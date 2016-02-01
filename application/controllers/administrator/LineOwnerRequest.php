<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class LineOwnerRequest extends CI_Controller
{

    private $errors = "";
    private $allowed = array();

    public function __construct()
    {
        parent::__construct();

        // Your own constructor code
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->form_validation->set_error_delimiters('<div class="red">', '</div>');
        $this->load->helper(array('form', 'url', 'general'));
        $this->load->helper('path');
        $this->load->model('LineModel');
        checkAdminAuth();
        $this->load->model('AuthModel');
        //$this->load->model('user_auth_model');
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

        //echo $this->session->userdata(ADMIN_AUTH_TYPE);die;
        if (in_array('referrer_view', $this->allowed)) {
            $data['list'] = $this->LineModel->lineGetAll();
            $data['allowed'] = $this->allowed;
            $data['error'] = $this->errors;

            $data['title'] = "Request sent by " . $this->session->userdata(ADMIN_AUTH_USERNAME);


            if ($this->session->userdata(ADMIN_AUTH_TYPE) != 'affiliate' && $this->session->userdata(ADMIN_AUTH_TYPE) != 'referrer' && $this->session->userdata(ADMIN_AUTH_TYPE) != 'client') {
                $type = 'referrer';
            } elseif (($this->session->userdata(ADMIN_AUTH_TYPE) == 'affiliate') || ($this->session->userdata(ADMIN_AUTH_TYPE) == 'referrer')) {
                $type = 'Lineowner';
            }


            $data['title1'] = "Request for signup '" . $type . "'";
            $data['main_content'] = ADMIN_PATH . "lineowner_requestforsignup";
            $this->load->view(ADMIN_PATH . 'incs/template', $data);
        } else {
            redirect("admin");
        }
    }

    function deleteAction($id)
    {
        $album_id = array();
        if (in_array('referrer_view', $this->allowed)) {
            //check before delete if it is admin user or currently loggged in user
            if ($this->LineModel->delete($id[0])) {
                $this->session->set_flashdata("su_message", "Request Record Deleted Successfully.");
            } else {
                $this->session->set_flashdata("su_message", "<font color=\"#FF0000\">The Selected Record Can't Be Deleted.</font>");
            }
        } else {
            $this->session->set_flashdata("su_message", "You Have No Permission To Delete This Record");
        }
        redirect(ADMIN_PATH . "lineowner_request");
    }

    // function addAction($album_id) {
    // $masterauth = new AuthModel();
    // $album_title = $this->AlbumModel->getDetails($album_id['0']);
    // $data['mas_auth'] = $masterauth->getAllAuth();
    // $data['error'] = $this->errors;
    // $data['title'] = "Add Gallery Image for album ".$album_title->album_title;
    // $data['album_id'] = $album_id['0'];
    //
    // $data['main_content'] = ADMIN_PATH . "gallery_add_view";
    // $this->load->view(ADMIN_PATH . 'incs/template', $data);
    // }

    function add()
    {
        if (in_array('referrer_view', $this->allowed)) {
            $flag = FALSE;
            foreach ($this->input->post('email') as $value) {
                if (!$this->UserModel->checkemailregistered($value)) {
                    $rcode = $this->generatercode();
                    $email = $value;

                    $this->EmailerModel->RequestForSignupFromreferrer($email, $rcode);

//					$subject = "Signup link for registering in americancpn";
//					$msg = $this->input->post('message');
//	            	$this->load->library('SimpleEmailService');
//	                $ses = new SimpleEmailService('AKIAISEC5PBG2F54VL4A', 'ZhRYSpKdUMLRrxPwy878UN+pJmnllAocdcYRpJwZ');
//
//	                $ses->enableVerifyPeer(false);
//	                //print_r($ses->verifyEmailAddress('savrniroj@gmail.com'));
//	                $m = new SimpleEmailServiceMessage();
//	                $m->addTo($email);
//	                $m->setFrom('Request for signup'.'<'.EMAILSENDER.'>');
//	                $m->setSubject($subject);
//	                $msg = " ";
//					if($this->session->userdata(ADMIN_AUTH_TYPE)=='affiliate' || $this->session->userdata(ADMIN_AUTH_TYPE)=='referrer'){
//						$msg.= "Here is the link for Line Registration: <a href='".base_url()."line/".$this->session->userdata(ADMIN_AUTH_NAMEUSER)."/".$rcode."'>Sign Up</a>";
//						$msg.= '<!doctype html>
//									<html>
//									<head>
//									<meta charset="utf-8">
//									<title>CPN Email Template</title>
//
//									</head>
//
//									<body>
//									<div class="box" style="padding:0px;width:500px; margin:0 auto;-webkit-border-radius: 5px;
//									-moz-border-radius: 5px;
//									border-radius: 5px; border:1px solid #ccc; ">
//									<div class="title" style="-webkit-border-top-left-radius: 5px;
//									-webkit-border-top-right-radius: 5px;
//									-moz-border-radius-topleft: 5px;
//									-moz-border-radius-topright: 5px;
//									border-top-left-radius: 5px;
//									border-top-right-radius: 5px; background:#027dab; color:#fff;">';
//
//						$msg.= '<h3 style="padding:10px; margin:0px; color:#fff;"><img src="'.base_url().'frontend/images/logo.png" height="35px" style="vertical-align:middle;margin-right:15px;">The Credit University</h3>';
//						$msg.='</div>
//								<div><img src="'.base_url().'frontend/images/american-cpn.gif"/></div>
//								<div class="footer" style="-webkit-border-bottom-right-radius: 5px;
//								-webkit-border-bottom-left-radius: 5px;
//								-moz-border-radius-bottomright: 5px;
//								-moz-border-radius-bottomleft: 5px;
//								border-bottom-right-radius: 5px;
//								border-bottom-left-radius: 5px;background:#027dab; color:#fff; margin:0px; padding:1px 10px; margin-top:600px;">
//								<p>Yours Sincerely,<br>
//								The Credit University Team</p>
//
//								</div>
//								</div>
//								</body>
//								</html>';
//
//
//
//					}elseif($this->session->userdata(ADMIN_AUTH_TYPE)!='affiliate' || $this->session->userdata(ADMIN_AUTH_TYPE)!='referrer' || $this->session->userdata(ADMIN_AUTH_TYPE)!='client'){
//						// header part of email template
//						$msg .= '<html>
//									<head>
//									<meta charset="utf-8">
//									<title>Email Template</title>
//
//									</head>
//
//									<body>
//									<div class="box" style="padding:0px;width:40%; margin:0 auto;-webkit-border-radius: 5px;
//									-moz-border-radius: 5px;
//									border-radius: 5px; border:1px solid #ccc;">
//									<div class="title" style="-webkit-border-top-left-radius: 5px;
//									-webkit-border-top-right-radius: 5px;
//									-moz-border-radius-topleft: 5px;
//									-moz-border-radius-topright: 5px;
//									border-top-left-radius: 5px;
//									border-top-right-radius: 5px; background:#ccc; color:#fff;">
//									<h3 style="padding:10px; margin:0px; color:#ac6f00;"><img src="'.base_url().'frontend/images/logo.png" height="35px" style="vertical-align:middle;margin-right:15px;">The Credit University</h3>
//									</div>
//									<div class="content" style="padding:10px; font-size:14px;">';
//
//						// body part of email template
//						$msg.= '<p style="font-size:13px;">Here is the link for referrer Registration: <a href="'.base_url().'register/referrer/'.$rcode.'">Sign Up</a></p>';
//
//						// footer part of email template
//						$msg .='</div>
//								<div class="footer" style="-webkit-border-bottom-right-radius: 5px;
//								-webkit-border-bottom-left-radius: 5px;
//								-moz-border-radius-bottomright: 5px;
//								-moz-border-radius-bottomleft: 5px;
//								border-bottom-right-radius: 5px;
//								border-bottom-left-radius: 5px;background:#ccc; color:#ac6f00; margin:0px; padding:1px 10px;">
//								<p>Yours Sincerely,<br>
//								The Credit University Team</p>
//								</div>
//								</div>
//								</body>
//								</html>';
//					}
//					$message = $msg;
//	                $m->setMessageFromString('', $message);

                } else {
                    $this->session->set_flashdata("su_message", "<p class='red'>Email already registered.</p>");

                    redirect(ADMIN_PATH . "lineowner_request");
                }
            }
            if ($flag) {

                $this->session->set_flashdata("su_message", "<p class='green'>Request has been sent Successfully.</p>");

            } else {
                $this->session->set_flashdata("su_message", "Some errors occured while sending request.");
            }
            redirect(ADMIN_PATH . "lineowner_request");
        } else {
            $this->session->set_flashdata("su_message", "You don't have the permission to send emails.");
            redirect(ADMIN_PATH . "lineowner_request");
        }
    }

    function remove_checked()
    {
        if (in_array('referrer_view', $this->allowed)) {
            $this->form_validation->set_rules('msg[]', 'Private Message', 'required|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata("su_message", "Select anyone of the items.");
                redirect(ADMIN_PATH . "lineowner_request");
            } else //success
            {
                foreach ($_POST['msg'] as $id) {
                    if ($this->LineModel->delete($id)) {
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
        redirect(ADMIN_PATH . "lineowner_request");
    }

    function generatercode()
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $rcode = substr(str_shuffle($chars), 0, 15);
        if ($this->LineModel->checkcode($rcode)) {
            $this->generatercode();
        } else {
            return $rcode;
        }
    }
}

?>