<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends AdminController
{
    private $allowed = array();

    public function __construct()
    {
        parent::__construct(CLIENT, OWNER, BROKER, ADMIN);
        $this->load->helper('general');
        $this->load->helper('url');
        checkAdminAuth();
        $this->load->library('pagination');
        $this->load->model('AuthModel');
        $this->load->helper('security');
        $this->load->model('RoleModel');
        $this->load->model('MembershipModel');
        $this->load->model('CampaignModel');
        $this->load->model('CardTypeModel');
        $this->load->model('EmailerModel');
        $this->load->model('EmailModel');
        $this->load->model('ProspectModel');
        $this->load->model('UserModel');
        $this->load->model('LineModel');
        $this->load->helper(array('form', 'url', 'captcha'));

    }

    public function index()
    {
        if ($this->roleName == ADMIN) {
            $data['users'] = $this->UserModel->getUsers();
        } else {
            $data['users'] = $this->UserModel->getBrokerUsers($this->session->userdata(BROKER_ID) ? $this->session->userdata(BROKER_ID) : $this->session->userdata(USER_ID));
        }

        $data['main_content'] = ADMIN_PATH . "users";
        $data['brokers'] = $this->UserModel->getBrokersEditable();
        $data['roles'] = $this->getRoles();
        foreach ((array)$data['users'] as $user) {
            $data = $this->addRolesToUser($user->id, $data);
        }
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    public function systemUsers()
    {
        if ($this->roleName == ADMIN) {
            $data['users'] = $this->UserModel->getUsers();
        } else {
            $data['users'] = $this->UserModel->getBrokerUsers($this->session->userdata(BROKER_ID) ? $this->session->userdata(BROKER_ID) : $this->session->userdata(USER_ID), 1);
        }
        $data['userType'] = 1;
        $data['main_content'] = ADMIN_PATH . "users";
        $data['brokers'] = $this->UserModel->getBrokersEditable();

        $data['roles'] = $this->getRoles();
        foreach ((array)$data['users'] as $user) {
            $data = $this->addRolesToUser($user->id, $data);
        }
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function getRoles()
    {
        $roleMembershipPrivilege = $this->MembershipModel->getMembershipRolesByUserId($this->session->userdata(USER_ID));
        $nonPublicRoles = $this->RoleModel->getNonPublicRolesByUserId($this->session->userdata(USER_ID));
        if (!empty($roleMembershipPrivilege) && !empty($nonPublicRoles)) {
            $roleResult = array_merge((array)$roleMembershipPrivilege, (array)$nonPublicRoles);
        } else {
            $roleResult = $roleMembershipPrivilege;
        }

        if ($roleResult) {
            $roles = array();
            foreach ($roleResult as $role) {
                $roles[] = '{' . 'value: ' . $role->id . ',' . ' text: ' . '\'' . $role->label . '\'' . '}';
            }
            return str_replace("\"", "", json_encode($roles));
        }
    }

    public function addRolesToUser($user_id, $data)
    {
        $a = array('[', '{', ']', '}', '"', 'role_id', ':', 'user_id');
        $b = array('', '', '', '', '', '', '');
        $data['user_roles'][$user_id] = str_replace($a, $b, json_encode($this->RoleModel->getUserIdRoleIdAssociative($user_id)));
        return $data;

        $this->session->set_flashdata('redirectToCurrent', current_url());
        $data['user'] = $this->UserModel->getUser($user_id);
        $data['employ'] = $this->UserModel->getEmployement($user_id);
        $data['roles'] = $this->getRoles();
        $data['brokers'] = $this->UserModel->getBrokersEditable();
        $data['title'] = "Update User";
        $data['offset'] = $user_id;
        $data['role'] = $this->roleName;
        $data = $this->addRolesToUser($user_id, $data);
        $data['main_content'] = ADMIN_PATH . "user";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);

    }


    public function brokers()
    {
        $data['brokers'] = $this->UserModel->getBrokerBroker();
        $data['main_content'] = ADMIN_PATH . "brokers";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function deleteUser($user_id)
    {
        try {
            $this->UserModel->deleteUser($user_id);
        } catch (Exception $e) {
            echo json_encode($this->handleDatabaseError($e));
            return;
        }
       // redirect(ADMIN_PATH . "user/index", 'location');
    }

    function deleteSystemUser($user_id)
    {
        try {
            $this->UserModel->deleteSystemUser($user_id);
        } catch (Exception $e) {
            echo json_encode($this->handleDatabaseError($e));
            return;
        }
        redirect(ADMIN_PATH . "user/systemUsers", 'refresh');
    }

    function checkBeforeDelete($user_id)
    {
        if ($user_id == $this->session->userdata(USER_ID)) {
            return FALSE;
        }
        return TRUE;
    }

    public function addUser()
    {
        try {
            $this->UserModel->insertUser();
//            $this->sendRegistrationMail();
        } catch (Exception $e) {
            echo json_encode($this->handleDatabaseError($e));
            return;
        }
        redirect(base_url() . 'administrator/user');
    }

    public function addProspect()
    {
        try {
            $this->ProspectModel->insertProspect();
            $this->sendRegistrationMail();
        } catch (Exception $e) {
            echo json_encode($this->handleDatabaseError($e));
        }
        redirect(base_url() . 'administrator/user');
    }

    function sendRegistrationMail()
    {
        $this->load->library('parser');
        $register = $this->input->post('email');
        $user_details = $this->UserModel->getUserByEmail($register);
        $role_details = $this->RoleModel->getRoleWithEmail($register);
        $register_role = $role_details->label;
        $register_name = $user_details->first_name . ' ' . $user_details->middle_initial . ' ' . $user_details->last_name;
        $broker_id = $this->input->post('brokerId[]');
        $subject = 'Welcome to The Credit University';
        $user = $this->UserModel->getUserByUserId($broker_id);
        $broker = $user->first_name . ' ' . $user->middle_initial . ' ' . $user->last_name;
        $this->load->library('SimpleEmailService');
        $ses = new SimpleEmailService('AKIAISEC5PBG2F54VL4A', 'ZhRYSpKdUMLRrxPwy878UN+pJmnllAocdcYRpJwZ');
        $ses->enableVerifyPeer(false);
        $simpleEmailServiceMessage = new SimpleEmailServiceMessage();

        if (!empty($user->email)) {
            $simpleEmailServiceMessage->addTo($user->email);
            $simpleEmailServiceMessage->setFrom('The Credit University' . '<' . EMAILSENDER . '>');
            $simpleEmailServiceMessage->setSubject($subject);
            $today = date('Y-m-d');
            $data1 = array(
                'subject' => 'Registered to The Credit University',
                'date' => $today,
                'registered' => $register,
                'register_name' => $register_name,
                'role' => $register_role,
                'under_registered' => $broker

            );

            $code = $this->parser->parse('administrator/registration_brokerTemplate', $data1);


            $simpleEmailServiceMessage->setMessageFromString('', $code);
            $sent = $ses->sendEmail($simpleEmailServiceMessage);

        }

        $simpleEmailServiceMessage->addTo($register);
        $simpleEmailServiceMessage->setFrom('The Credit University' . '<' . EMAILSENDER . '>');
        $simpleEmailServiceMessage->setSubject($subject);
        $today = date('Y-m-d');
        $data = array(
            'subject' => 'Registered to the The Credit University',
            'register_name' => $register_name,
            'date' => $today,
            'registered' => $register,
            'role' => $register_role,
            'under_registered' => $broker

        );
        $code = $this->parser->parse('administrator/registration_template', $data);
        $simpleEmailServiceMessage->setMessageFromString('', $code);
        $sent = $ses->sendEmail($simpleEmailServiceMessage);
        return $sent;

    }


    function sendEmails()
    {
        $user_id = $this->session->userdata(USER_ID);
        $user_role_details = $this->RoleModel->getRolesByUserId($user_id);
        $email_sender_type = $user_role_details->value;
        $user_details = $this->UserModel->getUser($user_id);
        $email_sender = $user_details->first_name . ' ' . $user_details->middle_initial . ' ' . $user_details->last_name;
        $subject = $this->input->post('subject');
        $to_emails = $this->input->post('toemails[]');
        $msg = $this->input->post('msg');
        $name = $this->UserModel->getNameFromEmail($to_emails);
        $role_name = $this->UserModel->getRoleFromEmail($to_emails);
        $user_ids = $this->UserModel->getUserIdFromEmail($to_emails);
        $this->load->library('SimpleEmailService');
        $ses = new SimpleEmailService('AKIAISEC5PBG2F54VL4A', 'ZhRYSpKdUMLRrxPwy878UN+pJmnllAocdcYRpJwZ');
        $ses->enableVerifyPeer(false);
        $m = new SimpleEmailServiceMessage();
        $m->addTo($to_emails);
        $m->setFrom($email_sender . '<' . EMAILSENDER . '>');
        $m->setSubject($subject);
        $msg = '<html>
									<head>
									<meta charset="utf-8">
									<title>Email Template</title>
									</head>
								<body>
									<div class="box" style="padding:0px;width:40%; margin:0 auto;-webkit-border-radius: 5px;
									-moz-border-radius: 5px;
									border-radius: 5px; border:1px solid #ccc;">
									<div class="title" style="-webkit-border-top-left-radius: 5px;
								-webkit-border-top-right-radius: 5px;
								-moz-border-radius-topleft: 5px;
								-moz-border-radius-topright: 5px;
						border-top-left-radius: 5px;
								border-top-right-radius: 5px; background:#ccc; color:#fff;">
								<h3 style="padding:10px; margin:0px; color:#ac6f00;"><img src="' . base_url() . 'frontend/images/logo.png" height="35px" style="vertical-align:middle;margin-right:15px;">The Credit University</h3>
								</div>
								<div class="content" style="padding:10px; font-size:14px;"><p style="font-size:13px;">';
        $msg .= 'Dear User,<br/>';
        $msg .= $this->input->post('msg');
        $msg .= '<br/><br/>';
        $msg .= 'Yours Sincerely,<br/>';
        $msg .= $email_sender;
        $msg .= 'Americancpn <br/>';

        // footer part of email template
        $msg .= '</p></div>
								<div class="footer" style="-webkit-border-bottom-right-radius: 5px;
								-webkit-border-bottom-left-radius: 5px;
							-moz-border-radius-bottomright: 5px;
							-moz-border-radius-bottomleft: 5px;
							border-bottom-right-radius: 5px;
							border-bottom-left-radius: 5px;background:#ccc; color:#ac6f00; margin:0px; padding:1px 10px;">
							<p>Yours Sincerely,<br>
							The Credit University Team</p>
							</div>
							</div>
							</body>
						</html>';
        $message = $msg;
        $m->setMessageFromString('', $message);
        if ($ses->sendEmail($m)) {
            $this->EmailModel->insertEmails('Success', $email_sender, $email_sender_type, $name, $role_name, $user_ids);
            redirect(ADMIN_PATH . "user/mailbox");
        } else {

            redirect(ADMIN_PATH . "user/compose");

        }
    }

    public
    function check_captcha($str)
    {
        $word = $this->session->userdata('captchaWord');
        if (strcmp(strtoupper($str), strtoupper($word)) == 0) {
            return true;
        } else {
            $this->form_validation->set_message('check_captcha', 'please enter correct captcha');
            return false;
        }
    }

    function checkBrokerEmailId($brokeremailid, $tablename)
    {
        $this->brokerUserId = '';
        $query = $this->db->query("SELECT ur.user_id, ur.role_id FROM user_role ur LEFT JOIN user u ON ur.user_id = u.id LEFT JOIN role r ON r.id = ur.role_id WHERE u.email = '$brokeremailid' AND r.value ='broker'");
        if ($query->num_rows() > 0) {
            $this->brokerUserId = $query->row()->user_id;
            $this->table_name = $tablename;
            return True;

        } else {
            $this->form_validation->set_message('checkBrokerEmailId', 'This Broker Doesn\'t Exist');
            return FALSE;
        }
    }

    function get_brokers()
    {
        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            $this->UserModel->get_brokersEmail($q);
        }
    }

    function update_profilePic($user_id)

    {
        if ($_FILES['profile_image']['name']) {
            $uploaded_image = $this->upload('profile_image', "uploads/profile/");
            if ($uploaded_image == "") {
                $this->session->set_flashdata('message', json_encode(strip_tags($this->upload->display_errors())));
            } else {
                $image = $uploaded_image['file_name'];

                $oldProfilePictureName = $this->UserModel->updateProfile($image, $user_id);
                try {
                    unlink('uploads/profile/' . $oldProfilePictureName);
                } catch (Exception $e) {
                }
            }
        }

        redirect(ADMIN_PATH . "user/user/" . $user_id);

    }

    function add()
    {
        if (in_array('user_add', $this->allowed)) {
            if ($this->form_validation->run('user_add') == FALSE) {
                $this->userForm();
            } else {
                $this->UserModel->insert();
                $this->session->set_flashdata("su_message", "User Added Successfully.");
                redirect(ADMIN_PATH . "user/index");
            }

        } else {
            redirect("admin");
        }
    }

    function userForm()
    {
        $data['questions'] = $this->UserModel->getQuestions();
        $data['roles'] = $this->RoleModel->getRolesFor("radio");
        $data['brokers'] = $this->UserModel->getBrokers(SELECT);
        $data['memberships'] = $this->MembershipModel->getMembershipTypes(SELECT);
        $data['main_content'] = ADMIN_PATH . "userForm";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function creditStatus($userId)
    {
        $data['title'] = 'Credit Status';
        $data['creditstatus'] = $this->UserModel->getCreditStatus($userId);
        $data['company'] = $this->UserModel->getCompanyEditable();
        $data['main_content'] = ADMIN_PATH . "creditStatus";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function creditStatusForm()
    {
        $data['title'] = 'Add Credit Status';
        $data['company'] = $this->UserModel->getCompanyAssociative();
        $data['userId'] = $this->session->userdata(USER_ID);
        $data['main_content'] = ADMIN_PATH . "creditStatusForm";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function addCreditStatus()
    {
        try {
            $this->UserModel->insertCreditStatus();
        } catch (Exception $e) {
            echo json_encode($this->handleDatabaseError($e));
            return;
        }

        redirect(ADMIN_PATH . 'user/creditStatus/' . $this->session->userdata(USER_ID));

    }

    function deleteCreditStatus()
    {
        try {
            $this->UserModel->deleteCreditStatus();
        } catch (Exception $e) {
            echo json_encode($this->handleDatabaseError($e));
            return;
        }
        redirect(base_url() . "administrator/user/creditStatus/" . $this->input->post('user_id'));
    }

    public function addCompany()
    {
        try {
            $data['data'] = $this->UserModel->insertCompany();
        } catch (Exception $e) {
            echo json_encode($this->handleDatabaseError($e));
            return; /*todo convert frontend submit into ajax post and handle the error via bootstrap validation*/
        }
        redirect(base_url() . "administrator/cardType/cardTypes");
    }

    function getCompany()
    {
        echo json_encode($this->UserModel->getCompanyAssociative());
    }

    function getCompanyName()
    {
        echo json_encode($this->UserModel->getCompanyNameAssociative($this->input->get('bank')));
    }


    function deleteNote()
    {
        try {
            $this->UserModel->deleteNote($this->input->post('id'));
        } catch (Exception $e) {
            echo json_encode($this->handleDatabaseError($e));
            return;
        }
        redirect(base_url() . "administrator/user/user/" . $this->input->post('userId'));
    }

    function update($offset)
    {
        if (in_array('user_update', $this->allowed)) {
            if ($this->form_validation->run('user_edit') == FALSE) {
                $this->user($this->input->post('user_id'), $offset);
            } else {
                $this->UserModel->update($this->input->post('user_id'));
                $this->session->set_flashdata("su_message", "User Updated Successfully.");
                redirect(ADMIN_PATH . "user/show/$offset");
            }
        } else {
            $this->session->set_flashdata("su_message", "You Have No Previleage To Update User");
            redirect(ADMIN_PATH . "user/show/$offset");
        }
    }

    function user($userId, $type = '')
    {
        if ($type)
            $data['protype'] = $type;

        $this->session->set_flashdata('redirectToCurrent', current_url());
        $data['user'] = $this->UserModel->getUser($userId);
        $data['employ'] = $this->UserModel->getEmployement($userId);
        $data['application'] = $this->UserModel->getCreditApplication($userId);
        $data['roles'] = $this->getRoles();
        $data['clientMembership'] = $this->MembershipModel->getMembership($userId, CLIENT, SELECTXKEYS);
        $data['userMembership'] = $this->MembershipModel->getMembershipLevelById($userId);
        $data['ownerMembership'] = $this->MembershipModel->getMembership($userId, OWNER, SELECTXKEYS);
        $data['brokerMembership'] = $this->MembershipModel->getMembership($userId, BROKER, SELECTXKEYS);
        $data['clientMemberships'] = $this->MembershipModel->getMembershipTypes(CLIENT, SELECTX);
        $data['ownerMemberships'] = $this->MembershipModel->getMembershipTypes(OWNER, SELECTX);
        $data['brokerMemberships'] = $this->MembershipModel->getMembershipTypes(BROKER, SELECTX);
        $data['userCoupons'] = $this->CampaignModel->getUserCampaigns($userId, SELECTXKEYS);
        $data['coupons'] = $this->CampaignModel->getCampaigns(SELECTX);
//        $coupons = $data['coupons'];
        $data['coupons_details'] = $this->CampaignModel->getCouponsDetails($userId);
        $data['brokers'] = $this->UserModel->getBrokersEditable();
        $data['questions'] = $this->UserModel->getQuestionsEditable();
        $data['state'] = $this->UserModel->getStatesEditable();
        $data['business'] = $this->UserModel->getBusiness($userId);
        $data['title'] = "Update User";
        $data['offset'] = $userId;
        $data['role'] = $this->roleName;
        $data['notes'] = $this->UserModel->getUserNotes($userId);
        $data['verified'] = $this->LineModel->getLineBalance($userId, true);
        $data['unverified'] = $this->LineModel->getLineBalance($userId, false);
        $data['userRoles'] = $this->RoleModel->getUserRolesByUserId($userId);
        $data = $this->addRolesToUser($userId, $data);
        $data['other_roles'] = $this->RoleModel->getRolesWithMembership($this->uri->segment(4));
        $data['admin_roles'] = $this->RoleModel->getAdminRoles($this->uri->segment(4));
        $data['roles'] = array_merge($data['other_roles'], $data['admin_roles']);
        $data['member_since'] = $this->UserModel->getUserCreatedDate($this->uri->segment(4));

        $brokerId = null;
        if ($this->roleName = "broker") {
            $brokerId = $this->uri->segment(4);
        }

        $data['total_clients'] = count($this->UserModel->getBrokerUsersWithRoles($brokerId, $role_name = 'client'));
        $data['total_owners'] = count($this->UserModel->getBrokerUsersWithRoles($brokerId, $role_name = 'owner'));
        $data['total_brokers'] = count($this->UserModel->getBrokerUsersWithRoles($brokerId, $role_name = 'broker'));
        $data['my_lines'] = count($this->LineModel->getSelfLines($this->uri->segment(4)));
        $data['to_lines'] = count($this->LineModel->getAllBrokerLines($this->uri->segment(4)));
        $data['active_lines'] = count($this->LineModel->getAllBrokerLines($this->uri->segment(4)));
        $data['credit'] = $this->UserModel->getCreditApplication($this->uri->segment(4));
        $data['about_employ'] = $this->UserModel->getSingleEmployement($userId);


//        $data['employments'] = $this->load->view(ADMIN_PATH . 'employments', NULL, TRUE);
        $data['main_content'] = ADMIN_PATH . "user_new";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function updateprofile()
    {
        if (in_array('self_update', $this->allowed)) {
            if ($this->form_validation->run('self_edit') == FALSE) {

                $this->session->set_flashdata("su_message", "Validation error occured.");
                redirect("admin/config");
            } else {
                $this->UserModel->updateself($this->input->post('user_id'));
                $this->session->unset_userdata(ADMIN_AUTH_USERNAME);
                $profile = $this->UserModel->getAdminDetails($this->input->post('user_id'));
                $this->session->set_userdata(array(ADMIN_AUTH_USERNAME => $profile->user_name));
                echo "<script>alert('Profile Updated Successfully.')</script>";
                redirect("admin");
            }
        } else {
            $this->session->set_flashdata("su_message", "You Have No Previleage To Update Profile");
            redirect("admin");
        }
    }

    function updatePassword($offset = '')
    {
        if ($this->form_validation->run('change_password') == FALSE) {
            $this->changePassword($this->input->post('user_id'), $offset);
        } else {
            $pass = $this->input->post('login_pwd');
            $this->UserModel->updatePassword($this->input->post('user_id'));
            $this->session->set_flashdata("message", "Password Updated Successfully.");
            redirect(ADMIN_PATH . "user/show/$offset");
        }
    }

    function changePassword($user_id)
    {
        $data['values'] = $this->UserModel->getAdminDetails($user_id);
        $data['title'] = "Change Password";
        $data['main_content'] = ADMIN_PATH . "changepassword_view";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function approveOldPassword_check($str)
    {
        $oldpassword = $this->input->post('old');
        $pass = $this->input->post('old_password');
        if ($oldpassword != md5($pass)) {
            $this->form_validation->set_message('approveOldPassword_check', 'Old Password Did Not Matched');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function changeStatus($id, $value, $offset)
    {
        if ($value == 'yes') {
            $stat = 'no';
        } else {
            $stat = 'yes';
        }
        if ($this->UserModel->updateStatus($id, $stat)) {
            $this->session->set_flashdata("su_message", "Status Updated Successfully.");

        } else {
            $this->session->set_flashdata("su_message", "Status Updated Successfully.");
        }
        redirect(ADMIN_PATH . "user/show/$offset");
    }

    function uniqueUsername($str)
    {
        $user_id = $this->input->post('user_id');
        if ($this->UserModel->uniqueUserName($user_id, $this->input->post('user_name')) > 0) {
            $this->form_validation->set_message('uniqueUsername', 'User Name Must Be Unique');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function switchRole($role_type, $roleid)
    {
        $this->session->set_userdata(array(ADMIN_AUTH_ROLE => $roleid));
        $this->session->set_userdata(array(ADMIN_AUTH_TYPE => $role_type));
        redirect(ADMIN_PATH . 'home', 'refresh');
    }

    function rolePrivilege($userid)
    {
        $data['title'] = 'Privilege Role';
        $data['userinfo'] = $this->UserModel->getUserInfoByUserId($userid);
        $privilegeroles = $this->UserModel->getRolesByUserId($userid);
        if (!empty($privilegeroles)) {
            $allowed_roles = $privilegeroles->role_privilege;
            $allowedlist = explode(',', $allowed_roles);
            if (count($allowedlist) > 0) {
                $allowed = $allowedlist;
            } else {
                $allowed = $allowed_roles;
            }
        }
        $data['allowed'] = $allowed;
        $data['old_roles'] = $allowed_roles;
        $data['allroles'] = $this->UserModel->getAllRoles();
        $data['main_content'] = ADMIN_PATH . 'user_role_manage_view';
        $this->load->view(ADMIN_PATH . 'incs/template', $data);

    }

    function updateRole()
    {
        $current = $this->input->post('role_privilege');
        $old = explode(',', $this->input->post('old_privilege'));
        $intersect = array_intersect($old, $current);
        $add = array_diff($current, $intersect);
        array_diff($old, $intersect);
        $userid = $this->input->post('user_id');
        foreach ($add as $userrole) {
            switch ($userrole) {
                case '4':
                    $this->UserModel->addBrokerRole($userid);
                    break;
                case '5':
                    $this->UserModel->addreferrerRole($userid);
                    break;
                case '6':
                    $this->UserModel->addLineRole($userid);
                    break;
                case '7':
                    $this->UserModel->addClientRole($userid);
                    break;
                default:
                    echo 'error while updating roles';
                    break;
            }
        }
        $allroles = implode(',', $current);
        $roleprivilege = $this->UserModel->updateRolesIntoUserTable($allroles, $userid);
        if ($roleprivilege) {
            $this->session->set_flashdata("update_message", "Role has been updated");
            redirect(ADMIN_PATH . "user/rolePrivilege/" . $userid);
        }
        die('error');
    }


    public function showUsersByRole($arg = NULL)
    {
        $this->allow(true, BROKER, ADMIN);
        if (($arg != Null)) {
            $data['users'] = $this->UserModel->getBrokerUsersWithRoles($this->userId, $arg);
        } else {
            if ($this->roleName == ADMIN) {
                $data['users'] = $this->UserModel->getUsers();
            } else {

                $data['users'] = $this->UserModel->getBrokerUsersWithRoles($this->userId, '$arg');
            }
        }
        $data['main_content'] = ADMIN_PATH . "users";
        $data['brokers'] = $this->UserModel->getBrokersEditable();
        $data['roles'] = $this->getRoles();
        foreach ((array)$data['users'] as $user) {
            $data = $this->addRolesToUser($user->id, $data);
        }
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    /*todo: this needs to allow upgrading memberships for any users by brokers or admin: instead of
    taking the current user passing in the user that you want to upgrade membership for*/
    function membershipUpgrade()
    {
        $data['title'] = 'Membership Upgrade';
        $membership = $this->MembershipModel->getMemberships($this->uri->segment(4));
        foreach ($membership as $membershipInfo) {
            $data[$membershipInfo->role . 'MembershipTypeId'] = $membershipInfo->id;
        }
        $receiverUserInfo = $this->UserModel->getUser($this->uri->segment(4));
        $data['user_name'] = $receiverUserInfo->first_name . ' ' . $receiverUserInfo->middle_initial . ' ' . $receiverUserInfo->last_name;
        $data['clientMembership'] = $this->MembershipModel->getMembershipByRole(2);
        $data['ownerMembership'] = $this->MembershipModel->getMembershipByRole(3);
        $data['brokerMembership'] = $this->MembershipModel->getMembershipByRole(5);
        $data['main_content'] = ADMIN_PATH . "membershipUpgrade";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function membershipRequest($clientId, $brokerId)
    {
        $clientInfo = $this->UserModel->getUserByUserId($clientId);
        $brokerInfo = $this->UserModel->getUserByUserId($brokerId);
        $receiverEmail = $clientInfo->email;
        $senderEmail = $brokerInfo->email;
        if ($receiverEmail) {
            $subject = 'The Credit University Membership Sign Up';
            $message = 'Please click the Link <a href="' . base_url('register/signUp/' . $clientId) . '">The Credit University</a> for Membership Registration';
            $emailSent = $this->EmailerModel->emailCenter($receiverEmail, $senderEmail, $subject, $message);
            if ($emailSent) {
                $this->session->set_flashdata('message', "Request has been send to the Client.");
                redirect(ADMIN_PATH . 'user/user/' . $clientId);
            } else {
                $this->session->set_flashdata('message', "Fial to Send Request.");
                redirect(ADMIN_PATH . 'user/user/' . $clientId);
            }
        } else {
            $this->session->set_flashdata('message', "Please Add Client Email Address First");
            redirect(ADMIN_PATH . 'user/user/' . $clientId);
        }


    }

    function systemUserForm()
    {

        $data['brokers'] = $this->UserModel->getBrokers(SELECT);
        $data['main_content'] = ADMIN_PATH . "systemUserForm";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    public function addSystemUser()
    {
        $limit = $this->MembershipModel->checkSystemUserLimit($this->session->userdata(USER_ID), BROKER);
        if ($limit == true) {
            try {
                $this->UserModel->insertSystemUser();
//            $this->sendRegistrationMail();
            } catch (Exception $e) {
                echo json_encode($this->handleDatabaseError($e));
                return;
            }
            redirect(base_url() . 'administrator/user/systemUsers');
        } else {
            $this->session->set_flashdata("su_message", "System User Limitation Exceed.");
            redirect(base_url() . 'administrator/user/systemUsers');
        }
    }

    function checkExistingUser()
    {
        return $this->UserModel->getUserByEmail($_POST['email']);
    }


}

?>