
<style>
    .display-none {
        display: none !important;
    }

    .display-inline {
        display: inline !important;
    }
</style>


<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            Tradeline
            <small>Transactions</small>
            <?php if (in_array($role, array(BROKER, ADMIN, CLIENT))): ?>
                <a class="btn btn-link" href="<?php echo base_url() . 'administrator/line/lineClientForm'; ?>">Assign
                    Tradeline</a>
                <a class="btn btn-link" href="<?php echo base_url() . 'administrator/line/market'; ?>">MarketPlace</a>
            <?php endif ?>
            <a class="btn btn-link" href="<?php echo base_url() . 'administrator/line/lineForm'; ?>">Add a Tradeline</a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">lines</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table class="table table-bordered table-striped table-hover" id="lineAssignment">
                            <?php if (in_array(role(), array(OWNER))): ?>
                            <div style="padding-left: 400px;"
                                class="btn-group"
                                data-toggle="btn-toggle">

                                <input
                                    id="toggle-todo"
                                    data-on="Show"
                                    data-off="Hide"
                                    data-toggle="toggle"
                                    type="checkbox"
                                    checked>
                            </div>

                            <?php endif ?>
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Line#</th>
                                <?php if (in_array(role(), array(BROKER))): ?>
                                    <th>Owner</th>
                                <?php endif ?>
                                <?php if (in_array(role(), array(OWNER))): ?>
                                <th>SSN</th>
                                <th>DOB</th>
                                <?php endif ?>
                                <th>Line</th>
                                <th>Client</th>
                                <th>Requested</th>
                                <th>Added</th>
                                <th>Removed</th>
                                <?php if (in_array(role(), array(OWNER, BROKER))): ?>
                                    <th>Owner Price</th>
                                <?php endif ?>
                                <?php if (in_array(role(), array(BROKER))): ?>
                                    <th>Owner Broker Price</th>
                                <?php endif ?>
                                <?php if (in_array(role(), array(BROKER))): ?>
                                    <th>Client Broker Price</th>
                                <?php endif ?>
                                <th>Owner Verified</th>
                                <th>Broker Verified</th>
                                <th>Cancelled</th>
                                <th>Reason</th>
                                <?php if (in_array(role(), array(ADMIN))): ?>
                                    <th>Delete</th>
                                <?php endif ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($lines as $key => $line) {
                                ?>
                                <tr class="item">
                                    <td><?php echo($line->id) ?></td>
                                    <td>
                                        <a href="<?php echo base_url() . 'administrator/line/line/' . $line->line_id; ?>" id="line_id"><?php echo $line->line_id; ?></a>
                                    </td>

                                    <?php if (in_array(role(), array(BROKER))): ?>
                                        <td>
                                            <a href="<?php '/administrator/user/user/' . $line->owner_id; ?>" id="owner" data-type="text"><?php echo $line->owner_name; ?></a>
                                        </td>

                                    <?php endif ?>
                                <?php if (in_array(role(), array(OWNER))): ?>
                                    <td style="white-space: nowrap">


                                        <a href="#"  data-type="text"
                                                 id="ssn_hide" class="">
                                            <?php echo '[hidden] '; ?>
                                        </a>

                                        <a href="#" data-type="text"
                                           id="ssn_show" class="" style="display: none">
                                            <?php echo $line->ssn; ?>
                                        </a>

                                    </td>
                                    <td style="white-space: nowrap">

                                        <a href="#"  data-type="text"
                                           id="dob_hide" class="">
                                            <?php echo '[hidden] '; ?>
                                        </a>

                                        <a href="#" data-type="text"
                                           id="dob_show" class="" style="display: none">
                                            <?php echo $line->dob; ?>
                                        </a>

                                        <script>
                                            function toggleFunction() {
                                                $("#ssn_hide*").toggleClass("display-none");
                                                $("#ssn_show*").toggleClass("display-inline");

                                                $("#dob_hide*").toggleClass("display-none");
                                                $("#dob_show*").toggleClass("display-inline");
                                            }
                                        </script>
                                       </td>
                                <?php endif ?>
                                    <td  style="white-space: nowrap"><?php echo $line->line; ?></td>
                                    <td  style="white-space: nowrap">
                                        <?php echo $line->client_name; ?>
                                    </td>
                                    <td  style="white-space: nowrap">
                                        <a href="#" id="requested" data-type="date" data-container="body" data-pk="<?php echo $line->id; ?>"><?php echo $line->requested; ?></a>
                                    </td>
                                    <td  style="white-space: nowrap">
                                        <a href="#" id="added" data-container="body" data-type="date" data-pk="<?php echo $line->id; ?>" data-li="<?php echo $line->line_id; ?>" data-ci="<?php echo $line->client_id; ?>"><?php echo $line->added; ?></a>
<script>
    $('#added*').editable({
        placement: 'left',
        pk: '<?php echo $line->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params) {
            params.table = 'line_client';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') {
                return response.msg;
            } else {
                $.ajax({
                    url: "<?php echo base_url().'/administrator/line/addedDateTask'?>",
                    method: "POST",
                    data: {'lineId': '<?php echo $line->line_id; ?>', 'clientId': $(this).attr('data-ci')}
                });
            }

        }
    });

</script>



                                    </td>

                                    <td>
                                        <a href="#" id="removed" data-type="date" data-container="body" data-pk="<?php $line->id; ?>"><?php echo $line->removed; ?></a>
                                    </td>
                                    <td>
                                        <?php if (in_array(role(), array(OWNER))) { ?>
                                            <?php echo '$' . number_format($line->price, 2) ?>
                                        <?php }
                                        if (in_array(role(), array(BROKER))) { ?>
                                            <?php if ($line->ownerBroker == 'true') {
                                                ; ?>
                                                <?php echo '$' . number_format($line->price, 2) ?>
                                            <?php } else {
                                                ; ?>
                                                N/A
                                            <?php }; ?>
                                        <?php }; ?>
                                    </td>

                                    <?php if (in_array(role(), array(BROKER))): ?>
                                        <td>
                                            <?php echo '$' . number_format($line->owner_broker_price, 2) ?>
                                        </td>
                                    <?php endif ?>
                                    <?php if (in_array(role(), array(BROKER))): ?>
                                        <td>
                                            <?php if ($line->clientBroker == 'true') {
                                                ; ?>
                                                <?php echo '$' . number_format($line->client_broker_price, 2) ?>
                                            <?php } else {
                                                ; ?>
                                                N/A
                                            <?php }; ?>
                                        </td>
                                    <?php endif ?>
                                    <td>
                                        <a href="#" id="verified_owner" data-container="body" data-type="date" data-pk="<?php $line->id; ?>"><?php echo $line->verified_onwer; ?></a>
                                    </td>
                                    <td>
                                        <a href="#" id="verified_broker" data-container="body" data-type="date" data-pk="<?php $line->id; ?>"><?php echo $line->verified_broker; ?></a>
                                    </td>
                                    <td>
                                        <a href="#" id="disqualified" data-container="body" data-type="date" data-pk="<?php $line->id; ?>"><?php echo $line->disqualified; ?></a>
                                    </td>
                                    <td>
                                        <a href="#" id="reason" data-type="text" data-pk="<?php $line->id; ?>"><?php echo $line->reason; ?></a>
                                    </td>
                                    <?php if (in_array(role(), array(ADMIN))): ?>
                                        <td><a href="#" id="submit"
                                               data="<?php echo singleQuote(array('id' => $line->id)); ?>"><span
                                                    class="glyphicon glyphicon-trash"></span></a></td>
                                    <?php endif ?>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>




        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span
                                class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add a new Card Type | Name</h4>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="box box-danger">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="type" class="control-label">Card Type:</label>

                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                            <input type="text" class="form-control"
                                                   id="type" name="type" autofocus="autofocus"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="control-label">Issuer Bank Name:</label>

                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                            <input type="text" class="form-control"
                                                   id="bank" name="bank"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="control-label">Card Name:</label>

                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                            <input type="text" class="form-control"
                                                   id="name" name="name"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="control-label">Bank Phone Number:</label>

                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                            <input type="text" class="form-control"
                                                   id="phone" name="phone"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="control-label">Bank Site:</label>

                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                            <input type="text" class="form-control"
                                                   id="site" name="site"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>

    $.fn.editable.defaults.mode = 'popup';
    var table = $('#lineAssignment').dataTable({
        iDisplayLength: 100,
        "scrollX": true,
        "autoWidth": false
    });
    table.fnAdjustColumnSizing();

    $('#reason*,#requested*,#removed*,#disqualified*,#verified_owner*,#verified_broker*').editable({
        placement: 'left',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params) {
            params.table = 'line_client';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });





    $('#added*').editable({
        placement: 'left',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params) {
            params.table = 'line_client';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') {
                return response.msg;
            } else {
                $.ajax({
                    url: "<?php echo base_url().'/administrator/line/addedDateTask'?>",
                    method: "POST",
                    data: {'lineId': $(this).attr('data-li'), 'clientId': $(this).attr('data-ci')}
                });
            }

        }
    });

    $('#client_broker_price, #owner_broker_price').editable({
        placement: 'left',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params) {
            params.table = 'line_client';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });

    $('#submit*').click(function (event) {
        $.ajax({
            url: '<?php echo base_url() . 'administrator/line/deleteLineClient'; ?>',
            data: jQuery.parseJSON($(this).attr("data")),
            method: "POST"
        }).done(function () {
            location.reload();
        })
    });

    //    $("#client").click(function () {
    //        var client_id = $(this).data('id');
    //        $.ajax({
    //            type: "POST",
    //            url: '<?php //echo base_url('administrator/line/lineAssignment')?>//' + '/' + client_id,
    //            data: ({id: client_id}),
    //            success: function (client_id) {
    //                $('#changes').html($(client_id).find('#changes *'));
    //                console.log(client_id);
    //            }
    //        });
    //        $("#myModal").modal();
    //        return false;
    //    });

    if ($(".roles").find("option:selected").val() == 'owner') {
        $('#verified_broker*').editable('toggleDisabled');
        $('#requested*').editable('toggleDisabled');
        $('#owner_broker_price*').editable('toggleDisabled');
    }


</script>


<script>
    $(function () {
        $('#toggle-todo').bootstrapToggle();
    })
</script>

<script>
    $(function () {
        $('#toggle-todo').change(function () {
            if ($(this).prop('checked')) {
                $("#ssn_hide*").toggleClass("display-none");
                $("#dob_hide*").toggleClass("display-none");
                $("#ssn_show*").toggleClass("display-inline");
                $("#dob_show*").toggleClass("display-inline");

            };

            if ($(this).prop('checked') == false) {
                $("#ssn_show*").toggleClass("display-inline");
                $("#dob_show*").toggleClass("display-inline");
                $("#ssn_hide*").toggleClass("display-none");
                $("#dob_hide*").toggleClass("display-none");
            };

        });
    });


</script>