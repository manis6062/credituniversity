<?php

	class SliderModel extends CI_Model
	{

		function __construct()
		{
			parent::__construct();
			// Your own constructor code
			$this->load->helper('date');
			$this->load->library('email');
			$this->load->model('SliderModel');
		}

		function countAll($cond)
		{
			$this->db->where($cond);
			$query = $this->db->get("nc_homepage_slider");

			return $query->num_rows();
		}

		function getAllPaginate($cond, $perPage, $offset)
		{

			$this->db->select('*');
			$this->db->from('nc_homepage_slider');

			$this->db->where($cond);
			$this->db->limit($perPage, $offset);
			$query = $this->db->get();

			if ($query->num_rows() > 0)
				return $query->result();

			return 0;
		}

		function getAll($by = "all")
		{

			if ($by != "all") {
				$this->db->where('publish', "yes");
				$this->db->where('crtd_by', $this->session->userdata(USER_ID));
			} else {
				$this->db->where('crtd_by', $this->session->userdata(USER_ID));
			}

			$this->db->select('*');
			$this->db->from('nc_homepage_slider');
			$this->db->order_by("slider_id", "desc");

			$query = $this->db->get();

			if ($query->num_rows() > 0)
				return $query->result();

			return 0;
		}

		function getPhotoDetails($id)
		{
			$query = $this->db->get_where('nc_homepage_slider', array('slider_id' => $id));

			if ($query->num_rows() == 0) {
				return 0;
			} else {
				return $query->row();
			}
		}

		function update($user_id, $pic, $mimage, $rimage)
		{
			$today = date("Y-m-d H:i:s");

			$data = array(

				//'slider_index' => $this->input->post('slider_index'),
				'description' => $this->input->post('description'), 'path' => $pic, 'mimage' => $mimage, 'rimage' => $rimage, 'crtd_dt' => $today, 'crtd_by' => $this->session->userdata(USER_ID), 'updt_dt' => $today, 'publish' => $this->input->post('publish'), 'updt_cnt' => $this->input->post('updt_cnt') + 1);

			$this->db->where("slider_id", $user_id);
			$this->db->update('nc_homepage_slider', $data);

		}

		function deletePhoto($userid)
		{
			$this->db->where('slider_id', $userid);
			$this->db->delete('nc_homepage_slider');
			if ($this->db->affected_rows() == '1') {
				return TRUE;
			}
			return FALSE;
		}

		function updateStatus($id, $value)
		{
			$data = array('publish' => $value);

			$this->db->where("slider_id", $id);
			$this->db->update('nc_homepage_slider', $this->security->xss_clean($data));
			if ($this->db->affected_rows() == '1') {
				return TRUE;
			}
			return FALSE;
		}

		function insert($ph, $mimage, $rimage)
		{

			$today = date("Y-m-d H:i:s");

			$data = array('slider_index' => $this->getMaxBannerOrder() + 1, 'description' => $this->input->post('description'), 'path' => $ph, 'mimage' => $mimage, 'rimage' => $rimage, 'crtd_dt' => $today, 'crtd_by' => $this->session->userdata(USER_ID), 'updt_dt' => $today, 'publish' => $this->input->post('publish'), 'updt_cnt' => $this->input->post('updt_cnt') + 1);
			$this->db->insert('nc_homepage_slider', $data);
			$userid = $this->db->insert_id();

			return $userid;
		}

		function changehigherorder($id, $order)
		{
			$query = $this->db->query("UPDATE nc_homepage_slider SET
					slider_index =(slider_index + 1)
					WHERE slider_index =" . ($order - 1) . " and crtd_by = " . $this->session->userdata(USER_ID));

			if ($query > 0) {
				$this->db->query("UPDATE nc_homepage_slider SET
					slider_index =(slider_index - 1)
					WHERE slider_id=$id and crtd_by = " . $this->session->userdata(USER_ID));
			}

		}

		function changelowerorder($id, $order)
		{

			$query = $this->db->query("UPDATE nc_homepage_slider  SET
					slider_index = (slider_index - 1)
					WHERE slider_index = " . ($order + 1) . " and crtd_by = " . $this->session->userdata(USER_ID));
			if ($query > 0) {
				$this->db->query("UPDATE nc_homepage_slider  SET
					slider_index = (slider_index + 1)
					WHERE slider_id = $id and crtd_by = " . $this->session->userdata(USER_ID));
			}
		}

		function getMaxBannerOrder()
		{
			$this->db->select_max('slider_index', 'norder');
			$this->db->where('crtd_by', $this->session->userdata(USER_ID));
			$query = $this->db->get('nc_homepage_slider');
			if ($query->num_rows() > 0) {
				$row = $query->row();
				return $row->norder;
			}

			return 0;
		}

		function getImageForHomePage($pid)
		{
			$this->db->where("gal_pro_id", $pid);
			$this->db->order_by("gal_id", "RANDOM");
			$this->db->group_by("gal_pro_id");
			$this->db->limit(1);
			//$this->db->limit($perPage,$offset);
			$query = $this->db->get("ah_products_gallery");
			if ($query->num_rows() > 0)
				return $query->row();

			return 0;
		}

		function getAllBanner()
		{
			$this->db->select('*');
			$this->db->from('homepage_slider');
			$this->db->order_by("slider_id", "ASC");

			$query = $this->db->get();

			if ($query->num_rows() > 0)
				return $query->result();

			return 0;

		}
	}

?>