<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payment extends AdminController
{
    public function __construct()
    {
        parent::__construct(CLIENT, BROKER);
        $this->load->helper('general');
        checkAdminAuth();
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->library('cart');
        $this->form_validation->set_error_delimiters('<div class="red">', '</div>');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('path');
        $this->load->model('PaymentModel');
        $this->load->model('MembershipModel');
        $this->load->model('SettingsModel');
        $this->load->model('CampaignModel');
    }

    function _remap($method, $parameter)
    {
        if (method_exists($this, $method)) {
            $this->$method($parameter);
        } else {
            $this->index($method, $parameter);
        }
    }


    function paypal()
    {
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
            if ($this->SettingsModel->getPaypalState() == 'live') {
                $config['business'] = 'admin@cyberneticstechnology.com';
            } else {
                $config['business'] = 'admin-facilitator@cyberneticstechnology.com';
            }
            $config['cpp_header_image'] = '';
            //Image header url [750 pixels wide by 90 pixels high]
            $config['custom'] = $transection_type;
            $config['return'] = base_url() . 'administrator/payment/buyLineProcess/' . $this->userId;
            $config['cancel_return'] = base_url() . 'administrator/line/lines/' . $this->userId;
            $config['notify_url'] = base_url() . 'Ipnlistener/process/' . $this->userId . '/?XDEBUG_SESSION_START';;
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

    function buyLineByBroker()
    {
        $cartItem = $this->cart->contents();
        $transection_type = 'broker_purchase';
        if (!empty($cartItem)) {
            $config = array();
            if ($this->SettingsModel->getPaypalState() == 'live') {
                $config['business'] = 'admin@cyberneticstechnology.com';
            } else {
                $config['business'] = 'pradhan2@yahoo.com';
                //$config['business'] = 'admin-facilitator@cyberneticstechnology.com';
            }
            $config['cpp_header_image'] = '';
            //Image header url [750 pixels wide by 90 pixels high]
            $config['custom'] = $transection_type;
            $config['return'] = base_url() . 'administrator/payment/buyLineByBrokerProcess/' . $this->userId;
            $config['cancel_return'] = base_url() . 'administrator/line/lines/' . $this->userId;
            $config['notify_url'] = base_url() . 'Ipnlistener/process/' . $this->userId . '/?XDEBUG_SESSION_START';;
            //IPN Post
            $config['rm'] = 2;
            $config['production'] = FALSE;
            //Its false by default and will use sandbox
            //$config['discount_rate_cart'] 	= 20; //This means 20% discount
            //$config["invoice"]				= '843843'; //The invoice id
            $this->load->library('Paypal', $config);
            #$this->paypal->add(<name>,<price>,<quantity>[Default 1],<code>[Optional]);
            foreach ($cartItem as $key => $item) {
                $this->paypal->add('Tradeline-' . $item['name'], $item['price'], 1, $item['id'] . '-' . $item['clientId'] . '-' . $item['owner_price'] . '-' . $item['broker_price'] . '-' . $item['client_broker_price'] . '-' . $item['qty']);
            }

            //First item
            $this->paypal->pay();
            //Proccess the payment
        } else
            redirect(ADMIN_PATH . 'line/cart');
    }

    function buyLineByBrokerProcess($userId){
        $this->cart->destroy();
        redirect(ADMIN_PATH . 'line/market');
    }

    function buyLineProcess($userId)
    {

        $paypalTransactionId = $_GET['tx'];
        $transaction = $this->PaymentModel->getTransaction($paypalTransactionId);
        $status = $_GET['st'];
        $type = $_GET['cm'];
        if ($status == 'Completed') {
            try {
                $transactionId = $transaction->transaction_id;
                $hit = $transaction->hit + 1;
                if ($transactionId) {
                    $this->PaymentModel->updateTransaction($userId, $type, $_GET['tx'], null, $_GET['st'], $hit, $_GET['amt'], null, $transactionId);
                } else {
                    $this->PaymentModel->insertTransaction($userId, $type, $_GET['tx'], null, $_GET['st'], $_GET['amt'], null);
//                    $this->PaymentModel->insertLineClient();
//                    $this->TaskModel->insertRegistrationNotificationTask($userId);
                }
            } catch (Exception $e) {
            }
        } else {
            throw new Exception("Paypal transaction could not be completed. Paypal returned " . $status);
        }
        redirect(ADMIN_PATH . 'line/market');


    }

    function membershipUpgrade($userId = ''){
        if(empty($userId)){
            $userId = $this->userId;
        }else{
            $userId = $this->uri->segment(4);
            $this->userId = $this->uri->segment(4);
        }

        $oldClientMembershipType = $this->input->post('clientMembershipTypeId');
        $clientMembershipType = $this->input->post('membershipTypeClient');
        $clientCoupon = $this->input->post('clientCoupon');
        $oldOwnerMembershipType = $this->input->post('ownerMembershipTypeId');
        $ownerMembershipType = $this->input->post('membershipTypeOwner');
        $ownerCoupon = $this->input->post('ownerCoupon');
        $oldBrokerMembershipType = $this->input->post('brokerMembershipTypeId');
        $brokerMembershipType = $this->input->post('membershipTypeBroker');
        $brokerCoupon = $this->input->post('brokerCoupon');
        $clientCampaignInfo = $this->CampaignModel->checkCouponRoleMatchDiscount($clientMembershipType, $clientCoupon);
        $ownerCampaignInfo = $this->CampaignModel->checkCouponRoleMatchDiscount($ownerMembershipType, $ownerCoupon);
        $brokerCampaignInfo = $this->CampaignModel->checkCouponRoleMatchDiscount($brokerMembershipType, $brokerCoupon);
        if($clientCoupon){
            $clientCouponInfo = $this->CampaignModel->getCampaignDetailByCoupon($clientCoupon);
        }
        else{
            $clientCouponInfo = $this->CampaignModel->getFullFeeCouponInfo($clientMembershipType);
        }
        if($ownerCoupon){
            $ownerCouponInfo = $this->CampaignModel->getCampaignDetailByCoupon($ownerCoupon);
        }
        else{
            $ownerCouponInfo = $this->CampaignModel->getFullFeeCouponInfo($ownerMembershipType);
        }
        if($brokerCoupon){
            $brokerCouponInfo = $this->CampaignModel->getCampaignDetailByCoupon($brokerCoupon);
        }
        else{
            $brokerCouponInfo = $this->CampaignModel->getFullFeeCouponInfo($brokerMembershipType);
        }

        $config = array();
        if ($this->SettingsModel->getPaypalState() == 'live') {
            $config['business'] = 'admin@cyberneticstechnology.com';
        } else {
            $config['business'] = 'pradhan2@yahoo.com';
            //$config['business'] = 'admin-facilitator@cyberneticstechnology.com';
        }
        $config['cpp_header_image'] = '';
        //Image header url [750 pixels wide by 90 pixels high]
        $config['custom'] = 'membershipUpgrade';
        $config['return'] = base_url() . 'administrator/payment/membershipUpgradeProcess/' . $this->userId. '/?XDEBUG_SESSION_START';
        $config['cancel_return'] = base_url() . 'administrator/user/user/' . $this->userId;
        $config['notify_url'] = base_url() . 'Ipnlistener/process/' . $this->userId . '/?XDEBUG_SESSION_START';
        //IPN Post
        $config['rm'] = 2;
        $config['production'] = FALSE;
        //Its false by default and will use sandbox
        //$config['discount_rate_cart'] 	= 20; //This means 20% discount
        //$config["invoice"]				= '843843'; //The invoice id
        $this->load->library('Paypal', $config);

    $description= "";
    $paymentAmount="";
    $recurring_status = $this->input->post('recurring');
     $payment_method = $this->input->post('paymentType');

        if(!empty($clientMembershipType)){ 
            if ($clientCoupon) {
                if ($clientCampaignInfo == 100) { 
                    $this->MembershipModel->upgradeMembershipFree($userId, $clientMembershipType ,$clientCouponInfo->id, $oldClientMembershipType);
                }
                else{ 
                    $clientMembershipInfo = $this->UserModel->getMembershipChargeAfterDiscount($userId, $clientMembershipType, 2,$clientCampaignInfo);
                    $this->paypal->add($clientMembershipInfo->value . ' Membership-' . $clientMembershipInfo->tid.'-'.$clientCouponInfo->id.'-'.$oldClientMembershipType, $clientMembershipInfo->price, 1, '');
                
                  $description.= $clientMembershipInfo->value . ' Membership-' . $clientMembershipInfo->tid.'-'.$clientCouponInfo->id.'-'.$oldClientMembershipType;
                  $paymentAmount+=$clientMembershipInfo->price;
                 
                }
            }
            else{ 
                $clientMembershipInfo = $this->UserModel->getMembershipChargeAfterDiscount($userId, $clientMembershipType, 2);
            
             
                $this->paypal->add($clientMembershipInfo->value . ' Membership-' . $clientMembershipInfo->tid.'-'.$clientCouponInfo->id.'-'.$oldClientMembershipType, $clientMembershipInfo->price, 1, '');

                 
                 $description.= " ".$clientMembershipInfo->value . ' Membership-' . $clientMembershipInfo->tid.'-'.$clientCouponInfo->id.'-'.$oldClientMembershipType;
                  $paymentAmount+=$clientMembershipInfo->price;
                

               }

        }
        if(!empty($ownerMembershipType)){//echo 'test1'; die();
            if ($ownerCoupon) {
                if ($ownerCampaignInfo == 100) {
                    $this->MembershipModel->upgradeMembershipFree($userId, $ownerMembershipType ,$ownerCouponInfo->id, $oldOwnerMembershipType);
                }
                else{
                    $ownerMembershipInfo = $this->UserModel->getMembershipChargeAfterDiscount($userId, $ownerMembershipType, 3, $ownerCampaignInfo);
                    $this->paypal->add($ownerMembershipInfo->value . ' Membership-' . $ownerMembershipInfo->tid.'-'.$ownerCouponInfo->id.'-'.$oldOwnerMembershipType, $ownerMembershipInfo->price, 1, '');

                      $description.= " ".$ownerMembershipInfo->value . ' Membership-' . $ownerMembershipInfo->tid.'-'.$ownerCouponInfo->id.'-'.$oldOwnerMembershipType;
                      $paymentAmount+=$ownerMembershipInfo->price;
                }
            }
            else{
                $ownerMembershipInfo = $this->UserModel->getMembershipChargeAfterDiscount($userId, $ownerMembershipType, 3);
                $this->paypal->add($ownerMembershipInfo->value . ' Membership-' . $ownerMembershipInfo->tid.'-'.$ownerCouponInfo->id.'-'.$oldOwnerMembershipType, $ownerMembershipInfo->price, 1, '');

                 $description.= " ".$ownerMembershipInfo->value . ' Membership-' . $ownerMembershipInfo->tid.'-'.$ownerCouponInfo->id.'-'.$oldOwnerMembershipType;
                 $paymentAmount+=$ownerMembershipInfo->price;
            }

        }
        if(!empty($brokerMembershipType)){
            if ($brokerCoupon) {
                if ($brokerCampaignInfo == 100) {
                    $this->MembershipModel->upgradeMembershipFree($userId, $brokerMembershipType ,$brokerCouponInfo->id, $oldBrokerMembershipType);
                }
                else{
                    $brokerMembershipInfo = $this->UserModel->getMembershipChargeAfterDiscount($userId, $brokerMembershipType, 5);
                    $this->paypal->add($brokerMembershipInfo->value . ' Membership-' . $brokerMembershipInfo->tid.'-'.$brokerCouponInfo->id.'-'.$oldBrokerMembershipType, $brokerMembershipInfo->price, 1, '');

                     $description.= " ".$brokerMembershipInfo->value . ' Membership-' . $brokerMembershipInfo->tid.'-'.$brokerCouponInfo->id.'-'.$oldBrokerMembershipType;
                     $paymentAmount+=$brokerMembershipInfo->price;
                }
            }
            else{
                $brokerMembershipInfo = $this->UserModel->getMembershipChargeAfterDiscount($userId, $brokerMembershipType, 5, $brokerCoupon);
                $this->paypal->add($brokerMembershipInfo->value . ' Membership-' . $brokerMembershipInfo->tid.'-'.$brokerCouponInfo->id.'-'.$oldBrokerMembershipType, $brokerMembershipInfo->price, 1, '');

                  $description.= " ".$brokerMembershipInfo->value . ' Membership-' . $brokerMembershipInfo->tid.'-'.$brokerCouponInfo->id.'-'.$oldBrokerMembershipType;
                 $paymentAmount+=$brokerMembershipInfo->price;
            }
        }
        if(($clientCampaignInfo !=100 && $clientMembershipType!='') || ($ownerCampaignInfo!=100 && $ownerMembershipType!='') || ($brokerCampaignInfo !=100 && $brokerMembershipType!='')){
           
         if($payment_method=="paypal"){ 

            if($recurring_status){ 

             $this->registrationRecurring($userId, $paymentAmount, $membershipType, $role, $description, $config);

            } else{

                 $this->paypal->pay();

            }

         } 
       
        }
        else {

            redirect(ADMIN_PATH . 'user/user/' . $this->userId);
        }

    }

    function registrationRecurring($userId, $paymentAmount, $membershipType, $role='', $description='', $config)
    { //echo $userId."==".$paymentAmount."==".$membershipType."==".$role."==".$description; die();
        $this->load->model('RecurringModel');
       
       $returnURL =  $config['return'];
      $cancelURL = $config['cancel_return'];
        $notifyURL =  $config['notify_url'];
            
        $_SESSION["notifyUrl"] = $notifyURL;

        $resArray = $this->RecurringModel->CallShortcutExpressCheckout($paymentAmount, $returnURL, $cancelURL, $membershipType, $role, $notifyURL, $description);
         //$resArray = $this->RecurringModel->CallShortcutExpressCheckout('6', $returnURL, $cancelURL, '1', '2', $notifyURL, 'suraj');
        $ack = strtoupper($resArray["ACK"]);
        if ($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING") {
            $this->RecurringModel->RedirectToPayPal($resArray["TOKEN"]);
        }
    }

    function membershipUpgradeProcess($userId){
        $paypalTransactionId = $_POST['txn_id'];
        $transaction = $this->PaymentModel->getTransaction($paypalTransactionId);
        $status = $_POST['payment_status'];
        if ($status == 'Completed') {
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
                        $this->PaymentModel->insertTransactionDetails($transactionId, $_POST['item_number'], $_POST['item_name' . $i], $_POST['mc_gross_' . $i]);
                        $this->MembershipModel->upgradeMembership($userId[0], $_POST['item_name' . $i]);
                    }
                } else {
                    $this->PaymentModel->insertTransactionDetails($transactionId, $_POST['item_name1'], "Registration", $_POST['mc_gross']);
                    $this->MembershipModel->upgradeMembership($userId[0], $_POST['item_name1']);
                }
            }
            $this->PaymentModel->activateUser($userId);
            redirect(ADMIN_PATH . 'user/user/' . $userId);

        }
        else{
            redirect(ADMIN_PATH);
        }

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


}

