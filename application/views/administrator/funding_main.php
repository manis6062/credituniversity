<style>
    .small-box > .small-box-footer {
        text-align: left;
    }

    #border {
        border-radius: 10px;
        -moz-border-radius: 10px;
        -webkit-border-radius: 10px;
        -khtml-border-radius: 10px;
        border: 2px solid green;
    }
</style>
<div class="content-wrapper bg-funding-main">
    <section class="content-header">
        <h1>
            <span id="funding" onclick="document.location = currentUrl() + '?option=descript'"
                  style="cursor: pointer"><?php echo "Funding" ?></span>
        </h1>

        <br/>

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        </ol>
    </section>
    <section class="content">

        <?php if ((in_array($role, array(CLIENT, ADMIN)))): ?>
            <div class="col-lg-3 col-xs-6" id="banks" style="cursor:pointer">
                <div class="small-box">
                    <div class="bcu1 inner bg-banks">
                        <div class="bg-soon">
                            <h3>&nbsp;</h3>

                            <p>&nbsp;</p>
                        </div>
                    </div>
                    <p class="bcu1 small-box-footer" style="color: black; background: rgb(207, 133, 15)"><strong>&nbsp;Banks
                            & Credit Unions</strong></p>
                </div>
            </div>
        <?php endif; ?>

        <?php if ((in_array(role(), array(CLIENT, ADMIN)))) : ?>
        <?php if (array_intersect($membership, array(BROKER_SILVER, BROKER_GOLD, BROKER_PLATINUM))) { ?>
        <div class="col-lg-3 col-xs-6" style="cursor:pointer" id="credit">
            <?php } else { ?>
            <div class="col-lg-3 col-xs-6"
                 style="cursor:pointer; opacity: 0.3;"
                 id="credit">
                <?php } ?>
                <div class="small-box">
                    <div class="cc1 inner bg-credit_cards">
                        <div class="bg-soon">
                            <h3>&nbsp;</h3>

                            <p>&nbsp;</p>
                        </div>
                    </div>
                    <p class="cc1 small-box-footer" style="color: black; background: rgb(207, 133, 15)"><strong>&nbsp;Credit
                            Cards</strong></p>
                </div>
            </div>
            <?php endif; ?>


            <?php if (in_array($role, array(CLIENT, ADMIN))) : ?>
            <?php if (array_intersect($membership, array(BROKER_GOLD, BROKER_PLATINUM)))  { ?>

            <div class="col-lg-3 col-xs-6" id="department" style="cursor:pointer; ">
                <?php } else { ?>
                <div
                    class="col-lg-3 col-xs-6"
                    id="department" style="cursor:pointer; opacity: 0.3;">
                    <?php } ?>
                    <div class="small-box bg-aqua">
                        <div class="ds1 inner bg-mall">
                            <div class="bg-soon">
                                <h3>&nbsp;</h3>

                                <p>&nbsp;</p>
                            </div>
                        </div>
                        <p class="ds1 small-box-footer"
                           style="color: black; background: rgb(207, 133, 15)">
                            <strong>&nbsp;Department Stores
                            </strong></p>
                    </div>
                </div>
                <?php endif ?>


                <?php if (in_array($role, array(CLIENT, ADMIN))) : ?>
                <?php if (array_intersect($membership, array(BROKER_PLATINUM))) { ?>
                <div class="col-lg-3 col-xs-6" onclick="document.location = currentUrl() + '?option=fse'"
                     style="cursor:pointer" id="furniture">
                    <?php } else { ?>
                    <div class="col-lg-3 col-xs-6" style="cursor:pointer; opacity: 0.3;" id="furniture">
                        <?php } ?>
                        <div class="small-box bg-green">
                            <div class="fse1 inner bg-furniture_stores">
                                <div class="bg-soon">
                                    <h3>&nbsp;</h3>

                                    <p>&nbsp;</p>
                                </div>
                            </div>
                            <p class="fse1 small-box-footer"
                               style="color: black; background:rgb(207, 133, 15)">
                                <strong>&nbsp;Furniture Stores Etc</strong>
                            </p>
                        </div>
                    </div>
                    <?php endif ?>

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

                        <div class="col-md-8 boxes" id="cc">

                            <div class="box box-solid">
                                <div class="box-body">
                                    <div class="col-md-6">
                                        "Credit Cards"
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-8 boxes" id="ds">

                            <div class="box box-solid">
                                <div class="box-body">
                                    <div class="col-md-6">
                                        " Department Stores "
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-8 boxes" id="fse">
                            <div class="box box-solid">
                                <div class="box-body">
                                    <div class="col-md-6">
                                        " Furniture Stores Etc"
                                        </a>
                                    </div>

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
