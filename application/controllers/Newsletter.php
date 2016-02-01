<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Newsletter extends CI_Controller
{


    public function __construct()
    {
        parent::__construct(BROKER);
        $this->load->helper('general');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('path');
        $this->load->helper('string');
        $this->load->model('NewsLetterModel');
        $this->load->model('CampaignModel');
        $this->load->model('UserModel');

    }


    function view($templateId,$userId,$campaignId)
    {
        if($userId!=0) {
            $userInfo = $this->db->query("Select * from profile where user_id=$userId")->row();
            $full_name = $userInfo->first_name . ' ' . $userInfo->last_name;
        }
        else{
            $userId = 0;
            $full_name = 'Sir/Madam';
        }
        $data['code'] = $this->getInterpretedNewsLetterTemplate($templateId, $full_name, $userId, $campaignId);
        $data['main_content'] = ADMIN_PATH . "newsletter_view";
        $this->load->view(ADMIN_PATH . 'inc/blank', $data);
    }

    public
    function getInterpretedNewsLetterTemplate($templateId, $full_name='', $userId, $campaignId)
    {
        $couponInfo = $this->CampaignModel->getCampaignDetailById($campaignId);
        $code = $this->NewsLetterModel->getTemplate($templateId);
        $code = str_replace("%full_name%", $full_name, $code);
        $code = str_replace("%coupon%", $couponInfo->coupon, $code);
        $template = base_url() . 'newsletter/view/' . $templateId.'/'. $userId . '/' . $campaignId;
        $code = str_replace("%template%", $template, $code);
        $signUp = base_url() . 'register/signUp/'.$couponInfo->brokerId;
        $code = str_replace("%signup%", $signUp, $code);
        return $code;
    }
}
