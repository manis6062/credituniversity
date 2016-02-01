<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Content extends AdminController
{


    public function __construct()
    {
        parent::__construct(CLIENT, BROKER, ADMIN);
        $this->load->helper('general');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('path');
        $this->load->helper('string');
        $this->load->model('ContentModel');
    }

    public function index()
    {
        $data['title'] = 'content';
        $data['contents'] = $this->ContentModel->getContents();
        $data['main_content'] = ADMIN_PATH . "contents";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }


    public function loadTip($id)
    {
        $data['title'] = 'Monthly Tips';
        $data['role'] = $this->roleName;
        $data['monthly_tips'] = $this->ContentModel->getMonthlyTipsWithId($id);
        $data['main_content'] = ADMIN_PATH . "load_tip";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    public function loadPdf($id)
    {
        $data['title'] = 'PDF BOOKS';
        $data['role'] = $this->roleName;
        $data['pdf_books'] = $this->ContentModel->getPdfWithId($id);
        $data['main_content'] = ADMIN_PATH . "load_pdf";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    public function funding($id)
    {
        $data['title'] = 'FUNDING';
        $data['funding'] = $this->ContentModel->getFundingWithId($id);
        $data['main_content'] = ADMIN_PATH . "funding";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }


    function uploadPdf($file, $path)
    {
        unset($config);
        $config['upload_path'] = $path;
        $config['allowed_types'] = '*';
        $config['max_size'] = '4048';
        $config['overwrite'] = true;
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

    public function whatAreTradelines($id)
    {
        $data['content'] = $this->ContentModel->getContentWithId($id);
        $data['main_content'] = ADMIN_PATH . "whatAreTradelines";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    public function tradelineBenefits($id)
    {
        $data['content'] = $this->ContentModel->getContentWithId($id);
        $data['main_content'] = ADMIN_PATH . "tradelineBenefits";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function pdfContents()
    {
        $data['title'] = 'Contents ';
        $data['role'] = $this->roleName;
        $data['contents'] = $this->ContentModel->getAllContents();
        $data['main_content'] = ADMIN_PATH . "pdf_content";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function pdfContentsOnly($pdf)
    {
        $data['title'] = 'Contents ';
        $data['role'] = $this->roleName;
        $data['contents'] = $this->ContentModel->getPdfContentsOnly($pdf);
        $data['main_content'] = ADMIN_PATH . "pdf_contents";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function monthlyTipsOnly($monthlyTips)
    {
        $data['title'] = 'Contents ';
        $data['role'] = $this->roleName;
        $data['contents'] = $this->ContentModel->getMonthlyTipsOnly($monthlyTips);
        $data['main_content'] = ADMIN_PATH . "monthly_tips";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }


    function contentForm()
    {
        $data['title'] = 'content';
        $data['action'] = 'Add';
        $data['main_content'] = ADMIN_PATH . 'contentForm';
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function contentPdfForm()
    {
        $data['title'] = 'Contents';
        $data['action'] = 'Add';
        $data['main_content'] = ADMIN_PATH . 'content_pdfForm';
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }


    function addContent()
    {
        $this->ContentModel->insert();
        $this->session->set_flashdata("su_message", "Content Added Successfully.");
        redirect(ADMIN_PATH . "content");
    }

    function addMonthlyTips()
    {
        if ($_FILES['file']['name']) {
            $file = $this->uploadPdf('file', "uploads/pdf_content/");
            if ($file == "") {
                $this->session->set_flashdata('message', json_encode(strip_tags($this->upload->display_errors())));
                redirect(ADMIN_PATH . "content/contentPdfForm");
            } else {
                $file_name = $file['file_name'];
                try {
                    $this->ContentModel->insertMonthlyTips($file_name);
                } catch (Exception $e) {
                    echo json_encode($this->handleDatabaseError($e));
                    return;
                }
                redirect(ADMIN_PATH . "content/pdfContents");
            }
        }
    }


    function editMonthlyTips()
    {
        $oldFilePath = 'uploads/pdf_content/' . $this->input->post('old_file_name');
        try {
            unlink($oldFilePath);
        } catch (Exception $e) {
        }
        if ($_FILES['file']['name']) {
            $newFile = $this->uploadPdf('file', "uploads/pdf_content/");
            if ($newFile == "") {
                $this->session->set_flashdata('message', json_encode(strip_tags($this->upload->display_errors())));
            } else {
                $newFileName = $newFile['file_name'];
                $this->ContentModel->updateMonthlyTips($newFileName, $this->input->post('old_file_id'));
            }
            redirect(ADMIN_PATH . "content/pdfContents");

        }
    }


    function deleteMonthlyTips($fileId, $fileName)
    {
        $oldFilePath = 'uploads/pdf_content/' . $fileName;
        try {
            unlink($oldFilePath);
        } catch (Exception $e) {
        }
        $this->ContentModel->deleteMonthlyTips($fileId);
        redirect(ADMIN_PATH . "content/pdfContents");
    }


    function deletePdfBooks($fileId, $fileName)
    {
        $oldFilePath = 'uploads/pdf_content/' . $fileName;
        try {
            unlink($oldFilePath);
        } catch (Exception $e) {
        }
        $this->ContentModel->deletePdfBooks($fileId);
        redirect(ADMIN_PATH . "content/pdfContents");
    }


    function Content($content_id)
    {
        $data['title'] = 'content';
        $data['action'] = 'update';
        $data['content'] = $this->ContentModel->getContent($content_id);
        $data['main_content'] = ADMIN_PATH . "content";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function updateAction()
    {
        $this->ContentModel->update($this->input->post('contentId'));
        $this->session->set_flashdata("su_message", "Content Updated Successfully.");
        redirect(ADMIN_PATH . "content");
    }

    function deleteContent($content_id)
    {
        if ($this->ContentModel->delete($content_id)) {
            $this->session->set_flashdata("su_message", "Content Deleted Successfully.");
        }
        redirect(ADMIN_PATH . "content");
    }

    function monthlyTips_list()
    {
        $data['title'] = 'Monthly Tips';
        $data['tips'] = $this->ContentModel->getMonthlyTipsOnly('monthly_tips');
        $data['main_content'] = ADMIN_PATH . "monthlyTips_list";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }


}

?>