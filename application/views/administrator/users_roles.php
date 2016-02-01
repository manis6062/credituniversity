<link href="<?php echo base_url(); ?>backend/css/americacpn.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url() . ADMIN_JS; ?>bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet">
<div class="content-wrapper bg-main">
    <section class="content-header">
        <a class="btn btn-primary" href="<?php echo base_url() . 'administrator/role/addRole'; ?>">Add Role</a>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h4>
                    Following users are currently assiged this role - '<?php echo $data[0]->label ?>'<br/>
                    <small>Delete the role from following users first. Then you can delete this role.</small>
                </h4>
            </div>
            <div class="box-body">
                <table id="roles" class="table table-bordered table-striped">
                    <thead>
                    <tr role="row">
                        <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                            style="width: 180px;" aria-label="Rendering engine: activate to sort column ascending"
                            aria-sort="descending">user id
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                            style="width: 229px;" aria-label="Browser: activate to sort column ascending">name
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                            style="width: 229px;" aria-label="Browser: activate to sort column ascending">role
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($data != 0 && count($data) > 0) {
                        foreach ($data as $key => $user) {
                            ?>
                            <tr role="row" class="odd">
                                <td class="sorting_1"><?php echo $user->user_id; ?></td>
                                <td><?php echo $user->name; ?></td>
                                <td><?php echo $user->label; ?></td>
                            </tr>
                        <?php }
                    } ?>
                    </tbody>
                </table>
                <input type="submit" class="btn btn-primary btn-flat" value="Delete" onclick="deleteUsersFromRole()"/>
                <input type="button" class="btn btn-primary btn-flat" value="Cancel" onclick="window.history.back()"/>
    </section>
</div>

<script>

    function deleteUsersFromRole() {
        window.location.href = '<?php echo base_url(ADMIN_PATH.'role/deleteUsersFromRole/'.$data[0]->id);?>';
        var selectedOption = $(".roles").find("option:selected");
        $.ajax({
            url: "<?php echo base_url().'/administrator/home/changeRoles/'?>",
            method: "POST",
            data: {
                'email': '<?php echo $data[0]->email;?>'
            }
        }).done(function (data) {
            populateDropdown(data, '.roles');
        });
    }

</script>








