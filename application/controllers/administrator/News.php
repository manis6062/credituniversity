<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class News extends CI_Controller
{

    private $allowed = array();

    public function __construct()
    {
        parent::__construct();
        checkAdminAuth();
        // Your own constructor code
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->form_validation->set_error_delimiters('<div class="red">', '</div>');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('path');
        $this->load->helper('string');

        //$this->load->model('auth_master_model');
        //$this->load->model('user_auth_model');
        $this->allowed = $this->AuthModel->getAuth();
    }

    public function index()
    {

        $this->show($page = '');

    }

    function show($page = '')
    {
        if (in_array('news_view', $this->allowed)) {
            $cond = array();
            if ($this->session->userdata(ADMIN_AUTH_TYPE) == "user") {
                $userid = $this->session->userdata(USER_ID);
                //$cond="where ts_user.branch_id='$branchid'";
                $cond['nc_news.crdt_by'] = $userid;

            }
            $config['total_rows'] = $this->NewsModel->countAll($cond);
            $config['base_url'] = site_url("news/show/");
            $config['per_page'] = '10';
            $config['uri_segment'] = '3';
            $offset = $this->uri->segment(3, 0);
            $this->pagination->initialize($config);
            $data['start'] = $page;
            $data['newsList'] = $this->NewsModel->getAllPaginate($cond, $config['per_page'], $offset);
            $data['allowed'] = $this->allowed;
            $data['title'] = "List News";
            $data['main_content'] = ADMIN_PATH . "news_view";
            $this->load->view(ADMIN_PATH . 'incs/template', $data);
        } else {
            redirect("admin");
        }
    }

    function deleteNews($id, $offset)
    {
        if (in_array('news_update', $this->allowed)) {

            if ($this->NewsModel->deleteNews($id)) {

                $this->session->set_flashdata("su_message", "News Deleted Successfully.");

            } else {
                $this->session->set_flashdata("su_message", "<font color=\"#FF0000\">The Selected News Can't Be Deleted.</font>");
            }
        } else {
            $this->session->set_flashdata("su_message", "You Have No Permission To Delete This Record");
        }

        redirect(ADMIN_PATH . "news/show/$offset");
    }

    function addNews()
    {

        $masterauth = new AuthModel();

        $data['mas_auth'] = $masterauth->getAllAuth();

        $data['title'] = "Add News";
        $data['main_content'] = ADMIN_PATH . "news_add_view";
        $this->load->view(ADMIN_PATH . 'incs/template', $data);
    }

    function add()
    {

        if (in_array('news_add', $this->allowed)) {
            if ($this->form_validation->run('news_add') == FALSE) {
                $this->addNews();
            } else {

                $this->NewsModel->insert();

                $this->session->set_flashdata("su_message", "News Addded Successfully.");
                redirect(ADMIN_PATH . "news/index");

            }
        } else {
            redirect("admin");
        }

    }

    function update($offset)
    {
        if (in_array('news_update', $this->allowed)) {
            if ($this->form_validation->run('news_add') == FALSE) {
                $this->updateNews($this->input->post('news_id'), $offset);
            } else {

                $this->NewsModel->update($this->input->post('news_id'));

                $this->session->set_flashdata("su_message", "News Updated Successfully.");
                redirect(ADMIN_PATH . "news/show/$offset");

            }
        } else {
            $this->session->set_flashdata("su_message", "You Have No Permission To Update News");
            redirect(ADMIN_PATH . "news/show/$offset");
        }
    }

    function updateStatus($id, $order, $low_high, $offset)
    {
        if ($low_high <= 1) {
            $this->NewsModel->changehigherorder($id, $order);
        } else {
            $this->NewsModel->changelowerorder($id, $order);
        }
        $this->session->set_flashdata("su_message", "Order changed successfully");
        redirect(ADMIN_PATH . "news/show/$offset");
    }

    function changeStatus($id, $value, $offset)
    {
        $stat = "";
        if ($value == 'Yes') {
            $stat = 'No';
        } else {
            $stat = 'Yes';
        }

        if ($this->NewsModel->updateStatus($id, $stat)) {
            $this->session->set_flashdata("su_message", "Status Updated Successfully.");

        } else {
            $this->session->set_flashdata("su_message", "Status Updated Successfully.");

        }
        redirect(ADMIN_PATH . "news/show/$offset");
    }

    function updateNews($id, $offset)
    {

        $masterauth = new AuthModel();
        $data['newsRecord'] = $this->NewsModel->getNewsDetails($id);
        $data['title'] = "Update News";
        $data['main_content'] = ADMIN_PATH . "news_update_view";
        $data['offset'] = $offset;

        $data['mas_auth'] = $masterauth->getAllAuth();

        $this->load->view(ADMIN_PATH . 'incs/template', $data);
    }

}

?>