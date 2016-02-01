<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller
{
    private $errors = "";

    public function __construct()
    {
        parent::__construct();

        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->form_validation->set_error_delimiters('<div class="error">* ', '</div>');
    }

    public function index()
    {
        $data['title'] = "Login";
        if ($this->session->userdata(USER_ID)) {
            redirect(ADMIN_PATH . 'home');
        } else {
            $this->load->view(ADMIN_PATH . 'signup', $data);
        }
    }

    function login_failed()
    {
        $this->session->set_flashdata('message', '<font color="#FF0000">*Invalid Username or Password.</font>');
        redirect('member');
    }

    function login()
    {
        if ($this->form_validation->run('login') == FALSE) {
            $this->index();
        } else {
            $domain = $_SERVER['SERVER_NAME'];
            $this->load->model('AffiliateModel');
            $domainId = $this->AffiliateModel->domainCheck($domain);
            if ($domainId) {
                $affiliate_id = $this->UserModel->affiliateLogin($this->security->sanitize_filename($this->input->post('username')), $this->security->sanitize_filename($this->input->post('password')), $domainId);
                if ($affiliate_id) {
                    $affiliateSess = $this->AffiliateModel->getAffiliateSessionValues($affiliate_id);
                    $this->session->set_userdata(array(ADMIN_AUTH_AFFILIATEID => $affiliateSess->affiliate_id));
                    $this->session->set_userdata(array(USER_ID => $affiliateSess->user_id));
                    $this->session->set_userdata(array(ADMIN_AUTH_USERNAME => $affiliateSess->affiliate_fname . ' ' . $affiliateSess->affiliate_lname));
                    $this->session->set_userdata(array(ADMIN_AUTH_NAMEUSER => $affiliateSess->login_name));
                    $this->session->set_userdata(array(ADMIN_AUTH_TYPE => 'affiliate'));
                    redirect(ADMIN_PATH . 'home', 'refresh');
                } else {
                    redirect('admin/login_failed', 'refresh');
                }
            }
            if ($domainId == '') {
                $user_id = $this->UserModel->login($this->security->sanitize_filename($this->input->post('username')), $this->security->sanitize_filename($this->input->post('password')));
                if ($user_id) {
                    $this->session->set_userdata(array(USER_ID => $user_id));
                    $userSess = $this->UserModel->getAdminDetails($user_id);
                    $this->session->set_userdata(array(ADMIN_AUTH_NAMEUSER => $userSess->login_name));
                    $this->session->set_userdata(array(ADMIN_AUTH_USERNAME => $userSess->user_name));
                    $roles = $this->UserModel->getRolesByUserId($user_id);
                    $roleid = strstr($roles->role_privilege, ',', TRUE);
                    if (empty($roleid)) {
                        $roleid = $roles->role_privilege;
                    }

                    $this->session->set_userdata(array(ADMIN_AUTH_ROLE => $roleid));
                    $role = $this->UserModel->getUserRoleDetailByRoleID($roleid);
                    $this->session->set_userdata(array(ADMIN_AUTH_TYPE => $role->role_type));
                    redirect(ADMIN_PATH . 'home', 'refresh');
                } else {
                    redirect('admin/login_failed', 'refresh');
                }
            }
        }
    }

    function config()
    {
        $data['usersTypes'] = $this->UserModel->getAdminDetails($this->session->userdata(USER_ID));
        $data['title'] = "Update Profile";
        $data['error'] = $this->errors;
        $data['main_content'] = ADMIN_PATH . "config";
        $this->load->view(ADMIN_PATH . 'incs/template', $data);
    }

    function logout()
    {
        if ($this->session->userdata(ADMIN_AUTH_AFFILIATEID)) {
            $this->session->unset_userdata(ADMIN_AUTH_AFFILIATEID);
        }
        $this->session->unset_userdata(USER_ID);
        $this->session->unset_userdata(ADMIN_AUTH_USERNAME);
        $this->session->unset_userdata(ADMIN_AUTH_TYPE);
        $this->session->unset_userdata(ADMIN_AUTH_ROLE);
        $this->session->unset_userdata(ROLE_NAME);
        redirect('member', 'refresh');
    }

}
