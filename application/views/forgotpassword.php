<section id="register-page">
    <div class="top-legal">
        <div class="center">
            <h1><?php echo $title; ?></h1>
        </div>
    </div>
    <div id="main-forgot" class="box">

        <?php
        if ($this->session->flashdata('message')) {
            ?>
            <div class="message info">
                <div id="message" style="color: red;"></div>
                <p><?php echo $this->session->flashdata('message') ?></p>
            </div>
        <?php } ?>

        <div class="container">
            <div class="col-lg-3"></div>
            <div class="col-lg-4">
                <div class="row">
                    <div id="message" style="color: red; text-align: center; font-size: 16px;"></div>
                    <br>
                    <h4 align="center">Enter the email address that you used for registration.</h4>
                    <?php if (empty($questions)) { ?>
                        <div id="user_input">
                            <div class="row">
                                <?php $attributes = array('id' => 'login-form', 'class' => 'form-horizontal');
                                echo form_open(base_url() . 'member/forgotPassword', $attributes); ?>
                                <div class="form-group col-md-15">


                                    <div class="form-group col-md-12">
                                        <?php $data = array('name' => 'username', 'id' => 'uname', 'placeholder' => 'Enter Your Email', 'value' => set_value('uname'), 'class' => 'form-control',);
                                        echo form_input($data);
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group" style="padding-bottom: 70px;">
                                    <div class="col-sm-offset-4 col-sm-8 ">
                                        <button class="btn btn-default" type="submit">Submit</button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>


                            </div>
                        </div>
                    <?php } ?>

                    <?php if ($questions) { ?>

                    <?php $attributes = array('id' => 'login-form', 'class' => 'form-horizontal');
                    echo form_open(base_url() . 'member/resetPassword', $attributes); ?>
                    <div class="row" id="output">
                        <div class="form-group col-md-13">
                            <label for="Question1">Security Question *</label>

                            <div class="input-group">

                                <?php echo $questions->question1; ?>


                            </div>
                        </div>
                        <div class="form-group col-md-13">
                            <label for="Answer1">Answer *</label>

                            <div class="input-group">
                                <div class="input-group-addon"><strong>A</strong></i></div>
                                <?php echo form_input(array('class' => 'form-control', 'id' => 'answer1', 'name' => 'answer1', 'type' => "text")); ?>
                            </div>

                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-13">
                            <label for="Question2">Security Question *</label>

                            <div class="input-group">

                                <?php echo $questions->question2; ?>

                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="form-group col-md-13">
                            <label for="Answer2">Answer *</label>

                            <div class="input-group">
                                <div class="input-group-addon"><strong>A</strong></i></div>
                                <?php echo form_input(array('class' => 'form-control', 'id' => 'answer2', 'name' => 'answer2', 'type' => "text")); ?>
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8 ">
                            <?php
                            $data = array('name' => 'submit', 'id' => 'submit', 'value' => 'Reset Password', 'class' => 'btn btn-default',);
                            echo form_submit($data);
                            ?>
                            <input type="hidden" name="email" value="<?php echo $useremail;?>">
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
                <?php } ?>


            </div>
        </div>
    </div>

    </div>
</section>



