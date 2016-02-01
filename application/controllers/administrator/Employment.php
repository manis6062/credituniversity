<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Employment extends AdminController
{

    public function __construct()
    {
        parent::__construct(CLIENT, OWNER, BROKER, ADMIN);
        $this->load->helper('general');
        $this->load->helper('url');
        checkAdminAuth();
        $this->load->library('pagination');
        $this->load->helper('security');
        $this->load->model('UserModel');
    }

    function  addEmployment()
    {
        try {
            $this->UserModel->insertEmployment();

        } catch (Exception $e) {
            echo json_encode($this->handleDatabaseError($e));
            return;
        }
        redirect(base_url() . "administrator/employment/employments/" . $this->input->post('user_id'));

    }

    function deleteEmployment()
    {
        try {
            $this->UserModel->deleteEmployment();
        } catch (Exception $e) {
            echo json_encode($this->handleDatabaseError($e));
            return;
        }
        redirect(base_url() . "administrator/employment/employments/" . $this->input->post('user_id'));
    }

    function employments($user_id)
    {
        $data['employ'] = $this->UserModel->getEmployement($user_id);
        $data['userId'] = $this->session->userdata(USER_ID);
        $data['title'] = "Employment Details";
        $data['main_content'] = ADMIN_PATH . 'employments';
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }
}
