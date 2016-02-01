<!DOCTYPE html>
<html>

<body class="skin-blue sidebar-mini">
<div class="wrapper">


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper bg-main">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <?php echo $this->session->userdata(NAME); ?>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Mailbox</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    <a href="<?php echo base_url('administrator/mail/compose') ?>"
                       class="btn btn-primary btn-block margin-bottom">Compose</a>

                    <div class="box ">
                        <div class="box-header ">
                            <h3 class="box-title">Folders</h3>

                            <div class='box-tools'>
                                <button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body no-padding">
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="<?php echo base_url('administrator/mail'); ?>"><i class="fa fa-inbox"></i>
                                        Inbox <span
                                            class="label label-primary pull-right"><?php if (!empty($count_receivedEmails)) {
                                                echo $count_receivedEmails;
                                            } ?></span></a></li>
                                <li><a href="<?php echo base_url('administrator/mail/sent_mail'); ?>"><i
                                            class="fa fa-envelope-o"></i> Sent</a></li>
                                <li><a href="#"><i class="fa fa-trash-o"></i> Trash</a></li>
                            </ul>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /. box -->

                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="box">
                        <div class="box-header">
                            <div class="box-tools pull-right">
                                <div class="btn-group">
                                    <a href="<?php echo base_url('administrator/mail') ?>"
                                       class="btn btn-default btn-sm" data-toggle="tooltip" title="Back"><i
                                            class="fa fa-chevron-left"></i></a>
                                    <a href="<?php echo base_url('administrator/mail/deleteAction') . '/' . $values->id ?>"
                                       class="btn btn-default btn-sm" data-toggle="tooltip" title="Delete"><i
                                            class="fa fa-trash-o"></i></a>


                                </div>
                                <!-- /.mailbox-controls -->

                            </div>
                        </div>
                        <!-- /.box-header -->


                        <?php
                        foreach ($read_mail as $values) { ?>
                            <div class="box-body no-padding">

                                <div class="mailbox-read-info">

                                    <h3>From: <?php echo $values->senderEmail; ?></h3>

                                </div>
                                <div class="mailbox-read-info" style="word-break: break-all;">
                                    <span class="mailbox-read-time pull-right"
                                          style="font-size: 14px;"><?php echo $values->date; ?></span>
                                    <h4 style="display: inline;">Subject : </h4>
                                    <span><?php echo $values->subject ?></span>

                                </div>
                                <!-- End of LOGO --><!-- start textbox-with-title -->
                                <div class="mailbox-read-info">
                                    <table bgcolor="#e8eaed" border="0" cellpadding="0" cellspacing="0"
                                           id="backgroundTable">
                                        <tbody>
                                        <tr>
                                            <td>
                                                <table align="center" border="0" cellpadding="0" cellspacing="0"
                                                       class="devicewidth" width="900" >
                                                    <tbody>
                                                    <tr>
                                                        <td width="100%">
                                                            <table align="center" bgcolor="#ffffff" border="0"
                                                                   cellpadding="0" cellspacing="0" class="devicewidth"
                                                                   width="900">
                                                                <tbody><!-- Spacing -->
                                                                <tr>
                                                                    <td height="20" width="100%">&nbsp;</td>
                                                                </tr>
                                                                <!-- Spacing -->

                                                                <tr>
                                                                    <td>

                                                                        <table bgcolor="#202020" border="0"
                                                                               cellpadding="0" cellspacing="0"
                                                                               id="backgroundTable" width="100%">
                                                                            <tbody><!-- Title -->

                                                                            <tr>
                                                                                <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; font-weight:bold; color: #333333; text-align:left;line-height: 24px; ">
                                                                                    Hello <?php echo $values->receiver; ?>
                                                                                    ,
                                                                                </td>
                                                                            </tr>
                                                                            <!-- End of Title --><!-- spacing -->
                                                                            <tr>
                                                                                <td height="5">&nbsp;</td>
                                                                            </tr>


                                                                            <tr>

                                                                                <td>
                                                                                    <div style="width: 790px;">
                                                                                        <?php
                                                                                        echo $values->msg;
                                                                                        ?>
                                                                                    </div>
                                                                                    <div class="clearfix"></div>
                                                                                </td>

                                                                            </tr>

                                                                            <!-- End of content --><!-- Spacing -->
                                                                            <tr>
                                                                                <td height="5" width="100%">&nbsp;</td>
                                                                            </tr>
                                                                            <!-- Spacing --><!-- button -->

                                                                            <!-- /button --><!-- Spacing -->
                                                                            <tr>
                                                                                <td height="20" width="100%">&nbsp;</td>
                                                                            </tr>
                                                                            <!-- Spacing -->
                                                                            </tbody>
                                                                        </table>

                                                                    </td>
                                                                </tr>

                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- end of textbox-with-title --><!-- Start of 2-columns -->

                                <!-- End of 2-columns --><!-- Start of postfooter -->

                                <table bgcolor="#202020" border="0" cellpadding="0" cellspacing="0" id="backgroundTable"
                                       width="100%">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <table align="center" border="0" cellpadding="0" cellspacing="0"
                                                   class="devicewidth" width="100%">
                                                <tbody>
                                                <tr>
                                                    <td width="100%">
                                                        <table align="center" border="0" cellpadding="0" cellspacing="0"
                                                               class="devicewidth" width="900">
                                                            <tbody><!-- Spacing -->
                                                            <tr>
                                                                <td height="20" width="100%">&nbsp;</td>
                                                            </tr>
                                                            <!-- Spacing -->
                                                            <tr>
                                                                <td align="center"
                                                                    style="font-family: Helvetica, arial, sans-serif; font-size: 13px;color: #ffffff"
                                                                    valign="middle">&copy; 2015 The Credit University. All Rights
                                                                    Reserved.
                                                                </td>
                                                            </tr>
                                                            <!-- Spacing -->
                                                            <tr>
                                                                <td height="20" width="100%">&nbsp;</td>
                                                            </tr>

                                                            <div class="box-footer">
                                                                <div class="btn-group">
                                                                    <h4>Thanking
                                                                        You,<br><br><?php echo $values->sender; ?></h4>
                                                                    <h4>The Credit University</h4>
                                                                </div>
                                                                <!-- /.btn-group -->

                                                            </div>
                                                            <!-- /.box-footer -->
                                                            <div class="box-footer">
                                                                <div class="btn-group">
                                                                    <a href="#" >Reply</a>
                                                                    <a href="#" > Reply All</a>
                                                                </div>
                                                            </div>

                                                            <!-- Spacing -->
                                                            </tbody>
                                                        </table>


                                                    </td>

                                                </tr>

                                                </tbody>
                                            </table>


                                        </td>

                                    </tr>

                                    </tbody>
                                </table>

                                <!-- End of postfooter -->


                            </div>

                        <?php } ?>


                        <div class="box-footer">
                            <div class="btn-group">

                            </div>
                            <!-- /.btn-group -->

                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!-- /. box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->

<!-- Page Script -->
<script>
    $(function () {
        //Enable iCheck plugin for checkboxes
        //iCheck for checkbox and radio inputs
        $('.mailbox-messages input[type="checkbox"]').iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass: 'iradio_flat-blue'
        });

        //Enable check and uncheck all functionality
        $(".checkbox-toggle").click(function () {
            var clicks = $(this).data('clicks');
            if (clicks) {
                //Uncheck all checkboxes
                $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
                $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
            } else {
                //Check all checkboxes
                $(".mailbox-messages input[type='checkbox']").iCheck("check");
                $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
            }
            $(this).data("clicks", !clicks);
        });

        //Handle starring for glyphicon and font awesome
        $(".mailbox-star").click(function (e) {
            e.preventDefault();
            //detect type
            var $this = $(this).find("a > i");
            var glyph = $this.hasClass("glyphicon");
            var fa = $this.hasClass("fa");

            //Switch states
            if (glyph) {
                $this.toggleClass("glyphicon-star");
                $this.toggleClass("glyphicon-star-empty");
            }

            if (fa) {
                $this.toggleClass("fa-star");
                $this.toggleClass("fa-star-o");
            }
        });
    });
</script>

</body>
</html>