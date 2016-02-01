<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Owner extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->form_validation->set_error_delimiters('<div class="red">', '</div>');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('security');
        // if ( $this->input->post( 'remember' ) ) // set sess_expire_on_close to 0 or FALSE when remember me is checked.
        // $this->config->set_item('sess_expire_on_close', '0'); // do change session config
        //
        // $this->load->library('session');
    }


    public function index($code = '')
    {
        $data['main_content'] = 'login';
        $this->load->view('inc/registration', $data);
    }

    public function carddetails($code)
    {
        $data['code'] = $code;
        $data['title'] = "Card Details";
        $data['main_content'] = 'ownercarddetails_view.php';
        $this->load->view('inc/registration', $data);
    }

    public function insert()
    {
        $cardtype = $_POST['cardtype'];
        $bank = $_POST['bank'];
        $cardnumber = $_POST['cardnumber'];
        $exp_date = $_POST['exp_date'];
        $credit_limit = $_POST['credit_limit'];
        $credit_selling_limit = $_POST['credit_selling_limit'];
        // $code = $this->uri->segment(3);
        $code = $_POST['code'];
        $allcarddetails = $this->LineModel->insertCardDetails($code, $cardtype, $bank, $cardnumber, $exp_date, $credit_limit, $credit_selling_limit);
        $html = "";
        $html .= "<table class='table table-bordered' id='cardsdetailtable' >";
        $html .= "<thead><th class='smalll'>#</th><th class='largee'>Card Type</th><th class='largee'>Issued Bank</th><th class='largee'>Card Number</th><th class='largee'>Card Credit Limit</th><th class='largee'>Card Credit Selling Limit</th></thead>";
        if (!empty($allcarddetails)) {
            $i = 1;
            foreach ($allcarddetails as $values) {
                $html .= "<tr>";
                $html .= "<td class='smalll'>" . $i . "</td>";
                $html .= "<td class='largee'>" . $values->type_id . "</td>";
                $html .= "<td class='largee'>" . $values->card_issuing_bank . "</td>";
                $html .= "<td class='largee'>" . $values->card_number . "</td>";
                $html .= "<td class='largee'>" . $values->expiration_date . "</td>";
                $html .= "<td class='largee'>" . $values->card_limit . "</td>";
                $html .= "<td class='largee'>" . $values->card_selling_limit . "</td>";
                $html .= "</tr>";
                $i++;
            }
        }
        $html .= "</table>";
        echo $html;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

