<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Module extends CI_Controller
{

    private $errors = "";
    private $allowed = array();

    public function __construct()
    {
        parent::__construct();
        checkAdminAuth();
        // Your own constructor code
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->form_validation->set_error_delimiters('<div class="red">', '</div>');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('path');
        $this->load->helper('security');
        //$this->load->model('auth_master_model');
        //$this->load->model('user_auth_model');
        $this->allowed = $this->AuthModel->getAuth();

    }

    public function index()
    {
        $this->show($page = '');
    }

    function show($page = '')
    {
        $cond = array();
        if (in_array('module_view', $this->allowed)) {
            $data['moduleList'] = $this->ModuleModel->getAll();
            $data['title'] = "List Module";
            $data['main_content'] = ADMIN_PATH . "module_view";
            $this->load->view(ADMIN_PATH . 'incs/template', $data);
        } else {
            redirect(ADMIN_PATH . "admin");
        }
    }

    function delete($id)
    {
        if (in_array('module_add', $this->allowed)) {
            if ($this->ModuleModel->delete($id)) {
                $this->session->set_flashdata("su_message", "Module Deleted Successfully.");
            }
            redirect(ADMIN_PATH . "module");
        } else {
            redirect(ADMIN_PATH . "admin");
        }
    }

    function addAction()
    {
        $masterauth = new AuthModel();
        $data['mas_auth'] = $masterauth->getAllAuth();
        $data['error'] = $this->errors;

        $data['title'] = "Add Module";
        $data['main_content'] = ADMIN_PATH . "moduleadd_view";
        $this->load->view(ADMIN_PATH . 'incs/template', $data);
    }

    function add()
    {
        if (in_array('module_add', $this->allowed)) {
            if ($this->form_validation->run('module_add') == FALSE) {
                $this->addAction();
            } else {
                if ($this->ModuleModel->insert($menu_data) > 0) {
                    $this->session->set_flashdata("su_message", "Module Addded Successfully.");
                } else {
                    $this->session->set_flashdata("su_message", "Some error occured while adding new module.");
                }
                redirect(ADMIN_PATH . "module");
            }
        } else {
            redirect(ADMIN_PATH . "admin");
        }
    }

    function update()
    {
        if (in_array('module_update', $this->allowed)) {
            if ($this->form_validation->run('module_add') == FALSE) {
                $this->updateAction($this->input->post('id'));
            } else {
                if ($this->ModuleModel->update($this->input->post('id'))) {
                    $this->session->set_flashdata("su_message", "Module Updated Successfully.");
                } else {
                    $this->session->set_flashdata("su_message", "Some error occured while updating module.");
                }
                redirect(ADMIN_PATH . "module");
            }
        } else {
            redirect(ADMIN_PATH . "admin");
        }
    }

    function updateAction($id)
    {
        $masterauth = new AuthModel();
        $data['error'] = $this->errors;
        $data['modules'] = $this->ModuleModel->getDetails($id);
        $data['title'] = "Update Module";
        $data['main_content'] = ADMIN_PATH . "moduleupdate_view";
        $data['mas_auth'] = $masterauth->getAllAuth();

        $this->load->view(ADMIN_PATH . 'incs/template', $data);
    }

    function priviledge()
    {
        $cond = array();
        if (in_array('module_priviledge', $this->allowed)) {
            $data['list'] = $this->AuthModel->getmodules();
            $data['moduleList'] = $this->ModuleModel->getmodulepriviledge();
            $data['clientmoduleList'] = $this->ModuleModel->getclientmodulepriviledge();
            $data['referrermoduleList'] = $this->ModuleModel->getreferrermodulepriviledge();
            $data['title'] = "Manage User Module Priviledge";
            $data['title1'] = "Manage Client Module Priviledge";
            $data['title2'] = "Manage referrer Module Priviledge";
            $data['main_content'] = ADMIN_PATH . "module_priviledge_view";
            $this->load->view(ADMIN_PATH . 'incs/template', $data);
        } else {
            redirect(ADMIN_PATH . "admin");
        }
    }

    function priviledgeupdate()
    {
        $this->ModuleModel->deletepriviledge();
        if ($this->input->post("type") == 'user') {
            $data = $this->input->post('module');
        } elseif ($this->input->post("type") == 'client') {
            $data = $this->input->post('module1');
        } elseif ($this->input->post("type") == 'referrer') {
            $data = $this->input->post('module2');
        }
        foreach ($data as $key => $value) {
            $this->ModuleModel->updatepriviledge($value);
        }
        if ($this->input->post("type") == 'user') {
            $this->session->set_flashdata("su_message", "Admin Module Priviledge Updated Successfully.");
        } elseif ($this->input->post("type") == 'client') {
            $this->session->set_flashdata("su_message1", "Client Module Priviledge Updated Successfully.");
        } elseif ($this->input->post("type") == 'referrer') {
            $this->session->set_flashdata("su_message2", "referrer Module Priviledge Updated Successfully.");
        }

        redirect(ADMIN_PATH . "module/priviledge");
    }
}

?>