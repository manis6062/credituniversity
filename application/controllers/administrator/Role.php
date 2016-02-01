<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Role extends AdminController
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
        $this->load->model('RoleModel');
        $this->load->model('AuthModel');
    }

    public function addRole()
    {
        try {
            $this->RoleModel->insertRoles();
        } catch (Exception $e) {
            redirect(ADMIN_PATH . "role/roleForm");
        }
        redirect(ADMIN_PATH . "role/roles");
    }

    public function updateRole($id)
    {
        $data['data'] = $this->RoleModel->updateRole($id);
        $data['title'] = "Update Role";
        $data['main_content'] = ADMIN_PATH . "role";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);

    }

    public function roles()
    {
        $data['data'] = $this->RoleModel->getRoles();
        $data['title'] = "";
        $data['main_content'] = ADMIN_PATH . "roles";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }


    public function roleAuth()
    {
        $data['roles'] = $this->RoleModel->getRoleRoleLabel();
        $data['role_auths'] = $this->RoleModel->getRoleAuthArray();
        $data['auths'] = $this->AuthModel->getAuthsArray();
        $data['main_content'] = ADMIN_PATH . "roleAuth";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    public function deleteRole($id)
    {
        try {
            $this->RoleModel->deleteRole($id);
            $this->session->set_flashdata("su_message", "Role Deleted Successfully.");
            redirect(ADMIN_PATH . "role/roles");
        } catch (Exception $e) {
            $data['data'] = $this->RoleModel->getUsersByRoleId($id);
            $data['main_content'] = ADMIN_PATH . "users_roles";
            $this->load->view(ADMIN_PATH . 'inc/template', $data);
        }
    }

    public function deleteUsersFromRole($roleId)
    {
        try {
            $this->RoleModel->deleteUsersFromRole($roleId);
            $this->session->set_flashdata("su_message", "role from users deleted successfully.");
            redirect(ADMIN_PATH . "role/roles");
        } catch (Exception $e) {
            echo json_encode($this->handleDatabaseError($e));
            return;
        }
    }


    public function roleForm()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('label', 'Label', 'required');
        $this->form_validation->set_rules('value', 'Value', 'required|max_length[10]');
        $data['main_content'] = ADMIN_PATH . "roleForm";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function updateRolePrivilege()
    {
        $this->load->model('InlineModel');
        $primaryKeyValue = $_POST['pk'];
        $columnName = $_POST['name'];
        $columnValue = $_POST['value'];
        $table = $_POST['table'];
        $deleteKey = $_POST['deleteKey'];
        $this->InlineModel->addOrUpdate($table, $primaryKeyValue, $columnName, $columnValue, $deleteKey);
        if ($this->session->userdata(USER_ID) == $primaryKeyValue['user_id'])
            $this->RoleModel->updateSessionValue($primaryKeyValue['user_id']);
    }

}