<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Affiliate extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('general');
        checkAdminAuth();
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="red">', '</div>');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('path');
        $this->load->model('AuthModel');
        $this->load->model('EmailerModel');

        $this->load->model('EmailModel');
        $this->load->model('AffiliateModel');
        $this->allowed = $this->AuthModel->getRoleAuth();
        $this->load->model('RecurringModel');
    }


    function _remap($method, $parameter)
    {
        if (method_exists($this, $method)) {
            $this->$method($parameter);
        } else {
            $this->index($method, $parameter);
        }
    }

    public function index($aid)
    {
        $admininfo = $this->UserModel->getAdminPaypalInfo();
        $admininfo->referrer_reg_charge;
        $currencyCodeType = "USD";
        $paymentType = "Sale";
        $paymentAmount = "7";
        $returnURL = base_url() . 'administrator/affiliate/order_confirm';
        $cancelURL = base_url() . 'administrator/home';
        $resArray = $this->RecurringModel->CallShortcutExpressCheckout($paymentAmount, $currencyCodeType, $paymentType, $returnURL, $cancelURL);
        $ack = strtoupper($resArray["ACK"]);
        if ($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING") {
            $this->RecurringModel->RedirectToPayPal($resArray["TOKEN"]);
        }
    }

    function order_confirm()
    {
        if ($_GET['token'] && $_GET['PayerID']) {
            echo $token = $_GET['token'];
            echo $pid = $_GET['PayerID'];
            $resArray = $this->RecurringModel->CreateRecurringPaymentsProfile();
            $ack = strtoupper($resArray["ACK"]);
            if ($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING") {
                $data['main_content'] = ADMIN_PATH . 'reucrring_success';
                $this->load->view(ADMIN_PATH . 'incs/template', $data);
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
    }

    function add()
    {
        if (in_array('referrer_view', $this->allowed)) {
            $data['states'] = $this->AffiliateModel->getStates();
            $data['title'] = "New referrer Registration";
            $data['main_content'] = ADMIN_PATH . 'referrer_add_view';
            $this->load->view(ADMIN_PATH . 'incs/template', $data);
        } else {
            redirect(ADMIN_PATH . 'admin');
        }
    }

    function addAction()
    {
        if (in_array('referrer_view', $this->allowed)) {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->helper('security');
            $this->load->database();
            $this->form_validation->set_rules('uname', 'Username', 'required|callback_username_check');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|max_length[12]');
            $this->form_validation->set_rules('cpassword', 'Password Confirmation', 'required|min_length[5]|max_length[12]|matches[password]');
            $this->form_validation->set_rules('fname', 'First Name', 'required|callback_alpha_space');
            $this->form_validation->set_rules('lname', 'Last Name', 'required|callback_alpha_space');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
            $this->form_validation->set_rules('bname', 'Business Name');
            $this->form_validation->set_rules('pcon', 'Primary Contact', 'required|callback_validate_phone_number');
            $this->form_validation->set_rules('scon', 'Secondary Contact');
            $this->form_validation->set_rules('gender', 'Gender');
            $this->form_validation->set_rules('state', 'State');
            $this->form_validation->set_rules('city', 'City ', 'callback_alpha_space');
            $this->form_validation->set_rules('zip', 'Zip', 'callback_checkzip');
            $this->form_validation->set_rules('address', 'Address ');
            $this->form_validation->set_rules('dob', 'Date of Birth', 'callback_checkDateFormat');
            if ($this->form_validation->run() == FALSE) {
                $this->add();
            } else {
                $username = $this->input->post('uname');
                $password = $this->input->post('password');
                $this->AffiliateModel->insertDetail($username, $password);
                $email = $this->input->post('email');
                $this->EmailerModel->Signupreferrer($username, $email);
                $this->session->set_flashdata("success_msg_affiliate", "Successfully Created New referrer.");
                redirect(ADMIN_PATH . 'affiliate/details');
            }
        } else {
            redirect(ADMIN_PATH);
        }
    }

    public function alpha_space($str)
    {
        if (!empty($str)) {
            if (preg_match("/^([a-z ])+$/i", $str)) {
                return true;
            } else {
                $this->form_validation->set_message('alpha_space', 'The %s field can only contain Alphabetical Characters.');
                return false;
            }
        } else {
            return TRUE;
        }
    }

    public function email_check($str)
    {
        $query = $this->db->query("SELECT user_id FROM user WHERE email = '$str'");
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('email_check', 'This email address already used.');
            return FALSE;
        } else {
            return TRUE;
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
        if (!empty($zip)) {

            if (preg_match("/[0-9]{5}/", $zip)) {
                return TRUE;
            } else {
                $this->form_validation->set_message('checkzip', 'Invalid Zip Code.');
                return FALSE;

            }
        } else {
            return TRUE;
        }
    }

    function checkDateFormat($date)
    {
        if (!empty($date)) {
            if (preg_match("/[0-9]{2}\/[0-9]{2}\/[0-9]{4}/", $date)) {
                if (checkdate(substr($date, 0, 2), substr($date, 3, 2), substr($date, 6, 4))) {
                    return true;
                } else {
                    $this->form_validation->set_message('checkDateFormat', 'Invalid Date');
                    return false;
                }
            }
        } else {
            return TRUE;
        }
    }


    public function username_check($str)
    {
        $query = $this->db->query("SELECT user_id FROM user WHERE login_name = '$str'");
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('username_check', 'This username already used.');
            return FALSE;
        } else {
            return TRUE;
        }
    }


    function details()
    {
        $config['base_url'] = site_url(ADMIN_PATH . "affiliate/details/");
        $config['per_page'] = '10';
        $config['uri_segment'] = '4';
        $this->pagination->initialize($config);
        if ($this->session->userdata(ADMIN_AUTH_TYPE) == "admin" || $this->session->userdata(ADMIN_AUTH_TYPE) == "super-admin") {
            $config['total_rows'] = $this->AffiliateModel->countAll();
            $affiliateList = $this->AffiliateModel->getAll();
            $data['affiliateList'] = $affiliateList;
            $data['title'] = "referrers";
            $data['main_content'] = ADMIN_PATH . "affiliate_view";
            $this->load->view(ADMIN_PATH . 'incs/template', $data);
        } elseif ($this->session->userdata(ADMIN_AUTH_TYPE) == "affiliate" || $this->session->userdata(ADMIN_AUTH_TYPE) == "referrer") {
            array('0' => $this->session->userdata(USER_ID));
            redirect('administrator/affiliate/view/' . $this->session->userdata(USER_ID));
        } elseif ($this->session->userdata(ADMIN_AUTH_TYPE) == "client") {
            redirect('administrator/affiliate/view/' . $this->ClientModel->getaffiliateuser($this->session->userdata(USER_ID)));
        }
    }

    function view($id)
    {
        $id = $id[0];
        $data['affiliate'] = $this->AffiliateModel->getSingleUsers($id);
        $data['employment'] = $this->AffiliateModel->getemployment($id);
        $data['title'] = "View Broker";
        $data['main_content'] = ADMIN_PATH . "affiliateview_view";
        $this->load->view(ADMIN_PATH . 'incs/template', $data);
    }


    function deleteAction($affiliate_id)
    {
        $affiliate_id = $affiliate_id[0];
        $this->AffiliateModel->deleteRef($affiliate_id);
        $this->session->set_flashdata("su_message", "referrer Deleted Successfully.");
        redirect(ADMIN_PATH . "affiliate/details");
    }

    function post()
    {
        $id = $_REQUEST['pk'];
        $value = $_REQUEST['value'];
        $name = $_REQUEST['name'];
        if (empty($type)) {
            $this->AffiliateModel->updateInline($name, $value, $id);
        }
    }

    function postdetail()
    {
        $id = $_REQUEST['pk'];
        $value = $_REQUEST['value'];
        $name = $_REQUEST['name'];
        $this->AffiliateModel->updateInline($name, $value, $id, 'detail');
    }

    function postemp()
    {
        $_REQUEST['pk'];
        $value = $_REQUEST['value'];
        $name = $_REQUEST['name'];
        $array = explode("_", $name);
        $name = $array[0];
        $emp_id = $array[1];
        $this->AffiliateModel->updateEmpInline($name, $value, $emp_id);
    }

    function insertemp($type)
    {
        $type = $type[0];
        $emp = $this->AffiliateModel->insertemp($type);
        $sr = $this->input->post('number');
        $html = '';
        $html .= '<div class="row-fluid" style="background-color: #f5f5f5; border-top: 1px solid #e5e5e5; border-radius: 10px;">';
        $html .= '<div class="forclientlabels .employment">';
        $html .= '<div class="span4">';
        $html .= $sr . '. Designation: <a href="#" class="editemp editable editable-click" id="designation">' . $emp->designation . '</a>';
        $html .= '</div><div class="span4">Company: <a href="#" class="editemp editable editable-click" id="company">' . $emp->company . '</a></div><div class="span4">';
        $html .= 'Experience: <a href="#" class="editemp editable editable-click" id="experience">' . $emp->experience . '</a>';
        $html .= '<input type="hidden" id="emp_id" name="emp_id" value="' . $emp->user_id . '"/></div></div></div>';
        echo $html;
    }

    function deleteEmp($emp)
    {
        $emp = $emp[0];
        if ($this->AffiliateModel->deleteEmp($emp)) {
            return TRUE;
        }
        return FALSE;
    }

    function emails()
    {
        if (in_array('referrer_view', $this->allowed)) {
            $user_id = $this->session->userdata(USER_ID);
            $user_type = $this->session->userdata(ADMIN_AUTH_TYPE);
            if ($user_type == 'affiliate' || $user_type == 'referrer') {
                $data['title1'] = 'Send Emails to admin or clients';
                $data['clients'] = $this->EmailModel->getallclients($user_id);
                $data['type'] = 'referrer';
            } elseif ($user_type == 'admin' || $user_type == 'super-admin') {
                $data['clients'] = '';
                $data['title1'] = 'Send Emails to affiliate';
                $data['type'] = 'admin';
            }
            $data['title'] = 'Email History';
            $data['title2'] = 'Email Received History';
            $data['title3'] = 'Email sent History';
            $data['receivedemails'] = $this->EmailModel->received_emails($user_id);
            $data['sentemails'] = $this->EmailModel->sent_emails($user_id);
            $data['main_content'] = ADMIN_PATH . "referreremails_view";
            $this->load->view(ADMIN_PATH . 'incs/template', $data);
        } else {
            redirect(ADMIN_PATH . 'home');
        }
    }

    function sendEmails()
    {
        $flag = FALSE;
        if (in_array('referrer_view', $this->allowed)) {
            if ($this->input->post('user_type') == 'super-admin') {
                $superadmin = $this->EmailModel->getSuperAdmin();
                $superemail = '';
                $superid = '';
                $total = sizeof($superadmin);
                if (!empty($superadmin)) {
                    $i = 1;
                    foreach ($superadmin as $key => $value) {
                        if (empty($superemail)) {
                            $superemail = $value->email;
                            $superid = $value->user_id;
                        } elseif (empty($superemail) && $total != $i) {
                            $superemail .= $value->email . ',';
                            $superid .= $value->user_id . ',';
                        } elseif ($superemail != '' && $total == $i) {
                            $superemail .= $value->email;
                            $superid .= $value->user_id;
                        } else {
                            $superemail .= $value->email . ',';
                            $superid .= $value->user_id . ',';
                        }
                        $i++;
                    }
                }
                foreach ($superadmin as $key => $value) {
                    $email = $value->email;
                    $this->EmailerModel->sendEmailsToAdminFromreferrer($email);
                    if ($flag) {
                        if ($this->EmailModel->insertEmails('super-admin', 'Success', $superid)) {
                            $flag = TRUE;
                        } else {
                            $flag = FALSE;
                        }
                    }
                    if ($flag) {
                        $this->session->set_flashdata("su_message", "Email Sent to Admin Successful.");
                        redirect(ADMIN_PATH . "affiliate/emails");
                    }
                }
            } elseif ($this->input->post('user_type') == 'client') {
                $emailsto = $this->input->post('toemails');
                $emailto = implode(',', $emailsto);
                $receiver = implode(',', $this->EmailModel->getIds($emailto));
                foreach ($emailsto as $key => $value) {
                    $this->EmailerModel->sendEmailsToAdminWithUserTypeClient($value);
                }
                if ($flag) {
                    if ($this->EmailModel->insertEmails('client', 'Success', $receiver)) {
                        $flag = TRUE;
                    } else {
                        $flag = FALSE;
                    }
                }
                if ($flag) {
                    $this->session->set_flashdata("su_message", "Email Sent to Admin Successful.");
                    redirect(ADMIN_PATH . "affiliate/emails");
                }
            } elseif ($this->input->post('user_type') == 'referrer' || $this->input->post('user_type') == 'affiliate') {
                $emailsto = $this->input->post('toemails');
                $emailto = implode(', ', $emailsto);
                $receiver = implode(', ', $this->EmailModel->getIds($emailto));
                foreach ($emailsto as $key => $value) {
                    $this->EmailerModel->sendEmailsToreferrer($value);
                    if ($flag) {
                        if ($this->EmailModel->insertEmails('referrer', 'Success', $receiver)) {
                            $flag = TRUE;
                        } else {
                            $flag = FALSE;
                        }
                    }
                    if ($flag) {
                        $this->session->set_flashdata("su_message", "Email Sent to referrers Successful.");
                        redirect(ADMIN_PATH . "affiliate/emails");
                    }
                }
            }
        } else {
            redirect(ADMIN_PATH . 'admin');
        }
    }

    function emailsreceiverdelete($email_id)
    {
        $email_id = $email_id[0];
        if (in_array('referrer_view', $this->allowed)) {
            if ($this->EmailModel->deleteEmails($email_id)) {
                $this->session->set_flashdata("su_message1", "Email Receivers History Deleted Successfully.");
            } else {
                $this->session->set_flashdata("su_message1", "Some error occured while deleting Email Receivers History.");
            }
        } else {
            $this->session->set_flashdata("su_message", "You Have No Permission To Delete This Record");
        }
        redirect(ADMIN_PATH . "affiliate/emails");
    }

    function emailssenderdelete($email_id)
    {
        $email_id = $email_id[0];
        if (in_array('referrer_view', $this->allowed)) {
            if ($this->EmailModel->deleteEmails($email_id)) {
                $this->session->set_flashdata("su_message2", "Email Senders History Deleted Successfully.");
            } else {
                $this->session->set_flashdata("su_message2", "Some error occured while deleting Email Senders History.");
            }
        } else {
            $this->session->set_flashdata("su_message", "You Have No Permission To Delete This Record");
        }
        redirect(ADMIN_PATH . "affiliate/emails");
    }

    function remove_checked_received_emails()
    {
        if (in_array('referrer_view', $this->allowed)) {
            $this->form_validation->set_rules('msg[]', 'Private Message', 'required|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata("su_message1", "Select anyone of the items.");
                redirect(ADMIN_PATH . "affiliate/emails");
            } else //success
            {
                foreach ($_POST['msg'] as $email_id) {
                    if ($this->EmailModel->deleteEmails($email_id)) {
                        $this->session->set_flashdata("su_message1", "Email Receivers History Deleted Successfully.");
                    } else {
                        $this->session->set_flashdata("su_message1", "<font color=\"#FF0000\">The Selected Email Receivers History Can't Be Deleted.</font>");
                    }
                }
            }
        } else {
            $this->session->set_flashdata("su_message1", "You Have No Permission To Delete Email Receivers History");
        }

        redirect(ADMIN_PATH . "affiliate/emails");
    }

    function remove_checked_sender_emails()
    {
        if (in_array('referrer_view', $this->allowed)) {
            $this->form_validation->set_rules('msg[]', 'Private Message', 'required|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata("su_message2", "Select anyone of the items.");
                redirect(ADMIN_PATH . "affiliate/emails");
            } else //success
            {
                foreach ($_POST['msg'] as $email_id) {
                    if ($this->EmailModel->deleteEmails($email_id)) {
                        $this->session->set_flashdata("su_message2", "Email Senders History Deleted Successfully.");
                    } else {
                        $this->session->set_flashdata("su_message2", "<font color=\"#FF0000\">The Selected Email Senders History Can't Be Deleted.</font>");
                    }
                }
            }
        } else {
            $this->session->set_flashdata("su_message2", "You Have No Permission To Delete Email Senders History");
        }

        redirect(ADMIN_PATH . "affiliate/emails");
    }
}
