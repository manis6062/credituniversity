<style>
    .small-box > .small-box-footer {
        text-align: left;
    }
</style>
<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            <?php echo "Credit Status" ?>
        </h1>

        <br/>

        <ul class="legend">
            <li><span class="silver"></span>Silver Member</li>
            <li><span class="gold"></span>Gold Member</li>
            <li><span class="platinum"></span>Platinum Member</li>
        </ul>

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        </ol>
    </section>
    <section class="content">

        <!-----------Credit Status--------------------->
        <?php if ((in_array($role, array(BROKER)))): ?>
            <div class="col-lg-3 col-xs-6"
                 onclick="document.location='<?php echo base_url() . 'administrator/creditStatus/creditStatus/' . $user_id; ?>'"
                 style="cursor:pointer">
                <div class="small-box">
                    <div class="inner bg-cs">
                        <h3>&nbsp;</h3>

                        <p>&nbsp;</p>
                    </div>
                    <p class="small-box-footer" style="color: black; background: rgb(0,163,203)"><strong>&nbsp;Credit
                            Status</strong></p>
                </div>
            </div>
        <?php endif; ?>

        <!-----------Marketplace--------------------->
        <?php if ((in_array(role(), array(BROKER)))) { ?>
        <?php if (array_intersect($membership, array(BROKER_SILVER, BROKER_GOLD, BROKER_PLATINUM))) { ?>
        <div class="col-lg-3 col-xs-6"
             onclick="document.location='<?php echo base_url() . 'administrator/line/market'; ?>'"
             style="cursor:pointer" id="marketplace">
            <?php } else { ?>
            <div class="col-lg-3 col-xs-6" onclick="document.location='#'" style="cursor:pointer; opacity: 0.3;"
                 id="marketplace">
                <?php } ?>
                <div class="small-box">
                    <div class="inner bg-market">
                        <h3>&nbsp;</h3>

                        <p>&nbsp;</p>
                    </div>
                    <p class="small-box-footer" style="color: black; background: rgb(0,163,203)"><strong>&nbsp;Market
                            Place</strong></p>
                </div>
            </div>
            <?php }; ?>

            <!-----------Vehicle Financing--------------------->
            <?php if (in_array($role, array(BROKER))) : ?>
            <?php if (array_intersect($membership, array(BROKER_GOLD, BROKER_PLATINUM)))  { ?>

            <div class="col-lg-3 col-xs-6"
                 onclick="document.location='#'"
                 style="cursor:pointer; ">

                <?php } else { ?>
                <div
                    class="col-lg-3 col-xs-6"
                    onclick="document.location='#'"
                    style="cursor:pointer; opacity: 0.3;">


                    <?php } ?>

                    <div class="small-box bg-aqua">
                        <div class="inner bg-vf">
                            <h3>&nbsp;</h3>

                            <p>&nbsp;</p>
                        </div>

                        <p class="small-box-footer"
                           style="color: black; background: rgb(188,64,49)">
                            <strong>&nbsp;Vehicle Financing</strong></p>
                    </div>
                </div>
                <?php endif ?>


                <!-----------Real Estate--------------------->

                <?php if ((in_array($role, array(BROKER)))) : ?>
                <?php if (array_intersect($membership, array(BROKER_GOLD, BROKER_PLATINUM))) { ?>

                <div class="col-lg-3 col-xs-6"
                     onclick="document.location='#'"
                     style="cursor:pointer" id="realEstate">
                    <?php } else { ?>

                    <div class="col-lg-3 col-xs-6"
                         onclick="document.location='#'"
                         style="cursor:pointer; opacity: 0.3;" id="realEstate">
                        <?php } ?>
                        <div class="small-box">
                            <div class="inner bg-real">
                                <h3>&nbsp;</h3>

                                <p>&nbsp;</p>
                            </div>
                            <p class="small-box-footer"
                               style="color: black; background: rgb(188,64,49)"><strong>
                                    &nbsp;Real
                                    Estate</strong></p>
                        </div>
                    </div>
                    <?php endif ?>

                    <!----------Funding------------------>
                    <?php if (in_array($role, array(BROKER))): ?>
                    <?php if (array_intersect($membership, array(BROKER_PLATINUM))) { ?>
                    <div class="col-lg-3 col-xs-6"
                         onclick="document.location='<?php echo base_url() . 'administrator/content/pdfContents' ?>'"
                         style="cursor:pointer" id="funding">
                        <?php } else { ?>
                        <div class="col-lg-3 col-xs-6" onclick="document.location='#'" style="cursor:pointer; opacity: 0.3;" id="funding">
                            <?php } ?>
                            <div class="small-box bg-green">
                                <div class="inner bg-funding">
                                    <h3>&nbsp;</h3>

                                    <p>&nbsp;</p>
                                </div>
                                <p class="small-box-footer"
                                   style="color: black; background:rgb(207, 133, 15)">
                                    <strong>&nbsp;Funding</strong>
                                </p>
                            </div>
                        </div>
                        <?php endif ?>


                        <!-----------Business Credit------------------->
                        <?php if ((in_array(role(), array(BROKER))))  : ?>
                        <?php if (array_intersect($membership, array(BROKER_PLATINUM)))  { ?>
                        <div class="col-lg-3 col-xs-6"
                             onclick="document.location='#'"
                             style="cursor:pointer">
                            <?php } else { ?>
                            <div
                                class="col-lg-3 col-xs-6"
                                onclick="document.location='#'"
                                style="cursor:pointer; opacity: 0.3;">
                                <?php } ?>
                                <div class="small-box bg-aqua">
                                    <div class="inner bg-bc">
                                        <h3>
                                            &nbsp;</h3>

                                        <p>
                                            &nbsp;</p>
                                    </div>
                                    <p class="small-box-footer"
                                       style="color: black; background: rgb(207, 133, 15)">
                                        <strong>
                                            &nbsp;Business
                                            Credit</strong>
                                    </p>
                                </div>
                            </div>

                            <?php endif ?>


                            <!-----------Marketing Resources------------------->
                            <?php if ((in_array(role(), array(BROKER))))  : ?>
                            <?php if (array_intersect($membership, array(BROKER_PLATINUM))) { ?>
                            <div class="col-lg-3 col-xs-6"
                                 onclick="document.location='#'"
                                 style="cursor:pointer">
                                <?php } else { ?>
                                <div
                                    class="col-lg-3 col-xs-6"
                                    onclick="document.location='#'"
                                    style="cursor:pointer; opacity: 0.3;">
                                    <?php } ?>
                                    <div class="small-box bg-aqua">
                                        <div class="inner bg-marketing_resources">
                                            <h3>
                                                &nbsp;</h3>

                                            <p>
                                                &nbsp;</p>
                                        </div>
                                        <p class="small-box-footer"
                                           style="color: black; background: rgb(207, 133, 15)">
                                            <strong>
                                                &nbsp;Marketing Resources</strong>
                                        </p>
                                    </div>
                                </div>

                                <?php endif ?>


                                <!-----------Credit Resources------------------->
                                <?php if ((in_array(role(), array(BROKER))))  : ?>
                                <?php if (array_intersect($membership, array(BROKER_PLATINUM))) { ?>
                                <div class="col-lg-3 col-xs-6"
                                     onclick="document.location='#'"
                                     style="cursor:pointer">
                                    <?php } else { ?>
                                    <div
                                        class="col-lg-3 col-xs-6"
                                        onclick="document.location='#'"
                                        style="cursor:pointer; opacity: 0.3;">
                                        <?php } ?>
                                        <div class="small-box bg-aqua">
                                            <div class="inner bg-credit_resources">
                                                <h3>
                                                    &nbsp;</h3>

                                                <p>
                                                    &nbsp;</p>
                                            </div>
                                            <p class="small-box-footer"
                                               style="color: black; background: rgb(207, 133, 15)">
                                                <strong>
                                                    &nbsp;Credit Resources</strong>
                                            </p>
                                        </div>
                                    </div>

                                    <?php endif ?>


    </section>


</div>
