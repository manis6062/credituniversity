<?php

class TaskModel extends AdminModel
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('date');
        $this->load->library('email');
        $this->load->library('encrypt');
        $this->load->helper('security');
    }


    function  insertRegistrationNotificationTask($userId)
    {
        $data = array(
            'user_id' => $userId,
            'task_type' => 'notification',
            'task_category' => 'client_registration',
            'task_title' => 'You\'ve registered Successfully.',
            'task_detail' => 'Wel-come to The Credit University. You\'ve registered as Client in Our System.',
            'startDate' => date('Y-m-d'),
            'completion' => date('Y-m-d'),

        );
        $this->db->insert('task', $this->security->xss_clean($data));
    }

    function taskExists($userId, $category)
    {
        return $this->db->query("select count(*) count from task a where a.user_id  = '$userId' and a.task_category = '$category'")->row()->count > 0;
    }


    function  insertClientPurchaseLineTask($client_id, $line_id)
    {
        $link = '<a href="'.base_url(ADMIN_PATH."line/lineAssignment").'" target="_blank">here</a>';
        list($brokerClient, $ownerLine) = $this->insertLinePurchaseNotificationTask($client_id, $line_id , $link);

    }

    public function insertLinePurchaseNotificationTask($client_id, $line_id , $link)
    {
        $brokerclient = $this->db->query("
                                        SELECT b.client_id, b.broker_id, concat_ws(' ',p.first_name, p.middle_initial, p.last_name) client
                                        FROM broker b
                                        LEFT JOIN profile p
                                        ON b.client_id = p.user_id
                                        WHERE b.client_id = $client_id
                        ")->row();
        $ownerline = $this->db->query("SELECT l.user_id, concat_ws(' - ', lt.bank, lt.type, lt.name, concat('$',l.lmt), l.statement, l.open) line
                                        FROM line l
                                        LEFT JOIN line_type lt
                                        ON l.type_id = lt.id
                                        WHERE l.id = $line_id")->row();

        $broker_clientName =  $brokerclient->client;
        $broker_id = $brokerclient->broker_id;
        $this->notifyBroker($broker_clientName,$broker_id ,$link );


        $line_detail = $ownerline->line;
        $owner_id = $ownerline->user_id;
        $this->notifyOwner($owner_id ,$client_id ,$link ,$line_detail , $broker_clientName );


        $this->notifyClient($line_detail ,$client_id ,$link);

        return array($brokerclient, $ownerline);
    }

    function sendEmails($email, $link ,$line_detail , $owner = NULL ,$broker_clientName ,$client_details)
    {
        $site_link = '<a href="'.base_url('member').'" target="_blank">here</a>';
        if (empty($owner)){
            $emailMessage = "You have been added to"  . $line_detail . ' '. ' Click' .' '. $site_link." to login ";
        }
        else{
            $emailMessage = $broker_clientName . " has been added to your card. "  . $line_detail . ' '. ' Click'. ' .'  . $site_link." to login .<br>" . "Client Details  : <br>" . "Personal Phone : " .$client_details->personal->phone ."<br>SSN : " .$client_details->ssn;
        }
        $msg = $emailMessage;
        $subject = "Added to the Card";
        $this->load->library('SimpleEmailService');
        $ses = new SimpleEmailService('AKIAISEC5PBG2F54VL4A', 'ZhRYSpKdUMLRrxPwy878UN+pJmnllAocdcYRpJwZ');
        $ses->enableVerifyPeer(false);
        $m = new SimpleEmailServiceMessage();
        $m->addTo($email);
        $m->setFrom($email_sender . '<' . EMAILSENDER . '>');
        $m->setSubject($subject);
        $message = $msg;
        $m->setMessageFromString('', $message);
        $ses->sendEmail($m);
        $this->session->set_flashdata("su_message", "Email Sent Successfully...");

    }

    function notifyBroker($broker_clientName,$broker_id ,$link){
        $today = date("Y-m-d");
        $data = array(
            'subject' => "Tradeline Bought",
            'msg' => $broker_clientName . ' has bought a card .' . 'Click '. $link." to review it." ,
            'date' => $today,
            'send_status' => 'Success',
            'user_id' => $broker_id,
        );
        $this->db->insert('emails', $this->security->xss_clean($data));
        $insert_id = $this->db->insert_id();

        $data = array(
            'email_id' => $insert_id,
            'receiver_id' => $broker_id,
            'senderEmail' => EMAILSENDER,

        );
        $this->db->insert('emails_receiver', $this->security->xss_clean($data));
    }

    function notifyOwner($owner_id ,$client_id ,$link , $line_detail ,$broker_clientName ){
        $owner_email = $this->UserModel->getEmailAddress($owner_id);
        $check_membership_owner = $this->MembershipModel->membershipExist($owner_id);
        if(empty($check_membership_owner)){

            $client_details = $this->UserModel->getUser($client_id);
            $this->sendEmails($owner_email ,$link, $line_detail , $owner = 1 ,$broker_clientName,$client_details );

        }
        else{
            $data = array(
                'user_id' => $owner_id,
                'task_type' => 'task',
                'task_category' => 'linePurchase',
                'task_title' => 'Add ' . $broker_clientName . ' to your line',
                'task_detail' => $broker_clientName . ' has bought your ' . $line_detail.'.' . "Click ".$link." to review it",
                'startDate' => date('Y-m-d'),
                'completion' => date('Y-m-d'),
            );
            $this->db->insert('task', $this->security->xss_clean($data));
            $insert_id = $this->db->insert_id();
            $this->insertTaskUser($insert_id ,$owner_id );
        }

    }

    function notifyClient($line_detail ,$client_id ,$link){
        $link = '<a href="'.base_url(ADMIN_PATH."line/lineAssignment").'" target="_blank">here</a>';
        $email = $this->UserModel->getEmailAddress($client_id);
        $check_membership_client = $this->MembershipModel->membershipExist($client_id);
        if(empty($check_membership_client)){
            $this->sendEmails($email ,$link,$line_detail ,$nonMemberClient = 1);
        }
        else{

            $today = date("Y-m-d");
            $data = array(
                'subject' => "Added to Card",
                'msg' => 'You have been added to ' . $line_detail,
                'date' => $today,
                'send_status' => 'Success',
                'user_id' => $client_id,
            );
            $this->db->insert('emails', $this->security->xss_clean($data));
            $insert_id = $this->db->insert_id();

            $data = array(
                'email_id' => $insert_id,
                'receiver_id' => $client_id,
                'senderEmail' => EMAILSENDER,

            );
            $this->db->insert('emails_receiver', $this->security->xss_clean($data));
        }

        $today = date("Y-m-d");
        $data = array(
            'subject' => "Tradeline Bought",
            'msg' => $brokerclient->client . ' has bought a Line',
            'date' => $today,
            'send_status' => 'Success',
            'user_id' => $this->session->userdata(USER_ID)?$this->session->userdata(USER_ID):'',
        );
        $this->db->insert('emails', $this->security->xss_clean($data));
        $insert_id = $this->db->insert_id();

        $data = array(
            'email_id' => $insert_id,
            'receiver_id' => $brokerclient->broker_id,
            'senderEmail' => EMAILSENDER,

        );
        $this->db->insert('emails_receiver', $this->security->xss_clean($data));
    }



    function getTasks($userid, $type, $status)

    {
         $query = $this->db->query("SELECT t.* , t_u.* , p.* , (SELECT concat(first_name, ' ', last_name) FROM profile p
                                                                 WHERE p.user_id = t.user_id) creator
                                                                FROM task t
                                                                left join task_user t_u on t.id = t_u.task_id
                                                                  left join profile p on p.user_id = t.user_id
                                                                WHERE t_u.user_id =$userid AND t.task_type = '$type'" . $status . " group by t_u.task_id DESC")->result();
        return $query;

    }


    function getTask($taskid)
    {
        $this->db->query("UPDATE task SET view = 'read' WHERE id =$taskid");
        return $this->db->query("SELECT * FROM task WHERE id=$taskid")->row();
    }

    function addTask($userId)
    {
        $data = array(
            'user_id' => $userId,
            'task_type' => 'task',
            'task_category' => 'goal',
            'task_title' => $this->input->post('title'),
            'task_detail' => '',
            'completion' => $this->formatDate($this->input->post('date')),
            'startDate' => $this->input->post('startDate')!=''?$this->formatDate($this->input->post('startDate')):$this->formatDate($this->input->post('date')),
        );
        $this->db->insert('task', $this->data($data));

            $insert_id = $this->db->insert_id();
            $data = array(
                'user_id' => $userId,
                'task_id' => $insert_id,
            );
            $this->db->insert('task_user', $this->data($data));
            
            /*
             * Share the task with users
             */
            $share_task_with = $this->input->post('share_goal');
            if(count($share_task_with)){
                foreach($share_task_with as $user){

                    /*
                     * Insert the relation of shared task
                     */
                    $this->TaskModel->insertTaskUser($insert_id, $user, $this->session->userdata(USER_ID));
                }
            }
        }


    function deleteTask($task_id  , $user_id)
        {
            $data = array(
                'id' => $task_id,
                'user_id' => $user_id
            );
            $this->db->delete('task', $this->security->xss_clean($data));
            $data = array(
                'task_id' => $task_id,
            );
            $this->db->delete('task_user', $this->security->xss_clean($data));
        }

    function ChangeToUnread($task_id)
    {
        return  $this->db->query("UPDATE task SET view = 'unread' WHERE id =$task_id");

    }

    function ChangeToComplete($task_id)
    {
        return  $this->db->query("UPDATE task SET status = 'complete', date_of_completion = CURDATE() WHERE id =$task_id");

    }

    function ChangeToInComplete($task_id)
    {
        return  $this->db->query("UPDATE task SET status = 'incomplete' WHERE id =$task_id");

    }

    function notifyAfterAddedToBroker($lineId, $clientId){
        list($brokerclient,$ownerline)= $this->ownerBrokerInfo($lineId, $clientId);
        $data = array(
            'user_id' => $brokerclient->broker_id,
            'task_type' => 'task',
            'task_category' => 'verify',
            'task_title' => 'Verify' .' ' . $brokerclient->client,
            'task_detail' => $brokerclient->client . ' has been Added to ' . $ownerline->line.'. Please Verify',
            'startDate' => date('Y-m-d'),
            'completion' => date('Y-m-d'),
        );
        $this->db->insert('task', $this->security->xss_clean($data));
        $insert_id = $this->db->insert_id();
        $data = array(
            'user_id' => $brokerclient->broker_id,
            'task_id' => $insert_id,
        );
        $this->db->insert('task_user', $this->data($data));


    }


    function notifyAfterAddedToClient($lineId, $clientId){
        list($brokerclient,$ownerline)= $this->ownerBrokerInfo($lineId, $clientId);

        $email = $this->UserModel->getEmailAddress($clientId);
        $check_membership_client = $this->MembershipModel->membershipExist($clientId);
        if(empty($check_membership_client)){
            $this->sendEmailsToClient($email , $ownerline->line);
        }
        $data = array(
            'user_id' => $clientId,
            'task_type' => 'task',
            'task_category' => 'verify',
            'task_title' => 'Added by Owner on this card' . ' ' . $ownerline->line . ' ' . 'for verify',
            'task_detail' => 'You hav been Added to ' . $ownerline->line.' '.'for verify',
            'startDate' => date('Y-m-d'),
            'completion' => date('Y-m-d'),
        );
        $this->db->insert('task', $this->security->xss_clean($data));
        $insert_id = $this->db->insert_id();
        $data = array(
            'user_id' => $clientId,
            'task_id' => $insert_id,
        );
        $this->db->insert('task_user', $this->data($data));


    }

    function sendEmailsToClient($email,$line_detail)
    {
        $site_link = '<a href="'.base_url('member').'" target="_blank">here</a>';
        $emailMessage = "You hav been added to your card by owner for verify. "  . $line_detail . ' '. ' Click'. ' .'  . $site_link." to login ";
        $msg = $emailMessage;
        $subject = "Added to the Card For Verify";
        $this->load->library('SimpleEmailService');
        $ses = new SimpleEmailService('AKIAISEC5PBG2F54VL4A', 'ZhRYSpKdUMLRrxPwy878UN+pJmnllAocdcYRpJwZ');
        $ses->enableVerifyPeer(false);
        $m = new SimpleEmailServiceMessage();
        $m->addTo($email);
        $m->setFrom($email_sender . '<' . EMAILSENDER . '>');
        $m->setSubject($subject);
        $message = $msg;
        $m->setMessageFromString('', $message);
        $ses->sendEmail($m);
        $this->session->set_flashdata("su_message", "Email Sent Successfully...");

    }






    function ownerBrokerInfo($lineId, $clientId){
        $brokerclient = $this->db->query("
                                        SELECT b.client_id, b.broker_id, concat_ws(' ',p.first_name, p.middle_initial, p.last_name) client
                                        FROM broker b
                                        LEFT JOIN profile p
                                        ON b.client_id = p.user_id
                                        WHERE b.client_id = $clientId
                        ")->row();
        $ownerline = $this->db->query("SELECT l.user_id, concat_ws(' - ', lt.bank, lt.type, lt.name, concat('$',l.lmt), l.statement, l.open) line
                                        FROM line l
                                        LEFT JOIN line_type lt
                                        ON l.type_id = lt.id
                                        WHERE l.id = $lineId")->row();

        return array($brokerclient, $ownerline);
    }

    function insertTaskUser($task_id , $userId, $brokerId = NULL)
    {
        $data = array(
            'user_id' => $userId,
            'task_id' => $task_id,
            'broker_id' => $brokerId
        );
        $this->db->insert('task_user', $data);
    }
    
    function getTaskUser($where = ''){
        return $this->db->get_where('task_user', $where)->row();
    }
    


}
