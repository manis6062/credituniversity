<section id="register-page">
    <div class="top-legal">
        <div class="center">
            <h1><?php echo $title; ?></h1>
        </div>
    </div>
    <div id="main-forgot" class="box">
        <?php $attributes = array('id' => 'update', 'class' => 'form-horizontal box1');
        echo form_open(base_url() . 'member/updatePassword/' . $user_id, $attributes);
        ?>
        <?php if ($this->session->flashdata('message')) { ?>
            <div class="message info">
                <p><?php echo $this->session->flashdata('message') ?></p>
            </div>
        <?php } ?>
        <div class="container">
            <div class="row">

                <div class="form-group col-md-6">
                    <label for="password">Password:</label>

                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-key"></i></div>
                        <?php echo form_input(array('class' => 'form-control', 'id' => 'password', 'name' => 'password', 'type' => "password")); ?>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="form-group col-md-6">
                    <label for="rePassword">Re-Password:</label>

                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-key"></i></div>
                        <?php echo form_input(array('class' => 'form-control', 'id' => 'rePassword', 'name' => 'rePassword', 'type' => "password")); ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-8">

                    <button type="submit" class="btn btn-default">Update Password</button>
                </div>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
</section>
<script>
    $(document).ready(function() {
    $("#update").formValidation({
        message: 'This value is not valid',
        fields: {
            password: {
                validators: {
                    notEmpty: {
                        message: 'The password is required and can\'t be empty'

                    },
                    securePassword: {
                        message: 'The password is not valid'
                    }
                }


            }, rePassword: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    identical: {
                        field: 'password',
                        message: 'Passwords do not match!'
                    },
                    blank: {}
                }
            }
        }
    });
    });
</script>