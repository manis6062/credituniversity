<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->form_validation->set_error_delimiters('<div class="error">* ', '</div>');
    }


    public function index()
    {
        $this->load->model('ThemeOptionModel');
        $this->load->model('ContentModel');
        $this->load->model('ProcessModel');
        $this->load->model('MenuModel');
        $this->load->model('ContactModel');
        $this->load->model('SocialModel');
        $this->load->helper('URL');
        $data['theme_option'] = $this->ThemeOptionModel->getAll();
        $data['content'] = $this->ContentModel->getHomeContent();
        $data['process'] = $this->ProcessModel->getAll();
        $data['title'] = 'Home';
        $this->load->helper('text');
        $data['main_content'] = 'welcome';
        $this->load->view('inc/template', $data);
    }
}
