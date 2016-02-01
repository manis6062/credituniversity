<?php

	class CreditcardModel extends CI_Model
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

		function getCreditCards($owner_id)
		{
			$query = $this->db->query("Select *,(SELECT count(card_sell_id) FROM nc_card_sell WHERE card_sell_status='process' AND card_sell_delete = 'NO' AND card_id = nc_credit_card.card_id) as card_sell_pro, (SELECT count(card_sell_id) FROM nc_card_sell WHERE card_id = nc_credit_card.card_id AND card_sell_delete = 'NO') as card_sell_au, (SELECT count(card_sell_id) FROM nc_card_sell WHERE card_sell_status='complete' AND card_id = nc_credit_card.card_id AND card_sell_delete = 'NO') as card_sell_com from nc_credit_card where to_id = $owner_id and card_is_delete = 'NO' and card_status = 'Active' order by card_close_date ASC");
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return 0;
			}
		}

		function getAllClientsByCard($cardid)
		{
			$query = $this->db->query("SELECT cs.* ,(SELECT concat(c.firstname, ' ', c.lastname) as fullname FROM nc_client c WHERE c.id = cs.client_id) as client_name FROM nc_card_sell cs WHERE cs.card_sell_delete = 'NO'  AND cs.card_id = '$cardid'");
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return 0;
			}
		}


		function insertClientsIntoCardSell($client_id, $price, $no_month, $card_id, $to_id, $ref_id, $brokerid)
		{
			$today = date("Y-m-d");
			$data = array(
				'card_id' => $card_id,
				'client_id' => $client_id,
				'to_id' => $to_id,
				'referrer_id' => $ref_id,
				'broker_id' => $brokerid,
				'card_sell_cost' => $charge,
				'card_sell_no_month' => $no_month,
				'card_sell_status' => 'process',
				'card_sell_pro_date' => $today,);
			$this->db->insert('nc_card_sell', $this->security->xss_clean($data));
			if ($this->db->affected_rows() > 0) {
				return TRUE;
			}
			return FALSE;
		}

		function insertLine()
		{
			$data = array(
				'user_Id' => $this->input->post('userId'),
				'type' => $this->input->post('type'),
				'name' => $this->input->post('name'),
				'bank' => $this->input->post('bank'),
				'url' => $this->input->post('url'),
				'phone' => $this->input->post('phone'),
				'lmt' => $this->input->post('lmt'),
				'balance' => $this->input->post('balance'),
				'open' => $this->input->post('open'),
				'statement' => $this->input->post('close'),
				'price' => $this->input->post('price'),
				'payment' => $this->input->post('payment'),
				'max' => $this->input->post('max'),
				'status' => $this->input->post('status'),
				'note' => $this->input->post('note')
			);
			$this->db->insert('line', $this->security->xss_clean($data));
			$cardid = $this->db->insert_id();
			return $cardid;
		}

		function checkavailablecarddetails($code)
		{
			$query = $this->db->query("Select tcd.card_detail_id from
								nc_line_owner_card_details as tcd
								inner join nc_line_owner as tow
								on tow.owner_id = tcd.owner_id 
								where tow.rcode = '$code'");
			if ($query->num_rows() > 0) {
				return true;
			}
			return FALSE;
		}

		function getAllCardOfAllLineOwner($broker_id)
		{
			$query = $this->db->query("
		    SELECT
                cc.*, towner.*, (SELECT count(card_sell_id) FROM nc_card_sell WHERE card_sell_status='complete' AND card_sell_delete='NO' AND card_id = cc.card_id) as card_sell_com ,
                (SELECT count(card_sell_id) FROM nc_card_sell WHERE card_sell_status='process' AND card_sell_delete='NO' AND card_id = cc.card_id) as card_sell_pro
                FROM
                referrer ref
                LEFT JOIN nc_line_owner towner ON ref.ref_id = towner.referrer_id
                LEFT JOIN nc_credit_card cc ON towner.to_id = cc.to_id
                WHERE towner.to_is_delete='NO'
                AND ref.broker_id = $broker_id
                AND cc.card_is_delete = 'NO'
                AND cc.card_status = 'Active'
                ORDER BY cc.card_close_date
                DESC
		");
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return 0;
			}
		}

		function getSingleCard($card)
		{

			$query = $this->db->query("SELECT * from nc_credit_card where card_id = '$card'");
			if ($query->num_rows() > 0) {
				return $query->row();
			} else {
				return 0;
			}
		}

		function getSingleCardSell($ref_id)
		{

			$query = $this->db->query("SELECT * from nc_card_sell where referrer_id = '$ref_id' AND card_sell_delete = 'NO'");
			if ($query->num_rows() > 0) {
				return $query->row();
			} else {
				return 0;
			}
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


		function updateInline($field, $value, $id)
		{
			$query = $this->db->query("update nc_card_sell set $field = '$value' where card_sell_id = '$id'");
			if ($this->db->affected_rows() == '1') {
				return TRUE;
			}
			return FALSE;
		}


		function updateInlineCard($field, $value, $id)
		{
			$query = $this->db->query("update nc_credit_card set $field = '$value' where card_id = '$id'");
			if ($this->db->affected_rows() == '1') {
				return TRUE;
			}
			return FALSE;
		}

		function getAllCreditCard($toid, $cstatus = '')
		{

			if ($cstatus == 'All') {
				$query = $this->db->query("SELECT cc.*, (SELECT count(card_sell_id) FROM nc_card_sell WHERE card_id = cc.card_id AND to_id = cc.to_id AND card_sell_status ='process' AND card_sell_delete = 'NO' ) as nocard, (SELECT count(card_sell_id) FROM nc_card_sell WHERE card_id = cc.card_id AND to_id = cc.to_id AND card_sell_status ='complete' AND card_sell_delete='NO') as countaddedcard  FROM nc_credit_card cc WHERE cc.to_id = $toid  AND cc.card_is_delete = 'NO'");
			} else {
				$query = $this->db->query("SELECT cc.*, (SELECT count(card_sell_id) FROM nc_card_sell WHERE card_id = cc.card_id AND to_id = cc.to_id AND card_sell_status ='process' AND card_sell_delete = 'NO' ) as nocard, (SELECT count(card_sell_id) FROM nc_card_sell WHERE card_id = cc.card_id AND to_id = cc.to_id AND card_sell_status ='complete' AND card_sell_delete='NO') as countaddedcard  FROM nc_credit_card cc WHERE cc.to_id = $toid  AND cc.card_is_delete = 'NO' AND cc.card_status ='$cstatus'");
			}
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return 0;
			}
		}


		function getAllCreditCardWithPayment($toid, $cstatus = '')
		{
			if ($toid != null) {
				if ($cstatus == 'All') {
					$query = $this->db->query("SELECT cc.*, (select sum(card_sell_cost) from nc_card_sell where card_id = cc.card_id AND card_sell_delete = 'NO' AND card_sell_status = 'complete') as card_sell_cost ,(select sum(card_sell_cost) from nc_card_sell where card_id = cc.card_id AND card_sell_delete = 'NO' AND card_sell_status = 'complete' AND verify_status = 'verified') as verify_status , (SELECT count(card_sell_id) FROM nc_card_sell WHERE card_id = cc.card_id AND to_id = cc.to_id AND card_sell_status ='process' AND card_sell_delete = 'NO' ) as nocard, (SELECT count(card_sell_id) FROM nc_card_sell WHERE card_id = cc.card_id AND to_id = cc.to_id AND card_sell_status ='complete' AND card_sell_delete='NO') as countaddedcard  FROM nc_credit_card cc WHERE cc.to_id = $toid  AND cc.card_is_delete = 'NO'");
				} else {
					$query = $this->db->query("SELECT cc.*,(select sum(card_sell_cost) from nc_card_sell where card_id = cc.card_id AND card_sell_delete = 'NO' AND card_sell_status = 'complete') as card_sell_cost ,(select sum(card_sell_cost) from nc_card_sell where card_id = cc.card_id AND card_sell_delete = 'NO' AND card_sell_status = 'complete' AND verify_status = 'verified') as verify_status ,(SELECT count(card_sell_id) FROM nc_card_sell WHERE card_id = cc.card_id AND to_id = cc.to_id AND card_sell_status ='process' AND card_sell_delete = 'NO' ) as nocard, (SELECT count(card_sell_id) FROM nc_card_sell WHERE card_id = cc.card_id AND to_id = cc.to_id AND card_sell_status ='complete' AND card_sell_delete='NO') as countaddedcard  FROM nc_credit_card cc WHERE cc.to_id = $toid  AND cc.card_is_delete = 'NO' AND cc.card_status ='$cstatus'");
				}
				if ($query->num_rows() > 0) {
					return $query->result();
				}
			}
		}

		function getAllClientRespectTo($cardid, $status)
		{
			$query = $this->db->query("SELECT * FROM nc_card_sell cs LEFT JOIN nc_client c ON cs.client_id = c.id  LEFT JOIN nc_credit_card cc ON cs.card_id = cc.card_id WHERE cs.card_id = $cardid AND cs.card_sell_status = '$status' AND cs.card_sell_delete='NO' ORDER BY cs.card_sell_status ASC  ");
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return 0;
			}
		}

		function getCardSell($to_id)
		{

			$query = $this->db->query("SELECT * from nc_card_sell where to_id = '$to_id'");
			if ($query->num_rows() > 0) {
				return $query->row();
			} else {
				return 0;
			}

		}

		function switchStatus($cardid, $status)
		{
			$data = array('card_status' => $status,);
			$this->db->where('card_id', $cardid);
			if ($this->db->update('nc_credit_card', $data))
				return TRUE;
			else
				return FALSE;
		}


		function getLinesOfClients($status)
		{
			$query = $this->db->query("SELECT  cs.client_id, cs.card_sell_id, cc.card_name, cc.type_id, cc.card_id  FROM nc_card_sell cs INNER JOIN nc_credit_card cc ON cs.card_id = cc.card_id WHERE card_sell_status = '$status' AND card_sell_delete = 'NO'");
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return 0;
			}
		}

		function getLinesOfAllClients()
		{
			$query = $this->db->query("SELECT  cs.client_id, cs.card_sell_id, cc.card_name, cc.type_id, cc.card_id  FROM nc_card_sell cs INNER JOIN nc_credit_card cc ON cs.card_id = cc.card_id AND card_sell_delete = 'NO'");
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return 0;
			}
		}

		function getReturnedLinesOfAllClients()
		{
			$query = $this->db->query("SELECT  cs.client_id, cs.card_sell_id, cc.card_name, cc.type_id, cc.card_id  FROM nc_card_sell cs INNER JOIN nc_credit_card cc ON cs.card_id = cc.card_id AND card_sell_delete = 'NO'");
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return 0;
			}
		}

		function getAllCardsLines()
		{
			$user_id = $this->session->userdata(USER_ID);
			$referrer = $this->AffiliateModel->getreferrerDetail($user_id);
			$referrer_id = $referrer->affiliate_id;
			$query = $this->db->query("SELECT
										nc_line_owner.to_fname,
										nc_line_owner.to_mname,
										nc_line_owner.to_lname,
										nc_credit_card.*
		FROM
		nc_line_owner
		INNER JOIN nc_credit_card ON nc_line_owner.to_id = nc_credit_card.to_id AND nc_line_owner.to_is_delete='NO' AND nc_credit_card.card_is_delete='NO'  where nc_line_owner.referrer_id=$referrer_id ORDER BY  nc_credit_card.card_close_date DESC");
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return 0;
			}
		}


		function changeVerifyStatus($card_sell_id)
		{
			$data = array('verify_status' => 'verify_to');
			$this->db->where('card_sell_id', $card_sell_id);
			if ($this->db->update('nc_card_sell', $data))
				return TRUE;
			else
				return FALSE;
		}

		function changeVerifyStatusToVerified($cardsellid)
		{

			$data = array('verify_status' => 'verified');
			$this->db->where('card_sell_id', $cardsellid);
			if ($this->db->update('nc_card_sell', $data)) {
				return TRUE;
			} else {
				return FALSE;
			}

		}


		function changeVerifyStatusToConfirmVerified($cardsellid)
		{
			$data = array('verify_status' => 'verify_ref');
			$this->db->where('card_sell_id', $cardsellid);
			if ($this->db->update('nc_card_sell', $data)) {
				return TRUE;
			} else {
				return FALSE;
			}

		}

		function getAlreadyAddedClient($cardid, $refid)
		{
			$query = $this->db->query("SELECT  c.firstname,c.middlename,c.lastname FROM nc_client c LEFT JOIN nc_card_sell cs ON c.id = cs.client_id WHERE cs.card_id = $cardid AND cs.card_sell_delete='NO' AND c.affiliate_id = $refid");
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return 0;
			}
		}

		function getAlreadyAddedReturnedClient($cardid, $refid)
		{

			$query = $this->db->query("SELECT  c.firstname,c.middlename,c.lastname FROM nc_client c LEFT JOIN nc_card_sell cs ON c.id = cs.client_id WHERE cs.card_id = $cardid AND cs.card_sell_delete='NO' AND c.return_client = 'YES' AND c.affiliate_id = $refid");
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return 0;
			}
		}

		function getNotAddedClient($cardid, $ref_id)
		{
			$query = $this->db->query("
									SELECT distinct(c.ssn_no),c.*, (SELECT count(card_sell_id) FROM nc_card_sell WHERE client_id = c.id AND card_sell_delete = 'NO') as noline
								FROM nc_client c
								LEFT JOIN nc_card_sell cs 
								ON c.affiliate_id = cs.referrer_id
								WHERE c.affiliate_id= $ref_id
								AND c.id NOT IN (SELECT client_id FROM nc_card_sell WHERE card_id = $cardid AND card_sell_delete='NO')
								AND c.is_delete = 'NO'
								  ORDER BY c.firstname");
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return 0;
			}
		}


		function getNotAddedReturnedClient($cardid, $refid)
		{
			$query = $this->db->query("
									SELECT distinct(c.ssn_no),c.*, (SELECT count(card_sell_id) FROM nc_card_sell WHERE client_id = c.id AND card_sell_delete = 'NO') as noline
								FROM nc_client c 
								LEFT JOIN nc_card_sell cs 
								ON c.affiliate_id = cs.referrer_id
								WHERE c.affiliate_id= $refid 
								AND c.id NOT IN (SELECT client_id FROM nc_card_sell WHERE card_id = $cardid AND card_sell_delete='NO')
								AND c.is_delete = 'NO' AND c.return_client = 'YES'
								  ORDER BY c.firstname");
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return 0;
			}
		}

		function getClientsOfEachLine_Payment($to_id)
		{

			$query = $this->db->query("SELECT
												nc_client.firstname,
												nc_client.lastname,
												nc_card_sell.card_sell_cost,
												nc_credit_card.card_name,
												nc_credit_card.type_id,
												nc_card_sell.card_sell_added_date,
												nc_card_sell.payment_status,
												nc_card_sell.card_sell_id,
												nc_card_sell.verify_status,
												nc_card_sell.card_sell_status,
												nc_card_sell.payment_paid_date_lineowner
												FROM
												nc_client
												INNER JOIN nc_card_sell ON nc_card_sell.client_id = nc_client.id
												INNER JOIN nc_credit_card ON nc_card_sell.card_id = nc_credit_card.card_id
												WHERE
												nc_credit_card.to_id = $to_id AND nc_card_sell.card_sell_delete='NO'
										
												AND nc_card_sell.card_sell_status = 'complete'
												
												ORDER BY nc_card_sell.card_sell_cost DESC");
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return 0;
			}
		}


		function getLineOwnerOfEachreferrer_Payment($refid)
		{
			if ($refid == '') return;
			$query = $this->db->query("SELECT
						nc_client.firstname,
						nc_client.lastname,
						nc_credit_card.type_id,
						nc_credit_card.card_name,
						nc_line_owner.to_fname,
						nc_line_owner.to_mname,
						nc_line_owner.to_lname,
						nc_card_sell.card_sell_cost,
						nc_card_sell.card_sell_added_date,
						nc_card_sell.card_sell_id,
						nc_card_sell.payment_paid_date_referrer,
						nc_card_sell.payment_status_referrer,
						nc_card_sell.verify_status,
						nc_card_sell.card_sell_status
						FROM
						nc_card_sell
						INNER JOIN nc_credit_card ON nc_credit_card.card_id = nc_card_sell.card_id
						INNER JOIN nc_line_owner ON nc_line_owner.to_id = nc_card_sell.to_id
						INNER JOIN nc_client ON nc_client.id = nc_card_sell.client_id
						WHERE
						nc_line_owner.referrer_id = $refid AND
                        nc_card_sell.card_sell_status = 'complete'
						ORDER BY nc_card_sell.card_sell_cost DESC");

			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return 0;
			}


		}

		function sumOfAmountofCollectable($refid)
		{
			$this->db->select_sum('card_sell_cost');
			$this->db->from('nc_card_sell');
			$this->db->where('card_sell_status', 'complete');
			$this->db->where('card_sell_delete', 'NO');
			$this->db->where('verify_status', 'verified');
			$this->db->where('referrer_id', $refid);
			$query = $this->db->get();
			return $query->result_array();
		}

		function sumOfAmountofReceivable($refid)
		{
			$this->db->select_sum('card_sell_cost');
			$this->db->from('nc_card_sell');
			$this->db->where('card_sell_status', 'complete');
			$this->db->where('card_sell_delete', 'NO');
			$this->db->where('referrer_id', $refid);
			$query = $this->db->get();
			return $query->result_array();
		}

		function sumOfAmountofCollectableLineOwner($line)
		{
			$this->db->select_sum('card_sell_cost');
			$this->db->from('nc_card_sell');
			$this->db->where('card_sell_status', 'complete');
			$this->db->where('card_sell_delete', 'NO');
			$this->db->where('verify_status', 'verified');
			$this->db->where('to_id', $line);
			$query = $this->db->get();
			return $query->result_array();
		}


		function sumOfAmountWithCardIDReceivable($ref_id, $card_id)
		{
			$this->db->select_sum('card_sell_cost');
			$this->db->from('nc_card_sell');
			$this->db->where('card_sell_status', 'complete');
			$this->db->where('card_sell_delete', 'NO');
			$this->db->where('referrer_id', $ref_id);
			$this->db->where('card_id', $card_id);
			$query = $this->db->get();
			return $query->result_array();
		}

		function sumOfAmountWithCardIDReceivableInProcess($ref_id, $card_id)
		{
			$this->db->select_sum('card_sell_cost');
			$this->db->from('nc_card_sell');
			$this->db->where('card_sell_delete', 'NO');
			$this->db->where('referrer_id', $ref_id);
			$this->db->where('card_id', $card_id);
			$query = $this->db->get();
			return $query->result_array();
		}


		function sumOfAmountWithCardIDCollectable($ref_id, $card_id)
		{
			$this->db->select_sum('card_sell_cost');
			$this->db->from('nc_card_sell');
			$this->db->where('card_sell_status', 'complete');
			$this->db->where('card_sell_delete', 'NO');
			$this->db->where('verify_status', 'verified');
			$this->db->where('referrer_id', $ref_id);
			$this->db->where('card_id', $card_id);
			$query = $this->db->get();
			return $query->result_array();
		}

		function sumOfAmountWithCardIDCollectableInProcess($ref_id, $card_id)
		{
			$this->db->select_sum('card_sell_cost');
			$this->db->from('nc_card_sell');
			$this->db->where('card_sell_delete', 'NO');
			$this->db->where('verify_status', 'verified');
			$this->db->where('referrer_id', $ref_id);
			$this->db->where('card_id', $card_id);
			$query = $this->db->get();
			return $query->result_array();
		}

		function sumOfAmountofReceivableLineOwner($line)
		{
			$this->db->select_sum('card_sell_cost');
			$this->db->from('nc_card_sell');
			$this->db->where('card_sell_status', 'complete');
			$this->db->where('card_sell_delete', 'NO');
			$this->db->where('to_id', $line);
			$query = $this->db->get();
			return $query->result_array();
		}

		function sumOfAmount($ref_id, $card_id)
		{
			$this->db->select_sum('card_sell_cost');
			$this->db->from('nc_card_sell');
			$this->db->where('referrer_id', $ref_id);
			$this->db->where('card_id', $card_id);
			$this->db->where('card_sell_delete', 'NO');
			$query = $this->db->get();
			return $query->result_array();
		}

		function sumOfAmountofReceivableLineOwnerWithCardId($to_id, $cardid)
		{
			$this->db->select_sum('card_sell_cost');
			$this->db->from('nc_card_sell');
			$this->db->where('to_id', $to_id);
			$this->db->where('card_id', $cardid);
			$this->db->where('card_sell_status', 'complete');
			$this->db->where('card_sell_delete', 'NO');
			$query = $this->db->get();
			return $query->result_array();
		}
	}

?>