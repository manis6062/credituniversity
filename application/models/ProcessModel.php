<?php

	class ProcessModel extends CI_Model
	{

		function __construct()
		{
			parent::__construct();
			// Your own constructor code
			$this->load->helper('date');
			$this->load->library('email');
		}
        ## backend
        function getProcesss()
        {
            $this->db->select('*');
            $this->db->from('process');
            $this->db->order_by('process_id');
            $query = $this->db->get();
            if ($query->num_rows() > 0)
                return $query->result();
            return 0;
        }

        function insert(){
            $data = array(
                'process_title' => $this->input->post('process_title'),
                'process_caption' => $this->input->post('process_caption'),
                'process_description'   => $this->input->post('process_description')
            );
            $this->db->insert('process', $this->security->xss_clean($data));
            return $this->db->insert_id();
        }

        function getProcess($id){
            $this->db->select('*');
            $this->db->from('process');
            $this->db->where('process_id', $id);
            $query = $this->db->get();
            if ($query->num_rows() > 0)
                return $query->row();
            return 0;
        }

        function delete($id)
        {
            $this->db->where('process_id', $id);
            $this->db->delete('process');
            if ($this->db->affected_rows() > 0) {
                return TRUE;
            }
            return FALSE;
        }
        ## end backend



















        function countAll($cond)
		{
			$this->db->where($cond);
			$query = $this->db->get("nc_process");

			return $query->num_rows();
		}

		function getAllPaginate($cond, $perPage, $offset)
		{
			$this->db->select('*');
			$this->db->from('nc_process');

			$this->db->where($cond);
			$this->db->limit($perPage, $offset);
			$query = $this->db->get();

			if ($query->num_rows() > 0)
				return $query->result();

			return 0;
		}

		// get the administratro details
		function getAdminDetails($id)
		{
			$query = $this->db->get_where('nc_process', array('process_id' => $id));

			if ($query->num_rows() == 0) {
				return 0;
			} else {
				return $query->row();
			}
		}

		function getAll()
		{
			$query = $this->db->query("Select * from process order by process_id desc");
			if ($query->num_rows() > 0)
				return $query->result();

			return 0;
		}





	}

?>