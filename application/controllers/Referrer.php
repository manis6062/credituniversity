<?php

	if (!defined('BASEPATH'))
		exit('No direct script access allowed');

	class Referrer extends CI_Controller
	{

		private $errors = "";

		public function __construct()
		{
			parent::__construct();

			$this->load->library('pagination');
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<div class="error">* ', '</div>');
			$this->load->model('AffiliateModel');

			$this->load->model('EmailerModel');

			// if ( $this->input->post( 'remember' ) ) // set sess_expire_on_close to 0 or FALSE when remember me is checked.
			// $this->config->set_item('sess_expire_on_close', '0'); // do change session config
//  
			// $this->load->library('session');
		}

		function _remap($method, $params)
		{
			$map = array();
			for ($i = 1; $i < count($params); $i = $i + 2) {
				$map[$params[$i - 1]] = $params[$i];
			}

			if ($method[0] != '_' && method_exists($this, $method))
				return $this->$method($map);
			else
				$this->index($method, $params[0]);
		}

		public function index($user, $code)
		{
			$this->show($user, $code);
		}

		public function show($ref_user, $code)
		{
			$email = $this->ClientModel->checkcodeanduseravailability($code);
			$refid = $this->ClientModel->getreferrerInfoForClient($ref_user);
			if ($email) {
				$data['refinfo'] = $refid;
				$data['ref_user'] = $ref_user;
				$data['email'] = $email;
				$data['title'] = 'Client Registration';
				$data['code'] = $code;
				$data['states'] = $this->AffiliateModel->getStates();
				$data['main_content'] = 'client_registration';
				$this->load->view('inc/registration', $data);
			} else {
				redirect(base_url());
			}
		}


		function validate_phone_number($value)
		{
			$value = trim($value);
			$match = '/^\(?[0-9]{3}\)?[-. ]?[0-9]{3}[-. ]?[0-9]{4}$/';
			$replace = '/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/';
			$return = '($1) $2-$3';
			if (preg_match($match, $value)) {
				return preg_replace($replace, $return, $value);
			} else {
				$this->form_validation->set_message('validate_phone_number', 'Invalid Contact Number.');
				return false;
			}
		}

		function checkSSN($ssn)
		{
			if (preg_match("/[0-9]{3}\-[0-9]{2}\-[0-9]{4}/", $ssn)) {
				return TRUE;
			} else {
				$this->form_validation->set_message('checkSSN', 'Invalid Social Security Number.');
				return FALSE;

			}
		}

		function checkzip($zip)
		{
			if (preg_match("/[0-9]{5}/", $zip)) {
				return TRUE;
			} else {
				$this->form_validation->set_message('checkzip', 'Invalid Zip Code.');
				return FALSE;

			}
		}

		function checkDateFormat($date)
		{
			if (preg_match("/[0-9]{2}\/[0-9]{2}\/[0-9]{4}/", $date)) {
				if (checkdate(substr($date, 0, 2), substr($date, 3, 2), substr($date, 6, 4))) {
					return true;
				} else {
					$this->form_validation->set_message('checkDateFormat', 'Invalid Date');
					return false;
				}
			} else {
				$this->form_validation->set_message('checkDateFormat', 'Invalid Date');
				return false;
			}
		}


		public function username_check($str)
		{
			$query = $this->db->query("SELECT user_id FROM user WHERE login_name = '$str'");
			// echo $query->num_rows();die;
			if ($query->num_rows() > 0) {
				$this->form_validation->set_message('username_check', 'This username already used.');
				return FALSE;
			} else {
				return TRUE;
			}
		}


		public function alpha_space($str)
		{
			if (!empty($str)) {
				if (preg_match("/^([a-z ])+$/i", $str)) {
					return true;
				} else {
					$this->form_validation->set_message('alpha_space', 'The %s field can only contain Alphabetical Characters.');
					return false;
				}
			} else {

				return true;
			}
		}

		public function client_reg()
		{


			$this->load->helper(array('form', 'url'));
			$this->load->helper('security');

			$this->load->library('form_validation');
			$this->load->database();
			$this->form_validation->set_rules('uname', 'Username', 'required|callback_username_check');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|max_length[12]');
			$this->form_validation->set_rules('cpassword', 'Password Confirmation', 'required|min_length[5]|max_length[12]|matches[password]');

			$this->form_validation->set_rules('fname', 'First Name', 'required|callback_alpha_space');
			$this->form_validation->set_rules('mname', 'Middle Name', 'callback_alpha_space');
			$this->form_validation->set_rules('lname', 'Last Name', 'required|callback_alpha_space');
			$this->form_validation->set_rules('mmname', 'Mothers Maiden Name', 'required|callback_alpha_space');

			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');

			$this->form_validation->set_rules('pcon', 'Primary Contact', 'required|callback_validate_phone_number');
			$this->form_validation->set_rules('scon', 'Secondary Contact');

			$this->form_validation->set_rules('gender', 'Gender', 'required');
			$this->form_validation->set_rules('state', 'State', 'required');
			$this->form_validation->set_rules('city', 'City ', 'required|callback_alpha_space');
			$this->form_validation->set_rules('zip', 'Zip', 'required|callback_checkzip');
			$this->form_validation->set_rules('address', 'Address ', 'required');

			$this->form_validation->set_rules('dob', 'Date of Birth', 'required|callback_checkDateFormat');


			if ($this->form_validation->run() == FALSE) {
				//$this->index();
				$this->index($this->input->post('ref_user'), $this->input->post('code'));
			} else {
				$cemail = $this->input->post('email');
				$cusername = $this->ClientModel->getGenerateUsername();
				$password = $this->ClientModel->generatePassword();
				$user_id = $this->ClientModel->insertClient($cusername, $password);
				if ($user_id) {
					$client = $this->ClientModel->insertInToClientTable($user_id);
					if (!empty($client)) {
						$client_email = $client->email;
						$client_name = $client->client_name;
						$client_login = $client->login_name;
						$this->EmailerModel->clientRegistrationFromRef($client_email, $cemail, $client_name, $client_login, $password);
//						$subject = "Registration on The Credit University";
//		            	$this->load->library('SimpleEmailService');
//		                $ses = new SimpleEmailService('AKIAISEC5PBG2F54VL4A', 'ZhRYSpKdUMLRrxPwy878UN+pJmnllAocdcYRpJwZ');
//
//		                $ses->enableVerifyPeer(false);
//		                //print_r($ses->verifyEmailAddress('savrniroj@gmail.com'));
//		                $m = new SimpleEmailServiceMessage();
//		                $m->addTo($client->email);
//		                $m->setFrom($cemail.'<'.EMAILSENDER.'>');
//		                $m->setSubject($subject);
//						$msg = '<div class="box" style="padding:0px;width:40%; margin:0 auto;-webkit-border-radius: 5px;
//								-moz-border-radius: 5px;
//								border-radius: 5px; border:1px solid #ccc;">
//								<div class="title" style="-webkit-border-top-left-radius: 5px;
//								-webkit-border-top-right-radius: 5px;
//								-moz-border-radius-topleft: 5px;
//								-moz-border-radius-topright: 5px;
//								border-top-left-radius: 5px;
//								border-top-right-radius: 5px; background:#ccc; color:#fff;">';
//						$msg.= '<h3 style="padding:10px; margin:0px; color:#ac6f00;"><img src="'.base_url().'style/img/logofront.png" height="35px" style="vertical-align:middle;margin-right:15px;">America Cpn</h3></div>';
//						$msg.= '<div class="content" style="padding:10px; font-size:14px;">';
//						$msg.= '<p style="font-size:13px;">Hello <strong>'.$client->client_name.'</strong> You are registered successfully in americancpn website. Your Login credentials for the site is:</p>';
//						$msg.= '<p style="font-size:13px;">Site Url: <a href="'.base_url().'">'.base_url().'</a><br>Site Admin Url: <a href="'.base_url().'admin">'.base_url().'admin</a><br>Username: '.$client->login_name.'<br>Password: '.$password.'</p><br></div>';
//						$msg.= '<div class="footer" style="-webkit-border-bottom-right-radius: 5px;
//								-webkit-border-bottom-left-radius: 5px;
//								-moz-border-radius-bottomright: 5px;
//								-moz-border-radius-bottomleft: 5px;
//								border-bottom-right-radius: 5px;
//								border-bottom-left-radius: 5px;background:#ccc; color:#ac6f00; margin:0px; padding:1px 10px;">';
//						$msg.= '<p>Yours Sincerely,<br>The Credit University Team</p></div></div>';
//						$message = $msg;
//		                $m->setMessageFromString('', $message);
//                		$this -> session -> set_flashdata("su_message", "Client Added Successfully");
//		                $ses->sendEmail($m);


					}
				} else {
					$this->session->set_flashdata("su_message", "Error while creating client.");
					$this->index($this->input->post('ref_user'), $this->input->post('code'));
				}


				$this->session->set_flashdata("success_msg_affiliate", "You have successfully registered as Affiliate Plz check your email.");

				redirect(base_url() . 'referrer/success');
			}
		}

		function success()
		{
			$data['main_content'] = 'client_registration_success';
			$this->load->view('inc/registration', $data);

		}


	}

	/* End of file welcome.php */
	/* Location: ./application/controllers/welcome.php */