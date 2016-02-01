<style>
    .small-box > .small-box-footer {
        text-align: left;
    }
</style>
<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            <?php echo $title ?>

            <a id="addCompany" href="#"
               class="btn btn-link">Add Monitoring Service</a>

        </h1>

        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="<?php echo base_url() . 'administrator/creditstatus/view/' . $userId; ?>">credit status</a></li>
            <li class="active">Monitoring Services</li>
        </ol>
    </section>
    <section class="content">



        <div class="row">


            <section class="col-lg-12 connectedSortable ui-sortable">
                <div class="box">
                    <div class="box-header">
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-striped" id="monitoring">
                            <thead>
                            <tr>
                                <th>Company</th>
                                <th>Website URL</th>
                                <th>Image</th>
                                <?php if ((in_array($role, array(ADMIN)))): ?>
                        <th>Edit</th>
                                <?php endif ; ?> <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($company as $key => $val) {
                                ?>
                                <tr class="item">

                                    <td><a href="#" data-pk="<?php echo $val->id ?>" id="name"
                                           data-type="text"><?php echo $val->name; ?></a></td>
                                    <td><a href="#" data-pk="<?php echo $val->id ?>" id="url"
                                           data-type="text"><?php echo($val->url) ?></a></td>
                                    <td align="center" class="tiptext">
                                        <?php if($val->site_image != ''){ ?>
                                            <a href="#"><i class="fa fa-file-image-o"></i>
                                                <iframe class="description" src="<?php echo base_url() . 'uploads/monitoring/' . $val->site_image ?>"></iframe>
                                            </a>
                                     <?php  } else{ ?>
                                            <a href="#"><i class="fa fa-file-image-o"></i>
                                                <iframe class="description" src="#"></iframe>
                                            </a>
                                        <?php } ?>

                                    </td>
                                <?php if ((in_array($role, array(ADMIN)))): ?>
                                    <td align="center">
                                        <form action="<?php echo base_url() . 'administrator/CreditStatus/update_montoringPic' . '/' . $val->id; ?>"
                                            method="post" enctype="multipart/form-data">
                                            <a style="cursor: pointer" id="img_<?php echo $key;?>" class="update_image"><i class="fa fa-edit"></i></a>
                                        <input type="file" onchange="this.form.submit()" class="input_update_image" name="site_image" id="site_image_<?php echo $key;?>"
                                               style="display: none; "/>
                                        </form>


                                    </td>
                                    <?php endif ; ?>

                                     <td align="center">   <a href="#"
                                           onclick="return confirm('Are you sure you want to delete?')? deleteMonitoringService(<?php echo $val->id ?>): '';"><span
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
    </section>


</div>
<div class="modal fade" id="addCompanyModel" tabindex="-1" role="dialog" aria-labelledby="addCompanyModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo base_url() . 'administrator/creditstatus/addMonitoringService'; ?>" method="post"
                  id="monitoringService">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="addLineTypeModalLabel">Add Monitoring Service</h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="box box-danger">
                            <div class="box-body">

                                <div class="form-group">
                                    <label for="type" class="control-label">Monitoring Service Name:</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-university"></i></div>
                                        <input type="text" class="form-control" value="" autocomplete="off" placeholder="Enter Company Name"
                                               id="company" name="company"/>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="site" class="control-label">Website:</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-link"></i></div>
                                        <input type="text" class="form-control" value="" autocomplete="off" placeholder="Enter Company website"
                                               id="site" name="site"/>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Company</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $("#addCompany").click(function () {
        $("#addCompanyModel").modal();
        return false;
    });

    function deleteMonitoringService(id) {
        $.post("<?php echo base_url() . 'administrator/creditstatus/deleteMonitoringService'; ?>", {
            id: id

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


    $('#name*, #url*').editable({
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params) {
            params.table = 'monitoring_service';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });

    $("#monitoringService").formValidation({
        message: 'This value is not valid',
        fields: {
            company: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    blank: {}
                }
            }, site: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    uri: {
                        message: 'Invalid'
                    },
                    blank: {}
                }
            }
        }
    });

    $(".update_image").click(function () {
       $(this).parent().find('.input_update_image').css('display', 'block');
    });

    $(".tiptext").mouseover(function () {
        $(this).find('a').children(".description").show();
    }).mouseout(function () {
            $(this).find('a').children(".description").hide();
        });
</script>



