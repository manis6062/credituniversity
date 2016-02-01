<?php

class MembershipModel extends AdminModel
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('date');
        $this->load->library('email');
        $this->load->model('RoleModel');

    }

    function getMemberships($userId, $widget = null)
    {
        $result = $this->db->query("SELECT m.user_id, r.name role, r.id roleId, ml.value membershipLevel, m.end_date, concat_ws(' ', ml.value, r.label) description,  mt.id, concat_ws('_', r.name, ml.name) membership
                                  FROM membership m
                                  JOIN membership_type mt on mt.id = m.type
                                  JOIN membership_level ml ON ml.id = mt.level
                                  JOIN role r ON r.id = mt.role where m.user_id = '$userId' ORDER BY r.id ASC")->result();
        return $this->widget($widget, $result, 'id', 'description', '');
    }

    function getMembership($userId, $role, $widget = null)
    {
        $result = $this->db->query("SELECT m.user_id, r.name role, m.end_date, concat_ws(' ', ml.value, r.label) description,  mt.id, concat_ws('_', r.name, ml.name) membership
                                  FROM membership m
                                  JOIN membership_type mt on mt.id = m.type
                                  JOIN membership_level ml ON ml.id = mt.level
                                  JOIN role r ON r.id = mt.role where m.user_id = '$userId' and r.name = '$role'")->result();
        return $result;
    }

    function getAllMembershipTypes($widget = null)
    {
        $result = $this->db->query("SELECT mt.id, mt.role role_id, mt.level level_id, mt.status status_id, mt.system_users sysuser,mt.client_users cliuser,mt.broker_users brouser, mt.owner_users ownuser, mt.prospect_users prouser , r.label role, ml.value level,  mt.price, s.value status,
                                        concat_ws(' ', r.label,ml.value , concat('$', mt.price)) description
                                        FROM membership_type mt
                                        JOIN role r ON r.id = mt.role
                                        JOIN membership_level ml ON ml.id = mt.level
                                        JOIN status s ON s.id = mt.status ORDER BY r.label , ml.value  ASC
                                        ")->result();
        return $this->widget($widget, $result, 'id', 'description', '');
    }

    function getMembershipTypes($role, $widget = null)
    {
        $result = $this->db->query("SELECT mt.id, mt.role role_id, mt.level level_id, mt.status status_id, r.label role, ml.value level,  mt.price, s.value status,
                                        concat_ws(' ', r.label,ml.value , concat('$', mt.price)) description
                                        FROM membership_type mt
                                        JOIN role r ON r.id = mt.role
                                        JOIN membership_level ml ON ml.id = mt.level
                                        JOIN status s ON s.id = mt.status
                                        WHERE r.name = '$role'
                                        ORDER BY r.label , ml.value  ASC
                                        ")->result();
        return $this->widget($widget, $result, 'id', 'description', '');
    }

    function getMembershipTypeByRoleCost($role, $cost)
    {
        return $this->db->query("select * from membership_type mt where mt.id = '$role' and mt.price = '$cost'")->row();
    }


    function getMembershipTypeByRole($roleId){
        return $this->db->query("SELECT mt.* FROM membership_type mt LEFT JOIN membership_level ml
                                      ON mt.level = ml.id
                                      WHERE ml.name='platinum'
                                      AND mt.role = $roleId")->row();
    }

    function getMembershipLevels($widget = null)
    {
        $result = $this->db->query("SELECT ml.id, ml.value FROM membership_level ml")->result();
        return $this->widget($widget, $result, 'id', 'value', 'Billing Cycle');

    }

    function insertMembershipType()
    {
        $data = array(
            'role' => $this->input->post('role'),
            'level' => $this->input->post('level'),
            'system_users' => $this->input->post('system_users'),
            'client_users' => $this->input->post('client_users'),
            'broker_users' => $this->input->post('broker_users'),
            'owner_users' => $this->input->post('owner_users'),
            'prospect_users' => $this->input->post('prospect_users'),
            'price' => $this->input->post('price'),
            'status' => $this->input->post('status')
        );
        $this->db->insert('membership_type', $data);
    }

    function deleteMembershipType($id , $type)
    {
        $this->db->where('user_id', $id);
        $this->db->where('type', $type);
        $this->db->delete('membership');
    }

    function getMembers()
    {
        return $this->db->query("SELECT m.user_id,
                                      concat_ws(' ', p.first_name, p.last_name) name,
                                      m.type,
                                      m.type as type_id,
                                      m.status,
                                      r.label role,
                                      ml.value type,
                                      m.type membershipTypeId
                                      FROM membership m
                                      JOIN profile p ON p.user_id = m.user_id
                                      JOIN membership_type mt ON mt.id = m.type
                                      JOIN membership_level ml ON ml.id = mt.level
                                      JOIN role r ON r.id = mt.role
                                      JOIN status s ON s.id = m.status
                                      ")->result();
    }

    public function insertMembershipUser($userId, $membershipTypeId, $endDate)
    {
        // $membership = $this->db->query("SELECT mt.role FROM membership_type mt where mt.id = '$membershipTypeId'")->row();
        $data = array(
            'user_id' => $userId,
            'type' => $membershipTypeId,
            'tips_access' => 0,
            'campaign' => $campaignId,
            'start_date' => date("Y-m-d"),
            'end_date' => $endDate,
            'status' => 1,
        );
        $this->db->insert('membership', $this->data($data));
    }

    public function insertMembership($userId, $membershipTypeId, $campaignId)
    {
        $data = array(
            'user_id' => $userId,
            'type' => $membershipTypeId,
            'campaign' => $campaignId,
            'start_date' => date("Y-m-d"),
            'end_date' => date('Y-m-d', strtotime('+1 months')),
            'status' => 1,
        );
        $this->db->insert('membership', $this->data($data));
    }

    function insertMembershipSystemUser($userId, $membershipTypeId, $campaignId, $status, $start, $end, $parent)
    {
        $data = array(
            'user_id' => $userId,
            'type' => $membershipTypeId,
            'campaign' => $campaignId,
            'start_date' => $start,
            'end_date' => $end,
            'status' => $status,
            'parent' => $parent,
            'sys_admin_id' => $this->session->userdata(BROKER_ID) ? $this->session->userdata(USER_ID) : ''
        );
        $this->db->insert('membership', $this->data($data));
    }

    function upgradeMembership($userId, $membershipInfo)
    {
        list($membership, $typeId, $campaignId, $oldTypeId) = explode('-', $membershipInfo);
        if($oldTypeId) {
            $data = array(
                'user_id' => $userId,
                'type' => $typeId,
                'campaign' => $campaignId,
                'start_date' => date('Y-m-d'),
                'end_date' => date('Y-m-d', strtotime('+1 months')),
                'status' => 1,
            );
            $this->db->where('user_id', $userId);
            $this->db->where('type', $oldTypeId);
            $this->db->update('membership', $this->data($data));
        }
        else{
            $this->insertMembership($userId, $typeId, $campaignId);
        }

    }

    function upgradeMembershipFree($userId, $membershipTypeId, $campaignId, $oldMembershipTypeId)
    {
        if ($oldMembershipTypeId) {
            $data = array(
                'user_id' => $userId,
                'type' => $membershipTypeId,
                'campaign' => $campaignId,
                'start_date' => date('Y-m-d'),
                'end_date' => date('Y-m-d', strtotime('+1 months')),
                'status' => 1,
            );
            $this->db->where('user_id', $userId);
            $this->db->where('type', $oldMembershipTypeId);
            $this->db->update('membership', $this->data($data));
        } else {
            $this->insertMembership($userId, $membershipTypeId, $campaignId);
        }

    }

    public function insertFreeMembership($userId, $membershipTypeId, $endDate, $campaignId)
    {
        $data = array(
            'user_id' => $userId,
            'type' => $membershipTypeId,
            'campaign' => $campaignId,
            'start_date' => date('Y-m-d'),
            'end_date' => $endDate,
            'status' => 1,
        );
        $this->db->insert('membership', $this->data($data));
        $this->db->update('user', array('status' => 1));
    }

    function insertInactiveMember($userId, $membershipTypeId, $endDate, $campaignId)
    {
        $data = array(
            'user_id' => $userId,
            'type' => $membershipTypeId,
            'campaign' => $campaignId,
            'start_date' => date('Y-m-d'),
            'end_date' => $endDate,
            'status' => 0,
        );
        $this->db->insert('membership', $this->data($data));
        $this->db->where('id', $userId);
        $this->db->update('user', array('status' => 1));
    }

    public function updateFreeMembership($userId, $membershipTypeId, $endDate, $campaignId)
    {
        $data = array(
            'user_id' => $userId,
            'type' => $membershipTypeId,
            'campaign' => $campaignId,
            'start_date' => date('Y-m-d'),
            'end_date' => $endDate,
            'status' => 1,
        );
        $this->db->update('membership', $this->data($data));
        $this->db->update('user', array('status' => 1));
    }

    function membershipExist($userId)
    {
        return $this->db->query("SELECT * FROM membership WHERE user_id = $userId")->result();
    }

    function getMembershipTypeById($typeId, $roleId)
    {
        return $this->db->query("SELECT mt.id tid,mt.*, ml.* FROM membership_type mt LEFT JOIN membership_level ml ON mt.level = ml.id WHERE mt.id = $typeId AND mt.role = $roleId")->row();
    }

    function getMembershipLevelById($userId)
    {
        return $this->db->query("SELECT
                                ml.value
                                FROM membership m
                                LEFT JOIN membership_type mt ON m.type = mt.id
                                LEFT JOIN membership_level ml ON mt.`level` = ml.id
                                WHERE m.user_id = $userId")->row()->value;
    }

    function getMembershipLevelBuy($typeId, $roleId)
    {
        return $this->db->query("SELECT ml.value FROM membership_type mt JOIN membership_level ml ON mt.level = ml.id JOIN role r ON mt.role=r.id WHERE mt.id= $typeId AND r.name='$roleId'")->row()->value;
    }

    function getMembershipRolesByUserId($userId)
    {
        return $this->db->query("SELECT r.id, r.name,r.label
                                  FROM membership m
                                  LEFT JOIN membership_type mt
                                  ON m.type = mt.id
                                  LEFT JOIN role r
                                  ON mt.role = r.id
                                  WHERE m.user_id = $userId")->result();
    }

    function getMaxUserLimit($brokerId, $roleName)
    {
        return $this->db->query("SELECT mt.system_users, mt.client_users, mt.broker_users, mt.owner_users,mt.prospect_users
                                    FROM membership m
                                    LEFT JOIN membership_type mt
                                    join role r on r.id = mt.role
                                    ON m.type= mt.id
                                    WHERE m.user_id =$brokerId AND r.name='$roleName'")->row();
    }

    function countMemberUsers($brokerId)
    {
        return $this->db->query("SELECT DISTINCT m.user_id
                                    FROM membership m
                                    WHERE m.parent =$brokerId")->result();
    }

    function checkSystemUserLimit($brokerId, $roleId)
    {
        $maxUser = $this->getMaxUserLimit($brokerId, BROKER);
        $totalUser = $this->countMemberUsers($brokerId);
        if ($maxUser->system_users > count($totalUser))
            return TRUE;
        else
            return FALSE;

    }

    function getMembershipByRole($roleId)
    {
        return $this->db->query("SELECT mt.id mtId, CONCAT_WS(' ' ,ml.value, concat('$', mt.price)) memberType, ml.*, mt.*
                                  FROM membership_level ml
                                  LEFT JOIN membership_type mt ON mt.level = ml.id
                                  WHERE mt.role = '$roleId'")->result();
    }

    function checkMembership($email)
    {
        return $this->db->query("select count(*) count from membership m where m.user_id = (select u.id from user u where u.email = '$email')")->row()->count;
    }

    function checkDuplicateMembershipType($roleId, $levelId)
    {
        return $this->db->query("select * from membership_type mt where mt.role = '$roleId' and mt.level = '$levelId'")->row();
    }

    function activateMembership($membershipId)
    {
        $this->db->where('user_id', $membershipId);
        $this->db->update('membership', array('status' => 1));
    }

    function insertMembershipToken($membershipId , $token){
        $this->db->where('user_id' , $membershipId);
        $this->db->update('membership' , array('token' => $token));
    }

    function membershipUpgradeFree($membershipTypeId, $coupon, $oldMembership)
    {
        $campaign = $this->CampaignModel->getCampaignDetailByCoupon($coupon);
        if ($oldMembership) {

        }
        $userPick = $this->CampaignModel->getItems($campaignId, $membershipTypeId);
        $this->MembershipModel->insertInactiveMember($userId, $membershipTypeId, $campaign->end, $campaignId);
        $transactionId = $this->PaymentModel->insertInactiveTransaction($userId, $paymentType);
        $this->PaymentModel->insertInactiveTransactionDetail($transactionId, $userPick->price);
        if ($campaign->percentage == 100) {
            $this->MembershipModel->activateMembership($userId);
            $prospectEmail = $this->UserModel->getEmailAddress($userId);
            $this->ProspectModel->inactiveProspect($prospectEmail);
        }

        $this->session->set_flashdata('memberRegistered', "Congratulations! You have successfully signed up. Please Log in.");
        redirect(base_url() . 'member');


    }

}