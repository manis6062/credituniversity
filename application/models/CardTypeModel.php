<?php

class CardTypeModel extends AdminModel
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('date');
        $this->load->library('email');
        $this->load->model('RoleModel');
    }


    function insertCardType()
    {
        $data = array(
            'type' => $this->input->post('type'),
            'bank' => $this->input->post('bank'),
            'name' => $this->input->post('name'),
            'phone' => $this->input->post('phone'),
            'site' => $this->input->post('site'));
        $this->db->insert('line_type', $this->security->xss_clean($data));
    }

    function deleteCard($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('line_type');
    }

    function getCardTypes()
    {
        return $this->db->query("SELECT ct.id, ct.bank, ct.type, ct.name, ct.phone, ct.site FROM line_type ct")->result();
    }

    function getCardType($type_id)
    {
        return $this->db->query("SELECT lt.id, lt.bank, lt.type, lt.name, lt.site, lt.phone FROM line_type lt where lt.id = '$type_id'")->result();
    }


    function  getCardTypesAssociative()
    {
        $query = $this->db->query("SELECT DISTINCT type FROM line_type");
        if ($query->num_rows() > 0) {
            $result = array();
            $count = 0;
            foreach ($query->result() as $row) {
                $result[$count++] = $row->type;
            }
            return $result;
        }
        return false;
    }

    public function getSite($lineId)
    {
        return $this->db->query("select lt.site From line_type lt where lt.id = '$lineId'")->row()->site;
    }

    function  getBanksAssociative()
    {
        $query = $this->db->query("SELECT concat_ws(' - ', lt.bank, lt.type, lt.name) card, lt.id FROM line_type lt");
        if ($query->num_rows() > 0) {
            $result = array();
            foreach ($query->result() as $row) {
                $result[$row->id] = $row->card;
            }
            return $result;
        }
        return false;
    }


    function autoSuggestType($keyword)
    {

        $query = $this->db->query("select type from line_type where type like '%".$keyword."%' order by type DESC");
        foreach ($query->result_array() as $row) {
            //$data[$row['friendly_name']];
            $data[] = $row;
        }
        //return $data;
        return $query;
    }

    function autoSuggestBank($keyword_bank)
    {

        $query = $this->db->query("select bank from line_type where bank like '%".$keyword_bank."%'");
        foreach ($query->result_array() as $row) {
            //$data[$row['friendly_name']];
            $data[] = $row;
        }
        //return $data;
        return $query;
    }

    function autoSuggestCard($keyword_card)
    {

        $query = $this->db->query("select name from line_type where name like '%".$keyword_card."%'");
        foreach ($query->result_array() as $row) {
            //$data[$row['friendly_name']];
            $data[] = $row;
        }
        //return $data;
        return $query;
    }


    function  getCardTypeNames()
    {
        $query = $this->db->query("SELECT type, name FROM line_type");
        if ($query->num_rows() > 0) {
            $result = array();
            foreach ($query->result() as $row) {
                $result[$row->type] = $row->name;
            }
            return $result;
        }
        return false;
    }

    function getCardTypesSelect2()
    {
        $query = $this->db->query("SELECT id, type FROM line_type");
        if ($query->num_rows() > 0) {
            return $this->select2($query->result(), id, type);
        }
    }

    function getPurchaseDate($user_id)
    {
        return $this->db->query("
SELECT
l.id,
l.type_id,
concat_ws(' - ', lt.bank, lt.type, lt.name, concat('$',l.lmt), l.statement, l.open) AS line,
l.lmt,
l.balance,
l.`open`,
l.statement,
l.price,
l.broker_price,
l.broker_price,
line_client.client_broker_price,
line_client.requested
FROM
line l

RIGHT JOIN line_client ON line_client.line_id = l.id
RIGHT JOIN line_type lt ON l.id= lt.id
where line_client.client_id=$user_id
")->result();
    }


    function lookup($keyword){
        $this->db->select('type')->from('line_type');
        $this->db->like('type',$keyword);
        $this->db->group_by('type');
        $query = $this->db->get();

        return $query->result();
    }

    function lookupName($keyword , $type , $bank){
        $this->db->select('id,name')->from('line_type');
        $this->db->like('name',$keyword);
        $this->db->where('type',$type);
        $this->db->where('bank',$bank);
        $query = $this->db->get();

        return $query->result();
    }

    function lookupBank($keyword , $type){
        $this->db->select('id,bank')->from('line_type');
        $this->db->like('bank',$keyword);
        $this->db->where('type',$type);
        $query = $this->db->get();

        return $query->result();
    }

    function getAllCardTypes() {
        $this->db->select('*')->from('line_type');
        $this->db->like('type');
        $query = $this->db->get();
        return $query->result();


    }
}