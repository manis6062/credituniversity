<div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
    <section class="content-header">
        <h1>
            Send NewsLetter
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">add</li>
        </ol>
    </section>
    <section class="content">
        <div id="row">
            <section class="content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="box box-danger">
                            <div class="box-header">
                                <h3 class="box-title"><?php echo $title ?></h3>
                            </div>
                            <?php $attributes = array('class' => 'formular', 'id' => 'form');
                            echo form_open_multipart(ADMIN_PATH . 'newsletter/sendNewsletter', $attributes);
                            ?>
                            <div class="box-body">
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-xs-6">
                                            <label>Email Subject (*):
                                            </label>
                                            <input type="text" class="form-control"
                                                   name="subject" required>
                                        </div>
                                    </div>
                                    <input class="col-xs-4 btn bg-olive btn-flat margin" id="mybutton" type="button"
                                           onclick="changeText()" value="Send To Subcribers"/>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-xs-12" id="to">
                                            <label>Select Users (*):</label>
                                            <select name="users" id="changes" class="selectpicker" data-width="148px">
                                                <option data-hidden="true" value="">Choose User</option>
                                                <?php
                                                if (!empty($users)) {
                                                    foreach ($users as $key => $values) {
                                                        ?>
                                                        <option value="<?php echo $values->id; ?>"><?php echo $values->first_name; ?> </option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-xs-12">
                                            <label>Select Templates (*):</label>
                                            <select name="template" class="selectpicker" data-width="148px">
                                                <?php
                                                if (!empty($getAllTemplates)) {
                                                    foreach ($getAllTemplates as $key => $values) {
                                                        ?>
                                                        <option
                                                            value="<?php echo $values->id; ?>"><?php echo $values->title; ?> </option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-12" id="toggle" style="display: none">
                                            <label>Select Subcribers (*):</label>
                                            <select name="subscribers" class="selectpicker1" data-width="148px">
                                                <option data-hidden="true" value="">Choose Subscriber</option>
                                                <?php
                                                if (!empty($getSubscribers)) {
                                                    foreach ($getSubscribers as $key => $values) {
                                                        ?>

                                                        <option value="<?php echo $values->id; ?>
                                            "> <?php echo $values->subscriber; ?> </option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $data = array('name' => 'submit', 'id' => 'submit', 'value' =>
                                    'Send', 'class' => 'btn btn-primary ',);
                                echo form_submit($data);
                                ?>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <?php $attributes = array('class' => 'formular', 'id' => 'form');
                    echo form_open_multipart(ADMIN_PATH . 'newsletter/subscribe', $attributes);
                    $data = array('name' => 'subscribe', 'id' => 'subscribe', 'placeholder' => 'Enter your Email');
                    echo form_input($data);
                    $data1 = array('name' => 'submit', 'id' => 'submit', 'value' =>
                        'Subscribe', 'class' => 'btn btn-primary fa fa-save ',);
                    echo form_submit($data1);
                    echo form_close();
                    ?>

                    <div id="row">
                        <div class="col-md-12">
                            <div class="box box-danger">
                                <div class="box-header">
                                    <h3 class="box-title"><?php echo $title1; ?></h3>
                                </div>

                                <div class="box-body">
                                    <table class="table table-bordered table-striped" id="send_templates">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Subscriber</th>
                                            <th>Newsletter Heading</th>
                                            <th>Sent Date</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php if (!empty($getAllSubscribers)) {
                                            $count = 1;
                                            foreach ($getAllSubscribers as $values) {
                                                ?>
                                                <tr class="item">
                                                    <td><?php echo $count++; ?></td>
                                                    <td><?php
                                                        if (empty($values->subscriber)) {
                                                            echo $values->first_name;
                                                        } else {
                                                            echo $values->subscriber;
                                                        }; ?></td>
                                                    <td><?php echo $values->subject; ?></td>
                                                    <td><?php echo $values->sent_date; ?></td>
                                                    <td><a class="" href="<?php echo 'delete' . '/' . $values->news_id ?>"><i class="glyphicon glyphicon-trash"></i></a></td>
                                                </tr>
                                            <?php }
                                        } ?>

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </section>
        </div>
</div>
<script type="text/javascript">
    jQuery(function () {
        $('#mybutton').click(function () {
            $("#toggle").toggle("hide");
            $("#to").toggle("slide");
        });
    });
    function changeText() // no ';' here
    {
        var elem = document.getElementById("mybutton");
        if (elem.value == "Send To Users") elem.value = "Send To Subcribers";
        else elem.value = "Send To Users";
    }

    $('#send_templates').DataTable();
    $('.selectpicker').select2();
    $('.selectpicker1').select2();

    $(document).ready(function () {
        $('#multiselectForm')
            .formValidation({
                framework: 'bootstrap',
                excluded: ':disabled',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    gender: {
                        validators: {
                            notEmpty: {
                                message: 'The gender is required'
                            }
                        }
                    },
                    browsers: {
                        validators: {
                            callback: {
                                message: 'Please choose 2-3 browsers you use for developing',
                                callback: function (value, validator, $field) {
                                    // Get the selected options
                                    var options = validator.getFieldElements('browsers').val();
                                    return (options != null
                                    && options.length >= 2 && options.length <= 3);
                                }
                            }
                        }
                    }
                }
            })
            .find('[name="gender"]')
            .multiselect({
                onChange: function (element, checked) {
                    $('#multiselectForm').formValidation('revalidateField', 'gender');
                    adjustByScrollHeight();
                },
                onDropdownShown: function (e) {
                    adjustByScrollHeight();
                },
                onDropdownHidden: function (e) {
                    adjustByHeight();
                }
            })
            .end()
            .find('[name="browsers"]')
            .multiselect({
                enableFiltering: true,
                includeSelectAllOption: true,
                // Re-validate the multiselect field when it is changed
                onChange: function (element, checked) {
                    $('#multiselectForm').formValidation('revalidateField', 'browsers');

                    adjustByScrollHeight();
                },
                onDropdownShown: function (e) {
                    adjustByScrollHeight();
                },
                onDropdownHidden: function (e) {
                    adjustByHeight();
                }
            })
            .end();

        function adjustByHeight() {
            var $body = $('body'),
                $iframe = $body.data('iframe.fv');
            if ($iframe) {
                $iframe.height($body.height());
            }
        }

        function adjustByScrollHeight() {
            var $body = $('body'),
                $iframe = $body.data('iframe.fv');
            if ($iframe) {
                $iframe.height($body.get(0).scrollHeight);
            }
        }
    });

</script>
