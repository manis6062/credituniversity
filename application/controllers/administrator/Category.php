<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category extends CI_Controller
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
        if ($this->session->userdata(ADMIN_AUTH_TYPE) == "user") {
            $userid = $this->session->userdata(USER_ID);
            //$cond="where ts_user.branch_id='$branchid'";
            $cond['nc_category.crtd_by'] = $userid;
        }
        $config['total_rows'] = $this->CategoryModel->countAll($cond);
        $config['base_url'] = site_url(ADMIN_PATH . "category/show/");
        $config['per_page'] = '10';
        $config['uri_segment'] = '4';
        $offset = $this->uri->segment(4, 0);
        $this->pagination->initialize($config);
        $data['start'] = $page;
        $data['categoryList'] = $this->CategoryModel->getAllPaginate($cond, $config['per_page'], $offset);


        $data['title'] = "List Category";
        $data['main_content'] = ADMIN_PATH . "categorylist_view";
        $this->load->view(ADMIN_PATH . 'incs/template', $data);
    }

    function deleteCategory($user_id, $offset)
    {
        $data = $this->CategoryModel->getCategoryForDelete($user_id);
        $flag = 0;
        if ($data->is_menu == 'yes') {
            $flag = 1;
        }
        if ($this->CategoryModel->deleteCategory($user_id)) {
            if ($flag == 1) {
                $this->MenuModel->delete($user_id, 'category');
            }
            $this->session->set_flashdata("su_message", "Category Deleted Successfully.");
        }

        redirect(ADMIN_PATH . "category/show/$offset");
    }

    function addAction()
    {
        $masterauth = new AuthModel();
        $data['mas_auth'] = $masterauth->getAllAuth();
        $data['error'] = $this->errors;

        $data['title'] = "Add Category";
        $data['main_content'] = ADMIN_PATH . "categoryadd_view";
        $this->load->view(ADMIN_PATH . 'incs/template', $data);
    }

    function add()
    {
        if ($this->form_validation->run('category_add') == FALSE) {
            $this->addAction();
        } else {
            $photo = TRUE;
            if ($photo) {
                $cat_id = $this->CategoryModel->insert();
                if ($this->input->post('is_menu') != '') {
                    $today = date("Y-m-d H:i:s");
                    $maxorder = $this->MenuModel->getMaxOrder();
                    $menu_data = array(
                        'menu_name' => ucwords($this->input->post('cat_name')),
                        'menu_type' => 'category',
                        'status' => $this->input->post('status') == 'active' ? 'Active' : 'Inactive',
                        'menu_order' => $maxorder + 1,
                        'rel_id' => $cat_id,
                        'crtd_dt' => $today,
                        'crtd_by' => $this->session->userdata(USER_ID),
                        'updt_dt' => $today,
                        'updt_by' => $this->session->userdata(USER_ID)
                    );
                    $this->MenuModel->insert($menu_data);
                }
                $this->session->set_flashdata("su_message", "Category Addded Successfully.");
                redirect(ADMIN_PATH . "category/index");
            } else {
                $this->addAction();
            }
        }
    }

    function update($offset)
    {
        if ($this->form_validation->run('category_update') == FALSE) {
            $this->updateAction($this->input->post('cat_id'), $offset);
        } else {
            //files validations
            $photo = TRUE;
            if ($photo) {
                $data = $this->CategoryModel->getCategoryForDelete($this->input->post('cat_id'));
                $flag = "0";
                if ($data->is_menu == 'yes') {
                    if ($this->input->post('is_menu') == '') {
                        $flag = "1";
                    }
                }
                if ($data->is_menu == 'no') {
                    if ($this->input->post('is_menu') == 'yes') {
                        $flag = "2";
                    }
                }
                $this->CategoryModel->update($this->input->post('cat_id'));
                $today = date("Y-m-d H:i:s");
                $maxorder = $this->MenuModel->getMaxOrder();
                $menu_data = array(
                    'menu_name' => ucwords($this->input->post('cat_name')),
                    'menu_type' => 'category',
                    'status' => $this->input->post('status') == 'active' ? 'Active' : 'Inactive',
                    'menu_order' => $maxorder + 1,
                    'rel_id' => $this->input->post('cat_id'),
                    'crtd_dt' => $today,
                    'crtd_by' => $this->session->userdata(USER_ID),
                    'updt_dt' => $today,
                    'updt_by' => $this->session->userdata(USER_ID)
                );
                if ($flag == "0") {
                    $this->MenuModel->update($this->input->post('cat_id'), 'category', $menu_data);
                } elseif ($flag == "1") {
                    $this->MenuModel->delete($this->input->post('cat_id'), 'category');
                } elseif ($flag == "2") {
                    $this->MenuModel->insert($menu_data);
                }
                $this->session->set_flashdata("su_message", "Category Updated Successfully.");
                redirect(ADMIN_PATH . "category/show/$offset");
            } else {
                $this->updateAction($this->input->post('cat_id'), $offset);
            }
        }
    }

    function updateAction($user_id, $offset)
    {
        $masterauth = new AuthModel();
        $data['error'] = $this->errors;
        $data['usersTypes'] = $this->CategoryModel->getAdminDetails($user_id);
        $data['title'] = "Update Category";
        $data['main_content'] = ADMIN_PATH . "categoryupdate_view";
        $data['offset'] = $offset;
        $data['mas_auth'] = $masterauth->getAllAuth();

        $this->load->view(ADMIN_PATH . 'incs/template', $data);
    }

    function changeStatus($id, $value, $offset)
    {
        $stat = "";
        $val = "";
        if ($value == 'active') {
            $val = 'Inactive';
            $stat = 'inactive';
        } else {
            $val = 'Active';
            $stat = 'active';
        }

        if ($this->CategoryModel->updateStatus($id, $stat)) {
            $this->MenuModel->updateStatus($id, 'category', $val);
            $this->session->set_flashdata("su_message", "Status Updated Successfully.");
        } else {
            $this->session->set_flashdata("su_message", "Status Updated Successfully.");
        }
        redirect(ADMIN_PATH . "category/show/$offset");
    }
}

?>