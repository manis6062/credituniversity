<?php
class PortfolioModel extends CI_Model {

    function __construct() {
        parent::__construct();
        // Your own constructor code
        $this -> load -> helper('date');
        $this -> load -> library('email');
    }

    function countAll($cond) {
        $this -> db -> where($cond);
        $query = $this -> db -> get("nc_portfolio");
        return $query -> num_rows();
    }

    function getAllPaginate($cond, $perPage, $offset) {

        $this -> db -> select('*');
        $this -> db -> from('nc_portfolio');

        $this -> db -> where($cond);
        $this -> db -> limit($perPage, $offset);
        $query = $this -> db -> get();

        if ($query -> num_rows() > 0)
            return $query -> result();

        return 0;
    }

    function getAll() {
        $query = $this->db->query("Select p.*, pc.category_name from nc_portfolio as p inner join nc_portfolio_category as pc
                                   on pc.id = p.category order by p.id desc");
        if ($query -> num_rows() > 0)
            return $query -> result();

        return 0;
    }

    function getAdminDetails($id) {
        $query = $this -> db -> get_where('nc_portfolio', array('id' => $id));

        if ($query -> num_rows() == 0) {
            return 0;
        } else {
            return $query -> row();
        }
    }

    function update($user_id, $ph) {
        $today = date("Y-m-d H:i:s");

        $data = array(
            'title' => $this->input->post('title'), 
            'description' => $this -> input -> post('description'), 
            'link' => $this -> input -> post('link'), 
            'image' => $ph, 
            'updt_dt' => $today, 
            'updt_by' => $this -> session -> userdata(USER_ID),
            'category' => $this -> input -> post('category')
        );

        $this -> db -> where("id", $user_id);
        $this -> db -> update('nc_portfolio', $data);

    }

    function delete($userid) {
        $this -> db -> where('id', $userid);
        $this -> db -> delete('nc_portfolio');
        if ($this -> db -> affected_rows() == '1') {
            return TRUE;
        }
        return FALSE;

    }

    function insert($ph) {

        $today = date("Y-m-d H:i:s");

        $data = array(
            'title' => $this->input->post('title'), 
            'description' => $this -> input -> post('description'), 
            'link' => $this -> input -> post('link'), 
            'image' => $ph, 
            'crtd_dt' => $today, 
            'crtd_by' => $this -> session -> userdata(USER_ID),
            'updt_dt' => $today, 
            'updt_by' => $this -> session -> userdata(USER_ID),
            'category' => $this -> input -> post('category')
        );
        $this -> db -> insert('nc_portfolio', $data);
        $userid = $this -> db -> insert_id();

        return $userid;
    }
}
?>