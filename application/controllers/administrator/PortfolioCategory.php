<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Portfoliocategory extends CI_Controller
{
    private $allowed = array();
    private $errors = "";

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
        if (in_array('portfoliocategory_view', $this->allowed)) {
            $data['categoryList'] = $this->PortfolioCategoryModel->getAll();
            $data['allowed'] = $this->allowed;
            $data['error'] = $this->errors;
            $data['title1'] = "Add Portfolio Category";
            $data['title'] = "List Portfolio Category";
            $data['main_content'] = ADMIN_PATH . "portfoliocategory_view";
            $this->load->view(ADMIN_PATH . 'incs/template', $data);
        }
    }

    function deleteAction($user_id)
    {

        if (in_array('portfoliocategory_delete', $this->allowed)) {
            if ($this->PortfolioCategoryModel->delete($user_id)) {
                $this->session->set_flashdata("su_message", "Portfolio Category Deleted Successfully.");
            }
        } else {
            $this->session->set_flashdata("su_message", "You Have No Permission To Delete This Record");
        }

        redirect(ADMIN_PATH . "portfoliocategory");
    }

    function add()
    {
        if (in_array('portfoliocategory_add', $this->allowed)) {
            if ($this->form_validation->run('portfoliocategory_add') == FALSE) {
                $this->show();
            } else {
                $this->PortfolioCategoryModel->insert();
                ///$userauth=new User_auth_model();
                //$userauth->add($this->input->post('user_id'));

                $this->session->set_flashdata("su_message", "Portfolio Category Added Successfully.");
                redirect(ADMIN_PATH . "portfoliocategory");
            }
        } else {
            $this->session->set_flashdata("su_message", "You Have No Permission To Add New Portfolio Category");
            redirect(ADMIN_PATH . "portfoliocategory");
        }
    }

    function update()
    {
        if (in_array('portfoliocategory_update', $this->allowed)) {
            if ($this->form_validation->run('portfoliocategory_add') == FALSE) {
                $this->updateAction($this->input->post('id'));
            } else {
                $this->PortfolioCategoryModel->update($this->input->post('id'));

                $this->session->set_flashdata("su_message", "Portfolio Category Updated Successfully.");
                redirect(ADMIN_PATH . "portfoliocategory");
            }
        } else {
            $this->session->set_flashdata("su_message", "You Have No Previleage To Update Portfolio Category");
            redirect(ADMIN_PATH . "portfoliocategory");
        }
    }

    function updateAction($user_id)
    {
        if (in_array('portfoliocategory_update', $this->allowed)) {
            $data['categoryList'] = $this->PortfolioCategoryModel->getAll();
            $data['photoRecord'] = $this->PortfolioCategoryModel->getAdminDetails($user_id);
            $data['allowed'] = $this->allowed;
            $data['error'] = $this->errors;
            $data['title1'] = "Update Portfolio Category";
            $data['title'] = "List Portfolio Category";
            $data['main_content'] = ADMIN_PATH . "portfoliocategory_view";
            $this->load->view(ADMIN_PATH . 'incs/template', $data);
        }
    }

}

?>