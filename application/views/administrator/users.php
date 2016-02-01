

<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            Clients
            <small>list</small>
            <a class="btn btn-link" href="<?php echo base_url() . 'administrator/user/userForm'; ?>">Add Client</a>
            <a class="btn btn-link" href="<?php echo base_url() . 'administrator/user/systemUserForm'; ?>">Add System
                User</a>
            <a class="btn btn-link" href="<?php echo base_url() . 'administrator/prospect/prospectForm'; ?>">Add
                Prospect</a>

            <a class="btn btn-link" href="<?php echo base_url() . 'administrator/user/systemUsers'; ?>">System Users</a>

        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="<?php echo base_url() . 'administrator/user'; ?>">Clients</a></li>
            <?php if ($userType == 1): ?>
                <li class="active"><?php echo $userType == 1 ? 'System Users' : 'Clients' ?></li>
            <?php endif; ?>
        </ol>
    </section>
    <section class="content">
        <div class="box transbox">
            <div class="box-header">
                <strong><?php echo $userType == 1 ? 'System Users' : 'Clients' ?></strong>
            </div>
            <?php if ($this->session->flashdata('su_message')) { ?>
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <?php echo $this->session->flashdata('su_message'); ?>
                </div>
            <?php } ?>
            <div class="box-body ">
                <div class="table-responsive">
                <table class="table table-bordered table-striped " id="users">
                    <thead>
                    <tr role="row">
                        <th>User Id</th>
                        <th>Name</th>
                        <th>Membership</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Broker</th>
                        <th>Roles</th>
                        <th>Action</th>
                        <th>Status</th>
                        <th>Last Login</th>
                        <th>Created Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($users != 0 && count($users) > 0) {
                        foreach ($users as $key => $user) {
                            $user_info= 'user : <b>'.$user->first_name . ' ' . $user->middle_initial . ' ' . $user->last_name  .'</b>'.' ( '.$user->email.' ) ';
                            ?>
                            <tr role="row">
                                <td> <?php echo anchor(base_url(ADMIN_PATH . 'user/user/' . $user->id), $user->id) ?></td>
                                <td> <?php echo anchor(base_url(ADMIN_PATH . 'user/user/' . $user->id), $user->first_name . ' ' . $user->middle_initial . ' ' . $user->last_name) ?></td>
                                <td><?php echo $user->membership_title ;?></td>
                                <td><a href="#" data-type="text" data-pk="<?php echo $user->id; ?>" id="email"
                                       name="email"><?php echo $user->email; ?></a></td>
                                <td><a href="#" data-type="text" data-pk="<?php echo $user->id; ?>" id="phone"
                                       name="phone"><?php echo $user->phone; ?></a></td>
                                <td>
                                    <div class="form-group">
                                        <a href="#" id="broker_id" data-type="select"
                                           data-value="<?php echo $user->broker_id ?>"
                                           data-pk=<?php echo singleQuote(array('broker_id' => $user->broker_id, 'client_id' => $user->id)); ?>
                                           data-source="<?php echo $brokers ?>"
                                           data-emptytext="select a broker"><?php echo $user->broker_name ?></a>
                                    </div>
                                </td>
                                <td><a href="#" id="role_id" data-type="checklist" data-emptytext="select roles"
                                       data-pk=<?php echo json_encode(array('role_id' => $user_roles[$user->id][0], 'user_id' => $user->id)); ?>
                                       data-value="<?php echo $user_roles[$user->id]; ?>"
                                       email="<?php echo $user->email ?>" data-source="<?php echo $roles ?>"></a>
                                </td>
                                <td><?php if ($userType == 1) { ?>
                                        <a href="#"
                                           data-href="<?php echo base_url() . 'administrator/user/deleteSystemUser' . '/' . $user->id ?>"
                                           data-toggle="modal" data-value="<?php echo $user_info; ?>"  data-target="#confirm-delete"><span
                                                class="glyphicon glyphicon-trash"></span></a>

                                    <?php } else { ?>
                                        <a href="#"
                                           data-href="<?php echo base_url() . 'administrator/user/deleteUser' . '/' . $user->id ?>"
                                           data-toggle="modal" data-value="<?php echo $user_info; ?>" data-target="#confirm-delete"><span
                                                class="glyphicon glyphicon-trash"></span></a>

                                    <?php } ?>
                                </td>
                                <td><a href="" data-type="select" id="status" data-value="<?php echo $user->status ?>"
                                       data-pk="<?php echo $user->id; ?>"
                                       data-source="[ {value: 0, text: 'inactive'}, {value: 1, text: 'active'}]"></a>
                                </td>
                                <td><?php echo date('Y-m-d', strtotime($user->last_login_date)); ?></td>
                                <td><?php echo date('Y-m-d', strtotime($user->created_date)); ?></td>
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
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
            </div>

            <div class="modal-body">
                <p>You are about to delete <span id="user_info"></span>, this procedure is irreversible.</p>

                <p>Do you want to proceed?</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="fail-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Fail Delete</h4>
            </div>

            <div class="modal-body">
                <p>System couldnot able to delete this time.</p>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ok</button>
               
            </div>
        </div>
    </div>
</div>

<script>
    $('#users').dataTable({
        iDisplayLength: 1000
    });

    $('#role_id*').editable({
        <?php $roles = array('admin','super_admin'); echo in_array($this->session->userdata(ROLE_NAME),$roles)?'':'disabled: true,'?>
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params) {
            params.table = 'user_role';
            params.deleteKey = 'user_id';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') {
                return response.msg;
            } else {
                $.ajax({
                    url: "<?php echo base_url().'/administrator/home/changeRoles/'?>",
                    method: "POST",
                    data: {'email': $(this).attr('email')}
                }).done(function (data) {
                    populateDropdown(data, '.roles');
                });
            }
        }
    });
    $('#status*').editable({
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params) {
            params.table = 'user';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });
    $('#phone*').editable({
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        tpl: '<input type="text" class="maskPhone form-control input-sm dd" style="padding-right: 24px;">',
        params: function (params) {
            params.table = 'profile';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });
    $('#broker_id*').editable({
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        prepend: "Unassigned",
        params: function (params, newValue) {
            params.table = 'broker';
            params.deleteKey = 'client_id';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') {
                return response.msg;
            }
        }
    });

    $('#email*').editable({
        pk: '<?php echo $user->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        tpl: '<input type="text"  pattern="^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$" style="padding-right: 24px;">',
        params: function (params) {
            params.table = 'user';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });

    $('#confirm-delete').on('show.bs.modal', function (e) {
        $(this).find('.btn-ok').attr('data-href', $(e.relatedTarget).data('href'));
         $(this).find('#user_info').html($(e.relatedTarget).data('value'));
              
    });
   $('.btn-ok').click( function (e) {
      $("#confirm-delete").hide();
         $.get($(this).data('href'))
               .success(function (data) { 

                try {
                    
                  if(data.length>1) {

                             var data1 = $.parseJSON(data);
                            $msg1 = "Please remove this broker as a parent broker from all other brokers first";
                            if(data1.message==$msg1){
                                  $("#fail-delete").modal().find('.modal-body').text($msg1).show();
                            }else{

                               $("#fail-delete").modal().find('.modal-body').text("Couldnot able to delete this time.").show();
                           }
                 
                      }else{

                           $("#fail-delete").modal().find('.modal-body').text("User is deleted successfully.").show();
                              
                               location.reload();
                            }
                 } catch (e) {
                      $("#fail-delete").modal().find('.modal-body').text(e.getMessages()).show();
                   }
                          
                 
               
                   
            });
    
    });
       
      

    //    function deleteUser(id) {
    //        $.get("<?php //echo base_url() . 'administrator/user/deleteUser'; ?>//" + '/' + id)
    ////            .success(function (data) {
    ////                try {
    ////                    var data1 = $.parseJSON(data);
    ////                    if (data1.message != 'Client has been successfully delete') {
    ////                        $("#baseModal2").modal().find('.modal-body').text(data1.message).show();
    ////                    } else {
    ////                        $.get("<?php ////echo base_url() . 'administrator/user'; ?>////")
    ////                    }
    ////                } catch (e) {
    ////                    $("#baseModal2").modal().find('.modal-body').text(e.getMessages()).show();
    ////                }
    ////            });
    //            .success(function (data) {
    //                try {
    //                    var data1 = $.parseJSON(data);
    //                    if (data1.message) {
    //                        $("#baseModal2").modal().find('.modal-body').text(data1.message).show();
    //                    } else {
    //                        location.reload();
    //                    }
    //                } catch (e) {
    //                    location.reload();
    //                }
    //            });
    //    }

    //    function deleteSystemUser(id) {
    //        $.get("<?php //echo base_url() . 'administrator/user/deleteSystemUser'; ?>//" + '/' + id)
    //            .success(function (data) {
    //                try {
    //                    var data1 = $.parseJSON(data);
    //                    if (data1.message) {
    //                        $("#baseModal2").modal().find('.modal-body').text(data1.message).show();
    //                    } else {
    //                        location.reload();
    //                    }
    //                } catch (e) {
    //                    location.reload();
    //                }
    //            });
    //    }

    $(document).on("focus", ".maskPhone", function () {
        $(".maskPhone").mask("(999)-999-9999");
    });

</script>








