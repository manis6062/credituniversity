<?php
class RequestModel extends CI_Model {

    function __construct() {
        parent::__construct();
        // Your own constructor code
        $this -> load -> helper('date');
        $this -> load -> library('email');
    }

    function countAll($cond) {
        $this -> db -> where($cond);
        $query = $this -> db -> get("nc_request_for_signup");

        return $query -> num_rows();
    }

    function getAllPaginate($cond, $perPage, $offset) {

        $this -> db -> select('*');
        $this -> db -> from('nc_request_for_signup');

        $this -> db -> where($cond);
        $this -> db -> limit($perPage, $offset);
        $query = $this -> db -> get();

        if ($query -> num_rows() > 0)
            return $query -> result();

        return 0;
    }

    function getAll() {
        $this -> db -> select('*');
        $this -> db -> from('nc_request_for_signup');
        $this -> db -> order_by("request_id", "desc");

        $query = $this -> db -> get();

        if ($query -> num_rows() > 0)
            return $query -> result();

        return 0;
    }

    function delete($id) {
        $this -> db -> where('request_id', $id);
        $this -> db -> delete('nc_request_for_signup');
        if ($this -> db -> affected_rows() == '1') {
            return TRUE;
        }
        return FALSE;

    }

    function insert($email,$rcode) {
        $today = date("Y-m-d");
		$type = '';
		if($this->session->userdata(ADMIN_AUTH_TYPE)!='affiliate' && $this->session->userdata(ADMIN_AUTH_TYPE)!='referrer' && $this->session->userdata(ADMIN_AUTH_TYPE)!='client'){
			$type = 'referrer';
		}elseif($this->session->userdata(ADMIN_AUTH_TYPE)=='affiliate' || $this->session->userdata(ADMIN_AUTH_TYPE)=='referrer'){
			$type = 'client';
		}
        $data = array('request_to_type' => $type, 
	        'request_to_emails' => $email, 
	        'request_by' => $this -> session -> userdata(USER_ID),
	        'request_send_dt' => $today,
			'rcode' => $rcode);
        $this -> db -> insert('nc_request_for_signup', $data);
        $userid = $this -> db -> insert_id();
        return $userid;
    }
	
	function checkcode($code){
		$this->db->select('request_id');
		$query = $this->db->get_where('nc_request_for_signup', array('rcode'=>$code));
		if($query->num_rows()>0){
			return TRUE;
		}
		return FALSE;
	}
    
    function insert_line($email,$rcode) {
        $today = date("Y-m-d");
        $type = '';
        if($this->session->userdata(ADMIN_AUTH_TYPE)!='affiliate' && $this->session->userdata(ADMIN_AUTH_TYPE)!='referrer' && $this->session->userdata(ADMIN_AUTH_TYPE)!='client'){
            $type = 'referrer';
        }elseif($this->session->userdata(ADMIN_AUTH_TYPE)=='affiliate' || $this->session->userdata(ADMIN_AUTH_TYPE)=='referrer'){
            $type = 'line';
        }
        $data = array('request_to_type' => $type, 
            'request_to_emails' => $email, 
            'request_by' => $this -> session -> userdata(USER_ID),
            'request_send_dt' => $today,
            'rcode' => $rcode);
        $this -> db -> insert('nc_request_for_signup', $data);
        $userid = $this -> db -> insert_id();
        return $userid;
    }
    
    
    
}
?>