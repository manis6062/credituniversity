<?php

class RoleModel extends AdminModel
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('date');
        $this->load->library('email');
        $this->load->model('RoleModel');

    }

    function  getAllRoles()
    {
        $query = $this->db->query("SELECT * FROM role");
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return 0;
    }

    function deleteUsersFromRole($roleId)
    {
        $email = $this->db->query("select u.email from user_role ur JOIN user u on u.id = ur.user_id where ur.role_id = $roleId")->result();
        $roles = $this->db->delete('user_role', array('role_id' => $roleId));
        $this->populateRolesInSession($email);
        return $roles;
    }

    function  getUsersByRoleId($roleId)
    {
        $query = $this->db->query("SELECT concat(p.first_name,' ',p.last_name) name, ur.user_id, r.label, r.id, (SELECT u.email FROM user u WHERE u.id = ur.user_id) email
                                  FROM user_role ur LEFT JOIN  profile p ON p.user_id = ur.user_id
                                  LEFT JOIN role r ON r.id = ur.role_id WHERE role_id = ?", array($roleId));
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return 0;
    }

    function insertRoles()
    {
        $data = array(
            'name' => $this->input->post('name'),
            'label' => $this->input->post('label'),
            'public' => $this->input->post('public'));
        $this->db->insert('role', $this->security->xss_clean($data));
    }

    function getRoles($widget = null)
    {
        $this->db->select('r.id, r.name, r.label, r.public');
        $this->db->from('role r');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        $result = $query->result();
        return $this->widget($widget, $result, 'id', 'label', 'Role');
    }

    function getMembershipRoles($widget = null)
    {
        $result = $this->db->query("SELECT r.id, r.name, r.label, r.public FROM role r WHERE r.name != 'super_admin' AND r.name != 'admin' ORDER BY r.id ASC")->result();
        return $this->widget($widget, $result, 'id', 'label', 'Role');
    }

    function getRoleRoleLabel()
    {
        $result = $this->db->query("SELECT r.id, r.label FROM role r")->result();
        $roles = array();
        foreach ($result as $role) {
            $roles{$role->id} = $role->label;
        }
        return $roles;
    }

    function getRoleAuthArray()
    {
        $query = $this->db->query("SELECT r.label, r.id role_id, a.id auth_id FROM role r  LEFT JOIN role_auth ra ON ra.role_id = r.id LEFT JOIN auth a ON a.id = ra.auth_id");
        if ($query->num_rows() > 0) {
            $result = array();
            foreach ($query->result() as $row) {
                $result[$row->role_id][] = $row->auth_id;
            }
            return $result;
        }
    }

    function getPublicRoles($widget = null)
    {
        $this->db->select('*');
        $this->db->from('role');
        $this->db->where('public', 1);
        $this->db->order_by('id', 'ASC');
        $result = $this->db->get()->result();
        return $this->widget($widget, $result, 'id', 'label', '');
    }

    function getRolesFor($widget)
    {
        switch ($widget) {
            case "radio":
                $result = $this->db->query("SELECT r.id, r.label FROM role r WHERE r.public = 1")->result();
                $roles = array();
                foreach ($result as $role) {
                    $roles[$role->id] = $role->label;
                }
                return $roles;
                break;
        }

    }


    function deleteRole($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('role');
    }

    function updateRole($id)
    {
        $data = array('value' => trim($this->input->post('value')),
            'label' => trim($this->input->post('label'))
        );
        $this->db->where("id", $id);
        $this->db->update('role', $this->security->xss_clean($data));
    }

    function getRolesByUserId($user_id)
    {
        $query = $this->db->query("SELECT ur.user_id , ur.role_id , r.id ,r.name
		from user_role ur INNER JOIN role r on ur.role_id = r.id where ur.user_id = $user_id ");
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return false;

    }


    function getNonPublicRolesByUserId($userId){
        return $this->db->query("select r.id, r.name, r.label
                                  from user_role ur
                                  LEFT JOIN user u on u.id = ur.user_id
                                  LEFT JOIN  role r on r.id = ur.role_id where u.id = '$userId' AND r.public=0
                                  ORDER BY r.sequence ASC")->result();
    }

    function getUserRolesByUserId($userId)
    {
        $query =  $this->db->query("select  r.name
                                  from user_role ur
                                  LEFT JOIN user u on u.id = ur.user_id
                                  LEFT JOIN  role r on r.id = ur.role_id where u.id = '$userId'
                                  ORDER BY r.sequence ASC")->result();
        foreach($query as $role){
            $roles[] = $role->name;
        }
        return $roles;
    }

    function hasUserRole($userId, $roleId, $roleName)
    {
        $query = "SELECT ur.role_id
		from user_role ur INNER JOIN role r on ur.role_id = r.id where ur.user_id = '$userId' and ";
        if ($roleId) {
            $query .= "ur.role_id = '$roleId' ";
        } else {
            $query .= "ur.role_name = '$roleName'";
        }
        return $this->db->query("{$query}")->num_rows();
    }

    function getUserIdRoleIdAssociative($user_id)
    {
        $query = $this->db->query("SELECT ur.role_id
		from user_role ur LEFT JOIN role r on ur.role_id = r.id where ur.user_id = $user_id ");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else
            return false;
    }


    function getRolesConcatByUserId($user_id)
    {
        $query = $this->db->query("SELECT GROUP_CONCAT(ur.role_id) as role_id
		from user_role ur INNER JOIN role r on ur.role_id = r.id where ur.user_id = $user_id
		");
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return false;

    }


    function getRolesByRoleId($role_id)
    {
        $query = $this->db->query("SELECT * FROM user_role WHERE role_id = $role_id");
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return 0;
    }

    function getRoleIdByRoleName($roleName)
    {
        $query = $this->db->query("SELECT r.id FROM role r WHERE r.name = '$roleName'");
        if ($query->num_rows() > 0) {
            return $query->row()->id;
        }
        return 0;
    }

    function insertUserRoles($userId, $rolesIds)
    {
        foreach ($rolesIds as $key => $role_id) {
            $this->RoleModel->inserUserRole($userId, $role_id, 1);
        }
    }

    function insertUserRole($userId, $roleId)
    {
        $data = array(
            "user_id" => $userId,
            "role_id" => $roleId,
            "status" => 1
        );
        $this->db->insert('user_role', $data);
    }

    function inserUserRole($userId, $roleId, $status)
    {

        if(empty($roleId)){
            $data1 = array(
                "user_id" => $userId,
                "role_id" => 2,
                "status" => 1
            );
        }else{


            $data1 = array(
                "user_id" => $userId,
                "role_id" => $roleId,
                "status" => 1
            );

        }
        $this->db->insert('user_role', $this->security->xss_clean($data1));
    }

    function getRoleNameByRoleId($roleId)
    {
        return $this->db->query("SELECT r.name FROM role r WHERE r.id = '$roleId'")->row()->name;
    }


    function updateSessionValue($uid)
    {
        $roleResult = $this->db->query("select r.name, r.label from user_role ur LEFT JOIN user u on u.id = ur.user_id LEFT JOIN  role r on r.id = ur.role_id where u.id = $uid ")->result();
        $roles = array();
        foreach ($roleResult as $role) {
            $roles[$role->name] = $role->label;
        }
        $this->session->set_userdata(ROLES, $roles);
    }

    public function populateRolesInSession($emails)
    {
        $email = $this->session->userdata(EMAIL);
        if ((is_array($email) and in_array($email, $emails)) or $emails == $email) {
            $roleResult = $this->getRolesByEmail($email);
            $roles = array();
            foreach ($roleResult as $role) {
                $roles[$role->name] = $role->label;
            }
            $this->session->set_userdata(ROLES, $roles);
        }
    }

    function getRoleWithEmail($email)
    {
        return $this->db->query("select ur.role_id, r.name, r.label from user_role ur LEFT JOIN user u on u.id = ur.user_id LEFT JOIN  role r on r.id = ur.role_id where u.email = '$email'")->row();
    }

    function getRolesWithMembership($userId)
    {
        $query =  $this->db->query("SELECT DISTINCT
                                    role.`name`
                                    FROM
                                    `user`
                                    INNER JOIN membership ON `user`.id = membership.user_id
                                    INNER JOIN membership_type ON membership.type = membership_type.id
                                    INNER JOIN role ON membership_type.role = role.id
                                    where `user`.id = '$userId'")->result();
        foreach($query as $role){
            $roles[] = $role->name;
        }
        return $roles;
    }

    function getAdminRoles($userId){
        $query =  $this->db->query("SELECT
                                    role.`name`
                                    FROM
                                    `user`
                                    INNER JOIN user_role ON `user`.id = user_role.user_id
                                    INNER JOIN role ON user_role.role_id = role.id
                                    WHERE user_id = '$userId'")->result();
        foreach($query as $role){
            $roles[] = $role->name;
        }
        return $roles;

    }

}