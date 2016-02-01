<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            auth
            <small>add</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="<?php echo base_url() . 'administrator/auth/auths'; ?>">auths</a></li>
            <li class="active">add</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <form action="<?php echo base_url() . 'administrator/auth/addAuth'; ?>" method="post"
                  id="line">
                <div class="col-md-6">
                    <div class="box box-danger">
                        <div class="box-body">
                            <div class="form-group">
                                <?php $data = array(
                                    'name' => 'name',
                                    'id' => 'name',
                                    'placeholder' => 'enter auth name',
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
                                    'placeholder' => 'enter auth label',
                                    'value' => set_value('label'),
                                    'class' => 'form-control',);
                                echo form_input($data);
                                ?>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="input-group">
                                              <span class="input-group-btn">
                                                <button type="submit" class="btn btn-primary btn-flat">add</button>
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
        /*http://www.jqueryscript.net/form/Powerful-Form-Validation-Plugin-For-jQuery-Bootstrap-3.html*/
        message: 'This value is not valid',
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'The auth name  is required and can\'t be empty'
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



