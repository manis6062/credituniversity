<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Line extends AdminController
{
    private $allowed = array();
    private $errors = "";

    public function __construct()
    {
        parent::__construct(CLIENT, OWNER, BROKER, ADMIN);
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('path');
        $this->load->helper('general');
        $this->load->library('cart');
        $this->load->model('AuthModel');
        $this->load->model('LineModel');
        $this->load->model('CardTypeModel');
        $this->load->model('CartModel');
        $this->load->model('ModuleModel');
        checkAdminAuth();
        $this->load->helper('security');
    }

    public function index()
    {
        $this->show($page = '');
    }

    function show()
    {
        $data['flag'] = '';
        $data['allowed'] = $this->allowed;
        $data['error'] = $this->errors;
        $data['usertype'] = checkUserType();
        $data['title'] = "List Line Schemes";
        $data['main_content'] = ADMIN_PATH . "lineschemes_view";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function autoComplete()
    {

        $keyword = $this->input->get('type');
        $data['response'] = 'false'; //Set default response
        $query = $this->CardTypeModel->autoSuggestType($keyword); //Model DB search

        if ($query->num_rows() > 0) {
            $data['response'] = 'true'; //Set response
            $data['message'] = array(); //Create array
            foreach ($query->result() as $row) {
                $data['message'][] = array('value' => $row->type); //Add a row to array
            }
        }
        echo json_encode($data);
    }

    function autoComplete_Bank()
    {

        $keyword_bank = $this->input->post('bank');
        $data['response'] = 'false'; //Set default response
        $query = $this->CardTypeModel->autoSuggestBank($keyword_bank); //Model DB search

        if ($query->num_rows() > 0) {
            $data['response'] = 'true'; //Set response
            $data['message'] = array(); //Create array
            foreach ($query->result() as $row) {
                $data['message'][] = array('value' => $row->bank); //Add a row to array
            }
        }
        echo json_encode($data);
    }


    function autoComplete_Card()
    {

        $keyword_card = $this->input->post('name');
        $data['response'] = 'false'; //Set default response
        $query = $this->CardTypeModel->autoSuggestCard($keyword_card); //Model DB search

        if ($query->num_rows() > 0) {
            $data['response'] = 'true'; //Set response
            $data['message'] = array(); //Create array
            foreach ($query->result() as $row) {
                $data['message'][] = array('value' => $row->name); //Add a row to array
            }
        }
        echo json_encode($data);
    }


    function lineForm()
    {
        $data['allowed'] = $this->allowed;
        $data['error'] = $this->errors;
        $data['title'] = "add line";
        $cardTypes = $this->CardTypeModel->getBanksAssociative();
        $data['banks'] = $cardTypes;
        $data['card_names'] = '';
        if ($cardTypes) {
            $data['website'] = $this->getWebsite(false, key($cardTypes));
        }
        $data['owners'] = $this->lineOwners(false);
        $usertype = checkUserType();
        $data['usertype'] = $usertype;
        $data['main_content'] = ADMIN_PATH . "lineForm";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    public function lineOwners($json = false)
    {
        $owners = array();
        switch ($this->roleName) {
            case BROKER:
            case  SUPER_BROKER:
            case SUPER_ADMIN:
                $owners = $this->UserModel->getLineOwners($this->userId);
                break;
            case OWNER:
                $owners = array($this->userId => $this->userName);
                break;
            default:
                break;
        }
        if ($json) {
            echo json_encode($owners);
        }
        return $owners;
    }

    function lineClientForm($selectedLine = '')
    {
        $this->allow(true, BROKER, ADMIN);
        $this->load->helper(array('form', 'url'));
        $data['lines'] = $this->LineModel->getAllLines(SELECT);
        $brokerId = $this->userId;
        if ($this->roleName == ADMIN)
            $brokerId = null;
        $data['clients'] = $this->UserModel->getClients($brokerId, SELECT);
        $data['selectedLine'] = $selectedLine;
        $data['main_content'] = ADMIN_PATH . "lineClientForm";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function market()
    {
        $this->allow(true, BROKER, CLIENT, ADMIN);
        $this->load->library('session');
        $this->load->library('cart');

        $cardTypes = $this->CardTypeModel->getBanksAssociative();
        $data['banks'] = $cardTypes;
        $data['lines'] = $this->LineModel->getAllPurchaseLines();
        $data['brokers'] = $this->UserModel->getBrokersEditable();
        $data['clients'] = $this->UserModel->getClients($this->userId, SELECT);
        $data['title'] = "Lines";
        $data['owners'] = $this->lineOwners(false);
        $data['items'] = $this->CartModel->getCart($this->userId);
        $data['userid'] = $this->userId;
        $data['member_module'] = $this->ModuleModel->getMemberModules('marketplace');
        $data['role'] = $this->roleName;
        $data['main_content'] = ADMIN_PATH . "lines";
        $cart[] = array();
        foreach ($this->cart->contents() as $content) {
            $cart[$content['id']][] = $content['options']['client'];
        }
        $data['cart'] = $cart;
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function to_lines()
    {
        $data['lines'] = $this->LineModel->getAllBrokerLines($this->userId);
        $data['clients'] = $this->UserModel->getClientsUnderBroker($this->userId);
        $data['title'] = "Lines";
        $data['owners'] = $this->lineOwners(false);
        $data['items'] = $this->CartModel->getCart($this->userId);
        $data['role'] = $this->roleName;
        $data['main_content'] = ADMIN_PATH . "to_lines";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function my_lines()
    {
        $data['lines'] = $this->LineModel->getSelfLines($this->userId);
        $data['title'] = "Lines";
        $data['owners'] = $this->lineOwners(false);
        if ($this->roleName == CLIENT) {
            $data['items'] = $this->CartModel->getCart($this->userId);
        }
        $data['role'] = $this->roleName;
        $data['main_content'] = ADMIN_PATH . "my_lines";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function all_lines()
    {
        $data['lines'] = $this->LineModel->getAllLines();
        $data['title'] = "Lines";
        $data['owners'] = $this->lineOwners(false);
        if ($this->roleName == CLIENT) {
            $data['items'] = $this->CartModel->getCart($this->userId);
        }
        $data['role'] = $this->roleName;
        $data['main_content'] = ADMIN_PATH . "all_lines";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function lines($ownerId)
    {
        $data['lines'] = $this->LineModel->getLines($ownerId);
        $data['title'] = "Lines";
        $data['owners'] = $this->lineOwners(false);
        if ($this->roleName == CLIENT) {
            $data['items'] = $this->CartModel->getCart($this->userId);
        }
        $data['role'] = $this->roleName;
        $data['main_content'] = ADMIN_PATH . "all_lines";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function line($lineId)
    {
        $data['role'] = $this->roleName;
        $data['lines'] = $this->LineModel->getLine($lineId);
        $data['title'] = "Lines";
        $data['owners'] = $this->lineOwners(false);
        if ($this->roleName == CLIENT) {
            $data['items'] = $this->CartModel->getCart($this->userId);
        }

        $data['main_content'] = ADMIN_PATH . "all_lines";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function fetchLines()
    {
        switch ($this->roleName) {
            case SUPER_ADMIN:
                return $this->LineModel->getAllLines();
            case BROKER:
                return $this->LineModel->getAllBrokerLines($this->userId);
            case CLIENT:
                return $this->LineModel->getAllPurchaseLines();
            case OWNER:
                return $this->LineModel->getSelfLines($this->userId);
        }
    }

    function cart()
    {
        $data['userId'] = $this->session->userdata(USER_ID);
        $data['cartItem'] = $this->cart->contents();
        $data['lastTrasactionId'] = $this->CartModel->getLastId();
        $data['main_content'] = ADMIN_PATH . "cart";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);

    }

    function invoicePrint()
    {
        $data['userId'] = $this->session->userdata(USER_ID);
        $data['cartItem'] = $this->cart->contents();
        $data['lastTrasactionId'] = $this->CartModel->getLastId();
        $data['main_content'] = ADMIN_PATH . "invoice-print";
        $this->load->view(ADMIN_PATH . "invoice-print", $data);
    }

    function addLine()
    {
        try {
            $this->LineModel->insertLine();
        } catch (Exception $e) {
            echo json_encode($this->handleDatabaseError($e));
            return;
        }
        if ($this->roleName == OWNER) {
            redirect(ADMIN_PATH . 'line/my_lines');
        } else if ($this->roleName == BROKER) {
            redirect(ADMIN_PATH . 'line/to_lines');
        }
    }

//    function invoicePrint()
//    {
////        $data['main_content'] = ADMIN_PATH . "invoice-print";
//        $this->load->view(ADMIN_PATH . "invoice-print");
//    }

    function addLineToClient()
    {
        try {
            $this->LineModel->insertLineToClient();
        } catch (Exception $e) {
            throw $e;
        }
        redirect(ADMIN_PATH . 'line/lineAssignment');
    }

    function deleteLineClient()
    {
        try {
            $this->LineModel->deleteLineClient();
        } catch (Exception $e) {
            echo json_encode($this->handleDatabaseError($e));
            return;
        }
        redirect(ADMIN_PATH . 'line/lineAssignment');
    }

    function changeStatus($line_id)
    {
        try {
            $this->LineModel->changeStatus($line_id);
        } catch (Exception $e) {
            echo json_encode($this->handleDatabaseError($e));
            return;
        }
        redirect(ADMIN_PATH . 'line/lineAssignment');
    }

    function deleteLine()
    {
        try {
            $this->LineModel->deleteLine();
        } catch (Exception $e) {
            echo json_encode($this->handleDatabaseError($e));
            return;
        }
        redirect(ADMIN_PATH . 'line/lineAssignment');
    }

    function lineAssignment($lineId = null)
    {
        $this->allow(true, OWNER, ADMIN, BROKER, CLIENT);
        $brokerId = null;
        if ($this->roleName == BROKER) {
            $data['lines'] = $this->LineModel->getLineClientsForOwnerBroker($lineId, $this->userId);
        } else if ($this->roleName == ADMIN) {
            $data['lines'] = $this->LineModel->getLineClientsForOwnerBroker($lineId, null);
        } else if ($this->roleName == OWNER) {
            $data['lines'] = $this->LineModel->getLineClientsForOwner($lineId, $this->userId);
        }

        $data['role'] = $this->roleName;
        $data['main_content'] = ADMIN_PATH . "lineAssignment";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function getCards()
    {
        echo json_encode($this->CardTypeModel->getBanksAssociative());
    }

    function getCardNames()
    {
        echo json_encode($this->CardTypeModel->getCardNamesAssociative($this->input->get('type')));
    }

    function getCardTypes()
    {
        echo json_encode($this->CardTypeModel->getCardTypesAssociative($this->input->get('bank')));
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
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function generatescheme()
    {
        $flag = FALSE;
        foreach ($this->input->post('amount') as $key => $value) {
            $charge = $this->input->post('charge');
            $charge = $charge[$key];
            if ($this->LineModel->generatescheme($value, $charge, $this->input->post('card_detail_id'))) {
                $flag = TRUE;
            } else {
                $flag = FALSE;
            }
        }
        if ($flag) {
            $this->session->set_flashdata('su_message', 'Scheme Generated Successful.');
            redirect('administrator/line');
        } else {
            $this->session->set_flashdata('su_message', 'Scheme Generated Unsuccessful.');
            redirect('administrator/line');
        }
    }

    function line_types()
    {
        $data['data'] = $this->CardTypeModel->getCards();
        $data['title'] = "";
        $data['main_content'] = ADMIN_PATH . "cards";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function purchaseLine($lineid)
    {
        $data['line'] = $this->LineModel->getLineDetails($lineid);
        $data['title'] = "purchase";
        $data['main_content'] = ADMIN_PATH . "purchaseLine";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function paypalPayment()
    {
        if ($this->input->post('paymentmethod') == 'recurring')
            $this->paypalRecurringPayment();
        else
            $this->paypalDirectPayment();
    }

    function paypalRecurringPayment()
    {
        $this->load->model('RecurringModel');
        $currencyCodeType = "USD";
        $paymentType = "Sale";
        $paymentAmount = 100;
        $returnURL = base_url() . 'administrator/line/order_confirm';
        $cancelURL = base_url() . 'administrator/home';
        $resArray = $this->RecurringModel->CallShortcutExpressCheckout($paymentAmount, $currencyCodeType, $paymentType, $returnURL, $cancelURL);
        $ack = strtoupper($resArray["ACK"]);
        if ($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING") {
            $this->RecurringModel->RedirectToPayPal($resArray["TOKEN"]);
        }


    }

    function paypalDirectPayment()
    {
        echo 'direct';
    }

    function order_confirm()
    {
        $this->load->model('RecurringModel');
        if ($_GET['token'] && $_GET['PayerID']) {
            $resArray = $this->RecurringModel->CreateRecurringPaymentsProfile();
            $ack = strtoupper($resArray["ACK"]);
            if ($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING") {
                $data['main_content'] = ADMIN_PATH . 'reucrring_success';
                $this->load->view(ADMIN_PATH . 'inc/template', $data);
            } else {
                $ErrorCode = urldecode($resArray["L_ERRORCODE0"]);
                $ErrorShortMsg = urldecode($resArray["L_SHORTMESSAGE0"]);
                $ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
                $ErrorSeverityCode = urldecode($resArray["L_SEVERITYCODE0"]);
                echo "GetExpressCheckoutDetails API call failed. ";
                echo "Detailed Error Message: " . $ErrorLongMsg;
                echo "Short Error Message: " . $ErrorShortMsg;
                echo "Error Code: " . $ErrorCode;
                echo "Error Severity Code: " . $ErrorSeverityCode;
            }
        }
    }

    function purchase()
    {
        $data['lines'] = $this->LineModel->getAllPurchaseLines();
        $data['title'] = "purchase";
        $user_id = $this->session->userdata(USER_ID);
        $data['purchase'] = $this->CardTypeModel->getPurchaseDate($user_id);
        $data['main_content'] = ADMIN_PATH . "purchase";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function addedDateTask()
    {
        $this->TaskModel->notifyAfterAddedToBroker($this->input->post('lineId'), $this->input->post('clientId'));
        $this->TaskModel->notifyAfterAddedToClient($this->input->post('lineId'), $this->input->post('clientId'));
        $this->AlertModel->emailAfterAddedDate($this->input->post('line_id'), $this->input->post('client_id'));
    }

    function emailAfterBrokerVerified()
    {
        $this->AlertModel->emailAfterBrokerVerified($this->input->post('line_id'), $this->input->post('client_id'));
    }

    function balance($lineId = null)
    {
        $this->allow(true, BROKER, ADMIN, OWNER , CLIENT);
        $brokerId = null;
        if ($this->roleName == 'broker')
            $brokerId = $this->userId;
        else if ($this->roleName = 'admin')
            $brokerId = null;
        $data['lines'] = $this->LineModel->balance($lineId, $brokerId);
        $data['role'] = $this->roleName;
        $data['main_content'] = ADMIN_PATH . "balance";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

}

?>