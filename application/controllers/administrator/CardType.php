<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class CardType extends AdminController
{
    public $errors = '';

    public function __construct()
    {
        parent::__construct(OWNER, BROKER, ADMIN);
        $this->load->helper('general');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('path');
        $this->load->helper('string');
        $this->load->model('CardTypeModel');
    }

    public function cardTypeForm()
    {
        $data['cardTypes'] = $this->CardTypeModel->getCardTypesAssociative();
        $data['main_content'] = ADMIN_PATH . "cardTypeForm";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    public function addCardType()
    {
        try {
            $data['data'] = $this->CardTypeModel->insertCardType();
        } catch (Exception $e) {
            echo json_encode($this->handleDatabaseError($e));
            return; /*todo convert frontend submit into ajax post and handle the error via bootstrap validation*/
        }
        redirect(base_url() . "administrator/cardType/cardTypes");
    }

    public function updateRole($id)
    {
        $data['data'] = $this->RoleModel->updateRole($id);
        $data['title'] = "Update Role";
        $data['main_content'] = ADMIN_PATH . "role";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);

    }

    public function cardTypes()
    {
        $data['data'] = $this->CardTypeModel->getCardTypes();
        $data['title'] = "";
        $data['main_content'] = ADMIN_PATH . "cardTypes";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);

    }

    public function cardType($typeId)
    {
        $data['data'] = $this->CardTypeModel->getCardType($typeId);
        $data['title'] = "";
        $data['main_content'] = ADMIN_PATH . "cardTypes";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);

    }

    public function deleteCard($id)
    {
        try {
            $this->CardTypeModel->deleteCard($id);
            redirect(ADMIN_PATH . "cardType/cardTypes");
        } catch (Exception $e) {
            echo json_encode($this->handleDatabaseError($e));
            return;
        }

    }

    public function deleteUsersFromRole($roleId)
    {
        try {
            $this->RoleModel->deleteUsersFromRole($roleId);
            $this->session->set_flashdata("su_message", "role from users deleted successfully.");
            redirect(ADMIN_PATH . "role/roles");
        } catch (Exception $e) {
            echo "some problem";
        }
    }


    public function addRole()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('label', 'Label', 'required');
        $this->form_validation->set_rules('value', 'Value', 'required|max_length[10]');
        $data['main_content'] = ADMIN_PATH . "roleForm";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    public function lookup()
    {
        // process posted form data
        $keyword = $this->input->post('term');
        $data['response'] = 'false'; //Set default response
        $queryType = $this->CardTypeModel->lookup($keyword); //Search DB

        if (!empty($queryType)) {
            $data['response'] = 'true'; //Set response
            $data['message'] = array(); //Create array
            foreach ($queryType as $row) {
                $data['message'][] = array(
                    'id' => $row->id,
                    'value' => $row->type,
                    ''
                );  //Add a row to array
            }
        }

        if ('IS_AJAX') {
            echo json_encode($data); //echo json string if ajax request

        } else {
            $this->load->view('administrator/cardTypeForm', $data); //Load html view of search results
        }
    }


    public function lookupBank($type)
    {
        // process posted form data
        $keyword = $this->input->post('term');
        $data['response'] = 'false'; //Set default response
        $queryBank = $this->CardTypeModel->lookupBank($keyword, $type); //Search DB

        if (!empty($queryBank)) {
            $data['response'] = 'true'; //Set response
            $data['message'] = array(); //Create array
            foreach ($queryBank as $row) {
                $data['message'][] = array(
                    'id' => $row->id,
                    'value' => $row->bank,
                    ''
                );  //Add a row to array
            }
        }

        if ('IS_AJAX') {
            echo json_encode($data); //echo json string if ajax request

        } else {
            $this->load->view('administrator/cardTypeForm', $data); //Load html view of search results
        }
    }


    public function lookupName($type, $bank)
    {
        // process posted form data
        $keyword = $this->input->post('term');
        $data['response'] = 'false'; //Set default response
        $queryName = $this->CardTypeModel->lookupName($keyword, $type, $bank); //Search DB

        if (!empty($queryName)) {
            $data['response'] = 'true'; //Set response
            $data['message'] = array(); //Create array
            foreach ($queryName as $row) {
                $data['message'][] = array(
                    'id' => $row->id,
                    'value' => $row->name,
                    ''
                );  //Add a row to array
            }
        }

        if ('IS_AJAX') {
            echo json_encode($data); //echo json string if ajax request

        } else {
            $this->load->view('administrator/cardTypeForm', $data); //Load html view of search results
        }
    }


}