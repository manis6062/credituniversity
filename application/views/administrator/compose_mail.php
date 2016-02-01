<!DOCTYPE html>
<html>
<link href="<?php echo base_url() ?>backend/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css">
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
                <li><a href="<?php echo base_url('administrator/mail'); ?>"><i class="fa fa-dashboard"></i> Home</a>
                </li>
                <li class="active">Mailbox</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    <a href="<?php echo base_url('administrator/mail'); ?>"
                       class="btn btn-primary btn-block margin-bottom">Back to Inbox</a>

                    <div class="box box-solid">
                        <div class="box-header with-border">
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
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Compose New Message</h3>
                            <div class="box-tools pull-right">
                                <div class="btn-group">
                                    <a href="<?php echo base_url('administrator/mail') ?>"
                                       class="btn btn-default btn-sm" data-toggle="tooltip" title="Back"><i
                                            class="fa fa-chevron-left"></i></a>
                                </div>
                                <!-- /.mailbox-controls -->

                            </div>
                        </div>
                        <!-- /.box-header -->

                        <?php $attributes = array('class' => 'formular', 'id' => 'form');
                        echo form_open_multipart(ADMIN_PATH . 'mail/sendMail', $attributes);
                        ?>


                        <div class="box-body">


                            <div class="row">
                                <?php if (in_array(role(), array(BROKER, ADMIN))): ?>
                                    <div class="form-group col-md-4">
                                        <div class="input-group">
                                            <label for="users"> All : </label><br/>
                                            <select id="brokers" multiple="multiple" name="users[]">
                                                <?php foreach ($users as $user) : ?>
                                                    <option
                                                        value="<?php echo $user->email ?>"><?php echo $user->first_name . ' ' . $user->last_name . ' - ' . $user->email ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                <?php endif ?>

                                <div class="form-group col-md-4">
                                    <div class="input-group">
                                        <label for="brokers"> Brokers : </label><br/>
                                        <select id="brokers" multiple="multiple" name="brokers[]">
                                            <?php foreach ($brokers as $broker) : ?>
                                                <option
                                                    value="<?php echo $broker->email ?>"><?php echo $broker->name . ' - ' . $broker->email ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <?php if (in_array(role(), array(BROKER, ADMIN))): ?>

                                    <div class="form-group col-md-4">
                                        <div class="input-group">
                                            <label for="clients"> Clients : </label> <br/>

                                            <select id="clients" multiple="multiple" name="clients[]">
                                                <?php foreach ($clients as $client) : ?>
                                                    <option
                                                        value="<?php echo $client->email ?>"><?php echo $client->name . ' - ' . $client->email ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                <?php endif ?>

                            </div>

                            <?php if (in_array(role(), array(BROKER, ADMIN))): ?>


                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <div class="input-group">
                                            <label for="owners"> Tradeline Owners : </label><br/>

                                            <select id="owners" multiple="multiple" name="owners[]">
                                                <?php foreach ($owners as $owner) : ?>
                                                    <option
                                                        value="<?php echo $owner->email ?>"><?php echo $owner->name . ' - ' . $owner->email ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group col-md-4">
                                        <div class="input-group">
                                            <label for="subscribers"> Subscribers : </label><br/>

                                            <select id="subscribers" multiple="multiple" name="subscribers[]">
                                                <?php foreach ($subscribers as $subscriber) : ?>
                                                    <option
                                                        value="<?php echo $subscriber->email ?>"><?php echo $subscriber->name . ' - ' . $subscriber->email ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="input-group">

                                            <label for="clientProspects"> Client Prospects : </label><br/>

                                            <select id="clientProspects" multiple="multiple" name="clientProspects[]">
                                                <?php foreach ($clientProspects as $clientProspect) : ?>
                                                    <option
                                                        value="<?php echo $clientProspect->email ?>"><?php echo $clientProspect->name . ' - ' . $clientProspect->email ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            <?php endif ?>


                            <?php if (in_array(role(), array(BROKER, ADMIN))): ?>

                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <div class="input-group">
                                            <label for="brokerProspects"> Broker Prospects : </label><br/>

                                            <select id="brokerProspects" multiple="multiple" name="brokerProspects[]">
                                                <?php foreach ($brokerProspects as $brokerProspect) : ?>
                                                    <option
                                                        value="<?php echo $brokerProspect->email ?>"><?php echo $brokerProspect->name . ' - ' . $brokerProspect->email ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="input-group">
                                            <label for="ownerProspects"> Owner Prospects : </label><br/>

                                            <select id="brokerProspects" multiple="multiple" name="brokerProspects[]">
                                                <?php foreach ($ownerProspects as $ownerProspect) : ?>
                                                    <option
                                                        value="<?php echo $ownerProspect->email ?>"><?php echo $ownerProspect->name . ' - ' . $ownerProspect->email ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            <?php endif ?>


                            <p style="color: red; font-size: 16px;"><?php echo $this->session->flashdata('su_message'); ?></p>

                            <div class="form-group">
                                <div class="col-xs-10">
                                    <label>Subject (*):</label>

                                    <div class='box-body pad'>
                                        <input type="text" class="form-control"
                                               name="subject" required>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-xs-12">
                                    <label>Message:</label>

                                    <div class='box-body pad'>
                                        <form>
                                            <textarea class="ckeditor" name="msg"></textarea>
                                        </form>
                                    </div>

                                    <input type="submit" value="Send Emails" name='submit' id='submit'
                                           class="btn btn-primary" disabled="disabled"/>
                                    <a href="<?php echo base_url('administrator/mail') ?>"
                                       class="btn btn-primary" data-toggle="tooltip" title="Back">Back</a>


                                </div>
                            </div>

                            <?php echo form_close(); ?>

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

<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
<script type="text/javascript">

    $("#brokers, #clients, #owners, #subscribers, #clientProspects, #brokerProspects, #ownerProspects").change(function () {
        if (this.value == "") {
            $("#submit").prop("disabled", true);
        } else {
            $("#submit").prop("disabled", false);
        }
    });

    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
    });

    function showRecipients() {
        var roles = $("#recipients").val();
        var singles = $("#users").val();
        var text = '';

        $("#clients").empty();
        $("#brokers").empty();
        $("#owners").empty();
        $("#prospects").empty();
        $("#subscribers").empty();
        $("#individuals").empty();

        if (roles != '' && roles != null
        ) {
            $.each(roles, function (key, value) {
                $.post("<?php echo base_url() . 'administrator/mail/emails'; ?>", {roles: value})
                    .success(function (data) {
                        try {
                            var data1 = $.parseJSON(data);
                            if (data.message) {
                                $("#baseModal2").modal().find('.modal-body').text(data).show();
                            } else {
                                var container = '';
                                var label = '';
                                if (value == 'client') {
                                    container = "#clients";
                                    label = "Clients : ";
                                } else if (value == 'broker') {
                                    container = "#brokers";
                                    label = "Brokers : ";
                                } else if (value == 'owner') {
                                    container = "#owners";
                                    label = "Owners : ";
                                } else if (value == 'subscriber') {
                                    container = "#subscribers";
                                    label = "Subscribers : ";
                                } else if (value == 'prospect') {
                                    container = "#prospects";
                                    label = "Prospects : ";
                                }
                                $(container).empty();
                                if (data1 != '') {
                                    $(container).append(label + '<br/><br/>');
                                    $.each(data1, function () {
                                        $('<input />', {
                                            type: 'checkbox',
                                            id: 'cb1',
                                            name: 'cb1[]',
                                            value: this.email,
                                            checked: 'checked'
                                        }).appendTo(container);
                                        $('<label />', {
                                            'for': 'cb1',
                                            text: this.name + ' : ' + this.email
                                        }).appendTo(container);
                                        $(container).append('<br/>');
                                    });
                                }
                            }
                        } catch (e) {
                            alert(e);
                        }
                    });
            });
        }

        if (singles != '' && singles != null) {
            var container = "#individuals";
            label = "Clients : ";
            $.post("<?php echo base_url() . 'administrator/mail/emails'; ?>", {individuals: singles})
                .success(function (data) {
                    try {
                        var data1 = $.parseJSON(data);
                        if (data.message) {
                            $("#baseModal2").modal().find('.modal-body').text(data).show();
                        } else {
                            $(container).empty();
                            if (data1 != '') {
                                $(container).append('Individuals:<br/><br/>');
                                $.each(data1, function () {
                                    $('<input />', {
                                        type: 'checkbox',
                                        id: 'cb1',
                                        name: 'cb1[]',
                                        value: this.email,
                                        checked: 'checked'
                                    }).appendTo(container);
                                    $('<label />', {
                                        'for': 'cb1',
                                        text: this.name + ' : ' + this.email
                                    }).appendTo(container);
                                    $(container).append('<br/>');
                                });
                            }
                        }
                    } catch (e) {
                        alert(e);
                    }
                });
        }

        return false;
    }

    $("#recipients").on("change", function () {
        return showRecipients();
    });
    $("#users").on("change", function () {
        return showRecipients();
    });


    $('#brokers, #clients, #owners, #subscribers, #clientProspects, #brokerProspects, #ownerProspects').multiselect({
        includeSelectAllOption: true,
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true
    });


</script>
</body>
</html>