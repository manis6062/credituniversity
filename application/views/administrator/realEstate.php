<style>
    .small-box > .small-box-footer {
        text-align: left;
    }

</style>
<div class="content-wrapper bg-sold">
    <section class="content-header">
        <h1>
            <span id="real_estate" style="cursor: pointer"
                  onclick="document.location = currentUrl() + '?option=descript'"><?php echo "Real Estate" ?></span>
        </h1>

        <br/>

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        </ol>
    </section>
    <section class="content">

        <div class="col-lg-3 col-xs-6" id="purchase" style="cursor:pointer">
            <div class="small-box">
                <div class="prp inner bg-purchase_refinance">
                    <div class="bg-soon">
                        <h3>&nbsp;</h3>

                        <p>&nbsp;</p>
                    </div>
                </div>
                <p class="prp small-box-footer" style="color: black; background: rgb(207, 133, 15)"><strong>&nbsp;Purchase
                        & Refinance Property</strong></p>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6" style="cursor:pointer" id="rental">
            <div class="small-box">
                <div class="rip inner bg-rental_investment">
                    <div class="bg-soon">
                        <h3>&nbsp;</h3>

                        <p>&nbsp;</p>
                    </div>
                </div>
                <p class="rip small-box-footer" style="color: black; background: rgb(207, 133, 15)"><strong>&nbsp;Rental
                        & Investment Property</strong></p>
            </div>
        </div>


        <div class="col-lg-3 col-xs-6" id="home" style="cursor:pointer; ">
            <div class="small-box bg-aqua">
                <div class="hlp inner bg-home_loan">
                    <div class="bg-soon">
                        <h3>&nbsp;</h3>

                        <p>&nbsp;</p>
                    </div>
                </div>

                <p class="hlp small-box-footer"
                   style="color: black; background: rgb(207, 133, 15)">
                    <strong>&nbsp;Home Loan Products
                    </strong></p>
            </div>
        </div>


        <div class="col-lg-3 col-xs-6" style="cursor:pointer" id="help">
            <div class="small-box bg-green">
                <div class="hfho inner bg-help_home_owner">
                    <div class="bg-soon">
                        <h3>&nbsp;</h3>

                        <p>&nbsp;</p>
                    </div>
                </div>
                <p class="hfho small-box-footer"
                   style="color: black; background:rgb(207, 133, 15)">
                    <strong>&nbsp;Help For Home Owners</strong>
                </p>
            </div>
        </div>


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


        <div class="col-md-8 boxes" id="prp">

            <div class="box box-solid">
                <div class="box-body">
                    <div class="col-md-6">
                        "Purchase & Refinance Property"
                        </a>
                    </div>

                </div>
            </div>

        </div>

        <div class="col-md-8 boxes" id="rip">

            <div class="box box-solid">
                <div class="box-body">
                    <div class="col-md-6">
                        "Rental & Investment Property"
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-8 boxes" id="hlp">

            <div class="box box-solid">
                <div class="box-body">
                    <div class="col-md-6">
                        "Home Loan Products "
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-8 boxes" id="hfho">
            <div class="box box-solid">
                <div class="box-body">
                    <div class="col-md-6">
                        " Help For Home Owners"
                        </a>
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