<?php

class EmailsModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('date');
        $this->load->library('email');
        $this->load->helper('security');

    }


	function getAll()
{
	$query = $this->db->query("SELECT DISTINCT (u.id),u.email, p.first_name , p.middle_initial , p.last_name FROM user u
                                   LEFT JOIN user_role r on u.id = r.user_id
                                   INNER JOIN profile p on u.id = p.user_id
								");
	if ($query->num_rows() > 0) {
		return $query->result();
	}
	return 0;
}

	function getAllByRoles($role_id)
	{
		$query = $this->db->query("SELECT  DISTINCT (u.id),u.email ,p.first_name , p.middle_initial , p.last_name FROM user u
                                   LEFT JOIN user_role r on u.id = r.user_id
                                   INNER JOIN profile p on u.id = p.user_id
                                   where role_id = $role_id
								");
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return 0;
	}



	function received_emails($user_id)

	{
		$query = $this->db->query("SELECT e.* , e_r.* , (SELECT first_name from `profile` where user_id = e_r.receiver_id) as receiver from emails e
INNER JOIN `profile` p on e.user_id = p.user_id
INNER JOIN emails_receiver e_r on e.id = e_r.email_id
where e_r.receiver_is_delete = 'no' and e_r.receiver_id = $user_id order by e.date ASC
");
	if ($query->num_rows() > 0)
			return $query->result();
	}

	function sent_emails($user_id )

	{
		$query = $this->db->query("SELECT e.* ,  e_r.* ,(SELECT CONCAT_WS(' ' ,first_name ,middle_initial ,last_name) from `profile` where user_id = e_r.receiver_id) as sender from emails e
INNER JOIN `profile` p on e.user_id = p.user_id
INNER JOIN emails_receiver e_r on e.id = e_r.email_id
where  e_r.sender_is_delete = 'no'  and e_r.sender_id = $user_id order by e.date ASC");


           if ($query->num_rows() > 0)
	       return $query->result();
	}

	function trash_emails($user_id)
	{
		$query = $this->db->query("SELECT e.* ,  e_r.* ,(SELECT CONCAT_WS(' ' ,first_name ,middle_initial ,last_name) from `profile` where user_id = e_r.sender_id) as sender ,(SELECT first_name from `profile` where user_id = e_r.receiver_id) as receiver from emails e
INNER JOIN `profile` p on e.user_id = p.user_id
INNER JOIN emails_receiver e_r on e.id = e_r.email_id
where e_r.trash_is_delete = 'no' and (e_r.sender_is_delete = 'yes' or receiver_is_delete = 'yes') and (e_r.receiver_id = $user_id or e_r.sender_id = $user_id) order by e.date ASC");
		if ($query->num_rows() > 0)
			return $query->result();
	}

	function read_mail($mail_id)
	{
		$query = $this->db->query("SELECT e.* , e_r.* , (SELECT first_name from `profile` where user_id = e_r.sender_id) as sender ,(SELECT first_name from `profile` where user_id = e_r.receiver_id) as receiver  from emails e
             INNER JOIN emails_receiver e_r on e.id = e_r.email_id where e.id = $mail_id GROUP BY e.id order by e.date ASC ");
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return 0;
	}


	function insertEmails($status,$receiver_ids,$to_newUser)

	{
		$receiver = implode(',' , $to_newUser);
		$today = date("Y-m-d");
		$data = array(
			'subject' => $this->input->post('subject'),
			'msg' => $this->input->post('msg'),
			'date' => $today,
			'send_status' => $status,
			'user_id' => $this->session->userdata(USER_ID),
		);
			$this->db->insert('emails', $this->security->xss_clean($data));
		$insert_id = $this->db->insert_id();

		if(count($receiver_ids) > 0){
			foreach($receiver_ids as $val){
				$data = array(
					'email_id' => $insert_id,
					'receiver_id' =>$val,
                    'sender_id' =>$this->session->userdata(USER_ID),
                );
				$this->db->insert('emails_receiver', $this->security->xss_clean($data)); }
			}
		else{
			$data = array(
				'email_id' => $insert_id,
				'receiver' => $receiver,
                'sender_id' => $this->session->userdata(USER_ID));
			$this->db->insert('emails_receiver', $this->security->xss_clean($data));

		}

	}
	function deleteEmailsFromInbOx($mail_id , $receiver_id)
	{
		$query = $this->db->query("update emails_receiver set receiver_is_delete = 'yes' where email_id = $mail_id and receiver_id = $receiver_id");
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		}
		return false;
	}


    function deleteEmailsFromSent($mail_id , $receiver_id)
    {
        $query = $this->db->query("update emails_receiver set sender_is_delete = 'yes' where email_id = $mail_id and receiver_id = $receiver_id");
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        }
        return false;
    }


    function deleteEmailsFromTrash($mail_id , $receiver_id)
    {
        $query = $this->db->query("update emails_receiver set trash_is_delete = 'yes' where email_id = $mail_id and receiver_id = $receiver_id");
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        }
        return false;
    }


	function permanentDelete($mail_id)
	{
		foreach($mail_id as $array){
		$this->db->query("delete from emails where id = $array");}
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		}
		return false;
	}


	function countAllReceivedItems($user_id)
	{
		$query = $this->db->query("SELECT e.* , e_r.* , (SELECT first_name from `profile` where user_id = e_r.receiver_id) as receiver from emails e
INNER JOIN `profile` p on e.user_id = p.user_id
INNER JOIN emails_receiver e_r on e.id = e_r.email_id
where e_r.receiver_is_delete = 'no' and e_r.receiver_id = $user_id  and e_r.display = 'unseen' order by e.date ASC");


		return $query->num_rows();
	}

	function changedToSeen($user_id)
	{
		$query = $this->db->query("update emails_receiver set display = 'seen' where receiver_id = $user_id");
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		}
		return false;
	}

	function deleteMultipleEmails($mail_id)

	{
            foreach($mail_id as $id){
                $explode = explode('/' ,$id );
                print_r($explode); die;

            }




        foreach($explode1 as $delete){
            print_r($delete); die;
            $this->db->query("update emails_receiver set is_delete = 'yes' where email_id = $delete[0] and receiver_id =  $delete[1] ");

        }
        foreach($explode2 as $delete1){
            $this->db->query("update emails_receiver set is_delete = 'yes' where email_id = $delete1[0] and receiver_id =  $delete1[1] ");
        }



        if ($this->db->affected_rows() > 0) {
			return TRUE;
		}
		return false;
	}


	/*---------------------------------OLD CODES----------------------------------------*/


    function getallreferrer()
    {
        $query = $this->db->query("SELECT
								u.email,
								u.user_name
								FROM user AS u
								WHERE
								(u.user_type = 'affiliate' || u.user_type = 'referrer')");
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return 0;
    }

    function getReceivers($receivers)
    {
        $allreceivers = '';
        $receivers = explode(',', $receivers);
        $total = sizeof($receivers);
        $i = 1;
        if ($total > 0) {
            while ($i <= $total) {
                $this->db->select('user_name');
                $query = $this->db->get_where('user', array('user_id' => $receivers[$i - 1]));
                if ($allreceivers == '' && $i == $total) {
                    $allreceivers .= $query->row()->user_name;
                } elseif ($allreceivers == '' && $i != $total) {
                    $allreceivers .= $query->row()->user_name . ', ';
                } elseif ($allreceivers != '' && $i == $total) {
                    $allreceivers .= $query->row()->user_name;
                } else {
                    $allreceivers .= $query->row()->user_name . ', ';
                }
                $i++;
            }
        }
        return $allreceivers;
    }

//    function deleteEmails($email_id)
//    {
//        $query = $this->db->query("delete from nc_emails where email_id = $email_id");
//        if ($this->db->affected_rows() > 0) {
//            return TRUE;
//        }
//        return false;
//    }

    function getSuperAdmin()
    {
        $query = $this->db->query("Select email, user_id from user where role_privilege= '2'");
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return 0;
    }

    function getIds($emailsto)
    {
        $sql = "Select user_id from user where email in (";
        $emailsto = explode(',', $emailsto);
        if (sizeof($emailsto) > 0) {
            if (sizeof($emailsto) == 1) {
                $sql .= "'$emailsto[0]'";
            } else {
                $size = sizeof($emailsto);
                $i = 1;
                foreach ($emailsto as $key => $value) {
                    $email = trim($value);
                    if ($i == $size) {
                        $sql .= "'$email'";
                    } elseif ($key == 0) {
                        $sql .= "'$email',";
                    } else {
                        $sql .= "'$email',";
                    }
                    $i++;
                }
            }
        }
        $sql .= ")";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $array = array();
            $result = $query->result();
            foreach ($result as $key => $value) {
                array_push($array, $value->user_id);
            }
            return $array;
        }
        return 0;
    }

    function getaffiliate($id)
    {
        $query = $this->db->query("select user_name from user where user_id = $id");
        return $query->row()->user_name;
    }
}

?>