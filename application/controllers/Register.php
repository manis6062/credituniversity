<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Register extends AdminController
{
    public function __construct()
    {
        parent::__construct(all);
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url', 'captcha'));
        $this->load->model('RoleModel');
        $this->load->model('AffiliateModel');
        $this->load->model('EmailerModel');
        $this->load->model('UserModel');
        $this->load->model('CampaignModel');
        $this->load->model('MembershipModel');
//        $this->load->library('curl');


    }

    function _remap($method, $parameter)
    {
        if (method_exists($this, $method)) {
            $this->$method($parameter);
        } else {
            $this->index($method, $parameter);
        }
    }

    public function index($code = '')
    {
        $data['main_content'] = 'login';
        $this->load->view('inc/registration', $data);
    }


//    function signUp($vars = '')
//    {
//        $data['title'] = "Add User";
//        $data['states'] = $this->UserModel->getStates();
//        $data['roles'] = $this->RoleModel->getRolesFor("radio");
//        $data['brokers'] = $this->UserModel->getBrokers(SELECT);
//        $data['questions'] = $this->UserModel->getQuestions();
//        $data['clientMembership'] = $this->MembershipModel->getMembershipByRole(2);
//        $data['ownerMembership'] = $this->MembershipModel->getMembershipByRole(3);
////        $data['referralMembership'] = $this->MembershipModel->getMembershipByRole(4);
//        $data['brokerMembership'] = $this->MembershipModel->getMembershipByRole(5);
//        if ($vars != '') {
//            $data['brokerId'] = $vars[0];
//        }
//        $data['main_content'] = 'publicRegistration';
//        $this->load->view('inc/registration', $data);
//    }


    function signUp($vars = '')
    {
        if ($vars[0] && $vars[1]) {
            $data['title'] = "Add User";
            $data['questions'] = $this->UserModel->getQuestions();
            $data['brokerId'] = $vars[0];
            $data['coupon'] = $vars[1];
            $campaignInfo = $this->CampaignModel->getRoleIdByCouponCode($vars[1]);
            if ($campaignInfo) {
                $data['roleId'] = $campaignInfo->role;
                $membershipInfo = $this->MembershipModel->getMembershipTypeByRole($campaignInfo->role);
                $data['membershipTypeId'] = $membershipInfo->id;
                $data['main_content'] = 'publicRegistrationCampaign';
                $this->load->view('inc/registration', $data);
            } else {
                $this->session->set_flashdata("invalidCoupon", "This coupon is not valid.");
                $data['main_content'] = 'publicRegistrationCampaign';
                $this->load->view('inc/registration', $data);
            }
        } else {
            $data['title'] = "Add User";
            $data['states'] = $this->UserModel->getStates();
            $data['roles'] = $this->RoleModel->getRolesFor("radio");
            $data['brokers'] = $this->UserModel->getBrokers(SELECT);
            $data['questions'] = $this->UserModel->getQuestions();
            $data['clientMembership'] = $this->MembershipModel->getMembershipByRole(2);
            $data['ownerMembership'] = $this->MembershipModel->getMembershipByRole(3);
//        $data['referralMembership'] = $this->MembershipModel->getMembershipByRole(4);
            $data['brokerMembership'] = $this->MembershipModel->getMembershipByRole(5);
            if ($vars != '') {
                $data['brokerId'] = $vars[0];
            }
            $data['main_content'] = 'publicRegistration';
            $this->load->view('inc/registration', $data);
        }

    }

    function signUpNew()
    {
        $data['title'] = "Add User";
        $data['states'] = $this->UserModel->getStates();
        $data['roles'] = $this->RoleModel->getRolesFor("radio");
        $data['brokers'] = $this->UserModel->getBrokers(SELECT);
        $data['questions'] = $this->UserModel->getQuestions();
        $data['main_content'] = 'publicRegistration';
        $this->load->view('inc/registration', $data);
    }


    function clientRegistration($vars)
    {
        $data['title'] = "Add User";
        $data['states'] = $this->UserModel->getStates();
        $data['roles'] = $this->RoleModel->getRolesFor("radio");
        $data['brokers'] = $this->UserModel->getBrokers();
        $data['questions'] = $this->UserModel->getQuestions();
        $data['user'] = $this->UserModel->getUserByUserId($vars[0]);
        if ($vars[1]) {
            $data['coupon'] = $this->CampaignModel->getCouponCodeById($vars[1]);
        }
        $data['campaignId'] = $vars[1] ? $vars[1] : 0;
        $data['main_content'] = 'clientRegistration';
        $this->load->view('inc/registration', $data);
    }

    public function addUser()
    {
        try {
            $userId = $this->UserModel->insertUser($status = 0);
            $roleId = $_POST['roleId'];
            $paymentType = $_POST['paymentType'];
            $campaign=0;
            $broker_id = isset($_POST['broker_id'])?$_POST['broker_id']:'';
            if (is_string($_POST['coupon'])) {
                $campaign = $this->CampaignModel->getCampaignIdByCode($_POST['coupon'], $roleId);
            } elseif (is_string($_POST['campaign'])) {
                $campaign = $this->CampaignModel->getCampaignIdByCode($_POST['campaign'], $roleId);
            }
            if (!$campaign) {
                $this->CampaignModel->getCampaignDetailsForBasicRole($roleId);
                $campaign = $this->session->userdata('campaign');
            }
            if ($this->input->post('membershipType')) {
                $membershipTypeId = $this->input->post('membershipType');
            } else {
                $membershipTypeId = '';
            } 
            echo json_encode(array(
                "campaign" => "$campaign",
                "userId" => "$userId",
                "role" => $roleId,
                "membershipTypeId" => $membershipTypeId,
                "paymentType" => $paymentType ? $paymentType : '',
                "message" => null,
                "broker_id" => $broker_id
            ));
            return;
        } catch (Exception $e) {
            echo json_encode($this->handleDatabaseError($e));
            return;
        }
    }

    function checkwebsiteurl($string_url)
    {
        $reg_exp = "@^(http\:\/\/|https\:\/\/)?([a-z0-9][a-z0-9\-]*\.)+[a-z0-9][a-z0-9\-]*$@i";
        if (preg_match($reg_exp, $string_url) == TRUE) {
            return TRUE;
        } else {
            $this->form_validation->set_message('checkwebsiteurl', 'URL is invalid format');
            return FALSE;
        }
    }

    public function emailCheck($str)
    {
        $query = $this->db->query("select email from user where email = '$str'");
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('emailCheck', 'This Email address already used . ');
            return FALSE;
        } else {
            return TRUE;
        }
    }


    function checkDateFormat($date)
    {
        if (preg_match("/[0-9]{2}\/[0-9]{2}\/[0-9]{4}/", $date)) {
            if (checkdate(substr($date, 0, 2), substr($date, 3, 2), substr($date, 6, 4))) {
                $today = date("Y");
                $date1 = date_create(date('m / d / Y'));
                $date2 = date_create($date);
                $diff = date_diff($date2, $date1);
                if ($today < substr($date, 6, 4)) {
                    $this->form_validation->set_message('checkDateFormat', 'Invalid Date');
                    return FALSE;
                } elseif ($diff->y < 21) {
                    $this->form_validation->set_message('checkDateFormat', 'You are below 21 years to be our client');
                    return FALSE;

                } else {
                    return TRUE;
                }
            } else {
                $this->form_validation->set_message('checkDateFormat', 'Invalid Date');
                return false;
            }
        } else {
            $this->form_validation->set_message('checkDateFormat', 'Invalid Date ');
            return false;
        }
    }


    /************************************************ OLD CODE **************************************************/


    public function alpha_space($str)
    {
        if (preg_match("/^([a-z ])+$/i", $str)) {
            return true;
        } else {
            $this->form_validation->set_message('alpha_space', 'The %s field can only contain Alphabetical Characters.');
            return false;
        }
    }

    function validate_phone_number($value)
    {
        $value = trim($value);
        $match = '/^\(?[0-9]{3}\)?[-. ]?[0-9]{3}[-. ]?[0-9]{4}$/';
        $replace = '/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/';
        $return = '($1) $2-$3';
        if (preg_match($match, $value)) {
            return preg_replace($replace, $return, $value);
        } else {
            $this->form_validation->set_message('validate_phone_number', 'Invalid Contact Number.');
            return false;
        }
    }

    function checkSSN($ssn)
    {
        if (preg_match("/[0-9]{3}\-[0-9]{2}\-[0-9]{4}/", $ssn)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('checkSSN', 'Invalid Social Security Number.');
            return FALSE;
        }
    }

    function checkzip($zip)
    {
        if (preg_match("/[0-9]{5}/", $zip)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('checkzip', 'Invalid Zip Code.');
            return FALSE;
        }
    }

    function checkDateFormats($date)
    {
        if (preg_match("/[0-9]{2}\/[0-9]{2}\/[0-9]{4}/", $date)) {
            if (checkdate(substr($date, 0, 2), substr($date, 3, 2), substr($date, 6, 4))) {
                $today = date("Y");
                $date1 = date_create(date('m/d/Y'));
                $date2 = date_create($date);
                $diff = date_diff($date2, $date1);
                if ($today < substr($date, 6, 4)) {
                    $this->form_validation->set_message('checkDateFormat', 'Invalid Date');
                    return FALSE;
                } elseif ($diff->y < 21) {
                    $this->form_validation->set_message('checkDateFormat', 'You are below 21 years to be our client');
                    return FALSE;

                } else {
                    return TRUE;
                }
            } else {
                $this->form_validation->set_message('checkDateFormat', 'Invalid Date');
                return false;
            }
        } else {
            $this->form_validation->set_message('checkDateFormat', 'Invalid Date ');
            return false;
        }
    }


    function generatePassword($length = 8)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $count = mb_strlen($chars);
        for ($i = 0, $result = ''; $i < $length; $i++) {
            $index = rand(0, $count - 1);
            $result .= mb_substr($chars, $index, 1);
        }
        return $result;
    }

    function generateVerificationCode($len = 16)
    {
        $hex = md5("!@#$%^&*" . uniqid("", true));
        $pack = pack('H*', $hex);
        $tmp = base64_encode($pack);
        $uid = preg_replace("#(*UTF8)[^A-Za-z0-9]#", "", $tmp);
        $len = max(4, min(128, $len));
        while (strlen($uid) < $len)
            $uid .= gen_uuid(22);
        return substr($uid, 0, $len);
    }


    public function captcha($str)
    {
        $word = $this->session->userdata('captchaWord');
        if (strcmp(strtoupper($str), strtoupper($word)) == 0) {
            return true;
        } else {
            $this->form_validation->set_message('check_captcha', 'Please enter correct words!');
            return false;
        }
    }
     public function checkUserExistByEmail(){

        try{

          $email = $_POST['email'];
                $old = $this->UserModel->checkEmailId($email);
                if ($old) {
                      echo json_encode($this->fieldMessage("email", "This email address is already registered."));
                } 

           } catch (Exception $e) {
            echo json_encode($this->handleDatabaseError($e));
            return;
        }

    }


    public function checkEmailExists()
    {
        $email = $_POST['email'];
        $old = $this->UserModel->checkEmailId($email);
        if (!$old) {
            redirect('register/signUpNew');
        } else {
            redirect('register/signup/old');
        }
    }


    function checkMembership()
    {
        try {
            if ($this->UserModel->getUserByEmail($_POST['email'])) {
                if ($this->MembershipModel->checkMembership($_POST['email']) > 0) {
                    echo json_encode($this->fieldMessage("email", "This email address cannot be registered at this time."));
                } else {

                    $this->addUser();
                }
            }
            return;
        } catch (Exception $e) {
            echo json_encode($this->handleDatabaseError($e));
            return;
        }
    }

    function checkMembershipExist()
    {
        try {
            if ($this->MembershipModel->checkMembership($_POST['email']) > 0) {
                echo json_encode($this->fieldMessage("email", "This email address cannot be registered at this time."));
            }
            elseif($this->UserModel->checkEmailRegistered($_POST['email'])== false){
                echo json_encode($this->fieldMessage("email", "This email address doesn't exist."));
            }
            return;
        } catch (Exception $e) {
            echo json_encode($this->handleDatabaseError($e));
            return;
        }
    }

    function verifyRecaptcha()
    {
        $captcha = filter_input(INPUT_POST, 'captchaResponse'); // get the captchaResponse parameter sent from our ajax

        /* Check if captcha is filled */
        if (!$captcha) {
            http_response_code(401); // Return error code if there is no captcha
        }
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfbIw4TAAAAAJ3IeQlrEGt15z_SyYEfYgiWI6pM&response=" . $captcha);
        if ($response . success == false) {
            echo 'SPAM';
            http_response_code(401); // It's SPAM! RETURN SOME KIND OF ERROR
        } else {
            // Everything is ok and you can proceed by executing your login, signup, update etc scripts
        }
    }

    function checkCouponRole()
    {
        $roleId = $_POST['roleId'];
        if ($_POST['clientCoupon']) {
            $coupon = $_POST['clientCoupon'];
            $return = 'clientCoupon';
        } elseif ($_POST['ownerCoupon']) {
            $coupon = $_POST['ownerCoupon'];
            $return = 'ownerCoupon';
        } elseif ($_POST['brokerCoupon']) {
            $coupon = $_POST['brokerCoupon'];
            $return = 'brokerCoupon';
        } else {
            $coupon = $_POST['coupon'];
            $return = 'coupon';
        }
        try {
            $discountPercentage = $this->CampaignModel->checkCouponRoleMatch($roleId, $coupon);
            if ($coupon == '') {
                echo json_encode(array($return => "Empty"));
            } elseif ($discountPercentage == '') {
                echo json_encode($this->fieldMessage($return, "Invalid Coupon Code"));
            } else {
                echo json_encode($discountPercentage == 100 ? false : true);
            }
            return;
        } catch (Exception $e) {
            echo json_encode($this->handleDatabaseError($e));
            return;
        }
    }

    function checkCouponGetRole()
    {
        $coupon = $_POST['coupon'];
        $return = 'coupon';
        try {
            $campaignInfo = $this->CampaignModel->getCampaignInfoByCode($coupon);
            if ($campaignInfo == '') {
                echo json_encode($this->fieldMessage($return, "Invalid Coupon Code"));
            } else {
                echo json_encode($campaignInfo);
            }
            return;
        } catch (Exception $e) {
            echo json_encode($this->handleDatabaseError($e));
            return;
        }
    }


}
