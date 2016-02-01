<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Portfolio extends CI_Controller
{
    private $allowed = array();
    private $errors = "";
    private $rules = array(
        array
        (
            'field' => 'link',
            'label' => 'Link',
            'rules' => 'trim|required|callback_url_checking',
        ),
        array(
            'field' => 'title',
            'label' => 'Title',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'category',
            'label' => 'Category',
            'rules' => 'trim|required|xss_clean'
        ),
    );

    public function __construct()
    {
        parent::__construct();
        checkAdminAuth();
        // Your own constructor code
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->form_validation->set_error_delimiters('<div class="red">', '</div>');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('path');
        $this->allowed = $this->AuthModel->getAuth();
    }

    public function url_checking($str)
    {

        $pattern = "/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i";
        if (!preg_match($pattern, $str)) {
            $this->form_validation->set_message('url_checking', 'The URL you entered is not correctly formatted.');
            return FALSE;
        }

        return TRUE;
    }

    public function index()
    {
        $this->show($page = '');
    }

    function show($page = '')
    {
        if (in_array('portfolio_view', $this->allowed)) {
            $data['portfolioList'] = $this->PortfolioModel->getAll();
            $data['allowed'] = $this->allowed;
            $data['error'] = $this->errors;
            $data['title1'] = "Add Portfolio";
            $data['title'] = "List Portfolio";
            $data['main_content'] = ADMIN_PATH . "portfolio_view";
            $this->load->view(ADMIN_PATH . 'incs/template', $data);
        }
    }

    function deleteAction($id)
    {
        if (in_array('portfolio_delete', $this->allowed)) {
            if ($this->PortfolioModel->delete($id)) {
                $this->session->set_flashdata("su_message", "Portfolio Deleted Successfully.");
            }
        } else {
            $this->session->set_flashdata("su_message", "You Have No Permission To Delete This Record");
        }

        redirect(ADMIN_PATH . "portfolio");
    }

    function add()
    {
        if (in_array('portfolio_add', $this->allowed)) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules($this->rules);
            if ($this->form_validation->run($this) == FALSE) {
                $this->show();
            } else {
                $photo = TRUE;
                $ph = "";
                $path = "";
                $pic = "";
                $path = PORTFOLIO_IMAGE_PATH;

                if ($_FILES['path']['name']) {
                    $uploaded_details = $this->upload('path', "$path");

                    if ($uploaded_details == "") {
                        $error = array('error' => $this->upload->display_errors('<p>', '</p>'));
                        //$this->form_validation->set_message('Basic Document', "error");
                        $this->errors = $error;

                        $photo = false;
                    } else {
                        $ph = $uploaded_details['file_name'];
                    }
                }
                if ($photo) {
                    $this->PortfolioModel->insert($ph);

                    $this->session->set_flashdata("su_message", "Portfolio Added Successfully.");
                    redirect(ADMIN_PATH . 'portfolio');
                } else {
                    $this->show();
                }
            }
        } else {
            $this->session->set_flashdata("su_message", "You don't have the permission to add new portfolio.");
            redirect(ADMIN_PATH . 'portfolio');
        }
    }

    function update()
    {
        if (in_array('portfolio_update', $this->allowed)) {
            if ($this->form_validation->run('portfolio_add') == FALSE) {
                $this->updateAction($this->input->post('id'));
            } else {
                $photo = TRUE;

                $ph = "";
                $oldph = $this->input->post('old_image');
                $path = "";

                $path = PORTFOLIO_IMAGE_PATH;
                if ($_FILES['path']['name']) {
                    $uploaded_details = $this->upload('path', "$path");

                    if ($uploaded_details == "") {
                        $error = array('error' => $this->upload->display_errors('<p>', '</p>'));
                        //$this->form_validation->set_message('Basic Document', "error");
                        $this->errors = $error;

                        $photo = FALSE;
                    } else {
                        $ph = $uploaded_details['file_name'];
                    }
                }
                if ($photo) {

                    if ($ph != "") {
                        $this->removeFile($oldph, $path);
                    } else {
                        $ph = $oldph;
                    }
                    $this->PortfolioModel->update($this->input->post('id'), $ph);

                    $this->session->set_flashdata("su_message", "Portfolio Updated Successfully.");
                    redirect(ADMIN_PATH . 'portfolio');
                } else {
                    $this->updateAction($this->input->post('id'));
                }
            }
        } else {
            redirect(ADMIN_PATH . "portfolio");
        }
    }

    function updateAction($user_id)
    {
        if (in_array('portfolio_update', $this->allowed)) {
            $data['portfolioList'] = $this->PortfolioModel->getAll();
            $data['photoRecord'] = $this->PortfolioModel->getAdminDetails($user_id);
            $data['allowed'] = $this->allowed;
            $data['error'] = $this->errors;
            $data['title1'] = "Update Portfolio";
            $data['title'] = "List Portfolio";
            $data['main_content'] = ADMIN_PATH . "portfolio_view";
            $this->load->view(ADMIN_PATH . 'incs/template', $data);
        }
    }

    function upload($file, $path)
    {
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '1024';
        $config['overwrite'] = false;

        $config['max_width'] = '0';
        $config['max_height'] = '0';
        $config['encrypt_name'] = true;
        $config['remove_spaces'] = true;

        $this->load->library('upload', $config);
        if ($this->upload->do_upload($file)) {
            //$data = $this->upload->data();
            //Image Resizing
            $config['image_library'] = 'gd2';
            $config['source_image'] = $this->upload->upload_path . $this->upload->file_name;
            $config['new_image'] = $path;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 660;
            $config['height'] = 251;
            $this->load->library('image_lib', $config);
            if ($this->image_lib->resize()) {
                $data = $this->upload->data();
            } else {
                $data = "";
            }
        } else {
            $data = "";
        }

        return $data;
    }

    function removeFile($file, $path)
    {

        if (file_exists($path . $file) && $file != "") {
            if (unlink($path . $file)) {
                return true;
            }
        }
        return FALSE;
    }

}

?>