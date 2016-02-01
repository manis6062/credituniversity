<?php

class SettingsModel extends AdminModel
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('date');
        $this->load->library('email');
        $this->load->model('RoleModel');

    }

    function getPaypalState()
    {
        return $this->db->query("SELECT sp.param_value FROM sys_param sp WHERE sp.broker_id = 11 AND sp.param_name = 'paypal'")->row()->param_value;
    }

    function setPaypalState($paypalState)
    {
        $this->db->query("update sys_param sp set sp.param_value = '$paypalState' where sp.param_name = 'paypal'");
    }

}