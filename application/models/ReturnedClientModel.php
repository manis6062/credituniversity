<?php

class ReturnedClientModel extends CI_Model {

	function __construct() {
		parent::__construct();
		// Your own constructor code
		$this -> load -> helper('date');
		$this -> load -> library('email');
	}

	function countAll($cond='') {
		if($cond==''){
			$query = $this -> db -> query("Select * from nc_client");			
		}else{
			$query = $this -> db -> query("Select * from nc_client where $cond");	
		}

		return $query -> num_rows();
	}

	function getAll($ref_id) {
			$query = $this -> db -> query("SELECT * FROM nc_client
INNER JOIN nc_card_sell ON nc_client.id = nc_card_sell.client_id
INNER JOIN nc_line_owner ON nc_line_owner.to_id = nc_card_sell.to_id
INNER JOIN nc_credit_card ON nc_credit_card.card_id = nc_card_sell.card_id where nc_card_sell.referrer_id = $ref_id AND nc_client.return_client = 'YES' AND nc_client.is_delete = 'NO' AND nc_credit_card.card_is_delete = 'NO' AND nc_line_owner.to_is_delete = 'NO'");
		if ($query -> num_rows() > 0)
			return $query -> result();

		return 0;
	}
    
  
	function clientLogin($username, $password, $role) {
		$this -> db -> where(array('email' => $username, 'password' => md5($password), 'role' => $role));

		$query = $this -> db -> get('nc_client');

		if ($query -> num_rows() == 0) {
			return 0;
		} else {
			return $query -> row();
		}
	}

	// get the administratro details
	function getAdminDetails($id) {
		$query = $this -> db -> get_where('nc_client', array('id' => $id));

		if ($query -> num_rows() == 0) {
			return 0;
		} else {
			return $query -> row();
		}
	}

	function uniqueUserName($userid, $name) {
		$this -> db -> select('*');
		$this -> db -> from('nc_client');
		$this -> db -> where('username', $name);
		$this -> db -> where_not_in('id', $userid);

		//$this->db->order_by("company_id","DESC");
		$query = $this -> db -> get();

		return $query -> num_rows();
	}

	function getAllUsersTemp() {
		$this -> db -> order_by("id", "DESC");
		//$this->db->limit($perPage,$offset);
		$query = $this -> db -> get("nc_client");
		if ($query -> num_rows() > 0)
			return $query -> result();

		return 0;
	}

	function getSingleUsers($id) {
		
        //$query = $this->db->query("SELECT c.*, (SELECT state FROM states  WHERE id = c.state) as state1 FROM nc_client c WHERE c.id =$id");
		$query = $this->db->query("SELECT c.*, s.state as st from nc_client c left join states s on  c.state = s.id where c.id = $id");
		//var_dump($query);
		if ($query -> num_rows() > 0)
			return $query -> row();

		return 0;
	}

	function checkEmailDuplicate($email) {
		$this -> db -> where('email', $email);
		$query = $this -> db -> get("nc_client");
		if ($query -> num_rows() > 0)
			return TRUE;
		else
			return FALSE;
	}

	function checkPassword($password, $id) {
		$password = md5($password);
		$query = $this -> db -> query("Select * from nc_client where password = '$password' and id = '$id'");
		if ($query -> num_rows() > 0)
			return TRUE;
		else
			return FALSE;
	}

	function update($id) {
		$today = date("Y-m-d H:i:s");
		$data = array('firstname' => ucwords($this -> input -> post('firstname')), 'lastname' => ucwords($this -> input -> post('lastname')), 'scn' => $this -> input -> post('scn'), 'dob' => $this -> input -> post('dob'), 'address' => $this -> input -> post('address'), 'city' => $this -> input -> post('city'), 'state' => $this -> input -> post('state'), 'zip' => $this -> input -> post('zip'), 'phone' => $this -> input -> post('phone'), 'mobile' => $this -> input -> post('mobile'), 'email' => $this -> input -> post('email'), 'comments' => $this -> input -> post('comments'), 'role' => $this -> input -> post('role'), );
		$this -> db -> where("id", $id);
		$this -> db -> update('nc_client', $this -> security -> xss_clean($data));
		if ($this -> db -> affected_rows() > 0) {
			return TRUE;
		}
		return FALSE;
	}

	function passwordcode($email, $code) {
		$today = date("Y-m-d H:i:s");
		$data = array('password_request_code' => $code);
		$this -> db -> where("email", $email);
		$this -> db -> update('nc_client', $this -> security -> xss_clean($data));
	}

	function checkCodegenerated($email) {
		$query = $this -> db -> query("Select password_request_code from nc_client where email = '$email'");
		if ($query -> num_rows() > 0)
			return $query -> row();

		return FALSE;
	}

	function updatePassword($id) {
		$data = array('password' => $this -> input -> post('password'));

		$this -> db -> where("id", $id);
		$this -> db -> update('nc_client', $this -> security -> xss_clean($data));
	}

	function updatePass() {
		$password = md5($this -> input -> post('password'));
		$code = $this -> input -> post('code');
		$this -> db -> query("Update nc_client set password = '$password' , password_request_code = '' where password_request_code = '$code'");
		if ($this -> db -> affected_rows() == '1') {
			return TRUE;
		}
		return FALSE;
	}

	function passwordupdate($id, $pass) {
		$pass = md5($pass);
		$this -> db -> query("Update nc_client set password = '$pass' where id = '$id'");
		if ($this -> db -> affected_rows() == '1') {
			return TRUE;
		}
		return FALSE;
	}

	function forpasswordchange($code) {
		$query = $this -> db -> query("select * from nc_client where password_request_code = '$code' and status = 'active'");
		if ($query -> num_rows() > 0)
			return true;

		return false;
	}

	function deleteClient($userid) {
	    $data = array('is_delete' => 'YES', );
		$this -> db -> where('id', $userid);
		
		if ($this -> db -> update('nc_client' , $data))
			return TRUE;
		else
			return FALSE;
	}

	function updateStatus($id, $value) {
		$data = array('status' => $value);

		$this -> db -> where("id", $id);
		$this -> db -> update('nc_client', $this -> security -> xss_clean($data));
		if ($this -> db -> affected_rows() == '1') {
			return TRUE;
		}
		return FALSE;
	}

	function checkIdandCode($id, $code) {
		$query = $this -> db -> query("Select * from nc_client where id = '$id' and code = '$code'");
		if ($query -> num_rows() > 0)
			return $query -> row();

		return 0;
	}

	function insert($userid) {
		$today = date("Y-m-d H:i:s");
        $data = array(
                    'firstname' => ucwords(trim($this -> input -> post('fname'))), 
                    'middlename' => ucwords(trim($this -> input -> post('mname'))), 
                    'lastname' => ucwords(trim($this -> input -> post('lname'))), 
                     'maidenname' => ucwords(trim($this -> input -> post('mmname'))), 
                      'gender' => $this -> input -> post('gender'),
                    'ssn_no' => $this -> input -> post('ssn_no'), 
                    'cpn_no' => $this -> input -> post('cpn_no'), 
                    'tax_no' => $this -> input -> post('tax_no'),
                    
                    
                    'transunion' => $this -> input -> post('transunion'), 
                    'equifax' => $this -> input -> post('equifax'), 
                    'experion' => $this -> input -> post('experion'),
                    
                    'cpn_score' => $this -> input -> post('cpn_score'),
                    'cpn_no' => $this -> input -> post('cpn_no'),
                    'ssn_no' => $this -> input -> post('ssn_no'),
                    'tax_no' => $this -> input -> post('tax_no'),
                    
                    'dob' => $this -> input -> post('dob'), 
                    'address' => ucwords(trim($this -> input -> post('address'))), 
                    'city' => ucfirst(trim($this -> input -> post('city'))), 
                    'state' => $this -> input -> post('state'), 
                    'zip' => $this -> input -> post('zip'), 
                    'phone' => $this -> input -> post('pcon'), 
                    'mobile' => $this -> input -> post('scon'), 
                    'email' => trim($this -> input -> post('email')), 
                    //'comments' => ucwords($this -> input -> post('comments')), 
                    'user_id' => $userid, 
                    'affiliate_id' => $this->input->post('ref_id'), 
                    'payment_status' => 'unpaid', 
                     'is_delete' => 'NO',
                     'return_client' => 'NO',
                  
                    'reg_date' => $today
                    );
		$this -> db -> insert('nc_client', $this -> security -> xss_clean($data));
		$clientid = $this -> db -> insert_id();
		$query = $this -> db -> query("Select  u.email, concat(c.firstname, ' ', c.lastname) as client_name from user as u inner join nc_client as c on c.user_id = u.user_id where u.id= (select user_id from nc_client where id = $clientid)");
		if ($query -> num_rows() > 0) {
			return $query -> row();
		} else {
			return 0;
		}
	}

	function activateClient($id, $code) {
		$query = $this -> db -> query("update nc_client set status = 'active' where id = '$id' and code = '$code'");
		if ($this -> db -> affected_rows() == '1') {
			return TRUE;
		}
		return FALSE;
	}

	function updateInline($field, $value, $id) {
		$query = $this -> db -> query("update nc_client set $field = '$value' where id = '$id'");
		if ($this -> db -> affected_rows() == '1') {
			return TRUE;
		}
		return FALSE;
	}
	
	function updateEmpInline($field, $value, $id) {
		$query = $this -> db -> query("update nc_employment_details set $field = '$value' where emp_id = '$id'");
		if ($this -> db -> affected_rows() == '1') {
			return TRUE;
		}
		return FALSE;
	}

	function checkcpn($num) {
		$query = $this -> db -> query("select id from nc_client where cpn = '$num'");
		if ($query -> num_rows() > 0) {
			return true;
		}
		return FALSE;
	}

	function getcpn() {
		$cpn = mt_rand(10000000, 99999999);
		if ($this -> checkcpn($cpn)) {
			$this -> getcpn();
		}
		return $cpn;
	}

	function checkClientPaymentSatus($id) {
		$query = $this -> db -> query("SELECT * FROM nc_client WHERE user_id= '$id'");
		if ($query -> num_rows() > 0)
			return $query -> row();

		return 0;
	}
	
	function checkcodeanduseravailability($code){
		$this->db->select('request_to_emails');
		$query = $this->db->get_where('nc_request_for_signup', array('rcode'=>$code,'request_to_type'=>'client'));
		if($query->num_rows()>0){
			$row = $query->row();
			$this->db->select('user_id');
			$query = $this->db->get_where('user', array('email'=>$row->request_to_emails));
			if($query->num_rows()>0){
				return FALSE;
			}
			else{
				return $row->request_to_emails;
			}
		}
		return FALSE;
	}
	
	function getclientid($userid){
		$this->db->select('id');
		$query = $this->db->get_where('nc_client', array('user_id'=>$userid));
		if($query->num_rows()>0){
			return $query->row()->id;
		}
		return 0;
	}
	
	function getemployment($client_id){
		$this->db->select("*");
		$query=$this->db->get_where('nc_employment_details', array('user_id'=>$client_id, 'user_type'=>'client'));
		if($query->num_rows()>0){
			return $query->result();
		}
		return 0;
	}
	
	function insertemp($type){
		$today = date("Y-m-d H:i:s");
		$data = array(
			'experience' => ucwords(trim($this -> input -> post('experience'))), 
			'designation' => ucwords(trim($this -> input -> post('designation'))), 
			'company' => ucwords(trim($this -> input -> post('company'))), 
			'user_id' => $this->input->post('user_id'),
			'user_type' => $type
			);
		$this -> db -> insert('nc_employment_details', $this -> security -> xss_clean($data));
		$empid = $this -> db -> insert_id();
		$query = $this -> db -> query("Select * from nc_employment_details where emp_id = $empid");
		if ($query -> num_rows() > 0) {
			return $query -> row();
		} else {
			return 0;
		}
	}
	
	function deleteEmp($emp_id){
		$query = $this->db->query("delete from nc_employment_details where emp_id = $emp_id");
		if($this->db->affected_rows()>0){
			return TRUE;
		}
		return FALSE;
	}
	
	function getreferrer($client_id){
		$query = $this->db->query("select (select affiliate_email from nc_affiliate where affiliate_id = c.affiliate_id) as email from nc_client as c where c.user_id = $client_id");
		if($query->num_rows()>0){
			return $query->row()->email;
		}
		return 0;
	}
	
	function getreferrerInfoForClient($ref_user){
		$query = $this->db->query("SELECT a.* FROM user as u  INNER JOIN nc_affiliate as a ON u.id= a.user_id WHERE u.login_name = '$ref_user'");
		if($query->num_rows()>0){
			return $query->row();
		}
		return 0;
	}
	
	
	function getGenerateUsername(){
		$username = '';
		$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		for ($i = 0; $i < 8; $i++) {
			$username .= $characters[rand(0, strlen($characters) - 1)];
		}
		$query = $this->db->query("SELECT login_name FROM user WHERE login_name = '$username'");
		if($query->num_rows()>0){
			return $this->getGenerateUsername();
		}
		else{
			return $username;
		}
	}
	function generatePassword(){
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$password = substr( str_shuffle( $chars ), 0, 8 );
		return $password;
	}
	
	function insertClient($username, $password) {

        $today = date("Y-m-d H:i:s");
        $priviledge = "";
        $val = $this->db->query("SELECT nc_auth_master.auth_id FROM nc_auth_master WHERE nc_auth_master.module IN (select modules from nc_client_module_priviledge) order by nc_auth_master.auth_id");
		if($val->num_rows()>0){
			$result = $val->result();
			$i = 1;
			foreach($result as $value){
				if($i==$val->num_rows()){				
					$priviledge.= $value->auth_id;
				}else{
					$priviledge.= $value->auth_id.",";
				}			
				$i++;
			}
		}	
        $data = array('user_name' => trim($this -> input -> post('fname')).' '.trim($this -> input -> post('lname')),  
        'login_name' => $username,
        'login_pwd' => trim(md5($password)), 
        'phone' => $this -> input -> post('pcon'), 
        'cell' => $this -> input -> post('scon'), 
        'address' => ucwords(trim($this -> input -> post('address'))), 
        'user_type' => 'client', 
        'email' => trim($this -> input -> post('email')), 
        'status' => 'yes',
        'auth_id' => $priviledge,
        'crtd_dt' => $today);
        $this -> db -> insert('user', $this -> security -> xss_clean($data));
        $userid = $this -> db -> insert_id();

        return $userid;
    }

	function insertInToClientTable($userid){
		$today = date("Y-m-d H:i:s");
		$data = array(
					'firstname' => ucwords(trim($this -> input -> post('fname'))), 
					'middlename' => ucwords(trim($this -> input -> post('mname'))),
					'lastname' => ucwords(trim($this -> input -> post('lname'))), 
					'maidenname' => ucwords(trim($this -> input -> post('mmname'))), 
					'gender' => $this -> input -> post('gender'), 
					'dob' => $this -> input -> post('dob'), 
					'address' => ucwords(trim($this -> input -> post('address'))), 
					'city' =>ucwords(trim($this -> input -> post('city'))) , 
					'state' => $this -> input -> post('state'), 
					'zip' => $this -> input -> post('zip'), 
					'phone' => $this -> input -> post('pcon'), 
					'mobile' => $this -> input -> post('scon'), 
					'email' => ucwords(trim($this -> input -> post('email'))), 
					'sal' => ucwords(($this -> input -> post('sal'))), 
					//'comments' => ucwords($this -> input -> post('comments')), 
					'user_id' => $userid, 
					'affiliate_id' => $this->input->post('ref_id'), 
					'payment_status' => 'unpaid', 
					
                    'ssn_no' => $this -> input -> post('ssn_no'), 
                    'cpn_no' => $this -> input -> post('cpn_no'), 
                    'tax_no' => $this -> input -> post('tax_no'),
                    
                    'transunion' => $this -> input -> post('transunion'), 
                    'equifax' => $this -> input -> post('equifax'), 
                    'experion' => $this -> input -> post('experion'),
                    
                      'tax_transunion' => $this -> input -> post('tax_transunion'), 
                    'tax_equifax' => $this -> input -> post('tax_equifax'), 
                    'tax_experion' => $this -> input -> post('tax_experion'),
                    
                      'cpn_transunion' => $this -> input -> post('cpn_transunion'), 
                    'cpn_equifax' => $this -> input -> post('cpn_equifax'), 
                    'cpn_experion' => $this -> input -> post('cpn_experion'),
                    'is_delete' => 'NO',
                    'return_client' => 'NO',
                  //  'cpn_score' => $this -> input -> post('cpn_score'),
                    
					'reg_date' => $today
					);
		$this -> db -> insert('nc_client', $this -> security -> xss_clean($data));
		$clientid = $this -> db -> insert_id();
		$query = $this -> db -> query("Select  u.email, concat(c.firstname, ' ', c.lastname) as client_name from user as u inner join nc_client as c on c.user_id = u.user_id where u.id= (select user_id from nc_client where id = $clientid)");
		if ($query -> num_rows() > 0) {
			return $query -> row();
		} else {
			return 0;
		}
	}
	
	function getAffiliatePaymentInfo($affid){
		$query = $this->db->query("SELECT * FROM nc_affiliate WHERE affiliate_id = $affid");
		if($query->num_rows()>0){
			return $query->row();
		}
		return 0;
	}
	
	function getSingleClientFromreferrer($affid){
		$query = $this->db->query("SELECT * FROM nc_client WHERE affiliate_id = $affid");
		if($query->num_rows()>0){
			return $query->row();
		}
		return 0;
	}
	
	function paypalPaymentInsert($aid, $cid,$paytitle, $pamount, $payer_email, $txn_id, $pstatus){
		$today = date("Y-m-d H:i:s");
		$data1 = array(
        	'affiliate_id' => $aid,
        	'client_id' => $cid,
        	'payment_title' => $paytitle,
            'payment_amount' => $pamount,
            'payment_payer' => $payer_email,
            'payment_txn_id' => $txn_id,
            'payment_status' => $pstatus,
            'payment_date' => $today
	        );
	        $this->db->insert('nc_payment_client', $this->security->xss_clean($data1));
	        $userid = $this->db->insert_id();
		
		$query = $this->db->query("UPDATE nc_client SET  payment_status = 'paid' WHERE id = $cid ");
		if ($this->db->affected_rows() == '1') {
            $query = $this->db->query("SELECT * FROM nc_client WHERE id= $cid");
            return $query->row();
        }
        return FALSE;
	}
	
	function getaffiliateuser($id){
		$query = $this->db->query("Select a.user_id from nc_client as c inner join nc_affiliate as a on c.affiliate_id = a.affiliate_id where c.user_id = $id");
		return $query->row()->user_id;
	}
        
        
        function getClientListUnderreferrer($ref_id){

            $query = $this->db->query("SELECT c.* ,  (SELECT count(card_sell_id) FROM nc_card_sell WHERE card_sell_delete = 'NO' AND client_id = c.id) as noline FROM nc_client as c WHERE affiliate_id = '$ref_id' AND c.is_delete = 'NO' order by c.firstname ASC ");

            // $query = $this->db->query("SELECT c.* ,  (SELECT count(card_sell_id) FROM nc_card_sell WHERE client_id = c.id) as noline FROM nc_client as c WHERE affiliate_id = '$ref_id' AND c.is_delete = 'NO' order by c.firstname ASC ");

            
            
            if($query->num_rows()>0){
                return $query->result();
                
            }else{
                return 0;
            }
        }
        
        
        function getAllClientListUnderreferrer($ref_id){
            $query = $this->db->query("SELECT c.* ,  (SELECT count(card_sell_id) FROM nc_card_sell WHERE client_id = c.id) as noline FROM nc_client as c WHERE affiliate_id = '$ref_id' AND c.is_delete = 'NO' ");
            
            
            if($query->num_rows()>0){
                return $query->result();
                
            }else{
                return 0;
            }
        }
        
         function getReturnedClientListUnderreferrer($ref_id){
            $query = $this->db->query("SELECT c.* ,  (SELECT count(card_sell_id) FROM nc_card_sell WHERE client_id = c.id AND card_sell_delete = 'NO') as noline FROM nc_client as c WHERE affiliate_id = '$ref_id' AND c.is_delete = 'NO' AND c.return_client = 'YES'");
            
            
            if($query->num_rows()>0){
                return $query->result();
                
            }else{
                return 0;
            }
        }
        
   
        
        function getCompletedClientByLine($to_id){
            $query = $this->db->query("SELECT count(distinct client_id) as clientcount FROM nc_card_sell WHERE card_sell_delete = 'NO' AND card_sell_status = 'complete' AND to_id = '$to_id'");
            if($query->num_rows()>0){
                return $query->row();
                
            }else{
                return 0;
            }
        }
        
          function getProcessClientByLine($to_id){
            $query = $this->db->query("SELECT count(distinct client_id) as processclientcount FROM nc_card_sell WHERE card_sell_delete = 'NO' AND card_sell_status = 'process' AND to_id = '$to_id'");
            if($query->num_rows()>0){
                return $query->row();
                
            }else{
                return 0;
            }
        }
          
           function getAddedClientByTo($to_id){
            $query = $this->db->query("SELECT  cs.*, c.* , (SELECT COUNT(card_id) FROM nc_card_sell cs WHERE cs.client_id = c.id AND card_sell_status = 'complete') as countcard FROM nc_card_sell cs left join nc_client c on cs.client_id = c.id where cs.to_id = '$to_id' AND cs.card_sell_status = 'complete' AND cs.card_sell_delete = 'NO' group by cs.client_id");
            if($query->num_rows()>0){
                return $query->result();
                
            }else{
                return 0;
            }
        }
           
            function getPendingClientByTo($to_id){
            $query = $this->db->query("SELECT  cs.*, c.*, (SELECT COUNT(card_id) FROM nc_card_sell cs WHERE cs.client_id = c.id AND card_sell_status = 'process') as countcard FROM nc_card_sell cs left join nc_client c on cs.client_id = c.id where cs.to_id = '$to_id' AND cs.card_sell_status = 'process' AND cs.card_sell_delete = 'NO' group by cs.client_id ");
            if($query->num_rows()>0){
                return $query->result();
                
            }else{
                return 0;
            }
        }
           
           
         
           
          
                // function verifyClientListUnderreferrer($ref_id){
// 
            // $query = $this->db->query("SELECT c.* ,  (SELECT count(card_sell_id) FROM nc_card_sell WHERE client_id = c.id) as noline FROM nc_client as c WHERE affiliate_id = '$ref_id' AND c.is_delete = 'NO' AND return_client = 'NO' ");
// 
            // $query = $this->db->query("SELECT c.* ,  (SELECT count(card_sell_id) FROM nc_card_sell WHERE client_id = c.id) as noline FROM nc_client as c WHERE affiliate_id = '$ref_id' AND c.is_delete = 'NO' order by c.firstname ASC ");
// 
//             
//             
            // if($query->num_rows()>0){
                // return $query->result();
//                 
            // }else{
                // return 0;
            // }
        }
          
          

?>