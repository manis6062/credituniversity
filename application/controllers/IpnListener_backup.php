<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ipnlistener extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('PaymentModel');
    }

    public function index()
    {
        $data['main_content'] = 'welcome';
        $this->load->view('includes/template', $data);
    }

    public function paymentProcess()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if ($_POST['txn_type'] == 'recurring_payment') {
                $this->db->query("UPDATE line SET used = used + 4 WHERE id = 1");
                $fh = fopen('result.txt', 'w');
                fwrite($fh, $_POST);
                fclose($fh);
                $val = $_POST['rp_invoice_id'];
                if ($val)
                    $this->db->query("UPDATE line SET used = used + $val WHERE id = 1");
                else
                    $this->db->query("UPDATE line SET used = used + 20 WHERE id = 1");
            } else {
                $val = $_POST['custom'];
                list($userId, $transactionType) = explode('-', $val);
                if ($_POST['receiver_email'] == 'pradhan2@yahoo.com' && $_POST['payment_status'] == "Completed") {
                    try {
                        header('HTTP/1.1 200 OK');
                        $this->PaymentModel->processMembership($userId, $transactionType);
                        redirect(ADMIN_PATH);
                    } catch (Exception $e) {
                        echo $e;
                    }
                }
            }
        }

    }


}
