<style>
     { position: absolute; cursor: default; }
    { background: white url('http://jquery-ui.googlecode.com/svn/tags/1.8.2/themes/flick/images/ui-anim_basic_16x16.gif') right center no-repeat; }*/
    * html .ui-autocomplete { width:1px; } /* without this, the menu expands to 100% in IE6 */
 {
        list-style:none;
        padding: 2px;
        margin: 0;
        display:block;
    }
    .ui-menu .ui-menu {
        margin-top: -3px;
    }
    .ui-menu .ui-menu-item {
        margin:0;
        padding: 0;
        zoom: 1;
        float: left;
        clear: left;
        width: 100%;
        font-size:80%;
    }
    .ui-menu .ui-menu-item a {
        text-decoration:none;
        display:block;
        padding:.2em .4em;
        line-height:1.5;
        zoom:1;
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
            card type
            <small>Add</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="<?php echo base_url() . 'administrator/cardType/cardTypes'; ?>">Card Types</a></li>
            <li class="active">add</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <form action="<?php echo base_url() . 'administrator/cardType/addCardType'; ?>" method="post"
                  id="card">
                <div class="col-md-3">
                    <div class="box box-danger">
                        <div class="box-header">
                            <h3 class="box-title">Card Information:</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="type" class="control-label">Card Type:</label>

                                <div class="input-group">
                                    <div class="input-group-addon"><i class="glyphicon glyphicon-credit-card"></i></div>
                                    <input type="text" class="form-control" autocomplete="off" placeholder="Enter Card Type"
                                           id="type" name="type" />
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="type" class="control-label">Issuer Bank Name:</label>

                                <div class="input-group">
                                    <div class="input-group-addon"><i class="glyphicon glyphicon-home"></i></div>
                                    <input type="text" class="form-control" placeholder="Enter Bank Name"
                                           id="bank" name="bank" />
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="type" class="control-label">Card Name:</label>

                                <div class="input-group">
                                    <div class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></div>
                                    <input type="text" class="form-control"  placeholder="Enter Card Name"
                                           id="name" name="name" />
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="name" class="control-label">Bank Phone Number:</label>

                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                    <input type="text" class="form-control" placeholder="(999) 999-9999" data-mask="(999) 999-9999"
                                           id="phone" name="phone" autofocus/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="control-label">Bank Site:</label>

                                <div class="input-group">
                                    <div class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></div>
                                    <input type="text" class="form-control"  placeholder="Enter bank Website"
                                           id="site" name="site" autofocus/>
                                </div>
                            </div>


                        </div>
                        <div class="box-footer">
                            <div class="input-group">
                                              <span class="input-group-btn">
                                                <button type="submit" class="btn btn-primary btn-flat">Add Card Type</button>
                                              </span>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
<script>

    $("#card").bootstrapValidator({
        message: 'This value is not valid',
        fields: {
            site: {
                validators: {
                    notEmpty: {
                        message: 'The website field is required and can\'t be empty'
                    }
                }

            }, phone: {
                validators: {
                    notEmpty: {
                        message: 'Phone is required'
                    }
                }
            }
            , name: {
                validators: {
                    notEmpty: {
                        message: 'Credit Card Name is required'
                    }
                }
            }, bank: {
                validators: {
                    notEmpty: {
                        message: 'Bank Name is required'
                    }
                }
            }, type: {
                validators: {
                    notEmpty: {
                        message: 'Credit Card Type is required'
                    }
                }
            }
        }
    });

</script>

<script type="text/javascript">

    $(this).ready( function() {
        $("#type").autocomplete({
            minLength: 1,
            source:
                function(req, add){
                    $.ajax({
                        url: "<?php echo base_url(); ?>administrator/CardType/lookup",
                        dataType: 'json',
                        type: 'POST',
                        data: req,
                        success:
                            function(data){
                                if(data.response =="true"){
                                    add(data.message);
                                }
                            },
                    });
                },
            select:
                function(event, ui) {
                    $("#result").append(
                        "<li>"+ ui.item.value + "</li>"
                    );
                },
        });


    });

    $(this).ready( function() {
        $("#type").change(function () {
            type = $(this).val();
        })


        $("#bank").autocomplete({
            minLength: 1,
            source:
                function(req, add ){
                    $.ajax({
                        url: "<?php echo base_url(); ?>administrator/CardType/lookupBank" + '/' + type,
                        dataType: 'json',
                        type: 'POST',
                        data: req ,
                        success:
                            function(data){
                                if(data.response =="true"){
                                    add(data.message);
                                }
                            },
                    });
                },
            select:
                function(event, ui) {
                    $("#result").append(
                        "<li>"+ ui.item.value + "</li>"
                    );
                },
        });


    });


    $(this).ready( function() {
        $("#bank").change(function () {
            bank = $(this).val();
        })

    $(this).ready( function() {
        $("#name").autocomplete({
            minLength: 1,
            source:
                function(req, add){
                    $.ajax({
                        url: "<?php echo base_url(); ?>administrator/CardType/lookupName" + '/' + type + '/' + bank,
                        dataType: 'json',
                        type: 'POST',
                        data: req,
                        success:
                            function(data){
                                if(data.response =="true"){
                                    add(data.message);
                                }
                            },
                    });
                },
            select:
                function(event, ui) {
                    $("#result").append(
                        "<li>"+ ui.item.value + "</li>"
                    );
                },
        });
    });


    });




</script>