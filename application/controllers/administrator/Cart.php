<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Cart extends AdminController
{
    public $errors = '';

    public function __construct()
    {
        parent::__construct(CLIENT, BROKER);
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('path');
        $this->load->helper('general');
        $this->load->model('CartModel');
        checkAdminAuth();
        $this->load->helper('security');
        $this->load->library('cart');
    }

    function addItem($clients)
    {
        if($clients=='null'){
            $this->cart->destroy();
        }
        else {
            if($this->session->userdata(ROLE_NAME)==BROKER) {
                $this->cart->destroy();
            }
            if (strpos($clients, ',') == false) {
                $clientArray = array($this->userId);
            } else {
                $clientArray = explode(',', $clients);
            }
            foreach ($clientArray as $key => $client) {
                $clientName = $this->UserModel->getUserByUserId($client);
                try {
                    $data = array(
                        'id' => $this->input->post('id'),
                        'qty' => $this->input->post('qty'),
                        'price' => $this->input->post('cost'),
                        'name' => $this->input->post('name'),
                        'options' => array('client' => $client),
                        'owner_price' => $this->input->post('owner_price'),
                        'broker_price' => $this->input->post('broker_price'),
                        'client_broker_price' => $this->input->post('client_broker_price'),
                        'clientName' => $clientName->userName,
                        'clientId' => $client
                    );
                    try {
                        $this->cart->insert($data);
                    } catch (Exception $e) {
                        echo $e;
                    }
                } catch
                (Exception $e) {
                    echo json_encode($this->handleDatabaseError($e));
                    return;
                }
            }
        }

        echo count($this->cart->contents());
        //$this->cart->destroy();
    }

    function deleteCartItem()
    {
        try {
            $this->CartModel->deleteItem();
        } catch (Exception $e) {
            return $this->handleDatabaseError($e);
        }
        redirect(ADMIN_PATH . 'line/lines');
    }

    function removeCartItem()
    {
        $rowId = $this->input->post('itemId');
        $this->cart->remove($rowId);
        return true;
    }

    function emptyCart()
    {
        foreach ($this->cart->contents() as $items) {
            $this->cart->remove($items['rowid']);
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    function updateCart()
    {
        $row_id = $_POST['row_id'];
        $qty = $_POST['qty'];
        $this->CartModel->updateCart($row_id ,$qty);
    }




}