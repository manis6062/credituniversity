<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class ReferrerIpnlistener extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this -> load -> library('pagination');
		$this -> form_validation -> set_error_delimiters('<div class="error">* ', '</div>');
		// if ( $this->input->post( 'remember' ) ) // set sess_expire_on_close to 0 or FALSE when remember me is checked.
		// $this->config->set_item('sess_expire_on_close', '0'); // do change session config
		//
		// $this->load->library('session');
	}

	public function index() {

		$data['main_content'] = 'welcome';
		$this -> load -> view('includes/template', $data);

	}

	public function paymentProcess() {

		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			$id = $_POST['custom'];
			list($aid, $cid) = explode('-', $id);
			
			$affinfo= $this->ClientModel->getAffiliatePaymentInfo($aid);

			// Check Number 1 ------------------------------------------------------------------------------------------------------------
			$receiver_email = $_POST['receiver_email'];
			if ($receiver_email == $affinfo->affiliate_paypal_account) {
				$payment_amount = $_POST['mc_gross'];
				if ($payment_amount == $affinfo->affiliate_client_reg_charge) {

					// Check number 2 ------------------------------------------------------------------------------------------------------------
					if ($_POST['payment_status'] == "Completed") {
						// Handle how you think you should if a payment is not complete yet, a few scenarios can cause a transaction to be incomplete

						// incs('config/dbcon.php');
						// assign posted variables to local variables
						$pstatus = $_POST['payment_status'];
						$pamount = $_POST['mc_gross'];
						$txn_id = $_POST['txn_id'];
						$payer_email = $_POST['payer_email'];
						$id = $_POST['custom'];
						list($aid, $cid) = explode('-', $id);
						$paytitle = $_POST['item_name1'];

						$updatepayment = $this -> ClientModel -> paypalPaymentInsert($aid,$cid,$paytitle, $pamount, $payer_email, $txn_id, $pstatus);

						// if ($updatepayment!='') {

							$subject = 'Client Registration Payment';
							
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
							
							$msg .= 'Payment Successfully completed. Please login <a href="' . base_url() . 'admin"> Click Here</a>';
							
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
							
							
							$this -> load -> library('SimpleEmailService');
							$ses = new SimpleEmailService('AKIAISEC5PBG2F54VL4A', 'ZhRYSpKdUMLRrxPwy878UN+pJmnllAocdcYRpJwZ');

							$ses -> enableVerifyPeer(false);
							//print_r($ses->verifyEmailAddress('savrniroj@gmail.com'));
							$m = new SimpleEmailServiceMessage();
							$m -> addTo('contact <'.$updatepayment->email.'>');
							$m -> setFrom('The Credit University' . '<'.EMAILSENDER.'>');
							$m -> setSubject($subject);
							$message = $msg;
							$m -> setMessageFromString('', $message);
							$ses -> sendEmail($m);

						// }

					}//payment_status check
				}
			}

		} else {

			$subject = 'Fail CPN referrer Partner Registration Payment';
			
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
			
			$msg .= 'Payment Failed.';
			
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
			
			$this -> load -> library('SimpleEmailService');
			$ses = new SimpleEmailService('AKIAISEC5PBG2F54VL4A', 'ZhRYSpKdUMLRrxPwy878UN+pJmnllAocdcYRpJwZ');

			$ses -> enableVerifyPeer(false);
			//print_r($ses->verifyEmailAddress('savrniroj@gmail.com'));
			$m = new SimpleEmailServiceMessage();
			$m -> addTo('contact <rajesh.mjn@hotmail.com>');
			$m -> setFrom('The Credit University' . '<'.EMAILSENDER.'>');
			$m -> setSubject($subject);
			$message = $msg;
			$m -> setMessageFromString('', $message);
			$ses -> sendEmail($m);
		}
	}

}
