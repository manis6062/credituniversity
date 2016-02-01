<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contact extends AdminController {


    public function __construct() {
        parent::__construct(ADMIN);
        $this->load->helper('general');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('path');
        $this->load->helper('string');
        $this->load->model('ContactModel');

    }



    public function index() {
        $data['title'] = 'contact us';
        $data['action'] = 'update';
        $data['contact'] = $this->ContactModel->getContact();
        $data['main_content'] = ADMIN_PATH . "contact";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }
}

?>
