<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            Prospects
            <a class="btn btn-link" href="<?php echo base_url() . 'administrator/prospect/prospectForm'; ?>">Add
                Prospect</a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">users</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <strong>Users</strong>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped" id="prospects">
                    <thead>
                    <tr role="row">
                        <th>Prospect Id</th>
                        <th>Role</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Action</th>
                        <th>Notes</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ((array)$prospects as $key => $prospect) { ?>
                        <tr role="row">
                            <td>
                                <a href="<?php echo base_url() . 'administrator/prospect/prospect/' . $prospect->id; ?>"><?php echo $prospect->id; ?></a>
                            </td>
                            <td><a href="#" id="role_id" data-type="select" data-pk="<?php echo $prospect->id; ?>"
                                   data-value="<?php echo $prospect->role_id ?>"
                                   data-source="<?php echo $roles ?>"><?php echo $prospect->label; ?></a></td>
                            <td><a href="#" data-type="text" data-pk="<?php echo $prospect->id; ?>" id="first_name"
                                   name="first_name"><?php echo $prospect->first_name; ?></a></td>
                            <td><a href="#" data-type="text" data-pk="<?php echo $prospect->id; ?>" id="last_name"
                                   name="last_name"><?php echo $prospect->last_name; ?></a></td>
                            <td><a href="#" data-type="text" data-pk="<?php echo $prospect->id; ?>" id="email"
                                   name="email"><?php echo $prospect->email; ?></a></td>
                            <td><a href="#" data-type="text" data-pk="<?php echo $prospect->id; ?>" id="phone"
                                   name="phone"><?php echo $prospect->phone; ?></a></td>
                            <td>
                                <a href="javascript:void(0);"
                                   onclick="return confirm('Are you sure you want to delete?')?deleteProspect(<?php echo $prospect->id ?>): '';"><i
                                        class="fa fa-trash fa-lg"></i></a>
                            </td>
                            <td><?php echo current($notes[$prospect->id]) ?> <a
                                    href="<?php echo base_url() . 'administrator/prospect/prospect/' . $prospect->id; ?>"> </a>
                            </td>


                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<script>
    $('#prospects').dataTable({
        iDisplayLength: 1000
    });

    $('#first_name*, #last_name*, #email*, #phone*, #role_id*').editable({
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params) {
            params.table = 'prospect';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') {
                return response.msg;
            } else {
                location.reload();
            }
        }
    });

    function deleteProspect(id) {
        $.get("<?php echo base_url() . 'administrator/prospect/deleteProspect'; ?>" + '/' + id)
            .success(function (data) {
                try {
                    var data1 = $.parseJSON(data);
                    if (data1.message != '') {
                        $("#baseModal2").modal().find('.modal-body').text(data1.message).show();
                    } else {
                        location.reload();
                    }
                } catch (e) {
                    location.reload();
                }
            });
    }

    $(document).on("focus", ".maskPhone", function () {
        $(this).mask("(999)-999-9999");
    });
</script>








