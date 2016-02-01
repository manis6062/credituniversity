<?php

class BannerModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->helper('date');
        $this->load->library('email');

    }


    ## backend
    function getBanners()
    {
        $this->db->select('*');
        $this->db->from('homepage_slider');
        $this->db->order_by("slider_index", "asc");

        $query = $this->db->get();

        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }

    function insert($ph, $mimage, $rimage)
    {
        $today = date("Y-m-d H:i:s");
        $data = array(
            'slider_name' => $this->input->post('slider_name'),
            'description' => $this->input->post('description'),
            'path' => $ph,
            'mimage' => $mimage,
            'rimage' => $rimage,
            'crtd_dt' => $today,
            'publish' => 'no');
        $this->db->insert('homepage_slider', $data);
        $userid = $this->db->insert_id();
        return $userid;
    }

    function getBanner($id)
    {
        $query = $this->db->get_where('homepage_slider', array('slider_id' => $id));
        if ($query->num_rows() == 0) {
            return 0;
        } else {
            return $query->row();
        }
    }

    function deleteBanner($userid)
    {
        $this->db->where('slider_id', $userid);
        $this->db->delete('homepage_slider');
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }
        return FALSE;
    }

    function update($id, $pic, $mimage, $rimage)
    {
        $today = date("Y-m-d H:i:s");
        $data = array(
            'slider_name' => $this->input->post('slider_name'),
            'description' => $this->input->post('description'),
            'path' => $pic,
            'mimage' => $mimage,
            'rimage' => $rimage,
            'updt_dt' => $today,
            'publish' => $this->input->post('publish'),

        );
        $this->db->where("slider_id", $id);
        $this->db->update('homepage_slider', $data);

    }

    ## backend


    function getAllBanner()
    {
        $this->db->select('*');
        $this->db->from('homepage_slider');
        $this->db->where('publish', 'yes');
        $this->db->order_by("slider_index", "ASC");

        $query = $this->db->get();

        if ($query->num_rows() > 0)
            return $query->result();

        return 0;

    }

    function reOrder($from, $to)
    {

        $from_id = $this->db->query("select hs.slider_id from homepage_slider hs where hs.slider_index = '$from'")->row()->slider_id;
        $to_id = $this->db->query("select hs.slider_id from homepage_slider hs where hs.slider_index = '$to'")->row()->slider_id;

        $data = array(
            'slider_index' => $to
        );
        $this->db->where('slider_id', $from_id);
        $this->db->update('homepage_slider', $data);

        $data = array(
            'slider_index' => $from
        );
        $this->db->where('slider_id', $to_id);
        $this->db->update('homepage_slider', $data);
    }
}

?>