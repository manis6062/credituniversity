<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Application extends AdminController
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

    function  addCreditApplication()
    {
        try {
            $this->UserModel->insertCreditApplication();

        } catch (Exception $e) {
            echo json_encode($this->handleDatabaseError($e));
            return;
        }
        redirect(base_url() . "administrator/application/creditapplications/" . $this->input->post('user_id'));
    }

    function deleteCreditApplication()
    {
        try {
            $this->UserModel->deleteCreditApplication();
        } catch (Exception $e) {
            echo json_encode($this->handleDatabaseError($e));
            return;
        }
        redirect(base_url() . "administrator/application/creditapplications/" . $this->input->post('user_id'));

    }

    function creditApplications($user_id)
    {
        $data['credit'] = $this->UserModel->getCreditApplication($user_id);
        $data['userId'] = $this->session->userdata(USER_ID);
        $data['title'] = "Credit Application  Details";
        $data['main_content'] = ADMIN_PATH . 'creditapplications';
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }


}
