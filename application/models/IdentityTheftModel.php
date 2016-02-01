<?php

class IdentityTheftModel extends AdminModel
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('security');
        $this->load->database();

    }


    function getIdentityTheft()
    {
        $query = $this->db->query("Select * from identity_theft");
        return $query->row();
    }



    function updateIdentityTheft()
    {
        $data = array(
            'description' => $this->input->post('description')
        );
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('identity_theft', $data);
    }



}