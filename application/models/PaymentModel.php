<?php

class PaymentModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('date');
        $this->load->library('email');
        $this->load->helper('security');
        $this->load->model('UserModel');
        $this->load->model('TaskModel');
    }

    public function getTransactionDetails($transactionId)
    {
        return $this->db->query("select * from transaction_details td where td.transaction_id = '$transactionId'")->row();
    }

    public function insertProfile()
    {
        $str = "insert profile here";
    }

    public function insertLineClient($lineId, $clientId, $price, $brokerPrice, $clientBrokerPrice, $months)
    {
        $data = array(
            'line_id' => $lineId,
            'client_id' => $clientId,
            'requested' => date('m/d/Y'),
            'owner_price' => $price,
            'owner_broker_price' => $brokerPrice,
            'client_broker_price' => $clientBrokerPrice,
            'no_month' => $months
        );
        $this->db->insert('line_client', $this->data($data));
    }

    public function getTransaction($paypalTransactionId)
    {
        return $this->db->query("select t.transaction_id, t.ipn_hit from transaction t where t.paypal_transaction_id = '$paypalTransactionId'")->row();
    }

    function data($string)
    {
        $data = array();
        if (is_array($string)) {
            foreach ($string as $key => $value) {
                if ($value or $value != null) {
                    $data[$key] = $value;
                }
            }
        }
        return $this->security->xss_clean($data);
    }

    public function insertTransaction($userId, $transactionType, $paypalTransactionId, $paypalId, $status, $transactionAmount, $paymentDate)
    {
        $paymentDate = date("Y-m-d", strtotime($paymentDate));
        $data = array(
            'payment_type' => 'paypal',
            'paypal_id' => $paypalId,
            'paypal_transaction_id' => $paypalTransactionId,
            'transaction_type' => $transactionType,
            'user_id' => $userId,
            'status' => $status,
            'agent' => 'ipn',
            'ipn_hit' => 1,
            'paypal_transaction_status' => $status,
            'paypal_transaction_amount' => $transactionAmount,
            'transaction_date' => $paymentDate,
            'due_date' => $paymentDate,
            'payment_date' => $paymentDate
        );
        $this->db->insert('transaction', $this->data($data));
        return $this->db->insert_id();
    }

    public function updateTransaction($userId, $transactionType, $paypalTransactionId, $paypalId, $status, $hit, $transactionAmount, $paymentDate, $transactionId)
    {
        $paymentDate = date("Y-m-d", strtotime($paymentDate));
        $data = array(
            'payment_type' => 'paypal',
            'paypal_id' => $paypalId,
            'transaction_type' => $transactionType,
            'user_id' => $userId,
            'status' => $status,
            'agent' => 'ipn',
            'ipn_hit' => $hit,
            'paypal_transaction_status' => $status,
            'paypal_transaction_amount' => $transactionAmount,
            'transaction_date' => $paymentDate,
            'due_date' => $paymentDate,
            'payment_date' => $paymentDate
        );
        $this->db->where("paypal_transaction_id", $paypalTransactionId);
        $this->db->or_where("transaction_id", $transactionId);
        $this->db->update('transaction', $this->data($data));
        return $transactionId;
    }

    public function insertTransactionDetails($transactionId, $item, $description, $price)
    {
        $data = array(
            'transaction_id' => $transactionId,
            'item' => $item,
            'description' => $description,
            'price' => $price
        );
        $this->db->insert('transaction_details', $this->data($data));
    }

    public function updateTransactionDetails($transactionId, $item, $description, $price)
    {
        $data = array(
            'item' => $item,
            'description' => $description,
            'price' => $price
        );
        $this->db->where('transaction_id', $transactionId);
        $this->db->update('transaction_details', $this->data($data));
    }

    public function updateMembership($userId, $membershipType, $role)
    {
        $endDate = '';
        $membership = $this->db->query("SELECT mc.name, mt.role FROM membership_type mt JOIN membership_cycle mc ON mc.id = mt.cycle where mt.id = '$membershipType'")->row();
        switch ($membership->name) {
            case "yearly":
            case "yearly_recurring":
                $endDate = date("Y/m/d", mktime(0, 0, 0, date("m"), date("d"), date("Y") + 1));
                break;
            case "monthly":
            case "monthly_recurring":
                $endDate = date("Y/m/d", mktime(0, 0, 0, date("m") + 1, date("d"), date("Y")));
                break;
        }
        $data = array(
            'user_id' => $userId,
            'type' => $membershipType,
            'role' => $membership->role,
            'start_date' => date("m/d/y"),
            'end_date' => $endDate,
            'status' => 1,
        );
        $this->db->where('user_id', $userId);
        $this->db->where('type', $membershipType);
        $this->db->update('membership', $this->data($data));
    }

    public function activateUser($userId)
    {
        $this->db->query("UPDATE user SET status = 1 WHERE id = '$userId'");
    }

    public function getTransactionCount($userId)
    {
        return $this->db->query("select count(*) count from transaction t where t.user_id = '$userId'")->row()->count;
    }

    function insertRecurringProfile($userId, $profileId, $dueDate){
        $data = array(
            'user_id' => $userId,
            'paypal_profile_id' => $profileId,
            'payment_date' => date("Y-m-d"),
            'payment_due_date' => $dueDate

        );
        $this->db->insert('recurring_profile', $this->data($data));
    }

    function insertInactiveTransaction($userId, $paymentType){
        $data = array(
            'payment_type' => $paymentType,
            'paypal_id' => '',
            'paypal_transaction_id' => '',
            'transaction_type' => 'registration',
            'user_id' => $userId,
            'status' => 'Pending',
            'agent' => '',
            'ipn_hit' => '',
            'paypal_transaction_status' => '',
            'paypal_transaction_amount' => '',
            'transaction_date' => '',
            'due_date' => date('Y-m-d'),
            'payment_date' => ''
        );
        $this->db->insert('transaction', $this->data($data));
        return $this->db->insert_id();
    }
    public function insertInactiveTransactionDetail($transactionId, $price)
    {
        $data = array(
            'transaction_id' => $transactionId,
            'item' => 1,
            'description' => '',
            'price' => $price
        );
        $this->db->insert('transaction_details', $this->data($data));
    }
}

?>