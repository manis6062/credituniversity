<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends AdminController
{
    public function __construct()
    {
        parent::__construct(CLIENT, OWNER, BROKER, ADMIN, SUPER_ADMIN);
        $this->load->helper('general');
        checkAdminAuth();
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('path');
        $this->load->model('AuthModel');
        $this->load->model('AffiliateModel');
        $this->load->model('LineOwnerModel');
        $this->load->model('LineModel');
        $this->load->model('RoleModel');
        $this->load->model('EmailModel');
        $this->load->model('TaskModel');
    }

    public function index()
    {
        $data['title'] = "Home";
        $dat = $this->LineModel->getAllPurchaseLines();
        $data['total_lines'] = count($dat);
        $client_id = $this->session->userdata(USER_ID);
        $da = $this->LineModel->linesPurchased($client_id);
        $data['count'] = count($da);
        $brokerId = null;
        if ($this->roleName = "broker") {
            $brokerId = $this->userId;
        }
        $data['activeAssignments'] = $this->LineModel->activeLines($brokerId);
        $whatAreTradelines = $this->ContentModel->getContentWithModuleName('what_are_tradelines');
        $this->session->set_userdata('whatAreTradelines', $whatAreTradelines);
        $data['whatAreTradelines'] = $whatAreTradelines;
        $tradelineBenefits = $this->ContentModel->getContentWithModuleName('tradeline_benefits');
        $this->session->set_userdata('tradelineBenefits', $tradelineBenefits);
        $data['tradelineBenefits'] = $tradelineBenefits;
        $data['activeLines'] = count($this->LineModel->getAllBrokerLines($brokerId));
        $data['users'] = count($this->UserModel->getBrokerUsers($brokerId));
        $data['total_clients'] = count($this->UserModel->getBrokerUsersWithRoles($brokerId , $role_name = 'client'));
        $data['total_owners'] = count($this->UserModel->getBrokerUsersWithRoles($brokerId , $role_name = 'owner'));
        $data['total_brokers'] = count($this->UserModel->getBrokerUsersWithRoles($brokerId , $role_name = 'broker'));

        $user_id = $this->session->userdata(USER_ID);
        $data['systemUsersUnderBroker'] = $this->UserModel->getSystemUsersUnderBroker($user_id, SELECT);
        $parent_id = $this->UserModel->getParentOfSystemUsers($client_id);
        $parent_id =$parent_id->parent;

        $parent_name = $this->UserModel->getParentName($parent_id);
        $parent_name =$parent_name->first_name . ' ' . $parent_name->last_name;
//        $parent_id =$parent_name->user_id;

        $broker = array($parent_id => $parent_name);
        $data['systemUsers'] = array_merge($data['systemUsersUnderBroker'] , $broker);
        $data['brokersSystemUsers'] = $this->UserModel->getBrokersSystemUsers($user_id, SELECT);
        
        /*
         * These data are used for to do sharing dropdown
         * 
         * If user has a parent then he/she is a system User
         * 
         * Broker:
         * Can only share with system users maintained by him/her
         * 
         * System Users:
         * Can share with parent broker and the system users maintained by him/her 
         */
        if($parent_id){
            $shareUsers = $broker + $this->UserModel->toDoSystemUsers($parent_id, $user_id);
            $data['shareUsers'] = $shareUsers;
        }else{
            $data['shareUsers'] = $this->UserModel->toDoSystemUsers($user_id);
        }

        $data['user_id'] = $this->session->userdata(USER_ID);
        $data['email'] = $this->session->userdata(EMAIL);
        $data['name'] = $this->session->userdata(NAME);
        $data['membership'] = $this->session->userdata(MEMBERSHIPS);
        
        $data['main_content'] = ADMIN_PATH . "home_view";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function lineowner_dashboard()
    {
        $user_id = $this->session->userdata(USER_ID);
        $line = $this->LineOwnerModel->getTradelinOwnerDetailsWithUserId($user_id);
        $data['completed_clients'] = $this->ClientModel->getCompletedClientByLine($line->to_id);
        $data['process_clients'] = $this->ClientModel->getProcessClientByLine($line->to_id);
        $data['cardinfo'] = $this->LineOwnerModel->getCardDetailsWithUserId($this->session->userdata(USER_ID));
        $data['title'] = "Home";
        $data['main_content'] = ADMIN_PATH . "line_dashboard";
        $this->load->view(ADMIN_PATH . 'incs/template', $data);
    }

    function changeRole()
    {
        $this->session->set_userdata(ROLE_NAME, $this->input->post(ROLE_NAME));
        $this->session->set_userdata(ROLE_LABEL, $this->input->post(ROLE_LABEL));
        $roleId=$this->RoleModel->getRoleIdByRoleName( $this->session->userdata(ROLE_NAME));
        $this->session->set_userdata(ROLE_ID, $roleId);
    }

    function changeRoles()
    {
        $this->RoleModel->populateRolesInSession($this->input->post('email'));
        echo json_encode($this->session->userdata(ROLES));
    }

    function quickMail()
    {
        $email_to = $this->input->post('emailto');
        $email_id = $this->UserModel->getIdFromEmailAddress($email_to);
        $subject = $this->input->post('subject');
        $message = $this->input->post('msg');
        $this->load->library('SimpleEmailService');
        $ses = new SimpleEmailService('AKIAISEC5PBG2F54VL4A', 'ZhRYSpKdUMLRrxPwy878UN+pJmnllAocdcYRpJwZ');
        $ses->enableVerifyPeer(false);
        $m = new SimpleEmailServiceMessage();
        $m->addTo($email_to);
        $m->setFrom($this->name . ' via Credit University' . '<' . EMAILSENDER . '>');
//        $m->addCC($this->email2);
        $m->setSubject($subject);
        $msg = $message;
        $m->setMessageFromString('', $msg);
        if ($ses->sendEmail($m)) {
            if ($email_id) {
                $receiver_id = array($email_id);
                $this->EmailModel->insertEmails('Success', $receiver_id);
            }
            $this->session->set_flashdata('quickMessage', "Quick Email has been sent successfully.");
            redirect(ADMIN_PATH);
        }
    }

    function supportEmail()
    {
        $clientOwner = array('Client','Owner');
        $result = array_intersect($clientOwner, $this->session->userdata(ROLES));
        if($result){
            $brokerId = $this->UserModel->getBrokerFromClientid($this->session->userdata(USER_ID));
            $brokerIdArray = array($brokerId);
            $brokerEmail[] = $this->UserModel->getEmailAddress($brokerId);
        }
        $adminUsers = $this->UserModel->getAdminUsers();
        foreach($adminUsers as $userAdmin){
            $receiverAdminId[] = $userAdmin->id;
            $receiverAdminEmail[] = $userAdmin->email;
        }
        if($brokerIdArray){
            $receiverId = array_unique (array_merge($receiverAdminId,$brokerIdArray));
            $receiverEmail = array_unique(array_merge($receiverAdminEmail,$brokerEmail));
        }
        else {
            $receiverId = $receiverAdminId;
            $receiverEmail = $receiverAdminEmail;
        }
        $emailId = $this->EmailModel->insertEmails('Success', $receiverId);
        $link = '<a href="'.base_url(ADMIN_PATH."mail/read_mail/".$emailId).'" target="_blank">here</a>';
        $emailMessage = "You've received email from ".$this->session->userdata(NAME).". Click ".$link." to view the message.";
        $subject = $this->input->post('subject');
        $message = $emailMessage;
        $this->load->library('SimpleEmailService');
        $ses = new SimpleEmailService('AKIAISEC5PBG2F54VL4A', 'ZhRYSpKdUMLRrxPwy878UN+pJmnllAocdcYRpJwZ');
        $ses->enableVerifyPeer(false);
        $m = new SimpleEmailServiceMessage();
        $m->addTo(EMAILSENDER);
        $m->addCC($receiverEmail);
        $m->setFrom($this->name . ' via Credit University' . '<' . EMAILSENDER . '>');
        $m->setSubject($subject);
        $msg = $message;
        $m->setMessageFromString('', $msg);
        $ses->sendEmail($m);

        $this->session->set_flashdata("supportMessage","Support & Suggestion email has been sent successfully.");
        redirect(ADMIN_PATH);
    }


}
