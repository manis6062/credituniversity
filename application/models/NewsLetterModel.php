<?php

class NewsletterModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('date');
        $this->load->library('email');

    }


    function getAll()
    {
        $query = $this->db->query("SELECT nt.*, ct.label campaign_type,  c.name campaign_name
                                    FROM newsletter_template nt
                                    LEFT JOIN campaign c ON c.id = nt.campaign_id
                                    LEFT JOIN campaign_type ct on ct.id = c.type
                                    WHERE nt.template_type='newsletter'
                                    ORDER BY id ASC");
        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }


    function getAllWelcomeLetter()
    {
        $query = $this->db->query("SELECT *
                                    FROM newsletter_template   WHERE template_type='welcome'                                
                                    ORDER BY id ASC");
        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }


    function getAllSubscribers()
    {
        $query = $this->db->query("SELECT n.* , s.* , nt.* , (SELECT n.id ) AS news_id ,(SELECT CONCAT_WS(' ',first_name,middle_initial,last_name) FROM profile WHERE user_id = n.user_id) AS first_name
                                    FROM newsletter n
                                    LEFT JOIN subscribe s ON n.subscriber_id = s.id
                                    LEFT JOIN newsletter_template nt ON n.newsletter_id = nt.id ORDER BY n.id DESC");
        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }

    function getSubscribers()
    {
        $query = $this->db->query("SELECT * FROM subscribe ");
        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }


    function getTemplate($tid)
    {
        $query = $this->db->query("SELECT code FROM newsletter_template WHERE id = '$tid'");
        if ($query->num_rows() > 0)
            return $query->row()->code;

        return 0;
    }


    function getWelcomeLetter($tid)
    {
        $query = $this->db->query("SELECT code FROM newsletter_template WHERE  id = '$tid'");
        if ($query->num_rows() > 0)
            return $query->row()->code;

        return 0;
    }

    function getWelcomeLetterTemplate($id)
    {
        $query = $this->db->query("SELECT * FROM newsletter_template  WHERE id = '$id'");

        if ($query->num_rows() > 0)
            return $query->row();

        return 0;
    }


    function getWelcomeLetterByShortCode($short_code)
    {
        $query = $this->db->query("SELECT code FROM newsletter_template  WHERE short_code = '$short_code'");

        if ($query->num_rows() > 0)
            return $query->row()->code;

        return 0;
    }

    function getNewsTemplate($id)
    {
        $query = $this->db->query("SELECT nt.*, (select concat_ws(' - ', c.type, c.name) from campaign c where id = nt.campaign_id) campaign_name FROM newsletter_template nt WHERE id = '$id'");

        if ($query->num_rows() > 0)
            return $query->row();

        return 0;
    }


    function getSubscibers($subscribers_id)
    {
        $query = $this->db->query("SELECT subscriber FROM subscribe WHERE id = '$subscribers_id'");
        if ($query->num_rows() > 0)
            return $query->row()->subscriber;

        return 0;
    }


    function deleteTemplate($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('newsletter_template');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        }
        return FALSE;
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('newsletter');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        }
        return FALSE;
    }


    function insert()
    {
        $today = date("Y-m-d H:i:s");
        $data = array(
            'title' => $this->input->post('title'),
            'code' => $this->input->post('code'),
            'created_date' => $today
        );
        $this->db->insert('newsletter_template', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }


    function insertWelcomeLetter()
    {
        $today = date("Y-m-d H:i:s");
        $data = array(
            'title' => $this->input->post('title'),
            'short_code' => $this->input->post('short_code'),
            'code' => $this->input->post('code'),
            'template_type' => 'welcome',
            'created_date' => $today
        );
        $this->db->insert('newsletter_template', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function updateWelcomeLetter($code, $id)
    {
        $today = date("Y-m-d H:i:s");
        $data = array(
            'code' => $code,
            'updated_date' => $today
        );
        $this->db->where('id', $id);
        $this->db->update('newsletter_template', $data);

    }


    function updateNewsletter()
    {
        $data = array(
            'code' => $this->input->post('code')
        );
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('newsletter_template', $data);
    }

    function insertSubscribers()
    {
        $today = date("Y-m-d H:i:s");
        $data = array(
            'subscriber' => $this->input->post('subscribe'),
            'date' => $today
        );
        $this->db->insert('subscribe', $this->security->xss_clean($data));
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        }
        return FALSE;
    }

    function insertNewsletter($subject, $template, $email)
    {
        $receiver_id = $this->UserModel->getUserIdFromEmailAddress($email);
//        $values = array_shift($receiver_id);
        $today = date("Y-m-d H:i:s");
        $data = array(
            'user_id' => $receiver_id,
            'newsletter_id' => $template,
            'subject' => $subject,
            'sent_date' => $today
        );
        $this->db->insert('newsletter', $this->security->xss_clean($data));

    }


    function getUserIdFromEmail($id)
    {
        $query = $this->db->query("SELECT id , email FROM user WHERE id = '$id'");
        if ($query->num_rows() > 0)
            return $query->row()->email;
        return 0;
    }

    function getCampaignId($newletterId)
    {
        return $this->db->query("select * from campaign c where c.id = (select nt.campaign_id from newsletter_template nt where nt.id = '$newletterId')")->row()->id;
    }
}

?>