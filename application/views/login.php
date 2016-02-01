<style>

    /* SQUARED ONE */
    #remember_me {
        margin: 20px auto;
        position: relative;
    }
</style>


<section id="register-page">
    <div class="top-legal">
        <div class="center">
            <h1><?php echo $title; ?></h1>
        </div>
    </div>
    <div class="container">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <?php $attributes = array('id' => 'login-form', 'class' => 'form-horizontal box1');
            echo form_open(base_url() . 'member/signin', $attributes);
            ?>
            <?php
            if ($this->session->flashdata('message')) {?>
                <div class="message info">
                    <p><?php echo $this->session->flashdata('message') ?></p>
                </div>
            <?php } ?>
            <?php if ($this->session->flashdata('memberRegistered')) { ?>
                <div class="message info">
                    <p><?php echo $this->session->flashdata('memberRegistered') ?></p>
                </div>
            <?php } ?>
            <div class="form-group">
                <label for="username" class="col-sm-4 control-label">Username :</label>

                <div class="col-sm-8">
                    <input name="username" id="username" placeholder="enter your user name" class="form-control" autofocus="autofocus"/>
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-4 control-label">Password :</label>

                <div class="col-sm-8">
                    <?php $data = array('name' => 'password', 'type' => 'password', 'placeholder' => 'Enter Password', 'id' => 'password', 'value' => set_value('password'), 'class' => 'form-control','onkeypress'=>'check_CapsLock(event)');
                    echo form_input($data);
                    ?>
                    <div id="caps_lock" style="color:red; font-weight:bold; display:none;">
                        Caps Lock is on!!!
                    </div>
                    <div style="margin-top: 10px;">
                     <a href="#" onclick="window.location.href='<?php echo base_url() . 'member/forgotPassword' ?>'">Forgot Password</a>
                   </div>
                    <div class="clear"></div>
                    <input type="checkbox" value="remember-me" id="remember_me"> Remember me
                </div>

            </div>

            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-8">
                    <?php
                    $data = array('name' => 'submit', 'id' => 'submit', 'value' => 'Login', 'class' => 'btn btn-info');
                    echo form_submit($data);
                    ?>
                </div>
            </div>

            <?php echo form_close(); ?>
        </div>
        <div class="col-lg-3"></div>
    </div>
</section>


<script>
    $(function() {

        if (localStorage.chkbx && localStorage.chkbx != '') {
            $('#remember_me').attr('checked', 'checked');
            $('#username').val(localStorage.username);
            $('#password').val(localStorage.password);
        } else {
            $('#remember_me').removeAttr('checked');
            $('#username').val('');
            $('#password').val('');
        }

        $('#remember_me').click(function() {

            if ($('#remember_me').is(':checked')) {
                // save username and password
                localStorage.username = $('#username').val();
                localStorage.password = $('#password').val();
                localStorage.chkbx = $('#remember_me').val();
            } else {
                localStorage.username = '';
                localStorage.password = '';
                localStorage.chkbx = '';
            }
        });
    });

</script>
<script type="text/javascript">
    function check_CapsLock(e)
    {

        keycode = e.keyCode?e.keyCode:e.which;
        shift = e.shiftKey?e.shiftKey:((keycode == 16)?true:false);
        if(((keycode >= 65 && keycode <= 90) && !shift)||
            ((keycode >= 97 && keycode <= 122) && shift))
        {
            document.getElementById('caps_lock').style.display = 'block';
        }
        else
        {
            document.getElementById('caps_lock').style.display = 'none';
        }
    }
</script>
