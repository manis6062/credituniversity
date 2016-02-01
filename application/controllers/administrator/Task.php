<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Task extends AdminController
{
    public function __construct()
    {
        parent::__construct(CLIENT, OWNER, BROKER);
        $this->load->helper('general');
        $this->load->helper(array('form', 'url'));
        $this->load->model('TaskModel');
        $this->load->library('user_agent');



    }

    function notifications()
    {
        $data['title'] = 'notification';
        $data['tasks'] = $this->TaskModel->getTasks($this->session->userdata(USER_ID), 'notification', '');
        $data['main_content'] = ADMIN_PATH . "tasks";
        $this->load->view(ADMIN_PATH . "inc/template", $data);

    }

    function notification($taskid)
    {
        $data['title'] = 'notification';
        $data['task'] = $this->TaskModel->getTask($taskid);
        $data['main_content'] = ADMIN_PATH . "task";

        $this->load->view(ADMIN_PATH . "inc/template", $data);
    }

    function tasks()
    {
        $data['title'] = 'task';
        $data['task_lists'] = $this->TaskModel->getTasks($this->session->userdata(USER_ID), 'task', '');
        $data['users'] = $this->UserModel->getBrokerUsers($this->userId);
        $data['main_content'] = ADMIN_PATH . "tasks";
        $this->load->view(ADMIN_PATH . "inc/template", $data);

    }

    function task($taskid)
    {
        $data['title'] = 'task';
        $data['task'] = $this->TaskModel->getTask($taskid);
        $data['main_content'] = ADMIN_PATH . "task";
        $this->load->view(ADMIN_PATH . "inc/template", $data);
    }

    function addTask()
    {
        $this->TaskModel->addTask($this->userId);
        redirect(ADMIN_PATH);
    }

    function deleteTask($task_id){
        $user_id = $this->session->userdata(USER_ID);
        $this->TaskModel->deleteTask($task_id , $user_id);
        redirect($this->agent->referrer());

    }

    function ChangeToComplete($task_id)
    {
        $this->TaskModel->ChangeToComplete($task_id);
        redirect(ADMIN_PATH);
    }

    function ChangeToInComplete($task_id)
    {
        $this->TaskModel->ChangeToInComplete($task_id);
        redirect(ADMIN_PATH);
    }


    function ChangeToUnread($task_id)
    {
        $this->TaskModel->ChangeToComplete($task_id);
        redirect(ADMIN_PATH);
    }

    function insertToTaskUser(){
        $client_id = $_POST['c_id'];
        $task_id = $_POST['t_id'];
        $this->TaskModel->insertTaskUser($task_id , $client_id);
        redirect(ADMIN_PATH);
        
    }
    
    
    /*
     * Ajax request funtion
     * Share the task with selected users
     */
    function shareToDoTask() {
        
        $task_id = $this->input->post('share_todo_id');
        $share_with = $this->input->post('share_todo');

        if (!isset($task_id) || empty($task_id)) {
            $data = array('status' => 'danger', 'message' => 'Something went wrong, please try again for start.');
            echo json_encode($data);
            die();
        }

        if (!count($share_with)) {
            $data = array('status' => 'warning', 'message' => 'Please select user to share with.');
            echo json_encode($data);
            die();
        }
        
        foreach($share_with as $user){
            /*Checks for duplicate share*/
            $already_shared = $this->TaskModel->getTaskUser(array('user_id'=>$user, 'task_id'=>$task_id, 'broker_id'=>$this->session->userdata(USER_ID)));
            /*checks if the task was shared by the selected user previously*/
            $task_shared_by = $this->TaskModel->getTaskUser(array('user_id'=>$this->session->userdata(USER_ID), 'task_id'=>$task_id, 'broker_id'=>$user));
            
            if(!$already_shared && !$task_shared_by){

                $this->TaskModel->insertTaskUser($task_id, $user, $this->session->userdata(USER_ID));
                
            }
        }
        
        $data = array('status' => 'success', 'message' => 'Task Shared.');
        echo json_encode($data);
        die();
        
    }

}