<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forum extends CI_Controller {
	
	 public function __construct()
       {
            parent::__construct();
			
			$this->load->library('pagination');
			$this->load->model(Model::FORUM_MODEL);
			$this->form_validation->set_error_delimiters('<div class="error">* ', '</div>');
            // if ( $this->input->post( 'remember' ) ) // set sess_expire_on_close to 0 or FALSE when remember me is checked.
            // $this->config->set_item('sess_expire_on_close', '0'); // do change session config
//  
            // $this->load->library('session');		
       }    

	
	public function index()
	{
		$data['title'] = 'Forum';
		$data['title1'] = 'Forum - All Topics';
		$data['forum'] = $this->ForumModel->getAllQuestion();
		$data['main_content']='forum_view';
		$this->load->view('inc/registration', $data);
	}
	
	public function myquestion(){
		$data['title'] = 'Forum';
		$data['title1'] = 'Forum - My Questions';
		$user = $this->session->userdata(USER_ID);
		$data['forum'] = $this->ForumModel->getAllQuestion($user);
		$data['main_content']='forum_view';
		$this->load->view('inc/registration', $data);
	}
	
	public function detail($qid){
		$data['title'] = 'Forum';
		$data['title1'] = 'Forum - Question Details';
		$this->ForumModel->updateview($qid);
		$data['forumquestion'] = $this->ForumModel->getQuestion($qid);
		$data['forumanswer'] = $this->ForumModel->getAnswers($qid);
		$data['main_content']='forum_detail';
		$this->load->view('inc/registration', $data);
	}
	
	public function ask(){
		$data['title'] = 'Forum';
		$data['title1'] = 'Forum - Create Topic';
		$data['main_content']='forumtopic_view';
		$this->load->view('inc/registration', $data);
	}
	
	public function createTopic(){
		$id = $this->ForumModel->inserttopic();
		if($id>0){
			redirect('forum/detail/'.$id);
		}else{
			$this->session->set_flashdata('su_message', 'Topic not created.');
			redirect('forum/ask');
		}
	}
	public function reply(){
		$qid = $this->input->post('qid');
		$id = $this->ForumModel->reply();
		if($id){
			$this->session->set_flashdata('su_message','Reply posted.');
			redirect('forum/detail/'.$qid);
		}
		else{
			$this->session->set_flashdata('su_message','Reply post failed.');
			redirect('forum/detail/'.$qid);
		}
	}
}

/* End of file welcome.php */
