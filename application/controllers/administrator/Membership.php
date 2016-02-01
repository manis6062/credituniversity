<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Membership extends AdminController
{
    public $errors = '';

    public function __construct()
    {
        parent::__construct(ADMIN);
        $this->load->helper('general');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('path');
        $this->load->helper('string');
        $this->load->model('CampaignModel');
        $this->load->model('AuthModel');
        $this->load->model('MembershipModel');
    }

    public function index()
    {
        $data['members'] = $this->MembershipModel->getMembers(SELECT);
        $data['main_content'] = ADMIN_PATH . "members";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }


    public function addMembershipType()
    {
        $roleId = $this->input->post('role');
        $levelId = $this->input->post('level');
        $membershipsTypes = $this->MembershipModel->checkDuplicateMembershipType($roleId, $levelId);
        if (!empty($membershipsTypes)) {

            $this->session->set_flashdata('message', '<font color="#FF0000">Duplicate Entry .</font>');
            redirect(ADMIN_PATH . "membership/membershipTypeForm");
        }
        else
        {
            try {
                $this->MembershipModel->insertMembershipType();
            } catch (Exception $e) {
                echo json_encode($this->handleDatabaseError($e));
                return;
            }

            redirect(ADMIN_PATH . "membership/membershipTypes");
        }
    }

    public function deleteMembershipType($id , $type)
    {
        try {
            $this->MembershipModel->deleteMembershipType($id , $type);
            redirect(ADMIN_PATH . "membership");
        } catch (Exception $e) {
            echo json_encode($this->handleDatabaseError($e));
            return;
        }
    }

    public function membershipTypeForm()
    {
        $this->load->helper(array('form', 'url'));
        $data['roles'] = $this->RoleModel->getMembershipRoles(SELECT);
        $data['levels'] = $this->MembershipModel->getMembershipLevels(SELECT);
        $data['statuses'] = $this->MembershipModel->getStatuses(SELECT);
        $data['main_content'] = ADMIN_PATH . "membershipTypeForm";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    public function membershipTypes()
    {
        $data['membershipTypes'] = $this->MembershipModel->getAllMembershipTypes();
        $data['roles'] = $this->RoleModel->getRoles(SELECTX);
        $data['levels'] = $this->MembershipModel->getMembershipLevels(SELECTX);
        $data['statuses'] = $this->MembershipModel->getStatuses(SELECTX);
        $data['main_content'] = ADMIN_PATH . "membershipTypes";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

}