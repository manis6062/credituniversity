<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Faq extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model(Model::FAQ_MODEL);
        $this->form_validation->set_error_delimiters('<div class="error">* ', '</div>');
        // if ( $this->input->post( 'remember' ) ) // set sess_expire_on_close to 0 or FALSE when remember me is checked.
        // $this->config->set_item('sess_expire_on_close', '0'); // do change session config
//  
        // $this->load->library('session');
    }


    public function index()
    {
        $data['title'] = 'FREQUENTLY ASKED QUESTIONS';
        $data['faq'] = $this->FaqModel->getFaqs();
        $data['main_content'] = 'faq_view';
        $this->load->view('inc/registration', $data);
    }



}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */