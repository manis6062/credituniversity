<?php

class RecurringModel extends CI_Model
{

    public $API_USER_NAME_SANDBOX = "admin-facilitator_api1.cyberneticstechnology.com";
    public $API_PASSWORD_SANDBOX = "NNE7B9HEJK9TL7LB";
    public $API_SIGNATURE_SANDBOX = "AFcWxV21C7fd0v3bYYYRCpSSRl31ABh-eMfmykqxCWZQO6716aLq6mWJ";
    public $API_USER_NAME_PRODUCTION = "admin_api1.cyberneticstechnology.com";
    public $API_PASSWORD_PRODUCTION = "PTMP3T5HR9UQNAUQ";
    public $API_SIGNATURE_PRODUCTION = "AFcWxV21C7fd0v3bYYYRCpSSRl31AiY8JDyMVSGnsXOo6BDV532dhZZ5";
    public $sBNCode = "PP-ECWizard";

    function __construct()
    {
        parent::__construct();
        $this->load->library('email');
        $this->load->helper('security');
        $this->PROXY_HOST = '127.0.0.1';
        $this->PROXY_PORT = '808';
        $this->load->model('SettingsModel');
        if ($this->SettingsModel->getPaypalState() == 'live') {
            $SandboxFlag = false;
        } else {
            $SandboxFlag = true;
        }
        if ($SandboxFlag == true) {
            $this->API_Endpoint = "https://api-3t.sandbox.paypal.com/nvp";
            $this->PAYPAL_URL = "https://www.sandbox.paypal.com/webscr?cmd=_express-checkout&token=";
        } else {
            $this->API_Endpoint = "https://api-3t.paypal.com/nvp";
            $this->PAYPAL_URL = "https://www.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=";
        }
        $this->version = "76";
        if (session_id() == "")
            session_start();
    }

    function CallShortcutExpressCheckout($paymentAmount, $returnURL, $cancelURL, $membershipType, $role, $notifyURL, $description)
    {
        $nvpstr = "&BILLINGAGREEMENTDESCRIPTION=" . urlencode($description);
        $nvpstr = $nvpstr . "&BILLINGTYPE=RecurringPayments";
        $nvpstr = $nvpstr . "&RETURNURL=" . $returnURL;
        $nvpstr = $nvpstr . "&CANCELURL=" . $cancelURL;
        $nvpstr .= "&NOTIFYURL=" . $notifyURL;
        $nvpstr = $nvpstr . "&PAYMENTREQUEST_0_PAYMENTACTION=Sale";
        $nvpstr = $nvpstr . "&L_PAYMENTREQUEST_0_NAME0=Client - Monthly Membership";
        $nvpstr = $nvpstr . "&L_PAYMENTREQUEST_0_NUMBER0=" . $membershipType;
//        $nvpstr = $nvpstr . "&L_PAYMENTREQUEST_0_NAME=Client - Monthly Membership";

//        $nvpstr = $nvpstr . "&L_PAYMENTREQUEST_0_NUMBER=" . $membershipType;
        $nvpstr = $nvpstr . "&L_PAYMENTREQUEST_0_DESC0=Monthly Recurring";
        $nvpstr = $nvpstr . "&L_PAYMENTREQUEST_0_AMT0=" . $paymentAmount;
        $nvpstr = $nvpstr . "&L_PAYMENTREQUEST_0_QTY0=1";
        $nvpstr = $nvpstr . "&PAYMENTREQUEST_0_ITEMAMT=" . $paymentAmount;
        $nvpstr = $nvpstr . "&PAYMENTREQUEST_0_TAXAMT=0";
        $nvpstr = $nvpstr . "&PAYMENTREQUEST_0_SHIPPINGAMT=0";
        $nvpstr = $nvpstr . "&PAYMENTREQUEST_0_HANDLINGAMT=0";
        $nvpstr = $nvpstr . "&PAYMENTREQUEST_0_SHIPDISCAMT=0";
        $nvpstr = $nvpstr . "&PAYMENTREQUEST_0_INSURANCEAMT=0";
        $nvpstr = $nvpstr . "&PAYMENTREQUEST_0_AMT=" . $paymentAmount;
        $nvpstr = $nvpstr . "&PAYMENTREQUEST_0_CURRENCYCODE=USD";
        $nvpstr = $nvpstr . "&ALLOWNOTE=1";
        $_SESSION["PaymentType"] = "Sale";
        $_SESSION["Description"] = $description;
        $resArray = $this->hash_call("SetExpressCheckout", $nvpstr);
        $ack = strtoupper($resArray["ACK"]);
        if ($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING") {
            $token = urldecode($resArray["TOKEN"]);
            $_SESSION['TOKEN'] = $token;
        }
        return $resArray;
    }

    function GetShippingDetails($token)
    {
        $nvpstr = "&TOKEN=" . $token;
        $resArray = $this->hash_call("GetExpressCheckoutDetails", $nvpstr);
        $ack = strtoupper($resArray["ACK"]);
        if ($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING") {
            $_SESSION['payer_id'] = $resArray['PAYERID'];
            $_SESSION['email'] = $resArray['email'];
            $_SESSION['firstName'] = $resArray["FIRSTNAME"];
            $_SESSION['lastName'] = $resArray["LASTNAME"];
        }
        return $resArray;
    }


    function ConfirmPayment($FinalPaymentAmt, $userId, $membershipType, $role)
    {
        $token = urlencode($_SESSION['TOKEN']);
        $paymentType = urlencode($_SESSION['PaymentType']);
        $currencyCodeType = urlencode($_SESSION['currencyCodeType']);
        $payerID = urlencode($_SESSION['payer_id']);
        $serverName = urlencode($_SERVER['SERVER_NAME']);
        $nvpstr = '&TOKEN=' . $token . '&PAYERID=' . $payerID . '&PAYMENTACTION=' . $paymentType . '&AMT=' . $FinalPaymentAmt;
        $nvpstr .= '&NOTIFYURL=' . $_SESSION["notifyUrl"];
        $nvpstr .= '&CURRENCYCODE=' . $currencyCodeType . '&IPADDRESS=' . $serverName;
        $nvpstr .= "&NOTIFYURL=" . base_url() . 'IpnListener/process/' . $userId . '/' . $membershipType . '/' . $role . '/?XDEBUG_SESSION_START';
        $resArray = $this->hash_call("DoExpressCheckoutPayment", $nvpstr);
        $_SESSION['billing_agreemenet_id'] = $resArray["BILLINGAGREEMENTID"];
        return $resArray;
    }

    function CreateRecurringPaymentsProfile($paymentAmount)
    {
        $rec_date = date('Y-m-d', strtotime('+30 Days'));
        $token = urlencode($_SESSION['TOKEN']);
        $nvpstr = "&TOKEN=" . $token;
        $nvpstr .= '&NOTIFYURL=' . $_SESSION["notifyUrl"];
        $nvpstr .= "&INITAMT=" . $paymentAmount;
        $nvpstr .= "&PROFILESTARTDATE=" . $rec_date . 'T' . date('H:i:s');
        $nvpstr .= "&DESC=" . $_SESSION["Description"];
        $nvpstr .= "&BILLINGPERIOD=Month";
        $nvpstr .= "&BILLINGFREQUENCY=1";
        $nvpstr .= "&TOTALBILLINGCYCLES=11";
        $nvpstr .= "&AMT=" . $paymentAmount;
        $nvpstr .= "&PROFILEREFERENCE=2";
        $nvpstr .= "&CURRENCYCODE=USD";
        $nvpstr .= "&IPADDRESS=" . $_SERVER['REMOTE_ADDR'];
        $resArray = $this->hash_call("CreateRecurringPaymentsProfile", $nvpstr);
        return $resArray;
    }


    function DirectPayment($paymentType, $paymentAmount, $creditCardType, $creditCardNumber, $expDate, $cvv2, $firstName, $lastName, $street, $city, $state, $zip, $countryCode, $currencyCode)
    {

        $nvpstr = "&AMT=" . $paymentAmount;
        $nvpstr = $nvpstr . "&CURRENCYCODE=" . $currencyCode;
        $nvpstr = $nvpstr . "&PAYMENTACTION=" . $paymentType;
        $nvpstr = $nvpstr . "&CREDITCARDTYPE=" . $creditCardType;
        $nvpstr = $nvpstr . "&ACCT=" . $creditCardNumber;
        $nvpstr = $nvpstr . "&EXPDATE=" . $expDate;
        $nvpstr = $nvpstr . "&CVV2=" . $cvv2;
        $nvpstr = $nvpstr . "&FIRSTNAME=" . $firstName;
        $nvpstr = $nvpstr . "&LASTNAME=" . $lastName;
        $nvpstr = $nvpstr . "&STREET=" . $street;
        $nvpstr = $nvpstr . "&CITY=" . $city;
        $nvpstr = $nvpstr . "&STATE=" . $state;
        $nvpstr = $nvpstr . "&COUNTRYCODE=" . $countryCode;
        $nvpstr = $nvpstr . "&IPADDRESS=" . $_SERVER['REMOTE_ADDR'];
        $resArray = $this->hash_call("DoDirectPayment", $nvpstr);
        return $resArray;
    }


    function hash_call($methodName, $nvpStr)
    {

        global $USE_PROXY;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->API_Endpoint);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        if ($USE_PROXY)
            curl_setopt($ch, CURLOPT_PROXY, $this->PROXY_HOST . ":" . $this->PROXY_PORT);
        if ($this->SettingsModel->getPaypalState() == 'live') {
            $nvpreq = "METHOD=" . urlencode($methodName) . "&VERSION=" . urlencode($this->version) . "&PWD=" . urlencode($this->API_PASSWORD_PRODUCTION) . "&USER=" . urlencode($this->API_USER_NAME_PRODUCTION) . "&SIGNATURE=" . urlencode($this->API_SIGNATURE_PRODUCTION) . $nvpStr . "&BUTTONSOURCE=" . urlencode($this->sBNCode);
        } else {
            $nvpreq = "METHOD=" . urlencode($methodName) . "&VERSION=" . urlencode($this->version) . "&PWD=" . urlencode($this->API_PASSWORD_SANDBOX) . "&USER=" . urlencode($this->API_USER_NAME_SANDBOX) . "&SIGNATURE=" . urlencode($this->API_SIGNATURE_SANDBOX) . $nvpStr . "&BUTTONSOURCE=" . urlencode($this->sBNCode);
        }
        curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);
        $response = curl_exec($ch);
        $nvpResArray = $this->deformatNVP($response);
        $nvpReqArray = $this->deformatNVP($nvpreq);
        $_SESSION['nvpReqArray'] = $nvpReqArray;
        if (curl_errno($ch)) {
            $_SESSION['curl_error_no'] = curl_errno($ch);
            $_SESSION['curl_error_msg'] = curl_error($ch);
        } else {
            curl_close($ch);
        }
        return $nvpResArray;
    }

    function RedirectToPayPal($token)
    {
        $payPalURL = $this->PAYPAL_URL . $token;
        header("Location: " . $payPalURL);
    }


    function deformatNVP($nvpstr)
    {
        $intial = 0;
        $nvpArray = array();
        while (strlen($nvpstr)) {
            $keypos = strpos($nvpstr, '=');
            $valuepos = strpos($nvpstr, '&') ? strpos($nvpstr, '&') : strlen($nvpstr);
            $keyval = substr($nvpstr, $intial, $keypos);
            $valval = substr($nvpstr, $keypos + 1, $valuepos - $keypos - 1);
            $nvpArray[urldecode($keyval)] = urldecode($valval);
            $nvpstr = substr($nvpstr, $valuepos + 1, strlen($nvpstr));
        }
        return $nvpArray;
    }
}