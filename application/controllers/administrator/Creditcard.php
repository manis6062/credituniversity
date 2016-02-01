<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Creditcard extends CI_Controller
{

    private $allowed = array();
    private $errors = "";

    public function __construct()
    {
        parent::__construct();

        // Your own constructor code
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->form_validation->set_error_delimiters('<div class="red">', '</div>');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('path');
        $this->load->helper('general');
        $this->load->helper('security');
        checkAdminAuth();
        $this->load->model('AuthModel');
        $this->load->model('CreditCardModel');
        $this->load->model('LineModel');
        //$this->load->model('user_auth_model');
        $this->allowed = $this->AuthModel->getAuth();
    }

    public function index()
    {
        $this->show($page = '');
    }

    function show($page = '')
    {
        $data['flag'] = '';
        $data['schemeList'] = $this->LineModel->getAll();
        $data['allowed'] = $this->allowed;
        $data['error'] = $this->errors;
        $data['usertype'] = checkUserType();
        $data['title'] = "List Line Schemes";
        $data['main_content'] = ADMIN_PATH . "lineschemes_view";
        $this->load->view(ADMIN_PATH . 'incs/template', $data);
    }

    function creditCardClients($to_id, $card_id, $to_name)
    {
        $this->load->model('referrerModel');
        $this->load->model('CreditcardModel');
        $ref_id = $this->referrerModel->getreferrerIdFromUserId($this->session->userdata(USER_ID));
        $data['card_id'] = $card_id;
        $data['ref_id'] = $ref_id;
        $data['referrerClients'] = $this->CreditcardModel->getNotAddedClient($card_id, $ref_id);
        $data['clientList'] = $this->CreditcardModel->getAllClientsByCard($card_id);
        $data['sumOfReceivableAmount'] = $this->CreditcardModel->sumOfAmountWithCardIDReceivableInProcess($ref_id, $card_id);
        $data['sumOfCollectableAmount'] = $this->CreditcardModel->sumOfAmountWithCardIDCollectableInProcess($ref_id, $card_id);
        $data['sumOfCharge'] = $this->CreditcardModel->sumOfAmount($ref_id, $card_id);
        $data['allowed'] = $this->allowed;
        $data['error'] = $this->errors;
        $data['usertype'] = checkUserType();
        $data['to_id'] = $to_id;
        $data['getdetailsofcard'] = $this->CreditcardModel->getSingleCard($card_id);
        $data['to_name'] = $to_name;
        $getdetailsofcard = $data['getdetailsofcard'];
        $card_name = $getdetailsofcard->card_name;
        $data['title'] = "List of Clients in " . $card_name . " of " . $to_name;
        $data['title1'] = "Add Clients in " . $card_name . " of " . $to_name;
        $data['main_content'] = ADMIN_PATH . "creditcard_clients_view";
        $this->load->view(ADMIN_PATH . 'incs/template', $data);
    }

    function linecardschemes($owner_id, $card_detail_id, $owner_name)
    {
        $data['availableamountforscheme'] = $this->LineModel->getavailableschemebalance($card_detail_id);
        $data['flag'] = 'scheme';
        $data['getdetailsofcard'] = $this->LineModel->getcarddetails($card_detail_id);
        $data['schemeList'] = $this->LineModel->getAllByScheme($card_detail_id);
        $data['allowed'] = $this->allowed;
        $data['error'] = $this->errors;
        $data['usertype'] = checkUserType();
        $data['owner_id'] = $owner_id;
        $data['card_detail_id'] = $card_detail_id;
        $data['owner_name'] = $owner_name;
        $data['title'] = "List Line Schemes";
        $data['title1'] = "Generate Card Schemes";
        $data['main_content'] = ADMIN_PATH . "lineschemes_view";
        $this->load->view(ADMIN_PATH . 'incs/template', $data);
    }

    function addClientsToCreditCard()
    {

        $this->form_validation->set_rules('no_month', 'No. Of Month', 'required');
        $this->form_validation->set_rules('charge', 'Charge', 'required');
        $flag = FALSE;
        $card_id = $this->input->post('card_id');
        $to_id = $this->input->post('to_id');
        $ref_id = $this->input->post('ref_id');
        $to_name = $this->input->post('to_name');
        $clientid = $this->input->post('client_id');
        $charge = $this->input->post('charge');
        $no_month = $this->input->post('no_month');

        if ($this->form_validation->run() == FALSE) {
            //$this->session->set_flashdata("su_message", "Select at least one credit card and one client or charge is missing.");
            $this->creditCardClients($to_id, $card_id, $to_name);
        } else {


            if ($this->CreditcardModel->insertClientsIntoCardSell($clientid, $charge, $no_month, $card_id, $to_id, $ref_id)) {
                $flag = TRUE;
            } else {
                $flag = FALSE;
            }

            if ($flag) {
                $todetail = $this->LineOwnerModel->getLineOwnerDetail($to_id);
                $to_email = $todetail->to_email;
                $to_fullname = $todetail->to_fname . '' . $todetail->to_fname . '' . $todetail->to_lname;
                $this->EmailerModel->addClientToCardFromreferrer($to_email, $to_fullname);
//			$subject = "Add Authorized User to the Card";
//			            	$this->load->library('SimpleEmailService');
//			                $ses = new SimpleEmailService('AKIAISEC5PBG2F54VL4A', 'ZhRYSpKdUMLRrxPwy878UN+pJmnllAocdcYRpJwZ');
//
//			                $ses->enableVerifyPeer(false);
//			                //print_r($ses->verifyEmailAddress('savrniroj@gmail.com'));
//			                $m = new SimpleEmailServiceMessage();
//			                $m->addTo($todetail->to_email);
//
//			                $m->setFrom('<'.EMAILSENDER.'>');
//			                $m->setSubject($subject);
//							$msg = '<div class="box" style="padding:0px;width:40%; margin:0 auto;-webkit-border-radius: 5px;
//									-moz-border-radius: 5px;
//									border-radius: 5px; border:1px solid #ccc;">
//									<div class="title" style="-webkit-border-top-left-radius: 5px;
//									-webkit-border-top-right-radius: 5px;
//									-moz-border-radius-topleft: 5px;
//									-moz-border-radius-topright: 5px;
//									border-top-left-radius: 5px;
//									border-top-right-radius: 5px; background:#ccc; color:#fff;">';
//							$msg.= '<h3 style="padding:10px; margin:0px; color:#ac6f00;"><img src="'.base_url().'style/img/logofront.png" height="35px" style="vertical-align:middle;margin-right:15px;">America Cpn</h3></div>';
//							$msg.= '<div class="content" style="padding:10px; font-size:14px;">';
//							$msg.= '<p style="font-size:13px;">Hello <strong>'.$todetail->to_fname.' '.$todetail->to_lname.'</strong> please add this client as authorized user.</p>';
//							$msg.= '<p style="font-size:13px;">Thank You</p>';
//							$msg.= '<div class="footer" style="-webkit-border-bottom-right-radius: 5px;
//									-webkit-border-bottom-left-radius: 5px;
//									-moz-border-radius-bottomright: 5px;
//									-moz-border-radius-bottomleft: 5px;
//									border-bottom-right-radius: 5px;
//									border-bottom-left-radius: 5px;background:#ccc; color:#ac6f00; margin:0px; padding:1px 10px;">';
//							$msg.= '<p>Yours Sincerely,<br>The Credit University Team</p></div></div>';
//							$message = $msg;
//			                $m->setMessageFromString('', $message);
//	                		//$this -> session -> set_flashdata("su_message", "Client Added Successfully");
//			                $ses->sendEmail($m);

                $this->session->set_flashdata('su_message', 'Email send Successful.');
                redirect('administrator/creditcard/creditCardClients/' . $to_id . '/' . $card_id . '/' . $to_name);
            } else {
                $this->session->set_flashdata('su_message', 'Scheme Generated Unsuccessful.');
                redirect('administrator/line');
            }

        }
    }


    function addClientToCard($cardid = '')
    {
        $this->load->model('AffiliateModel');
        $this->load->model('CreditcardModel');
        $this->load->model('LineOwnerModel');
        $this->load->model('ClientModel');

        $brokerid = $this->AffiliateModel->getaffiliateid($this->session->userdata(USER_ID));
        if (!empty($cardid)) {
            $cardinfo = $this->CreditcardModel->getSingleCard($cardid);
            $toinfo = $this->LineOwnerModel->getLineOwnerDetail($cardinfo->to_id);
            $ref_id = $toinfo->referrer_id;
            $data['ref_id'] = $ref_id;
            $data['referrerClients'] = $this->CreditcardModel->getNotAddedClient($cardid, $brokerid);
            $data['addedclientname'] = $this->CreditcardModel->getAlreadyAddedClient($cardid, $brokerid);
            $data['cardid'] = $cardid;
            $data['cardinfo'] = $this->CreditcardModel->getLinesOfAllClients();
        } else {
            $data['referrerClients'] = $this->ClientModel->getClientListUnderreferrer($brokerid);
            $data['cardinfo'] = $this->CreditcardModel->getLinesOfAllClients();
        }
        $data['linecard'] = $this->CreditcardModel->getAllCardOfAllLineOwner($brokerid);
        $data['allowed'] = $this->allowed;
        $data['error'] = $this->errors;
        $data['usertype'] = checkUserType();

        //$data['ref_id'] = $toinfo->referrer_id;
        $data['broker_id'] = $brokerid;
        $data['title'] = "List of Clients in Credit Card";
        $data['title1'] = "Add Clients in the Credit Card";

        $data['main_content'] = ADMIN_PATH . "creditcard_client_add_view";
        $this->load->view(ADMIN_PATH . 'incs/template', $data);

    }

    public function returned($cardid = '')
    {
        $ref_id = $this->AffiliateModel->getaffiliateid($this->session->userdata(USER_ID));
        if (!empty($cardid)) {
            $data['referrerClients'] = $this->CreditcardModel->getNotAddedReturnedClient($cardid, $ref_id);
            $data['addedclientname'] = $this->CreditcardModel->getAlreadyAddedReturnedClient($cardid, $ref_id);
            $data['cardid'] = $cardid;
            $data['cardinforeturn'] = $this->CreditcardModel->getReturnedLinesOfAllClients();
        } else {
            $data['referrerClients'] = $this->ClientModel->getReturnedClientListUnderreferrer($ref_id);
            $data['cardinforeturn'] = $this->CreditcardModel->getReturnedLinesOfAllClients();
        }

        $data['linecard'] = $this->CreditcardModel->getAllCardOfAllLineOwner($ref_id);
        $data['allowed'] = $this->allowed;
        $data['error'] = $this->errors;
        $data['usertype'] = checkUserType();

        $data['ref_id'] = $ref_id;
        $data['title'] = "List of Clients in Credit Card";
        $data['title1'] = "Add Clients in the Credit Card";

        $data['main_content'] = ADMIN_PATH . "returned_client_add_view";
        $this->load->view(ADMIN_PATH . 'incs/template', $data);
    }


    function verifyAction($to_id, $card_id, $to_name, $card_sell_id)
    {


        $this->CreditcardModel->changeVerifyStatus($card_sell_id);

        $this->session->set_flashdata("su_message", "Verification Message Send To Lineowner Successfully.");

        redirect('administrator/creditcard/creditCardClients/' . $to_id . '/' . $card_id . '/' . $to_name);
    }


    function addCheckedClientToCard()
    {
        $this->load->model('CreditcardModel');
        $this->load->model('LineOwnerModel');
        $this->load->model('ClientModel');
        $this->load->model('EmailerModel');

        $this->form_validation->set_rules('cardid[]', 'At Least One Credit Card Checked', 'required');
        $this->form_validation->set_rules('clientid[]', 'At Least One Client Checked', 'required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $this->addClientToCard();
        } else {
            foreach ($_POST['cardid'] as $key => $cardid) {
                if ($_POST['cardid'][$key]) {
                    $index = array_keys($_POST['cardid']);
                    $key1 = $index[0];
                    $card_id = $_POST['cardid'][$key1];
                    $to_id = $_POST['to_id'][$key1];
                    $ref_id = $_POST['ref_id'][$key1];
                    $charge = $_POST['card_sell_cost'][$key1];
                    $brokerid = $_POST['broker_id'];

                    $no_clients = count($_POST['clientid']);
                    foreach ($_POST['clientid'] as $clientid) {

                        $insertData = $this->CreditcardModel->insertClientsIntoCardSell($clientid, $charge, '2', $card_id, $to_id, $ref_id, $brokerid);

                    }
                    if ($insertData) {
                        $todetail = $this->LineOwnerModel->getLineOwnerDetail($to_id);

                        $card = $this->CreditcardModel->getSingleCard($card_id);
                        $referrer_id = $todetail->referrer_id;

                        $clientDetails = $this->ClientModel->getSingleClientFromreferrer($referrer_id);
                        $to_email = $todetail->to_email;
                        $to_fullname = $todetail->to_fname . '' . $todetail->to_mname . '' . $todetail->to_lname;
                        $card_name = $card->type_id;
                        $type_id = $card->card_name;
                        $this->EmailerModel->addCheckedClientToCardFromreferrer($to_email, $to_fullname, $no_clients, $card_name, $type_id);


                        $this->session->set_flashdata("su_message", "Client Added Successfully");
                    }
                }
            }
            $this->session->set_flashdata("su_message", "Request Sent Successfully");
            redirect(ADMIN_PATH . "creditcard/addClientToCard");
            //redirect to inbox
        }

    }


    function addCheckedClientToCardReturned()
    {


        $this->form_validation->set_rules('cardid[]', 'At Least One Credit Card Checked', 'required');
        //$cards = $this->input->post('cardid');

        // foreach($cards as $key => $card){
        // $charge = $_POST['charge'][$key];
        // if(empty($charge))
        // $this->session->set_flashdata("su_message", "Select at least one credit card and one client or charge is missing.");
        // return FALSE;
        // $this->addClientToCard();
        // //$this->form_validation->set_rules($charge, 'Missing Charge', 'required|xss_clean');
        // }
// 	

        $this->form_validation->set_rules('clientid[]', 'At Least One Client Checked', 'required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            //$this->session->set_flashdata("su_message", "Select at least one credit card and one client or charge is missing.");
            $this->returned();
        } else //success
        {
            // print_r($_POST['cardid'][$key]);
            // print_r($_POST['to_id']);die;

            foreach ($_POST['cardid'] as $key => $cardid) {


                if ($_POST['cardid'][$key]) {
                    $card_id = $_POST['cardid'][$key];
                    $to_id = $_POST['to_id'][$key];
                    $ref_id = $_POST['ref_id'][$key];
                    $charge = $_POST['card_sell_cost'][$key];


                    $no_clients = count($_POST['clientid']);
                    foreach ($_POST['clientid'] as $clientid) {

                        $insertData = $this->CreditcardModel->insertClientsIntoCardSell($clientid, $charge, '2', $card_id, $to_id, $ref_id);

                    }
                    if ($insertData) {
                        $todetail = $this->LineOwnerModel->getLineOwnerDetail($to_id);

                        // $getrefemail = $this->AffiliateModel->getLineOwnerDetail($ref_id);
                        // $email = $getrefemail->affiliate_email;


                        //send email to line owner
                        $to_email = $todetail->to_email;
                        $to_fullname = $todetail->$todetail->to_fname . ' ' . $todetail->to_lname;
                        $this->EmailerModel->SendEmailaddCheckedClientToCardReturned($to_email, $to_fullname, $no_clients);


//						$subject = "Add Authorized User to Credit Card";
//			            	$this->load->library('SimpleEmailService');
//			                $ses = new SimpleEmailService('AKIAISEC5PBG2F54VL4A', 'ZhRYSpKdUMLRrxPwy878UN+pJmnllAocdcYRpJwZ');
//
//			                $ses->enableVerifyPeer(false);
//			                //print_r($ses->verifyEmailAddress('savrniroj@gmail.com'));
//			                $m = new SimpleEmailServiceMessage();
//			                $m->addTo($todetail->to_email);
//			                $m->setFrom('<'.EMAILSENDER.'>');
//			                $m->setSubject($subject);
//							$msg = '<div class="box" style="padding:0px;width:40%; margin:0 auto;-webkit-border-radius: 5px;
//									-moz-border-radius: 5px;
//									border-radius: 5px; border:1px solid #ccc;">
//									<div class="title" style="-webkit-border-top-left-radius: 5px;
//									-webkit-border-top-right-radius: 5px;
//									-moz-border-radius-topleft: 5px;
//									-moz-border-radius-topright: 5px;
//									border-top-left-radius: 5px;
//									border-top-right-radius: 5px; background:#ccc; color:#fff;">';
//							$msg.= '<h3 style="padding:10px; margin:0px; color:#ac6f00;"><img src="'.base_url().'style/img/logofront.png" height="35px" style="vertical-align:middle;margin-right:15px;">The Credit University</h3></div>';
//							$msg.= '<div class="content" style="padding:10px; font-size:14px;">';
//							$msg.= '<p style="font-size:13px;">Hello <strong>'.$todetail->to_fname.' '.$todetail->to_lname.'</strong> please add '.$no_clients.' authorized user.</p>';
//							$msg.= '<p style="font-size:13px;">Url: <a href="'.base_url().'admin">'.base_url().'admin</a></p><br>';
//							$msg.= '<p style="font-size:13px;">Thank You</p></div>';
//							$msg.= '<div class="footer" style="-webkit-border-bottom-right-radius: 5px;
//									-webkit-border-bottom-left-radius: 5px;
//									-moz-border-radius-bottomright: 5px;
//									-moz-border-radius-bottomleft: 5px;
//									border-bottom-right-radius: 5px;
//									border-bottom-left-radius: 5px;background:#ccc; color:#ac6f00; margin:0px; padding:1px 10px;">';
//							$msg.= '<p>Yours Sincerely,<br>The Credit University Team</p></div></div>';
//							$message = $msg;
//			                $m->setMessageFromString('', $message);
//	                		//$this -> session -> set_flashdata("su_message", "Client Added Successfully");
//			                $ses->sendEmail($m);

                    }
                }
            }
            $this->session->set_flashdata("su_message", "Request Sent Successfully");
            redirect(ADMIN_PATH . "creditcard/returned");
            //redirect to inbox
        }

    }

    function post()
    {
        $id = $_REQUEST['pk'];
        $value = $_REQUEST['value'];
        $name = $_REQUEST['name'];
        $this->CreditcardModel->updateInline($name, $value, $id);
    }


    function post1()
    {
        $id = $_REQUEST['pk'];
        $value = $_REQUEST['value'];
        $name = $_REQUEST['name'];
        $this->CreditcardModel->updateInlineCard($name, $value, $id);
    }


    function alreadyAddedClient()
    {
        $ref_id = $this->AffiliateModel->getaffiliateid($this->session->userdata(USER_ID));
        $cardid = $_REQUEST['cardid'];
        $addedclientname = $this->CreditcardModel->getAlreadyAddedClient($cardid, $ref_id);

        $html = '';

        if (!empty($addedclientname)) {
            $html .= '
                                    <div class="box-header well" data-original-title>
                                        <h2><i class="icon-user"></i> Client Already in the Credit Card</h2>

                                    </div>';
            foreach ($addedclientname as $val) {

                $html .= '<div>';
                $html .= $val->firstname . ' ' . $val->lastname;
                $html .= '</div>';
            }
            $html .= '';
        } else {
            echo '<div class="clear"></div>No clients added in this card';
        }
        echo $html;
    }


    function notAddedClient()
    {
        $ref_id = $this->AffiliateModel->getaffiliateid($this->session->userdata(USER_ID));
        $cardid = $_REQUEST['cardid'];
        $notaddedclientname = $this->CreditcardModel->getNotAddedClient($cardid, $ref_id);

        $html = '';

        // $html .= form_error('clientid[]');


//                       $html .= '<table class="table table-striped table-bordered bootstrap-datatable datatable">
//                            <thead>
//                                <tr>
//                                    <th>#</th>
//                                    <th>Client Name <img src="'.base_url().'/style/img/sort.png"></th>
//                                    
//                                    <th>No. of Lines<img src="'.base_url().'/style/img/sort.png"></th>
//                                   
//                                </tr>
//                            </thead>';
//		
//		//if(!empty($addedclientname)){
//                    $html .=  '<tbody>';
        if ($notaddedclientname != '' && count($notaddedclientname) != 0) {

            foreach ($notaddedclientname as $key => $val) {

                $html .= '<tr class="';
                if ($key % 2 == 0) {
                    'even';
                } else {
                    'odd';
                }
                $html .= '">';
                $html .= '<td class="sorting_1"><input type="checkbox" name="clientid[]" value="' . $val->id . '"/> </td>';
                $html .= '<td>' . $val->firstname . ' ' . $val->lastname . '</td>';
                $html .= '<td>' . $val->noline . '</td>';

                $html .= '</tr>';
            }
        } else {
            echo 'empty clients';
        }


        //$html .=  '</tbody></table>';


//		}
//		else{
//			echo '<div class="clear"></div>No clients added in this card';
//		}
        echo $html;


//		if(!empty($notaddedclientname)){
//				$html .= '<h4>Clients Not added in Card</h4>';
//			foreach($notaddedclientname as $val){
//				
//				$html .= '<div>';
//				$html .= $val->firstname.' '.$val->lastname;
//				$html .= '</div>';
//			}
//		}
//		else{
//			echo '<div class="clear"></div>not found clients';
//		}
//		echo $html;
    }

    public function verifyClients($to_id, $card_id, $to_name)
    {
        $ref_id = $this->AffiliateModel->getaffiliateid($this->session->userdata(USER_ID));
        $data['referrerClients'] = $this->ClientModel->getClientListUnderreferrer($ref_id);
        $data['clientList'] = $this->CreditcardModel->getVerifiedClientsByCard($card_id);

        $data['allowed'] = $this->allowed;
        $data['error'] = $this->errors;
        $data['usertype'] = checkUserType();
        $data['to_id'] = $to_id;
        $data['card_id'] = $card_id;
        $data['getdetailsofcard'] = $this->CreditcardModel->getSingleCard($card_id);
        $data['to_name'] = $to_name;
        $data['ref_id'] = $ref_id;
        $data['title'] = "List of Clients in Credit Card" . '&nbsp' . $to_name;
        $data['title1'] = "Add Clients in the Credit Card" . '&nbsp' . $to_name;

        redirect(ADMIN_PATH . "creditcard/creditCardClients");

    }


}

?>