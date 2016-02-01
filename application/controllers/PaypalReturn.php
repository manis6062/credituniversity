<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class PaypalReturn extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('PaymentModel');
        $this->load->model('MembershipModel');
    }

    public function index()
    {
        $data['main_content'] = 'welcome';
        $this->load->view('includes/template', $data);
    }

    public function processDirect($userId, $membershipType, $campaignId)
    {
        $this->processPayment($userId, $membershipType, $campaignId);
        redirect('member');
    }

    public function processRecurring($userId, $membershipType, $role)
    {
        $this->load->model('RecurringModel');
        $resArray = $this->RecurringModel->GetShippingDetails($_SESSION['TOKEN']);
        $ack = strtoupper($resArray["ACK"]);
        if ($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING") {
            $resArray = $this->RecurringModel->ConfirmPayment(strtoupper($resArray["AMT"]), $userId, $membershipType, $role);
            $ack = strtoupper($resArray["ACK"]);
            if ($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING") {
                if ($_GET['token'] && $_GET['PayerID']) {
                    $resArray = $this->RecurringModel->CreateRecurringPaymentsProfile(strtoupper($resArray["AMT"]));
                    $ack = strtoupper($resArray["ACK"]);
                    if ($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING") {
                        if (strtoupper($resArray["PROFILEID"])) {
                            $this->PaymentModel->insertRecurringProfile($userId, $resArray["PROFILEID"],$resArray["NEXTBILLINGDATE"]);
                            try {
                                $this->MembershipModel->insertMembership($userId, $membershipType, 0);
                                $this->TaskModel->insertRegistrationNotificationTask($userId);
                                $this->PaymentModel->activateUser($userId);
                            } catch (Exception $e) {
                            }
                        } else {
                            $this->processPayment($userId, $membershipType, $role);
                        }
                        redirect('member');
                    }
                }
            }
        } else {
            $ErrorCode = urldecode($resArray["L_ERRORCODE0"]);
            $ErrorShortMsg = urldecode($resArray["L_SHORTMESSAGE0"]);
            $ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
            $ErrorSeverityCode = urldecode($resArray["L_SEVERITYCODE0"]);
            echo "GetExpressCheckoutDetails API call failed. ";
            echo "Detailed Error Message: " . $ErrorLongMsg;
            echo "Short Error Message: " . $ErrorShortMsg;
            echo "Error Code: " . $ErrorCode;
            echo "Error Severity Code: " . $ErrorSeverityCode;
        }

    }

    public function processPayment($userId, $membershipType, $campaignId)
    {
        $paypalTransactionId = $_GET['tx'];
        $status = $_GET['st'];
        $method = 'get';
        if (!$paypalTransactionId) {
            $paypalTransactionId = $_POST['txn_id'];
            $status = $_POST['payment_status'];
            $method = 'post';
        }
        $transaction = $this->PaymentModel->getTransaction($paypalTransactionId);
        if ($status == 'Completed') {
            try {
                $transactionId = $transaction->transaction_id;
                if ($method == 'get') {
                    if ($transactionId) {
                        $this->PaymentModel->updateTransaction($userId, "registration", $_GET['tx'], null, $_GET['st'], null, $_GET['amt'], null, $transactionId);
                    } else {
                        $this->PaymentModel->insertTransaction($userId, "registration", $_GET['tx'], null, $_GET['st'], $_GET['amt'], null);
                        $this->MembershipModel->insertMembership($userId, $membershipType, $campaignId);
                        $this->TaskModel->insertRegistrationNotificationTask($userId);
                    }
                } else {
                    if ($transactionId) {
                        $this->PaymentModel->updateTransaction($userId, "registration", $_POST['txn_id'], $_POST['payer_email'], $_POST['payment_status'], null, $_POST['mc_gross'], $_POST['payment_date'], $transactionId);
                    } else {
                        $this->PaymentModel->insertTransaction($userId, "registration", $_POST['txn_id'], $_POST['payer_email'], $_POST['payment_status'], $_POST['mc_gross'], $_POST['payment_date']);
                        $this->MembershipModel->insertMembership($userId, $membershipType, $campaignId);
                        $this->TaskModel->insertRegistrationNotificationTask($userId);
                    }
                    if (!$this->PaymentModel->getTransactionDetails($transactionId)) {
                        $cartItems = $_POST['num_cart_items'];
                        if ($cartItems) {
                            for ($i = 1; $i <= $cartItems; $i++) {
                                $this->PaymentModel->insertTransactionDetails($transactionId, $_POST['item_number' . $i], $_POST['item_name' . $i], $_POST['mc_gross_' . $i]);
                            }
                        } else {
                            $this->PaymentModel->insertTransactionDetails($transactionId, $membershipType, "Registration", $_POST['mc_gross']);
                        }
                    }
                }
                $this->PaymentModel->activateUser($userId);
            } catch (Exception $e) {
                $str = "need to handle this";
            }
        } else {
            throw new Exception("Paypal transaction could not be completed. Paypal returned " . $status);
        }
    }

}
