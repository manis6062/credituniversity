<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ThemeOption extends AdminController
{


    public function __construct()
    {
        parent::__construct(ADMIN);
        $this->load->helper('general');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('path');
        $this->load->helper('string');
        $this->load->model('ThemeOptionModel');

    }

    public function index()
    {
        $data['title'] = 'Theme Option';
        $data['action'] = 'update';
        $data['contact'] = $this->ThemeOptionModel->getThemeOption();
        $data['main_content'] = ADMIN_PATH . "themeOption";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }
}

?>
