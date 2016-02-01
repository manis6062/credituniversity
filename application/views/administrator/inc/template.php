<?php
$CI =& get_instance();
$CI->load->model('TaskModel');
$CI->load->model('CampaignModel');
$CI->load->model('CartModel');
$userId = $this->session->userdata(USER_ID);
$data['notification'] = $CI->TaskModel->getTasks($userId,'notification','AND status!= "complete"');
$data['uncompleted_tasks'] = $CI->TaskModel->getTasks($userId, 'task', 'AND status!="complete"');
$data['completed_tasks'] = $CI->TaskModel->getTasks($userId, 'task', 'AND status ="complete"');
$data['tasks'] = $CI->TaskModel->getTasks($userId, 'task', ' AND view="unread"');
$data['freeCampaign'] = $CI->CampaignModel->getTrailCampaign($userId);
$data['cartItemCount'] = $CI->CartModel->getTotalCartItemCount($userId);
$data['cartCount'] = $CI->CartModel->getCartTotal();

$this->load->view(ADMIN_PATH . 'inc/header_back.php', $data);
$this->load->view($main_content);
$this->load->view(ADMIN_PATH . 'inc/footer_back.php');