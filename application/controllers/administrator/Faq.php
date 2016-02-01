<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Faq extends AdminController
{


    public function __construct()
    {
        parent::__construct(ADMIN);
        $this->load->helper('general');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('path');
        $this->load->helper('string');
        $this->load->model('FaqModel');

    }

    public function index()
    {
        $data['title'] = 'faq';
        $data['faqs'] = $this->FaqModel->getFaqs();
        $data['main_content'] = ADMIN_PATH . "faqs";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function faqForm()
    {
        $data['title'] = 'faq';
        $data['action'] = 'add';
        $data['main_content'] = ADMIN_PATH . 'faqForm';
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function addFaq()
    {
        $this->FaqModel->insert();
        $this->session->set_flashdata("su_message", "FAQ Added Successfully.");
        redirect(ADMIN_PATH . "faq");
    }

    function faq($faq_id)
    {
        $data['title'] = 'faq';
        $data['action'] = 'update';
        $data['faq'] = $this->FaqModel->getFaq($faq_id);
        $data['main_content'] = ADMIN_PATH . "faq";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function updateAction()
    {
        $this->FaqModel->update($this->input->post('faq_id'));
        $this->session->set_flashdata("su_message", "FAQ Updated Successfully.");
        redirect(ADMIN_PATH . "faq");
    }

    function deleteFaq($faq_id)
    {
        if ($this->FaqModel->delete($faq_id)) {
            $this->session->set_flashdata("su_message", "FAQ Deleted Successfully.");
        }
        redirect(ADMIN_PATH . "faq");
    }


    function reOrder()
    {
        $this->FaqModel->reOrder($_POST['fromPosition'], $_POST['toPosition']);
    }

}

?>