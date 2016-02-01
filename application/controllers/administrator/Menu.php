<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menu extends AdminController
{


    public function __construct()
    {
        parent::__construct(ADMIN);
        $this->load->helper('general');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('path');
        $this->load->helper('string');
        $this->load->model('MenuModel');
        $this->load->model('ContentModel');
        $this->load->model('ModuleModel');

    }

    public function index()
    {
        $data['title'] = 'menu';
        $data['menus'] = $this->MenuModel->getMenus();
        $data['main_content'] = ADMIN_PATH . "menus";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function menuForm()
    {
        $data['title'] = 'menu';
        $data['action'] = 'add';
        $data['contents'] = $this->ContentModel->getContents();
        $data['modules'] = $this->ModuleModel->getModules();
        $data['main_content'] = ADMIN_PATH . 'menuForm';
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function menu($id)
    {
        $data['title'] = 'menu';
        $data['action'] = 'update';
        $data['menu'] = $this->MenuModel->getMenu($id);
        $data['contents'] = $this->ContentModel->getContents();
        $data['modules'] = $this->ModuleModel->getModules();
        $data['main_content'] = ADMIN_PATH . "menu";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function addMenu()
    {
        $this->MenuModel->insert();
        $this->session->set_flashdata("su_message", "Menu Added Successfully.");
        redirect(ADMIN_PATH . "menu");
    }

    function deleteMenu($id)
    {
        if ($this->MenuModel->delete($id)) {
            $this->session->set_flashdata("su_message", "Menu Deleted Successfully.");
        }
        redirect(ADMIN_PATH . "menu");
    }

    function updateMenu($id)
    {
        if ($this->MenuModel->update($id)) {
            $this->session->set_flashdata("su_message", "Menu Updated Successfully.");
        }
        redirect(ADMIN_PATH . "menu");
    }

    function reOrder()
    {
        $this->MenuModel->update($_POST['fromPosition'], $_POST['toPosition']);
    }


}

?>
