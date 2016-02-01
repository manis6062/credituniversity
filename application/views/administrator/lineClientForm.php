<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            Assign Tradeline
            <small>To a Client</small>
            <a class="btn btn-link" href="<?php echo base_url() . 'administrator/line/lineForm'; ?>">add a tradeline</a>
            <a class="btn btn-link" href="<?php echo base_url() . 'administrator/line/my_lines'; ?>">tradelines</a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="<?php echo base_url() . 'administrator/line/lines'; ?>">lines</a></li>
            <li class="active">add</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <form action="<?php echo base_url() . 'administrator/line/addLineToClient'; ?>" method="post"
                  id="line">
                <div class="col-md-6">
                    <div class="box box-danger">
                        <div class="box-header">
                            <h3 class="box-title">Details:</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group col-md-10">
                                <label class="left">Tradeline:</label>
                                <a style="padding-left: 5em" href="<?php echo base_url() . 'administrator/line/market'; ?>">buy tradelines</a>
                                <?php echo form_dropdown('line_id', $lines, $selectedLine, array('class' => 'form-control select2', 'id' => 'line_id'))
                                ?>
                            </div>
                            <div class="form-group col-md-10">
                                <label class="left">Client:</label>
                                <?php echo form_dropdown('client_id', $clients, '', array('class' => 'form-control select2', 'id' => 'client_id'))
                                ?>
                            </div>
                            <div class="form-group col-md-10">
                                <label for="requested">Requested Months:</label>

                                <div class='input-group date'>
                                    <?php
                                    $option = array(
                                        '' => 'Select no. of Month',
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
                                    echo form_dropdown('months', $option, '', array('class' => 'form-control ', 'id' => 'months')) ?>
                                </div>
                            </div>
                            <div class="form-group col-md-10">
                                <label for="requested">Requested:</label>

                                <div class='input-group date'>
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type='text' class="form-control date-picker" id="requested" name="requested"/>
                                </div>
                            </div>

                            <div class="form-group col-md-10">
                                <label for="requested">Added:</label>

                                <div class='input-group date'>
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type='text' class="form-control date-picker" id="added" name="added"/>
                                </div>
                            </div>
                            <div class="form-group col-md-10">
                                <label for="requested">Removed:</label>

                                <div class='input-group date'>
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type='text' class="form-control date-picker" id="removed" name="removed"/>
                                </div>
                            </div>
                            <div class="form-group col-md-10">
                                <label for="requested">Cancelled:</label>

                                <div class='input-group date'>
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type='text' class="form-control date-picker" id="cancelled" name="cancelled"/>
                                </div>
                            </div>

                        </div>
                        <div class="box-footer">
                            <div class="input-group">
                                              <span class="input-group-btn">
                                                <button type="submit" class="btn btn-primary btn-flat">Add</button>
                                              </span>
                            </div>
                        </div>
                    </div>
                    <div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
<script>
    $( "#requested" ).datepicker({  maxDate: 0 });

    $(".select2").select2();
    $(function () {
        $('#requested, #added, #removed, #cancelled').datepicker({format: 'mm-dd-yyyy'});
    });
    $("#line").bootstrapValidator({
        message: 'This value is not valid',
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }

            }, label: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            }, client_id: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    blank: {}
                }
            }, months: {
                validators: {
                    notEmpty: {
                        message: 'Please select no. of Months'
                    }
                }
            }
        }
    });

</script>



