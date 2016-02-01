<?php
class ChooseAndChargeModel extends CI_Model {

    function __construct() {
        parent::__construct();
        // Your own constructor code
        $this -> load -> helper('date');
        $this -> load -> library('email');
    }

    function countAll($cond) {
        $this -> db -> where($cond);
        $query = $this -> db -> get("nc_choosencharge");

        return $query -> num_rows();
    }

    function getAllPaginate($cond, $perPage, $offset) {
        $this -> db -> select('*');
        $this -> db -> from('nc_choosencharge');

        $this -> db -> where($cond);
        $this -> db -> limit($perPage, $offset);
        $query = $this -> db -> get();

        if ($query -> num_rows() > 0)
            return $query -> result();

        return 0;
    }

    // get the administratro details
    function getAdminDetails($id) {
        $query = $this -> db -> get_where('nc_choosencharge', array('id' => $id));

        if ($query -> num_rows() == 0) {
            return 0;
        } else {
            return $query -> row();
        }
    }

    function getAll() {
        $query = $this -> db -> query("Select c.*, (select state from states where state_code = c.state) as state_detail from nc_choosencharge as c order by c.id desc");
        if ($query -> num_rows() > 0)
            return $query -> result();

        return 0;
    }

    function update($id) {
        $today = date("Y-m-d H:i:s");

        $data = array('company_name' => $this -> input -> post('name'),
        	'company_website' => $this -> input -> post('website'),
        	'state' => $this -> input -> post('state'),
			'address' => $this->input->post('address'),
			'details' => $this->input->post('details'));
        $this -> db -> where("id", $id);
        $this -> db -> update('nc_choosencharge', $this -> security -> xss_clean($data));
        if($this->db->affected_rows()>0){
            return TRUE;
        }
        return FALSE;
    }

    function delete($id) {
        $this -> db -> where('id', $id);
        $this -> db -> delete('nc_choosencharge');
        if ($this -> db -> affected_rows()>0) {
            return TRUE;
        }
        return FALSE;
    }

    function insert() {

        $today = date("Y-m-d H:i:s");

        $data = array('company_name' => $this -> input -> post('name'),
        	'company_website' => $this -> input -> post('website'),
        	'state' => $this -> input -> post('state'),
			'address' => $this->input->post('address'),
			'details' => $this->input->post('details'));
        $this -> db -> insert('nc_choosencharge', $this -> security -> xss_clean($data));
        $faqid = $this -> db -> insert_id();

        return $faqid;
    }
	
	function getAllState(){
		$query = $this->db->query('Select * from states');
		return $query->result();
	}

}
?>