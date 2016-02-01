<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Newsletter extends AdminController {

    public function __construct() {
        parent::__construct(ADMIN);
        $this->load->helper('general');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('path');
        $this->load->helper('string');
        $this->load->model('NewsLetterModel');
        $this->load->model('CampaignModel');
        $this->load->model('UserModel');
    }

    public function index() {
        $data['templates'] = $this->NewsLetterModel->getAll();
        $data['WelcomeLetters'] = $this->NewsLetterModel->getAllWelcomeLetter();
        $data['campaigns'] = $this->CampaignModel->getCampaigns(SELECTX);
        $data['main_content'] = ADMIN_PATH . "newsletters";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    public function newsletterForm() {
        $data['main_content'] = ADMIN_PATH . "newsletterForm";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    public function welcomeletterForm() {
        $data['main_content'] = ADMIN_PATH . "welcomeletterForm";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    public function sendNewsletterForm($templateId) {
        $newsletters = $this->NewsLetterModel->getAll();
        $data['newsletters'] = $newsletters;
        $templates = array();
        foreach ($newsletters as $newsletter) {
            $templates[$newsletter->id] = $newsletter->title;
        }
        $data['templates'] = $templates;
        $data['selectedTemplate'] = $templateId;
        $data['subscribers'] = $this->emails('subscriber', true);
        $data['brokers'] = $this->emails('broker', true);
        $data['owners'] = $this->emails('owner', true);
        $data['clients'] = $this->emails('client', true);
        $data['clientProspects'] = $this->emails('prospect', true, 'client');
        $data['brokerProspects'] = $this->emails('brokerProspect', true, 'broker');
        $data['ownerProspects'] = $this->emails('ownerProspect', true, 'owner');
        $this->load->model('UserModel');
        $data['users'] = $this->UserModel->getUsersWithEmail();
        $data['main_content'] = ADMIN_PATH . "sendNewsletterForm";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    public function sentNewsletters() {
        $data['getAllTemplates'] = $this->NewsLetterModel->getAll();
        $data['getSubscribers'] = $this->NewsLetterModel->getSubscribers();
        $data['getAllSubscribers'] = $this->NewsLetterModel->getAllSubscribers();
        $this->load->model('UserModel');
        $data['users'] = $this->UserModel->getUsers();
        $data['main_content'] = ADMIN_PATH . "sent_newsletters";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    public function subscribe() {
        $this->NewsLetterModel->insertSubscribers();
        redirect(ADMIN_PATH . "newsletter/sendNewsletterForm");
    }

    function sendNewsletter() {
        $template_id = $this->input->post('template');
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
                foreach ($emails as $email) {
                    $user = $this->UserModel->getUserByEmail($email);
                    $fullName = $user->first_name . ' ' . $user->last_name;
                    $sent = $this->sendEmails($email, $subject, $template_id, $user->id, $fullName);
                    if ($sent) {
                        $this->NewsLetterModel->insertNewsletter($subject, $template_id, $email);
                    }
                }
            }
        } catch (Exception $e) {
            redirect(ADMIN_PATH . "newsletter/sendNewsletterForm");
        }
        redirect(ADMIN_PATH . "newsletter");
    }

    function emails($roles, $return = null, $roleName = null) {
        if ($return == null) {
            echo json_encode($this->UserModel->getEmails($roles, $_POST['individuals'], $roleName));
        } else {
            return $this->UserModel->getEmails($roles, $_POST['individuals'], $roleName);
        }
    }

    public function add() {
        try {
            $this->NewsLetterModel->insert();
            redirect(ADMIN_PATH . 'newsletter');
        } catch (Exception $e) {
            echo json_encode($this->handleDatabaseError($e));
            return;
        }
    }

    public function addWelcomeLetter() {
        try {
            $this->NewsLetterModel->insertWelcomeLetter();
           
        } catch (Exception $e) {
            echo json_encode($this->handleDatabaseError($e));
            return;
        }
    }

    public
            function deleteTemplate($id) {
        $this->NewsLetterModel->deleteTemplate($id);
        redirect(ADMIN_PATH . 'newsletter');
    }

    public
            function deleteWelcomeLetter($id) {
        $this->NewsLetterModel->deleteWelcomeLetter($id);
        redirect(ADMIN_PATH . 'newsletter');
    }

    function editWelcomeLetter($id) {
        $data['title'] = 'Update Welcome Letter';
        $data['template'] = $this->getRawWelcomeLetterTemplate($id);

        // $data['campaigns'] = $campaigns;
        $data['main_content'] = ADMIN_PATH . "welcomeletter";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    public
            function delete($id) {
        $this->NewsLetterModel->delete($id);
        redirect(ADMIN_PATH . 'newsletter/sentNewsletters');
    }

    function edit($id) {
        $data['title'] = 'Update Template';
        $data['template'] = $this->getRawNewsLetterTemplate($id);
        $allCampaigns = $this->CampaignModel->getCampaigns();
        $campaigns = array();
        foreach ($allCampaigns as $campaign) {
            $campaigns[] = array('value' => $campaign->id, 'text' => $campaign->type . ' - ' . $campaign->name);
        }
        $data['campaigns'] = $campaigns;
        $data['main_content'] = ADMIN_PATH . "newsletter";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function updateWelcomeLetter() {
        try {
            $this->NewsLetterModel->updateWelcomeLetter($this->input->post('code'), $this->input->post('id'));
           
        } catch (Exception $e) {
            echo json_encode($this->handleDatabaseError($e));
            //  return;
        }
    }

    function view($templateId) {
        $full_name = '[First Name] [Last Name]';
        $data['code'] = $this->getInterpretedNewsLetterTemplate($templateId, $full_name, null, $templateId);
        $data['main_content'] = ADMIN_PATH . "newsletter_view";
        $this->load->view(ADMIN_PATH . 'inc/blank', $data);
    }

    function update() {

        $this->NewsLetterModel->updateNewsletter($this->input->post('code'));
    }

    public
            function sendEmails($emails, $subject, $templateId, $userId, $full_name = '', $other = '') {
        $this->load->library('SimpleEmailService');
        $ses = new SimpleEmailService('AKIAISEC5PBG2F54VL4A', 'ZhRYSpKdUMLRrxPwy878UN+pJmnllAocdcYRpJwZ');
        $ses->enableVerifyPeer(false);
        $simpleEmailServiceMessage = new SimpleEmailServiceMessage();

        if (!empty($emails)) {
            $simpleEmailServiceMessage->addTo($emails);
        } else {
            $simpleEmailServiceMessage->addTo($other);
        }
        $simpleEmailServiceMessage->setFrom('The Credit University' . '<' . EMAILSENDER . '>');
        $simpleEmailServiceMessage->setSubject($subject);
        if (empty($other)) {
            $code = $this->getInterpretedNewsLetterTemplate($templateId, $full_name, $userId, $this->NewsLetterModel->getCampaignId($templateId), $other = '');
        } else {
            $code = $this->getInterpretedNewsLetterTemplate($templateId, $full_name = '', $userId, $this->NewsLetterModel->getCampaignId($templateId), $other);
        }
        $simpleEmailServiceMessage->setMessageFromString('', $code);
        $sent = $ses->sendEmail($simpleEmailServiceMessage);
        return $sent;
    }

    public
            function getInterpretedNewsLetterTemplate($templateId, $full_name = '', $userId, $campaignId, $other = '') {
        if (!isset($userId)) {
            $userId = 0;
            $full_name = 'Sir/Madam';
        }
        if ($campaignId) {
            $couponInfo = $this->CampaignModel->getCampaignDetailById($campaignId);
        }
        $code = $this->NewsLetterModel->getTemplate($templateId);
        $code = str_replace("%full_name%", $full_name, $code);
        $code = str_replace("%coupon%", $couponInfo->coupon, $code);
        $template = base_url() . 'newsletter/view/' . $templateId . '/' . $userId . '/' . $campaignId;
        $code = str_replace("%template%", $template, $code);
        $signUp = base_url() . 'register/signUp/' . $couponInfo->brokerId;
        $code = str_replace("%signup%", $signUp, $code);
        return $code;
    }

    public
            function getRawNewsLetterTemplate($id) {
        return $this->NewsLetterModel->getNewsTemplate($id);
    }

    public
            function getRawWelcomeLetterTemplate($id) {
        return $this->NewsLetterModel->getWelcomeLetterTemplate($id);
    }

    /* do not delete this - regex to change content
      (src=")(.*?)(")
      $1http://americacpn.com/uploads/email_templates/litmus_stamplia_templates/Minty/$2$3
     */
}
?>

