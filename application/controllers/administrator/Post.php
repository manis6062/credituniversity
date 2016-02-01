<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Post extends AdminController
{

    public function __construct()
    {
        parent::__construct(CLIENT, OWNER, BROKER, ADMIN, SUPER_ADMIN);
        $this->load->model('InlineModel');
    }

    public function index()
    {
        $primaryKeyValue = $_POST['pk'];
        $columnName = $_POST['name'];
        $columnValue = $_POST['value'];
        $table = $_POST['table'];
        $deleteKey = $_POST['deleteKey'];
        $this->InlineModel->addOrUpdate($table, $primaryKeyValue, $columnName, $columnValue, $deleteKey);
    }
}

?>