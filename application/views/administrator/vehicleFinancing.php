<style>
    .small-box > .small-box-footer {
        text-align: left;
    }
</style>
<div class="content-wrapper bg-mustang">
    <section class="content-header">
        <h1>

            <span id="vehicle_financing" style="cursor: pointer"
                  onclick="document.location = currentUrl() + '?option=descript'">  <?php echo "Vehicle Financing" ?></span>
        </h1>

        <br/>

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        </ol>
    </section>
    <section class="content">

        <?php if ((in_array($role, array(CLIENT, BROKER, ADMIN)))): ?>
            <div class="col-lg-3 col-xs-6" style="cursor:pointer" id="cars">
                <div class="small-box">
                    <div class="car inner bg-cars">
                        <div class="bg-soon">
                            <h3>&nbsp;</h3>

                            <p>&nbsp;</p>
                        </div>
                    </div>
                    <p class="car small-box-footer" style="color: black; background: rgb(207, 133, 15) ;"><strong>&nbsp;Cars</strong>
                    </p>
                </div>
            </div>
        <?php endif; ?>

        <?php if ((in_array($role, array(CLIENT, BROKER, ADMIN)))): ?>
        <?php if (array_intersect($membership, array(BROKER_SILVER, BROKER_GOLD, BROKER_PLATINUM))) { ?>
        <div class="col-lg-3 col-xs-6" style="cursor:pointer" id="trucks">
            <?php } else { ?>
            <div class="col-lg-3 col-xs-6" style="cursor:pointer; opacity: 0.3;" id="trucks">
                <?php } ?>
                <div class="small-box">
                    <div class="truck inner bg-trucks">
                        <div class="bg-soon">
                            <h3>&nbsp;</h3>

                            <p>&nbsp;</p>
                        </div>
                    </div>
                    <p class="truck small-box-footer" style="color: black; background: rgb(207, 133, 15)"><strong>&nbsp;Trucks</strong>
                    </p>
                </div>
            </div>
            <?php endif; ?>

            <?php if ((in_array($role, array(CLIENT, BROKER, ADMIN)))): ?>
            <?php if (array_intersect($membership, array(BROKER_GOLD, BROKER_PLATINUM)))  { ?>

            <div class="col-lg-3 col-xs-6" id="boats"
                 style="cursor:pointer;">
                <?php } else { ?>
                <div class="col-lg-3 col-xs-6" id="boats" style="cursor:pointer; opacity: 0.3;">
                    <?php } ?>
                    <div class="small-box bg-aqua">
                        <div class="boat inner bg-boats_rvs">
                            <div class="bg-soon">
                                <h3>&nbsp;</h3>

                                <p>&nbsp;</p>
                            </div>
                        </div>
                        <p class="boat small-box-footer"
                           style="color: black; background: rgb(207, 133, 15)">
                            <strong>&nbsp;Boats & RVs
                            </strong></p>
                    </div>
                </div>
                <?php endif ?>



                <?php if ((in_array($role, array(CLIENT, BROKER, ADMIN)))): ?>
                <?php if (array_intersect($membership, array(BROKER_PLATINUM))) { ?>
                <div class="col-lg-3 col-xs-6"
                     style="cursor:pointer" id="luxury">
                    <?php } else { ?>
                    <div class="col-lg-3 col-xs-6" style="cursor:pointer; opacity: 0.3;" id="luxury">
                        <?php } ?>
                        <div class="small-box bg-green">
                            <div class="lux inner bg-luxury">
                                <div class="bg-soon">
                                    <h3>&nbsp;</h3>

                                    <p>&nbsp;</p>
                                </div>
                            </div>
                            <p class="lux small-box-footer"
                               style="color: black; background:rgb(207, 133, 15)">
                                <strong>&nbsp;Luxury</strong>
                            </p>
                        </div>
                    </div>
                    <?php endif ?>


                    <div class="row">
                        <?php if (($member_module->description != '') || (in_array($role, array(ADMIN)))) : ?>

                            <div class="col-md-6 col-md-offset-3 boxes transbox" id="descript">
                                <div class="box box-solid">
                                    <div class="box-body">


                                        <div class="col-md-12 ">
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

                        <div class="col-md-9 boxes" id="ca" style="display: none">
                            <div class="box box-solid">
                                <div class="box-body">
                                    <div class="col-md-3">
                                        "cars"
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="col-md-8 boxes" id="tr" style="display: none">
                            <div class="box box-solid">
                                <div class="box-body">
                                    <div class="col-md-3">
                                        "Trucks"
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="col-md-8 boxes" id="bo" style="display: none">
                            <div class="box box-solid">
                                <div class="box-body">
                                    <div class="col-md-3">
                                        "Boats"
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-8 boxes" id="lu" style="display: none">
                            <div class="box box-solid">
                                <div class="box-body">
                                    <div class="col-md-3">
                                        "Luxury"
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
