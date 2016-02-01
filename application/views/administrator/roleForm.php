<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            role
            <small>add</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="<?php echo base_url() . 'administrator/role/roles'; ?>">roles</a></li>
            <li class="active">add</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <form action="<?php echo base_url() . 'administrator/role/addRole'; ?>" method="post"
                  id="line">
                <div class="col-md-6">
                    <div class="box box-danger">
                        <div class="box-header">
                            <h3 class="box-title">role information:</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <?php $data = array(
                                    'name' => 'name',
                                    'id' => 'name',
                                    'placeholder' => 'enter role name',
                                    'value' => set_value('value'),
                                    'class' => 'form-control',
                                    'autofocus' => 'true'
                                );
                                echo form_input($data);
                                ?>
                            </div>
                            <div class="form-group">
                                <?php
                                $data = array(
                                    'name' => 'label',
                                    'id' => 'label',
                                    'placeholder' => 'enter role label',
                                    'value' => set_value('label'),
                                    'class' => 'form-control',);
                                echo form_input($data);
                                ?>
                            </div>
                            <div class="form-group col-md-3 no-padding">
                                <label>Public</label>
                                <?php $data = array(
                                    '1' => 'Yes',
                                    '0' => 'No',
                                );
                                echo form_dropdown('public', $data, '1', array('id' => 'public', 'class' => 'form-control select2'));
                                ?>
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
    $("#line").bootstrapValidator({
        message: 'This value is not valid',
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'The role name  is required and can\'t be empty'
                    }
                }

            }, label: {
                validators: {
                    notEmpty: {
                        message: 'label is required'
                    }
                }
            }
        }
    });
</script>



