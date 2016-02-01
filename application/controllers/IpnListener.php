<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ipnlistener extends CI_Controller
{
    private $SANDBOX_HOST_NAME = 'ssl://www.sandbox.paypal.com';
    private $PRODUCTION_HOST_NAME = 'ssl://www.paypal.com';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('PaymentModel');
        $this->load->model('MembershipModel');
        $this->load->model('TaskModel');
        $this->load->model('SettingsModel');
        $this->load->library('cart');
    }

    public function index()
    {
        $data['main_content'] = 'welcome';
        $this->load->view('includes/template', $data);
    }

    public function process($userId = '', $membershipType = '', $campaignId = '')
    {
        header('HTTP/1.1 200 OK');
        $req = $this->constructRequest();
        $header = $this->constructHeader($req);
        if ($this->SettingsModel->getPaypalState() == 'live') {
            $fp = fsockopen($this->PRODUCTION_HOST_NAME, 443, $errno, $errstr, 30);
        } else {
            $fp = fsockopen($this->SANDBOX_HOST_NAME, 443, $errno, $errstr, 30);
        }
        fputs($fp, $header . $req);
        while (!feof($fp)) {
            $res = fgets($fp, 1024);
            if (strcmp($res, "VERIFIED") == 0) {
                $paypalTransactionId = $_POST['txn_id'];
                $transaction = $this->PaymentModel->getTransaction($paypalTransactionId);
                $status = $_POST['payment_status'];
                if ($status == 'Completed') {
                    try {
                        $type = $_POST['custom'];
                        if ($type == 'client_purchase') {
                            $transactionId = $transaction->transaction_id;
                            $hit = $transaction->hit + 1;
                            if ($transactionId) {
                                $this->PaymentModel->updateTransaction($userId, $type, $_POST['txn_id'], $_POST['payer_email'], $_POST['payment_status'], $hit, $_POST['mc_gross'], $_POST['payment_date'], $transactionId);
                            } else {
                                $this->PaymentModel->insertTransaction($userId, $type, $_POST['txn_id'], $_POST['payer_email'], $_POST['payment_status'], $_POST['mc_gross'], $_POST['payment_date']);
                            }
                            if (!$this->PaymentModel->getTransactionDetails($transactionId)) {
                                $cartItems = $_POST['num_cart_items'];
                                if ($cartItems) {
                                    for ($i = 1; $i <= $cartItems; $i++) {
                                        list($lineId, $clientId, $price, $brokerPrice, $clientBrokerPrice, $months) = explode('-', $_POST['item_number' . $i]);
                                        $this->PaymentModel->insertLineClient($lineId, $clientId, $price, $brokerPrice, $clientBrokerPrice, $months);
                                        $this->db->query("UPDATE line SET used = used + 1 WHERE id = $lineId");
                                        $this->PaymentModel->insertTransactionDetails($transactionId, $_POST['item_number' . $i], $_POST['item_name' . $i], $_POST['mc_gross_' . $i]);
                                        $this->TaskModel->insertClientPurchaseLineTask($clientId, $lineId);
                                        $this->db->query("DELETE FROM cart_item WHERE line_id = $lineId AND id = (SELECT id FROM cart WHERE user_id =$userId )");
                                    }
                                }
                            }
                        }
                        elseif ($type == 'broker_purchase') {
                            $transactionId = $transaction->transaction_id;
                            $hit = $transaction->hit + 1;
                            if ($transactionId) {
                                $this->PaymentModel->updateTransaction($userId, $type, $_POST['txn_id'], $_POST['payer_email'], $_POST['payment_status'], $hit, $_POST['mc_gross'], $_POST['payment_date'], $transactionId);
                            } else {
                                $transactionId = $this->PaymentModel->insertTransaction($userId, $type, $_POST['txn_id'], $_POST['payer_email'], $_POST['payment_status'], $_POST['mc_gross'], $_POST['payment_date']);
                            }
                            if (!$this->PaymentModel->getTransactionDetails($transactionId)) {
                                $cartItems = $_POST['num_cart_items'];
                                if ($cartItems) {
                                    for ($i = 1; $i <= $cartItems; $i++) {
                                        list($lineId, $clientId, $price, $brokerPrice, $clientBrokerPrice, $months) = explode('-', $_POST['item_number' . $i]);
                                        $this->PaymentModel->insertLineClient($lineId, $clientId, $price, $brokerPrice, $clientBrokerPrice, $months);
                                        $this->db->query("UPDATE line SET used = used + 1 WHERE id = $lineId");
                                        $this->PaymentModel->insertTransactionDetails($transactionId, $_POST['item_number' . $i], $_POST['item_name' . $i], $_POST['mc_gross_' . $i]);
                                        //$this->TaskModel->insertClientPurchaseLineTask($clientId, $lineId);
                                       // $this->db->query("DELETE FROM cart_item WHERE line_id = $lineId AND id = (SELECT id FROM cart WHERE user_id =$userId )");
                                    }
                                }
                                $this->cart->destroy();
                            }
                        }
                        elseif($type =='membershipUpgrade'){
                            $transactionId = $transaction->transaction_id;
                            $hit = $transaction->hit + 1;
                            if ($transactionId) {
                                $this->PaymentModel->updateTransaction($userId[0], "registration", $_POST['txn_id'], $_POST['payer_email'], $_POST['payment_status'], $hit, $_POST['mc_gross'], $_POST['payment_date'], $transactionId);
                            } else {
                                $this->PaymentModel->insertTransaction($userId[0], "registration", $_POST['txn_id'], $_POST['payer_email'], $_POST['payment_status'], $_POST['mc_gross'], $_POST['payment_date']);

                                //$this->TaskModel->insertMembershipUpgradeTask($userId);
                            }
                            if (!$this->PaymentModel->getTransactionDetails($transactionId)) {
                                $transaction = $this->PaymentModel->getTransaction($paypalTransactionId);
                                $transactionId = $transaction->transaction_id;
                                $cartItems = $_POST['num_cart_items'];
                                if ($cartItems) {
                                    for ($i = 1; $i <= $cartItems; $i++) {
                                        $this->PaymentModel->insertTransactionDetails($transactionId, $_POST['item_number' . $i], $_POST['item_name' . $i], $_POST['mc_gross_' . $i]);
                                        $this->MembershipModel->upgradeMembership($userId[0], $_POST['item_name'.$i]);
                                    }
                                } else {
                                    $this->PaymentModel->insertTransactionDetails($transactionId, $_POST['item_name1'], "Registration", $_POST['mc_gross']);
                                    $this->MembershipModel->upgradeMembership($userId[0], $_POST['item_name1']);
                                }
                            }
                            $this->PaymentModel->activateUser($userId);
                        }
                        elseif($type == 'membership'){
                            $transactionId = $transaction->transaction_id;
                            $hit = $transaction->hit + 1;
                            if ($transactionId) {
                                $this->PaymentModel->updateTransaction($userId[0], "registration", $_POST['txn_id'], $_POST['payer_email'], $_POST['payment_status'], $hit, $_POST['mc_gross'], $_POST['payment_date'], $transactionId);
                            } else {
                                $this->PaymentModel->insertTransaction($userId[0], "registration", $_POST['txn_id'], $_POST['payer_email'], $_POST['payment_status'], $_POST['mc_gross'], $_POST['payment_date']);
                                $this->MembershipModel->upgradeMembership($userId[0], $_POST['item_name1']);
                                //$this->TaskModel->insertMembershipUpgradeTask($userId);
                            }
                            if (!$this->PaymentModel->getTransactionDetails($transactionId)) {
                                $transaction = $this->PaymentModel->getTransaction($paypalTransactionId);
                                $transactionId = $transaction->transaction_id;
                                $cartItems = $_POST['num_cart_items'];
                                if ($cartItems) {
                                    for ($i = 1; $i <= $cartItems; $i++) {
                                        $this->PaymentModel->insertTransactionDetails($transactionId, $_POST['item_number' . $i], $_POST['item_name' . $i], $_POST['mc_gross_' . $i]);
                                    }
                                } else {
                                    $this->PaymentModel->insertTransactionDetails($transactionId, $_POST['item_name1'], "Registration", $_POST['mc_gross']);
                                }
                            }
                            $this->PaymentModel->activateUser($userId);
                        }
                        else {
                            $transactionId = $transaction->transaction_id;
                            $hit = $transaction->hit + 1;
                            if ($transactionId) {
                                $this->PaymentModel->updateTransaction($userId, "register", $_POST['txn_id'], $_POST['payer_email'], $_POST['payment_status'], $hit, $_POST['mc_gross'], $_POST['payment_date'], $transactionId);
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
                            $this->PaymentModel->activateUser($userId);
                        }
                    } catch (Exception $e) {
                        $str = "need to handle this";
                    }
                } else {
                    //handle error
                }
            } else if (strcmp($res, "INVALID") == 0) {
            }
        }
        fclose($fp);
    }


    public function constructHeader($req)
    {
        $header = '';
        $header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
        if ($this->SettingsModel->getPaypalState() == 'live') {
            $header .= "Host: www.paypal.com\r\n";
        } else {
            $header .= "Host: www.sandbox.paypal.com\r\n";
        }
        $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
        return $header;
    }

    public function constructRequest()
    {
        $req = 'cmd=_notify-validate';
        foreach ($_POST as $key => $value) {
            $value = urlencode(stripslashes($value));
            $req .= "&$key=$value";
        }
        return $req;
    }
}
