<?php

	class ThemeOptionModel extends CI_Model
	{

		function __construct()
		{
			parent::__construct();
			// Your own constructor code
			$this->load->helper('date');
			$this->load->library('email');
		}
        ## backend
        function getThemeOption()
        {
            $this->db->select('*');
            $this->db->from('theme_option');
            $query = $this->db->get();

            if ($query->num_rows() > 0)
                return $query->row();

            return 0;
        }
        ## end backend



















		function countAll($cond)
		{
			$this->db->where($cond);
			$this->db->where('crtd_by', $this->session->userdata(USER_ID));
			$query = $this->db->get("nc_theme_option");
			return $query->num_rows();
		}

		function getAllPaginate($cond, $perPage, $offset)
		{
			$this->db->select('*');
			$this->db->from('theme_option');
			$this->db->where($cond);
			$this->db->where('crtd_by', $this->session->userdata(USER_ID));
			$this->db->limit($perPage, $offset);
			$query = $this->db->get();

			if ($query->num_rows() > 0)
				return $query->result();

			return 0;
		}

		function getAll()
		{
			$query = $this->db->query("Select * from theme_option");
			if ($query->num_rows() > 0)
				return $query->row();

			return 0;
		}

		function getAllFront()
		{
			$query = $this->db->query("Select * from theme_option");
			if ($query->num_rows() > 0)
				return $query->row();

			return 0;
		}

		function update($logo, $fav_icon, $background_image, $footer_image)
		{
			$today = date("Y-m-d H:i:s");
			$data = array(
				'title' => $this->input->post('title'),
				'caption' => $this->input->post('caption'),
				'head_color' => $this->input->post('head_color'),
				'footer_color' => $this->input->post('footer_color'),
				'custom_css' => $this->input->post('custom_css'),
				'fav_icon' => $fav_icon,
				'featureheading1' => $this->input->post('featureheading1'),
				'featureheading2' => $this->input->post('featureheading2'),
				'featureheading3' => $this->input->post('featureheading3'),
				'featuretagline1' => $this->input->post('featuretagline1'),
				'featuretagline2' => $this->input->post('featuretagline2'),
				'featuretagline3' => $this->input->post('featuretagline3'),
				'featuredesc1' => $this->input->post('featuredesc1'),
				'featuredesc2' => $this->input->post('featuredesc2'),
				'featuredesc3' => $this->input->post('featuredesc3'),
				'theme_video' => $this->input->post('theme_video'),


				// 'head_back_image' => $background_image,
				// 'footer_back_image' => $footer_image,
				'logo' => $logo
			);
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('theme_option', $data);
			if ($this->db->affected_rows() > 0) {
				return TRUE;
			}
			return FALSE;
		}

		function insert($logo, $fav_icon, $background_image, $footer_image)
		{
			$today = date("Y-m-d H:i:s");
			$data = array(
				'title' => $this->input->post('title'),
				'caption' => $this->input->post('caption'),
				'head_color' => $this->input->post('head_color'),
				'footer_color' => $this->input->post('footer_color'),
				'custom_css' => $this->input->post('custom_css'),
				'fav_icon' => $fav_icon,
				// 'head_back_image' => $background_image,
				// 'footer_back_image' => $footer_image,
				'logo' => $logo,
				'crtd_by' => $this->session->userdata(USER_ID)
			);

			$this->db->insert('theme_option', $data);
			if ($this->db->affected_rows() > 0) {
				return TRUE;
			}
			return FALSE;

		}
	}

?>