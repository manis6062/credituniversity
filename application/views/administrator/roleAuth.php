<div class="content-wrapper bg-main">
    <section class="content-header">
        <h4>
            role auth
            <small>list</small>
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
                                <th>role</th>
                                <th>auth</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($role_auths as $key => $val) {
                                ?>
                                <tr role="row">
                                    <td><?php echo $roles[$key]; ?></td>
                                    <td><a href="#" id="auth_id" data-type="checklist" table="role_auth"
                                           data-pk="<?php echo singleQuote(array('role_id' => $key, 'auth_id' => $val[0])) ?>"
                                           data-emptytext="select roles"
                                           data-value="<?php echo singleQuote($val) ?>"
                                           data-source="<?php echo $auths ?>"></a>
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
        $('#role_auths').DataTable({
            iDisplayLength: 100
        });
        $('#role_auths a').editable({
            url: '<?php echo base_url() . 'administrator/post'; ?>',
            placement: 'right',
            params: function (params) {
                var table = $(this).attr("table");
                params.table = table;
                params.deleteKey = 'role_id';
                return params;
            },
            success: function (response, newValue) {
                if (response.status == 'error') return response.msg;
            }
        });
    </script>

</div>






