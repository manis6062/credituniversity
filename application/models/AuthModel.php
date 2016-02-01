<?php

class AuthModel extends AdminModel
{
    function getAuthDetails($auth_id)
    {
        $query = $this->db->get_where('auth', array('id' => $auth_id));
        if ($query->num_rows() == 0) {
            return 0;
        } else {
            return $query->row();
        }
    }

    function getAllAuth()
    {
        $query = $this->db->query("SELECT
                                    nc_auth_master.auth_id,
                                    nc_auth_master.auth_name,
                                    nc_auth_master.auth_label,
                                    nc_auth_master.`status`,
                                    nc_auth_master.module
                                    FROM
                                    nc_auth_master
                                    WHERE
                                    nc_auth_master.`status` = 'Publish' 
                                    AND nc_auth_master.module IN (SELECT modules FROM nc_module_priviledge) ORDER BY module"
        );
        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }

    function getUserAuths()
    {
        $this->db->query('role_auth as ra');
        $this->db->join('user_role as ur', 'ra.role_id = ur.role_id');
        $this->db->where('user_id = ', $this->session->userdata(USER_ID));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $row = $query->row();
        }
    }

    function getAuthsByRole($roleId)
    {
        $this->db->query('role_auth as ra');
        $this->db->join('user_role as ur', 'ra.role_id = ur.role_id');
        $this->db->where(array('ur.user_id' => $this->session->userdata(USER_ID), 'ra.role_id' => $roleId));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $row = $query->row();
        }
    }

    function  getUsersByAuthId($authId)
    {
        $query = $this->db->query("SELECT concat(p.first_name,' ',p.last_name) name, ur.user_id, a.label, a.id FROM user_role ur LEFT JOIN  profile p ON p.user_id = ur.user_id LEFT JOIN role_auth ra ON ra.role_id = ur.role_id LEFT JOIN auth a ON a.id = ra.auth_id WHERE auth_id = ?", array($authId));
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return 0;
    }

    function getAuths()
    {
        $this->db->select('a.id, a.name, a.label');
        $this->db->from('auth a');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return false;
    }

    function deleteUsersFromAuth($authId)
    {
        $this->db->delete('user_role', array('role_id' => $this->getRoleIdByAuth($authId)));
    }

    function getRoleIdByAuth($authId)
    {
        $this->db->query("select ra.auth_id from role_auth ra where ra.auth_id = '$authId'")->row()->auth_id;
    }

    function deleteAuth($authId)
    {
        $this->db->where('id', $authId);
        $this->db->delete('auth');
    }

    function getAuthsArray()
    {
        $this->db->select('a.id, a.label');
        $this->db->from('auth a');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $this->editable($query->result(), 'id', 'label');
        } else
            return false;
    }



    function insertAuth()
    {
        $data = array(
            'name' => $this->input->post('name'),
            'label' => $this->input->post('label'));
        $this->db->insert('auth', $this->security->xss_clean($data));
    }


    function getmodules()
    {
        $query = $this->db->query("SELECT
                                *
                                FROM
                                nc_auth_master
                                GROUP BY
                                nc_auth_master.module");
        if ($query->num_rows() > 0)
            return $query->result();
        return 0;
    }

    function getRoleAuth()
    {
        $role = $this->UserModel->getUserRoleDetailByRoleID($this->session->userdata(ADMIN_AUTH_ROLE));
        $allowedarry = array();
        $allowed = $role->role_auth_id;
        $array = explode(',', $allowed);
        $i = 0;
        foreach ($array as $value) {
            $details = $this->getAuthDetails($value);
            @$allowedarry[$i] = $details->auth_name;
            $i++;
        }
        return $allowedarry;
    }
}

?>