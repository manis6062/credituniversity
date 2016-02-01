<?php
$CI = &get_instance();
$this->load->model('MenuModel');
$this->load->model('ContactModel');
$this->load->model('SocialModel');
$menu = $CI->MenuModel->getAllByType('main-menu', 'main-menu/footer-menu', '');
$contact = $CI->ContactModel->getAll();
$social = $CI->SocialModel->getAllActive();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>The Credit University | <?php echo $title; ?></title>
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>backend/image/favicon-university.ico"/>

    <link href="<?php echo base_url(); ?>backend/docs/css/bootstrap-3.3.2.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>backend/font-awesome-4.4.0/css/font-awesome.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo base_url(); ?>backend/css/ionicons.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>backend/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>backend/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>backend/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>backend/plugins/morris/morris.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo base_url(); ?>backend/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>backend/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"
          rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>backend/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo base_url() ?>backend/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>backend/plugins/select2/select2.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url() ?>backend/css/bootstrapValidator.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url() ?>backend/css/jquery.steps.css" rel="stylesheet" type="text/css"/>

    <link href="<?php echo base_url() ?>backend/formvalidation-dist-v0.7.0/dist/css/formValidation.min.css"
          rel="stylesheet" type="text/css"/>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<!--step form Registration-->
<!--    <link rel="stylesheet" href="--><?php //echo base_url(); ?><!--frontend/assets/bootstrap/css/bootstrap.min.css">-->
<!--    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">-->
<!--    <link rel="stylesheet" href="assets/css/form-elements.css">-->
<!--    <link rel="stylesheet" href="--><?php //echo base_url(); ?><!--frontend/assets/css/style.css">-->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!--step form Registration-->

    <script src="<?php echo base_url(); ?>backend/docs/js/jquery-2.1.3.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/docs/js/bootstrap-3.3.2.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>backend/js/jquery-ui.min.js"></script>


    <script src="<?php echo base_url(); ?>backend/formvalidation-dist-v0.7.0/dist/js/formValidation.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/formvalidation-dist-v0.7.0/dist/js/framework/bootstrap.min.js"></script>

    <script type="text/javascript">
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="<?php echo base_url(); ?>backend/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/datatables/dataTables.bootstrap.min.js"></script>
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
    <script src="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"
            type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/slimScroll/jquery.slimscroll.min.js"
            type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>backend/dist/js/app.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>backend/js/md5.js"></script>
    <script src="<?php echo base_url() ?>backend/bootstrap3-editable/js/bootstrap-editable.js"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/select2/select2.full.min.js" type="text/javascript"></script>
<!--    <script src="--><?php //echo base_url(); ?><!--backend/plugins/input-mask/jquery.inputmask.js"-->
<!--            type="text/javascript"></script>-->
<!--    <script src="--><?php //echo base_url(); ?><!--backend/plugins/input-mask/jquery.inputmask.date.extensions.js"-->
<!--            type="text/javascript"></script>-->
<!--    <script src="--><?php //echo base_url(); ?><!--backend/plugins/input-mask/jquery.inputmask.extensions.js"-->
<!--            type="text/javascript"></script>-->
    <script src="<?php echo base_url(); ?>backend/js/jquery.maskedinput.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>backend/js/jquery-ui.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>backend/js/jquery.steps.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>backend/js/cpn.js" type="text/javascript"></script>
    <link href="<?php echo base_url() ?>frontend/css/main.css" rel="stylesheet">
    <link href="<?php echo base_url()?>frontend/css/responsive.css" rel="stylesheet">

</head>

<body class="homepage">
<div class="wrapper">
    <header id="header">
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-xs-6">
                        <div class="top-number"><p><i class="fa fa-phone-square"></i>
                                <a class="phoneTag" href="tel:18002728030"> 180-272-8030 </a></p></div>
                    </div>
                    <div class="col-sm-6 col-xs-6">
                        <div class="social">
                            <ul class="social-share" style="margin-right:15px; !important;">
                                <?php if (!empty($social)) {
                                    foreach ($social as $key => $value) { ?>
                                        <li><a href="<?php echo $value->social_link; ?>"
                                               class="<?php echo $value->social_title; ?>"><i
                                                    class="fa fa-<?php echo $value->social_title; ?>"></i></a></li>
                                    <?php }
                                } ?>
                            </ul>
                            <div class="pull-right btn-login">
                                <?php if ($this->session->userdata(USER_ID)) { ?>
                                    <a href="<?php echo base_url() . 'member' ?>">Dashboard</a>  | <a
                                        href="<?php echo base_url() . 'member/logout' ?>">log out</a>
                                <?php } else { ?>
                                    <a href="<?php echo base_url() . 'register/signUp' ?>">sign up</a>  | <a
                                        href="<?php echo base_url() . 'member'; ?>">log in</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-inverse">
            <div class="container">
                <div class="row">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div class="logo"><a href="<?php echo base_url() ?>"><img
                                    src="<?php echo base_url() ?>frontend/images/logo.png" alt="logo"></a></div>
                    </div>
                    <div class="collapse navbar-collapse navbar-right">
                        <ul class="nav navbar-nav">
                            <li <?php
                            if (($this->uri->segment(1) == '') || ($this->uri->segment(1) == 'home')) {
                                echo 'class="active">';
                            } else {
                                echo '>';
                            }
                            ?>
                            <?php
                            foreach ($menu as $mmenu) {
                                if ($mmenu->menu_name != 'home') {
                                    ?>
                                    <li <?php
                                    if (($mmenu->module_controller == 'content') && ($this->uri->segment(2) == $mmenu->content_id)) {
                                        echo 'class="active">';
                                    } elseif (($mmenu->module_controller == $this->uri->segment(1)) && ($mmenu->module_controller != 'content')) {
                                        echo 'class="active">';
                                    } else {
                                        echo '>';
                                    }
                                    ?>
                                    <a href="<?php
                                    echo site_url($mmenu->module_controller);
                                    if ($mmenu->module_controller == 'content') {
                                        ?>/<?php
                                        echo $mmenu->content_id;
                                    }
                                    ?>"><?php echo $mmenu->menu_name; ?></a>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
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
    </header>
</div>
