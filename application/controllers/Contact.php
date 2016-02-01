<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contact extends CI_Controller
{

    private $errors = "";

    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->form_validation->set_error_delimiters('<div class="error">* ', '</div>');
    }

    public function index()
    {
        $data['title'] = 'Contact Us';
        $data['main_content'] = 'contact';
        $this->load->view('inc/registration', $data);
    }

    public function login()
    {
        if ($this->form_validation->run('contact') == FALSE) {
            $this->index();
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $subject = $this->input->post('subject');
            $msg = $this->input->post('message');
            $this->load->library('SimpleEmailService');
            $ses = new SimpleEmailService('AKIAISEC5PBG2F54VL4A', 'ZhRYSpKdUMLRrxPwy878UN+pJmnllAocdcYRpJwZ');

            $ses->enableVerifyPeer(false);
            //print_r($ses->verifyEmailAddress('savrniroj@gmail.com'));
            $m = new SimpleEmailServiceMessage();
            $m->addTo('contact <nirojshakyaimadol@hotmail.com>');
            $m->setFrom($email . '<' . EMAILSENDER . '>');
            $m->setSubject($subject);
            $message = $msg;
            $m->setMessageFromString('', $message);
            $ses->sendEmail($m);
            $this->session->set_flashdata("su_message", "Email Sent Successfully.");
            redirect("contact");
        }
    }

    public function sendmail()
    {
        $this->load->library('form_validation');
        $this->load->model('EmailModel');
        $this->load->model('UserModel');
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $subject = $this->input->post('subject');
        $msg = $this->input->post('msg');
        $adminUsers = $this->UserModel->getAdminUsers();
        foreach($adminUsers as $userAdmin){
            $receiverAdminId[] = $userAdmin->id;
            $receiverAdminEmail[] = $userAdmin->email;
        }
        $emailId = $this->EmailModel->insertEmails('Success', $receiverAdminId);
        $link = '<a href="'.base_url(ADMIN_PATH."mail/read_mail/".$emailId).'" target="_blank">here</a>';
        $emailMessage = "You've received email from ".$name.". Click ".$link." to view the message.";

        $this->load->library('SimpleEmailService');
        $ses = new SimpleEmailService('AKIAISEC5PBG2F54VL4A', 'ZhRYSpKdUMLRrxPwy878UN+pJmnllAocdcYRpJwZ');

        $ses->enableVerifyPeer(false);
        //print_r($ses->verifyEmailAddress('savrniroj@gmail.com'));
        $m = new SimpleEmailServiceMessage();
        $m->addTo(EMAILSENDER);
        $m->addCC($receiverAdminEmail);
        $m->setFrom($email . '<' . EMAILSENDER . '>');
        $m->setSubject($subject);
        $message = $emailMessage;
        $m->setMessageFromString('', $message);
        if ($ses->sendEmail($m)) {
            if ($this->uri->segment(1) == 'Contact' || $this->uri->segment(1) == 'contact') {
                $this->session->set_flashdata("su_message", "Email Sent Successfully");
                redirect("contact");
            } else {
                echo "<script>alert('Email Sent Successfully');window.history.back();</script>";
            }
        }
    }

    public function quickConnect()
    {
        $this->load->library('form_validation');
        $this->load->model('UserModel');
        $this->load->model('EmailModel');
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $subject = 'Quick Connect';


        $adminUsers = $this->UserModel->getAdminUsers();
        foreach($adminUsers as $userAdmin){
            $receiverAdminId[] = $userAdmin->id;
            $receiverAdminEmail[] = $userAdmin->email;
        }
        $emailId = $this->EmailModel->insertEmails('Success', $receiverAdminId);
        $link = '<a href="'.base_url(ADMIN_PATH."mail/read_mail/".$emailId).'" target="_blank">here</a>';
        $emailMessage = "You've received email from ".$name.". Click ".$link." to view the message.";

        $this->load->library('SimpleEmailService');
        $ses = new SimpleEmailService('AKIAISEC5PBG2F54VL4A', 'ZhRYSpKdUMLRrxPwy878UN+pJmnllAocdcYRpJwZ');
        $ses->enableVerifyPeer(false);
        $m = new SimpleEmailServiceMessage();
        $m->addTo('info@thecredituniversity.com');
        $m->setFrom($email . '<' . EMAILSENDER . '>');
        $m->setSubject($subject);
        $message = $emailMessage;
        $m->setMessageFromString('', $message);
        if ($ses->sendEmail($m)) {
            if ($this->uri->segment(1) == 'Contact' || $this->uri->segment(1) == 'contact') {
                $this->session->set_flashdata("su_message", "Email Sent Successfully");
                redirect("home");
            } else {
                echo "<script>alert('Email Sent Successfully');window.history.back();</script>";
            }
        }
    }


}

