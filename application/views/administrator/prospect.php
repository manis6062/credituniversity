<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            <?php echo $prospect->first_name . ' ' . $prospect->last_name ?>
            <small>Prospect</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <?php if ($role == BROKER or $role == SUPER_ADMIN): ?>
                <li><a href="<?php echo base_url() . 'administrator/user'; ?>">Users</a></li>
            <?php endif ?>
            <li class="active">Edit</li>
        </ol>
    </section>

    <section class="content ">
        <div class="row">
            <?php if ($protype == 'general' || ($protype == '')) { ?>
                <section class="col-lg-6 connectedSortable ui-sortable">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Personal</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="form-group col-md-6"> <?php echo form_label('User Id : ', 'id'); ?>
                                        <?php
                                        echo $prospect->id ?>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <?php echo form_label('Broker : ', 'broker_id'); ?>
                                        <a href="#" id="broker_id" data-type="select"
                                           data-value="<?php echo $prospect->broker_id ?>"
                                           data-pk=<?php echo $prospect->id ?>
                                           data-source="<?php echo $brokers ?>"
                                           data-emptytext="select a broker"><?php echo $prospect->broker_name ?></a
                                        >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6"> <?php echo form_label('First Name : ', 'first_name'); ?>
                                        <a href="#" id="first_name"><?php echo $prospect->first_name ?></a>
                                    </div>
                                    <div class="form-group col-md-6"> <?php echo form_label('Last Name : ', 'last_name'); ?>
                                        <a href="#" id="last_name" data-type="text">
                                            <?php echo $prospect->last_name ?></a>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6"> <?php echo form_label('Email : ', 'email'); ?>
                                        <a href="#" id="email" data-type="text"> <?php echo $prospect->email; ?></a>
                                    </div>
                                    <div class="form-group col-md-6"> <?php echo form_label('Phone : ', 'phone'); ?>
                                        <a href="#" id="phone" data-type="text">
                                            <?php echo $prospect->personal_phone ?></a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <?php if (role() == BROKER): ?>
                        <div class="col-md-12">
                            <form method="post"
                                  action="<?php echo base_url() . 'administrator/prospect/addProspectNotes/' . $prospect->id; ?>">
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <h3 class="box-title">Notes</h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <textarea style="width: 100%" name="note"></textarea>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <input type="submit" value="Add Note" class="btn-primary">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <?php foreach ($notes as $note) {
                                          ?>
                                                <div class="form-group col-md-12">
                                                    <?php echo $note->updated ?> <br/>
                                                    <a href="#" data-type="textarea" data-pk="<?php echo $note->id ?>"
                                                       id="note" name="note"><?php echo $note->note ?></a>
                                                </div>
                                                <div class="form-group col-md-1">
                                                    <a href="" id="deleteNote"
                                                       onclick="deleteNote(<?php echo $note->id . ',' . $this->uri->segment(4) ;?>)">
                                                        <span class="glyphicon glyphicon-trash"></span></a>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php endif ?>
                </section>
            <?php } ?>
        </div>
    </section>
</div>
<script>

    $.fn.editable.defaults.mode = 'inline';

    $('#first_name,#last_name,#phone').editable({
        pk: '<?php echo $prospect->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params) {
            params.table = 'prospect';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });

    $('#email').editable({
        pk: '<?php echo $prospect->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params) {
            params.table = 'prospect';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });

    $('#broker_id').editable({
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        prepend: "Unassigned",
        params: function (params, newValue) {
            params.table = 'prospect';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') {
                return response.msg;
            }
        }
    });


    $('#status*').editable({
        url: '<?php echo base_url() . 'administrator/post'; ?>',

        params: function (params, newValue) {
            params.table = 'application';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') {
                return response.msg;
            }
            location.reload();
        }
    });

    $('#note*').editable({
        url: '<?php echo base_url() . 'administrator/post'; ?>',

        params: function (params, newValue) {
            params.table = 'notes';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') {
                return response.msg;
            }
        }
    });

    $(document).ready(
        function () {
            $('input:file').change(
                function () {
                    if ($(this).val()) {
                        $('input:submit').attr('disabled', false);
                    }
                }
            );
        }
    );


    function deleteNote(id, prospectid) {
        $.post("<?php echo base_url() . 'administrator/user/deleteNote'; ?>", {id: id, prospectId: prospectid})
            .success(function (data) {
                try {
                    var data1 = $.parseJSON(data);
                    if (data1.message) {
                        $("#baseModal2").modal().find('.modal-body').text(data1.message).show();
                    } else {
                        location.reload();
                    }
                } catch (e) {
                    location.reload();
                }
            });
    }


</script>
