<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Social extends AdminController {


    public function __construct() {
        parent::__construct(ADMIN);
        $this->load->helper('general');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('path');
        $this->load->helper('string');
        $this->load->model('SocialModel');

    }

    public function index()
    {
        $data['title'] = 'social';
        $data['socials'] = $this->SocialModel->getSocials();
        $data['main_content'] = ADMIN_PATH . "socials";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function socialForm()
    {
        $data['title'] = 'social';
        $data['action'] = 'add';
        $data['main_content'] = ADMIN_PATH . 'socialForm';
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function addSocial()
    {
        $this->SocialModel->insert();
        $this->session->set_flashdata("su_message", "Social Added Successfully.");
        redirect(ADMIN_PATH . "social");
    }

    function deleteSocial($id)
    {
        if ($this->SocialModel->delete($id)) {
            $this->session->set_flashdata("su_message", "Social Media Deleted Successfully.");
        }
        redirect(ADMIN_PATH . "social");
    }
}

?>
