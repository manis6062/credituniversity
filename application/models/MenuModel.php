<?php

	class MenuModel extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
		}

        ## backend
        function getMenus(){
            $this->db->select('*');
            $this->db->from('menu');
            $query = $this->db->get();

            if ($query->num_rows() > 0)
                return $query->result();

            return 0;
        }

        function getMenu($id)
        {
            $this->db->where('id', $id);
            $this->db->select('*');
            $this->db->from('menu');
            $query = $this->db->get();
            if ($query->num_rows() > 0)
                return $query->row();
            return 0;
        }

        function insert()
        {
            $today = date("Y-m-d H:i:s");
            $data = array(
                'menu_name' => $this->input->post('menu_name'),
                'menu_type' => $this->input->post('menu_type'),
                'status' => $this->input->post('status'),
                'content_id' => $this->input->post('content'),
                'menu_module' => $this->input->post('module'),
                'crtd_dt' => $today

            );
            $this->db->insert('menu', $this->security->xss_clean($data));
            $userid = $this->db->insert_id();
            return $userid;
        }

        function delete($id)
        {
            $this->db->where('id', $id);
            $this->db->delete('menu');
            if ($this->db->affected_rows() == '1') {
                return TRUE;
            }
            return FALSE;
        }

        function update($id)
        {
            $today = date("Y-m-d H:i:s");
            $data = array(
                'menu_name' => $this->input->post('menu_name'),
                'menu_type' => $this->input->post('menu_type'),
                'status' => $this->input->post('status'),
                'content_id' => $this->input->post('content'),
                //'menu_parent' => $this->input->post('parent'),
                'menu_module' => $this->input->post('module'),
                'updt_dt' => $today,
                'updt_by' => $this->session->userdata(USER_ID)
            );
            $array = array('id' => $id);
            $this->db->where($array);
            $this->db->update('menu', $this->security->xss_clean($data));
            if ($this->db->affected_rows() == '1') {
                return TRUE;
            }
            return FALSE;
        }

        ## end backend








		function countAll($cond)
		{
			$this->db->where($cond);
			$query = $this->db->get("menu");
			return $query->num_rows();
		}

		function getAll()
		{
			$this->db->select('*');
			$this->db->from('menu');
			$query = $this->db->get();

			if ($query->num_rows() > 0)
				return $query->result();

			return 0;
		}

		function getAdminDetails($id)
		{
			$query = $this->db->query("SELECT m.* FROM menu AS M WHERE m.id = " . $id
			);

			if ($query->num_rows() == 0) {
				return 0;
			} else {
				return $query->row();
			}
		}

		function getsubmenu($id)
		{
			$this->db->where('MENU_PARENT', $id);
			$this->db->select('*');
			$this->db->from('menu');
			$query = $this->db->get();

			if ($query->num_rows() > 0)
				return $query->result();

			return 0;
		}

		function getAllByType($type, $type1, $type2)
		{
			$this->session->userdata(USER_ID);
			$query = $this->db->query("SELECT M.*, mo.module_controller FROM menu AS M INNER JOIN module AS mo ON M.menu_module=mo.id WHERE menu_type IN ('$type', '$type1', '$type2') and STATUS = 'Active' ORDER BY menu_order ASC");
			if ($query->num_rows() > 0)
				return $query->result();
			return 0;
		}






	}

?>