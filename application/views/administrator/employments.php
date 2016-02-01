
<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            <?php echo $title; ?>
            <small>list <a style="padding-left: 5em" id="addemploy" href="#">add a new employee details</a></small>


        </h1>


        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">employment</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped" id="emplyee">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Company Name</th>
                        <th>Street</th>
                        <th>City</th>
                        <th>Zip Code</th>
                        <th>Website</th>
                        <th>Position</th>
                        <th>Yearly Salary</th>
                        <th>Experienced</th>
                        <th>Phone Number</th>
                        <th>Comment</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($employ as $employ) { ?>
                        <tr class="item">
                            <td><?php echo $employ->id; ?></td>
                            <td><a href="#" data-pk="<?php echo $employ->id ?>" id="company"
                                   data-type="text"><?php echo($employ->company) ?></a></td>
                            <td><a href="#" data-pk="<?php echo $employ->id ?>" id="street_employment"
                                   data-type="text"><?php echo($employ->street_employment) ?></a></td>
                            <td><a href="#" data-pk="<?php echo $employ->id ?>" id="city_employment"
                                   data-type="text"><?php echo($employ->city_employment) ?></a></td>
                            <td><a href="#" data-pk="<?php echo $employ->id ?>" id="zip_employment"
                                   data-type="text"><?php echo($employ->zip_employment) ?></a></td>
                            <td><a href="#" data-pk="<?php echo $employ->id ?>" id="web_address"
                                   data-type="text"><?php echo($employ->web_address) ?></a></td>
                            <td><a href="#" data-pk="<?php echo $employ->id ?>" id="position"
                                   data-type="text"><?php echo $employ->position; ?></a></td>
                            <td><a href="#" id="salary"
                                   data-value="<?php echo '$' . $employ->salary ?>"
                                   data-pk=<?php echo $employ->id; ?><?php echo '$' . $employ->salary ?></a>
                            </td>
                            <td><a href="#" id="years" data-type="select" data-value="<?php echo $employ->years ?>"
                                   data-pk=<?php echo $employ->id; ?> data-source="<?php echo '[{value:1,text:1},{value:2,text:2},{value:3,text:3},{value:4,text:4},{value:5,text:5},{value:6,text:6},{value:7,text:7},{value:8,text:8},{value:9,text:9},{value:10,text:10},{value:11,text:11},{value:12,text:12},{value:13,text:13},{value:14,text:14},{value:15,text:15},{value:16,text:16},{value:17,text:17},{value:18,text:18},{value:19,text:19},{value:20,text:20}]' ?>"
                                   data-emptytext="years"><?php echo $employ->years ?></a>
                                Year
                                <a href="#" id="months" data-type="select"
                                   data-value="<?php echo $employ->months ?>"
                                   data-pk=<?php echo $employ->id; ?>
                                   data-source="<?php echo '[{value:1,text:1},{value:2,text:2},{value:3,text:3},{value:4,text:4},{value:5,text:5},{value:6,text:6},{value:7,text:7},{value:8,text:8},{value:9,text:9},{value:10,text:10},{value:11,text:11},{value:12,text:12}]' ?>"
                                   data-emptytext="months"><?php echo $employ->months ?></a> Month
                            </td>
                            <td><a href="#" data-pk="<?php echo $employ->id ?>" id="phone_employment"
                                   data-type="text"><?php echo $employ->phone_employment; ?></a></td>
                            <td><a href="#" data-pk="<?php echo $employ->id ?>" id="comment_employment"
                                   data-type="text"><?php echo $employ->comment_employment; ?></a></td>
                            <td>
                                <a href="#"
                                   onclick="return confirm('Are you sure you want to delete?')? deleteEmployment(<?php echo $employ->id . ',' . $employ->user_id ?>): '';"><span
                                        class="glyphicon glyphicon-trash"></span></i></a>
                            </td>

                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="employment" tabindex="-1" role="dialog"
     aria-labelledby="employment" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo base_url() . 'administrator/employment/addEmployment'; ?>"
                  method="post"
                  id="addemploye">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="employment">Add a new Employement Details</h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="box box-danger">
                            <div class="box-body">
                                <div class="form-group col-md-6">
                                    <label class="left">Employer:</label>
                                    <input type='text' class="form-control" id="company1" name="company1"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="left">Position:</label>
                                    <input type='text' class="form-control" id="position1"
                                           name="position1"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="sal">Yearly Salary:</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-dollar"></i></div>
                                        <input type="text" class="form-control" id="sal" name="sal"/>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="phone">Phone number:</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                        <input type="text" class="form-control"
                                               id="phone1" name="phone1"
                                               data-mask="(999) 999-9999" placeholder="(999) 999-9999"/>
                                    </div>
                                </div>


                                <div class="form-group col-md-12">
                                    <label style="padding-left: 15px;" >How long did you work here?</label>
                                    </br>



                                    <div class='form-group col-md-3'>
                                        <label for="experienced">Year</label>
                                        <?php
                                        $option = array(
                                            '' => 'Year',
                                            '1' => '1',
                                            '2' => '2',
                                            '3' => '3',
                                            '4' => '4',
                                            '5' => '5',
                                            '6' => '6',
                                            '7' => '7',
                                            '8' => '8',
                                            '9' => '9',
                                            '10' => '10',
                                            '11' => '11',
                                            '12' => '12',
                                            '13' => '13',
                                            '14' => '14',
                                            '15' => '15',
                                            '16' => '16',
                                            '17' => '17',
                                            '18' => '18',
                                            '19' => '19',
                                            '20' => '20'
                                        );

                                        echo form_dropdown('years', $option, '', array('class' => 'form-control ', 'id' => 'year')) ?>
                                    </div>


                                    <div class='form-group col-md-3'>
                                        <label for="experienced">Month</label>
                                        <?php
                                        $option = array(
                                            '' => 'Month',
                                            '1' => '1',
                                            '2' => '2',
                                            '3' => '3',
                                            '4' => '4',
                                            '5' => '5',
                                            '6' => '6',
                                            '7' => '7',
                                            '8' => '8',
                                            '9' => '9',
                                            '10' => '10',
                                            '11' => '11',
                                            '12' => '12',
                                        );

                                        echo form_dropdown('months', $option, '', array('class' => 'form-control ', 'id' => 'month')) ?>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="Street1">Street:</label>
                                        <input data-type="text" class="form-control" id="street1"
                                               name="street1"/>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="city1">City:</label>
                                    <input data-type="text" class="form-control" id="city1"
                                           name="city1"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="zip1">Zip Code:</label>
                                    <input data-type="text" class="form-control" id="zip1"
                                           name="zip1"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="web_address2">Web Address:</label>
                                    <input data-type="text" class="form-control" id="web_address2"
                                           name="web_address2"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="comment1">Comment:</label>
                                    <input data-type="text" class="form-control" id="comment1"
                                           name="comment1"/>
                                </div>
                                <input type="hidden" class="form-control" id="user_id" name="user_id"
                                       value="<?php echo $userId ?>"/>
                                <input type="hidden" class="form-control" id="type" name="protype"
                                       value="<?php echo $protype; ?>"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Employee</button>
                </div>
            </form>
        </div>
    </div>
    1
</div>
<script>

    $(document).on("focus", "#sal", function () {
        $(this).mask("000,000,000,000,000", {reverse: true});
    });

    $(document).on("focus", ".salarymask", function () {
        $(this).mask("000,000,000,000,000", {reverse: true});
    });

    $(document).on("focus", ".zipmask", function () {
        $(this).mask("00000");
    });

    $(document).on("focus", "#zip1", function () {
        $(this).mask("00000");
    });

    $(document).on("focus", ".phonemask", function () {
        $(this).mask("(000) 000-0000");
    });

        $(document).on("focus", ".webmask", function () {
            $(this).mask("uri");
        });

    function deleteEmployment(id, userid) {
        $.post("<?php echo base_url() . 'administrator/employment/deleteEmployment'; ?>", {
            id: id,
            user_id: userid
        })
            .success(function (data) {
                try {
                    var data1 = $.parseJSON(data);
                    if (data1.message) {
                        $("#baseModal2").modal().find('.modal-body').text(data1.message).show();
                    } else {
                        location.reload();
                    }
                } catch (e) {
                    location.reload();
                }
            });
    }

    $('#company*,#position*,#street_employment*,#url*,#comment_employment*').editable({

        pk: '<?php echo $employ->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params) {
            params.table = 'employment';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') {
                return response.msg;
            }
            location.reload();
        }
    });

    $('#city_employment*').editable({
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        tpl: '<input type="text" title="Only Alphabet" pattern="^[a-zA-Z\s]+$" style="padding-right: 24px;">',
        params: function (params) {
            params.table = 'employment';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
            location.reload();
        }
    });

    $('#phone_employment*').editable({
        placement: 'right',
        pk: '<?php echo $employ->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        tpl: '<input type="text"   class="phonemask"  style="padding-right: 24px;">',
        params: function (params) {
            params.table = 'employment';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
            location.reload();
        }
    });

        $('#web_address*').editable({
            placement: 'right',
            pk: '<?php echo $employ->id;?>',
            url: '<?php echo base_url() . 'administrator/post'; ?>',
            tpl: '<input type="text"   class="webmask"  style="padding-right: 24px;">',
            params: function (params) {
                params.table = 'employment';
                return params;
            },
            success: function (response, newValue) {
                if (response.status == 'error') return response.msg;
                location.reload();
            }
        });

    $('#zip_employment*').editable({
        placement: 'right',
        pk: '<?php echo $employ->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        tpl: '<input type="text"   class="zipmask"   style="padding-right: 24px;">',
        params: function (params) {
            params.table = 'employment';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
            location.reload();
        }
    });

    $('#salary*').editable({
        placement: 'right',
        pk: '<?php echo $employ->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        tpl: '<input type="text" class="salarymask"   style="padding-right: 24px;">',
        params: function (params) {
            params.table = 'employment';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
            location.reload();
        }
    });

    $('#months*,#years*').editable({
        placement: 'right',
        url: '<?php echo base_url() . 'administrator/post'; ?>',

        params: function (params, newValue) {
            params.table = 'employment';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') {
                return response.msg;
            }
            location.reload();
        }
    });

    $("#addemploy").click(function () {
        $("#employment").modal();
        return false;
    });

    $("#addemploye").bootstrapValidator({
        message: 'This value is not valid',
        fields: {
            company1: {
                validators: {
                    notEmpty: {
                        message: 'Enter Company'
                    },
                    blank: {}
                }
            }, join1: {
                validators: {
                    notEmpty: {
                        message: 'Enter Date Of Joining Company '
                    },
                    blank: {}
                }
            }, position1: {
                validators: {
                    notEmpty: {
                        message: 'Enter Position At Work'
                    },
                    regexp: {
                        regexp: /^[a-z\d\-_\s]+$/i

                    },
                    blank: {}
                }
            }, sal: {
                validators: {
                    notEmpty: {
                        message: 'Enter Salary Amount'
                    },
                    regexp: {
                        regexp: /[0-9]+(,[0-9]+)*,?/

                    },
                    blank: {}
                }
            }, phone1: {
                validators: {
                    notEmpty: {
                        message: 'Phone no. is required'
                    },
                    stringLength: {
                        min: 10,
                        message: 'Must be of Length 10'
                    },
                    blank: {}
                }
            }, city1: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    blank: {}
                }
            }, street1: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    blank: {}
                }
            }, zip1: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    stringLength:{
                        min :5,
                        message : 'Must be of Length 5'
                    },

                    blank: {}
                }
            },
            web_address2: {
                validators: {
                    optional: true,
                    uri: {
                        message: 'Invalid'
                    }
                }
            }
        }


    });
</script>



