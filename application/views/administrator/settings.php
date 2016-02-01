<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            System Settings
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="<?php echo base_url() . 'administrator/role/roles'; ?>">roles</a></li>
            <li class="active">add</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <form action="<?php echo base_url() . 'administrator/settings/setPaypal'; ?>" method="post"
                  id="line">
                <div class="col-md-6">
                    <div class="box box-danger">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Paypal State : </label><br/>
                                <?php echo form_radio('paypal', 'live', $paypal == 'live'?'selected':'') ?>
                                <label>Live</label>
                                <?php echo form_radio('paypal', 'sandbox', $paypal == 'sandbox'?'selected':'') ?>
                                <label>Sandbox</label>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="input-group">
                                              <span class="input-group-btn">
                                                <button type="submit" class="btn btn-primary btn-flat">Submit</button>
                                              </span>
                        </div>
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



