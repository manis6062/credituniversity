<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class CreditStatus extends AdminController
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

    public function view($userId)
    {

        $data['title'] = 'Credit Status';
        $data['role'] =  $this->session->userdata(ROLE_NAME);
        $data['creditStatus'] = $this->CreditStatusModel->getCreditStatus($userId);
        $data['monitoringServicesClient'] = $this->CreditStatusModel->getMonitoringServices($userId, SELECT);
        $data['monitoringServices'] = $this->CreditStatusModel->getMonitoringServicesAll(SELECT);
        $data['main_content'] = ADMIN_PATH . "creditStatus";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function creditStatus($userId)
    {
         $data['number'] = $_POST['num'];
        $data['title'] = 'Credit Status';
        $data['role_name'] =  $this->session->userdata(ROLE_NAME);
        $data['member_module'] = $this->ModuleModel->getMemberModules('credit_status');
        $data['creditStatus'] = $this->CreditStatusModel->getCreditStatus($userId);
        $data['monitoringServicesClient'] = $this->CreditStatusModel->getMonitoringServices($userId, SELECT);
        $data['monitoringServices'] = $this->CreditStatusModel->getMonitoringServicesAll(SELECT);
        $data['main_content'] = ADMIN_PATH . "creditStatus";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function site($id)
    {
        echo $this->CreditStatusModel->getMonitoringServicesSite($id);
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
        $data['role'] =  $this->session->userdata(ROLE_NAME);
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
        $this->allow(true, ADMIN);
        $data['title'] = 'Monitoring Services';
        $data['role'] =  $this->session->userdata(ROLE_NAME);
        $data['company'] = $this->CreditStatusModel->getMonitoringServices();
        $data['userId'] = $this->session->userdata(USER_ID);
        $data['main_content'] = ADMIN_PATH . "monitoringService";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function monitoringServiceClient()
    {
        $this->allow(true, CLIENT);
        $data['title'] = 'Monitoring Services';
        $data['userId'] = $this->session->userdata(USER_ID);
        $data['role'] =  $this->session->userdata(ROLE_NAME);

        $data['monitoringServicesClient'] = $this->CreditStatusModel->getMonitoringServicesClient($data['userId']); 
        $data['monitoringServices'] = $this->CreditStatusModel->getMonitoringServicesAll(SELECT);

        $data['company'] = $data['monitoringServices'];
        $data['companyClient'] = $data['monitoringServicesClient'];

        $data['main_content'] = ADMIN_PATH . "monitoringServiceClient";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function update_montoringPic($id)

    {
        if ($_FILES['site_image']['name']) {
            $uploaded_image = $this->upload('site_image', "uploads/monitoring/");
            if ($uploaded_image == "") {
                $this->session->set_flashdata('message', json_encode(strip_tags($this->upload->display_errors())));
            } else {
                $image = $uploaded_image['file_name'];

                $oldProfilePictureName = $this->CreditStatusModel->updateMonitoring($image, $id);
                try {
                    unlink('uploads/monitoring/' . $oldProfilePictureName);
                } catch (Exception $e) {
                }
            }
        }

        redirect(ADMIN_PATH . "creditstatus/monitoringService");

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
        //redirect(base_url() . "administrator/creditStatus/creditStatusForm");
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

    public function loadPdf($id)
    {
        $data['title'] = 'Pdf';
        $data['monthly_tips'] = $this->ContentModel->getMonthlyTipsWithId($id);
        $data['main_content'] = ADMIN_PATH . "load_tip";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }
    
    
    function loadCreditStatus($userId,$service_provider){

        $data['creditStatus'] = $this->CreditStatusModel->getCreditStatus($userId,$service_provider);
      $creditStatus =$data['creditStatus'];
      $str = "";
      if($creditStatus){
       foreach ($creditStatus as $key => $credit) {
                                    $credit_date = date('Y-m-d', strtotime($credit->date));
                                    $link = base_url() . 'uploads/creditStatus/' . $credit->file;
                      
                        if ($credit->file!="") {
                                              
                                             $pdf_link ='<a href="'.$link.'"
                                                   target="_blank" id="file"><i
                                                        class="fa fa-file-pdf-o fa-lg"></i>
                                                </a>';
                                             } 

                            $parameter = $credit->id . ',' . $credit->user_id;
                            $delete_confirm = "confirm('Are you sure you want to delete?')? deleteCreditStatus(".$parameter."): ''";

                                  $str.='   <tr class="item">
                                        <td>
                                            <div class="form-group">
                                                <a href="'.$credit->url.'" id="monitoring_service_id"
                                                   target="_blank">'.$credit->name.'</a>
                                            </div>
                                        </td>
                                        <td><a href="#" data-pk="'.$credit->id.'" id="experian"
                                               data-type="text">'.$credit->experian.'</a></td>
                                        <td><a href="#" data-pk="'.$credit->id.'" id="equifax"
                                               data-type="text">'.$credit->equifax.'</a></td>
                                        <td><a href="#" data-pk="'.$credit->id.'" id="transunion"
                                               data-type="text">'.$credit->transunion.'</a></td>
                                        <td>
                                            '.$pdf_link.'</td>
                                        <td><a href="#" data-pk="'.$credit->id.'" id="date"
                                               data-type="combodate">'.$credit_date.'</a></td>
                                        <td>
                                            <a href="#"
                                               onclick="return '.$delete_confirm.'"><span
                                                    class="glyphicon glyphicon-trash"></span></i></a>
                                        </td>
                                    </tr>';

                }
        }

        echo  $str;
    }



    function profileProcess($userId, $type = '')
    {
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
        $this->load->model('EmailerModel');
        $this->load->model('EmailModel');
        $this->load->model('ProspectModel');
        $this->load->model('UserModel');
        $this->load->model('LineModel');
        $this->load->helper(array('form', 'url', 'captcha'));

        $this->allow(true, BROKER, ADMIN , OWNER );
        if ($type)
            $data['protype'] = $type;

        $this->session->set_flashdata('redirectToCurrent', current_url());
        $data['user'] = $this->UserModel->getUser($userId);
        $data['employ'] = $this->UserModel->getEmployement($userId);
        $data['application'] = $this->UserModel->getCreditApplication($userId);
        $data['roles'] = $this->getRoles();
        $data['clientMembership'] = $this->MembershipModel->getMembership($userId, CLIENT, SELECTXKEYS);
        $data['userMembership'] = $this->MembershipModel->getMembershipLevelById($userId);
        $data['ownerMembership'] = $this->MembershipModel->getMembership($userId, OWNER, SELECTXKEYS);
        $data['brokerMembership'] = $this->MembershipModel->getMembership($userId, BROKER, SELECTXKEYS);
        $data['clientMemberships'] = $this->MembershipModel->getMembershipTypes(CLIENT, SELECTX);
        $data['ownerMemberships'] = $this->MembershipModel->getMembershipTypes(OWNER, SELECTX);
        $data['brokerMemberships'] = $this->MembershipModel->getMembershipTypes(BROKER, SELECTX);
        $data['userCoupons'] = $this->CampaignModel->getUserCampaigns($userId, SELECTXKEYS);
        $data['coupons'] = $this->CampaignModel->getCampaigns(SELECTX);
//        $coupons = $data['coupons'];
        $data['coupons_details'] = $this->CampaignModel->getCouponsDetails($userId);
        $data['brokers'] = $this->UserModel->getBrokersEditable();
        $data['questions'] = $this->UserModel->getQuestionsEditable();
        $data['state'] = $this->UserModel->getStatesEditable();
        $data['business'] = $this->UserModel->getBusiness($userId);
        $data['title'] = "Update User";
        $data['offset'] = $userId;
        $data['role'] = $this->roleName;
        $data['notes'] = $this->UserModel->getUserNotes($userId);
        $data['verified'] = $this->LineModel->getLineBalance($userId, true);
        $data['unverified'] = $this->LineModel->getLineBalance($userId, false);
        $data['userRoles'] = $this->RoleModel->getUserRolesByUserId($userId);
        $data = $this->addRolesToUser($userId, $data);
        $data['other_roles'] = $this->RoleModel->getRolesWithMembership($this->uri->segment(4));
        $data['admin_roles'] = $this->RoleModel->getAdminRoles($this->uri->segment(4));
        $data['roles'] = array_merge($data['other_roles'], $data['admin_roles']);
        $data['member_since'] = $this->UserModel->getUserCreatedDate($this->uri->segment(4));

        $brokerId = null;
        if ($this->roleName = "broker") {
            $brokerId = $this->uri->segment(4);
        }

        $data['total_clients'] = count($this->UserModel->getBrokerUsersWithRoles($brokerId, $role_name = 'client'));
        $data['total_owners'] = count($this->UserModel->getBrokerUsersWithRoles($brokerId, $role_name = 'owner'));
        $data['total_brokers'] = count($this->UserModel->getBrokerUsersWithRoles($brokerId, $role_name = 'broker'));
        $data['my_lines'] = count($this->LineModel->getSelfLines($this->uri->segment(4)));
        $data['to_lines'] = count($this->LineModel->getAllBrokerLines($this->uri->segment(4)));
        $data['active_lines'] = count($this->LineModel->getAllBrokerLines($this->uri->segment(4)));
        $data['credit'] = $this->UserModel->getCreditApplication($this->uri->segment(4));
        $data['about_employ'] = $this->UserModel->getSingleEmployement($userId);


//        $data['employments'] = $this->load->view(ADMIN_PATH . 'employments', NULL, TRUE);
        $data['main_content'] = ADMIN_PATH . "profile_process";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }



    function getRoles()
    {
        $roleMembershipPrivilege = $this->MembershipModel->getMembershipRolesByUserId($this->session->userdata(USER_ID));
        $nonPublicRoles = $this->RoleModel->getNonPublicRolesByUserId($this->session->userdata(USER_ID));
        if (!empty($roleMembershipPrivilege) && !empty($nonPublicRoles)) {
            $roleResult = array_merge((array)$roleMembershipPrivilege, (array)$nonPublicRoles);
        } else {
            $roleResult = $roleMembershipPrivilege;
        }

        if ($roleResult) {
            $roles = array();
            foreach ($roleResult as $role) {
                $roles[] = '{' . 'value: ' . $role->id . ',' . ' text: ' . '\'' . $role->label . '\'' . '}';
            }
            return str_replace("\"", "", json_encode($roles));
        }
    }

    public function addRolesToUser($user_id, $data)
    {
        $a = array('[', '{', ']', '}', '"', 'role_id', ':', 'user_id');
        $b = array('', '', '', '', '', '', '');
        $data['user_roles'][$user_id] = str_replace($a, $b, json_encode($this->RoleModel->getUserIdRoleIdAssociative($user_id)));
        return $data;

        $this->session->set_flashdata('redirectToCurrent', current_url());
        $data['user'] = $this->UserModel->getUser($user_id);
        $data['employ'] = $this->UserModel->getEmployement($user_id);
        $data['roles'] = $this->getRoles();
        $data['brokers'] = $this->UserModel->getBrokersEditable();
        $data['title'] = "Update User";
        $data['offset'] = $user_id;
        $data['role'] = $this->roleName;
        $data = $this->addRolesToUser($user_id, $data);
        $data['main_content'] = ADMIN_PATH . "user";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);

    }


}

?>