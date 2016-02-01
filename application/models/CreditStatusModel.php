<?php

class CreditStatusModel extends AdminModel
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('date');
        $this->load->library('email');
        $this->load->library('encrypt');
        $this->load->helper('security');
        $this->load->model('RoleModel');
        $this->load->model('ContentModel');
        $this->load->model('EmailModel');
        $this->load->model('UserModel');
        $this->load->database();

    }


    function deleteCreditStatus()
    {
        $this->db->where($this->input->post());
        $this->db->delete('credit_status');
        if ($this->db->affected_rows() == 0) {
            throw new Exception("Could not delete row");
        }

    }

    function getCreditStatus($userId, $serviceProviderId = null, $widget = null)
    {
        if ($serviceProviderId)
            $append = " and cs.monitoring_service_id = '$serviceProviderId'";
        $result = $this->db->query("SELECT ms.name, cs.monitoring_service_id, cs.equifax, cs.experian, cs.transunion, cs.file , cs.id, cs.date, ms.url, cs.user_id
                                  FROM credit_status cs
                                  LEFT JOIN monitoring_service ms ON cs.monitoring_service_id = ms.id
                                  WHERE cs.user_id = $userId" . $append . " ORDER BY cs.id DESC")->result();
        return $this->widget($widget, $result, 'monitoring_service_id', 'name', '');
    }

    function getBusiness($userId)
    {
        return $this->db->query("SELECT * FROM business LEFT JOIN address ON business.address_id = address.id WHERE business.user_id = $userId")->result();

    }

    function getMonitoringServices($userId = null, $widget)
    {
        if ($userId)
            $append = "  JOIN credit_status cs on cs.monitoring_service_id = ms.id and cs.user_id = '$userId'";
        $result = $this->db->query("SELECT * ,ms.*, ms.id msid FROM monitoring_service ms
                                     $append")->result();
        return $this->widget($widget, $result, 'msid', 'name', '');
    }

    function getMonitoringServicesAll($widget)
    {
        $result = $this->db->query("SELECT * ,ms.*, ms.id msid FROM monitoring_service ms ")->result();
        return $this->widget($widget, $result, 'msid', 'name', '');
    }

    function getMonitoringServicesSite($id)
    {
       return $this->db->query("SELECT ms.url FROM monitoring_service ms WHERE ms.id = '$id' ")->row()->url;
    }

//    function getMonitoringServices($userId = null, $widget)
//    {
//        if ($userId)
//            $append = "  JOIN credit_status cs on cs.monitoring_service_id = ms.id and cs.user_id = '$userId'";
//        $result = $this->db->query("SELECT * ,ms.*, ms.id msid FROM monitoring_service ms
//                                     $append")->result();
//        return $this->widget($widget, $result, 'msid', 'name', '');
//    }

    function getMonitoringServicesClient($userId)
    {
        return $this->db->query("SELECT cms.*, ms.name, ms.url FROM client_monitoring_service cms
                                    LEFT JOIN monitoring_service ms ON cms.monitoring_service_id = ms.id
                                     WHERE cms.userId = $userId")->result();
    }


    function getmonitoring_serviceEditable()
    {
        $query = $this->db->query("SELECT * FROM monitoring_service");
        if ($query->num_rows() > 0) {
            return $this->editable($query->result(), 'id', 'monitoring_service');
        } else
            return false;
    }

    function insertmonitoring_service()
    {
        $data = array(
            'monitoring_service' => $this->input->post('monitoring_service'),
            'url' => $this->input->post('url'),
        );
        $this->db->insert('monitoring_service', $this->security->xss_clean($data));
    }

    function insertCreditStatus($monitoringServiceId, $userId, $experian, $equifax, $transUnion, $date, $file_name)
    {
        $data = array(
            'monitoring_service_id' => $monitoringServiceId,
            'user_id' => $userId,
            'experian' => $experian,
            'equifax' => $equifax,
            'transunion' => $transUnion,
            'date' => $this->formatDate($date),
            'file' => $file_name
        );
        $this->db->insert('credit_status', $this->data($data));
    }

    function  getmonitoring_service()
    {
        $query = $this->db->query("SELECT * FROM monitoring_service");
        if ($query->num_rows() > 0) {
            $result = array();
            foreach ($query->result() as $row) {
                $result[$row->id] = $row->monitoring_service;
            }
            return $result;
        }
        return false;
    }

    function  getmonitoring_serviceNameAssociative()
    {
        $query = $this->db->query("SELECT DISTINCT name FROM monitoring_service");
        if ($query->num_rows() > 0) {
            $result = array();
            $count = 0;
            foreach ($query->result() as $row) {
                $result[$count++] = $row->monitoring_service;
            }
            return $result;
        }
        return false;
    }


    function insertMonitoringService($name, $site)
    {
        $data = array(
            'name' => $name,
            'url' => $site,
        );
        $this->db->insert('monitoring_service', $this->security->xss_clean($data));
    }

    function deleteMonitoringService()
    {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->delete('monitoring_service');
    }

    function insertMonitoringServiceClient()
    {
        $data = array(
            'monitoring_service_id' => $this->input->post('monitoring_service_id'),
            'userId' => $this->session->userdata(USER_ID),
            'username' => $this->input->post('userId'),
            'password' => $this->input->post('pass'),
            'security_answer' => $this->input->post('answer'),
        );
        $this->db->insert('client_monitoring_service', $this->security->xss_clean($data));

    }

    function deleteMonitoringServiceClient()
    {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->delete('client_monitoring_service');
    }

    function updateMonitoring($image, $id)
    {
        $oldProfilePictureName = $this->db->query("select m.site_image from monitoring_service m where m.id = $id")->row()->site_image;
        $data = array(
            "site_image" => $image,

        );
        $this->db->where("id", $id);
        $this->db->update('monitoring_service', $this->security->xss_clean($data));
        return $oldProfilePictureName;
    }


}
