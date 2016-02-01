<style>
    ul.ui-autocomplete {
        z-index: 1100;
    }

    {
        position: absolute
    ;
        cursor: default
    ;
    }
    {
        background: white url('http://jquery-ui.googlecode.com/svn/tags/1.8.2/themes/flick/images/ui-anim_basic_16x16.gif') right center no-repeat
    ;
    }
    *

    /
    * html .ui-autocomplete {
        width: 1px;
    }

    /* without this, the menu expands to 100% in IE6 */
    {
        list-style: none
    ;
        padding: 2px
    ;
        margin: 0
    ;
        display: block
    ;
    }
    .ui-menu .ui-menu {
        margin-top: -3px;
    }

    .ui-menu .ui-menu-item {
        margin: 0;
        padding: 0;
        zoom: 1;
        float: left;
        clear: left;
        width: 100%;
        font-size: 80%;
    }

    .ui-menu .ui-menu-item a {
        text-decoration: none;
        display: block;
        padding: .2em .4em;
        line-height: 1.5;
        zoom: 1;
    }

    .ui-menu .ui-menu-item a.ui-state-hover,
    .ui-menu .ui-menu-item a.ui-state-active {
        font-weight: normal;
        margin: -1px;
    }

</style>


<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            Tradeline
            <small>Add</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="<?php echo base_url() . 'administrator/line/lines'; ?>">lines</a></li>
            <li class="active">add</li>
        </ol>
    </section>
    <section class="content">
        <?php include 'lineForm_content.php'; ?>
    </section>
</div>

<div class="modal fade" id="addLineTypeModal" tabindex="-1" role="dialog" aria-labelledby="addLineTypeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo base_url() . 'administrator/cardType/addCardType'; ?>" method="post"
                  id="cardtype">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="addLineTypeModalLabel">Add a new Card Type | Name</h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="box box-danger">
                            <div class="box-body">

                                <div class="form-group">
                                    <label for="type" class="control-label">Card Type:</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="glyphicon glyphicon-credit-card"></i>
                                        </div>
                                        <input type="text" class="form-control" value="" autocomplete="off"
                                               placeholder="Enter Card Type"
                                               id="type" name="type"/>
                                    </div>


                                </div>
                                <div class="form-group">
                                    <label for="name" class="control-label">Issuer Bank Name:</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="glyphicon glyphicon-home"></i></div>
                                        <input type="text" class="form-control" value="" autocomplete="off"
                                               placeholder="Enter Bank Name"
                                               id="bank" name="bank"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="control-label">Card Name:</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Enter Card Name"
                                               id="name" name="name"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="control-label">Bank Phone Number:</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                        <input type="text" class="form-control" placeholder="(999) 999-9999"
                                               data-mask="(999) 999-9999"
                                               id="phone" name="phone"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="control-label">Bank Site:</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></div>
                                        <input type="text" class="form-control"
                                               id="site" name="site"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Card Type</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(".select2").select2();
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    $("[data-mask]").inputmask();
    function getSite(typeSelection) {
        $.get("<?php echo base_url() . 'administrator/cardtype/getWebsite/true/'; ?>" + typeSelection.val()).done(function (data) {
            try {
                var site = $.parseJSON(data);
                if (site != '') {
                    $("#site_link").html("Need to look up details? Click here to go to issuer site");
                    $("#site_link").attr('href', site);
                } else {
                    $("#site_link").html('');
                    $("#site_link").attr('href', '');
                }
            } catch (e) {
                $("#site_link").html('');
                $("#site_link").attr('href', '');
            }
        });
    }
    $("#type_id").change(function () {
        var typeSelection = $("#type_id").find("option:selected");
        getSite(typeSelection);
        $.get("<?php echo base_url() . 'administrator/line/getCardTypes'; ?>", {
            type: typeSelection.text()
        }).done(function (data) {
            var data1 = $.parseJSON(data);
            var names = "";
            $("#type").html(names);
            $.each(data1, function (id, name) {
                names += "<option value='" + id + "'>" + name + "</option>";
            });
        })
    });

    $("#cardtype").submit(function (e) {
        $.post($(this).attr('action'), $(this).serialize(), function (response) {
        }, 'json').always(function () {
            $.get("<?php echo base_url() . 'administrator/line/getCards'; ?>").done(function (data) {
                var data1 = $.parseJSON(data);
                var names = "";
                $.each(data1, function (id, name) {
                    names += "<option value='" + id + "'>" + name + "</option>";
                });
                $("#type_id").html(names);
                var typeSelection = $("#type_id").find("option:selected");
                getSite(typeSelection);
                $(".select2").select2();
            })
        });
        $("#addLineTypeModal").modal('hide');
        return false;
    });

    $("#addcard").click(function () {
        $("#addLineTypeModal").modal();
        return false;
    });

    $("#line").bootstrapValidator({
        message: 'This value is not valid',
        fields: {
            type_id: {
                message: 'Not Valid',
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            }, lmt: {
                message: 'Not Valid',
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            }, balance: {
                message: 'Not Valid',
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            }, open: {
                message: 'Not Valid',
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }, between: {
                        min: 1915,
                        max: 2015,
                        message: 'Not Valid'
                    }
                }
            }, price: {
                message: 'Not Valid',
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
            statement: {
                validators: {
                    between: {
                        min: 1,
                        max: 31,
                        message: 'Not Valid'
                    }, notEmpty: {
                        message: 'Required'
                    }
                }
            },
            url: {
                validators: {
                    stringLength: {
                        min: 0
                    },
                    uri: {
                        message: 'Not Valid'
                    }
                }
            }
        }
    });


    $(this).ready(function () {
        $("#type").autocomplete({
            minLength: 1,
            source: function (req, add) {
                $.ajax({
                    url: "<?php echo base_url(); ?>administrator/CardType/lookup",
                    dataType: 'json',
                    type: 'POST',
                    data: req,
                    success: function (data) {
                        if (data.response == "true") {
                            add(data.message);
                        }
                    }
                });
            },
            select: function (event, ui) {
                $("#result").append(
                    "<li>" + ui.item.value + "</li>"
                );
            }
        });


    });

    $(this).ready(function () {
        $("#type").change(function () {
            type = $(this).val();
        });


        $("#bank").autocomplete({
            minLength: 1,
            source: function (req, add) {
                $.ajax({
                    url: "<?php echo base_url(); ?>administrator/CardType/lookupBank" + '/' + type,
                    dataType: 'json',
                    type: 'POST',
                    data: req,
                    success: function (data) {
                        if (data.response == "true") {
                            add(data.message);
                        }
                    }
                });
            },
            select: function (event, ui) {
                $("#result").append(
                    "<li>" + ui.item.value + "</li>"
                );
            }
        });


    });


    $(this).ready(function () {
        $("#bank").change(function () {
            bank = $(this).val();
        });

        $(this).ready(function () {
            $("#name").autocomplete({
                minLength: 1,
                source: function (req, add) {
                    $.ajax({
                        url: "<?php echo base_url(); ?>administrator/CardType/lookupName" + '/' + type + '/' + bank,
                        dataType: 'json',
                        type: 'POST',
                        data: req,
                        success: function (data) {
                            if (data.response == "true") {
                                add(data.message);
                            }
                        }
                    });
                },
                select: function (event, ui) {
                    $("#result").append(
                        "<li>" + ui.item.value + "</li>"
                    );
                }
            });
        });


    });


</script>


