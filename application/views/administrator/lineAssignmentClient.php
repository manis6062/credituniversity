<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            Tradeline
            <small>Transactions</small>
            <?php if (in_array($role, array(BROKER, ADMIN))): ?>
                <a class="btn btn-link" href="<?php echo base_url() . 'administrator/line/lineClientForm'; ?>">Assign Tradeline</a>
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
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Line#</th>
                                <th>Owner</th>
                                <th>Line</th>
                                <th>Client</th>
                                <th>Requested</th>
                                <th>Added</th>
                                <th>Broker Verified</th>
                                <th>Removed</th>
                                <th>Owner Verified</th>
                                <th>Cancelled</th>
                                <th>Reason</th>
                                <?php if (in_array(role(), array(BROKER))): ?>
                                    <th>Client Broker</th>
                                    <th>Owner Broker</th>
                                <?php endif ?>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ((array)$lines as $key => $line) { ?>
                                <tr class="item">
                                    <td><?php echo($line->id) ?></td>
                                    <td><?php echo anchor('/administrator/line/lines/' . $line->line_id, $line->line_id, array('id' => 'popoverOption' . $key, 'data-type' => 'text', 'class' => 'btn', 'rel' => 'popover', 'data-placement' => 'right', 'data-html' => 'true', 'data-original-title' => $line->owner_name, 'data-content' => str_replace('-', '<br>', $line->line))) ?></td>
                                    <td><?php echo anchor('/administrator/user/user/' . $line->owner_id, $line->owner_name, array('id' => 'owner', 'data-type' => 'text')) ?></td>
                                    <td><?php echo anchor('/administrator/line/lineClientForm/' . $line->line_id, $line->line, array('id' => 'line', 'data-type' => 'text')) ?></td>
                                    <td><?php echo anchor('#', $line->client_name, array('title' => "Client Description", 'data-id' => $line->client_id, 'id' => 'client', 'data-type' => 'text')) ?></td>
                                    <td><?php echo anchor('#', $line->requested, array('id' => 'requested', 'data-type' => 'date', 'data-pk' => $line->id)) ?></td>
                                    <td><?php echo anchor('#', $line->added, array('id' => 'added',  'data-type' => 'date', 'data-pk' => $line->id, 'data-li'=>$line->line_id,'data-ci'=>$line->client_id)) ?></td>
                                    <td><?php echo anchor('#', $line->verified_broker, array('id' => 'verified_broker', 'data-type' => 'date', 'data-pk' => $line->id, 'data-li'=>$line->line_id,'data-ci'=>$line->client_id)) ?></td>
                                    <td><?php echo anchor('#', $line->removed, array('id' => 'removed', 'data-type' => 'date', 'data-pk' => $line->id)) ?></td>
                                    <td><?php echo anchor('#', $line->verified_owner, array('id' => 'verified_owner', 'data-type' => 'date', 'data-pk' => $line->id)) ?></td>
                                    <td><?php echo anchor('#', $line->disqualified, array('id' => 'disqualified', 'data-type' => 'date', 'data-pk' => $line->id)) ?></td>
                                    <td><?php echo anchor('#', $line->reason, array('id' => 'reason', 'data-type' => 'text', 'data-pk' => $line->id)) ?></td>
                                    <?php if (in_array(role(), array(BROKER))): ?>
                                        <td><a href="#" id="client_broker_price" name="client_broker_price" data-pk="<?php echo $line->id ?>" data-type="text"><?php echo '$' . number_format($line->client_broker_price) ?></a></td>
                                        <td><a href="#" id="owner_broker_price" name="owner_broker_price" data-pk="<?php echo $line->id ?>" data-type="text"><?php echo '$' . number_format($line->owner_broker_price) ?></a></td>
                                    <?php endif ?>

                                    <td><a href="#" id="submit" data="<?php echo singleQuote(array('id' => $line->id)) ?>"><span class="glyphicon glyphicon-trash"></span></a></td>
                                    <script>
                                        $('#popoverOption<?php echo $key?>').popover({trigger: "hover"});
                                    </script>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
    $('#lineAssignment').DataTable({
        iDisplayLength: 100,
        "scrollX": true,
        "sScrollY": $(window).height()
    });
    $('#reason*,#requested*,#removed*,#disqualified*,#verified_owner*,#verified_broker*').editable({
        placement: 'right',
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
        placement: 'right',
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
                    data: {'lineId': $(this).attr('data-li'),'clientId': $(this).attr('data-ci')}
                });
            }

        }
    });

    $('#verified_broker*').editable({
        placement: 'right',
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
                    url: "<?php echo base_url().'/administrator/line/emailAfterBrokerVerified'?>",
                    method: "POST",
                    data: {'lineId': $(this).attr('data-li'),'clientId': $(this).attr('data-ci')}
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

    $("#client").click(function () {
        var client_id = $(this).data('id');
        $.ajax({
            type: "POST",
            url: '<?php echo base_url('administrator/line/lineAssignment')?>' + '/' + client_id,
            data: ({id: client_id}),
            success: function (client_id) {
                $('#changes').html($(client_id).find('#changes *'));
                console.log(client_id);
            }
        });
        $("#myModal").modal();
        return false;
    });


</script>