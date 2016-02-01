<div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
    <section class="content-header">
        <h1>
            Send NewsLetter
            <a class="btn btn-link" href="<?php echo base_url() . 'administrator/newsletter/sentNewsletters'; ?>">Sent Newsletters</a>
            <a class="btn btn-link" href="<?php echo base_url() . 'administrator/newsletter'; ?>">Newsletter Templates</a>
            <a class="btn btn-link" href="<?php echo base_url() . 'administrator/newsletter/newsletterForm'; ?>">Add a Newsletter</a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="<?php echo base_url() . 'administrator/newsletter'; ?>"><i class="fa fa-newspaper-o"></i>Newsletters Templates</a></li>
            <li class="active">Send Newsletter</li>
        </ol>
    </section>
    <section class="content">
        <form action="<?php echo base_url() . 'administrator/newsletter/sendNewsletter'; ?>" method="post" id="newsletter">
            <div class="row col-md-6">
                <div class="box box-info">
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="subject">Subject:</label>

                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-rss"></i></div>
                                    <input type='text' class="form-control" id='subject' name="subject" autofocus/>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <label for="template">Template :</label>
                                    <select name="template" id="template" class="select2" data-width="300px">
                                        <?php
                                        if (!empty($getAllTemplates)) {
                                            foreach ($getAllTemplates as $key => $values) { ?>
                                                <option
                                                    value="<?php echo $values->id; ?>"><?php echo $values->title; ?> </option>
                                            <?php }
                                        } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-5">
                                <div class="input-group" id="to1">
                                    <label for="group">Recipients :</label>
                                    <?php echo form_dropdown('recipients[]', array('select' => 'Select Recipients', 'brokers' => 'Brokers', 'clients' => 'Clients', 'owners' => 'Tradeline Owners', 'subscribers' => 'Subscribers'), '', array('class' => 'select2 emailAddress', 'data-width' => '300px', 'multiple' => 'multiple', 'id' => 'recipients')) ?>
                                </div>
                            </div>
                            <div class="form-group col-md-5" style="margin-left: 55px">
                                <div class="input-group" id="to2">
                                    <label for="users">Individuals :</label>
                                    <select name="users[]" id="users" class="select2 emailAddress" data-width="300px" multiple="multiple">
                                        <?php
                                        if (!empty($users)) {
                                            foreach ($users as $key => $values) { ?>
                                                <option value="<?php echo $values->id; ?>"><?php echo $values->first_name . ' ' . $values->last_name . ' ' . $values->role_name . ' ' . $values->email; ?> </option>
                                            <?php }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="input-group">
                            <input type="submit" class="btn btn-primary btn-flat" value="Send">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>

<!--    <div class="form-group col-md-6">-->
<!--        <div class="input-group">-->
<!--            --><?php //$attributes = array('class' => 'formular', 'id' => 'form2');
//            echo form_open_multipart(ADMIN_PATH . 'newsletter/subscribe', $attributes);
//            $data = array('name' => 'subscribe', 'id' => 'subscribe', 'placeholder' => 'Enter an Email');
//            echo form_input($data);
//            $data1 = array('name' => 'submit', 'id' => 'submit', 'value' => 'Subscribe', 'class' => 'btn btn-primary fa fa-save ',);
//            echo form_submit($data1);
//            ?>
<!--            --><?php //echo form_close(); ?>
<!--        </div>-->
<!--    </div>-->
</div>

<script type="text/javascript">
    $('#send_templates').dataTable();
    $(".select2").select2({
        placeholder: "Make one or more selections"
    });
    $("#newsletter").bootstrapValidator({
        message: 'This value is not valid',
        fields: {
            subject: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            }
        }
    });
</script>
