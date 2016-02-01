<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Webhooks extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('general');
        checkAdminAuth();
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->form_validation->set_error_delimiters('<div class="red">', '</div>');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('path');
    }

    function _remap($method, $parameter)
    {
        if (method_exists($this, $method)) {
            $this->$method($parameter);
        } else {
            $this->index($method, $parameter);
        }
    }

    public function index()
    {
    }

    function paypal()
    {
        print_r($_POST);
        die;
        if (@$_POST['payment_status'] == "Completed") {
            $this->session->set_flashdata("su_message", "Paypal Payment Successful.");
        }
        $data['title'] = 'Paypal Payment';
        $data['main_content'] = ADMIN_PATH . "referrerpaypal_view";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function paymentPaypal()
    {
        $this->load->model('CartModel');
        $items = $this->CartModel->getCart($this->userId);
        if ($this->roleName == 'client') {
            $transection_type = 'client_purchase';
        }
        if (!empty($items)) {
            $config = array();
            $config['business'] = 'pradhan2@yahoo.com';
            $config['cpp_header_image'] = '';
            //Image header url [750 pixels wide by 90 pixels high]
            $config['custom'] = $this->userId . '-' . $transection_type;
            $config['return'] = base_url() . 'administrator/payment/paypal';
            $config['cancel_return'] = base_url() . 'administrator/line/lines';
            $config['notify_url'] = base_url() . 'ipnlistener/paymentProcess';
            //IPN Post
            $config['rm'] = 2;
            $config['production'] = FALSE;
            //Its false by default and will use sandbox
            //$config['discount_rate_cart'] 	= 20; //This means 20% discount
            //$config["invoice"]				= '843843'; //The invoice id
            $this->load->library('Paypal', $config);
            #$this->paypal->add(<name>,<price>,<quantity>[Default 1],<code>[Optional]);
            foreach ($items as $key => $item) {
                $this->paypal->add('Tradeline-' . $item->line_id, $item->client_broker_price, 1, $item->line_id . '-' . $this->userId . '-' . $item->price . '-' . $item->broker_price . '-' . $item->client_broker_price . '-' . $item->quantity);
            }

            //First item
            $this->paypal->pay();
            //Proccess the payment
        } else
            redirect(ADMIN_PATH . 'line/market');
    }

    function paymentHistory()
    {
        $data['title'] = 'Payment History';
        $data['main_content'] = ADMIN_PATH . "paymentHistory";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }


    function cash()
    {
        $data['title'] = 'Cash Payment';
        $data['main_content'] = ADMIN_PATH . "referrercash_view";
        $this->load->view(ADMIN_PATH . 'incs/template', $data);
    }

    function addcash()
    {
        if (in_array('payment', $this->allowed)) {
            if ($this->form_validation->run('addcash') == FALSE) {
                $this->cash();
            } else {
                $this->PaymentModel->insertCashPayment($this->session->userdata(USER_ID));

                $this->session->set_flashdata("su_message", "Cash Payment Added Successfully.");
                redirect(ADMIN_PATH . "payment/cash");
            }
        } else {
            redirect("admin");
        }
    }

    function confirm()
    {
        echo "welcome back";
    }


}

