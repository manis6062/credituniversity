<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            roles
            <small>list</small>
            <a class="btn btn-link" href="<?php echo base_url() . 'administrator/role/roleForm'; ?>">add a
                role</a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">roles</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table class="table table-bordered table-striped table-hover" id="roles">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>value</th>
                                <th>label</th>
                                <th>action</th>
                                <th>public</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($data != 0 && count($data) > 0) {
                                foreach ($data as $key => $role) {
                                    ?>
                                    <tr role="row" class="odd">
                                        <td class="sorting_1"><?php echo $role->id; ?></td>
                                        <td><a href="" data-type="text" id="name"
                                               data-pk=<?php echo $role->id; ?>> <?php echo $role->name; ?> </a></td>
                                        <td><a href="" data-type="text" id="label"
                                               data-pk=<?php echo $role->id; ?>> <?php echo $role->label; ?> </a></td>
                                        <td>
                                            <submit type="text"
                                                    onclick="deleteRole(<?php echo $role->id ?>)">
                                                <i class="btn btn-danger fa fa-trash"></i>
                                            </submit>
                                        </td>
                                        <td><a href="" data-type="select" id="public"
                                               data-value="<?php echo $role->public ?>"
                                               data-source="[ {value: 0, text: 'No'}, {value: 1, text: 'Yes'}]"
                                               data-pk=<?php echo $role->id; ?>></a>
                                        </td>
                                    </tr>
                                <?php }
                            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </section>
</div>
<script>
    $('#roles').DataTable();
    $.fn.editable.defaults.mode = 'inline';
    $('#roles a').editable({
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params) {
            params.table = 'role';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') {
                return response.msg;
            } else {
                $.ajax({
                    url: "<?php echo base_url().'/administrator/home/changeRoles/'?>",
                    method: "POST",
                    data: {'email': '<?php echo $this->session->userdata(EMAIL);?>'}
                }).done(function (data) {
                    populateDropdown(data, '.roles');
                });
            }
        }
    });
    function deleteRole(id) {
        var location = '<?php echo base_url(ADMIN_PATH.'role/deleteRole');?>' + '/' + id;
        window.location.href = location;
    }
</script>








