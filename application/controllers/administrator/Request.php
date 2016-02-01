<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Request extends CI_Controller
{

    private $errors = "";
    private $allowed = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('general');
        checkAdminAuth();
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->form_validation->set_error_delimiters('<div class="red">', '</div>');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('path');
        $this->load->model('RequestModel');
        $this->load->model('AuthModel');
        $this->allowed = $this->AuthModel->getRoleAuth();
    }

    function _remap($method, $args)
    {
        if (method_exists($this, $method)) {
            $this->$method($args);
        } else {
            $this->index($method, $args);
        }
    }

    public function index($id)
    {
        $this->show($id, $page = '');
    }

    function show($id, $page = '')
    {
        if (in_array('request', $this->allowed)) {
            $data['list'] = $this->RequestModel->getAll();
            $data['allowed'] = $this->allowed;
            $data['error'] = $this->errors;
            $data['title'] = "List of request sent by " . $this->session->userdata(ADMIN_AUTH_USERNAME);
            if ($this->session->userdata(ADMIN_AUTH_TYPE) != 'affiliate' && $this->session->userdata(ADMIN_AUTH_TYPE) != 'referrer' && $this->session->userdata(ADMIN_AUTH_TYPE) != 'client') {
                $type = 'referrer';
            } elseif (($this->session->userdata(ADMIN_AUTH_TYPE) == 'affiliate') || ($this->session->userdata(ADMIN_AUTH_TYPE) == 'referrer')) {
                $type = 'client';
            }
            $data['title1'] = "Request for signup '" . $type . "'";
            $data['main_content'] = ADMIN_PATH . "requestforsignup";
            $this->load->view(ADMIN_PATH . 'incs/template', $data);
        } else {
            redirect("admin");
        }
    }

    function deleteAction($id)
    {
        if (in_array('request', $this->allowed)) {
            if ($this->RequestModel->delete($id[0])) {
                $this->session->set_flashdata("su_message", "Request Record Deleted Successfully.");
            } else {
                $this->session->set_flashdata("su_message", "<font color=\"#FF0000\">The Selected Record Can't Be Deleted.</font>");
            }
        } else {
            $this->session->set_flashdata("su_message", "You Have No Permission To Delete This Record");
        }
        redirect(ADMIN_PATH . "request");
    }

    function add()
    {
        if (in_array('request', $this->allowed)) {
            $flag = FALSE;
            foreach ($this->input->post('email') as $value) {
                if (!$this->UserModel->checkemailregistered($value)) {
                    $rcode = $this->generatercode();
                    $email = $value;

                    $this->EmailerModel->requestMail($email, $rcode);
                } else {
                    $this->session->set_flashdata("su_message", "Email already registered.");
                    redirect(ADMIN_PATH . "request");
                }
            }
            if ($flag) {
                $this->session->set_flashdata("su_message", "Request has been sent Successfully.");
            } else {
                $this->session->set_flashdata("su_message", "Some errors occured while sending request.");
            }
            redirect(ADMIN_PATH . "request");
        } else {
            $this->session->set_flashdata("su_message", "You don't have the permission to send emails.");
            redirect(ADMIN_PATH . "request");
        }
    }

    function remove_checked()
    {
        if (in_array('request', $this->allowed)) {
            $this->form_validation->set_rules('msg[]', 'Private Message', 'required|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata("su_message", "Select anyone of the items.");
                redirect(ADMIN_PATH . "request");
            } else //success
            {
                foreach ($_POST['msg'] as $id) {
                    if ($this->RequestModel->delete($id)) {
                        $flag = TRUE;
                    } else {
                        $flag = FALSE;
                    }
                }
                //redirect to inbox                                       
            }
            //check before delete if it is admin user or currently loggged in user
        } else {
            $this->session->set_flashdata("su_message", "You Have No Permission To Delete This Request Records");
        }
        if ($flag) {
            $this->session->set_flashdata("su_message", "Request Record Deleted Successfully.");
        } else {
            $this->session->set_flashdata("su_message", "Error while deleting request records..");
        }
        redirect(ADMIN_PATH . "request");
    }

    function generatercode()
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $rcode = substr(str_shuffle($chars), 0, 15);
        if ($this->RequestModel->checkcode($rcode)) {
            $this->generatercode();
        } else {
            return $rcode;
        }
    }
}

?>