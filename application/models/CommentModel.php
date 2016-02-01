<?php

class CommentModel extends CI_Model {

    function __construct() {
        parent::__construct();
        // Your own constructor code
        $this->load->helper('date');
        $this->load->library('email');
        $this->load->helper('security');

    }

    function countAll($cond) {
        $query = $this->db->query("Select * from nc_comments where cartoon_id = '$cond' and status = 'Publish'");

        return $query->num_rows();
    }
    
    function count() {
        $query = $this->db->get("nc_comments");

        return $query->num_rows();
    }

    function getAllPaginate($cond, $perPage, $offset) {

//        $this->db->select('*');
//        $this->db->from('nc_comments');
//
//        $this->db->where($cond);
//        $this->db->limit($perPage, $offset);
        $query = $this->db->query("SELECT
                                    c.id,
                                    c.comment,
                                    c.flag,
                                    (select client_name from nc_client where id = c.client_id) as client,
                                    (select title from nc_cartoon where id = c.cartoon_id) as story,
                                    c.comment_dt,
                                    c.status
                                    FROM
                                    nc_comments as c 
                                    ORDER BY c.comment_dt desc limit $offset,$perPage");
        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }

    function getAllPaginatefront($id, $perPage, $offset) {

//        $this->db->select('*');
//        $this->db->from('nc_comments');
//
//        $this->db->where($cond);
//        $this->db->limit($perPage, $offset);
        $query = $this->db->query("SELECT
                                    c.id,
                                    c.comment,
                                    c.cartoon_id,
                                    c.flag,
                                    (select client_name from nc_client where id = c.client_id) as client,
                                    (select picture from nc_client where id = c.client_id) as picture,
                                    (select title from nc_cartoon where id = c.cartoon_id) as story,
                                    date_format(c.comment_dt, '%M %d %Y') as crtd_dt,
                                    c.comment_dt,
                                    c.status
                                    FROM
                                    nc_comments as c where c.cartoon_id = '$id' and status = 'Publish' 
                                    ORDER BY c.comment_dt desc
                                    limit 0,$perPage");
        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }
    
    function getAll($id) {

//        $this->db->select('*');
//        $this->db->from('nc_comments');
//
//        $this->db->where($cond);
//        $this->db->limit($perPage, $offset);
        $query = $this->db->query("SELECT
                                    c.id,
                                    c.comment,
                                    c.cartoon_id,
                                    c.flag,
                                    (select client_name from nc_client where id = c.client_id) as client,
                                    (select picture from nc_client where id = c.client_id) as picture,
                                    (select title from nc_cartoon where id = c.cartoon_id) as story,
                                    date_format(c.comment_dt, '%M %d %Y') as crtd_dt,
                                    c.comment_dt,
                                    c.status
                                    FROM
                                    nc_comments as c  
                                    ORDER BY c.comment_dt desc");
        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }


    function updateStatus($id, $value) {
        $data = array(
            'status' => $value
        );

        $this->db->where("id", $id);
        $this->db->update('nc_comments', $this->security->xss_clean($data));
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }
        return FALSE;
    }

    function insert($cartoonid, $client_id, $comment) {
        $today = date("Y-m-d H:i:s");
        $data = array(
            'cartoon_id' => $cartoonid,
            'status' => 'Publish',
            'comment_dt' => $today,
            'client_id' => $client_id,
            'flag' => 'clean',
            'comment' => $comment
        );
        $this->db->insert('nc_comments', $this->security->xss_clean($data));
        $userid = $this->db->insert_id();
        return $userid;
    }

    function update($id) {
        $data = array(
            'flag' => 'flaged'
        );

        $this->db->where("id", $id);
        $this->db->update('nc_comments', $this->security->xss_clean($data));
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }
        return FALSE;
    }
}

?>