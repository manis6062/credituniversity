<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Auth extends AdminController
{
    public $errors = '';

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('general');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('path');
        $this->load->helper('string');
        $this->load->model('AuthModel');
    }

    public function addAuth()
    {
        try {
            $this->AuthModel->insertAuth();
        } catch (Exception $e) {
            redirect(ADMIN_PATH . "auth/authForm");
        }
        redirect(ADMIN_PATH . "auth/auths");
    }

    public function updateRole($id)
    {
        $data['data'] = $this->RoleModel->updateRole($id);
        $data['title'] = "Update Role";
        $data['main_content'] = ADMIN_PATH . "role";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);

    }

    public function auths()
    {
        $data['data'] = $this->AuthModel->getAuths();
        $data['main_content'] = ADMIN_PATH . "auths";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);

    }

    public function deleteAuth($authId)
    {
        try {
            $this->AuthModel->deleteAuth($authId);
            $this->session->set_flashdata("su_message", "Auth Deleted Successfully.");
            redirect(ADMIN_PATH . "auth/auths");
        } catch (Exception $e) {
            $data['data'] = $this->AuthModel->getUsersByAuthId($authId);
            $data['main_content'] = ADMIN_PATH . "users_auths";
            $this->load->view(ADMIN_PATH . 'inc/template', $data);
        }

    }


    public function deleteUsersFromAuth($authId)
    {
        try {
            $this->AuthModel->deleteUsersFromAuth($authId);
            $this->session->set_flashdata("su_message", "auth from users deleted successfully.");
            redirect(ADMIN_PATH . "auth/auths");
        } catch (Exception $e) {
            echo "some problem";
        }
    }


    public function authForm()
    {
        $this->load->helper(array('form', 'url'));
        $data['main_content'] = ADMIN_PATH . "authForm";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }
}