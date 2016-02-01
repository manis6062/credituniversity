<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mail extends AdminController
{
    public function __construct()
    {
        parent::__construct(CLIENT, BROKER, OWNER, ADMIN);
        $this->load->helper('general');
        $this->load->helper('url');
        $this->load->library('parser');
        checkAdminAuth();
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->form_validation->set_error_delimiters('<div class="red">', '</div>');
        $this->load->model('AuthModel');
        $this->load->helper('security');
        $this->load->model('RoleModel');
        $this->load->model('EmailModel');

        $this->load->helper(array('form', 'url', 'captcha', 'text'));

    }

    public function index()

    {
        $user_id = $this->session->userdata(USER_ID);
        $user_details = $this->UserModel->getUser($user_id);
        $data['profile_name'] = $user_details->first_name;
        $user_role_details = $this->RoleModel->getRolesConcatByUserId($user_id);
        $data['receivedEmails'] = $this->EmailModel->received_emails($user_id);
        $data['count_receivedEmails'] = $this->EmailModel->countAllReceivedItems($user_id);
        $data['main_content'] = ADMIN_PATH . "mailbox";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }


    function sendMail()
    {
        $subject = $this->input->post('subject');
        $users = $_POST['users'];
        $brokers = $_POST['brokers'];
        $clients = $_POST['clients'];
        $owners = $_POST['owners'];
        $subscribers = $_POST['subscribers'];
        $clientProspects = $_POST['clientProspects'];
        $brokerProspects = $_POST['brokerProspects'];
        $ownerProspects = $_POST['ownerProspects'];
        $emails = array();
        if (is_array($users))
            $emails = array_unique(array_merge($emails, $users));
        if (is_array($brokers))
            $emails = array_unique(array_merge($emails, $brokers));
        if (is_array($clients))
            $emails = array_unique(array_merge($emails, $clients));
        if (is_array($owners))
            $emails = array_unique(array_merge($emails, $owners));
        if (is_array($subscribers))
            $emails = array_unique(array_merge($emails, $subscribers));
        if (is_array($clientProspects))
            $emails = array_unique(array_merge($emails, $clientProspects));
        if (is_array($brokerProspects))
            $emails = array_unique(array_merge($emails, $brokerProspects));
        if (is_array($ownerProspects))
            $emails = array_unique(array_merge($emails, $ownerProspects));
        try {
            if (is_array($emails)) {
                $receiver_id = $this->UserModel->getUserIdFromEmailAddress($emails);
                $emailId = $this->EmailModel->insertEmails('Success', $receiver_id);
                $link = '<a href="'.base_url(ADMIN_PATH."mail/read_mail/".$emailId).'" target="_blank">here</a>';
                foreach ($emails as $email) {
                    $this->sendEmails($email, $link);
                }
            }
        } catch (Exception $e) {
            redirect(ADMIN_PATH . "mail/compose");
        }
        redirect(ADMIN_PATH . "mailbox");
    }


    function sendEmails($email, $link)
    {
        $emailMessage = "You've received email from ".$this->session->userdata(NAME).". Click ".$link." to view the message.";
        $receiverUserInfo = $this->UserModel->getUserByEmail($email);
        $receiverName = $receiverUserInfo->first_name . ' ' . $receiverUserInfo->middle_initial . ' ' . $receiverUserInfo->last_name;
        $user_id = $this->session->userdata(USER_ID);
        $user_details = $this->UserModel->getUser($user_id);
        $email_sender = $user_details->first_name . ' ' . $user_details->middle_initial . ' ' . $user_details->last_name;
        $msg = $emailMessage;
        $subject = $this->input->post('subject');
        $this->load->library('SimpleEmailService');
        $ses = new SimpleEmailService('AKIAISEC5PBG2F54VL4A', 'ZhRYSpKdUMLRrxPwy878UN+pJmnllAocdcYRpJwZ');
        $ses->enableVerifyPeer(false);
        $m = new SimpleEmailServiceMessage();
        $m->addTo($email);
        $m->setFrom($email_sender . '<' . EMAILSENDER . '>');
        $m->setSubject($subject);
        $data = array(
            'receiver'=> $receiverName,
            'emailer' => $email_sender,
            'message' => $msg,
        );
        $code = $this->parser->parse('administrator/mailed_template', $data);
        $m->setMessageFromString('', $code);
        $ses->sendEmail($m);
        $this->session->set_flashdata("su_message", "Email Sent Successfully...");
        redirect(ADMIN_PATH . "mail/compose");

    }


    function sent_mail()
    {
        $user_id = $this->session->userdata(USER_ID);
//        $data['sentEmails'] = $this->EmailModel->sent_emails($user_id);
        $data['allEmails'] = $this->EmailModel->getAllMail($user_id);
        $data['count_receivedEmails'] = $this->EmailModel->countAllReceivedItems($user_id);
        $data['main_content'] = ADMIN_PATH . "sent_mailbox";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function read_mail($mail_id)
    {
        $this->session->unset_userdata('previousLink');
        $user_id = $this->session->userdata(USER_ID);
        $user_details = $this->UserModel->getUser($user_id);
        $data['profile_name'] = $user_details->first_name;
        $user_role_details = $this->RoleModel->getRolesConcatByUserId($user_id);
        $data['read_mail'] = $this->EmailModel->read_mail($mail_id);
        $data['count_receivedEmails'] = $this->EmailModel->countAllReceivedItems($user_id);
        $this->EmailModel->changedToSeen($mail_id);
        $data['main_content'] = ADMIN_PATH . "read_mail";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function deleteFromInbox($mail_id, $receiver_id)
    {
        $this->EmailModel->deleteEmailsFromInbOx($mail_id, $receiver_id);
        $this->session->set_flashdata("su_message", "Email Deleted Successfully.");
        redirect(ADMIN_PATH . "mail");
    }

    function deleteFromSent($mail_id, $receiver_id)
    {
        $this->EmailModel->deleteEmailsFromSent($mail_id, $receiver_id);
        $this->session->set_flashdata("su_message", "Email Deleted Successfully.");
        redirect(ADMIN_PATH . "mail/sent_mail");
    }


    function deleteAction($mail_id, $receiver_id)
    {
        $this->EmailModel->deleteEmails($mail_id, $receiver_id);
        $this->session->set_flashdata("su_message", "Email Deleted Successfully.");
        redirect(ADMIN_PATH . "mail");
    }

    function permanent_delete($mail_id)
    {
        $this->EmailModel->permanentDelete($mail_id);
        $this->session->set_flashdata("su_message", "Email Deleted Successfully.");
        redirect(ADMIN_PATH . "mail/trash_mail");
    }

    function deleteFromTrash($mail_id, $receiver_id)
    {
        $this->EmailModel->deleteEmailsFromTrash($mail_id, $receiver_id);
        $this->session->set_flashdata("su_message", "Email Deleted Successfully.");
        redirect(ADMIN_PATH . "mail/trash_mail");
    }


    function compose()
    {
        $user_id = $this->session->userdata(USER_ID);
        $user_details = $this->UserModel->getUser($user_id);
        $data['profile_name'] = $user_details->first_name;
        $data['count_receivedEmails'] = $this->EmailModel->countAllReceivedItems($user_id);
        $data['subscribers'] = $this->emails('subscriber', true);
        $emails = $this->emails('broker', true);
        if (in_array($this->session->userdata(ROLE_NAME), array(CLIENT, OWNER))) {
            $emails = $this->UserModel->getBrokerNameEmail($this->session->userdata(USER_ID));
        }
        $data['brokers'] = $emails;
        $data['subscribers'] = $this->emails('subscriber', true);
        $data['owners'] = $this->emails('owner', true);
        $data['clients'] = $this->emails('client', true);
        $data['clientProspects'] = $this->emails('prospect', true, 'client');
        $data['brokerProspects'] = $this->emails('brokerProspect', true, 'broker');
        $data['ownerProspects'] = $this->emails('ownerProspect', true, 'owner');
        $this->load->model('UserModel');
        $data['users'] = $this->UserModel->getUsersWithEmail();
        $data['main_content'] = ADMIN_PATH . "compose_mail";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function trash_mail()
    {
        $user_id = $this->session->userdata(USER_ID);
        $data['trashEmails'] = $this->EmailModel->trash_emails($user_id);
        $data['count_receivedEmails'] = $this->EmailModel->countAllReceivedItems($user_id);
        $data['main_content'] = ADMIN_PATH . "trash_mail";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function deleteMultiple()
    {
        $checkbox = $this->input->post('checkbox');
        $this->EmailModel->deleteMultipleEmails($checkbox);
        $this->session->set_flashdata("su_message", "Email Deleted Successfully.");
        redirect(ADMIN_PATH . "mail");
    }

    function permanentDeleteMultiple()
    {
        $checkbox = $this->input->post('checkbox');
        $this->EmailModel->permanentDelete($checkbox);
        $this->session->set_flashdata("su_message", "Email Deleted Successfully.");
        redirect(ADMIN_PATH . "mail/trash_mail");
    }


    function emails($roles, $return = null, $roleName = null)
    {
        if ($return == null) {
            echo json_encode($this->UserModel->getEmails($roles, $_POST['individuals'], $roleName));
        } else {
            return $this->UserModel->getEmails($roles, $_POST['individuals'], $roleName);
        }
    }


    /*-------------------------- Old Codes----------------------------------------*/


}

?>