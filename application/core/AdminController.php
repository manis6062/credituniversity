<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller
{
    protected $roleId;
    protected $roleName;
    protected $authIds;
    protected $roleLabel;
    protected $userId;
    protected $userName;
    protected $email2;
    protected $name;

    public function __construct(...$args)

    {
        parent::__construct();
        $url = substr($_SERVER[REQUEST_URI], 1, strrpos($_SERVER[REQUEST_URI], '/') - 1);
        if($url =='administrator/mail/read_mail') {
            $this->session->set_userdata('previousLink', $_SERVER[REQUEST_URI]);
        }
        $this->roleId = $this->session->userdata(ROLE_ID);
        $this->authIds = $this->session->userdata(AUTHS);
        $this->roleName = $this->session->userdata(ROLE_NAME);
        $this->roleLabel = $this->session->userdata(ROLE_LABEL);
        $this->userId = $this->session->userdata(USER_ID);
        $this->userName = $this->session->userdata(NAME);
        $this->email2 = $this->session->userdata(EMAIL);
        $this->name = $this->session->userdata(NAME);
        $this->checkRoles(true, $args);
    }

public function handleDatabaseError(Exception $e)
{
    $errorNumber = $this->getStringAfter($e, 'error number:');
    set_status_header(200);
    switch ($errorNumber) {
        case "1451":
            $foreign_key_constraint = $this->getStringAfter($e, ', constraint');
            switch ($foreign_key_constraint) {
                case "broker_ibfk_2" :
                    return $this->message("Please remove the broker from this user first");
                case "broker_ibfk_1" :
                    return $this->message("Please remove this broker as a parent broker from all other brokers first");
                case "line_ibfk_1" :
                    return $this->message("DELETE tradlines FROM this owner FIRST");
                 case "client_monitoring_service_ibfk_2" :
                    return $this->message("Please remove client form the monitoring service first");
                 case "credit_status_ibfk_1" :
                    return $this->message("Please remove client form the monitoring service first");
                case "cart_item_ibfk_1" :
                    return $this->message("Clear all shopping carts with this tradeline");
                default;
                    return $this->message($e->getMessage());
            }
        case "1062":
            $duplicate_column = $this->getStringAfter($e, 'for key');
            return $this->fieldMessage($duplicate_column,"Invalid" .' ' .  strtoupper($duplicate_column) );
        case "1054":
            return $this->message($e->getMessage());
        default:
            return $this->message($e->getMessage());

    }
}

function upload($file, $path)
{
    unset($config);
    $config['upload_path'] = $path;
    $config['allowed_types'] = 'gif|jpg|jpeg|png';
    $config['max_size'] = '4096';
    $config['overwrite'] = false;
    $config['max_width'] = '2048';
    $config['max_height'] = '2048';
    $config['encrypt_name'] = true;
    $config['remove_spaces'] = true;
    $this->load->library('upload', $config);
    $this->upload->initialize($config);
    if ($this->upload->do_upload($file)) {
        $data = $this->upload->data();
    } else {
        $data = "";
    }

    return $data;
}

function uploadPdf($file, $path)
{
    unset($config);
    $config['upload_path'] = $path;
    $config['allowed_types'] = '*';
    $config['max_size'] = '4048';
    $config['overwrite'] = false;
    $config['max_width'] = '4048';
    $config['max_height'] = '4048';
    $config['encrypt_name'] = true;
    $config['remove_spaces'] = true;
    $this->load->library('upload', $config);
    $this->upload->initialize($config);
    if ($this->upload->do_upload($file)) {
        $data = $this->upload->data();
    } else {
        $data = "";
    }

    return $data;
}


public function getStringAfter(Exception $e, $string)
{
    $split = preg_split('/' . $string . '/', strtolower($e->getMessage()));
    $needleSection = array();
    if (count($split) > 1) {
        $needleSection = explode(' ', $split[1]);
    }
    return $needle = str_replace($this->remove("`", "'", "(", ")", "\nwhere", "."), "", $needleSection[1]);
}

public function remove($arg)
{
    $remove = array();
    foreach (func_get_args() as $ch) {
        $remove[] = $ch;
    }

    return $remove;
}


public function fieldMessage($field, $message)
{
    return array("result" => "error", "fields" => array($field => $message));
}

public function message($message)
{
    return array('message' => $message);
}


public function getWebsite($json, $typeId = '')
{
    if ($typeId != '') {
        $site = $this->CardTypeModel->getSite($typeId);
        if ($json) {
            echo json_encode($site);
        }
        return $site;
    }
}


function allow($allow, ...$args)
    {
        $this->checkRoles($allow, $args);
    }

    public function checkRoles($allow, ...$args)
    {
        $roles = $args[0];

        if (!$this->userId and !in_array("all", $roles)) {
            redirect('member', 'location');
        }

//        if (!$this->roleName) {
//            redirect('member', 'location');
//        }

        if (in_array("all", $roles)) {
            return;
        }

        if ($allow) {
            if (!in_array($this->roleName, $roles)) {
                redirect('administrator', 'location');
            }
        } else {
            if (in_array($this->roleName, $roles)) {
                redirect('administrator', 'location');
            }
        }
    }

    function addUserNotes($userId)
    {
        $this->UserModel->addUserNotes($this->userId, $userId, $_POST['note_validate']);
        redirect(ADMIN_PATH . "user/user/" . $userId);
    }


    function addProspectNotes($prospect)
    {
        $this->UserModel->addProspectNotes($this->userId, $prospect, $_POST['note']);
        redirect(ADMIN_PATH . "prospect/prospect/" . $prospect);
    }


}
