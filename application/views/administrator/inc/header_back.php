<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">

<head>
    <meta charset="UTF-8">
    <title>The Credit University | Dashboard </title>
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>backend/image/favicon-university.ico"/>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="robots" content="noindex, nofollow"/>
    <link href="<?php echo base_url(); ?>backend/docs/css/bootstrap-3.3.2.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url() ?>backend/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>backend/font-awesome-4.4.0/css/font-awesome.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo base_url(); ?>backend/css/ionicons.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>backend/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>backend/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>backend/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>backend/plugins/morris/morris.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>backend/css/cpn.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo base_url(); ?>backend/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>backend/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet"
          type="text/css"/>
    <link
        href="<?php echo base_url(); ?>backend/plugins/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min.css"
        rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"
          rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>backend/plugins/dataTables/media/css/dataTables.bootstrap.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo base_url() ?>backend/plugins/select2/select2.min.css" rel="stylesheet" type="text/css"/>

    <link href="<?php echo base_url() ?>backend/formvalidation-dist-v0.7.0/dist/css/formValidation.min.css"
          rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url() ?>backend/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script>
        var imagePath = '<?php echo base_url(); ?>';
    </script>

    <script src="<?php echo base_url(); ?>backend/docs/js/jquery-2.1.3.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/js/jquery-ui.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>backend/js/rowReordering.js" type="text/javascript"></script>

    <script src="<?php echo base_url(); ?>backend/docs/js/bootstrap-3.3.2.min.js" type="text/javascript"></script>
    <!--    <script src="--><?php //echo base_url(); ?><!--backend/js/jquery-ui.min.js"></script>-->
    <script src="<?php echo base_url(); ?>backend/formvalidation-dist-v0.7.0/dist/js/formValidation.min.js"></script>
    <script
        src="<?php echo base_url(); ?>backend/formvalidation-dist-v0.7.0/dist/js/framework/bootstrap.min.js"></script>

    <script type="text/javascript">
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="<?php echo base_url(); ?>backend/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/datatables/media/js/dataTables.bootstrap.min.js"></script>

    <!--[if lt IE 9]>
    <script src="<?php echo base_url(); ?>backend/js/html5shiv.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/js/respond.min.js"></script>
    <![endif]-->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <script src="<?php echo base_url(); ?>backend/js/raphael-min.js"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/morris/morris.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/sparkline/jquery.sparkline.min.js"
            type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"
            type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"
            type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/knob/jquery.knob.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>backend/js/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/daterangepicker/daterangepicker.js"
            type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/datepicker/bootstrap-datepicker.js"
            type="text/javascript"></script>
    <!--    <script-->
    <!--        src="-->
    <?php //echo base_url(); ?><!--backend/plugins/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.js"-->
    <!--        type="text/javascript"></script>-->
    <script src="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"
            type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/slimScroll/jquery.slimscroll.min.js"
            type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>backend/dist/js/app.min.js" type="text/javascript"></script>

    <script src="<?php echo base_url() ?>backend/js/md5.js"></script>
    <script src="<?php echo base_url() ?>backend/js/bootstrap-multiselect.js"></script>
    <script src="<?php echo base_url() ?>backend/bootstrap3-editable/js/bootstrap-editable.js"></script>
    <script src="<?php echo base_url() ?>backend/bootstrap3-editable/js/radiobutton.js"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/select2/select2.full.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/input-mask/jquery.inputmask.js"
            type="text/javascript"></script>
    <!--    <script src="-->
    <?php //echo base_url(); ?><!--backend/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>-->
    <script src="<?php echo base_url(); ?>backend/plugins/input-mask/jquery.inputmask.extensions.js"
            type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>backend/js/pdf.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>backend/js/jspdf.debug.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/ckeditor_4.5.2_full/ckeditor/ckeditor.js"
            type="text/javascript"></script>
    <link rel="stylesheet"
          href="<?php echo base_url(); ?>backend/plugins/ckeditor_4.5.2_full/ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/ckeditor_4.5.2_full/ckeditor/plugin.js">
    <script src="<?php echo base_url(); ?>backend/js/cpn.js" type="text/javascript"></script>


    <script src="<?php echo base_url(); ?>backend/plugins/fullcalendar/fullcalendar.js"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/fullcalendar/fullcalendar.min.js"></script>
    <link href="<?php echo base_url(); ?>backend/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>backend/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>backend/plugins/fullcalendar/fullcalendar.print.css" rel="stylesheet"
          type="text/css" media='print'/>
    <link href="<?php echo base_url() ?>frontend/css/responsive.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>backend/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="<?php echo base_url() ?>backend/js/bootstrap-toggle.min.js"></script>
    <link href="<?php echo base_url() ?>backend/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <script src="<?php echo base_url() ?>backend/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="<?php echo base_url() ?>backend/js/jquery.dataTables.columnFilter.js"></script>
    <style>
        .btn {
            border: 1px solid transparent;
            border-radius: 0;
            box-shadow: none;
        }
    </style>

</head>


<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">
    <header class="main-header">
        <a href="<?php echo base_url('administrator'); ?>" class="logo">
            <span class="logo-mini"><i class="fa fa-university"></i></span>
            <span class="logo-lg"><b>T</b>he<b>C</b>redit<b>U</b>niversity&nbsp; </span>
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
            <a href="" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>


            <div class="pull-left info" style="margin-top: 10px">
                <?php echo form_dropdown("roles", $this->session->userdata(ROLES), $this->session->userdata(ROLE_NAME), array('class' => 'form-control roles selectpicker show-tick'));
                $role = $this->session->userdata(ROLE_NAME);
                ?>
            </div>


            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <?php if ($this->session->userdata(ROLE_NAME) == 'client'): ?>

                        <li class="dropdown notifications-menu">
                            <a data-toggle="modal" href="<?php echo site_url(ADMIN_PATH . 'user/membershipUpgrade') ?>"
                               data-target="#membershipUpgrade">
                                <i class="fa fa-user-plus"></i>
                            </a>
                        </li>

                        <li class="dropdown notifications-menu">
                            <a href="<?php echo site_url(ADMIN_PATH . 'line/cart') ?>">
                                <i class="fa fa-shopping-cart"></i>
                                <?php $this->load->library('cart');; ?>
                                <span class="label label-warning"><?php echo $cartCount; ?></span>
                            </a>
                        </li>
                    <?php endif ?>
                    <?php
                    $this->load->model('EmailModel');
                    $user_id = $this->session->userdata(USER_ID);
                    $agentId = $this->session->userdata(BROKER_ID);
                    $data['receivedEmails'] = $this->EmailModel->received_emails($user_id);
                    $data['count_receivedEmails'] = $this->EmailModel->countAllReceivedItems($user_id);
                    $this->session->set_userdata(INBOX, $data['receivedEmails']);
                    $this->session->set_userdata(COUNT_INBOX, $data['count_receivedEmails']);
                    $pdfBooks = $this->db->query("SELECT f.value, f.file,f.short_name ,  f.name, f.description, f.id ,f.module FROM files f WHERE f.module = 'pdf'")->result();
                    $this->session->set_userdata(PDF_BOOKS, $pdfBooks);
                    $monthlyTips = $this->db->query("SELECT f.value, f.file,f.short_name, f.name, f.description, f.id  ,f.module FROM files f WHERE f.module = 'monthly_tips'")->result();
                    $this->session->set_userdata(MONTHLY_TIPS, $monthlyTips);
                    $content = $this->db->query("SELECT f.value, f.file, f.name,f.short_name, f.description, f.id  ,f.module FROM files f WHERE f.module = 'fund'")->result();
                    $this->session->set_userdata(FUNDING, $content);
                    $tips = $this->db->query("SELECT f.value,f.short_name , f.file, f.name, f.description, f.id  ,f.module ,f.sub_module FROM files f WHERE f.module = 'monthly_tips'")->result();
                    $bc_Tips = $this->db->query("SELECT f.value, f.file,f.short_name, f.name, f.description, f.id  ,f.module ,f.sub_module FROM files f WHERE f.module = 'monthly_tips' AND sub_module = 'business_credit'")->result();
                    $cr_Tips = $this->db->query("SELECT f.value, f.file,f.short_name , f.name, f.description, f.id  ,f.module ,f.sub_module FROM files f WHERE f.module = 'monthly_tips' AND sub_module = 'credit_repair'")->result();
                    $rs_Tips = $this->db->query("SELECT f.value, f.file,f.short_name, f.name, f.description, f.id  ,f.module ,f.sub_module FROM files f WHERE f.module = 'monthly_tips' AND sub_module = 'real_estate'")->result();
                    $financial_Tips = $this->db->query("SELECT f.value, f.short_name ,f.file, f.name, f.description, f.id  ,f.module ,f.sub_module FROM files f WHERE f.module = 'monthly_tips' AND sub_module = 'financial'")->result();
                    $cpn_Tips = $this->db->query("SELECT f.value, f.file, f.short_name ,f.name, f.description, f.id  ,f.module ,f.sub_module FROM files f WHERE f.module = 'monthly_tips' AND sub_module = 'cpn'")->result();
                    $user_id = $this->session->userdata(USER_ID);
                    $role = $this->session->userdata(ROLE_NAME);
                    $memberships_list = $this->MembershipModel->getMembership($user_id, $role);
                    $current_memberships = $this->MembershipModel->getMemberships($user_id);
                    $memberships_list = $memberships_list[0];
                    $membership = $memberships_list->membership;
                    //                    $count_transaction = $this->ContentModel->countMonthlyTipsWithTransaction($user_id);
                    ?>

                    <li class="dropdown messages-menu">

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <?php if ($this->session->userdata(COUNT_INBOX) == 0) { ?>
                                <span class="label label-success"></span> <?php } else { ?>
                                <span
                                    class="label label-success"><?php echo $this->session->userdata(COUNT_INBOX) ?></span>  <?php } ?>
                        </a>

                        <ul class="dropdown-menu">
                            <li class="header"><p>You have <?php echo $this->session->userdata(COUNT_INBOX) ?> new
                                    messages</p></li>
                            <li>

                                <ul class="menu">
                                    <?php foreach ((array)$this->session->userdata(INBOX) as $inbox) {
                                        $receiver_id = $inbox->receiver_id;
                                        $profileDetails = $this->UserModel->getUser($receiver_id);
                                        $profileImage = $profileDetails->profile_image;
                                        ?>
                                        <li>
                                            <a href=" <?php echo base_url('administrator/mail/read_mail') . '/' . $inbox->id ?>">
                                                <div class="pull-left">
                                                    <?php if (!empty($profileImage)) { ?>
                                                        <img
                                                            src="<?php echo base_url() . 'uploads/profile/' . $profileImage ?>"
                                                            class="img-circle"
                                                            alt="User Image"/>
                                                    <?php } else { ?>
                                                        <img
                                                            src="<?php echo base_url() . 'uploads/profile/empty_profile.jpg' ?>"
                                                            class="img-circle"
                                                            alt="User Image"/>
                                                    <?php } ?>
                                                </div>

                                                <?php if ($inbox->display == 'seen') { ?>
                                                    <h4>
                                                        <?php echo $inbox->receiver ?>
                                                        <small><i class="fa fa-clock-o"></i> <?php echo $inbox->date ?>
                                                        </small>
                                                    </h4>
                                                    <p> <?php echo $inbox->subject ?></p>
                                                <?php } else { ?>
                                                    <h4 class="text-red">
                                                        <?php echo $inbox->receiver ?>
                                                        <small><i class="fa fa-clock-o"></i> <?php echo $inbox->date ?>
                                                        </small>
                                                    </h4>
                                                    <p class="text-red"> <?php echo $inbox->subject ?></p>
                                                <?php } ?>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>

                            </li>

                            <li class="footer"><a href="<?php echo base_url('administrator/mail') ?>">See All
                                    Messages</a></li>

                        </ul>

                    </li>

                    <li class="dropdown tasks-menu">

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-flag-o"></i> <span
                                class="label label-danger"><?php if (count($tasks) != 0) {
                                    echo count($tasks);
                                } ?></span> </a>

                        <ul class="dropdown-menu">
                            <li class="header">You have <?php echo count($tasks); ?> tasks</li>
                            <?php if (count($tasks) > 0): ?>
                                <li>
                                    <ul class="menu">
                                        <?php foreach ($tasks as $key => $task): ?>
                                            <li>
                                                <a href="<?php echo base_url(ADMIN_PATH . 'task/task/' . $task->id) ?>">
                                                    <h3>
                                                        <?php echo $task->task_title ?>

                                                    </h3>

                                                </a>
                                            </li>
                                        <?php endforeach ?>

                                    </ul>
                                </li>
                            <?php endif ?>
                            <li class="footer">
                                <a href="<?php echo base_url(ADMIN_PATH . 'task/tasks') ?>">View all tasks</a>
                            </li>
                        </ul>

                    </li>

                    <li class="dropdown user user-menu">

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <?php
                            $blob_length = strlen($this->session->userdata(PROFILE_PIC));
                            $profilePicture = $this->session->userdata(PROFILE_PIC);
                            $imageUrl = base_url() . 'uploads/profile/' . $profilePicture;
                            $emptyImageUrl = base_url() . 'uploads/profile/empty_profile.jpg';
                            if ($profilePicture && profileImageExists($imageUrl)) {
                                ?>
                                <img src="<?php echo $imageUrl ?>" class="user-image" alt="User Image"/>
                            <?php } else { ?>
                                <img src="<?php echo $emptyImageUrl ?>" class="user-image" alt="User Image"/>
                            <?php } ?>
                            <span class="hidden-xs"><?php echo $this->session->userdata(NAME) ?></span>
                        </a>

                        <ul class="dropdown-menu">

                            <li class="user-header">
                                <?php
                                if ($profilePicture && profileImageExists($imageUrl)) {
                                    ?>
                                    <img src="<?php echo $imageUrl ?>" class="img-circle" alt="User Image"/>
                                <?php } else { ?>
                                    <img src="<?php echo $emptyImageUrl ?>" class="img-circle" alt="User Image"/>
                                <?php } ?>

                                <p>
                                    <?php echo $this->session->userdata(NAME) ?>
                                    - <?php echo strtoupper($this->session->userdata(ROLE_NAME)) ?>
                                    <small>Member
                                        since <?php echo date('M Y', strtotime($this->session->userdata(CREATED_DATE))); ?></small>
                                </p>
                            </li>


                            <li class="user-footer">
                                <div class="pull-left">
                                    <!--                                    <a href="-->
                                    <?php //$userId=$this->session->userdata(AGENT_ID)!=''?$this->session->userdata(AGENT_ID):$this->session->userdata(USER_ID);  echo base_url() . 'administrator/user/user/' . $userId; ?><!--"-->
                                    <a href="<?php echo base_url() . 'administrator/user/user/' . $this->session->userdata(USER_ID); ?>"
                                       class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="<?php echo base_url('member/logout') ?>" class="btn btn-default btn-flat">Sign
                                        out</a>
                                </div>
                            </li>

                        </ul>

                    </li>

                    <!--                    <li><a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a></li>-->

                </ul>
                <br/>
                <a class="btn-link" style="color: whitesmoke"
                   href="<?php echo base_url() . 'administrator/user/user/' . $user_id; ?>">Profile</a>

            </div>

        </nav>

    </header>

    <div class="modal fade" id="baseModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                test test test
            </div>
        </div>
    </div>

    <aside class="main-sidebar">
        <section class="sidebar">
            <div class="user-panel" style="padding-left: 10px; background-color: #367fa9; min-height: 100px">
                <div class="pull-left image" style="cursor: pointer"
                     onclick=document.location='<?php echo base_url() . 'administrator/user/user/' . $user_id ?>'>
                    <?php
                    if ($profilePicture && profileImageExists($imageUrl)) {
                        ?>
                        <img style="width: auto" src="<?php echo $imageUrl ?>" class="img-circle"
                             alt="User Image"/> <?php } else { ?>
                        <img style="width: auto" src="<?php echo $emptyImageUrl ?>" class="img-circle"
                             alt="User Image"/>
                    <?php } ?>
                    <br/>

                </div>
                <div style="padding-right: 40px" class="pull-right">
                    <?php foreach ($current_memberships as $membership) {
                        echo $membership->description;
                        echo "<br/>";
                    }; ?>
                    <a href="<?php echo site_url(ADMIN_PATH . 'user/membershipUpgrade/'.$user_id) ?>" style="font-size: x-small">Upgrade
                        Membership</a>
                </div>

            </div>
            <ul class="sidebar-menu">

                <!--                <li class="header">MAIN NAVIGATION</li>-->


                <li class="<?php echo activate(2, ''); ?> boxer super_admin admin super_broker broker owner client">
                    <a href="<?php echo base_url() . 'administrator'; ?>"> <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>

                <?php if ($role == SUPER_ADMIN): ?>

                    <li class="<?php echo activate(2, ''); ?> boxer super_admin admin super_broker broker owner client">
                        <a href="<?php echo base_url() . 'administrator/settings'; ?>"> <i class="fa fa-cog"></i> <span>Settings</span>
                        </a>
                    </li>

                <?php endif ?>

                <?php if (in_array($role, array(CLIENT, BROKER, OWNER, ADMIN))): ?>
                    <li class="<?php echo activate(2, MAIL); ?> treeview boxer super_admin super_broker broker admin client">
                        <a href="<?php echo base_url() . 'administrator/mail'; ?>"><i class='fa fa-envelope'></i> <span>Mailbox</span></a>
                    </li>
                <?php endif ?>


                <?php if (in_array($role, array(OWNER, BROKER, CLIENT, ADMIN))): ?>
                    <li class="<?php echo activateSegments(2, array(USER, APPLICATION, EMPLOYMENT), 3, USER, CREDIT_APPLICATIONS, EMPLOYMENTS); ?> treeview boxer super_admin admin broker super_broker">

                        <a href="#"><i class='fa fa-bookmark-o'></i> <span>Profile</span> <i
                                class="fa fa-angle-left pull-right"></i></a>

                        <ul class="treeview-menu">

                            <li class="<?php echo activate(5, 'general'); ?>">
                                <a href="<?php echo base_url() . 'administrator/user/user/' . $this->session->userdata(USER_ID) . '/general'; ?>"><i
                                        class='fa fa-bookmark-o'></i>General</a>
                            </li>

                            <li class="<?php echo activate(3, EMPLOYMENTS); ?>">
                                <a href="<?php echo base_url() . 'administrator/employment/employments/' . $this->session->userdata(USER_ID); ?>"><i
                                        class='fa fa-bookmark-o'></i>Employment</a>
                            </li>

                            <li class="<?php echo activate(2, APPLICATION); ?>">
                                <a href="<?php echo base_url() . 'administrator/application/creditapplications/' . $this->session->userdata(USER_ID); ?>"><i
                                        class='fa fa-bookmark-o'></i>Credit Application</a>
                            </li>

                        </ul>

                    </li>
                <?php endif ?>


                <?php if ($role == CLIENT): ?>

                    <li class="<?php echo activateSegments(2, 'creditstatus', 3, 'creditstatus'); ?> treeview">
                        <a href="<?php echo base_url() . 'administrator/creditstatus/creditstatus/' . $this->session->userdata(USER_ID) . '?option=descript' ?>"><i
                                class='fa fa-line-chart'></i> <span>Credit Status</span> </a>
                    </li>

                <?php endif ?>


                <?php if (in_array($role, array(OWNER, BROKER, CLIENT, ADMIN))) : ?>

                    <li class="<?php echo activate(2, CARD_TYPE, LINE, CHOOSE_AND_CHARGE); ?> treeview">

                        <a href="#"><i class='fa fa-database'></i> <span>Tradelines</span> <i
                                class="fa fa-angle-left pull-right"></i></a>

                        <ul class="treeview-menu">

                            <?php if ($role == ADMIN): ?>

                                <li class="<?php echo activate(3, ''); ?>">
                                    <a href="<?php echo base_url('administrator/ChooseAndCharge') ?>"><i
                                            class='fa fa-truck'></i>Choose And Charge</a>
                                </li>

                                <li class="<?php echo activate(3, CARD_TYPES); ?>">
                                    <a href="<?php echo base_url() . 'administrator/cardType/cardTypes'; ?>"><i
                                            class='fa fa-cc-visa'></i>Tradeline Types</a>
                                </li>

                            <?php endif; ?>

                            <li class="<?php echo activate(3, 'what_are_tradelines'); ?>">
                                <a href="<?php echo base_url() . 'administrator/content/whatAreTradelines/' . $this->session->userdata("whatAreTradelines")->id ?>"><i
                                        class='fa fa-question'></i><?php echo $this->session->userdata("whatAreTradelines")->name ?>
                                </a>
                            </li>

                            <li class="<?php echo activate(3, 'tradeline_benefits'); ?>">
                                <a href="<?php echo base_url() . 'administrator/content/tradelineBenefits/' . $this->session->userdata("tradelineBenefits")->id ?>"><i
                                        class='fa fa-star'></i><?php echo $this->session->userdata("tradelineBenefits")->name ?>
                                </a>
                            </li>

                            <?php if (in_array(role(), array(BROKER, CLIENT)) and array_intersect(memberships(), array(CLIENT_SILVER, CLIENT_GOLD, CLIENT_PLATINUM, BROKER_SILVER, BROKER_GOLD, BROKER_PLATINUM)))  : ?>

                                <li class="<?php echo activate(3, 'market'); ?>">
                                    <a href="<?php echo base_url() . 'administrator/line/market?option=descript' ?>"><i
                                            class='fa fa-shopping-cart'></i>Tradelines Marketplace</a>
                                </li>
                            <?php endif ?>

                            <?php if ($role == BROKER): ?>
                                <li class="<?php echo activate(3, 'to_lines'); ?>">
                                    <a href="<?php echo base_url() . 'administrator/line/to_lines' ?>"><i
                                            class='fa fa-shopping-cart'></i>TO Tradelines</a>
                                </li>
                            <?php endif ?>
                            <?php if (in_array($role, array(OWNER, BROKER))) : ?>
                                <li class="<?php echo activate(3, 'my_lines'); ?>">
                                    <a href="<?php echo base_url() . 'administrator/line/my_lines' ?>"><i
                                            class='fa fa-credit-card'></i>My Tradelines</a>
                                </li>
                            <?php endif ?>

                            <?php if ($role == ADMIN): ?>

                                <li class="<?php echo activate(3, 'all_lines'); ?>">
                                    <a href="<?php echo base_url() . 'administrator/line/all_lines' ?>"><i
                                            class='fa fa-shopping-cart'></i>All Tradelines</a>
                                </li>

                            <?php endif ?>

                            <?php if ($role != CLIENT): ?>

                                <li class="<?php echo activate(3, 'lineForm'); ?>">
                                    <a href="<?php echo base_url() . 'administrator/line/lineForm'; ?>"><i
                                            class='fa fa-plus'></i>Add a Tradeline</a>
                                </li>

                            <?php endif ?>

                            <?php if (in_array($role, array(CLIENT, BROKER, OWNER, ADMIN))) { ?>

                                <li class="<?php echo activateSegments(2, LINE, 3, 'lineAssignment') ?>">

                                    <a href="<?php echo base_url() . 'administrator/line/lineAssignment' ?>"><i
                                            class='fa fa-database'></i>
                                        Line Assignments</a>
                                </li>

                            <?php }; ?>

                        </ul>

                    </li>

                <?php endif ?>

                <?php if (in_array($role, array(CLIENT, BROKER, ADMIN))) : ?>


                    <li class="<?php echo activate(2, 'realEstate'); ?>"><a
                            href="<?php echo base_url() . 'administrator/realEstate?option=descript' ?>"><i
                                class='fa fa-home'></i>
                            <span>Real Estate</span></i></a></li>

                    <li class="<?php echo activate(2, 'vehicleFinancing'); ?>"><a
                            href="<?php echo base_url() . 'administrator/vehicleFinancing?option=descript' ?>"><i
                                class='fa fa-car'></i>
                            <span>Vehicle Financing</span></i></a></li>

                    <li><a href="javascript:void(0)"><i class='fa fa-check-square-o'></i>
                            <span>Business Credit</span></i></a></li>


                    <li class="<?php echo activateSegments(2, CONTENT, 3, FUNDING); ?> treeview">

                        <a href="<?php echo base_url('administrator/referrer') ?>"><i class='fa fa-usd'></i>
                            <span>Funding</span>
                            <i class="fa fa-angle-left pull-right"></i></a>

                        <ul class="treeview-menu">

                            <?php foreach ((array)$this->session->userdata(FUNDING) as $content) { ?>

                                <li class="<?php echo activate(4, $content->id); ?>">
                                    <a href="<?php
                                    $memberships = array('', 'free', 'silver');
                                    echo (in_array(MEMBERSHIPS, $memberships) && $role == CLIENT) ? '#' : base_url('administrator/content/funding/' . urlencode(json_decode($content->id)));
                                    ?>">
                                        <i class='fa fa-usd'></i>
                                        <?php echo $content->name ?>
                                    </a>
                                </li>

                            <?php } ?>

                        </ul>

                    </li>


                    <li class="<?php echo activateSegments(2, CONTENT, 3, 'loadTip'); ?> treeview">

                        <a href="#"><i class='fa fa-lightbulb-o'></i>
                            <span>Monthly Tips</span><?php echo str_repeat('&nbsp;', 5); ?>
                            <i class="fa fa-angle-left pull-right"></i></a>

                        <ul class="treeview-menu">

                            <?php if (in_array($role, array(BROKER, ADMIN))) : ?>
                                <li style="background-color: InactiveCaptionText;"
                                    class="<?php echo activate(2, 'content', 3, 'monthlyTips_list'); ?> treeview">
                                    <a title="Monthly Tips Archive"
                                       href="<?php echo base_url('administrator/content/monthlyTips_list'); ?>"><i
                                            class='glyphicon glyphicon-link'> </i>
                                        <span style="font-size: 14px;">Monthly Tips - Archive </span>
                                    </a>
                                </li>


                            <?php endif; ?>



                            <?php if ($membership != 'broker_silver') : ?>
                                <?php if ($membership != 'client_silver') : ?>

                                    <?php
                                    foreach ((array)$tips as $tip)  :
                                        $today = date("Y-m-d");
                                        $currentMonth = date('F');
                                        $currentYear = date("Y");
                                        $monthlyTipDate = $tip->value;
                                        $month_only = date('F', strtotime($monthlyTipDate));

                                        $monthlyTipYear = $tip->value;
                                        $get_year = date("Y", strtotime($monthlyTipYear));

                                        if (($today >= $tip->value) && ($month_only == $currentMonth) && ($get_year == $currentYear)) :
                                            ?>
                                            <li class="<?php echo activate(3, 'loadTip', 4, $tip->id); ?>">
                                                <a href="<?php $memberships = array('', 'free');
                                                echo in_array(MEMBERSHIPS, $memberships) && $role == CLIENT ? '#' : base_url('administrator/content/loadTip/' . urlencode(json_decode($tip->id)) . '/businesscredit') ?>"><i
                                                        class='fa fa-lightbulb-o'></i><i><?php echo $tip->short_name ?></i>
                                                </a>
                                            </li>
                                            <?php
                                        endif;
                                    endforeach; ?>
                                <?php endif; ?>
                            <?php endif; ?>


                        </ul>

                    </li>


                    <li class="<?php echo activateSegments(2, CONTENT, 3, 'loadPdf'); ?> treeview">

                        <a href="<?php echo base_url('administrator/referrer') ?>"><i class='fa fa-book'></i> <span> PDF Books</span>
                            <i class="fa fa-angle-left pull-right"></i></a>

                        <ul class="treeview-menu">

                            <?php foreach ((array)$this->session->userdata(PDF_BOOKS) as $pdf) { ?>

                                <li class="<?php echo activate(3, 'loadPdf', 4, $pdf->name); ?>">
                                    <a href="<?php $memberships = array('', 'free', 'silver');
                                    echo in_array(MEMBERSHIPS, $memberships) && $role == CLIENT ? '#' : base_url('administrator/content/loadPdf/' . urlencode(json_decode($pdf->id))) ?>"><i
                                            class='fa fa-book'></i><i><?php echo $pdf->short_name ?></i>
                                    </a>
                                </li>

                            <?php } ?>

                        </ul>

                    </li>
                <?php endif; ?>

                <?php if (in_array($role, array(BROKER, ADMIN))): ?>

                    <li class="<?php echo activate(2, array(USER, 'prospect'), 3, USER); ?> treeview boxer super_admin admin broker super_broker">

                        <a href="#"><i class='fa fa-users'></i> <span>Client Management</span> <i
                                class="fa fa-angle-left pull-right"></i></a>

                        <ul class="treeview-menu">

                            <li class="<?php echo activate(2, USER, 3, ''); ?>">
                                <a href="<?php echo base_url() . 'administrator/user'; ?>"><i class='fa fa-cogs'></i>Manage
                                    Clients</a>
                            </li>

                            <li class="<?php echo activate(2, 'prospect', 3, ''); ?>">
                                <a href="<?php echo base_url() . 'administrator/prospect'; ?>"><i
                                        class='fa fa-cogs'></i>Manage Prospects</a>
                            </li>

                            <li class="<?php echo activate(3, 'userForm'); ?>">
                                <a href="<?php echo base_url() . 'administrator/user/userForm'; ?>"><i
                                        class='fa fa-user-plus'></i>Add Client</a>
                            </li>

                            <li class="<?php echo activate(3, 'systemUserForm'); ?>">
                                <a href="<?php echo base_url() . 'administrator/user/systemUserForm'; ?>"><i
                                        class='fa fa-user-plus'></i>Add System User</a>
                            </li>

                            <li class="<?php echo activate(3, 'prospectForm'); ?>">
                                <a href="<?php echo base_url() . 'administrator/prospect/prospectForm'; ?>"><i
                                        class='fa fa-user-plus'></i>Add Prospect</a>
                            </li>

                        </ul>

                    </li>

                <?php endif; ?>

                <?php if (in_array($role, array(ADMIN))): ?>

                    <li class="<?php echo activate(2, 'newsletter'); ?> treeview">
                        <a href="<?php echo base_url('administrator/newsletter') ?>"><i
                                class='fa fa-newspaper-o'></i><span>NewsLetters</span></a>
                    </li>

                    <li class="<?php echo activate(2, 'campaign'); ?> treeview">

                        <a href="<?php echo base_url('administrator/campaign') ?>"><i
                                class='fa fa-flag-checkered'></i><span>Campaigns</span></a>
                    </li>

                    <li class="<?php echo activate(2, 'membership'); ?> treeview">
                        <a href="<?php echo base_url('administrator/membership') ?>"><i
                                class='fa fa-university'></i><span>Memberships</span></a>
                    </li>

                    <li class="<?php echo activate(2, 'banner', 'menu', 'faq', 'process', 'social', 'contact', 'themeoption'); ?> treeview">

                        <a href="#"><i class='fa fa-folder-open'></i> <span>Content Management</span> <i
                                class="fa fa-angle-left pull-right"></i></a>

                        <ul class="treeview-menu">

                            <li class="<?php echo activate(3, ''); ?>">

                                <a href="#"><i class='fa fa-globe'></i> <span>Public</span> <i
                                        class="fa fa-angle-left pull-right"></i></a>

                                <ul class="treeview-menu">

                                    <li class="<?php echo activate(2, 'banner'); ?>">
                                        <a href="<?php echo base_url('administrator/banner') ?>"><i
                                                class='fa fa-header'></i> Manage Banner</a>
                                    </li>

                                    <li class="<?php echo activate(3, ''); ?>">
                                        <a href="<?php echo base_url('administrator/content') ?>"><i
                                                class='fa fa-folder-open'></i> Manage Content</a>
                                    </li>

                                    <li class="<?php echo activate(2, 'menu'); ?>">
                                        <a href="<?php echo base_url('administrator/menu') ?>"><i
                                                class='fa fa-server'></i>Manage Menu</a>
                                    </li>

                                    <li class="<?php echo activate(2, 'faq'); ?>">
                                        <a href="<?php echo base_url('administrator/faq') ?>"><i
                                                class='fa fa-question'></i>Faqs</a>
                                    </li>

                                    <li class="<?php echo activate(2, 'process'); ?>">
                                        <a href="<?php echo base_url('administrator/process') ?>"><i
                                                class='fa fa-puzzle-piece'></i>Manage Process</a>
                                    </li>

                                    <li class="<?php echo activate(2, 'social'); ?>">
                                        <a href="<?php echo base_url('administrator/social') ?>"><i
                                                class='fa fa-facebook'></i>Manage Social Media</a>
                                    </li>

                                    <li class="<?php echo activate(2, 'contact'); ?>">
                                        <a href="<?php echo base_url('administrator/contact') ?>"><i
                                                class='fa fa-street-view'></i>Update Contact</a>
                                    </li>

                                    <li class="<?php echo activate(2, 'themeoption'); ?>">
                                        <a href="<?php echo base_url('administrator/themeoption') ?>"><i
                                                class='fa fa-ellipsis-v'></i>Manage Theme Option</a>
                                    </li>

                                </ul>
                            </li>

                            <li class="<?php echo activate(3, 'pdfContents'); ?> treeview">

                                <a href="#"><i class='fa fa-lock'></i> <span>Members</span> <i
                                        class="fa fa-angle-left pull-right"></i></a>

                                <ul class="treeview-menu">

                                    <li class="<?php echo activate(3, 'pdfContents'); ?>">
                                        <a href="<?php echo base_url('administrator/content/pdfContents') ?>">Manage
                                            Content</a>
                                    </li>

                                </ul>

                            </li>

                        </ul>

                    </li>

                <?php endif; ?>

                <?php if (in_array($role, array(BROKER, CLIENT, ADMIN))): ?>
                    <li class=" treeview <?php echo activate(3, 'balance'); ?>">

                        <a href="<?php echo base_url() . 'administrator/line/balance'; ?>"><i
                                class='fa fa-briefcase'></i>
                            <span>Transactions</span></a>

                    </li>

                    <?php if ($role == ADMIN): ?>

                        <li class="<?php echo activate(2, 'role', 'auth'); ?> treeview boxer super_admin admin">

                            <a href="#"><i class='fa fa-lock'></i> <span>Access Management</span> <i
                                    class="fa fa-angle-left pull-right"></i></a>

                            <ul class="treeview-menu">

                                <li class="<?php echo activate(2, 'role'); ?> boxer super_admin admin">
                                    <a href="#"><a href="<?php echo base_url() . 'administrator/role/roles'; ?>"><i
                                                class='fa fa-unlock-alt'></i> <span>Roles</span></a>
                                </li>

                                <li class="<?php echo activate(2, 'auth'); ?>">
                                    <a href="<?php echo base_url() . 'administrator/auth/auths'; ?>"><i
                                            class='fa fa-lock'></i> <span>Authorizations</span> </a>
                                </li>

                                <li class="<?php echo activate(3, 'roleAuth'); ?>">
                                    <a href="<?php echo base_url() . 'administrator/role/roleAuth'; ?>"><i
                                            class='fa fa-gears'></i>Auth Assignments</a>
                                </li>

                            </ul>

                        </li>

                    <?php endif; ?>

                <?php endif ?>

                <li class="<?php echo activate(2, 'calendar'); ?> treeview">
                    <a href="<?php echo base_url() . 'administrator/calendar'; ?>"><i class='fa fa-calendar'></i> <span>Calendar</span></a>
                </li>

<!--                <li class="--><?php //echo activate(2, 'invoice'); ?><!-- treeview">-->
<!--                    <a href="--><?php //echo base_url() . 'administrator/invoice'; ?><!--"><i class='fa fa-file-text-o'></i> <span>Invoice</span></a>-->
<!--                </li>-->

            </ul>
        </section>
    </aside>


    <div class="modal fade" id="baseModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Message</h4>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Message</h4>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <a class="btn btn-danger btn-ok" id="confirm" name="confirm">Ok</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Shopping Cart</h4>
                </div>
                <div class="modal-body">
                    <div class="te"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Checkout</button>
                </div>
            </div>
        </div>
    </div>


    <?php if ($freeCampaign) {
        if ($this->session->userdata('popUp') != 'show' || (($freeCampaign =='disabled') && ($this->uri->segment(3)!='membershipUpgrade'))){ ?>

            <div class="modal fade" id="campaignModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Message</h4>

                        </div>
                        <div class="modal-body">
                            You have <?php echo is_int($freeCampaign) ? $freeCampaign : 0 ?> days remaning in your trial
                            membership.</br>
                            Click <a
                                href="<?php echo base_url(ADMIN_PATH . 'user/membershipUpgrade/'.$user_id)?>">here</a>
                            to upgrade!

                        </div>
                        <div class="modal-footer">

                            <button type="button" <?php echo $freeCampaign == 'disabled' ? 'disabled' : '' ?>
                                    class="btn btn-default" data-dismiss="modal">Ok
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                $(window).load(function () {
                    $('#campaignModal').modal('show');
                });
            </script>
            <?php $this->session->set_userdata('popUp', 'show');
        }
    } ?>

    <script>

        $(".roles").change(function () {
            setVisibility("roles");
            var selectedOption = $(".roles").find("option:selected");
            $.ajax({
                url: "<?php echo base_url().'/administrator/home/changeRole/'?>",
                method: "POST",
                data: {current_role_name: selectedOption.val(), current_role_label: selectedOption.text()}
            }).done(function () {
                location.reload();
            });
        });

        //        $(document).ready(function () {
        //            setVisibility("roles");
        //        });

        //todo : do not uncomment this or above, if left menu doesn't show up for a role fix it with the php code instead. any question ask me - Sundar

        $('#disablelink').click(function (e) {
            e.preventDefault();
        });

        $('.selectpicker').selectpicker({
            style: 'btn-primary',
            size: 8
        });


    </script>



