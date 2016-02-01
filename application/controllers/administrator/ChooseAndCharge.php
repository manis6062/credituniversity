<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ChooseAndCharge extends AdminController
{


    public function __construct()
    {
        parent::__construct(BROKER, ADMIN);
        $this->load->helper('general');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('path');
        $this->load->helper('string');

    }


    public function index()
    {
        $data['main_content'] = ADMIN_PATH . "choosencharge_view";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

}

?>

<!----------------------------------Old Code--------------------------------------------------------!>

<?php
//if (!defined('BASEPATH'))
//    exit('No direct script access allowed');
//
//class Chooseandcharge extends CI_Controller {
//    private $allowed = array();
//    private $errors = "";
//    public function __construct() {
//        parent::__construct();
//        checkAdminAuth();
//        // Your own constructor code
//        $this -> load -> library('form_validation');
//        $this -> load -> library('pagination');
//        $this -> form_validation -> set_error_delimiters('<div class="red">', '</div>');
//        $this -> load -> helper(array('form', 'url'));
//        $this -> load -> helper('path');
//		$this->load->helper('general');
//        $this->load->helper('security');
//        //$this->load->model('auth_master_model');
//        //$this->load->model('user_auth_model');
//        $this -> allowed = $this -> AuthMasterModel -> getAuth();
//    }
//
//    public function index() {
//        $this -> show($page = '');
//    }
//
//	function validurl($str)
//    {
//        $pattern = "/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i";
//        if (!preg_match($pattern, $str))
//        {
//        	$this->form_validation->set_message('validurl', 'Website Url not valid');
//            return FALSE;
//        }
//		return true;
//    }
//
//    function show($page = '') {
//            $data['chooseList'] = $this -> ChooseAndChargeModel -> getAll();
//            $data['allowed'] = $this -> allowed;
//            $data['error'] = $this -> errors;
//			$data['usertype'] = checkUserType();
//			$data['states'] = $this->ChooseAndChargeModel -> getAllState();
//            $data['title1'] = "Add Choose And Charge";
//            $data['title'] = "List Choose And Charge";
//            $data['main_content'] = ADMIN_PATH . "choosencharge_view";
//            $this -> load -> view(ADMIN_PATH . 'incs/template', $data);
//    }
//
//    function deleteAction($c_id) {
//            if ($this -> ChooseAndChargeModel -> delete($c_id)) {
//                $this -> session -> set_flashdata("su_message", "Row Deleted Successfully.");
//            }
//        redirect(ADMIN_PATH . "chooseandcharge");
//    }
//
//    function add() {
//            if ($this -> form_validation -> run('choose_add') == FALSE) {
//                $this -> show();
//            } else {
//                    if($this -> ChooseAndChargeModel -> insert()){
//                    ///$userauth=new User_auth_model();
//                    //$userauth->add($this->input->post('user_id'));
//
//                    	$this -> session -> set_flashdata("su_message", "Row Added Successfully.");
//					}else{
//						$this -> session -> set_flashdata("su_message", "Error while adding row.");
//					}
//                    redirect(ADMIN_PATH . "chooseandcharge");
//            }
//    }
//
//    function update() {
//            if ($this -> form_validation -> run('choose_add') == FALSE) {
//                $this -> updateAction($this -> input -> post('c_id'));
//            } else {
//                   	if($this -> ChooseAndChargeModel -> update($this -> input -> post('c_id'))){
//                    	$this -> session -> set_flashdata("su_message", "Row Updated Successfully.");
//				   	}else{
//				   		$this -> session -> set_flashdata("su_message", "Error while updating row.");
//				   	}
//                    redirect(ADMIN_PATH . "chooseandcharge");
//            }
//    }
//
//    function updateAction($c_id) {
//            $data['chooseList'] = $this -> ChooseAndChargeModel -> getAll();
//            $data['photoRecord'] = $this -> ChooseAndChargeModel -> getAdminDetails($c_id);
//            $data['states'] = $this->ChooseAndChargeModel -> getAllState();
//            $data['allowed'] = $this -> allowed;
//			$data['usertype'] = checkUserType();
//            $data['error'] = $this -> errors;
//            $data['title1'] = "Update Choose And Charge";
//            $data['title'] = "List Choose And Charge";
//            $data['main_content'] = ADMIN_PATH . "choosencharge_view";
//            $this -> load -> view(ADMIN_PATH . 'incs/template', $data);
//    }
//
//}
//?>