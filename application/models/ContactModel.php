<?php

	class ContactModel extends CI_Model
	{

		function __construct()
		{
			parent::__construct();
			// Your own constructor code
		}

        ## backend
        function getContact()
        {
            $this->db->select('*');
            $this->db->from('contact');
            $query = $this->db->get();

            if ($query->num_rows() > 0)
                return $query->row();

            return 0;
        }
        ## end backend




		function countAll($cond)
		{
			$this->db->where($cond);
			$query = $this->db->get("nc_contact");

			return $query->num_rows();
		}

		function getAllPaginate($cond, $perPage, $offset)
		{

			$this->db->select('*');
			$this->db->from('nc_contact');

			$this->db->where($cond);
			$this->db->limit($perPage, $offset);
			$query = $this->db->get();

			if ($query->num_rows() > 0)
				return $query->result();

			return 0;
		}

		function getAll()
		{
			$this->db->select('*');
			$this->db->from('contact');
			$query = $this->db->get();

			if ($query->num_rows() > 0)
				return $query->row();

			return 0;
		}

		function update($contact_link, $id)
		{
			$today = date("Y-m-d H:i:s");
			$data = array(
				//'slider_index' => $this->input->post('slider_index'),
				'contact_link' => $contact_link,
				'crtd_by' => $this->session->userdata(USER_ID),
			);
			$this->db->where("id", $id);
			$this->db->update('nc_contact', $this->security->xss_clean($data));
		}

	}

?>