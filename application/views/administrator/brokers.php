<div class="content-wrapper bg-main">
    <section class="content-header">
        <h4>
            Broker Client (work in progress)
            <small>List</small>
        </h4>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">role auth</li>
        </ol>
    </section>


    <section class="content">
        <div class="row">
            <div class="col-xs-6">
                <div class="box">
                    <div class="box-body">
                        <table id="role_auths" class="table table-bordered table-striped">
                            <thead>
                            <tr role="row">
                                <th>Broker</th>
                                <th>Client Broker</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($brokers as $key => $val) {
                                ?>
                                <tr role="row">
                                    <td><?php echo $key; ?></td>
                                    <td><a href="#" id="broker_id" data-type="checklist" table="broker"
                                           data-pk="<?php echo singleQuote(array('broker_id' => $key, 'client_id' => $val)) ?>"
                                           data-emptytext="select roles"
                                           data-value="<?php echo singleQuote($val) ?>"
                                           data-source="<?php echo singleQuote($val) ?>"</a>
                                    </td>
                                </tr>
                            <?php }
                            ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $('#broker').DataTable({
            iDisplayLength: 100
        });
        $('#broker a').editable({
            url: '<?php echo base_url() . 'administrator/post'; ?>',
            placement: 'right',
            params: function (params) {
                var table = $(this).attr("table");
                params.table = table;
                params.deleteKey = 'client_id';
                return params;
            },
            success: function (response, newValue) {
                if (response.status == 'error') return response.msg;
            }
        });
    </script>

</div>






