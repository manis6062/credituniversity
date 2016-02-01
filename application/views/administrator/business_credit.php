<style>
    .small-box > .small-box-footer {
        text-align: left;
    }
</style>
<div class="content-wrapper bg-business-credit-main">
    <section class="content-header">
        <h1>
            <span id="funding" onclick="document.location = currentUrl() + '?option=descript'"
                  style="cursor: pointer"><?php echo "Business Credit" ?></span>
        </h1>
        <br/>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        </ol>
    </section>
    <section class="content">

        <?php if ((in_array($role, array(CLIENT, ADMIN)))): ?>
            <div class="col-lg-3 col-xs-6" onclick="document.location = currentUrl() + '?option=bcu'"
                 id="banks" style="cursor:pointer">
                <div class="small-box">
                    <div class="bcu1 inner bg-banks">
                        <h3>&nbsp;</h3>

                        <p>&nbsp;</p>
                    </div>
                    <p class="bcu1 small-box-footer" style="color: black; background: rgb(207, 133, 15)"><strong>&nbsp;What
                            Goes Here?</strong></p>
                </div>
            </div>
        <?php endif; ?>

        <div class="row">

            <?php if (($member_module->description != '') || (in_array($role, array(ADMIN)))) : ?>
                <div class="col-md-6 col-md-offset-3 boxes transbox" id="descript">
                    <div class="box box-solid">
                        <div class="box-body">

                            <div class="col-md-12">

                                <?php if (in_array($role, array(ADMIN))) { ?>
                                    <a href="#" id="description" data-type="textarea"
                                       data-emptytext="enter description"
                                       data-value="<?php
                                       echo($member_module->description);
                                       ?>"><?php echo $member_module->description; ?></a>
                                <?php } else {
                                    echo $member_module->description;
                                } ?>


                            </div>

                        </div>

                    </div>
                </div>
            <?php endif; ?>
            <div class="col-md-8 boxes" id="bcu">
                <div class="box box-solid">
                    <div class="box-body">
                        <div class="col-md-6">
                            "Banks & Credit Unions"
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

</div>


<script>
    //CKEDITOR.inline( 'faq_answer' );
    $.fn.editable.defaults.mode = 'inline';
    $('#description').editable({
        pk: '<?php echo $member_module->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        tpl: '<textarea class="wy"></textarea>',
        params: function (params) {
            params.table = 'member_module';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });

    $(document).on("click", ".wy", function () {
        $(this).wysihtml5({
            toolbar: {
                "font-styles": true,
                "emphasis": true,
                "lists": true,
                "html": true,
                "link": true,
                "image": true,
                "color": true,
                "blockquote": false,
                "outdent": true,
                "indent": true,
                "size": 'sm',
                "fa": true
            }
        });
    });


</script>

