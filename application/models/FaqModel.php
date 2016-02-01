<?php

class FaqModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->helper('date');
        $this->load->library('email');

    }

    function getFaqs()
    {
        $this->db->select('*');
        $this->db->from('faq');
        $this->db->order_by('sequence');
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result();
        return 0;
    }

    function insert()
    {
        $max_sequence = $this->db->query("SELECT max(sequence) max FROM faq")->row()->max;

        $data = array(
            'faq_question' => $this->input->post('faq_question'),
            'faq_answer' => $this->input->post('faq_answer'),
            'sequence' => $max_sequence + 1
        );
        $this->db->insert('faq', $this->security->xss_clean($data));
        return $this->db->insert_id();
    }

    function getFaq($id)
    {
        $this->db->select('*');
        $this->db->from('faq');
        $this->db->where('faq_id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->row();
        return 0;
    }

    function delete($id)
    {
        $this->db->where('faq_id', $id);
        $this->db->delete('faq');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        }
        return FALSE;
    }

    function reOrder($from, $to)
    {

        $from_id = $this->db->query("select f.faq_id from faq f where f.sequence = '$from'")->row()->faq_id;
        $to_id = $this->db->query("select f.faq_id from faq f where f.sequence = '$to'")->row()->faq_id;

        $data = array(
            'sequence' => $to
        );
        $this->db->where('faq_id', $from_id);
        $this->db->update('faq', $data);

        $data = array(
            'sequence' => $from
        );
        $this->db->where('faq_id', $to_id);
        $this->db->update('faq', $data);
    }

}

?>