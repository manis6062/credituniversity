<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper bg-mail">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo $this->session->userdata(NAME); ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('administrator'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Inbox</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <a href="<?php echo base_url('administrator/mail/compose') ?>"
                   class="btn btn-primary btn-block margin-bottom">Compose</a>

                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Folders</h3>

                        <div class='box-tools'>
                            <button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                            <li class="active"><a href="<?php echo base_url('administrator/mail'); ?>"><i
                                        class="fa fa-inbox"></i> Inbox <span
                                        class="label label-primary pull-right"><?php if (!empty($count_receivedEmails)) {
                                            echo $count_receivedEmails;
                                        } ?></span></a></li>
                            <li><a href="<?php echo base_url('administrator/mail/sent_mail'); ?>"><i
                                        class="fa fa-envelope-o"></i> Sent<span
                                        class="label label-primary pull-right"></span></a></li>
                            <li><a href="<?php echo base_url('administrator/mail/trash_mail'); ?>"><i
                                        class="fa fa-trash-o"></i> Trash</a></li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /. box -->
            </div>
            <!-- /.col -->
            <div class="col-xs-9">
                <div class="box ">
                    <div class="box-header with-border ">
                        <h3 class="box-title">Inbox</h3> <?php if (!empty($receivedEmails)) { ?>
                <a class="refresh" href="<?php echo base_url('administrator/mail'); ?> " <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button></a>
				<?php } ?>
                        <div class="box-tools pull-right">

                        </div>
                    </div>
                    <!-- /.box-header -->


                    <div class="box-body">
                        <div class="table-responsive ">
                            <div class="mailbox-controls">
                            <table class="table table-hover table-striped" id='inbox'>
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Sender</th>
                                    <th>Subject</th>
                                    <th>Date</th>
                                    <th>Action</th>

                                </tr>
                                </thead>


                                <tbody>


                                <form method="post" action="<?php echo base_url('administrator/mail/deleteMultiple') ?>">

                                    <?php
                                    if (!empty($receivedEmails)) {
                                        $count = 1;
                                        foreach ($receivedEmails as $values) { ?>
                                            <tr <?php echo $values->display == 'unseen'?'style="font-weight:bold"':''; ?>>



                                                <td><?php echo $count++ ?> </td>
                                                <td class="mailbox-name"><?php echo $values->receiver!=''?$values->receiver:$values->senderEmail ?>
                                                </td>
                                                <td class="mailbox-subject"><b><a href="<?php echo base_url('administrator/mail/read_mail') . '/' . $values->id ?>"><?php echo character_limiter($values->subject, 30) ?></a></b></td>
                                                <td class="mailbox-date"><?php echo $values->date ?></td>
                                                <td>
                                                    <a href="<?php echo base_url('administrator/mail/deleteFromInbox') . '/' . $values->id . '/' . $values->receiver_id ?>"  onclick="return confirm('Please confirm to delete this email?');" >
                                                        <span class="glyphicon glyphicon-trash"></span></a>
                                                </td>

                                                </tr>
                                            <?php  } } ?>



                                </form>
                                </tbody>
                            </table>
                        </div>
                            <!-- /.table -->
                        </div>
                        <!-- /.mail-box-messages -->
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer no-padding">
                        <div class="mailbox-controls">


                            <div class="pull-right">


                            </div>
                            <!-- /.pull-right -->
                        </div>
                    </div>
                </div>
                <!-- /. box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
    $('#inbox').dataTable({
        iDisplayLength: 100
    });
</script>


