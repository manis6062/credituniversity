<div class="content-wrapper " xmlns="http://www.w3.org/1999/html">
    <!-- Content Header (Page header) -->
  <section class="content-header">
        <h1>
            Update Welcome Letter
             <a class="btn btn-link" href="<?php echo base_url() . 'administrator/newsletter'; ?>">Newletter Templates</a>
        
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="<?php echo base_url() . 'administrator/newsletter'; ?>"><i class="fa fa-newspaper-o"></i>Newsletters</a></li>
            <li class="active">Welcome Letter</li>
        </ol>
    </section>
    <section class="content">
        <div id="row">
            <form enctype="multipart/form-data" action="<?php echo base_url() . 'administrator/newsletter/updateWelcomeLetter'; ?>" method="post" id="welcomeletter">
                <input hidden="hidden" id="id" name="id" value="<?php echo $template->id ?>"/>

                <div class="col-md-12">
                    <div class="box box-danger">
                        <div class="box-header">
                            <h3 class="box-title">Information:</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <?php echo form_label('ID', 'id'); ?><br/>
                                    <a href="#" id="id" name="id" data-type="text"> <?php echo $template->id; ?></a>
                                </div>
                                 <div class="form-group col-md-3">
                                    <?php echo form_label('Slug', 'short_code'); ?><br/>
                                    <a href="#" id="short_code" data-type="text"> <?php echo $template->short_code; ?></a>
                                </div>
                                <div class="form-group col-md-3">
                                    <?php echo form_label('Title', 'title'); ?><br/>
                                    <a href="#" id="title" data-type="text"> <?php echo $template->title; ?></a>
                                </div>
                              
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <label>Template Html: </label>

                                    <div id="editor">
                                        <?php echo $template->code ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                    <div class="box-footer">
                            <div class="input-group">
                                   <div class="form-group">
                               
                                <button type="button" id="submitForm" class="btn btn-primary btn-flat">Submit</button>
                                <input type="button" class="btn btn-primary btn-flat" value="Cancel"
                                   onclick="window.history.back()"/>
                               </div>
                        </div>
                        </div>
                </div>
            </form>
        </div>
    </section>
</div>


<div class="modal fade" id="fail-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Fail Delete</h4>
            </div>

            <div class="modal-body">
                <p>System couldnot able to update this time.</p>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ok</button>
               
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $.fn.editable.defaults.mode = 'inline';
    $('#title,#short_code').editable({
        pk: '<?php echo $template->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params) {
            params.table = 'newsletter_template';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });

    //$(window).bind('beforeunload', function () {
 $("#submitForm").on('click', function (e, data) {
        var $form = $('#welcomeletter'),
            formData = new FormData(),
            params = $form.serializeArray();
        code = CKEDITOR.instances.editor.getData();
        if(code==''){
            alert('Please enter Template');
            return;
        }
        formData.append('code', code);
        $.each(params, function (i, val) {
            formData.append(val.name, val.value);
        });
        $.ajax({
            url: $form.attr('action'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            async: false,
            type: 'POST',
            success: function (data) { 
                try{               
                   
                         serverValidation($("#welcomeletter"), data, '<?php echo base_url() . 'administrator/newsletter'?>');             
                     
                       
                 } catch (e) {
                      //$("#fail-delete").modal().find('.modal-body').text(e.getMessages()).show();
                   }

            }
        });


    });

    initSample();


</script>
