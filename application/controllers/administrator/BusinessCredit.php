<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class BusinessCredit extends AdminController
{
    public function __construct()
    {
        parent::__construct(CLIENT, OWNER, BROKER, ADMIN);
        $this->load->helper('general');
        $this->load->helper('url');
        checkAdminAuth();
        $this->load->library('pagination');
        $this->load->model('AuthModel');
        $this->load->helper('security');
        $this->load->model('RoleModel');
        $this->load->model('MembershipModel');
        $this->load->model('CampaignModel');
        $this->load->model('CardTypeModel');
        $this->load->model('EmailModel');
        $this->load->model('ProspectModel');
        $this->load->model('UserModel');
        $this->load->model('LineModel');
        $this->load->model('CreditStatusModel');
        $this->load->model('ModuleModel');

        $this->load->helper(array('form', 'url', 'captcha'));

    }

    public function index()
    {
        $data['role'] = $role = $this->session->userdata(ROLE_NAME);
        $data['membership'] = $membership = $this->session->userdata(MEMBERSHIPS);
        $data['member_module'] = $this->ModuleModel->getMemberModules('business_credit');
        $data['main_content'] = ADMIN_PATH . "business_credit";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    public function view($userId)
    {
        $data['title'] = 'Credit Status';
        $data['creditStatus'] = $this->CreditStatusModel->getCreditStatus($userId);
        $data['monitoringServices'] = $this->CreditStatusModel->getMonitoringServices($userId, SELECT);
        $data['main_content'] = ADMIN_PATH . "business_credit";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function creditStatus($userId)
    {
        $data['title'] = 'Credit Status';
        $data['creditStatus'] = $this->CreditStatusModel->getCreditStatus($userId);
        $data['monitoringServices'] = $this->CreditStatusModel->getMonitoringServices($userId, SELECT);

        $data['main_content'] = ADMIN_PATH . "creditStatus";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function getCreditStatus($userId)
    {
        if (!$userId)
            $userId = $this->userId;
        return $this->CreditStatusModel->getCreditStatus($userId, $_POST['service'], JSON);
    }

    function creditStatusForm()
    {
        $data['title'] = 'Add Credit Status';
        $data['company'] = $this->CreditStatusModel->getMonitoringServices('', SELECT);
        $data['companyClient'] = $this->CreditStatusModel->getMonitoringServicesClient($this->session->userdata(USER_ID));
        $data['userId'] = $this->session->userdata(USER_ID);
        $data['main_content'] = ADMIN_PATH . "creditStatusForm";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }


    function addCreditStatus()
    {
        if ($_FILES['file']['name']) {
            $file = $this->uploadPdf('file', "uploads/creditStatus/");
            if ($file == "") {
                $this->session->set_flashdata('message', json_encode(strip_tags($this->upload->display_errors())));
                redirect(ADMIN_PATH . "creditstatus/creditStatusForm");
            } else {
                $file_name = $file['file_name'];
                try {
                    $this->CreditStatusModel->insertCreditStatus($_POST['monitoringServiceId'], $this->userId, $_POST['experian'], $_POST['equifax'], $_POST['transUnion'], $_POST['date'], $file_name);
                } catch (Exception $e) {
                    echo json_encode($this->handleDatabaseError($e));
                    return;
                }
                redirect(ADMIN_PATH . 'creditstatus/creditStatus/' . $this->session->userdata(USER_ID));
            }
        } else {
            try {
                $this->CreditStatusModel->insertCreditStatus($_POST['monitoringServiceId'], $this->userId, $_POST['experian'], $_POST['equifax'], $_POST['transUnion'], $_POST['date']);
            } catch (Exception $e) {
                echo json_encode($this->handleDatabaseError($e));
                return;
            }
            redirect(ADMIN_PATH . 'creditstatus/creditStatus/' . $this->session->userdata(USER_ID));
        }

    }

    function deleteCreditStatus()
    {
        try {
            $this->CreditStatusModel->deleteCreditStatus();
        } catch (Exception $e) {
            echo json_encode($this->handleDatabaseError($e));
            return;
        }
        redirect(base_url() . "administrator/creditstatus/view/" . $this->input->post('user_id'));
    }

    public function addMonitoringService()
    {
        try {
            $data['data'] = $this->CreditStatusModel->insertMonitoringService($_POST['company'], $_POST['site']);
        } catch (Exception $e) {
            echo json_encode($this->handleDatabaseError($e));
            return;
        }
        redirect(base_url() . "administrator/creditStatus/monitoringService");
    }

    function deleteMonitoringService()
    {
        try {
            $this->CreditStatusModel->deleteMonitoringService();
        } catch (Exception $e) {
            echo json_encode($this->handleDatabaseError($e));
            return;
        }
        redirect(base_url() . "administrator/creditstatus/monitoringService");
    }

    function getCompany()
    {
        echo json_encode($this->UserModel->getCompanyAssociative());
    }

    function getCompanyName()
    {
        echo json_encode($this->UserModel->getCompanyNameAssociative($this->input->get('bank')));
    }

    function monitoringService()
    {
        $data['title'] = 'Monitoring Services';
        $data['company'] = $this->CreditStatusModel->getMonitoringServices();
        $data['userId'] = $this->session->userdata(USER_ID);
        $data['main_content'] = ADMIN_PATH . "monitoringService";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function deleteNote()
    {
        try {
            $this->UserModel->deleteNote($this->input->post('id'));
        } catch (Exception $e) {
            echo json_encode($this->handleDatabaseError($e));
            return;
        }
        redirect(base_url() . "administrator/creditstatus/creditStatus/" . $this->input->post('userId'));
    }

    public function addMonitoringServiceClient()
    {
        try {
            $data['data'] = $this->CreditStatusModel->insertMonitoringServiceClient();
        } catch (Exception $e) {
            echo json_encode($this->handleDatabaseError($e));
            return;
        }
        redirect(base_url() . "administrator/creditStatus/creditStatusForm");
    }

    function deleteMonitoringServiceClient()
    {
        try {
            $this->CreditStatusModel->deleteMonitoringServiceClient();
        } catch (Exception $e) {
            echo json_encode($this->handleDatabaseError($e));
            return;
        }
        redirect(base_url() . "administrator/creditstatus/creditStatusForm");
    }

}

?>