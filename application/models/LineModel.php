<?php

class LineModel extends AdminModel
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('date');
        $this->load->library('email');
        $this->load->model('UserModel');
        $this->load->model('TaskModel');
        $this->load->model('MembershipModel');

    }

    public function getAllPurchaseLines()
    {
        return $this->db->query("SELECT l.id, l.user_id, concat(p.first_name , ' ' , p.last_name) user, l.type_id,
                                        concat_ws(' , ', lt.bank, lt.type, lt.name, concat('Limit : $',l.lmt), concat('Statement : ' ,l.statement ), concat('Opened : ' ,l.open )) line,
                                        l.lmt, l.balance, l.open, l.statement, l.price, l.broker_price,  COALESCE(l.client_broker_price,(l.broker_price + (bu.client_commission * l.broker_price)/100)) client_broker_price,
                                        l.payment, l.max, l.status, l.note, l.used, concat_ws('  ', lt.bank, lt.type, lt.name, concat('Limit ',l.lmt), concat('Statement ' ,l.statement ), concat('Opened ' ,l.open )) itemName
                                        FROM line l
                                        LEFT JOIN profile p ON p.user_id = l.user_id
                                        LEFT JOIN line_type lt ON lt.id = l.type_id
                                        LEFT JOIN broker b ON b.client_id = l.user_id
                                        LEFT JOIN business bu ON bu.user_id = b.broker_id
                                        WHERE (bu.client_commission IS NOT NULL AND bu.client_commission != 0)
                                        AND (l.broker_price IS NOT NULL AND l.broker_price != 0)
                                        AND (l.price IS NOT NULL OR l.price != 0)
                                        AND l.status = 1 ")->result();
    }

    function clientBrokerCommission()
    {
        $clientBrokerId = $this->session->userdata(USER_ID);
        return $this->db->query("select b.owner_commission owner_commission from business b where b.user_id = '$clientBrokerId'")->row()->owner_commission;
    }

    public function getAllBrokerLines($brokerId)
    {
        $brokers = $this->UserModel->getBrokerHierarchy($brokerId, false, true, true);
        return $this->db->query("SELECT l.id, b.* , l.user_id, concat(p.first_name , ' ' , p.last_name) user, l.type_id, concat_ws(' - ', lt.bank, lt.type, lt.name, concat('$',l.lmt), day(l.statement),
                                        year(l.open)) line, l.lmt, l.balance, l.open, l.statement, l.price, l.broker_price, l.broker_price + (bu.client_commission * l.broker_price)/100 client_broker_price,
                                        l.payment, l.max, l.status, l.note, (select count(*) from line_client lc where lc.line_id = l.id and lc.removed IS NULL) used
                                        FROM line l
                                        LEFT JOIN profile p ON p.user_id = l.user_id
                                        LEFT JOIN line_type lt ON lt.id = l.type_id
                                        LEFT JOIN broker b on b.client_id = l.user_id
                                        LEFT JOIN business bu on bu.user_id = b.broker_id
                                        WHERE b.broker_id in ($brokers) ORDER BY l.user_id ASC")->result();
    }

    public function getAllLines($widget = null)
    {
        $result = $this->db->query("SELECT l.id, l.user_id, concat(p.first_name , ' ' , p.last_name) user, l.type_id, concat_ws(' - ', concat(p.first_name , ' ' , p.last_name), lt.bank, lt.type, lt.name, concat('$',l.lmt), concat(l.statement, '(S)'),
                                        concat(l.open, '(O)')) line, l.lmt, l.balance, l.open, l.statement, l.price, l.broker_price, l.broker_price +
                                        (bu.client_commission * l.broker_price)/100 client_broker_price, l.payment, l.max, l.status, l.note, l.used
                                        FROM line l
                                        LEFT JOIN profile p ON p.user_id = l.user_id
                                        LEFT JOIN broker b ON b.client_id = l.user_id LEFT JOIN business bu ON bu.user_id = b.broker_id
                                        LEFT JOIN line_type lt ON lt.id = l.type_id ORDER BY p.first_name ASC ")->result();
        return $this->widget($widget, $result, 'id', 'line', '');
    }

    public function getLine($lineId)
    {
        return $this->db->query("SELECT l.id, l.user_id, concat(p.first_name , ' ' , p.last_name) user, l.type_id, concat_ws(' - ', lt.bank, lt.type, lt.name, concat('$',l.lmt), day(l.statement),
                                        year(l.open)) line, l.lmt, l.balance, l.open, l.statement, l.price,l.broker_price, l.broker_price + (bu.client_commission * l.broker_price)/100 client_broker_price, l.payment, l.max, l.status, l.note, l.used
                                        FROM line l
                                        LEFT JOIN profile p ON p.user_id = l.user_id
                                        LEFT JOIN line_type lt ON lt.id = l.type_id
                                        LEFT JOIN broker b on b.client_id = l.user_id LEFT JOIN business bu on bu.user_id = b.broker_id
                                        where l.id = $lineId")->result();
    }

    public function getLines($owner_id)
    {
        return $this->db->query("SELECT l.id, l.user_id, concat(p.first_name , ' ' , p.last_name) user, l.type_id, concat_ws(' - ', lt.bank, lt.type, lt.name, concat('$',l.lmt), day(l.statement),
                                        year(l.open)) line, l.lmt, l.balance, l.open, l.statement, l.price,l.broker_price, l.broker_price + (bu.client_commission * l.broker_price)/100 client_broker_price, l.payment, l.max, l.status, l.note, l.used
                                        FROM line l
                                        LEFT JOIN profile p ON p.user_id = l.user_id
                                        LEFT JOIN line_type lt ON lt.id = l.type_id
                                        LEFT JOIN broker b on b.client_id = l.user_id LEFT JOIN business bu on bu.user_id = b.broker_id
                                        where l.user_id = '$owner_id' ")->result();
    }

    public function getSelfLines($ownerId)
    {
        return $this->db->query("SELECT l.id, l.user_id, concat(p.first_name , ' ' , p.last_name) user, l.type_id, concat_ws(' - ', lt.bank, lt.type, lt.name, concat('$',l.lmt), day(l.statement),
                                        year(l.open)) line, l.lmt, l.balance, l.open, l.statement, l.price, l.payment, l.max, l.status, l.note, l.used
                                        FROM line l
                                        LEFT JOIN profile p ON p.user_id = l.user_id
                                        LEFT JOIN line_type lt ON lt.id = l.type_id
                                        WHERE l.user_id = $ownerId order by line asc")->result();
    }

    public function getLineClientsForClientBroker($lineId = null, $brokerId = null)

    {
        if ($lineId and $brokerId)
            $append = " where lc.line_id = '$lineId' and b.broker_id = '$brokerId' and r.name = 'client' ";
        else if ($lineId)
            $append = " where lc.line_id = '$lineId' and r.name = 'client' ";
        else if ($brokerId)
            $append = " where b.broker_id ='$brokerId' and r.name = 'client'";

        return $this->db->query(" SELECT lc.id,lc.line_id, concat_ws(' ', p.first_name, p.last_name) client_name, p.user_id client_id,
                                  (SELECT concat_ws(' - ', lt.bank, lt.type, lt.name, concat('$',l.lmt), day(l.statement), year(l.open)) FROM line l RIGHT JOIN line_type lt ON l.type_id = lt.id
                                    WHERE l.id = lc.line_id) line,
                                  (SELECT concat_ws(' ', p2.first_name, p2.last_name) FROM profile p2 WHERE p2.user_id = l.user_id) owner_name,
                                  (SELECT p2.user_id FROM profile p2 WHERE p2.user_id = l.user_id) owner_id,
                                  lc.client_id,lc.requested, lc.added, lc.verified_owner, lc.verified_broker, lc.removed, lc.disqualified, lc.reason , lc.status,
                                  lc.client_broker_price, lc.owner_broker_price
                                  FROM line_client lc
                                  LEFT JOIN line l ON l.id = lc.line_id
                                  LEFT JOIN profile p ON p.user_id = lc.client_id
                                  LEFT JOIN broker b on b.client_id = lc.client_id
                                  JOIN role r on r.id = b.role_id
                                  $append ")->result();
    }

    public function getLineClientsForOwnerBroker($lineId = null, $brokerId = null)

    {
        if ($lineId and $brokerId)
            $append = " where lc.line_id = '$lineId' and b.broker_id = '$brokerId' and r.name = 'owner' ";
        else if ($lineId)
            $append = " where lc.line_id = '$lineId' ";
        else if ($brokerId)
            $append = " where b_owner.broker_id ='$brokerId' or b_client.broker_id ='$brokerId' ";

        return $this->db->query(" SELECT lc.id,lc.line_id, concat_ws(' ', p.first_name, p.last_name) client_name, p.user_id client_id,
                                  (SELECT concat_ws(' , ', lt.bank, lt.type, lt.name, concat('Limit : $',l.lmt), concat('Statement : ',l.statement) ,  concat('Opened : ', l.open)) FROM line l RIGHT JOIN line_type lt ON l.type_id = lt.id
                                    WHERE l.id = lc.line_id) line,
                                  (SELECT concat_ws(' ', p2.first_name, p2.last_name) FROM profile p2 WHERE p2.user_id = l.user_id) owner_name,
                                  (SELECT p2.user_id FROM profile p2 WHERE p2.user_id = l.user_id) owner_id,
                                  lc.client_id,lc.requested, lc.added, lc.verified_owner, lc.verified_broker, lc.removed, lc.disqualified, lc.reason , lc.status,
                                  lc.client_broker_price, lc.owner_broker_price,
                                  if (b_owner.broker_id = '$brokerId', 'true', 'false') ownerBroker,
                                  if (b_client.broker_id = '$brokerId', 'true', 'false') clientBroker
                                  FROM line_client lc
                                  LEFT JOIN line l ON l.id = lc.line_id
                                  LEFT JOIN profile p ON p.user_id = lc.client_id
                                  JOIN broker b_owner on b_owner.client_id = l.user_id
                                  join broker b_client on b_client.client_id = lc.client_id
                                  $append order by line asc")->result();
    }

    public function getLineClientsForOwner($lineId = null, $ownerId = null)

    {
        if ($lineId and $ownerId)
            $append = " where lc.line_id = '$lineId' and b.broker_id = '$ownerId' and r.name = 'owner' ";
        else if ($lineId)
            $append = " where lc.line_id = '$lineId' and r.name = 'owner' ";
        else if ($ownerId)
            $append = " where b.client_id ='$ownerId' and r.name = 'owner'";

        return $this->db->query("SELECT lc.id,lc.line_id,
                                  (SELECT concat_ws(' ', p3.first_name, p3.last_name) FROM profile p3 WHERE p3.user_id = lc.client_id) client_name,
                                  p.user_id client_id,
                                  (SELECT concat_ws(' , ', lt.bank, lt.type, lt.name, concat('Limit : $',l.lmt), concat('Statement : ',l.statement) ,  concat('Opened : ', l.open)) FROM line l RIGHT JOIN line_type lt ON l.type_id = lt.id WHERE l.id = lc.line_id) line,
                                  (SELECT concat_ws(' ', p2.first_name, p2.last_name ) FROM profile p2 WHERE p2.user_id = l.user_id) owner_name,

                                    (SELECT AES_DECRYPT(p2.ssn,'$this->ssn_phrase') FROM profile p2 WHERE p2.user_id = lc.client_id) ssn,
                                    (SELECT AES_DECRYPT(p2.dob,'$this->dob_phrase') FROM profile p2 WHERE p2.user_id = lc.client_id) dob,



                                  (SELECT p2.user_id FROM profile p2 WHERE p2.user_id = l.user_id) owner_id,




                                  lc.client_id,lc.requested, lc.added, lc.verified_owner, lc.verified_broker, lc.removed, lc.disqualified, lc.reason , lc.status,
                                  lc.client_broker_price, lc.owner_broker_price , l.price
                                  FROM line_client lc
                                  LEFT JOIN line l ON l.id = lc.line_id
                                  LEFT JOIN profile p ON p.user_id = l.user_id
                                  LEFT JOIN broker b on b.client_id = l.user_id
                                  JOIN role r on r.id = b.role_id
                                  $append ")->result();
    }


    function getLineDetails($lineid)
    {
        return $this->db->query("
                                SELECT l.id, l.user_id, l.lmt, l.balance, l.open, l.statement, l.price, l.broker_price, l.client_broker_price, lt.type, lt.bank, lt.name
                                FROM line l
                                LEFT JOIN line_type lt
                                ON l.type_id = lt.id
                                WHERE l.id =$lineid
                                ")->row();

    }

    function insertLine()
    {
        $data = array(
            'user_Id' => $this->input->post('user_id'),
            'type_id' => $this->input->post('type_id'),
            'lmt' => $this->input->post('lmt'),
            'balance' => $this->input->post('balance'),
            'open' => $this->input->post('open'),
            'statement' => $this->input->post('statement'),
            'price' => $this->input->post('price'),
            'payment' => $this->input->post('payment'),
            'max' => $this->input->post('max'),
            'status' => $this->input->post('status'),
            'note' => $this->input->post('note')
        );
        $this->db->insert('line', $this->security->xss_clean($data));
        $lineId = $this->db->insert_id();
        return $lineId;
    }

    function insertLineToClient()
    {
        $lineInfo = $this->getLineInfo($this->input->post('line_id'));

        $data = array(
            'line_id' => $this->input->post('line_id'),
            'client_id' => $this->input->post('client_id'),
            'requested' => $this->formatDate($this->input->post('requested') ? $this->input->post('requested') : date('m/d/Y')),
            'added' => $this->formatDate($this->input->post('added')),
            'removed' => $this->formatDate($this->input->post('removed')),
            'disqualified' => $this->formatDate($this->input->post('cancelled')),
            'owner_price' => $lineInfo->price,
            'owner_broker_price' => $lineInfo->broker_price,
            'no_month' => $this->input->post('months')
        );
        $this->db->insert('line_client', $this->data($data));
        $this->TaskModel->insertClientPurchaseLineTask($this->input->post('client_id'), $this->input->post('line_id'));
    }

    function  getLinesAssociative()
    {
        $query = $this->db->query("SELECT concat_ws(' - ', concat_ws(' ', p.first_name, p.last_name) ,lt.bank, lt.type, lt.name, concat('$',l.lmt), l.open) card, l.id
                                    FROM line l
                                    LEFT JOIN line_type lt ON lt.id = l.type_id
                                    LEFT JOIN profile p ON p.user_id = l.user_id");
        if ($query->num_rows() > 0) {
            $result = array();
            foreach ($query->result() as $row) {
                $result[$row->id] = $row->card;
            }
            return $result;
        }
        return false;
    }

    function getGenerateUsername()
    {
        $username = '';
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        for ($i = 0; $i < 8; $i++) {
            $username .= $characters[rand(0, strlen($characters) - 1)];
        }
        $query = $this->db->query("SELECT login_name FROM user WHERE login_name = '$username'");
        if ($query->num_rows() > 0) {
            return $this->getGenerateUsername();
        } else {
            return $username;
        }
    }

    function generatePassword()
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $password = substr(str_shuffle($chars), 0, 8);
        return $password;
    }

    function deleteLine()
    {
        $this->db->trans_start();
        $line_id = $this->input->post();
        $this->db->where(array('id' => $line_id['id']));
        $this->db->delete('line');
        if ($this->db->affected_rows() == 0) {
            throw new Exception("Could not delete line");
        }
        $this->db->trans_complete();
    }

    function deleteLineClient()
    {
        $this->db->where($this->input->post());
        $this->db->delete('line_client');
        if ($this->db->affected_rows() == 0) {
            throw new Exception("Could not delete row");
        }
    }

    function linesPurchased($client_id)
    {
        return $this->db->query("Select client_id FROM line_client where client_id=$client_id")->result();

    }

    function activeLinesPurchased($client_id)
    {
        return $this->db->query("Select client_id FROM line_client where status = 'active' and client_id = '$client_id'")->result();

    }

    function activeLines($brokerId = null)
    {
        $brokers = $this->UserModel->getBrokerHierarchy($brokerId, false, true, true);
        $clients = $this->db->query("select group_concat(b.client_id) clients from broker b where b.broker_id in ($brokers)")->row()->clients;
        if ($clients) {
            $append = "  where l.user_id in ($clients)";
        }

        return $this->db->query("SELECT count(*) count FROM line_client lc
                                JOIN line l ON lc.line_id = l.id $append")->row()->count;
    }

    function changeStatus($line_id)
    {
        {
            return $this->db->query = $this->db->query("update line_client set status = 'sent' where id = $line_id");
        }
    }

    function getLineBalance($userId, $verified = true)
    {
        $append = "";
        if ($verified) {
            $append = " and lc.verified_broker IS NOT NULL";
        }
        return $this->db->query("SELECT sum(lc.owner_price) balance FROM line_client lc
                                              JOIN line l on lc.line_id = l.id
                                              WHERE l.user_id = '$userId'  $append")->row()->balance;
    }

    function getLineInfo($lineId)
    {
        return $this->db->query("SELECT * FROM line WHERE id = $lineId")->row();
    }

    public function balance($lineId = null, $brokerId = null)

    {
        if ($lineId and $brokerId)
            $append = " where lc.line_id = '$lineId' and b.broker_id = '$brokerId' and r.name = 'client' ";
        else if ($lineId)
            $append = " where lc.line_id = '$lineId' and r.name = 'client' ";
        else if ($brokerId)
            $append = " where b.broker_id ='$brokerId' and r.name = 'client'";

        return $this->db->query(" SELECT lc.id,lc.line_id, concat_ws(' ', p.first_name, p.last_name) client_name, p.user_id client_id,
                                  (SELECT concat_ws(' - ', lt.bank, lt.type, lt.name, concat('$',l.lmt), day(l.statement), year(l.open)) FROM line l RIGHT JOIN line_type lt ON l.type_id = lt.id
                                    WHERE l.id = lc.line_id) line,
                                  (SELECT concat_ws(' ', p2.first_name, p2.last_name) FROM profile p2 WHERE p2.user_id = l.user_id) owner_name,
                                  (SELECT p2.user_id FROM profile p2 WHERE p2.user_id = l.user_id) owner_id,
                                  lc.client_id , lc.verified_owner, lc.verified_broker,lc.owner_price ,(SELECT sum(lc.owner_price) from line_client lc where lc.verified_broker IS NOT NULL) as verified_sum ,
(SELECT sum(lc.owner_price) from line_client lc where lc.verified_broker IS NULL ) as unverified_sum ,(SELECT sum(lc.owner_price) from line_client lc) as total_sum ,
lc.client_broker_price, lc.owner_broker_price
                                  FROM line_client lc
                                  LEFT JOIN line l ON l.id = lc.line_id
                                  LEFT JOIN profile p ON p.user_id = lc.client_id
                                  LEFT JOIN broker b on b.client_id = lc.client_id
                                  JOIN role r on r.id = b.role_id
                                  $append ")->result();
    }

}


?>