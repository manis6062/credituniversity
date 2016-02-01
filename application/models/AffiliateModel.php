<?php

	class AffiliateModel extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
			$this->load->helper('date');
			$this->load->library('email');
		}

		function countAll($cond = '')
		{
			if ($cond == '') {
				$query = $this->db->query("Select * from nc_affiliate");
			} else {
				$query = $this->db->query("Select * from nc_affiliate where $cond");
			}

			return $query->num_rows();
		}

		function getAll($cond = '')
		{
			if ($cond == '') {
				$query = $this->db->query('select a.*, ad.*,
								(select user_name from user where user_id = a.user_id) as affiliate ,(select count(to_id) from nc_line_owner where referrer_id = a.affiliate_id) as nolineowner
								from 
								nc_affiliate as a 
								inner join 
								nc_affiliate_detail as ad 
								on a.affiliate_id = ad.affiliate_id where is_delete = "NO" ');
			} else {
				$query = $this->db->query('select a.*, ad.*,
								(select user_name from user where user_id = a.user_id) as affiliate
								from 
								nc_affiliate as a 
								inner join 
								nc_affiliate_detail as ad 
								on a.affiliate_id = ad.affiliate_id 
								where is_delete = "NO"' . $cond);
			}
			if ($query->num_rows() > 0)
				return $query->result();
			return 0;
		}

		function clientLogin($username, $password, $role)
		{
			$this->db->where(array('email' => $username, 'password' => md5($password), 'role' => $role));
			$query = $this->db->get('nc_client');
			if ($query->num_rows() == 0) {
				return 0;
			} else {
				return $query->row();
			}
		}

		function getAdminDetails($id)
		{
			$query = $this->db->get_where('nc_client', array('id' => $id));
			if ($query->num_rows() == 0) {
				return 0;
			} else {
				return $query->row();
			}
		}

		function uniqueUserName($userid, $name)
		{
			$this->db->select('*');
			$this->db->from('nc_client');
			$this->db->where('username', $name);
			$this->db->where_not_in('id', $userid);
			$query = $this->db->get();
			return $query->num_rows();
		}

		function getAllUsersTemp()
		{
			$this->db->order_by("id", "DESC");
			$query = $this->db->get("nc_client");
			if ($query->num_rows() > 0)
				return $query->result();
			return 0;
		}

		function getSingleUsers($id)
		{
			$query = $this->db->query('select a.*, ad.*,
								(select user_name from user where user_id = a.user_id) as affiliate
								from 
								nc_affiliate as a 
								inner join 
								nc_affiliate_detail as ad 
								on a.affiliate_id = ad.affiliate_id 
								where a.user_id = ' . $id);
			if ($query->num_rows() > 0)
				return $query->row();
			return 0;
		}

		function checkEmailDuplicate($email)
		{
			$this->db->where('email', $email);
			$query = $this->db->get("nc_client");
			if ($query->num_rows() > 0)
				return TRUE;
			else
				return FALSE;
		}

		function checkPassword($password, $id)
		{
			$password = md5($password);
			$query = $this->db->query("Select * from nc_client where password = '$password' and id = '$id'");
			if ($query->num_rows() > 0)
				return TRUE;
			else
				return FALSE;
		}

		function update($id)
		{
			date("Y-m-d H:i:s");
			$data = array('firstname' => ucwords(trim($this->input->post('firstname'))), 'lastname' => ucwords(trim($this->input->post('lastname'))), 'scn' => $this->input->post('scn'), 'dob' => $this->input->post('dob'), 'address' => ucwords(trim($this->input->post('address'))), 'city' => ucwords(trim($this->input->post('city'))), 'state' => $this->input->post('state'), 'zip' => $this->input->post('zip'), 'phone' => $this->input->post('phone'), 'mobile' => $this->input->post('mobile'), 'email' => trim($this->input->post('email')), 'comments' => $this->input->post('comments'), 'role' => $this->input->post('role'),);
			$this->db->where("id", $id);
			$this->db->update('nc_client', $this->security->xss_clean($data));
			if ($this->db->affected_rows() > 0) {
				return TRUE;
			}
			return FALSE;
		}

		function passwordcode($email, $code)
		{
			date("Y-m-d H:i:s");
			$data = array('password_request_code' => $code);
			$this->db->where("email", $email);
			$this->db->update('nc_client', $this->security->xss_clean($data));
		}

		function checkCodegenerated($email)
		{
			$query = $this->db->query("Select password_request_code from nc_client where email = '$email'");
			if ($query->num_rows() > 0)
				return $query->row();

			return FALSE;
		}

		function updatePassword($id)
		{
			$data = array('password' => $this->input->post('password'));
			$this->db->where("id", $id);
			$this->db->update('nc_client', $this->security->xss_clean($data));
		}

		function updatePass()
		{
			$password = md5($this->input->post('password'));
			$code = $this->input->post('code');
			$this->db->query("Update nc_client set password = '$password' , password_request_code = '' where password_request_code = '$code'");
			if ($this->db->affected_rows() == '1') {
				return TRUE;
			}
			return FALSE;
		}

		function passwordupdate($id, $pass)
		{
			$pass = md5($pass);
			$this->db->query("Update nc_client set password = '$pass' where id = '$id'");
			if ($this->db->affected_rows() == '1') {
				return TRUE;
			}
			return FALSE;
		}

		function forpasswordchange($code)
		{
			$query = $this->db->query("select * from nc_client where password_request_code = '$code' and status = 'active'");
			if ($query->num_rows() > 0)
				return true;

			return false;
		}

		function deleteClient($userid)
		{
			$this->db->where('id', $userid);
			if ($this->db->delete('nc_client'))
				return TRUE;
			else
				return FALSE;
		}

		function updateStatus($id, $value)
		{
			$data = array('status' => $value);
			$this->db->where("id", $id);
			$this->db->update('nc_client', $this->security->xss_clean($data));
			if ($this->db->affected_rows() == '1') {
				return TRUE;
			}
			return FALSE;
		}

		function checkIdandCode($id, $code)
		{
			$query = $this->db->query("Select * from nc_client where id = '$id' and code = '$code'");
			if ($query->num_rows() > 0)
				return $query->row();

			return 0;
		}

		function insert($verification)
		{
			$today = date("Y-m-d H:i:s");
			$data = array('affiliate_fname' => ucwords(trim($this->input->post('afname'))), 'affiliate_lname' => ucwords(trim($this->input->post('alname'))), 'affiliate_email' => trim($this->input->post('aemail')), 'affiliate_business' => trim($this->input->post('abname')), 'affiliate_primary_contact' => $this->input->post('apcon'), 'affiliate_secondary_contact' => $this->input->post('ascon'), 'affiliate_partner_type' => $this->input->post('partner'), 'affiliate_verification' => $verification, 'affiliate_registered_date' => $today, 'affiliate_status' => 'N', 'is_delete' => 'NO',);
			$this->db->insert('nc_affiliate', $this->security->xss_clean($data));
			$userid = $this->db->insert_id();
			return $userid;
		}

		function activateClient($id, $code)
		{
			$this->db->query("update nc_client set status = 'active' where id = '$id' and code = '$code'");
			if ($this->db->affected_rows() == '1') {
				return TRUE;
			}
			return FALSE;
		}

		function getIncompleteAffiliate($vc)
		{
			$query = $this->db->query("SELECT * FROM nc_affiliate WHERE affiliate_verification = '$vc' AND affiliate_status = 'N'");
			if ($query->num_rows() == 1)
				return $query->row();

			return 0;
		}

		function insertDetail($username, $password)
		{
			$today = date("Y-m-d");
			$dname = $this->input->post('domainname');
			$domainid = '';

			if ($dname != '') {
				$data2 = array('domain_name' => $dname,);
				$this->db->insert('nc_domain', $this->security->xss_clean($data2));
				$domainid = $this->db->insert_id();

			}
			$userid = $this->UserModel->insertUsersIntoUserTable($username, $password, 4);
			if ($userid) {
				$data2 = array('user_id' => $userid, 'domain_id' => $domainid, 'affiliate_fname' => ucwords(trim($this->input->post('fname'))), 'affiliate_mname' => ucwords(trim($this->input->post('mname'))), 'affiliate_lname' => ucwords(trim($this->input->post('lname'))), 'affiliate_email' => trim($this->input->post('email')), 'affiliate_business' => trim($this->input->post('bname')), 'affiliate_primary_contact' => $this->input->post('pcon'), 'affiliate_secondary_contact' => $this->input->post('scon'),
					'affiliate_paypal_account' => 'Add Merchant ID', 'affiliate_registered_date' => $today, 'affiliate_status' => 'Y', 'affiliate_payment_status' => 'N', 'is_delete' => 'NO',);
				$this->db->insert('nc_affiliate', $this->security->xss_clean($data2));
				$refid = $this->db->insert_id();
			}

			if ($refid) {
				$data3 = array('affiliate_detail_gender' => $this->input->post('gender'), 'affiliate_detail_city' => $this->input->post('city'), 'affiliate_detail_state' => $this->input->post('state'), 'affiliate_detail_zip' => $this->input->post('zip'), 'affiliate_detail_address' => ucwords(trim($this->input->post('address'))), 'affiliate_detail_ssn' => $this->input->post('ssn'), 'affiliate_detail_dob' => $this->input->post('dob'), 'affiliate_detail_date' => $today, 'affiliate_id' => $refid,);
				$this->db->insert('nc_affiliate_detail', $this->security->xss_clean($data3));
				$this->db->insert_id();
			}

		}

		function checkUserExist()
		{
			date("Y-m-d H:i:s");
			$uname = $this->input->post('username');
			$query = $this->db->query("Select * from user where login_name = '$uname'");
			if ($query->num_rows() > 0)
				return true;
			return false;
		}

		function getStates()
		{
			$query = $this->db->query("SELECT * FROM states ORDER BY id ASC");
			if ($query->num_rows() > 1)
				return $query->result();
			return 0;
		}

		function getAffiliateSessionValues($affid)
		{
			$query = $this->db->query("SELECT a.*,  u.user_name FROM nc_affiliate as a inner join user as u on a.user_id = u.user_id WHERE a.affiliate_id = $affid");
			if ($query->num_rows() == 1)
				return $query->row();
			return 0;
		}

		function domainCheck($domain)
		{
			$query = $this->db->query("SELECT * FROM nc_domain WHERE domain_name = '$domain'");
			if ($query->num_rows() == 1)
				return $query->row()->domain_id;
			return 0;
		}

		function checkAffiliatePaymentSatus($affid)
		{
			$query = $this->db->query("SELECT * FROM nc_affiliate WHERE affiliate_id= '$affid'");
			if ($query->num_rows() == 1)
				return $query->row();
			return 0;
		}

		function checkreferrerPaymentSatus($userid)
		{
			$query = $this->db->query("SELECT * FROM nc_affiliate WHERE user_id= '$userid'");
			if ($query->num_rows() == 1)
				return $query->row();
			return 0;
		}

		function checkAffiliatePaymentSatusFront($domainid)
		{
			$query = $this->db->query("SELECT affiliate_payment_status FROM nc_affiliate WHERE domain_id= '$domainid'");
			if ($query->num_rows() == 1)
				return $query->row()->affiliate_payment_status;
			return 0;
		}

		function getrefid($userid)
		{
			$this->db->select('affiliate_id');
			$query = $this->db->get_where('nc_affiliate', array('user_id' => $userid));
			if ($query->num_rows() > 0) {
				return $query->row()->affiliate_id;
			}
			return 0;
		}

		function paypalPyamentInsert($fee = '', $aid, $paytitle, $pamount, $payer_email, $txn_id, $pstatus)
		{
			$today = date("Y-m-d H:i:s");
			$data1 = array('user_id' => $aid, 'payment_title' => $paytitle, 'payment_amount' => $pamount, 'payment_payer' => $payer_email, 'payment_txn_id' => $txn_id, 'payment_status' => $pstatus, 'payment_date' => $today);
			$this->db->insert('nc_payment', $this->security->xss_clean($data1));
			$this->db->insert_id();
			if ($fee == '') {
				$this->db->query("UPDATE nc_affiliate SET  affiliate_payment_status = 'Y'  WHERE user_id = $aid ");
			}
			if ($this->db->affected_rows() == '1') {
				$query = $this->db->query("SELECT * FROM nc_affiliate WHERE user_id= $aid");
				return $query->row();
			}
			return FALSE;
		}

		function getemployment($ref_id)
		{
			$query = $this->db->query("Select * from nc_employment_details where user_id = $ref_id and (user_type = 'affiliate' or user_type = 'referrer')");
			if ($query->num_rows() > 0) {
				return $query->result();
			}
			return 0;
		}

		function deleteRef($affiliate_id)
		{
			$data = array('is_delete' => 'YES',);
			$this->db->where('affiliate_id', $affiliate_id);
			if ($this->db->update('nc_affiliate', $data)) {
				return TRUE;
			} else
				return FALSE;
		}

		function checkcodeanduseravailability($code)
		{
			$this->db->select('request_to_emails');
			$query = $this->db->get_where('nc_request_for_signup', array('rcode' => $code, 'request_to_type' => 'referrer'));
			if ($query->num_rows() > 0) {
				$row = $query->row();
				$this->db->select('user_id');
				$query = $this->db->get_where('user', array('email' => $row->request_to_emails));
				if ($query->num_rows() > 0) {
					return FALSE;
				} else {
					return $row->request_to_emails;
				}
			}
			return FALSE;
		}

		function insertemp($type)
		{
			date("Y-m-d H:i:s");
			$data = array('experience' => ucwords($this->input->post('experience')), 'designation' => ucwords($this->input->post('designation')), 'company' => ucwords($this->input->post('company')), 'user_id' => $this->input->post('user_id'), 'user_type' => $type);
			$this->db->insert('nc_employment_details', $this->security->xss_clean($data));
			$empid = $this->db->insert_id();
			$query = $this->db->query("Select * from nc_employment_details where emp_id = $empid");
			if ($query->num_rows() > 0) {
				return $query->row();
			} else {
				return 0;
			}
		}

		function deleteEmp($emp_id)
		{
			$this->db->query("delete from nc_employment_details where emp_id = $emp_id");
			if ($this->db->affected_rows() > 0) {
				return TRUE;
			}
			return FALSE;
		}

		function updateInline($field, $value, $id, $type = '')
		{
			if ($type == '') {
				if ($field == 'affiliate_email') {
					$this->db->query("UPDATE nc_affiliate, user
                                           SET nc_affiliate.$field = '$value', user.email = '$value'
                                           WHERE nc_affiliate.user_id = user.user_id
                                           AND nc_affiliate.user_id = '$id'");
				} else {
					$this->db->query("update nc_affiliate set $field = '$value' where user_id = '$id'");
				}

				if ($field == 'affiliate_fname') {
					$this->db->query("UPDATE nc_affiliate, user
                                           SET nc_affiliate.$field = '$value', user.user_name = '$value'
                                           WHERE nc_affiliate.user_id = user.user_id
                                           AND nc_affiliate.user_id = '$id'");
				} else {
					$this->db->query("update nc_affiliate set $field = '$value' where user_id = '$id'");
				}

				if ($field == 'affiliate_lname') {
					$this->db->query("UPDATE nc_affiliate, user
                                           SET nc_affiliate.$field = '$value', user.user_name = '$value'
                                           WHERE nc_affiliate.user_id = user.user_id
                                           AND nc_affiliate.user_id = '$id'");
				} else {
					$this->db->query("update nc_affiliate set $field = '$value' where user_id = '$id'");
				}

				if ($field == 'affiliate_primary_contact') {
					$this->db->query("UPDATE nc_affiliate, user
                                           SET nc_affiliate.$field = '$value', user.phone = '$value'
                                           WHERE nc_affiliate.user_id = user.user_id
                                           AND nc_affiliate.user_id = '$id'");
				} else {
					$this->db->query("update nc_affiliate set $field = '$value' where user_id = '$id'");
				}

				if ($field == 'affiliate_secondary_contact') {
					$this->db->query("UPDATE nc_affiliate, user
                                           SET nc_affiliate.$field = '$value', user.cell = '$value'
                                           WHERE nc_affiliate.user_id = user.user_id
                                           AND nc_affiliate.user_id = '$id'");
				} else {
					$this->db->query("update nc_affiliate set $field = '$value' where user_id = '$id'");
				}


			} else {
				$this->db->query("update nc_affiliate_detail set $field = '$value' where affiliate_id = '$id'");
			}
			if ($this->db->affected_rows() == '1') {
				return TRUE;
			}
			return FALSE;
		}

		function updateEmpInline($field, $value, $id)
		{
			$this->db->query("update nc_employment_details set $field = '$value' where emp_id = '$id'");
			if ($this->db->affected_rows() == '1') {
				return TRUE;
			}
			return FALSE;
		}

		function getaffiliateid($user_id)
		{
			$query = $this->db->query("select affiliate_id from nc_affiliate where user_id = $user_id");
			return $query->row()->affiliate_id;
		}

		function getreferrerId($user_id)
		{
			$query = $this->db->query("select ref_id from referrer where user_id = $user_id");
			if ($query->num_rows() > 0) {
				return $query->row()->ref_id;
			}
		}

		function getreferrerDetail($userid)
		{
			$query = $this->db->query("SELECT * FROM nc_affiliate WHERE user_id = $userid");
			return $query->row();
		}

		function getreferrerDetailByRefId($affiliate_id)
		{
			$query = $this->db->query("SELECT * FROM nc_affiliate WHERE affiliate_id = $affiliate_id");
			return $query->row();

		}

		public function addedClientsRef($broker_id)
		{
			$query = $this->db->query("SELECT
                                    nc_card_sell.*,
                                    nc_line_owner.to_fname,
                                    nc_line_owner.to_mname,
                                    nc_line_owner.to_lname,
                                    nc_client.id,
                                    nc_card_sell.referrer_id,
                                    nc_card_sell.card_sell_added_date,
                                    nc_credit_card.card_name,
                                    nc_credit_card.type_id,
                                    nc_client.firstname,
                                    nc_client.lastname
                                    FROM
                                    nc_card_sell
                                    LEFT JOIN  nc_client ON nc_card_sell.client_id = nc_client.id
                                    LEFT JOIN nc_line_owner ON nc_card_sell.to_id = nc_line_owner.to_id
                                    LEFT JOIN nc_credit_card ON nc_card_sell.card_id = nc_credit_card.card_id
                                    WHERE
                                    nc_card_sell.card_sell_status = 'complete' AND
                                    nc_card_sell.card_sell_delete = 'NO' AND
                                    nc_client.is_delete = 'NO' AND
                                    nc_line_owner.to_is_delete = 'NO' AND
                                    nc_credit_card.card_is_delete = 'NO' AND
                                    nc_credit_card.card_status = 'Active' AND
                                    nc_card_sell.broker_id = '$broker_id'
                                    ");
			return $query->result();
		}

		public function pendingClients($broker_id)
		{
			$query = $this->db->query("SELECT
                                        nc_card_sell.card_sell_id,
                                        nc_line_owner.to_fname,
                                        nc_line_owner.to_mname,
                                        nc_line_owner.to_lname,
                                        nc_client.id,
                                        nc_card_sell.referrer_id,
                                        nc_card_sell.card_sell_added_date,
                                        nc_credit_card.card_name,
                                        nc_credit_card.type_id,
                                        nc_client.firstname,
                                        nc_client.lastname
                                        FROM
                                        nc_card_sell
                                        LEFT JOIN  nc_client ON nc_card_sell.client_id = nc_client.id
                                        LEFT JOIN nc_line_owner ON nc_card_sell.to_id = nc_line_owner.to_id
                                        LEFT JOIN nc_credit_card ON nc_card_sell.card_id = nc_credit_card.card_id
                                        WHERE
                                        nc_card_sell.card_sell_status = 'process' AND
                                        nc_card_sell.card_sell_delete = 'NO' AND
                                        nc_client.is_delete = 'NO' AND
                                        nc_line_owner.to_is_delete = 'NO' AND
                                        nc_credit_card.card_is_delete = 'NO' AND
                                        nc_card_sell.broker_id = '$broker_id'
                                ");
			return $query->result();
		}

		function geBrokerIdFromUserId($userid)
		{
			$this->db->select('affiliate_id');
			$query = $this->db->get_where('nc_affiliate', array('user_id' => $userid));
			if ($query->num_rows() > 0) {
				return $query->row()->affiliate_id;
			}
			return 0;
		}
	}

?>