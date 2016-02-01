<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Campaign extends AdminController
{
    public $errors = '';

    public function __construct()
    {
        parent::__construct(BROKER, ADMIN);
        $this->load->helper('general');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('path');
        $this->load->helper('string');
        $this->load->model('CampaignModel');
        $this->load->model('NewsletterModel');
        $this->load->model('AuthModel');
    }

    public function index()
    {
        $data['campaigns'] = $this->CampaignModel->getCampaigns();
        $data['campaignTypes'] = $this->CampaignModel->getCampaignTypes(SELECTX);
        $data['statuses'] = $this->CampaignModel->getStatuses(SELECTX);
        $data['main_content'] = ADMIN_PATH . "campaigns";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }


    public function addCampaign()
    {
        try {
            $this->CampaignModel->insertCampaign();
        } catch (Exception $e) {
            echo json_encode($this->handleDatabaseError($e));
            return;
        }
        redirect(ADMIN_PATH . "campaign");
    }

    public function deleteCampaign($id)
    {
        try {
            $this->CampaignModel->deleteCampaign($id);
            redirect(ADMIN_PATH . "campaign");
        } catch (Exception $e) {
            echo json_encode($this->handleDatabaseError($e));
            return;
        }
    }

    public function campaignForm()
    {
        $this->load->helper(array('form', 'url'));
        $data['campaignTypes'] = $this->CampaignModel->getCampaignTypes(SELECT);
        $data['statuses'] = $this->CampaignModel->getStatuses(SELECT);
        $data['main_content'] = ADMIN_PATH . "campaignForm";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    public function getCampaignDetails()
    {
        $campaignId = $this->NewsletterModel->getCampaignId($_POST['templateId']);
        if ($campaignId) {
            $campaignName = $this->CampaignModel->getCampaignName($campaignId)->name;
            $campaignType = $this->CampaignModel->getCampaignName($campaignId)->label;
            $campaignDetails = $this->CampaignModel->getCampaignDetails($campaignId);
            $details = array();

            $details[] = 'Campaign Type : ' . $campaignType;
            $details[] = 'Name : ' . $campaignName;
            $details[] = '';
            foreach ($campaignDetails as $key => $value) {
                $details[] = $value->description;
            }
            echo json_encode($details);
        } else {
            echo json_encode("");
        }
    }

}