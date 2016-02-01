<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Member extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->form_validation->set_error_delimiters('<div class="red">', '</div>');
        $this->load->helper(array('form', 'url', 'cookie'));
        $this->load->helper('security');
        $this->load->model('UserModel');
        $this->load->model('CampaignModel');
        $this->load->model('SettingsModel');
        $this->load->library('user_agent');
        $this->load->model('ProspectModel');
        $this->load->library('cart');
        $this->load->helper('helper');
        $this->load->model('EmailerModel');

    }

    public function index()
    {
        $data['title'] = 'LOG IN';
        $data['main_content'] = 'login';
        $userdata = array(
            USER_ID => '',
            ROLES => '',
            AUTHS => '',
            CAPTCHA => '',
            NAME => ''
        );
        $this->session->set_userdata($userdata);
        $this->load->view('inc/registration', $data);
    }

    public function signin()
    {
        if ($this->form_validation->run('login') == FALSE) {
            $this->session->set_flashdata('message', '<font color="#FF0000">Username and Password are required fields</font>');
            redirect('member');
        } else {
            $user_id = $this->UserModel->login($this->security->sanitize_filename($this->input->post('username')), $this->security->sanitize_filename($this->input->post('password')));
            if ($user_id) {
                if($this->session->userdata('previousLink'))
                    redirect($this->session->userdata('previousLink', 'refresh'));
                else
                    $this->db->query("UPDATE user SET last_login_date = CURRENT_DATE WHERE id = $user_id");
                    redirect(base_url() . 'administrator/home', 'refresh');
            } else {
                $this->session->set_flashdata('message', '<font color="#FF0000">Username and Password didn\'t match</font>');
                redirect('member');
            }
        }
    }

    public function check()
    {
        $data['main_content'] = 'register';
        $this->load->view('includes/affregister', $data);
    }

    function logout()
    {
        $this->session->unset_userdata(USER_ID);
        $this->session->unset_userdata(BROKER_ID);
        $this->session->unset_userdata(AUTHS);
        $this->session->unset_userdata(ROLES);
        $this->session->unset_userdata(NAME);
        $this->session->unset_userdata(PROFILE_PIC);
        $this->session->unset_userdata(ROLE_ID);
        $this->session->unset_userdata(ROLE_NAME);
        $this->session->unset_userdata(ROLE_LABEL);
        $this->session->unset_userdata(INBOX);
        $this->session->unset_userdata(COUNT_INBOX);
        $this->session->unset_userdata(MONTHLY_TIPS);
        $this->session->unset_userdata(PDF_BOOKS);
        $this->session->unset_userdata('campaign');
        $this->session->unset_userdata('previousLink');
        $this->session->unset_userdata('popUp');
        $this->cart->destroy();

        redirect(base_url() . 'member', 'refresh');
    }

    function forgotPassword()
    {
        if($this->input->post('username')){
            $id = $this->UserModel->checkEmailId($this->input->post('username'));
            if($id)
                $question = $this->UserModel->getQuestionById($id);
            if($question->question1!= NULL){
                 $data['questions'] = $question;
                $data['useremail']= $this->input->post('username');
            }
            else{
                $this->session->set_flashdata('message', '<font color="#FF0000" alingment="center">Permission Denied.Please Contact To Your Broker</font>');

            }
        }
        $data['title'] = 'Forgot Password';

        $data['main_content'] = 'forgotpassword';
        $this->load->view('inc/registration', $data);
    }


    function resetPassword()
    {
        $code = $this->autoGenerateCode();
        $email_to =$this->input->post('email') ;

        $answer_1 = $this->input->post('answer1');

        $answer_2 = $this->input->post('answer2');
        $result = $this->UserModel->checkQuestionsAnswers($email_to,$answer_1, $answer_2);
        $id = $this->UserModel->checkEmailId($email_to);

        if (!empty($id) && !empty($result)) {
            $this->UserModel->updateProfile(null, $id, $code);
            $subject = "Forgot Password";
            $message = "Click on the following link to reset your password";
            $this->load->library('SimpleEmailService');
            $ses = new SimpleEmailService('AKIAISEC5PBG2F54VL4A', 'ZhRYSpKdUMLRrxPwy878UN+pJmnllAocdcYRpJwZ');
            $ses->enableVerifyPeer(false);
            $m = new SimpleEmailServiceMessage();
            $from = 'info@thecredituniversity.com';
            $m->addTo($email_to);
            $m->setFrom($from . '<' . EMAILSENDER . '>');
            $m->setSubject($subject);
            $msg = $message;
            $msg .= '<br/><a href="' . base_url() . 'member/changePassword' . '/' . $code . '">CLICK HERE</a>';
            $m->setMessageFromString('', $msg);
            $ses->sendEmail($m);
            $this->session->set_flashdata('message', "<b style=\"color:green; alignment:center;\" >Please refer to your email. The reset link has been send to your email successfully.</b>");
            redirect(base_url() . 'member/forgotpassword');
        } else {
            $this->session->set_flashdata('message', "<b style=\"color:red;\">Contact Broker For Difficulties</b>");
            redirect(base_url() . 'member/forgotpassword');

        }
    }

    function autoGenerateCode()
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $code = substr(str_shuffle($chars), 0, 6);
        return $code;
    }

    function changePassword($code)
    {
        $user_id = $this->UserModel->checkResetCode($code);
        if (!empty($user_id)) {
            $data['title'] = 'Update Password';
            $data['user_id'] = $user_id;
            $data['main_content'] = 'changepassword';
            $this->load->view('inc/registration', $data);
        }
    }

    function  updatePassword($user_id)
    {
        $this->UserModel->updatePassword($user_id);
        $this->session->set_flashdata("su_message", "Password Updated Successfully.");
        redirect(base_url() . 'member');

    }


    function registrationCharge($userId, $campaignId = null, $roleId = null)
    {
        if ($campaignId) {
            list($campaigns, $registrationTypes) = $this->CampaignModel->checkFreeRegistration($campaignId);
            foreach ($registrationTypes as $registrationType) {
                $prices[] = $registrationType->price;
            }
            if (in_array(0, $prices, false)) {
                if ($this->MembershipModel->membershipExist($userId))
                    $this->MembershipModel->updateFreeMembership($userId, 2, $campaigns->end, $campaignId);
                else
                    $this->MembershipModel->insertFreeMembership($userId, 2, $campaigns->end, $campaignId);
                redirect(base_url() . 'member');
            }

            $data['campaignId'] = $campaignId;
            $campaignDetails = $this->CampaignModel->getCampaignDetails($campaignId, SELECT);
        }
        $data['userId'] = $userId;
        if ($campaignDetails) {
            $data['items'] = $campaignDetails;
            $data['main_content'] = 'registrationCharge';
        } else {
            $campaignDetails = $this->CampaignModel->getCampaignDetailsForBasicRole($roleId, SELECT);
            $data['items'] = $campaignDetails;
            $data['main_content'] = 'registrationCharge';
            $data['campaignId'] = $this->session->userdata('campaign');
        }
        $this->load->view('inc/registration', $data);
    }
     
    //function registrationPay($userId, $campaignId, $membershipType = '')   
    function registrationPay($userId, $campaignId, $membershipType = '',$paymentType = '')    
    {
        if ($campaignId == '') {
            $campaignId = $this->session->userdata('campaign');
        }
        if ($membershipType != '') {
            $membershipTypeId = $membershipType;
        } else {
            $membershipTypeId = $this->input->post('membershipType');
        }
        $userPick = $this->CampaignModel->getItems($campaignId, $membershipTypeId);
        $role = $userPick->role;
        $paymentAmount = $userPick->price; 
       // switch ($userPick->cycle) {
         switch ($paymentType) {
            case 'monthly_recurring':
            //case 'yearly_recurring':
            case 'recurring': //   modified by suraj
                $this->registrationRecurring($userId, $paymentAmount, $membershipTypeId, $role, $userPick->description);
                break;
            case 'yearly':
            case 'monthly':
                $this->registrationDirect($userId, $paymentAmount, $membershipTypeId, $role);
                break;
            default:
                $this->registrationDirect($userId, $paymentAmount, $membershipTypeId, $role, $campaignId);
                break;
        }
    }

    function registrationDirect($userId, $price, $membershipType, $role, $campaignId)
    {
        $level = $this->MembershipModel->getMembershipLevelBuy($membershipType, $role);
        $config = array();
        if ($this->SettingsModel->getPaypalState() == 'live') {
            $config['business'] = 'admin@cyberneticstechnology.com';
            $config['production'] = TRUE;
        } else {
            $config['business'] = 'pradhan2@yahoo.com';
            //$config['business'] = 'admin-facilitator@cyberneticstechnology.com';
            $config['production'] = FALSE;
        }
        $config['cpp_header_image'] = '';
        //Image header url [750 pixels wide by 90 pixels high]
        $config['return'] = base_url() . 'PaypalReturn/processDirect/' . $userId . '/' . $membershipType . '/' . $campaignId . '/?XDEBUG_SESSION_START';
        $config['notify_url'] = base_url() . 'IpnListener/process/' . $userId . '/' . $membershipType . '/' . $campaignId . '/?XDEBUG_SESSION_START';
        $config['cancel_return'] = base_url() . 'member/registrationCharge/' . $userId;
        //IPN Post
        $config['rm'] = 2;
        //Its false by default and will use sandbox
        //$config['discount_rate_cart'] 	= 20; //This means 20% discount
        //$config["invoice"]				= '843843'; //The invoice id
        $this->load->library('Paypal', $config);
        #$this->paypal->add(<name>,<price>,<quantity>[Default 1],<code>[Optional]);
        $this->paypal->add($level . ' Membership', $price, 1, $membershipType);
        //First item
        $this->paypal->pay();
        //Proccess the payment
    }

    function registrationRecurring($userId, $paymentAmount, $membershipType, $role, $description)
    {
        $this->load->model('RecurringModel');
        $returnURL = base_url() . 'PaypalReturn/processRecurring/' . $userId . '/' . $membershipType . '/' . $role . '/?XDEBUG_SESSION_START';
        $cancelURL = base_url() . 'member/registrationCharge/' . $userId;
        $notifyURL = base_url() . 'IpnListener/process/' . $userId . '/' . $membershipType . '/' . $role . '/?XDEBUG_SESSION_START';
        $_SESSION["notifyUrl"] = $notifyURL;

        $resArray = $this->RecurringModel->CallShortcutExpressCheckout($paymentAmount, $returnURL, $cancelURL, $membershipType, $role, $notifyURL, $description);
        $ack = strtoupper($resArray["ACK"]);
        if ($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING") {
            $this->RecurringModel->RedirectToPayPal($resArray["TOKEN"]);
        }
    }

    function registrationPayOthers_backup($userId, $roleId, $campaignId, $membershipTypeId, $paymentType)
    {
        $campaign = $this->CampaignModel->getCampaignDetailById($campaignId);
        $userPick = $this->CampaignModel->getItems($campaignId, $membershipTypeId);
        $this->MembershipModel->insertInactiveMember($userId, $membershipTypeId, $campaign->end, $campaignId);
        $transactionId = $this->PaymentModel->insertInactiveTransaction($userId, $paymentType);
        $this->PaymentModel->insertInactiveTransactionDetail($transactionId, $userPick->price);
        if($campaign->percentage ==100){
            $this->MembershipModel->activateMembership($userId);
            $prospectEmail = $this->UserModel->getEmailAddress($userId);
            $this->ProspectModel->inactiveProspect($prospectEmail);
        }

        $this->session->set_flashdata('memberRegistered',"Congratulations! You have successfully signed up. Please Log in.");
        redirect(base_url() . 'member');


    }
    function registrationPayOthers($userId, $roleId, $campaignId, $membershipTypeId, $paymentType,$broker_id='')
    { 
       
        $campaign = $this->CampaignModel->getCampaignDetailById($campaignId);       
        $userPick = $this->CampaignModel->getItems($campaignId, $membershipTypeId);
        $this->MembershipModel->insertInactiveMember($userId, $membershipTypeId, $campaign->end, $campaignId);
        $transactionId = $this->PaymentModel->insertInactiveTransaction($userId, $paymentType);
        $this->PaymentModel->insertInactiveTransactionDetail($transactionId, $userPick->price);
        if($campaign->percentage ==100){
        
             try {
                 $token = rand(1,99999);
                 $this->MembershipModel->insertMembershipToken($userId , $token);
//               $this->MembershipModel->activateMembership($userId);
              $prospectEmail = $this->UserModel->getEmailAddress($userId);
               if($prospectEmail){ 
                 $this->EmailerModel->sendWelcomeRegistrationMail($prospectEmail ,$broker_id , $token , $userId);
                    }

                    } catch (Exception $e) {
                        echo json_encode($this->handleDatabaseError($e));
                        return;
                    }         
          
            $this->ProspectModel->inactiveProspect($prospectEmail);
        }

        $this->session->set_flashdata('memberRegistered',"Congratulations! You have successfully signed up. Please Log in.");
        redirect(base_url() . 'member');


    }

    function checkEmailExist()
    {
        $email = $_POST['email'];
        $this->UserModel->userExist($email);
    }

    function getMembershipToken($userId){
        $query = $this->db->query("Select token from membership where user_id = '$userId'");
        return $query->row();
    }


    function activateMember($token , $userId){
       $membership = $this->getMembershipToken($userId);
        try{

            if($membership->token == $token){
                $this->MembershipModel->activateMembership($userId);
                $this->session->set_flashdata('memberRegistered',"Congratulations! You have successfully signed up. Please Log in.");
                redirect(base_url('member')); }
            else{
                redirect(base_url('register/signUp'));
            }
        }
        catch(Exception $e){
            echo json_encode($this->handleDatabaseError($e));
            return;
        }
    }

}
