<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Banner extends AdminController
{

    public function __construct()
    {
        parent::__construct(ADMIN);
        $this->load->helper('general');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('path');
        $this->load->helper('string');
        $this->load->helper('security');
        $this->load->model('BannerModel');

    }

    public function index()
    {
        $data['banners'] = $this->BannerModel->getBanners();
        $data['title'] = "banner";
        $data['main_content'] = ADMIN_PATH . "banners";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }


    function bannerForm()
    {
        $data['title'] = 'banner';
        $data['action'] = 'add';
        $data['main_content'] = ADMIN_PATH . 'bannerForm';
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function addBanner()
    {
        $photo = TRUE;
        $ph = "";
        $path = "";
        if ($_FILES['path']['name']) {
            $path = BANNER_IMAGE_PATH;
            $uploaded_details = $this->upload('path', "$path");
            if ($uploaded_details == "") {
                $error = array('error' => $this->upload->display_errors('<p>', '</p>'));
                $this->errors = $error;
                $photo = false;
            } else {
                $ph = $uploaded_details['file_name'];
            }
        }

        if ($_FILES['mimage']['name']) {
            $path = BANNER_IMAGE_PATH;
            $uploaded_mimage = $this->upload('mimage', "$path");
            if ($uploaded_mimage == "") {
                $error = array('error' => $this->upload->display_errors('<p>', '</p>'));
                $this->errors = $error;
                $photo_mimage = false;
            } else {
                $mimage = $uploaded_mimage['file_name'];
            }
        }

        if ($_FILES['rimage']['name']) {
            $path = BANNER_IMAGE_PATH;
            $uploaded_rimage = $this->upload('rimage', "$path");
            if ($uploaded_rimage == "") {
                $error = array('error' => $this->upload->display_errors('<p>', '</p>'));
                $this->errors = $error;
                $photo_rimage = false;
            } else {
                $rimage = $uploaded_rimage['file_name'];
            }
        }

        if ($photo) {
            $this->BannerModel->insert($ph, $mimage, $rimage);
            $this->session->set_flashdata("su_message", "Banner Addded Successfully.");
            redirect(ADMIN_PATH . "banner");
        } else {
            $this->addBanner();
        }
    }

    function upload($file, $path)
    {
        unset($config);
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '1024';
        $config['overwrite'] = false;

        $config['max_width'] = '0';
        $config['max_height'] = '0';
        $config['encrypt_name'] = true;
        $config['remove_spaces'] = true;
        //$this->upload->initialize($config);
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload($file)) {
            $data = $this->upload->data();
        } else {
            $data = "";
        }

        return $data;
    }


    function deleteBanner($id)
    {
        $details = $this->BannerModel->getBanner($id);
        if ($this->BannerModel->deleteBanner($id)) {
            $path = BANNER_IMAGE_PATH;
            $this->removeFile($details->path, $path);
            $this->removeFile($details->mimage, $path);
            $this->removeFile($details->rimage, $path);
            $this->session->set_flashdata("su_message", "Banner Deleted Successfully.");
        } else {
            $this->session->set_flashdata("su_message", "<font color=\"#FF0000\">The Selected Banner Can't Be Deleted.</font>");
        }
        redirect(ADMIN_PATH . "banner");
    }

    function removeFile($file, $path)
    {
        if (file_exists($path . $file) && $file != "")
            unlink($path . $file);
    }

    function banner($id)
    {
        $data['title'] = 'Banner';
        $data['action'] = 'update';
        $data['banner'] = $this->BannerModel->getBanner($id);
        $data['main_content'] = ADMIN_PATH . "Banner";
        $this->load->view(ADMIN_PATH . 'inc/template', $data);
    }

    function updateBanner()
    {
        $photo = TRUE;
        $ph = "";
        $oldph = $this->input->post('old_image');
        $path = "";
        $path = BANNER_IMAGE_PATH;
        if ($_FILES['path']['name']) {
            $oldimg = $this->input->post('old_image');
            $uploaded_image = $this->upload('path', $path);
            if ($uploaded_image == "") {
                $error = array('error' => $this->upload->display_errors('<p>', '</p>'));
                $this->errors = $error;
                $photo = false;
            } else {
                $img = $uploaded_image['file_name'];
            }
        }

        if (@$img != "") {
            $this->removeFile($oldimg, $path);
        } else {
            $oldimg = $this->input->post('old_image');
            $img = $oldimg;
        }

        if ($_FILES['mimage']['name']) {
            $oldmimage = $this->input->post('old_mimage');
            $uploaded_mimage = $this->upload('mimage', $path);
            if ($uploaded_mimage == "") {
                $error = array('error' => $this->upload->display_errors('<p>', '</p>'));
                $this->errors = $error;
                $photo = false;
            } else {
                $mimage = $uploaded_mimage['file_name'];
            }
        }
        if (@$mimage != "") {
            $this->removeFile($oldmimage, $path);
        } else {
            $oldmimage = $this->input->post('old_mimage');
            $mimage = $oldmimage;
        }

        if ($_FILES['rimage']['name']) {
            $oldrimage = $this->input->post('old_rimage');
            $uploaded_rimage = $this->upload('rimage', $path);
            if ($uploaded_rimage == "") {
                $error = array('error' => $this->upload->display_errors('<p>', '</p>'));
                $this->errors = $error;
                $photo = false;
            } else {
                $rimage = $uploaded_rimage['file_name'];
            }
        }

        if (@$rimage != "") {
            $this->removeFile($oldrimage, $path);
        } else {
            $oldrimage = $this->input->post('old_rimage');
            $rimage = $oldrimage;
        }

        if ($photo) {
            $this->BannerModel->update($this->input->post('slider_id'), $img, $mimage, $rimage);
            $this->session->set_flashdata("su_message", "Banner Updated Successfully.");
            redirect(ADMIN_PATH . "banner");
        } else {
            $this->banner($this->input->post('slider_id'));
        }
    }

    function reOrder()
    {
        $this->BannerModel->reOrder($_POST['fromPosition'], $_POST['toPosition']);
    }


}

?>

