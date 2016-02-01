<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Referrer extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->helper('general');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('path');
        $this->load->helper('string');
        $this->load->model('referrerModel');

    }


    public function index()
    {

        $data['head'] = 'referrer Management';
        $data['title'] = 'referrers';
        $data['referrers'] = $this->referrerModel->getreferrers();
        $data['main_content'] = ADMIN_PATH . "referrers";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    public function referrerForm()
    {
        $random_number = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
        $vals = array(
            'word' => $random_number,
            'img_path' => './captcha/',
            'img_url' => base_url() . 'captcha/',
            'img_width' => 250,
            'img_height' => 34,
            'expiration' => 7200
        );
        $data['main_content'] = ADMIN_PATH . "referrerForm";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    public function addreferrer()
    {

        // From User Table
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim|xss_clean|callback_emailCheck');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|max_length[12]|trim');
        $this->form_validation->set_rules('cpassword', 'Password Confirmation', 'required|min_length[5]|max_length[12]|matches[password]|trim', array('matches' => 'Password Doesn\'t Match.'));

        //From Profile Table

        if (($this->input->post('roleid')) && (in_array(2, $this->input->post('roleid')))) {
            $this->form_validation->set_rules('referrer_email_id', 'referrer Email ID', 'required|valid_email|callback_checkreferrerEmailId[referrer_referrer]');
            $this->form_validation->set_rules('ssn', 'SSN', 'required');
            $this->form_validation->set_rules('dob', 'Date of Birth', 'callback_checkDateFormat');
        }

        $this->form_validation->set_rules('first_name', 'First Name', 'required|trim|callback_alpha_space');
        if ($this->input->post('middleInitial')) {
            $this->form_validation->set_rules('middle_initial', 'Middle Name', 'trim|callback_alpha_space');
        }
        $this->form_validation->set_rules('last_name', 'Last Name', 'required|trim|callback_alpha_space');
        $this->form_validation->set_rules('primary_phone_no', 'Primary Contact', 'required|callback_validate_phone_number');

        if ($this->form_validation->run() == FALSE) {
            $this->referrerForm();

        } else {
            if (!empty($this->referrerUserId) && (in_array(2, $this->input->post('roleid')) || in_array(4, $this->input->post('roleid')))) {
                $referreruserid = $this->referrerUserId;
                $table = $this->table_name;
                $referreruserid = '';

            } elseif (in_array(3, $this->input->post('roleid'))) {
                $referreruserid = $this->referrerUserId;
                $table = $this->table;
                $referreruserid = '';
            } else {
                $referreruserid = '';
                $referreruserid = '';
                $table = '';
            }

            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $this->UserModel->insertUser($email, $password, $referreruserid, $referreruserid, $table);
            redirect(base_url() . 'administrator/referrer');
        }

    }


}
