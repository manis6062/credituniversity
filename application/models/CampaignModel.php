<?php

class CampaignModel extends AdminModel
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('date');
        $this->load->library('email');
        $this->load->model('UserModel');
        $this->load->helper('string');
    }

    function insertCampaign()
    {
        $data = array(
            'coupon' => strtoupper(random_string('alnum', 6)),
            'type' => $this->input->post('type'),
            'name' => $this->input->post('name'),
            'percentage' => $this->input->post('percentage'),
            'status' => $this->input->post('status'),
            'start' => $this->formatDate($this->input->post('start')),
            'end' => $this->formatDate($this->input->post('end')),
            'duration' => $this->input->post('duration'),
            'brokerId' => $this->session->userdata(BROKER_ID)?$this->session->userdata(BROKER_ID):$this->session->userdata(USER_ID)
        );
        $this->db->insert('campaign', $this->data($data));
    }

    function getCampaigns($widget = null)
    {
        $result = $this->db->query("SELECT c.id, c.type type_id, ct.label type, c.name, c.percentage, c.duration, c.amount, c.status status_id, s.value status, c.coupon, c.start, c.end,
                                      concat_ws(' ',concat(c.coupon, ' - '), ct.label, c.name) description
                                      FROM campaign c
                                      JOIN campaign_type ct ON ct.id = c.type
                                      JOIN status s ON s.id = c.status
                                  ")->result();
        return $this->widget($widget, $result, 'id', 'description', '');
    }

    function getCampaignTypes($widget = null)
    {
        $result = $this->db->query("SELECT ct.id, ct.label FROM campaign_type ct")->result();
        return $this->widget($widget, $result, 'id', 'label', 'Select a Campaign Type');
    }

    function getUserCampaigns($userId, $widget = null)
    {
        $result = $this->db->query("SELECT c.id, c.type type_id, ct.label type, c.name, c.percentage,  c.duration, c.amount, c.status status_id, s.value status, c.coupon, c.start, c.end
                                      FROM campaign c
                                      JOIN campaign_type ct ON ct.id = c.type
                                      JOIN status s ON s.id = c.status
                                      JOIN membership m ON m.campaign = c.id
                                      where m.user_id = '$userId'
                                  ")->result();
        return $this->widget($widget, $result, 'id', 'name', '');
    }


    function deleteCampaign($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('campaign');
    }

    function checkFreeRegistration($campaignId)
    {
        $campaign = $this->db->query("SELECT ct.type, ct.role, c.amount, c.percentage, c.duration, c.start, c.end
                                                FROM campaign c
                                                JOIN campaign_type ct ON ct.id = c.type
                                                WHERE c.id = '$campaignId';")->row();


        if ($campaign->type == 'Registration') {
            $result = $this->db->query("SELECT mt.id, (mt.price - (CASE WHEN !'$campaign->percentage' THEN '$campaign->amount' ELSE (mt.price * ('$campaign->percentage') / 100) END)) price
                                      FROM membership_type mt
                                      JOIN membership_level ml ON ml.id = mt.level
                                      JOIN role r ON r.id = mt.role
                                      WHERE mt.role = '$campaign->role'")->result();
            return array($campaign, $result);
        }
    }

    function getItems($campaignId, $membershipTypeId)
    {
        $campaign = $this->db->query("SELECT ct.type, ct.role, c.amount,  c.duration, c.duration, c.percentage FROM campaign c
                                                JOIN campaign_type ct ON ct.id = c.type
                                                WHERE c.id = '$campaignId';")->row();


        if ($campaign->type == 'Registration') {
            return $this->db->query("SELECT ml.value, ROUND((mt.price - (CASE WHEN !'$campaign->percentage' THEN '$campaign->amount' ELSE (mt.price * ('$campaign->percentage') / 100) END)),2) price,
                                        r.name role, concat_ws(' ', ml.value,  r.label) description
                                      FROM membership_type mt
                                      JOIN membership_level ml ON ml.id = mt.level
                                      JOIN role r ON r.id = mt.role WHERE mt.id = '$membershipTypeId';")->row();
        }
    }

    function getCampaignDetails($id, $widget = null)
    {
        $campaign = $this->db->query("SELECT ct.type, ct.role, c.amount, c.duration, c.percentage, c.start, c.end
                                                FROM campaign c
                                                JOIN campaign_type ct ON ct.id = c.type
                                                WHERE c.id = '$id';")->row();


        if ($campaign->type == 'Registration') {
            $result = $this->db->query("SELECT mt.id,
                                          concat_ws(' - $', ml.value, ROUND((mt.price - (CASE WHEN !'$campaign->percentage' THEN '$campaign->amount' ELSE (mt.price * ('$campaign->percentage') / 100) END)),2)) description
                                      FROM membership_type mt
                                      JOIN membership_level ml ON ml.id = mt.level
                                      JOIN role r ON r.id = mt.role
                                      WHERE mt.role = '$campaign->role' and ml.name != 'free';")->result();
            return $this->widget($widget, $result, 'id', 'description', '');
        }
    }

    function getCampaignName($campaignId)
    {
        return $this->db->query("select c.name, ct.label from campaign c
                                    JOIN campaign_type ct on ct.id = c.type
                                    where c.id = $campaignId")->row();
    }

    function getRoleIdByCouponCode($coupon){
        return $this->db->query("SELECT ct.* FROM campaign_type ct LEFT JOIN campaign c ON c.type = ct.id
                                  WHERE c.coupon ='$coupon'")->row();
    }

    function getCampaignDetailsForBasicRole($roleId, $widget = null)
    {
        $campaign = $this->db->query("SELECT ct.type, ct.role, c.amount, c.duration, c.percentage, c.start, c.end, c.id
                                                FROM campaign c
                                                JOIN campaign_type ct ON ct.id = c.type
                                                WHERE ct.role = '$roleId' and (c.percentage  IS  NULL or c.percentage = 0) ;")->row();
        $this->session->set_userdata('campaign', $campaign->id);

        if ($campaign->type == 'Registration') {
            $result = $this->db->query("SELECT mt.id,
                                          concat_ws(' - $', ml.value, ROUND((mt.price - (CASE WHEN !'$campaign->percentage' THEN '$campaign->amount' ELSE (mt.price * ('$campaign->percentage') / 100) END)),2)) description
                                      FROM membership_type mt
                                      JOIN membership_level ml ON ml.id = mt.level
                                      JOIN role r ON r.id = mt.role
                                      WHERE mt.role = '$campaign->role';")->result();
            return $this->widget($widget, $result, 'id', 'description', '');
        }
    }

    function getCouponsDetails($userId)
    {
        return $this->db->query("SELECT campaign_type.name,campaign_type.label,campaign_type.type, campaign.duration,campaign.coupon
                                FROM membership
                                LEFT JOIN campaign ON campaign.id = membership.campaign
                                LEFT JOIN campaign_type ON campaign_type.id = campaign.type
                                WHERE
                                membership.user_id = $userId")->row();
    }

    function getCampaignIdByCode($campaignCode, $roleId)
    {
        return $this->db->query("SELECT c.id
                                      FROM campaign c
                                      LEFT JOIN campaign_type ct
                                      ON c.type = ct.id
                                      WHERE c.coupon = '$campaignCode' AND ct.role = $roleId ")->row()->id;
    }


    function getCouponCodeById($campaignId)
    {
        return $this->db->query("SELECT c.coupon
                                      FROM campaign c
                                      WHERE c.id = '$campaignId' ")->row()->coupon;
    }

    function getCampaignDetailById($campaignId)
    {
        return $this->db->query("SELECT * FROM campaign WHERE id = $campaignId")->row();
    }

    function getCampaignDetailByCoupon($coupon)
    {
        return $this->db->query("SELECT * FROM campaign WHERE coupon = '$coupon'")->row();
    }

    function checkCouponRoleMatch($roleId, $coupon)
    {
        return $this->db->query("select c.percentage from campaign c
                                  LEFT JOIN campaign_type ct ON c.type= ct.id
                                    WHERE ct.role=$roleId AND c.coupon = '$coupon'
                                    AND (c.start IS NULL OR c.start <= sysdate())
                                    AND (c.end IS NULL OR c.end >= SYSDATE())
                                    AND c.status = 1")->row()->percentage;
    }

    function checkCouponRoleMatchDiscount($membershipTypeId, $coupon)
    {
        if($membershipTypeId && $coupon) {
            return $this->db->query("select c.percentage from campaign c
                                  LEFT JOIN campaign_type ct ON c.type= ct.id
                                  LEFT JOIN membership_type mt ON mt.role = ct.role
                                    WHERE mt.id=$membershipTypeId AND c.coupon = '$coupon'
                                    AND (c.start IS NULL OR c.start <= sysdate())
                                    AND (c.end IS NULL OR c.end >= SYSDATE())
                                    AND c.status = 1")->row()->percentage;
        }
        else
            return false;
    }

    function getTrailCampaign($userId){
        $result = $this->db->query("SELECT m.start_date, c.duration FROM membership m
                                    LEFT JOIN campaign c ON m.campaign = c.id
                                    WHERE m.user_id = $userId
                                    AND m.status = 1 LIMIT 1 ")->row();

        if($result->duration!=null) {
            $this->session->userdata('popUp');
            $start = date('Y-m-d', strtotime($result->start_date));
            $membershipDate = new DateTime($start);
            $today = new DateTime(date('Y-m-d'));
            $validDate = $membershipDate->modify("+" . $result->duration . " days");
            $remainingDays = $today->diff($validDate);
            if ($remainingDays->format('%R') . $remainingDays->days > 0) {
                return $remainingDays->days;
            }
            else{
                return 'disabled';
            }
        }
        else{
            return false;
        }

    }

    function getFullFeeCouponInfo($membershipTypeId){
        if($membershipTypeId) {
            return $this->db->query("select c.* from campaign c
                                  LEFT JOIN campaign_type ct ON c.type= ct.id
                                  LEFT JOIN membership_type mt ON mt.role = ct.role
                                    WHERE mt.id=$membershipTypeId AND (c.percentage IS NULL OR c.percentage=0)
                                    AND (c.start IS NULL OR c.start <= sysdate())
                                    AND (c.end IS NULL OR c.end >= SYSDATE())
                                    AND c.status = 1")->row();
        }
        else{
            return false;
        }
    }

    function getCampaignInfoByCode($coupon){
        $roleId = $this->db->query("select ct.role roleId from campaign c
                                  LEFT JOIN campaign_type ct ON c.type= ct.id
                                    WHERE c.coupon='$coupon' AND (c.percentage=100)
                                    AND (c.start IS NULL OR c.start <= sysdate())
                                    AND (c.end IS NULL OR c.end >= SYSDATE())
                                    AND c.status = 1")->row()->roleId;
        if($roleId) {
            $membershipInfo = $this->MembershipModel->getMembershipTypeByRole($roleId);
            $membershipTypeId = $membershipInfo->id;
            return array('roleId' => $roleId, 'membershipTypeId' => $membershipTypeId);
        }
        else
            return false;
    }
}

?>