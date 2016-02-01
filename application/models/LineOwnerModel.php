<?php

	class LineOwnerModel extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
			$this->load->helper('date');
			$this->load->library('email');
		}

		function countAll($cond)
		{
			$this->db->where($cond);
			$query = $this->db->get("nc_lineowner");
			return $query->num_rows();
		}

		function getAllPaginate($cond, $perPage, $offset)
		{
			$this->db->select('*');
			$this->db->from('nc_lineowner');
			$this->db->where($cond);
			$this->db->limit($perPage, $offset);
			$query = $this->db->get();
			if ($query->num_rows() > 0)
				return $query->result();
			return 0;
		}

		function getAdminDetails($id)
		{
			$query = $this->db->get_where('nc_line_owner', array('user_id' => $id));
			if ($query->num_rows() == 0) {
				return 0;
			} else {
				return $query->row();
			}
		}


		function getAll()
		{
			$userid = $this->session->userdata(USER_ID);
			$ref_id = $this->referrerModel->getreferrerIdFromUserId($this->session->userdata(USER_ID));
			$query = $this->db->query("Select t.*, (select count(card_id) from nc_credit_card where to_id = t.to_id AND card_is_delete = 'NO') as totalnumberofcards from nc_line_owner as t where (t.referrer_id = '$ref_id' || t.user_id = $userid) and t.to_is_delete = 'NO'");
			if ($query->num_rows() > 0)
				return $query->result();

			return 0;
		}


		function getAllWithPayments()
		{
			if (checkUserType() == 2) {
				$this->load->model('AffiliateModel');
				$referrerid = $this->AffiliateModel->getreferrerId($this->session->userdata(USER_ID));
				$query = $this->db->query("Select t.*,
                                                (select sum(card_sell_cost) from nc_card_sell where to_id = t.to_id AND card_sell_delete = 'NO' AND card_sell_status = 'complete') as card_sell_cost ,
                                                (select sum(card_sell_cost) from nc_card_sell where to_id = t.to_id AND card_sell_delete = 'NO' AND card_sell_status = 'complete' AND verify_status = 'verified') as verify_status ,
                                                (select count(card_id) from nc_credit_card where to_id = t.to_id AND card_is_delete = 'NO') as totalnumberofcards
                                                from nc_line_owner as t
                                                where t.to_is_delete = 'NO'
                                                AND  t.referrer_id = '$referrerid'");
				if ($query->num_rows() > 0) {
					return $query->result();
				} else {
					return 0;
				}
			} else {
				$query = $this->db->query("Select t.*,
                                                (select sum(card_sell_cost) from nc_card_sell where to_id = t.to_id AND card_sell_delete = 'NO' AND card_sell_status = 'complete') as card_sell_cost ,
                                                (select sum(card_sell_cost) from nc_card_sell where to_id = t.to_id AND card_sell_delete = 'NO' AND card_sell_status = 'complete' AND verify_status = 'verified') as verify_status ,
                                                (select count(card_id) from nc_credit_card where to_id = t.to_id AND card_is_delete = 'NO') as totalnumberofcards
                                                from nc_line_owner as t
                                                where t.to_is_delete = 'NO'
                                               ");
				if ($query->num_rows() > 0) {
					return $query->result();
				}
			}
		}

		function getAllCards($owner_id)
		{
			$query = $this->db->query("Select * from nc_line_owner_card_details where owner_id = $owner_id");
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return 0;
			}
		}

		function getLineOwnerDetail($to_id)
		{
			$query = $this->db->get_where('nc_line_owner', array('to_id' => $to_id));
			if ($query->num_rows() == 0) {
				return 0;
			} else {
				return $query->row();
			}
		}

		function deleteLineOwner($id)
		{
			$data = array('to_is_delete' => 'YES',);
			$this->db->where('to_id', $id);
			$this->db->update('nc_line_owner', $data);
			if ($this->db->affected_rows() > 0) {
				return TRUE;
			}
			return FALSE;
		}

		function deleteCard($card_id)
		{
			$data = array('to_is_delete' => 'YES',);
			$this->db->where('to_id', $card_id);
			if ($this->db->update('nc_line_owner', $data))
				return TRUE;
			else
				return FALSE;
		}


		function insert($code)
		{
			$today = date("Y-m-d");
			$data = array('line_owner_name' => $this->input->post('name'),
				'line_owner_address' => ucwords(trim($this->input->post('address'))),
				'line_owner_ssn' => $this->input->post('ssn'),
				'line_owner_email' => trim($this->input->post('email')),
				'line_owner_phone' => $this->input->post('phone'),
				'crtd_dt' => $today,
				'affiliate_id' => $this->session->userdata(USER_ID),
				'rcode' => $code);
			$this->db->insert('nc_line_owner', $this->security->xss_clean($data));
			$toid = $this->db->insert_id();
			return $toid;
		}

		function checkavailablecarddetails($code)
		{
			$query = $this->db->query("Select tcd.card_detail_id from
								nc_line_owner_card_details as tcd
								inner join nc_line_owner as tow
								on tow.owner_id = tcd.owner_id 
								where tow.rcode = '$code'");
			if ($query->num_rows() > 0) {
				return true;//available
			}
			return FALSE;
		}


		function insertInToUser($username, $password)
		{
			$today = date("Y-m-d");
			$priviledge = "";
			$val = $this->db->query("SELECT nc_auth_master.auth_id FROM nc_auth_master WHERE nc_auth_master.module IN (select modules from nc_lineowner_module_priviledge) order by nc_auth_master.auth_id");
			if ($val->num_rows() > 0) {
				$result = $val->result();
				$i = 1;
				foreach ($result as $value) {
					if ($i == $val->num_rows()) {
						$priviledge .= $value->auth_id;
					} else {
						$priviledge .= $value->auth_id . ",";
					}
					$i++;
				}
			}
			$data = array('user_name' => $this->input->post('fname') . ' ' . $this->input->post('lname'),
				'login_name' => $username,
				'login_pwd' => md5($password),
				'phone' => $this->input->post('pcon'),
				'address' => ucwords(trim($this->input->post('address'))),
				'user_type' => 'line',
				'email' => trim($this->input->post('email')),
				'status' => 'yes',
				'auth_id' => $priviledge,
				'crtd_dt' => $today);
			$this->db->insert('user', $this->security->xss_clean($data));
			$userid = $this->db->insert_id();

			return $userid;
		}

		function insertInToLineowner($userid)
		{
			$today = date("Y-m-d");
			$data = array(
				'to_fname' => ucwords(trim($this->input->post('fname'))),
				'to_mname' => ucwords(trim($this->input->post('mname'))),
				'to_lname' => ucwords(trim($this->input->post('lname'))),
				'to_email' => trim($this->input->post('email')),
				'to_pcon' => $this->input->post('pcon'),
				'to_address' => ucwords(trim($this->input->post('address'))),
				'to_ssn_no' => $this->input->post('to_ssn_no'),
				'to_transunion' => $this->input->post('to_transunion'),
				'to_equifax' => $this->input->post('to_equifax'),
				'to_experion' => $this->input->post('to_experion'),
				'to_payment_type' => $this->input->post('payment'),
				'to_paypal_id' => $this->input->post('paypal_id'),
				'to_reg_date' => $today,
				'user_id' => $userid,
				'referrer_id' => $this->input->post('ref_id'),

			);
			$this->db->insert('nc_line_owner', $this->security->xss_clean($data));
			$toid = $this->db->insert_id();
			$query = $this->db->query("Select  u.email, concat(t.to_fname, ' ', t.to_lname) as full_name from user as u inner join nc_line_owner as t on t.user_id = u.user_id where u.id= (select user_id from nc_line_owner where to_id = $toid)");
			if ($query->num_rows() > 0) {
				return $query->row();
			} else {
				return 0;
			}
		}

		function updateInline($value, $id, $field)
		{
			if ($field == 'to_fname') {
				$this->db->query("UPDATE nc_line_owner, user
                                           SET nc_line_owner.$field = '$value', user.user_name = '$value'
                                           WHERE nc_line_owner.user_id = user.user_id
                                           AND nc_line_owner.user_id = '$id'");
			} else {
				$this->db->query("update nc_line_owner set $field = '$value' where user_id = '$id'");
			}

			if ($field == 'to_lname') {
				$this->db->query("UPDATE nc_line_owner, user
                                           SET nc_line_owner.$field = '$value', user.user_name = '$value'
                                           WHERE nc_line_owner.user_id = user.user_id
                                           AND nc_line_owner.user_id = '$id'");
			} else {
				$this->db->query("update nc_line_owner set $field = '$value' where user_id = '$id'");
			}

			if ($field == 'to_mname') {
				$this->db->query("UPDATE nc_line_owner, user
                                           SET nc_line_owner.$field = '$value', user.user_name = '$value'
                                           WHERE nc_line_owner.user_id = user.user_id
                                           AND nc_line_owner.user_id = '$id'");
			} else {
				$this->db->query("update nc_line_owner set $field = '$value' where user_id = '$id'");
			}

			if ($field == 'to_email') {
				$this->db->query("UPDATE nc_line_owner, user
                                           SET nc_line_owner.$field = '$value', user.email = '$value'
                                           WHERE nc_line_owner.user_id = user.user_id
                                           AND nc_line_owner.user_id = '$id'");
			} else {
				$this->db->query("update nc_line_owner set $field = '$value' where user_id = '$id'");
			}
			if ($field == 'to_pcon') {
				$this->db->query("UPDATE nc_line_owner, user
                                           SET nc_line_owner.$field = '$value', user.phone = '$value'
                                           WHERE nc_line_owner.user_id = user.user_id
                                           AND nc_line_owner.user_id = '$id'");
			} else {
				$this->db->query("update nc_line_owner set $field = '$value' where user_id = '$id'");
			}
			if ($field == 'to_address') {
				$this->db->query("UPDATE nc_line_owner, user
                                           SET nc_line_owner.$field = '$value', user.address = '$value'
                                           WHERE nc_line_owner.user_id = user.user_id
                                           AND nc_line_owner.user_id = '$id'");
			} else {
				$this->db->query("update nc_line_owner set $field = '$value' where user_id = '$id'");
			}
			if ($this->db->affected_rows() == '1') {
				return TRUE;
			}
			return FALSE;
		}


		function getTradelinOwnerDetailsWithUserId($userid)
		{
			$query = $this->db->query("SELECT p.first_name, p.last_name, u.id FROM user u LEFT  JOIN profile p on p.user_id = u.id WHERE id = $userid");
			if ($query->num_rows() > 0) {
				return $query->row();
			} else {
				return 0;
			}
		}

		function getCardDetailsWithUserId($userid)
		{
			$query = $this->db->query("SELECT count(card_id) as countcard FROM nc_credit_card WHERE card_is_delete = 'NO' AND user_id = $userid");
			if ($query->num_rows() > 0) {
				return $query->row();
			} else {
				return 0;
			}
		}


		function updateIntoCardSell($cardsellid, $cardid)
		{
			$cardinfo = $this->CreditcardModel->getSingleCard($cardid);
			$close = $cardinfo->card_close_date;
			$closedate1 = $close . "-" . date("m-Y");
			$closedate1 = date('m/d/Y', strtotime($closedate1));
			$closedate = strtotime($closedate1);
			$today = date('m/d/Y');
			$todays = strtotime($today);
			if ($todays <= $closedate) {
				$added_date = $closedate1;
				$end_date = date("m/d/Y", strtotime("+2 month", strtotime($added_date)));
			} else {
				$added_date = date("m/d/Y", strtotime("+1 month", $closedate));
				$end_date = date("m/d/Y", strtotime("+3 month", $closedate));
			}
			$this->db->query("update nc_card_sell set  card_sell_status= 'complete', card_sell_com_date = '$today', card_sell_added_date = '$added_date', card_sell_end_date = '$end_date' where card_sell_id = '$cardsellid'");
			if ($this->db->affected_rows() == '1') {
				return TRUE;
			}
			return FALSE;
		}

		function add($date_str, $months)
		{
			$date = new DateTime($date_str);
			$start_day = $date->format('j');
			$date->modify("+{$months} month");
			$end_day = $date->format('j');
			if ($start_day != $end_day)
				$date->modify('last day of last month');
			return $date;
		}


		function updateInlineCard($value, $id, $field)
		{
			$this->db->query("update nc_credit_card set $field = '$value' where card_id = '$id'");
			if ($this->db->affected_rows() == '1') {
				return TRUE;
			}
			return FALSE;
		}

		function updateInlineCardSell($value, $id, $field)
		{
			$this->db->query("update nc_card_sell set $field = '$value' where card_sell_id = '$id'");
			if ($this->db->affected_rows() == '1') {
				return TRUE;
			}
			return FALSE;
		}

		function getCardLists()
		{
			$query = $this->db->query("SELECT ct.id, ct.type FROM line_type ct ORDER BY id ASC");
			if ($query->num_rows() > 1)
				return $query->result();
			else {
				return null;
			}

		}

		function deleteCardSell($cardsellid)
		{
			$data = array('card_sell_delete' => 'YES');
			$this->db->where('card_sell_id', $cardsellid);
			if ($this->db->update('nc_card_sell', $data))
				return TRUE;
			else
				return FALSE;
		}


		function notAddedCardSell($cardsellid)
		{
			date("Y-m-d H:i:s");
			$this->db->query("delete from nc_card_sell where card_sell_id = '$cardsellid'");
			if ($this->db->affected_rows() == '1') {
				return TRUE;
			}
			return FALSE;
		}

		function updateInlineAddedDate($value, $id, $field)
		{
			$this->db->query("update nc_card_sell set $field = '$value' where card_sell_id = '$id'");
			if ($this->db->affected_rows() == '1') {
				return TRUE;
			}
			return FALSE;
		}

		function completeDeleteCardSell($cardsellid)
		{
			date("Y-m-d H:i:s");
			$this->db->query("Delete from nc_card_sell where card_sell_id = $cardsellid");
			if ($this->db->affected_rows() == '1') {
				return TRUE;
			}
			return FALSE;
		}

		function DeleteToReturnClient($id)
		{
			$data = array('return_client' => 'YES',);
			$this->db->where('id', $id);
			if ($this->db->update('nc_client', $data))
				return TRUE;
			else
				return FALSE;
		}


		function insertReturnDate($x, $id)
		{
			$today = date("Y-m-d");
			$data = array('return_date' => $today, 'return_note' => $x);
			$this->db->where('id', $id);
			$this->db->update('nc_client', $this->security->xss_clean($data));
			if ($this->db->affected_rows() == '1') {
				return TRUE;
			}
			return FALSE;
		}

		function lineownerWithPayment($to_id)
		{
			$query = $this->db->query("select c.*, cc.* , cs.* from nc_card_sell cs left join nc_client c on cs.client_id = c.id
									  left join nc_credit_card cc on cs.card_id = cc.card_id WHERE cc.card_is_delete = 'NO' AND cs.card_sell_delete = 'NO' AND cs.card_sell_status = 'complete' AND cs.to_id = '$to_id'");
			if ($query->num_rows() > 0)
				return $query->result();
			return 0;
		}
	}

?>