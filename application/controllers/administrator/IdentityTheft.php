<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class IdentityTheft extends AdminController
{


    public function __construct()
    {
        parent::__construct(BROKER , CLIENT);
        $this->load->helper('general');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('path');
        $this->load->helper('string');
        $this->load->model('NewsLetterModel');
        $this->load->model('CampaignModel');
        $this->load->model('UserModel');
        $this->load->model('IdentityTheftModel');

    }


    public function index()
    {
        $data['identity'] = $this->IdentityTheftModel->getIdentityTheft();
        $data['main_content'] = ADMIN_PATH . "identity_theft";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }



    function edit()
    {

        $this->IdentityTheftModel->updateIdentityTheft($this->input->post('description'));
    }

}