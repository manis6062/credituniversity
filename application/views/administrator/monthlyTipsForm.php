<div class="content-wrapper">
    <section class="content-header">


        <div class="btn-group">
            <a class="btn dropdown-toggle btn-select btn btn-primary" data-toggle="dropdown" href="#">Choose Forms <span class="caret"></span></a>
            <ul id = 'select' class="dropdown-menu">
                <li id = 'tip'><a class="btn btn-link"  >Monthly Tips</a></li>
                <li class="divider"></li>
                <li id = 'pdf'><a class="btn btn-link">Pdf Books</a></li>
            </ul>

        </div>

        <script>

            $(document).ready(function () {
                $('#select li').on('click', function () {
                    var sentData = $(this).attr('id');
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url() . 'administrator/content/monthlyTipsForm' ; ?>" + '/' + sentData,
                        data: "sentData=" + sentData,
                        dataType: "html",
                        success: function(data)
                        {
                            var result = $('<div />').append(data).find('.content').html();
                            $('.content').html(result);

                        }
                    });
                });
            });
        </script>

        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active"><?php echo $title ?></li>
        </ol>
    </section>
    <section class="content">
        <h3> <small><?php echo ucfirst($action); ?></small>
            <?php echo $title; ?>

        </h3>
        <div class="row">

            <?php if ($title != 'Pdf Books'){ ?>
            <form enctype="multipart/form-data" action="<?php echo base_url() . 'administrator/content/addMonthlyTips'; ?>" method="post" id="content">
               <?php } else {?>
                <form enctype="multipart/form-data" action="<?php echo base_url() . 'administrator/content/addPdf'; ?>" method="post" id="content">
                <?php }?>

                <div class="col-md-8">
                    <div class="box box-danger">
                        <div class="box-header">
                            <div class="box-body">

                                <div class="row">
                                    <div class="form-group col-md-10">
                                        <?php
                                        echo form_label('Title:');
                                        echo form_input(array('class' => 'form-control', 'id' => 'content_title', 'name' => 'content_title', 'width' => '40'));
                                        ?>
                                    </div>
                                    <?php if ($title != 'Pdf Books'): ?>
                                    <div class="form-group col-md-2">
                                        <?php
                                        echo form_label('Month:');
                                        echo form_dropdown('value', getNumbers(1, 12), 0, array('class' => 'form-control', 'id' => 'value', 'name' => 'value', 'width' => '40'));
                                        ?>
                                    </div>
                                    <?php endif ?>
                                    <div class="form-group col-md-12">
                                        <?php
                                        echo form_label('Description:');
                                        echo form_textarea(array('class' => 'form-control', 'id' => 'description', 'name' => 'description', 'rows' => '10', 'cols' => '80'));
                                        ?>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <?php echo form_label('Upload:'); ?>
                                        <input type="file" name="file" id="file">
                                    </div>
                                </div>
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
                </div>
            </form>
        </div>
    </section>
</div>
<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js" type="text/javascript"></script>
<script>
    $("#content").bootstrapValidator({
        message: 'This value is not valid',
        fields: {
            content_title: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    blank: {}
                }
            },
            description: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    blank: {}
                }
            },
            file: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    blank: {}
                }
            },
            value: {
                validators: {
                    blank: {}
                }
            }
        }
    }).on('success.form.bv', function (e) {
        e.preventDefault();
        var $form = $(e.target),
            formData = new FormData(),
            params = $form.serializeArray(),
            files = $form.find('[name="file"]')[0].files;
        formData.append('file', files[0]);
        $.each(params, function (i, val) {
            formData.append(val.name, val.value);
        });

        $.ajax({
            url: $form.attr('action'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            success: function (data) {
                serverValidation($("#content"), data, '<?php echo base_url() . 'administrator/content/pdfContents'?>');
            }
        });
    });

    $(function () {
        CKEDITOR.replace('editor1');
        $(".textarea").wysihtml5();
    });



</script>


