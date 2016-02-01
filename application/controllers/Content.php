<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Content extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(Library::FORM_VALIDATION);
        $this->load->model('ContentModel');
        $this->form_validation->set_error_delimiters('<div class="error">* ', '</div>');
    }

    function _remap($parameter)
    {
        $this->index($parameter);
    }

    public function index($id)
    {
        $content = $this->ContentModel->getAdminDetails($id);
        $data['content'] = $content;
        $data['title'] = $content->content_title;
        $data['main_content'] = 'content';
        $this->load->view('inc/registration', $data);
    }

    public function show($id)
    {
        $data['content'] = $this->ContentModel->getAdminDetails($id);
        $data['main_content'] = 'content';
        $this->load->view('inc/template', $data);
    }
}
