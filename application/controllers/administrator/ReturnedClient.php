<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ReturnedClient extends CI_Controller
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
        $this->load->helper('general');
        $this->load->model('ReturnedClientModel');
        $this->load->model('AuthModel');
        $this->load->model('AffiliateModel');
        checkAdminAuth();
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
        $user_id = $this->session->userdata(USER_ID);
        $ref_details = $this->AffiliateModel->getSingleUsers($user_id);
        $ref_id = $ref_details->affiliate_id;
        $data['returned_client_list'] = $this->ReturnedClientModel->getAll($ref_id);
        $data['allowed'] = $this->allowed;
        $data['error'] = $this->errors;
        $data['usertype'] = checkUserType();
        $data['title'] = "List of Returned Clients";
        $data['main_content'] = ADMIN_PATH . "returned_client_view";
        $this->load->view(ADMIN_PATH . 'incs/template', $data);
    }


}

?>