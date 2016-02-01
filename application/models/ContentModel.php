<?php

class ContentModel extends AdminModel
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('date');
        $this->load->library('email');
        $this->load->model('MembershipModel');
        $this->load->model('PaymentModel');
    }

    function getContents()
    {
        $this->db->select('*');
        $this->db->from('content');
        $this->db->order_by('content_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result();
        return 0;
    }


    function getAllContents()
    {
        $query = $this->db->query("SELECT value, file, short_name , name, sub_type ,description, id , module , sub_module  FROM files ORDER BY module DESC ")->result();
        return $query;

    }

    function getPdfContentsOnly()
    {
        $result = $this->db->query("SELECT *
                                            FROM files  WHERE module = 'pdf'  ")->result();
        return $result;
    }

    function getMonthlyTipsOnly($monthlyTips)
    {
        $result = $this->db->query("SELECT *
                                            FROM files  WHERE module = '$monthlyTips'  ")->result();
        return $result;
    }

    function getMonthlyTips($userId)
    {
        $memberships = $this->MembershipModel->getMemberships($userId);
        $result = '';
        foreach ((array)$memberships as $membership) {
            $append = '';
            if ($membership->role = 'client' and ($membership->type == "yearly" or $membership->type == "yearly_recurring") and ($membership->end_date > date("m/d/y"))) {
                $append = '';
            } else if (($membership->type == "monthly" or $membership->type == "monthly_recurring") and ($membership->end_date > date("m/d/y"))) {
                $count = $this->PaymentModel->getTransactionCount($userId);
                $append = "AND f.value <= '$count'";
            }
            $result = $this->db->query("SELECT f.value, f.short_name , f.file, f.name, f.description, f.id , f.module
                                            FROM files f WHERE f.module = 'monthly_tips'  $append")->result();
        }

        return $result;

    }

    function getPdf()
    {
        return $this->db->query("SELECT f.value, f.short_name , f.file, f.name, f.description, f.id ,f.module FROM files f WHERE f.module = 'pdf'")->result();
    }

    function getContentWithModuleName($moduleName)
    {
        return $this->db->query("SELECT f.id, f.short_name , f.name, f.file FROM files f WHERE f.module = '$moduleName'")->row();
    }

    function getContentWithId($id)
    {
        return $this->db->query("SELECT f.id, f.name, f.short_name ,f.file, f.description FROM files f WHERE f.id = '$id'")->row();
    }

    function getPdfWithId($id)
    {
        $pdfBooks = $this->db->query("SELECT f.value, f.short_name , f.file, f.name, f.description, f.id FROM files f WHERE f.module = 'pdf' and id = $id")->row();
        return $pdfBooks;

    }

    function getFundingWithId($id)
    {
        return $this->db->query("SELECT f.value, f.short_name , f.file, f.name, f.description, f.id FROM files f WHERE f.module = 'fund' and id = $id")->row();
    }


    function getMonthlyTipsWithId($id)
    {
        $monthly_tips = $this->db->query("SELECT f.value, f.file, f.short_name ,f.name, f.description, f.id FROM files f WHERE f.module = 'monthly_tips' and id = $id")->row();
        return $monthly_tips;

    }


    function insert()
    {
        $data = array(
            'content_title' => $this->input->post('content_title'),
            'content_description' => $this->input->post('content_description')
        );
        $this->db->insert('content', $this->security->xss_clean($data));
        return $this->db->insert_id();
    }
    function update($id)
    {
        $data=array(
            'content_title' =>$this->input->post('question'),
            'content_description' =>$this->input->post('answer')
        );
        $this->db->where('content_id', $id);
        $this->db->update('content', $this->security->xss_clean($data));
    }

    function insertMonthlyTips($file_name)
    {

        $module = $this->input->post('module');

        if ($module == 'monthly_tips') {
            $data = array(
                'module' => $this->input->post('module'),
                'file_type' => 'application/pdf',
                'name' => $this->input->post('content_title'),
                'short_name' => $this->input->post('short_content_title'),
                'description' => $this->input->post('description'),
                'value' => $this->formatDate($this->input->post('value')),
                'file' => $file_name,
                'sub_module' => $this->input->post('sub_module')
            );
        } elseif ($module == 'pdf') {
            $data = array(
                'module' => $this->input->post('module'),
                'file_type' => 'application/pdf',
                'name' => $this->input->post('content_title'),
                'short_name' => $this->input->post('short_content_title'),
                'description' => $this->input->post('description'),
                'file' => $file_name,
                'sub_type' => $this->input->post('sub_type'),
            );
        } else {
            $data = array(
                'module' => $this->input->post('module'),
                'file_type' => 'application/pdf',
                'name' => $this->input->post('content_title'),
                'short_name' => $this->input->post('short_content_title'),
                'description' => $this->input->post('description'),
                'file' => $file_name
            );
        }


        $this->db->insert('files', $this->security->xss_clean($data));
        return $this->db->insert_id();
    }

    function insertPdf($file_name)
    {
        $data = array(
            'module' => 'pdf',
            'file_type' => 'application/pdf',
            'name' => $this->input->post('content_title'),
            'short_name' => $this->input->post('short_content_title'),
            'description' => $this->input->post('description'),
            'file' => $file_name
        );
        $this->db->insert('files', $this->security->xss_clean($data));
        return $this->db->insert_id();
    }


    function updateMonthlyTips($newFile, $oldFileId)
    {
        $data = array(
            'file' => $newFile
        );
        $this->db->where('id', $oldFileId);
        $this->db->update('files', $this->security->xss_clean($data));
    }

    function updatePdf($newFile, $oldFileId)
    {
        $data = array(
            'file' => $newFile
        );
        $this->db->where('id', $oldFileId);
        $this->db->update('files', $this->security->xss_clean($data));
    }


    function deleteMonthlyTips($fileId)
    {
        $data = array(
            'id' => $fileId
        );
        $this->db->delete('files', $this->security->xss_clean($data));
    }

    function deletePdfBooks($fileId)
    {
        $data = array(
            'id' => $fileId
        );
        $this->db->delete('files', $this->security->xss_clean($data));
    }

    function getContent($id)
    {
        $this->db->select('*');
        $this->db->from('content');
        $this->db->where('content_id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->row();
        return 0;
    }

    function delete($id)
    {
        $this->db->where('content_id', $id);
        $this->db->delete('content');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        }
        return FALSE;
    }

    ## end backend


    function countAll($cond)
    {
        $this->db->where($cond);
        $query = $this->db->get("content");

        return $query->num_rows();
    }

    function getAll()
    {
        $this->db->select('*');
        $this->db->from('content');
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result();
        return 0;
    }

    function getAllActive()
    {

        $this->db->select('*');
        $this->db->from('content');
        $array = array('content_status' => 'Yes', 'crtd_by' => $this->session->userdata(USER_ID));
        $this->db->where($array);
        $query = $this->db->get();

        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }

    function getAdminDetails($user_id)
    {
        $query = $this->db->query("SELECT c.content_id, c.content_title, c.content_description, c.content_status, c.created_by, c.created_date, c.updated_by, c.updated_date, c.updated_count
										FROM content AS c WHERE c.content_id = " . $user_id);

        if ($query->num_rows() == 0) {
            return 0;
        } else {
            return $query->row();
        }
    }

    function getDetails($module)
    {
        //$query = $this->db->get_where('content', array('content_id' => $user_id));
        $query = $this->db->query("SELECT
        							content.content_id,
        							content.content_title,
									content.content_description
									FROM
									content
									INNER JOIN menu ON content.content_id = menu.content_id
									INNER JOIN module ON menu.menu_module = module.ID
									WHERE
									module.module_controller = '$module'");

        if ($query->num_rows() == 0) {
            return 0;
        } else {
            return $query->row();
        }
    }


    function countMonthlyTipsWithTransaction($user_id)
    {
        return $this->db->query("Select count(t.user_id) count from user_role ur
                   LEFT JOIN transaction t on ur.user_id = t.user_id
                   where ur.role_id = '2' and t.transaction_type = 'registration' and t.`status` = 'Completed'
                 and ur.user_id = '$user_id'")->row();

    }


    function updateStatus($id, $value)
    {
        $data = array('content_status' => $value);

        $this->db->where("content_id", $id);
        $this->db->update('content', $this->security->xss_clean($data));
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }
        return FALSE;
    }


    function getHomeContent()
    {
        $query = $this->db->query("SELECT id FROM module WHERE module_controller = 'home'");
        $module_id = $query->row()->id;
        $qry = $this->db->query("select c.* from menu as m inner join content as c on m.content_id = c.content_id where menu_module = $module_id");
        if ($qry->num_rows() > 0) {
            return $qry->row();
        }
        return 0;
    }

    function getSubTip()
    {
        $row = $this->db->query("SHOW COLUMNS FROM files LIKE 'sub_module'")->row()->Type;
        $regex = "/'(.*?)'/";
        preg_match_all($regex, $row, $enum_array);
        $enum_fields = $enum_array[1];
        foreach ($enum_fields as $key => $value) {
            $enums[$value] = $value;
        }
        return $enums;
    }

}

?>