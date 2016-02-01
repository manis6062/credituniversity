<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Calendar extends AdminController
{


    public function __construct()
    {
        parent::__construct(CLIENT, OWNER, BROKER, ADMIN, SUPER_ADMIN);
        $this->load->helper('general');
        $this->load->helper(array('form', 'url'));
        $this->load->library('user_agent');
        $this->load->model('CalendarModel');

    }

    public function index()
    {
        $data['title'] = "Calendar";
        $data['main_content'] = ADMIN_PATH . "calendar";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function getEvents()
    {
        echo $this->CalendarModel->getEventsByUserId($this->session->userdata(USER_ID));
    }

    function addEvent()
    {
        $lastId = $this->CalendarModel->insertEventByUserId($this->session->userdata(USER_ID));
        echo json_encode(array('status' => 'success', 'eventId' => $lastId));
    }

    function editEvent()
    {
        $editEvent = $this->CalendarModel->updateEventByUserId($this->session->userdata(USER_ID));
        if ($editEvent)
            echo json_encode(array('status' => 'success'));
        else
            echo json_encode(array('status' => 'failed'));
    }

    function editTitleEvent()
    {
        $editTitle = $this->CalendarModel->updateEventTitleById();
        if ($editTitle)
            echo json_encode(array('status' => 'success'));
        else
            echo json_encode(array('status' => 'failed'));
    }

    function removeEvent()
    {
        $removeEvent = $this->CalendarModel->deleteEvent();
        if ($removeEvent)
            echo json_encode(array('status' => 'success'));
        else
            echo json_encode(array('status' => 'failed'));
    }
}

?>