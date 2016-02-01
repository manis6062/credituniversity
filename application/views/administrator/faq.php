<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            <?php echo $title; ?>
            <small><?php echo $action; ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="<?php echo base_url() . 'administrator/' . $title; ?>"><?php echo $title; ?>s</a></li>
            <li class="active"><?php echo $action; ?></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">update question no.: <?php echo $faq->faq_id; ?></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <?php echo form_label('question', 'Question'); ?>
                                <a href="#" id="faq_question" data-type="text"
                                   data-emptytext="enter question"><?php echo $faq->faq_question; ?></a>
                            </div>
                            <div class="form-group col-md-12">
                                <?php echo form_label('answer', 'Answer'); ?>
                                <a href="#" id="faq_answer" data-type="textarea"
                                   data-emptytext="enter answer" data-value="<?php echo $faq->faq_answer; ?>"></a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<!--<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js" type="text/javascript"></script>-->
<script>
    //CKEDITOR.inline( 'faq_answer' );
    $.fn.editable.defaults.mode = 'inline';
    $('#faq_question, #faq_answer').editable({
        pk: '<?php echo $faq->faq_id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        tpl: '<textarea class="wy"></textarea>',
        params: function (params) {
            params.table = 'faq';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });

    $(document).on("click", ".wy", function () {
        $(this).wysihtml5({
            toolbar: {
                "font-styles": true
                ,"emphasis": true
                ,"lists": true
                ,"html": true
                ,"link": true
                ,"image": true
                ,"color": true
                ,"blockquote": false
                ,"outdent": true
                ,"indent": true
                ,"size": 'sm'
                ,"fa": true
            }
        });
    });


</script>

