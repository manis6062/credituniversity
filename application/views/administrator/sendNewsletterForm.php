<style>
    .dropdown-menu {
        max-height: 500px;
        overflow-y: auto;
        overflow-x: hidden;
    }

    #bottom {
        margin-top: 620px;
    }
</style>
<div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
    <section class="content-header">
        <h1>
            Send NewsLetter
            <a class="btn btn-link" href="<?php echo base_url() . 'administrator/newsletter/sentNewsletters'; ?>">Sent
                Newsletters</a>
            <a class="btn btn-link" href="<?php echo base_url() . 'administrator/newsletter'; ?>">Newsletter
                Templates</a>
            <a class="btn btn-link" href="<?php echo base_url() . 'administrator/newsletter/newsletterForm'; ?>">Add a
                Newsletter</a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="<?php echo base_url() . 'administrator/newsletter'; ?>"><i class="fa fa-newspaper-o"></i>Newsletters
                    Templates</a></li>
            <li class="active">Send Newsletter</li>
        </ol>
    </section>
    <section class="content">
        <form action="<?php echo base_url() . 'administrator/newsletter/sendNewsletter'; ?>" method="post"
              id="newsletter">
            <div class="row col-md-12">
                <div class="box box-info">
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="subject">Subject:</label>

                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-rss"></i></div>
                                    <input type='text' class="form-control" id='subject' name="subject" autofocus/>
                                </div>
                            </div>
                            <div class="form-group col-md-8">
                                <div class="input-group">
                                    <label for="template">Template :</label><br/>
                                    <?php echo form_dropdown('template', $templates, $selectedTemplate, array('class' => 'form-control template', 'id' => 'template')) ?>
                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <div class="input-group">
                                    <label for="users"> All : </label><br/>
                                    <select id="brokers" multiple="multiple" name="users[]">
                                        <?php foreach ($users as $user) : ?>
                                            <option
                                                value="<?php echo $user->email ?>"><?php echo $user->first_name . ' ' . $user->last_name . ' - ' . $user->email ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="input-group">
                                    <label for="brokers"> Brokers : </label><br/>
                                    <select id="brokers" multiple="multiple" name="brokers[]">
                                        <?php foreach ($brokers as $broker) : ?>
                                            <option
                                                value="<?php echo $broker->email ?>"><?php echo $broker->name . ' - ' . $broker->email ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="input-group">
                                    <label for="clients"> Clients : </label> <br/>

                                    <select id="clients" multiple="multiple" name="clients[]">
                                        <?php foreach ($clients as $client) : ?>
                                            <option
                                                value="<?php echo $client->email ?>"><?php echo $client->name . ' - ' . $client->email ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <div class="input-group">
                                    <label for="owners"> Tradeline Owners : </label><br/>

                                    <select id="owners" multiple="multiple" name="owners[]">
                                        <?php foreach ($owners as $owner) : ?>
                                            <option
                                                value="<?php echo $owner->email ?>"><?php echo $owner->name . ' - ' . $owner->email ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group col-md-4">
                                <div class="input-group">
                                    <label for="subscribers"> Subscribers : </label><br/>

                                    <select id="subscribers" multiple="multiple" name="subscribers[]">
                                        <?php foreach ($subscribers as $subscriber) : ?>
                                            <option
                                                value="<?php echo $subscriber->email ?>"><?php echo $subscriber->name . ' - ' . $subscriber->email ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="input-group">

                                    <label for="clientProspects"> Client Prospects : </label><br/>

                                    <select id="clientProspects" multiple="multiple" name="clientProspects[]">
                                        <?php foreach ($clientProspects as $clientProspect) : ?>
                                            <option
                                                value="<?php echo $clientProspect->email ?>"><?php echo $clientProspect->name . ' - ' . $clientProspect->email ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <div class="input-group">
                                    <label for="brokerProspects"> Broker Prospects : </label><br/>

                                    <select id="brokerProspects" multiple="multiple" name="brokerProspects[]">
                                        <?php foreach ($brokerProspects as $brokerProspect) : ?>
                                            <option
                                                value="<?php echo $brokerProspect->email ?>"><?php echo $brokerProspect->name . ' - ' . $brokerProspect->email ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="input-group">
                                    <label for="ownerProspects"> Owner Prospects : </label><br/>

                                    <select id="brokerProspects" multiple="multiple" name="brokerProspects[]">
                                        <?php foreach ($ownerProspects as $ownerProspect) : ?>
                                            <option
                                                value="<?php echo $ownerProspect->email ?>"><?php echo $ownerProspect->name . ' - ' . $ownerProspect->email ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="box-footer">
                <div class="input-group">
                    <button type="submit" id="submitForm" class="btn btn-primary btn-flat" disabled="disabled">Send
                    </button>
                </div>
            </div>
        </form>
    </section>
    <section class="content">
        <div class="box box-info">
            <div class="box-body">
                <div class="col-md-8">
                    <?php
                    foreach ($newsletters as $key => $template) {
                        ?>
                        <div id='temp<?php echo $template->id?>' class="temps">
                            <?php echo $template->code?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
</div>


<script type="text/javascript">
    //    jQuery('#template').change(function(){
    //        $(this).find('option').each(function(){
    //            $('#temp'+$(this).val()).hide();
    //        });
    //
    //        $('#temp' + this.value).show();
    //    });
    $('.template').each(function () {
        $('.temps').hide();
        $('#temp' + $(this).val()).show();

    })
    $('.template').change(function () {
        console.log(this.id);
        $('.temps').hide();
        $('#temp' + $(this).val()).show();
    });


    $("#brokers, #clients, #owners, #subscribers, #clientProspects, #brokerProspects, #ownerProspects").change(function () {
        if (this.value == "") {
            $("#submitForm").prop("disabled", true);
        } else {
            $("#submitForm").prop("disabled", false);
        }
    });


    $('#send_templates').dataTable();
    $(".select2").select2({
        placeholder: "Make one or more selections"
    });
    $("#newsletter").formValidation({
        message: 'This value is not valid',
        fields: {
            subject: {
                validators: {
                    notEmpty: {
                        message: 'Enter Subject'
                    }
                }
            }
        }
    });

    function showRecipients() {
        var roles = $("#recipients").val();
        var singles = $("#users").val();
        var text = '';

        $("#clients").empty();
        $("#brokers").empty();
        $("#owners").empty();
        $("#prospects").empty();
        $("#subscribers").empty();
        $("#individuals").empty();

        if (roles != '' && roles != null
        ) {
            $.each(roles, function (key, value) {
                $.post("<?php echo base_url() . 'administrator/newsletter/emails'; ?>", {roles: value})
                    .success(function (data) {
                        try {
                            var data1 = $.parseJSON(data);
                            if (data.message) {
                                $("#baseModal2").modal().find('.modal-body').text(data).show();
                            } else {
                                var container = '';
                                var label = '';
                                if (value == 'client') {
                                    container = "#clients";
                                    label = "Clients : ";
                                } else if (value == 'broker') {
                                    container = "#brokers";
                                    label = "Brokers : ";
                                } else if (value == 'owner') {
                                    container = "#owners";
                                    label = "Owners : ";
                                } else if (value == 'subscriber') {
                                    container = "#subscribers";
                                    label = "Subscribers : ";
                                } else if (value == 'prospect') {
                                    container = "#prospects";
                                    label = "Prospects : ";
                                }
                                $(container).empty();
                                if (data1 != '') {
                                    $(container).append(label + '<br/><br/>');
                                    $.each(data1, function () {
                                        $('<input />', {
                                            type: 'checkbox',
                                            id: 'cb1',
                                            name: 'cb1[]',
                                            value: this.email,
                                            checked: 'checked'
                                        }).appendTo(container);
                                        $('<label />', {
                                            'for': 'cb1',
                                            text: this.name + ' : ' + this.email
                                        }).appendTo(container);
                                        $(container).append('<br/>');
                                    });
                                }
                            }
                        } catch (e) {
                            alert(e);
                        }
                    });
            });
        }

        if (singles != '' && singles != null) {
            var container = "#individuals";
            label = "Clients : ";
            $.post("<?php echo base_url() . 'administrator/newsletter/emails'; ?>", {individuals: singles})
                .success(function (data) {
                    try {
                        var data1 = $.parseJSON(data);
                        if (data.message) {
                            $("#baseModal2").modal().find('.modal-body').text(data).show();
                        } else {
                            $(container).empty();
                            if (data1 != '') {
                                $(container).append('Individuals:<br/><br/>');
                                $.each(data1, function () {
                                    $('<input />', {
                                        type: 'checkbox',
                                        id: 'cb1',
                                        name: 'cb1[]',
                                        value: this.email,
                                        checked: 'checked'
                                    }).appendTo(container);
                                    $('<label />', {
                                        'for': 'cb1',
                                        text: this.name + ' : ' + this.email
                                    }).appendTo(container);
                                    $(container).append('<br/>');
                                });
                            }
                        }
                    } catch (e) {
                        alert(e);
                    }
                });
        }

        return false;
    }

    $("#recipients").on("change", function () {
        return showRecipients();
    });
    $("#users").on("change", function () {
        return showRecipients();
    });

    $("#template").on("change", function () {
        return showTemplateDetails();
    });

    $(document).ready(function () {
        return showTemplateDetails();
    });

    function showTemplateDetails() {
        var templateId = $("#template").val();
        var text = '';
        $.post("<?php echo base_url() . 'administrator/campaign/getCampaignDetails'; ?>", {templateId: templateId})
            .success(function (data) {
                try {
                    var data1 = $.parseJSON(data);
                    if (data.message) {
                        $("#baseModal2").modal().find('.modal-body').text(data).show();
                    } else {
                        $("#templateDetails").empty();
                        if (data1 != '') {
                            $.each(data1, function () {
                                $("#templateDetails").append(this).append('<br/>');

                            });
                        } else {
                            $("#templateDetails").append(this).append('<br/> Template is not associated with any campaign. <br/> Can be used for general newsletters.');
                        }
                    }
                } catch (e) {
                    alert(e);
                }
            });
        return false;
    }

    $('#brokers, #clients, #owners, #subscribers, #clientProspects, #brokerProspects, #ownerProspects').multiselect({
        includeSelectAllOption: true,
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true
    });

</script>
