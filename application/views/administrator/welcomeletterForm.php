<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            Add Welcome Letter
            <a class="btn btn-link" href="<?php echo base_url() . 'administrator/newsletter'; ?>">Welcome
                Letter</a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">add</li>
        </ol>
    </section>
    <section class="content">
        <div id="row">
            <form enctype="multipart/form-data" action="<?php echo base_url() . 'administrator/newsletter/addWelcomeLetter'; ?>"
                  method="post" id="form">
                <div class="col-md-12">
                    <div class="box box-danger">
                        <div class="box-header">
                            <h3 class="box-title">Add Welcome letter</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <label for="title">letter Title :</label>
                                        <input type="text" class="form-control" name="title" id="title">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <label for="title">letter Slug(Ex:welcome_letter) :</label>
                                        <input type="text" class="form-control" name="short_code" id="short_code">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <label>Letter Code: </label>

                                        <textarea class="ckeditor" name="code"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="input-group">
                                <input name="submit" type="submit" id="submit" value="Save"
                                       class="btn btn-primary fa fa-save">
                                
                                   <input type="button" class="btn btn-primary btn-flat" value="Cancel"
                                   onclick="window.history.back()"/>
                               </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<script type="text/javascript">

    $("#form").on('init.field.fv', function (e, data) {
        var $icon = data.element.data('fv.icon'),
            options = data.fv.getOptions(),
            validators = data.fv.getOptions(data.field).validators;
        if (validators.notEmpty && options.icon && options.icon.required) {
            $icon.addClass(options.icon.required).show();
        }
    }).formValidation({
        framework: 'bootstrap',
        icon: {
            required: 'fa fa-asterisk',
            valid: 'fa fa-check',
            invalid: 'fa fa-times',
            validating: 'fa fa-refresh'
        },
        excluded: ':disabled',
        fields: {
            title: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    blank: {}
                }
            },
              short_code: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    blank: {}
                }
            }
        }
    }).on('status.field.fv', function (e, data) {
        var $icon = data.element.data('fv.icon'),
            options = data.fv.getOptions(),
            validators = data.fv.getOptions(data.field).validators;
        if (validators.notEmpty && options.icon && options.icon.required) {
            $icon.removeClass(options.icon.required).addClass('fa');
        }
    }).on('success.form.fv', function (e) {
        e.preventDefault();
        $.post($(this).attr('action'), $(this).serialize())
            .done(function (data) {
                
                  if(data.length==1){ 
                    serverValidation($("#form"), data, '<?php echo base_url() . 'administrator/newsletter'?>');             
                }else{
                 alert('Couldnot able  to update this time.');
             }
               
            });
    });

    jQuery(function () {
        $('#mybutton').click(function () {
            $("#toggle").toggle("hide");
            $("#to").toggle("slide");
        });
    });
    function changeText() {
        var elem = document.getElementById("mybutton");
        if (elem.value == "Send To Users") elem.value = "Send To Subcribers";
        else elem.value = "Send To Users";
    }

    $('#templates').dataTable({iDisplayLength: 100});
    $('.selectpicker').select2();
    $('[data-toggle=confirmation]').confirmation(options);


</script>
