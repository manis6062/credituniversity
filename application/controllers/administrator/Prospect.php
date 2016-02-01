<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Prospect extends AdminController
{
    public function __construct()
    {
        parent::__construct(ADMIN, BROKER);
        $this->load->helper('general');
        $this->load->helper('url');
        checkAdminAuth();
        $this->load->library('pagination');
        $this->load->model('AuthModel');
        $this->load->helper('security');
        $this->load->model('ProspectModel');
        $this->load->helper(array('form', 'url', 'captcha'));

    }

    public function index()
    {
        $data['prospects'] = $this->ProspectModel->getProspects($this->session->userdata(BROKER_ID)?$this->session->userdata(BROKER_ID):$this->session->userdata(USER_ID));
        $data['roles'] = $this->RoleModel->getPublicRoles(SELECTX);
        $data['notes'] = $this->ProspectModel->getProspectNotesForBroker($this->userId);
        $data['main_content'] = ADMIN_PATH . "prospects";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }


    function prospectForm()
    {

        $data['title'] = "Prospects";
        $data['roles'] = $this->RoleModel->getRolesFor('radio');
        $data['brokers'] = $this->UserModel->getBrokers();
        $data['main_content'] = ADMIN_PATH . "prospectForm";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    public function addProspect()
    {
        try {
            if ($this->roleName = 'broker') {
               $inserted_id =  $this->ProspectModel->insertProspect($this->session->userdata(BROKER_ID)?$this->session->userdata(BROKER_ID):$this->session->userdata(USER_ID));
                $this->addProspectNotes($inserted_id);
            } else {
                echo "Need to switch role to broker to use this functionality";
            }
        } catch (Exception $e) {
            echo json_encode($this->handleDatabaseError($e));
            return;
        }
        redirect(base_url() . 'administrator/prospect');
    }

    function deleteProspect($prospectId)
    {
        try {
            $this->ProspectModel->deleteProspect($prospectId);
        } catch (Exception $e) {
            echo json_encode($this->handleDatabaseError($e));
            return;
        }
        redirect(ADMIN_PATH . "user/index", 'location');
    }

    function prospect($prospectId) {
        $data['prospect'] = $this->ProspectModel->getProspect($prospectId);
        $data['notes'] = $this->ProspectModel->getProspectNotes($prospectId);
        $data['brokers'] = $this->UserModel->getBrokers(SELECTX);
        $data['main_content'] = ADMIN_PATH . "prospect";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }


}

?>