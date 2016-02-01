<?php

class ProspectModel extends AdminModel
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();

    }

    function insertProspect($broker_id)
    {
        $data = array(
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'first_name' => $this->input->post('firstName'),
            'last_name' => $this->input->post('lastName'),
            'broker_id' => $broker_id,
            'role_id' => $this->input->post('type'),
            'sys_admin_id' => $this->session->userdata(BROKER_ID)?$this->session->userdata(USER_ID):''
        );
        $this->db->insert('prospect', $data);
         return $this->db->insert_id();

    }

    function getProspects($brokerId)
    {
        if($this->session->userdata(BROKER_ID))
        {
            $condition="AND p.sys_admin_id=".$this->session->userdata(USER_ID);

        }
        else{
            $condition='';
        }
        return $this->db->query("select p.id, r.label, p.first_name, p.last_name, p.phone, p.email, p.broker_id
                                    from prospect p
                                    LEFT JOIN role r on p.role_id = r.id
                                    where broker_id = '$brokerId' $condition")->result();
    }

    function deleteProspect($prospectId)
    {
        $this->deleteNotes($prospectId);
        $this->db->where('id', $prospectId);
        $this->db->delete('prospect');
    }

    function deleteNotes($prospectId)
    {
        $this->db->where('prospect_id', $prospectId);
        $this->db->delete('notes');
    }

    function getProspect($prospectId)
    {
        return $this->db->query("select * from prospect p where p.id = '$prospectId'")->row();
    }


    function getProspectNotes($prospectId)
    {
        return $this->db->query("select * from notes n where n.prospect_id = '$prospectId'  ")->result();
    }

    function getProspectNotesForBroker($brokerId)
    {
        $result = $this->db->query("select n.prospect_id, n.note from notes n where n.broker_id = '$brokerId' and n.prospect_id IS NOT NULL order by n.updated DESC ")->result();
        $temp = array();
        foreach ($result as $row) {
            $temp[$row->prospect_id][] = $row->note;
        }
        return $temp;
    }

    function inactiveProspect($email){
        $data = array('status' => '0');
        $this->db->where("email", $email);
        $this->db->update('prospect', $this->security->xss_clean($data));
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }
        return FALSE;
    }


}
