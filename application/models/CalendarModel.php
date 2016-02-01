<?php

class CalendarModel extends AdminModel
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('date');
        $this->load->library('email');
        $this->load->library('encrypt');
        $this->load->helper('security');
    }

    function getEventsByUserId($userId)
    {
        return $this->calendar($this->db->query("SELECT id, task_title title, startDate start, completion end , bgColor, bColor FROM task WHERE user_id = $userId")->result());
    }

    function insertEventByUserId($userId)
    {
        $data = array(
            'user_id' => $userId,
            'task_title' => $this->input->post('title'),
            'task_type' => $this->input->post('task'),
            'startDate' => $this->input->post('start'),
            'completion' => $this->input->post('end'),
            'bgColor' => $this->input->post('bgColor'),
            'bColor' => $this->input->post('bColor')

        );
        $this->db->insert('task', $this->security->xss_clean($data));
        return $this->db->insert_id();
    }

    function updateEventByUserId($userId)
    {
        $data = array(
            'user_id' => $userId,
            'task_title' => $this->input->post('title'),
//            'task_type' => $this->input->post('task'),
            'startDate' => $this->input->post('start'),
            'completion' => $this->input->post('end'),

        );
        $this->db->where("id", $this->input->post('eventId'));
        $this->db->update('task', $this->security->xss_clean($data));
        return true;
    }

    function updateEventTitleById()
    {
        $data = array(
            'task_title' => $this->input->post('title'),
        );
        $this->db->where("id", $this->input->post('eventId'));
        $this->db->update('task', $this->security->xss_clean($data));
        return true;
    }

    function deleteEvent()
    {
        $this->db->where('id', $this->input->post('eventId'));
        $this->db->delete('task');
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }
        return FALSE;
    }


}