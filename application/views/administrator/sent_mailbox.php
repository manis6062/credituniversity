<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper bg-main">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo $this->session->userdata(NAME) ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('administrator/mail'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Sent Mail</li>
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
                            <li><a href="<?php echo base_url('administrator/mail'); ?>"><i class="fa fa-inbox"></i>
                                    Inbox <span
                                        class="label label-primary pull-right"><?php if (!empty($count_receivedEmails)) {
                                            echo $count_receivedEmails;
                                        } ?></span></a></li>
                            <li class="active"><a href="<?php echo base_url('administrator/mail/sent_mail'); ?>"><i
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
            <div class="col-md-9">
                <div class="box ">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sent</h3>

                        <a class="refresh" href="<?php echo base_url('administrator/mail/sent_mail'); ?> "
                        <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                        </a>


                    </div>
                    <!-- /.box-header -->
                    <div class="box-body ">
                        <div class="table-responsive ">
                            <div class="mailbox-controls">
                                <table class="table table-hover table-striped" id='sent'>
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Receiver</th>
                                        <?php if ($this->session->userdata(ROLE_NAME) == 'admin') : ?>
                                            <th>Sender</th>
                                        <?php endif; ?>
                                        <th>Subject</th>
                                        <th>Sent Date</th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>

                                    <tbody>

                                    <?php $count = 1;

                                    foreach ($allEmails as $values) { ?>
                                        <tr>
                                            <td><?php echo $count++ ?> </td>
                                            <td class="mailbox-name">
                                                <?php if (!empty($values->receiverName)) {
                                                    echo character_limiter($values->receiverName, 30);
                                                } else {
                                                    echo $values->receiver_name;
                                                }?></td>
                                            <?php if ($this->session->userdata(ROLE_NAME) == 'admin') : ?>
                                                <td><?php echo $values->senderName ?></td><?php endif?>
                                            <td class="mailbox-subject"><b><a
                                                        href="<?php echo base_url('administrator/mail/read_mail') . '/' . $values->id . '/' . $values->receiver_id ?>"><?php echo character_limiter($values->subject, 30) ?></a></b>

                                            </td>
                                            <td class="mailbox-date"><?php echo $values->date ?></td>
                                            <td>
                                                <a href="<?php echo base_url('administrator/mail/deleteFromSent') . '/' . $values->id . '/' . $values->receiver_id?>"
                                                   onclick="return confirm('Please confirm to delete this email?');"
                                                <span class="glyphicon glyphicon-trash"></span></a>

                                            </td>
                                        </tr>
                                    <?php }; ?>


                                    </tbody>
                                </table>


                                </tbody>
                                </table><!-- /.table -->
                            </div>
                        </div>
                        <!-- /.mail-box-messages -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer no-padding">
                        <div class="mailbox-controls">
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
    $('#sent').dataTable({
        iDisplayLength: 1000
    });

    $('#confirm-delete').on('show.bs.modal', function (e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
</script>


