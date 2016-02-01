<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            Membership Types
            <a class="btn btn-link" href="<?php echo base_url() . 'administrator/membership/membershipTypeForm'; ?>">Add a Membership Type</a>
            <a class="btn btn-link" href="<?php echo base_url() . 'administrator/membership'; ?>">Members</a>
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
                        <table class="table table-bordered table-striped table-hover" id="membershipTypes">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Role</th>
                                <th>Level</th>
                                <th>Price</th>
                                <th>System Users</th>
                                <th>Client Users</th>
                                <th>Broker Users</th>
                                <th>Owner Users</th>
                                <th>Prospect Users</th>
                                <th>Status</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($membershipTypes != 0 && count($membershipTypes) > 0) {
                                foreach ($membershipTypes as $membershipType) {
                                    ?>
                                    <tr role="row" class="odd">
                                        <td class="sorting_1"><?php echo $membershipType->id; ?></td>
                                        <td><a href="#" data-type="select" id="role" data-pk="<?php echo $membershipType->id ?>" data-source="<?php echo $roles ?>" data-value="<?php echo $membershipType->role_id ?>"><?php echo $membershipType->role ?></a></td>
                                        <td><a href="#" data-type="select" id="level" data-pk="<?php echo $membershipType->id ?>" data-source="<?php echo $levels ?>" data-value="<?php echo $membershipType->level_id ?>"><?php echo $membershipType->level ?></a></td>
                                        <td><a href="" data-type="text" id="price" data-pk=<?php echo $membershipType->id; ?>> <?php echo '$' . number_format($membershipType->price, 2); ?> </a></td>
                                        <td><a href="#" data-type="text" id="system_users" data-pk=<?php echo $membershipType->id; ?>> <?php echo $membershipType->sysuser; ?> </a></td>
                                        <td><a href="#" data-type="text" id="client_users" data-pk=<?php echo $membershipType->id; ?>> <?php echo $membershipType->cliuser; ?> </a></td>
                                        <td><a href="#" data-type="text" id="broker_users" data-pk=<?php echo $membershipType->id; ?>> <?php echo $membershipType->brouser; ?> </a></td>
                                        <td><a href="#" data-type="text" id="owner_users" data-pk=<?php echo $membershipType->id; ?>> <?php echo $membershipType->ownuser; ?> </a></td>
                                        <td><a href="#" data-type="text" id="prospect_users" data-pk=<?php echo $membershipType->id; ?>> <?php echo $membershipType->prouser; ?> </a></td>
                                        <td><a href="#" data-type="select" id="status" data-pk="<?php echo $membershipType->id ?>" data-source="<?php echo $statuses ?>" data-value="<?php echo $membershipType->status_id ?>"><?php echo $membershipType->status ?></a></td>
                                        <td>
                                            <a href="javascript:void(0);" class="delete" id="delete" onclick="deleteMembershipType(<?php echo $membershipType->id ?>)"><i class="fa fa-trash fa-lg"></i></a>
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
    $('#membershipTypes a:not(#delete)').editable({
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params) {
            params.table = 'membership_type';
            return params;
        }
    });
    function deleteMembershipType(id) {
        var location = '<?php echo base_url(ADMIN_PATH.'membership/deleteMembershipType');?>' + '/' + id;
        window.location.href = location;
    }
</script>








