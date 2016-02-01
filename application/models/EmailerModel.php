<?php

class EmailerModel extends CI_Model {

    function __construct() {
        parent::__construct();

        $this -> load -> library('SimpleEmailService');
    }

    function emailSenderForSignUp($email,$password)
    {


        $subject = "Registration on The Credit University";
        $this->load->library('SimpleEmailService');
        $ses = new SimpleEmailService('AKIAISEC5PBG2F54VL4A', 'ZhRYSpKdUMLRrxPwy878UN+pJmnllAocdcYRpJwZ');

        $ses->enableVerifyPeer(false);
        //print_r($ses->verifyEmailAddress('savrniroj@gmail.com'));
        $m = new SimpleEmailServiceMessage();
        $m->addTo($email);
        $m->setFrom('<'.EMAILSENDER.'>');
        $m->setSubject($subject);
        $msg = '<div class="box" style="padding:0px;width:40%; margin:0 auto;-webkit-border-radius: 5px;
									-moz-border-radius: 5px;
									border-radius: 5px; border:1px solid #ccc;">
									<div class="title" style="-webkit-border-top-left-radius: 5px;
									-webkit-border-top-right-radius: 5px;
									-moz-border-radius-topleft: 5px;
									-moz-border-radius-topright: 5px;
									border-top-left-radius: 5px;
									border-top-right-radius: 5px; background:#ccc; color:#fff;">';
        $msg.= '<h3 style="padding:10px; margin:0px; color:#ac6f00;"><img src="'.base_url().'style/img/logofront.png" height="35px" style="vertical-align:middle;margin-right:15px;">The Credit University</h3></div>';
        $msg.= '<div class="content" style="padding:10px; font-size:14px;">';
        $msg.= '<p style="font-size:13px;">You are registered successfully in americancpn website. Your Login credentials for the site is:</p>';
        $msg.= '<p style="font-size:13px;"><br>Username: '.$email.'<br>Password: '.$password.'</p><br></div>';
        $msg.= '<div class="footer" style="-webkit-border-bottom-right-radius: 5px;
									-webkit-border-bottom-left-radius: 5px;
									-moz-border-radius-bottomright: 5px;
									-moz-border-radius-bottomleft: 5px;
									border-bottom-right-radius: 5px;
									border-bottom-left-radius: 5px;background:#ccc; color:#ac6f00; margin:0px; padding:1px 10px;">';
        $msg.= '<p>Yours Sincerely,<br>The Credit University Team</p></div></div>';
        $message = $msg;
        $m->setMessageFromString('', $message);
        $ses->sendEmail($m);
    }

	
	function clientRegistrationFromBroker($client_email,$client_name,$client_login_name,$client_password , $broker_email){
		
		$subject = "Registration on The Credit University";
			            	$this->load->library('SimpleEmailService');
			                $ses = new SimpleEmailService('AKIAISEC5PBG2F54VL4A', 'ZhRYSpKdUMLRrxPwy878UN+pJmnllAocdcYRpJwZ');

			                $ses->enableVerifyPeer(false);
			                //print_r($ses->verifyEmailAddress('savrniroj@gmail.com'));
			                $m = new SimpleEmailServiceMessage();
			                $m->addTo($client_email);
			                $m->setFrom($broker_email.'<'.EMAILSENDER.'>');
			                $m->setSubject($subject);
							$msg = '<div class="box" style="padding:0px;width:40%; margin:0 auto;-webkit-border-radius: 5px;
									-moz-border-radius: 5px;
									border-radius: 5px; border:1px solid #ccc;">
									<div class="title" style="-webkit-border-top-left-radius: 5px;
									-webkit-border-top-right-radius: 5px;
									-moz-border-radius-topleft: 5px;
									-moz-border-radius-topright: 5px;
									border-top-left-radius: 5px;
									border-top-right-radius: 5px; background:#ccc; color:#fff;">';	
							$msg.= '<h3 style="padding:10px; margin:0px; color:#ac6f00;"><img src="'.base_url().'style/img/logofront.png" height="35px" style="vertical-align:middle;margin-right:15px;">The Credit University</h3></div>';
							$msg.= '<div class="content" style="padding:10px; font-size:14px;">';
							$msg.= '<p style="font-size:13px;">Hello <strong>'.$client_name.'</strong> You are registered successfully in americancpn website. Your Login credentials for the site is:</p>';
							$msg.= '<p style="font-size:13px;">Site Url: <a href="'.base_url().'">'.base_url().'</a><br>Site Admin Url: <a href="'.base_url().'admin">'.base_url().'admin</a><br>Username: '.$client_login_name.'<br>Password: '.$client_password.'</p><br></div>';
							$msg.= '<div class="footer" style="-webkit-border-bottom-right-radius: 5px;
									-webkit-border-bottom-left-radius: 5px;
									-moz-border-radius-bottomright: 5px;
									-moz-border-radius-bottomleft: 5px;
									border-bottom-right-radius: 5px;
									border-bottom-left-radius: 5px;background:#ccc; color:#ac6f00; margin:0px; padding:1px 10px;">';
							$msg.= '<p>Yours Sincerely,<br>The Credit University Team</p></div></div>';
							$message = $msg;
			                $m->setMessageFromString('', $message);
			                $ses->sendEmail($m);
	}


    function referrerRegistrationFromBroker($username,$email){
        $subject = 'Successfully Registered As referrer in The Credit University';
        $msg = '<html>
										<head>
										<meta charset="utf-8">
										<title>Email Template</title>

										</head>

										<body>
										<div class="box" style="padding:0px;width:40%; margin:0 auto;-webkit-border-radius: 5px;
										-moz-border-radius: 5px;
										border-radius: 5px; border:1px solid #ccc;">
										<div class="title" style="-webkit-border-top-left-radius: 5px;
										-webkit-border-top-right-radius: 5px;
										-moz-border-radius-topleft: 5px;
										-moz-border-radius-topright: 5px;
										border-top-left-radius: 5px;
										border-top-right-radius: 5px; background:#ccc; color:#fff;">
										<h3 style="padding:10px; margin:0px; color:#ac6f00;"><img src="' . base_url() . 'frontend/images/logo.png" height="35px" style="vertical-align:middle;margin-right:15px;">The Credit University</h3>
										</div>
										<div class="content" style="padding:10px; font-size:14px;"><p style="font-size:13px;">';

        $msg .= 'Please click on <a href="' . base_url() . 'admin">this link</a> for referrer login.  <br>Username: ' . $username . '  <br> Password: ********';

        // footer part of email template
        $msg .= '</p></div>
									<div class="footer" style="-webkit-border-bottom-right-radius: 5px;
									-webkit-border-bottom-left-radius: 5px;
									-moz-border-radius-bottomright: 5px;
									-moz-border-radius-bottomleft: 5px;
									border-bottom-right-radius: 5px;
									border-bottom-left-radius: 5px;background:#ccc; color:#ac6f00; margin:0px; padding:1px 10px;">
									<p>Yours Sincerely,<br>
									The Credit University Team</p>
									</div>
									</div>
									</body>
									</html>';

        $this -> load -> library('SimpleEmailService');
        $ses = new SimpleEmailService('AKIAISEC5PBG2F54VL4A', 'ZhRYSpKdUMLRrxPwy878UN+pJmnllAocdcYRpJwZ');

        $ses -> enableVerifyPeer(false);
        //print_r($ses->verifyEmailAddress('savrniroj@gmail.com'));
        $m = new SimpleEmailServiceMessage();
        $m -> addTo('contact <' . $email . '>');
        $m -> setFrom('The Credit University' . '<' . EMAILSENDER . '>');
        $m -> setSubject($subject);
        $message = $msg;
        $m -> setMessageFromString('', $message);
        $ses -> sendEmail($m);
    }

    function lineownerRegistrationFromreferrer($lineowner_email,$lineowner_full_name, $referrer_email,$lineowner_login_name,$lineowner_password){

        $subject = "Registration on The Credit University";
        $this -> load -> library('SimpleEmailService');
        $ses = new SimpleEmailService('AKIAISEC5PBG2F54VL4A', 'ZhRYSpKdUMLRrxPwy878UN+pJmnllAocdcYRpJwZ');

        $ses -> enableVerifyPeer(false);
        //print_r($ses->verifyEmailAddress('savrniroj@gmail.com'));
        $m = new SimpleEmailServiceMessage();
        $m -> addTo($lineowner_email);
        $m -> setFrom($referrer_email . '<' . EMAILSENDER . '>');
        $m -> setSubject($subject);
        $msg = '<div class="box" style="padding:0px;width:40%; margin:0 auto;-webkit-border-radius: 5px;
                                    -moz-border-radius: 5px;
                                    border-radius: 5px; border:1px solid #ccc;">
                                    <div class="title" style="-webkit-border-top-left-radius: 5px;
                                    -webkit-border-top-right-radius: 5px;
                                    -moz-border-radius-topleft: 5px;
                                    -moz-border-radius-topright: 5px;
                                    border-top-left-radius: 5px;
                                    border-top-right-radius: 5px; background:#ccc; color:#fff;">';
        $msg .= '<h3 style="padding:10px; margin:0px; color:#ac6f00;"><img src="' . base_url() . 'style/img/logofront.png" height="35px" style="vertical-align:middle;margin-right:15px;">The Credit University</h3></div>';
        $msg .= '<div class="content" style="padding:10px; font-size:14px;">';
        $msg .= '<p style="font-size:13px;">Hello <strong>' . $lineowner_full_name . '</strong> You are registered successfully in americancpn website. Your Login credentials for the site is:</p>';
        $msg .= '<p style="font-size:13px;">Site Url: <a href="' . base_url() . '">' . base_url() . '</a><br>Site Admin Url: <a href="' . base_url() . 'admin">' . base_url() . 'admin</a><br>Username: ' . $lineowner_login_name . '<br>Password: ' . $lineowner_password . '</p><br></div>';
        $msg .= '<div class="footer" style="-webkit-border-bottom-right-radius: 5px;
                                    -webkit-border-bottom-left-radius: 5px;
                                    -moz-border-radius-bottomright: 5px;
                                    -moz-border-radius-bottomleft: 5px;
                                    border-bottom-right-radius: 5px;
                                    border-bottom-left-radius: 5px;background:#ccc; color:#ac6f00; margin:0px; padding:1px 10px;">';
        $msg .= '<p>Yours Sincerely,<br>The Credit University Team</p></div></div>';
        $message = $msg;
        $m -> setMessageFromString('', $message);

        $ses -> sendEmail($m);
    }

    function addClientToCardFromreferrer($to_email , $to_fullname){
        $subject = "Add Authorized User to the Card";
        $this->load->library('SimpleEmailService');
        $ses = new SimpleEmailService('AKIAISEC5PBG2F54VL4A', 'ZhRYSpKdUMLRrxPwy878UN+pJmnllAocdcYRpJwZ');

        $ses->enableVerifyPeer(false);
        //print_r($ses->verifyEmailAddress('savrniroj@gmail.com'));
        $m = new SimpleEmailServiceMessage();
        $m->addTo($to_email);

        $m->setFrom('<'.EMAILSENDER.'>');
        $m->setSubject($subject);
        $msg = '<div class="box" style="padding:0px;width:40%; margin:0 auto;-webkit-border-radius: 5px;
									-moz-border-radius: 5px;
									border-radius: 5px; border:1px solid #ccc;">
									<div class="title" style="-webkit-border-top-left-radius: 5px;
									-webkit-border-top-right-radius: 5px;
									-moz-border-radius-topleft: 5px;
									-moz-border-radius-topright: 5px;
									border-top-left-radius: 5px;
									border-top-right-radius: 5px; background:#ccc; color:#fff;">';
        $msg.= '<h3 style="padding:10px; margin:0px; color:#ac6f00;"><img src="'.base_url().'style/img/logofront.png" height="35px" style="vertical-align:middle;margin-right:15px;">The Credit University</h3></div>';
        $msg.= '<div class="content" style="padding:10px; font-size:14px;">';
        $msg.= '<p style="font-size:13px;">Hello <strong>'.$to_fullname.'</strong> please add this client as authorized user.</p>';
        $msg.= '<p style="font-size:13px;">Thank You</p>';
        $msg.= '<div class="footer" style="-webkit-border-bottom-right-radius: 5px;
									-webkit-border-bottom-left-radius: 5px;
									-moz-border-radius-bottomright: 5px;
									-moz-border-radius-bottomleft: 5px;
									border-bottom-right-radius: 5px;
									border-bottom-left-radius: 5px;background:#ccc; color:#ac6f00; margin:0px; padding:1px 10px;">';
        $msg.= '<p>Yours Sincerely,<br>The Credit University Team</p></div></div>';
        $message = $msg;
        $m->setMessageFromString('', $message);
        //$this -> session -> set_flashdata("su_message", "Client Added Successfully");
        $ses->sendEmail($m);


    }

    function addCheckedClientToCardFromreferrer($to_email ,$to_fullname , $no_clients , $card_name ,$type_id){

        $subject = "Add Authorized User to Credit Card";
        $this->load->library('SimpleEmailService');
        $ses = new SimpleEmailService('AKIAISEC5PBG2F54VL4A', 'ZhRYSpKdUMLRrxPwy878UN+pJmnllAocdcYRpJwZ');

        $ses->enableVerifyPeer(false);
        //print_r($ses->verifyEmailAddress('savrniroj@gmail.com'));
        $m = new SimpleEmailServiceMessage();
        $m->addTo($to_email);
        $m->setFrom('<'.EMAILSENDER.'>');
        $m->setSubject($subject);
        $msg = '<div class="box" style="padding:0px;width:40%; margin:0 auto;-webkit-border-radius: 5px;
									-moz-border-radius: 5px;
									border-radius: 5px; border:1px solid #ccc;">
									<div class="title" style="-webkit-border-top-left-radius: 5px;
									-webkit-border-top-right-radius: 5px;
									-moz-border-radius-topleft: 5px;
									-moz-border-radius-topright: 5px;
									border-top-left-radius: 5px;
									border-top-right-radius: 5px; background:#ccc; color:#fff;">';
        $msg.= '<h3 style="padding:10px; margin:0px; color:#ac6f00;"><img src="'.base_url().'style/img/logofront.png" height="35px" style="vertical-align:middle;margin-right:15px;">The Credit University</h3></div>';
        $msg.= '<div class="content" style="padding:10px; font-size:14px;">';
        $msg.= '<p style="font-size:13px;">Hello <strong>'.$to_fullname.'</strong> please add '.$no_clients.' as authorized user in' .$card_name.' ' .$type_id.'</p>';
        $msg.= '<p style="font-size:13px;">Url: <a href="'.base_url().'admin">'.base_url().'admin</a></p><br>';
        $msg.= '<p style="font-size:13px;">Thank You</p></div>';
        $msg.= '<div class="footer" style="-webkit-border-bottom-right-radius: 5px;
									-webkit-border-bottom-left-radius: 5px;
									-moz-border-radius-bottomright: 5px;
									-moz-border-radius-bottomleft: 5px;
									border-bottom-right-radius: 5px;
									border-bottom-left-radius: 5px;background:#ccc; color:#ac6f00; margin:0px; padding:1px 10px;">';
        $msg.= '<p>Yours Sincerely,<br>The Credit University Team</p></div></div>';
        $message = $msg;
        $m->setMessageFromString('', $message);
        //$this -> session -> set_flashdata("su_message", "Client Added Successfully");
        $ses->sendEmail($m);

    }
	  function RequestForSignupFromreferrer($email ,$rcode){

          $subject = "Signup link for registering in americancpn";
          $msg = $this->input->post('message');
          $this->load->library('SimpleEmailService');
          $ses = new SimpleEmailService('AKIAISEC5PBG2F54VL4A', 'ZhRYSpKdUMLRrxPwy878UN+pJmnllAocdcYRpJwZ');

          $ses->enableVerifyPeer(false);
          //print_r($ses->verifyEmailAddress('savrniroj@gmail.com'));
          $m = new SimpleEmailServiceMessage();
          $m->addTo($email);
          $m->setFrom('Request for signup'.'<'.EMAILSENDER.'>');
          $m->setSubject($subject);
          $msg = " ";
          if($this->session->userdata(ADMIN_AUTH_TYPE)=='affiliate' || $this->session->userdata(ADMIN_AUTH_TYPE)=='referrer'){
              $msg.= "Here is the link for Line Registration: <a href='".base_url()."line/".$this->session->userdata(ADMIN_AUTH_NAMEUSER)."/".$rcode."'>Sign Up</a>";
              $msg.= '<!doctype html>
									<html>
									<head>
									<meta charset="utf-8">
									<title>CPN Email Template</title>

									</head>

									<body>
									<div class="box" style="padding:0px;width:500px; margin:0 auto;-webkit-border-radius: 5px;
									-moz-border-radius: 5px;
									border-radius: 5px; border:1px solid #ccc; ">
									<div class="title" style="-webkit-border-top-left-radius: 5px;
									-webkit-border-top-right-radius: 5px;
									-moz-border-radius-topleft: 5px;
									-moz-border-radius-topright: 5px;
									border-top-left-radius: 5px;
									border-top-right-radius: 5px; background:#027dab; color:#fff;">';

              $msg.= '<h3 style="padding:10px; margin:0px; color:#fff;"><img src="'.base_url().'frontend/images/logo.png" height="35px" style="vertical-align:middle;margin-right:15px;">The Credit University</h3>';
              $msg.='</div>
								<div><img src="'.base_url().'frontend/images/american-cpn.gif"/></div>
								<div class="footer" style="-webkit-border-bottom-right-radius: 5px;
								-webkit-border-bottom-left-radius: 5px;
								-moz-border-radius-bottomright: 5px;
								-moz-border-radius-bottomleft: 5px;
								border-bottom-right-radius: 5px;
								border-bottom-left-radius: 5px;background:#027dab; color:#fff; margin:0px; padding:1px 10px; margin-top:600px;">
								<p>Yours Sincerely,<br>
								The Credit University Team</p>

								</div>
								</div>
								</body>
								</html>';



          }elseif($this->session->userdata(ADMIN_AUTH_TYPE)!='affiliate' || $this->session->userdata(ADMIN_AUTH_TYPE)!='referrer' || $this->session->userdata(ADMIN_AUTH_TYPE)!='client'){
              // header part of email template
              $msg .= '<html>
									<head>
									<meta charset="utf-8">
									<title>Email Template</title>

									</head>

									<body>
									<div class="box" style="padding:0px;width:40%; margin:0 auto;-webkit-border-radius: 5px;
									-moz-border-radius: 5px;
									border-radius: 5px; border:1px solid #ccc;">
									<div class="title" style="-webkit-border-top-left-radius: 5px;
									-webkit-border-top-right-radius: 5px;
									-moz-border-radius-topleft: 5px;
									-moz-border-radius-topright: 5px;
									border-top-left-radius: 5px;
									border-top-right-radius: 5px; background:#ccc; color:#fff;">
									<h3 style="padding:10px; margin:0px; color:#ac6f00;"><img src="'.base_url().'frontend/images/logo.png" height="35px" style="vertical-align:middle;margin-right:15px;">The Credit University</h3>
									</div>
									<div class="content" style="padding:10px; font-size:14px;">';

              // body part of email template
              $msg.= '<p style="font-size:13px;">Here is the link for referrer Registration: <a href="'.base_url().'register/referrer/'.$rcode.'">Sign Up</a></p>';

              // footer part of email template
              $msg .='</div>
								<div class="footer" style="-webkit-border-bottom-right-radius: 5px;
								-webkit-border-bottom-left-radius: 5px;
								-moz-border-radius-bottomright: 5px;
								-moz-border-radius-bottomleft: 5px;
								border-bottom-right-radius: 5px;
								border-bottom-left-radius: 5px;background:#ccc; color:#ac6f00; margin:0px; padding:1px 10px;">
								<p>Yours Sincerely,<br>
								The Credit University Team</p>
								</div>
								</div>
								</body>
								</html>';
          }
          $message = $msg;
          $m->setMessageFromString('', $message);
          if($ses->sendEmail($m) && $this -> LineModel -> insert_line($email , $rcode)){
              //if($this -> RequestModel -> insert($value)){
              //if($this -> RequestModel -> insert($value)){
              $flag = TRUE;
          }else{
              $flag = FALSE;
          }

      }

    function SendMailToRefWhileNotAddedFromTo($referrer_email,$line_owner_email,$referrer_fullname , $client_fullname , $type_id , $card_name , $x){
        $subject = "Client Decline on The Credit University";
        $this -> load -> library('SimpleEmailService');
        $ses = new SimpleEmailService('AKIAISEC5PBG2F54VL4A', 'ZhRYSpKdUMLRrxPwy878UN+pJmnllAocdcYRpJwZ');
        $msg = '';
        $ses -> enableVerifyPeer(false);
        //print_r($ses->verifyEmailAddress('savrniroj@gmail.com'));
        $m = new SimpleEmailServiceMessage();
        $m -> addTo($referrer_email);
        $m -> setFrom($line_owner_email . '<' . EMAILSENDER . '>');
        $m -> setSubject($subject);

        // header part of email template
        $msg .= '<html>
                                            <head>
                                            <meta charset="utf-8">
                                            <title>Email Template</title>

                                            </head>

                                            <body>
                                            <div class="box" style="padding:0px;width:40%; margin:0 auto;-webkit-border-radius: 5px;
                                            -moz-border-radius: 5px;
                                            border-radius: 5px; border:1px solid #ccc;">
                                            <div class="title" style="-webkit-border-top-left-radius: 5px;
                                            -webkit-border-top-right-radius: 5px;
                                            -moz-border-radius-topleft: 5px;
                                            -moz-border-radius-topright: 5px;
                                            border-top-left-radius: 5px;
                                            border-top-right-radius: 5px; background:#ccc; color:#fff;">
                                            <h3 style="padding:10px; margin:0px; color:#ac6f00;"><img src="' . base_url() . 'frontend/images/logo.png" height="35px" style="vertical-align:middle;margin-right:15px;">The Credit University</h3>
                                            </div>
                                            <div class="content" style="padding:10px; font-size:14px;"><p style="font-size:13px;">';

        $msg .= "<h3 style='text-align:center;'>Client Decline on The Credit University : </h3>";
        $msg .= "Hello " .$referrer_fullname  .  ",<br/>";
        $msg .= "<p>This Client has been declined:</p>";
        $msg .= "<p>Name :".$client_fullname ."</p>";
        $msg .= "<p>".$type_id.' '.$card_name."</p>";
        $msg .= "<p>Note: ".$x."</p>";
        $msg .= "<br/><br/>";
        $msg .= 'Yours Sincerely,<br/>';
        $msg .= 'Americancpn referrer<br/>';
        $msg .= strtoupper($this -> session -> userdata(ADMIN_AUTH_USERNAME));



        // footer part of email template
        $msg .= '</p></div>
                                        <div class="footer" style="-webkit-border-bottom-right-radius: 5px;
                                        -webkit-border-bottom-left-radius: 5px;
                                        -moz-border-radius-bottomright: 5px;
                                        -moz-border-radius-bottomleft: 5px;
                                        border-bottom-right-radius: 5px;
                                        border-bottom-left-radius: 5px;background:#ccc; color:#ac6f00; margin:0px; padding:1px 10px;">

                                        </div>
                                        </div>
                                        </body>
                                        </html>';

        $message = $msg;
        $m -> setMessageFromString('', $message);
        $ses -> sendEmail($m);


    }

    function Signupreferrer($username , $email){
        $subject = 'Successfully Registered As referrer in The Credit University';

        // header part of email template
        $msg = '<html>
										<head>
										<meta charset="utf-8">
										<title>Email Template</title>

										</head>

										<body>
										<div class="box" style="padding:0px;width:40%; margin:0 auto;-webkit-border-radius: 5px;
										-moz-border-radius: 5px;
										border-radius: 5px; border:1px solid #ccc;">
										<div class="title" style="-webkit-border-top-left-radius: 5px;
										-webkit-border-top-right-radius: 5px;
										-moz-border-radius-topleft: 5px;
										-moz-border-radius-topright: 5px;
										border-top-left-radius: 5px;
										border-top-right-radius: 5px; background:#ccc; color:#fff;">
										<h3 style="padding:10px; margin:0px; color:#ac6f00;"><img src="'.base_url().'frontend/images/logo.png" height="35px" style="vertical-align:middle;margin-right:15px;">The Credit University</h3>
										</div>
										<div class="content" style="padding:10px; font-size:14px;"><p style="font-size:13px;">';

        $msg .= 'Please click on <a href="'.base_url().'admin">this link</a> for referrer login.  <br>Username: '.$username.'  <br> Password: ********';

        // footer part of email template
        $msg .='</p></div>
									<div class="footer" style="-webkit-border-bottom-right-radius: 5px;
									-webkit-border-bottom-left-radius: 5px;
									-moz-border-radius-bottomright: 5px;
									-moz-border-radius-bottomleft: 5px;
									border-bottom-right-radius: 5px;
									border-bottom-left-radius: 5px;background:#ccc; color:#ac6f00; margin:0px; padding:1px 10px;">
									<p>Yours Sincerely,<br>
									The Credit University Team</p>
									</div>
									</div>
									</body>
									</html>';

        $this->load->library('SimpleEmailService');
        $ses = new SimpleEmailService('AKIAISEC5PBG2F54VL4A', 'ZhRYSpKdUMLRrxPwy878UN+pJmnllAocdcYRpJwZ');

        $ses->enableVerifyPeer(false);
        //print_r($ses->verifyEmailAddress('savrniroj@gmail.com'));
        $m = new SimpleEmailServiceMessage();
        $m->addTo('contact <'.$email.'>');
        $m->setFrom('The Credit University'.'<'.EMAILSENDER.'>');
        $m->setSubject($subject);
        $message = $msg;
        $m->setMessageFromString('', $message);
        $ses->sendEmail($m);
    }

    function sendEmailsToClientAndAdminFromreferrer($emailsto){

        $subject = $this->input->post('subject');
        $this->load->library('SimpleEmailService');
        $ses = new SimpleEmailService('AKIAISEC5PBG2F54VL4A', 'ZhRYSpKdUMLRrxPwy878UN+pJmnllAocdcYRpJwZ');

        $ses->enableVerifyPeer(false);
        //print_r($ses->verifyEmailAddress('savrniroj@gmail.com'));
        $m = new SimpleEmailServiceMessage();
        $m->addTo($emailsto);
        $m->setFrom('The Credit University'.$this->session->userdata(ADMIN_AUTH_USERNAME).'<'.EMAILSENDER.'>');
        $m->setSubject($subject);

        // header part of email template
        $msg = '<html>
										<head>
										<meta charset="utf-8">
										<title>Email Template</title>

										</head>

										<body>
										<div class="box" style="padding:0px;width:40%; margin:0 auto;-webkit-border-radius: 5px;
										-moz-border-radius: 5px;
										border-radius: 5px; border:1px solid #ccc;">
										<div class="title" style="-webkit-border-top-left-radius: 5px;
										-webkit-border-top-right-radius: 5px;
										-moz-border-radius-topleft: 5px;
										-moz-border-radius-topright: 5px;
										border-top-left-radius: 5px;
										border-top-right-radius: 5px; background:#ccc; color:#fff;">
										<h3 style="padding:10px; margin:0px; color:#ac6f00;"><img src="'.base_url().'frontend/images/logo.png" height="35px" style="vertical-align:middle;margin-right:15px;">The Credit University</h3>
										</div>
										<div class="content" style="padding:10px; font-size:14px;"><p style="font-size:13px;">';

        $msg .= 'Dear Sir/Madam,<br/>';
        $msg.= $this->input->post('msg');
        $msg.= '<br/><br/>';
        $msg.= 'Yours Sincerely,<br/>';
        $msg.= 'Americancpn Client<br/>';
        $msg.= $this->session->userdata(ADMIN_AUTH_USERNAME);

        // footer part of email template
        $msg .='</p></div>
									<div class="footer" style="-webkit-border-bottom-right-radius: 5px;
									-webkit-border-bottom-left-radius: 5px;
									-moz-border-radius-bottomright: 5px;
									-moz-border-radius-bottomleft: 5px;
									border-bottom-right-radius: 5px;
									border-bottom-left-radius: 5px;background:#ccc; color:#ac6f00; margin:0px; padding:1px 10px;">

									</div>
									</div>
									</body>
									</html>';

        $message = $msg;
        $m->setMessageFromString('', $message);

        if($ses->sendEmail($m) && $this->EmailModel->insertEmails('referrer', 'Success', $receiver)){
            $this -> session -> set_flashdata("su_message", "Email Sent to referrer Successful.");
            redirect(ADMIN_PATH . "client/emails");
        }
    }

    function sendEmailsToAdminFromreferrer($email){
        $subject = $this->input->post('subject');
        $this->load->library('SimpleEmailService');
        $ses = new SimpleEmailService('AKIAISEC5PBG2F54VL4A', 'ZhRYSpKdUMLRrxPwy878UN+pJmnllAocdcYRpJwZ');

        $ses->enableVerifyPeer(false);
        //print_r($ses->verifyEmailAddress('savrniroj@gmail.com'));
        $m = new SimpleEmailServiceMessage();
        $m->addTo($email);
        $m->setFrom('The Credit University referrer '.$this->session->userdata(ADMIN_AUTH_USERNAME).'<'.EMAILSENDER.'>');
        $m->setSubject($subject);
        // header part of email template
        $msg = '<html>
										<head>
										<meta charset="utf-8">
										<title>Email Template</title>

										</head>

										<body>
										<div class="box" style="padding:0px;width:40%; margin:0 auto;-webkit-border-radius: 5px;
										-moz-border-radius: 5px;
										border-radius: 5px; border:1px solid #ccc;">
										<div class="title" style="-webkit-border-top-left-radius: 5px;
										-webkit-border-top-right-radius: 5px;
										-moz-border-radius-topleft: 5px;
										-moz-border-radius-topright: 5px;
										border-top-left-radius: 5px;
										border-top-right-radius: 5px; background:#ccc; color:#fff;">
										<h3 style="padding:10px; margin:0px; color:#ac6f00;"><img src="'.base_url().'frontend/images/logo.png" height="35px" style="vertical-align:middle;margin-right:15px;">The Credit University</h3>
										</div>
										<div class="content" style="padding:10px; font-size:14px;"><p style="font-size:13px;">';


        $msg.= 'Dear Admin,<br/>';
        $msg.= $this->input->post('msg');
        $msg.= '<br/><br/>';
        $msg.= 'Yours Sincerely,<br/>';
        $msg.= 'Americancpn referrer<br/>';
        $msg.= $this->session->userdata(ADMIN_AUTH_USERNAME);

        // footer part of email template
        $msg .='</p></div>
									<div class="footer" style="-webkit-border-bottom-right-radius: 5px;
									-webkit-border-bottom-left-radius: 5px;
									-moz-border-radius-bottomright: 5px;
									-moz-border-radius-bottomleft: 5px;
									border-bottom-right-radius: 5px;
									border-bottom-left-radius: 5px;background:#ccc; color:#ac6f00; margin:0px; padding:1px 10px;">
									<p>Yours Sincerely,<br>
									The Credit University Team</p>
									</div>
									</div>
									</body>
									</html>';


        $message = $msg;
        $m->setMessageFromString('', $message);
        //$this -> session -> set_flashdata("su_message", "Client Added Successfully");
        if($ses->sendEmail($m)){
            $flag =  TRUE;
    }
}

function sendEmailsToAdminWithUserTypeClient($value){
    $subject = $this->input->post('subject');
    $this->load->library('SimpleEmailService');
    $ses = new SimpleEmailService('AKIAISEC5PBG2F54VL4A', 'ZhRYSpKdUMLRrxPwy878UN+pJmnllAocdcYRpJwZ');

    $ses->enableVerifyPeer(false);
    //print_r($ses->verifyEmailAddress('savrniroj@gmail.com'));
    $m = new SimpleEmailServiceMessage();
    $m->addTo($value);
    $m->setFrom('The Credit University '.$this->session->userdata(ADMIN_AUTH_USERNAME).'<'.EMAILSENDER.'>');
    $m->setSubject($subject);

    // header part of email template
    $msg = '<html>
										<head>
										<meta charset="utf-8">
										<title>Email Template</title>

										</head>

										<body>
										<div class="box" style="padding:0px;width:40%; margin:0 auto;-webkit-border-radius: 5px;
										-moz-border-radius: 5px;
										border-radius: 5px; border:1px solid #ccc;">
										<div class="title" style="-webkit-border-top-left-radius: 5px;
										-webkit-border-top-right-radius: 5px;
										-moz-border-radius-topleft: 5px;
										-moz-border-radius-topright: 5px;
										border-top-left-radius: 5px;
										border-top-right-radius: 5px; background:#ccc; color:#fff;">
										<h3 style="padding:10px; margin:0px; color:#ac6f00;"><img src="'.base_url().'frontend/images/logo.png" height="35px" style="vertical-align:middle;margin-right:15px;">The Credit University</h3>
										</div>
										<div class="content" style="padding:10px; font-size:14px;"><p style="font-size:13px;">';


    $msg .= 'Dear Sir/Madam,<br/>';
    $msg.= $this->input->post('msg');
    $msg.= '<br/><br/>';
    $msg.= 'Yours Sincerely,<br/>';
    $msg.= 'The Credit University referrer<br/>';
    $msg.= $this->session->userdata(ADMIN_AUTH_USERNAME);

    // footer part of email template
    $msg .='</p></div>
									<div class="footer" style="-webkit-border-bottom-right-radius: 5px;
									-webkit-border-bottom-left-radius: 5px;
									-moz-border-radius-bottomright: 5px;
									-moz-border-radius-bottomleft: 5px;
									border-bottom-right-radius: 5px;
									border-bottom-left-radius: 5px;background:#ccc; color:#ac6f00; margin:0px; padding:1px 10px;">
									<p>Yours Sincerely,<br>
									The Credit University Team</p>
									</div>
									</div>
									</body>
									</html>';

    $message = $msg;
    $m->setMessageFromString('', $message);
    //$this -> session -> set_flashdata("su_message", "Client Added Successfully");
    if($ses->sendEmail($m)){
        $flag=TRUE;
    }
}

    function sendEmailsToreferrer($value){
        $subject = $this->input->post('subject');
        $this->load->library('SimpleEmailService');
        $ses = new SimpleEmailService('AKIAISEC5PBG2F54VL4A', 'ZhRYSpKdUMLRrxPwy878UN+pJmnllAocdcYRpJwZ');

        $ses->enableVerifyPeer(false);
        //print_r($ses->verifyEmailAddress('savrniroj@gmail.com'));
        $m = new SimpleEmailServiceMessage();
        $m->addTo($value);
        $m->setFrom('The Credit University '.$this->session->userdata(ADMIN_AUTH_USERNAME).'<'.EMAILSENDER.'>');
        $m->setSubject($subject);

        // header part of email template
        $msg = '<html>
										<head>
										<meta charset="utf-8">
										<title>Email Template</title>

										</head>

										<body>
										<div class="box" style="padding:0px;width:40%; margin:0 auto;-webkit-border-radius: 5px;
										-moz-border-radius: 5px;
										border-radius: 5px; border:1px solid #ccc;">
										<div class="title" style="-webkit-border-top-left-radius: 5px;
										-webkit-border-top-right-radius: 5px;
										-moz-border-radius-topleft: 5px;
										-moz-border-radius-topright: 5px;
										border-top-left-radius: 5px;
										border-top-right-radius: 5px; background:#ccc; color:#fff;">
										<h3 style="padding:10px; margin:0px; color:#ac6f00;"><img src="'.base_url().'frontend/images/logo.png" height="35px" style="vertical-align:middle;margin-right:15px;">The Credit University</h3>
										</div>
										<div class="content" style="padding:10px; font-size:14px;"><p style="font-size:13px;">';

        $msg .= 'Dear Sir/Madam,<br/>';
        $msg.= $this->input->post('msg');
        $msg.= '<br/><br/>';
        $msg.= 'Yours Sincerely,<br/>';
        $msg.= 'Americancpn Admin<br/>';
        $msg.= $this->session->userdata(ADMIN_AUTH_USERNAME);

        // footer part of email template
        $msg .='</p></div>
									<div class="footer" style="-webkit-border-bottom-right-radius: 5px;
									-webkit-border-bottom-left-radius: 5px;
									-moz-border-radius-bottomright: 5px;
									-moz-border-radius-bottomleft: 5px;
									border-bottom-right-radius: 5px;
									border-bottom-left-radius: 5px;background:#ccc; color:#ac6f00; margin:0px; padding:1px 10px;">
									<p>Yours Sincerely,<br>
									The Credit University Team</p>
									</div>
									</div>
									</body>
									</html>';

        $message = $msg;
        $m->setMessageFromString('', $message);
        //$this -> session -> set_flashdata("su_message", "Client Added Successfully");
        if($ses->sendEmail($m)){
            $flag = TRUE;
        }
    }

    function clientRegistrationFromRef($client_email ,$cemail, $client_name, $client_login ,$password){
        $subject = "Registration on The Credit University";
        $this->load->library('SimpleEmailService');
        $ses = new SimpleEmailService('AKIAISEC5PBG2F54VL4A', 'ZhRYSpKdUMLRrxPwy878UN+pJmnllAocdcYRpJwZ');

        $ses->enableVerifyPeer(false);
        //print_r($ses->verifyEmailAddress('savrniroj@gmail.com'));
        $m = new SimpleEmailServiceMessage();
        $m->addTo($client_email);
        $m->setFrom($cemail.'<'.EMAILSENDER.'>');
        $m->setSubject($subject);
        $msg = '<div class="box" style="padding:0px;width:40%; margin:0 auto;-webkit-border-radius: 5px;
								-moz-border-radius: 5px;
								border-radius: 5px; border:1px solid #ccc;">
								<div class="title" style="-webkit-border-top-left-radius: 5px;
								-webkit-border-top-right-radius: 5px;
								-moz-border-radius-topleft: 5px;
								-moz-border-radius-topright: 5px;
								border-top-left-radius: 5px;
								border-top-right-radius: 5px; background:#ccc; color:#fff;">';
        $msg.= '<h3 style="padding:10px; margin:0px; color:#ac6f00;"><img src="'.base_url().'style/img/logofront.png" height="35px" style="vertical-align:middle;margin-right:15px;">The Credit University</h3></div>';
        $msg.= '<div class="content" style="padding:10px; font-size:14px;">';
        $msg.= '<p style="font-size:13px;">Hello <strong>'.$client_name.'</strong> You are registered successfully in americancpn website. Your Login credentials for the site is:</p>';
        $msg.= '<p style="font-size:13px;">Site Url: <a href="'.base_url().'">'.base_url().'</a><br>Site Admin Url: <a href="'.base_url().'admin">'.base_url().'admin</a><br>Username: '.$client_login.'<br>Password: '.$password.'</p><br></div>';
        $msg.= '<div class="footer" style="-webkit-border-bottom-right-radius: 5px;
								-webkit-border-bottom-left-radius: 5px;
								-moz-border-radius-bottomright: 5px;
								-moz-border-radius-bottomleft: 5px;
								border-bottom-right-radius: 5px;
								border-bottom-left-radius: 5px;background:#ccc; color:#ac6f00; margin:0px; padding:1px 10px;">';
        $msg.= '<p>Yours Sincerely,<br>The Credit University Team</p></div></div>';
        $message = $msg;
        $m->setMessageFromString('', $message);
        $this -> session -> set_flashdata("su_message", "Client Added Successfully");
        $ses->sendEmail($m);
    }

    function SendEmailaddCheckedClientToCardReturned($to_email , $to_fullname , $no_clients){

        $subject = "Add Authorized User to Credit Card";
        $this->load->library('SimpleEmailService');
        $ses = new SimpleEmailService('AKIAISEC5PBG2F54VL4A', 'ZhRYSpKdUMLRrxPwy878UN+pJmnllAocdcYRpJwZ');

        $ses->enableVerifyPeer(false);
        //print_r($ses->verifyEmailAddress('savrniroj@gmail.com'));
        $m = new SimpleEmailServiceMessage();
        $m->addTo($to_email);
        $m->setFrom('<'.EMAILSENDER.'>');
        $m->setSubject($subject);
        $msg = '<div class="box" style="padding:0px;width:40%; margin:0 auto;-webkit-border-radius: 5px;
									-moz-border-radius: 5px;
									border-radius: 5px; border:1px solid #ccc;">
									<div class="title" style="-webkit-border-top-left-radius: 5px;
									-webkit-border-top-right-radius: 5px;
									-moz-border-radius-topleft: 5px;
									-moz-border-radius-topright: 5px;
									border-top-left-radius: 5px;
									border-top-right-radius: 5px; background:#ccc; color:#fff;">';
        $msg.= '<h3 style="padding:10px; margin:0px; color:#ac6f00;"><img src="'.base_url().'style/img/logofront.png" height="35px" style="vertical-align:middle;margin-right:15px;">The Credit University</h3></div>';
        $msg.= '<div class="content" style="padding:10px; font-size:14px;">';
        $msg.= '<p style="font-size:13px;">Hello <strong>'.$to_fullname.'</strong> please add '.$no_clients.' authorized user.</p>';
        $msg.= '<p style="font-size:13px;">Url: <a href="'.base_url().'admin">'.base_url().'admin</a></p><br>';
        $msg.= '<p style="font-size:13px;">Thank You</p></div>';
        $msg.= '<div class="footer" style="-webkit-border-bottom-right-radius: 5px;
									-webkit-border-bottom-left-radius: 5px;
									-moz-border-radius-bottomright: 5px;
									-moz-border-radius-bottomleft: 5px;
									border-bottom-right-radius: 5px;
									border-bottom-left-radius: 5px;background:#ccc; color:#ac6f00; margin:0px; padding:1px 10px;">';
        $msg.= '<p>Yours Sincerely,<br>The Credit University Team</p></div></div>';
        $message = $msg;
        $m->setMessageFromString('', $message);
        //$this -> session -> set_flashdata("su_message", "Client Added Successfully");
        $ses->sendEmail($m);


    }

    function newsLetterEmail($sub , $temp ,$emails){
        $subject = $sub;
        $msg = '<!doctype html>
					<html>
					<head>
					<meta charset="utf-8">
					<title>The Credit University | Newsletter</title>

					</head>

					<body>';
        $msg.= $temp;
        $msg.='</body>
					</html>';

        $this->load->library('SimpleEmailService');
        $ses = new SimpleEmailService('AKIAISEC5PBG2F54VL4A', 'ZhRYSpKdUMLRrxPwy878UN+pJmnllAocdcYRpJwZ');

        $ses->enableVerifyPeer(false);
        //print_r($ses->verifyEmailAddress('savrniroj@gmail.com'));
        $m = new SimpleEmailServiceMessage();
        $m->addTo($emails);
        $m->setFrom('CPN America' . '<'.EMAILSENDER.'>');
        $m->setSubject($subject);
        $message = $msg;
        $m->setMessageFromString('', $message);
        if ($ses->sendEmail($m)) {
            $this -> session -> set_flashdata("su_message", "Email Sent Successfully.");
        }else{
            $this -> session -> set_flashdata("su_message", "Error while sending email.");
        }
    }


    function requestMail($email , $rcode){
        $subject = "Signup link for registering in americancpn";
        $msg = $this->input->post('message');
        $this->load->library('SimpleEmailService');
        $ses = new SimpleEmailService('AKIAISEC5PBG2F54VL4A', 'ZhRYSpKdUMLRrxPwy878UN+pJmnllAocdcYRpJwZ');

        $ses->enableVerifyPeer(false);
        //print_r($ses->verifyEmailAddress('savrniroj@gmail.com'));
        $m = new SimpleEmailServiceMessage();
        $m->addTo($email);
        $m->setFrom('Request for signup'.'<'.EMAILSENDER.'>');
        $m->setSubject($subject);
        $msg = " ";
        if($this->session->userdata(ADMIN_AUTH_TYPE)=='affiliate' || $this->session->userdata(ADMIN_AUTH_TYPE)=='referrer'){
            $msg.= "Here is the link for Client Registration: <a href='".base_url()."referrer/".$this->session->userdata(ADMIN_AUTH_NAMEUSER)."/".$rcode."'>Sign Up</a>";
            $msg.= '<!doctype html>
									<html>
									<head>
									<meta charset="utf-8">
									<title>CPN Email Template</title>

									</head>

									<body>
									<div class="box" style="padding:0px;width:500px; margin:0 auto;-webkit-border-radius: 5px;
									-moz-border-radius: 5px;
									border-radius: 5px; border:1px solid #ccc; ">
									<div class="title" style="-webkit-border-top-left-radius: 5px;
									-webkit-border-top-right-radius: 5px;
									-moz-border-radius-topleft: 5px;
									-moz-border-radius-topright: 5px;
									border-top-left-radius: 5px;
									border-top-right-radius: 5px; background:#027dab; color:#fff;">';

            $msg.= '<h3 style="padding:10px; margin:0px; color:#fff;"><img src="'.base_url().'frontend/images/logo.png" height="35px" style="vertical-align:middle;margin-right:15px;">The Credit University</h3>';
            $msg.='</div>
								<div><img src="'.base_url().'frontend/images/american-cpn.gif"/></div>
								<div class="footer" style="-webkit-border-bottom-right-radius: 5px;
								-webkit-border-bottom-left-radius: 5px;
								-moz-border-radius-bottomright: 5px;
								-moz-border-radius-bottomleft: 5px;
								border-bottom-right-radius: 5px;
								border-bottom-left-radius: 5px;background:#027dab; color:#fff; margin:0px; padding:1px 10px; margin-top:600px;">
								<p>Yours Sincerely,<br>
								The Credit University Team</p>

								</div>
								</div>
								</body>
								</html>';



        }elseif($this->session->userdata(ADMIN_AUTH_TYPE)!='affiliate' || $this->session->userdata(ADMIN_AUTH_TYPE)!='referrer' || $this->session->userdata(ADMIN_AUTH_TYPE)!='client'){
            // header part of email template
            $msg .= '<html>
									<head>
									<meta charset="utf-8">
									<title>Email Template</title>

									</head>

									<body>
									<div class="box" style="padding:0px;width:40%; margin:0 auto;-webkit-border-radius: 5px;
									-moz-border-radius: 5px;
									border-radius: 5px; border:1px solid #ccc;">
									<div class="title" style="-webkit-border-top-left-radius: 5px;
									-webkit-border-top-right-radius: 5px;
									-moz-border-radius-topleft: 5px;
									-moz-border-radius-topright: 5px;
									border-top-left-radius: 5px;
									border-top-right-radius: 5px; background:#ccc; color:#fff;">
									<h3 style="padding:10px; margin:0px; color:#ac6f00;"><img src="'.base_url().'frontend/images/logo.png" height="35px" style="vertical-align:middle;margin-right:15px;">The Credit University</h3>
									</div>
									<div class="content" style="padding:10px; font-size:14px;">';

            // body part of email template
            $msg.= '<p style="font-size:13px;">Here is the link for referrer Registration: <a href="'.base_url().'register/referrer/'.$rcode.'">Sign Up</a></p>';

            // footer part of email template
            $msg .='</div>
								<div class="footer" style="-webkit-border-bottom-right-radius: 5px;
								-webkit-border-bottom-left-radius: 5px;
								-moz-border-radius-bottomright: 5px;
								-moz-border-radius-bottomleft: 5px;
								border-bottom-right-radius: 5px;
								border-bottom-left-radius: 5px;background:#ccc; color:#ac6f00; margin:0px; padding:1px 10px;">
								<p>Yours Sincerely,<br>
								The Credit University Team</p>
								</div>
								</div>
								</body>
								</html>';
        }
        $message = $msg;
        $m->setMessageFromString('', $message);
        if($ses->sendEmail($m) && $this -> RequestModel -> insert($email,$rcode)){
            //if($this -> RequestModel -> insert($value)){
            $flag = TRUE;
        }else{
            $flag = FALSE;
        }
    }

    function addCARDREQUEST($rcode){
        $subject = "Request for card details information";
        $this -> load -> library('SimpleEmailService');
        $ses = new SimpleEmailService('AKIAISEC5PBG2F54VL4A', 'ZhRYSpKdUMLRrxPwy878UN+pJmnllAocdcYRpJwZ');
        $msg = '';
        $ses -> enableVerifyPeer(false);
        //print_r($ses->verifyEmailAddress('savrniroj@gmail.com'));
        $m = new SimpleEmailServiceMessage();
        $m -> addTo($this -> input -> post('email'));
        $m -> setFrom($this -> session -> userdata(ADMIN_AUTH_USERNAME) . '<' . EMAILSENDER . '>');
        $m -> setSubject($subject);

        // header part of email template
        $msg .= '<html>
    										<head>
    										<meta charset="utf-8">
    										<title>Email Template</title>

    										</head>

    										<body>
    										<div class="box" style="padding:0px;width:40%; margin:0 auto;-webkit-border-radius: 5px;
    										-moz-border-radius: 5px;
    										border-radius: 5px; border:1px solid #ccc;">
    										<div class="title" style="-webkit-border-top-left-radius: 5px;
    										-webkit-border-top-right-radius: 5px;
    										-moz-border-radius-topleft: 5px;
    										-moz-border-radius-topright: 5px;
    										border-top-left-radius: 5px;
    										border-top-right-radius: 5px; background:#ccc; color:#fff;">
    										<h3 style="padding:10px; margin:0px; color:#ac6f00;"><img src="' . base_url() . 'frontend/images/logo.png" height="35px" style="vertical-align:middle;margin-right:15px;">The Credit University</h3>
    										</div>
    										<div class="content" style="padding:10px; font-size:14px;"><p style="font-size:13px;">';

        $msg .= "<h3 style='text-align:center;'>Request for Card Details Information:</h3>";
        $msg .= "Hello " . $this -> input -> post('name') . ",<br/>";
        $msg .= "<p>Please follow the link below to fill your card details:</p>";
        $msg .= "<a href='" . base_url() . "owner/carddetails/" . $rcode . "' style='text-decoration:none; color:red;'>Click here</a>";
        $msg .= "<br/><br/>";
        $msg .= 'Yours Sincerely,<br/>';
        $msg .= 'Americancpn referrer<br/>';
        $msg .= $this -> session -> userdata(ADMIN_AUTH_USERNAME);

        // footer part of email template
        $msg .= '</p></div>
    									<div class="footer" style="-webkit-border-bottom-right-radius: 5px;
    									-webkit-border-bottom-left-radius: 5px;
    									-moz-border-radius-bottomright: 5px;
    									-moz-border-radius-bottomleft: 5px;
    									border-bottom-right-radius: 5px;
    									border-bottom-left-radius: 5px;background:#ccc; color:#ac6f00; margin:0px; padding:1px 10px;">

    									</div>
    									</div>
    									</body>
    									</html>';

        $message = $msg;
        $m -> setMessageFromString('', $message);
        if ($ses -> sendEmail($m)) {
            //if($this -> RequestModel -> insert($value)){
            $this -> session -> set_flashdata("su_message", "Line Owner Added Successfully.");
            redirect(ADMIN_PATH . "lineowner");
        } else {
            $this -> session -> set_flashdata("su_message", "Line Owner Added Successfully.");
            redirect(ADMIN_PATH . "lineowner");
        }
    }

    function emailCenter($receiverEmail,$senderEmail,$subject, $message){
        $this -> load -> library('SimpleEmailService');
        $ses = new SimpleEmailService('AKIAISEC5PBG2F54VL4A', 'ZhRYSpKdUMLRrxPwy878UN+pJmnllAocdcYRpJwZ');
        $ses->enableVerifyPeer(false);
        $m = new SimpleEmailServiceMessage();
        $m->addTo($receiverEmail);
        $m->setFrom($senderEmail.'<'.EMAILSENDER.'>');
        $m->setSubject($subject);
        $m->setMessageFromString('', $message);
        if($ses->sendEmail($m))
            return true;
    }
    
       function sendWelcomeRegistrationMail($register,$broker_id="" , $token = '' , $userId= '')
    {
        $this->load->model('UserModel');
         $this->load->model('NewsLetterModel');
         $this->load->model('RoleModel');
        $this->load->library('parser');

       
        if($register==""){
            return false;
        }

        $user_details = $this->UserModel->getUserByEmail($register);
        $role_details = $this->RoleModel->getRoleWithEmail($register);
        $register_role = $role_details->label;
        $register_name = $user_details->first_name . ' ' . $user_details->middle_initial . ' ' . $user_details->last_name;
        
        $subject = 'Welcome to The Credit University';

        if($broker_id){
        $user = $this->UserModel->getUserByUserId($broker_id);
        $broker = $user->first_name . ' ' . $user->middle_initial . ' ' . $user->last_name;
        }

        $this->load->library('SimpleEmailService');

        $ses = new SimpleEmailService('AKIAISEC5PBG2F54VL4A', 'ZhRYSpKdUMLRrxPwy878UN+pJmnllAocdcYRpJwZ');
        $ses->enableVerifyPeer(false);
        $simpleEmailServiceMessage = new SimpleEmailServiceMessage();
        $sent="";
        if (!empty($user->email)) {
            $simpleEmailServiceMessage->addTo($user->email);
            $simpleEmailServiceMessage->setFrom('The Credit University' . '<' . EMAILSENDER . '>');
            $simpleEmailServiceMessage->setSubject($subject);
            $today = date('Y-m-d');
            $data1 = array(
                'subject' => 'Registered to The Credit University',
                'date' => $today,
                'registered' => $register,
                'register_name' => $register_name,
                'role' => $register_role,
                'under_registered' => $broker,


            );

           $code = $this->NewsLetterModel->getWelcomeLetterByShortCode(BROKER_WELCOME_TEMPLATE);
       
          if($code!=""){
               $code =  $this->parseTemplate($code,$data1); 
            $simpleEmailServiceMessage->setMessageFromString('', $code); 
            $sent = $ses->sendEmail($simpleEmailServiceMessage);

            }

        }

        $simpleEmailServiceMessage->addTo($register);
        $simpleEmailServiceMessage->setFrom('The Credit University' . '<' . EMAILSENDER . '>');
        $simpleEmailServiceMessage->setSubject($subject);
        $today = date('Y-m-d');
        $data = array(
            'subject' => 'Registered to The Credit University',
            'register_name' => $register_name,
            'date' => $today,
            'registered' => $register,
            'role' => $register_role,
            'under_registered' => $broker,
             'token' => $token,
                'user_id' =>$userId ,

        );
       
       $code_register = $this->NewsLetterModel->getWelcomeLetterByShortCode(WELCOME_TEMPLATE);
       if( $code_register!=""){
        $code_register =  $this->parseTemplate($code_register,$data);
      
        $simpleEmailServiceMessage->setMessageFromString('', $code_register);
        $sent = $ses->sendEmail($simpleEmailServiceMessage);

       }
        return $sent;
        

    }

    function parseTemplate($code="",$data=""){
      
        if($code){
            if($data){
            foreach( $data as $key=>$val){
                $find = '{'.$key.'}';
                $code = str_replace( $find, $val, $code);
             }
            }

            return   $code;
        }

    }


}

?>
