<?php

	class SocialModel extends CI_Model
	{

		function __construct()
		{
			parent::__construct();
			// Your own constructor code
		}
           ## backend
        function getSocials()
        {
            $this->db->select('*');
            $this->db->from('social');
            $query = $this->db->get();

            if ($query->num_rows() > 0)
                return $query->result();

            return 0;
        }

        function insert(){
            $data = array(
                'social_title' => $this->input->post('social_title'),
                'social_link'   => $this->input->post('social_link')
            );
            $this->db->insert('social', $this->security->xss_clean($data));
            return $this->db->insert_id();
        }

        function delete($id)
        {
            $this->db->where('id', $id);
            $this->db->delete('social');
            if ($this->db->affected_rows() > 0) {
                return TRUE;
            }
            return FALSE;
        }


        ## end backend














		function countAll($cond)
		{
			$this->db->where($cond);
			$query = $this->db->get("nc_social");

			return $query->num_rows();
		}

		function getAllPaginate($cond, $perPage, $offset)
		{

			$this->db->select('*');
			$this->db->from('nc_social');

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
			$this->db->from('nc_social');
			$query = $this->db->get();

			if ($query->num_rows() > 0)
				return $query->result();

			return 0;
		}

		function getAllActive()
		{
			$query = $this->db->query("Select * from social where social_link != ''");
			if ($query->num_rows() > 0)
				return $query->result();

			return 0;
		}

		function update($social_link, $id)
		{
			$today = date("Y-m-d H:i:s");
			$data = array(
				//'slider_index' => $this->input->post('slider_index'),
				'social_link' => $social_link
			);
			$this->db->where("id", $id);
			$this->db->update('nc_social', $this->security->xss_clean($data));
		}
	}

?>