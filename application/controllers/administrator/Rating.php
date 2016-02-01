<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rating extends CI_Controller
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
        $config['per_page'] = '10';
        $config['uri_segment'] = '4';
        $offset = $this->uri->segment(4, 0);
        $data['rateList'] = $this->RateModel->getAll($config['per_page'], $offset);
        $data['title'] = "List Story Rating";
        $data['main_content'] = ADMIN_PATH . "rate_view";
        $this->load->view(ADMIN_PATH . 'incs/template', $data);
    }

    function viewDetail($id)
    {
        $data['rateList'] = $this->RateModel->getData($id);

        $data['title'] = "Rating Detail";
        $data['main_content'] = ADMIN_PATH . "ratedetail_view";
        $this->load->view(ADMIN_PATH . 'incs/template', $data);
    }

    function viewBriefDetail($id)
    {
        $data['rateList'] = $this->RateModel->getDataDetail($id);

        $data['title'] = "Rating Detail";
        $data['main_content'] = ADMIN_PATH . "ratebriefdetail_view";
        $this->load->view(ADMIN_PATH . 'incs/template', $data);
    }
}

?>