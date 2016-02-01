<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Settings extends AdminController
{
    public $errors = '';

    public function __construct()
    {
        parent::__construct(SUPER_ADMIN);
        $this->load->helper('general');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('path');
        $this->load->helper('string');
        $this->load->model('RoleModel');
        $this->load->model('AuthModel');
        $this->load->model('SettingsModel');
    }

    public function index()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $data['paypal'] = $this->SettingsModel->getPaypalState();
        $data['main_content'] = ADMIN_PATH . "settings";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    public function setPaypal()
    {
        $this->SettingsModel->setPaypalState($_POST['paypal']);
        redirect(ADMIN_PATH . "settings");
    }

}