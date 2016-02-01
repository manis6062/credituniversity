<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Process extends AdminController
{


    public function __construct()
    {
        parent::__construct(ADMIN);
        $this->load->helper('general');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('path');
        $this->load->helper('string');
        $this->load->model('ProcessModel');

    }

    public function index()
    {
        $data['title'] = 'process';
        $data['processes'] = $this->ProcessModel->getProcesss();
        $data['main_content'] = ADMIN_PATH . "processes";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function processForm()
    {
        $data['title'] = 'process';
        $data['action'] = 'add';
        $data['main_content'] = ADMIN_PATH . 'processForm';
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function addProcess()
    {
        $this->ProcessModel->insert();
        $this->session->set_flashdata("su_message", "Process Added Successfully.");
        redirect(ADMIN_PATH . "process");
    }

    function Process($process_id)
    {
        $data['title'] = 'process';
        $data['action'] = 'update';
        $data['process'] = $this->ProcessModel->getProcess($process_id);
        $data['main_content'] = ADMIN_PATH . "process";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function updateAction()
    {
        $this->ProcessModel->update($this->input->post('process_id'));
        $this->session->set_flashdata("su_message", "Process Updated Successfully.");
        redirect(ADMIN_PATH . "process");
    }

    function deleteProcess($process_id)
    {
        if ($this->ProcessModel->delete($process_id)) {
            $this->session->set_flashdata("su_message", "Process Deleted Successfully.");
        }
        redirect(ADMIN_PATH . "process");
    }

}

?>