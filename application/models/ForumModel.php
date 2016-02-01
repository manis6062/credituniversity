<?php

	class ForumModel extends CI_Model
	{

		function __construct()
		{
			parent::__construct();
			// Your own constructor code
			$this->load->helper('date');
			$this->load->library('email');
			$this->load->helper('security');

		}

		function getAllQuestion($user_id = '')
		{
			if ($user_id == '') {
				$query = $this->db->query("select f.*,  u.email,
	    									(select count(forum_ans_id) from forum_answer where forum_id = f.forum_id) as total_answer
	    									from forum_question as f
	    									inner join user as u
	    									on u.id= f.questioner
	    									order by f.forum_id desc");
			} else {
				$query = $this->db->query("select f.*,  u.email,
	    									(select count(forum_ans_id) from forum_answer where forum_id = f.forum_id) as total_answer
	    									from forum_question as f
	    									inner join user as u
	    									on u.id= f.questioner
	    									where f.questioner = $user_id
	    									order by f.forum_id desc");
			}
			if ($query->num_rows() > 0) {
				return $query->result();
			}
			return 0;
		}

		function getQuestion($qid)
		{
			$query = $this->db->query("select f.*,  u.email, u.user_type
    									from forum_question as f
    									inner join user as u
    									on u.id= f.questioner
    									where f.forum_id = $qid
    									order by f.forum_id asc");
			if ($query->num_rows() > 0) {
				return $query->row();
			}
			return 0;
		}

		function getAnswers($qid)
		{
			$query = $this->db->query("select f.*,  u.email, u.user_type
    									from forum_answer as f
    									inner join user as u
    									on u.id= f.answerer
    									where f.forum_id = $qid
    									order by f.forum_ans_id asc");
			if ($query->num_rows() > 0) {
				return $query->result();
			}
			return 0;
		}

		function inserttopic()
		{
			$today = date("Y-m-d");

			$data = array('question' => $this->input->post('question'),
				'question_detail' => $this->input->post('question_detail'),
				'forum_date' => $today,
				'views' => 0,
				'questioner' => $this->session->userdata(USER_ID));
			$this->db->insert('forum_question', $this->security->xss_clean($data));
			$faqid = $this->db->insert_id();

			return $faqid;
		}

		function reply()
		{
			$today = date("Y-m-d");

			$data = array('answer' => $this->input->post('reply'),
				'forum_id' => $this->input->post('qid'),
				'answer_date' => $today,
				'answerer' => $this->session->userdata(USER_ID));
			$this->db->insert('forum_answer', $this->security->xss_clean($data));
			$id = $this->db->insert_id();

			return $id;
		}

		public function updateview($qid)
		{
			$view = $this->getviews($qid) + 1;
			$query = $this->db->query("Update forum_question set views = $view where forum_id = $qid");
			if ($this->db->affected_rows() > 0) {
				return TRUE;
			}
			return FALSE;
		}

		public function getviews($qid)
		{
			$this->db->select('views');
			$query = $this->db->get_where('forum_question', array('forum_id' => $qid));
			if ($query->num_rows() > 0) {
				return $query->row()->views;
			}
			return 0;
		}
	}

?>