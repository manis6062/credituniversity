<?php
class ModuleModel extends CI_Model {

    function __construct() {
        parent::__construct();
        // Your own constructor code
        $this -> load -> helper('date');
    }

    function getModules() {

        $this -> db -> select('*');
        $this -> db -> from('module');

        $query = $this -> db -> get();

        if ($query -> num_rows() > 0)
            return $query -> result();

        return 0;
    }

    function getMemberModules($module_name) {

        $this -> db -> select('*');
        $this -> db -> from('member_module');
        $this -> db -> where('name' , $module_name);
        $query = $this -> db -> get();
        if ($query -> num_rows() > 0)
            return $query -> row();

        return 0;
    }







//------------------------------------------   OLD CODES------------------------------

    function countAll() {
        $query = $this -> db -> get("nc_module");

        return $query -> num_rows();
    }

    function getAll() {

        $this -> db -> select('*');
        $this -> db -> from('nc_module');

        $query = $this -> db -> get();

        if ($query -> num_rows() > 0)
            return $query -> result();

        return 0;
    }
    
    function getmodulepriviledge(){
        $this->db->select('modules');
        $this->db->from('nc_module_priviledge');
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->result();
        return 0;
    }
	
	function getclientmodulepriviledge(){
        $this->db->select('modules');
        $this->db->from('nc_client_module_priviledge');
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->result();
        return 0;
    }
	
	function getreferrermodulepriviledge(){
        $this->db->select('modules');
        $this->db->from('nc_referrer_module_priviledge');
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->result();
        return 0;
    }

    function getDetails($id) {
        $this->db->select('*');
        $this->db->from('nc_module');
        $this -> db -> where('id', $id);
        $query = $this -> db -> get();
        if ($query -> num_rows() > 0)
            return $query -> row();

        return 0;
    }

    function update($id) {
        $data = array('module_name' => ucwords($this -> input -> post('module_name')), 'module_controller' => $this -> input -> post('module_controller'));

        $this -> db -> where("id", $id);
        $this -> db -> update('nc_module', $this -> security -> xss_clean($data));
    }

    function delete($id) {
        $this -> db -> where('id', $id);
        return $this -> db -> delete('nc_module');
    }

    function insert() {
        $data = array('module_name' => ucwords($this -> input -> post('module_name')), 'module_controller' => $this -> input -> post('module_controller'));
        $this -> db -> insert('nc_module', $this -> security -> xss_clean($data));
        $id = $this -> db -> insert_id();
        return $id;
    }
    function updatepriviledge($module){
        $data = array(
            'modules' => $module
        );
        //$this -> db -> where("id", $this -> input -> post('id'));
        if($this->input->post("type")=='user'){
        	$this -> db -> insert('nc_module_priviledge', $this -> security -> xss_clean($data));
        }else{
        	$this -> db -> insert('nc_'.$this->input->post("type").'_module_priviledge', $this -> security -> xss_clean($data));
        }	
        if ($this -> db -> affected_rows() == '1') {
            return TRUE;
        }
        return FALSE;
    }
    function deletepriviledge(){
    	if($this->input->post("type")=='user'){
    		return $this -> db -> query('truncate nc_module_priviledge');
    	}else{    		
        	return $this -> db -> query('truncate nc_'.$this->input->post("type").'_module_priviledge');
    	}
    }
}
?>