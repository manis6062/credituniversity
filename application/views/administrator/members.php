<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            Current Members
            <a class="btn btn-link" href="<?php echo base_url() . 'administrator/membership/membershipTypes'; ?>">Membership
                Types</a>
            <a class="btn btn-link" href="<?php echo base_url() . 'administrator/membership/membershipTypeForm'; ?>">Add
                a Membership Type</a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('administrator'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">roles</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">

                    <div class="box-body">
                        <table class="table table-bordered table-striped table-hover" id="members">
                            <thead>
                            <tr>
                                <th>User Id</th>
                                <th>Member Name</th>
                                <th>Role</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($members != 0 && count($members) > 0) {
                                foreach ($members as $member) {
                                    ?>
                                    <tr role="row" class="odd">
                                        <td class="sorting_1"><?php echo $member->user_id; ?></td>
                                        <td>
                                            <a href="<?php echo base_url() . 'administrator/user/user/' . $member->user_id; ?>"
                                               data-type="select" id="role" data-pk="<?php echo $member->user_id ?>"
                                               data-source="<?php echo $roles ?>"
                                               data-value="<?php echo $member->role_id ?>"><?php echo $member->name ?></a>
                                        </td>
                                        <td><a href="#" data-type="select" id="cycle"
                                               data-pk="<?php echo $member->user_id ?>"
                                               data-source="<?php echo $cycles ?>"
                                               data-value="<?php echo $member->cycle_id ?>"><?php echo $member->role ?></a>
                                        </td>
                                        <td><a href="" data-type="text" id="price"
                                               data-pk=<?php echo $member->user_id; ?>> <?php echo $member->type; ?> </a>
                                        </td>

                                        <td><a href="" data-type="select" id="status"
                                               data-value="<?php echo $member->status; ?>"
                                               data-source="[ {value: 0, text: 'inactive'}, {value: 1, text: 'active'}]"
                                               data-pk=<?php echo json_encode(array('type' => $member->membershipTypeId, 'user_id' => $member->user_id)); ?>></a>
                                        </td>
                                        <td>
                                            <a  href="#" data-href="<?php echo base_url(ADMIN_PATH.'membership/deleteMembershipType'). '/' .$member->user_id  . '/' . $member->type_id;?> "
                                               data-toggle="modal" data-target="#confirm-delete"><span
                                                    class="glyphicon glyphicon-trash"></span></a>

                                        </td>
                                    </tr>
                                <?php }
                            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
         <div>
         </div>
    </section>
</div>
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
            </div>

            <div class="modal-body">
                <p>You are about to delete, this procedure is irreversible.</p>

                <p>Do you want to proceed?</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>
<script>

    $('#confirm-delete').on('show.bs.modal', function (e) {
        $(this).find('.btn-ok').attr('data-href', $(e.relatedTarget).data('href'));


    });

    $('.btn-ok').click( function (e) {
        $.get($(this).data('href'))
            .success(function (data) { console.log(data);
                location.reload();
            });

    });

    $('#members').dataTable({
        iDisplayLength: 1000
    });
    $.fn.editable.defaults.mode = 'inline';
    $('#members2 a:not(#delete)').editable({
        /*todo disabled on purpose need to come back and fix this*/
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params) {
            params.table = 'membership_type';
            return params;
        }
    });
    $('#status*').editable({
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params) {
            params.table = 'membership';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });
    function deleteMembershipType(id) {
        var location = '<?php echo base_url(ADMIN_PATH.'membership/deleteMembershipType');?>' + '/' + id;
        window.location.href = location;
    }
</script>








