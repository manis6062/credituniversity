<style xmlns="http://www.w3.org/1999/html">

    table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        min-width: 100%;
    }

    thead input {
        width: 100%;
        box-sizing: border-box;
    }

    .form-inline .form-control {
        box-sizing: border-box;

        display: inline-block;
        vertical-align: middle;
        width: 100%;
    }

    th, td {
        white-space: nowrap;
    }

</style>

<div class="content-wrapper bg-marketplace">
    <section class="content-header">
        <h1>
            <span id="marketplace" onclick="document.location = currentUrl() + '?option=descript'"
                  style="cursor: pointer"><?php echo "Marketplace" ?></span>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('administrator'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Lines</li>
        </ol>
    </section>

    <section class="content">

        <div class="col-lg-3 col-xs-6" id="authorized_users" style="cursor:pointer"
             onclick="document.location = currentUrl() + '?option=au_content'">
            <div class="small-box rounded">
                <div class="au1 inner bg-authorized_users">
                    <h3>&nbsp;</h3>

                    <p>&nbsp;</p>
                </div>
                <p class="au1 small-box-footer" style="color: black; background: rgb(207, 133, 15)"><strong>&nbsp;Authorized
                        Users</strong></p>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6" id="primaries"
             style="cursor:pointer">
            <div class="small-box rounded">
                <div class="p1 inner bg-funding">
                    <div class="bg-soon">
                        <h3>&nbsp;</h3>

                        <p>&nbsp;</p>
                    </div>
                </div>
                <p class="p1 small-box-footer" style="color: black; background: rgb(207, 133, 15)"><strong>
                        &nbsp;Primaries</strong></p>
            </div>
        </div>


        <div class="col-md-12 boxes" id="au_content" style="min-width: 100%">
            <div class="row" id="lines_lines" style="min-width: 100%">
                <div class="box">
                    <div class="nav-tabs-custom transbox">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#authorize" data-toggle="tab">Marketplace</a></li>
                            <li><a href="#add_client" data-toggle="tab">Add Client</a></li>
                            <li><a href="#add_tradeline" data-toggle="tab">Add
                                    Tradeline</a></li>
                            <div class="col-md-3 col-sm-6 col-xs-12" style="float: right; cursor: pointer"
                                 onclick="document.location = currentUrl() + '../../../line/cart'">
                                <div class="info-box bg-aqua" style="margin-bottom: 0">
                                    <span class="info-box-icon"><i class="fa fa-shopping-cart"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Shopping Cart</span>
                                        <span
                                            class="info-box-number"><div
                                                id="cartItems"><?php echo count($this->cart->contents()) . ' tradelines'; ?></div> </span>

                                        <div class="progress">
                                            <div class="progress-bar" style="width: 70%"></div>
                                        </div>
                                              <span class="progress-description">
                                                Proceed to Checkout
                                              </span>
                                    </div>
                                </div>
                            </div>
                        </ul>

                        <div class="tab-content">
                            <div class="active tab-pane" id="authorize">
                                <div class="container-fluid">
                                    <div class="col-xs-12">
                                        <div class="box">
                                            <div class="box-body">
                                                <table
                                                    class="table table-bordered table-striped table-hover datatable"
                                                    id="lines">

                                                    <thead>
                                                    <tr>
                                                        <th>All</th>
                                                        <th>All</th>
                                                        <?php if ($role == BROKER) : ?>
                                                            <th>All</th>
                                                        <?php endif; ?>
                                                        <th>All</th>
                                                        <?php if ($role == BROKER) : ?>
                                                            <th>All</th>
                                                        <?php endif; ?>

                                                        <th>All</th>
                                                        <th>All</th>
                                                        <th>All</th>
                                                        <th>All</th>
                                                        <th></th>
                                                        <?php if ($role == BROKER) : ?>
                                                            <th></th>
                                                        <?php endif; ?>
                                                        <?php if ($role == CLIENT) : ?>
                                                            <th>Buy</th>
                                                        <?php endif; ?>
                                                    </tr>

                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Summary</th>
                                                        <?php if ($role == BROKER) : ?>
                                                            <th>Primary</th>
                                                        <?php endif; ?>
                                                        <th>Cost</th>
                                                        <?php if ($role == BROKER) : ?>
                                                            <th>Sell</th>
                                                        <?php endif; ?>
                                                        <th>Year</th>
                                                        <th>Close</th>
                                                        <th>Limit</th>
                                                        <th>Bal</th>
                                                        <th>Qty</th>
                                                        <?php if ($role == BROKER) : ?>
                                                            <th>Assign Clients</th>
                                                        <?php endif; ?>
                                                        <?php if ($role == CLIENT) : ?>
                                                            <th>Buy</th>
                                                        <?php endif; ?>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    <?php foreach ($lines as $line) { ?>
                                                        <tr class="item">
                                                            <td><?php echo $line->id; ?></td>
                                                            <td><?php echo $line->line; ?></td>
                                                            <?php if ($role == BROKER) : ?>
                                                                <td><?php echo $line->user; ?></td>
                                                            <?php endif; ?>
                                                            <td><?php if ($role == CLIENT) {
                                                                    echo '$' . number_format($line->client_broker_price);
                                                                } else {
                                                                    echo '$' . number_format($line->broker_price);
                                                                } ?></td>
                                                            <?php if ($role == BROKER) : ?>
                                                                <td><a href="#" id="client_broker_price"
                                                                       data-type="text"
                                                                       data-pk=<?php echo $line->id ?>><?php echo '$' . number_format($line->client_broker_price) ?></a>
                                                                </td>
                                                            <?php endif; ?>

                                                            <td><?php echo $line->open; ?></td>
                                                            <td><?php echo $line->statement; ?></td>
                                                            <td><?php echo '$' . number_format($line->lmt) ?></td>
                                                            <td><?php echo '$' . number_format($line->balance) ?></td>
                                                            <td><?php echo($line->max - $line->used) ?></td>

                                                            <?php if ($role == BROKER) : ?>
                                                                <td>
                                                                <?php if (($line->max - $line->used) > 0) { ?>
                                                                    <select name="clients" multiple="multiple"
                                                                            id='clients_<?php echo $line->id; ?>'
                                                                            onchange='addItem(<?php echo json_encode(array('id' => $line->id, 'name' => $line->itemName, 'cost' => $line->price, 'qty' => 1, 'owner_price' => $line->price, 'broker_price' => $line->broker_price, 'client_broker_price' => $line->client_broker_price)); ?>, this.id)'
                                                                            class="form-control roles selectpicker show-tick"
                                                                            data-container="body"
                                                                            data-live-search="true">
                                                                    <?php
                                                                    $assignees = '';
                                                                    foreach ($clients as $key => $value): ?>
                                                                        <option
                                                                            value="<?php echo $key; ?>" <?php if (in_array($key, $cart[$line->id])) echo ' selected'; ?>><?php echo $value; ?></option>
                                                                    <?php endforeach ?>
                                                                    </select>
                                                                    <?php } else { ?>
                                                                    <div id="noClients"  data-toggle="popover" data-placement="left"
                                                                         data-content="This line is currently not available. Please check back later. <?php ?>">
                                                                        <select name="clients" multiple="multiple" disabled
                                                                                class="form-control roles selectpicker show-tick"
                                                                                data-container="body"
                                                                                data-live-search="true">
                                                                            <?php
                                                                            $assignees = '';
                                                                            foreach ($clients as $key => $value): ?>
                                                                                <option
                                                                                    value="<?php echo $key; ?>" <?php if (in_array($key, $cart[$line->id])) echo ' selected'; ?>><?php echo $value; ?></option>
                                                                            <?php endforeach ?>
                                                                        </select>

                                                                    </div>







                                                                <?php }  ?>
                                                                </td>
                                                            <?php endif; ?>

                                                            <?php if ($role == CLIENT) : ?>
                                                                <td>
                                                                    <?php if (in_array($line->id, array_map(function($o) { return $o[id]; }, $this->cart->contents()))) { ?>
                                                                    <a href="#" id="purchase<?php echo $line->id; ?>"
                                                                       data-toggle="popover" data-placement="left"
                                                                       data-content="This line is already added. <?php ?>"
                                                                       class="fa fa-check fa-lg"></i></a>
                                                                    <?php } else { ?>
                                                                    <?php if (($line->max - $line->used) > 0) { ?>
                                                                        <a href="#" id="purchase<?php echo $line->id; ?>"
                                                                           onclick='addItem(<?php echo json_encode(array('id' => $line->id, 'name' => $line->itemName, 'cost' => $line->client_broker_price, 'qty' => 1, 'owner_price' => $line->price, 'broker_price' => $line->broker_price, 'client_broker_price' => $line->client_broker_price)); ?>, this.id);'
                                                                           class="fa fa-cart-plus fa-lg"></i></a>
                                                                    <?php } else { ?>
                                                                        <a href="#" id="purchase<?php echo $line->id; ?>"
                                                                           data-toggle="popover" data-placement="left"
                                                                           data-content="This line is currently not available. Please check back later. <?php ?>"
                                                                            ><i class="fa fa-cart-plus fa-lg"></i></a>
                                                                        <?php } ?>
                                                                    <?php } ?>
                                                                </td>
                                                            <?php endif; ?>
                                                        </tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="tab-pane" id="add_client">
                                <div class="container-fluid">
                                    <div class="col-xs-4">
                                        <form action="#" method="post" id="user">
                                            <div class="row">


                                                <input type="hidden"
                                                       value="<?php echo $this->session->userdata(USER_ID); ?>"
                                                       name="brokerId">
                                                <input type="hidden" value="2" name="roleId">

                                                <div class="form-group col-md-5">
                                                    <label for="firstName">First Name:</label>

                                                    <div class="input-group">
                                                        <div class="input-group-addon"><strong>F</strong></i>
                                                        </div>
                                                        <?php echo form_input(array('class' => 'form-control', 'id' => 'firstName', 'name' => 'firstName')); ?>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label for="mi">M.I:</label>

                                                    <div class="input-group">
                                                        <div class="input-group-addon"><strong>M</strong></i>
                                                        </div>
                                                        <input class="form-control" id="mi" name="mi"
                                                               data-mask="A">
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-5">
                                                    <label for="lastName">Last Name:</label>

                                                    <div class="input-group">
                                                        <div class="input-group-addon"><strong>L</strong></i>
                                                        </div>
                                                        <?php echo form_input(array('class' => 'form-control', 'id' => 'lastName', 'name' => 'lastName')); ?>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="ssn">SSN:</label>

                                                    <div class="input-group ">
                                                        <div class="input-group-addon"><i class="fa fa-user"></i>
                                                        </div>
                                                        <input type="text" class="form-control" id="ssn" name="ssn"
                                                               data-mask="000-00-0000"
                                                               placeholder="___-__-____"/>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="dob">Date Of Birth:</label>

                                                    <div class="input-group">
                                                        <div class="input-group-addon"><i
                                                                class="fa fa-calendar"></i></div>
                                                        <input type='text' class="form-control" id='dob' name="dob"
                                                               data-mask="00-00-0000"
                                                               placeholder="MM-DD-YYYY" "/>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="email">Email:</label>

                                                    <div class="input-group">
                                                        <div class="input-group-addon"><i
                                                                class="fa fa-envelope"></i></div>
                                                        <input type='text' class="form-control" id='email'
                                                               name="email""/>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="phone">Phone number:</label>

                                                    <div class="input-group">
                                                        <div class="input-group-addon"><i class="fa fa-phone"></i>
                                                        </div>
                                                        <input type="text" class="form-control"
                                                               id="phone" name="phone"
                                                               data-mask="(999)-999-9999"
                                                               placeholder="(999)999-9999"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-footer">
                                                <div class="input-group">
                                                    <input type="submit" class="btn btn-primary btn-flat"
                                                           value="Add">
                                                    <input type="button" class="btn btn-primary btn-flat"
                                                           value="Cancel"
                                                           onclick="window.history.back()"/>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="add_tradeline">
                                <div class="container-fluid">
                                    <div class="col-xs-6">
                                        <div class="row">
                                            <div class="border col-md-12">
                                                <div class="row">
                                                    <div class="box-body">
                                                        <form
                                                            action="<?php echo base_url() . 'administrator/line/addLine'; ?>"
                                                            method="post" id="line">
                                                            <div class="row">
                                                                <div class="form-group col-md-8">
                                                                    <label class="left"
                                                                           style="padding-right: 20px;">Owner:</label>
                                                                    <?php echo form_dropdown('user_id', $owners, $this->session->userdata(USER_ID), array('class' => 'form-control select2', 'id' => 'user_id')) ?>
                                                                </div>

                                                            </div>

                                                            <div class="row">
                                                                <div class="form-group col-md-8">
                                                                    <?php echo form_label('Tradeline Type:'); ?>
                                                                    <?php echo form_dropdown('type_id', $banks, '', array('class' => 'form-control select2 type_id', 'id' => 'type_id')) ?>
                                                                </div>
                                                            </div>


                                                            <div class="row">

                                                                <div class="form-group col-md-8">
                                                                    <label class="control-label"
                                                                           for="lmt">Limit:</label>

                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i
                                                                                class="fa fa-dollar"></i></div>
                                                                        <input type="text" class="form-control"
                                                                               id="lmt" name="lmt"/>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-8">
                                                                    <label class="control-label"
                                                                           for="balance">Balance:</label>

                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i
                                                                                class="fa fa-dollar"></i></div>
                                                                        <input type="text" class="form-control"
                                                                               id="balance" name="balance"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-8">
                                                                    <label class="control-label"
                                                                           for="open">Opened:</label>

                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i
                                                                                class="fa fa-phone"></i></div>
                                                                        <input type="text" class="form-control"
                                                                               id="open" name="open"
                                                                               data-mask="0000" placeholder="YYYY"/>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-8">
                                                                    <label class="control-label"
                                                                           for="statement">Statement</label>

                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i
                                                                                class="fa fa-phone"></i></div>
                                                                        <input type="text" class="form-control"
                                                                               id="statement" name="statement"
                                                                               data-mask="00" placeholder="DD"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-8">
                                                                    <label class="control-label"
                                                                           for="price">Price:</label>

                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i
                                                                                class="fa fa-dollar"></i></div>
                                                                        <input type="text" class="form-control"
                                                                               id="price" name="price"/>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-8">
                                                                    <?php echo form_label('maximus users:', 'max', array('class' => 'control-label'));
                                                                    echo form_dropdown('max', getNumbers(1, 15), 0, array('class' => 'form-control select2', 'name' => 'max'))
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-8">
                                                                    <?php echo form_label('activate line:', 'activate', array('class' => 'control-label', 'style' => 'padding-right: 20px'));
                                                                    echo form_dropdown('status', array(1 => 'activate', 0 => 'activate later'), $this->session->userdata(USER_ID), array('class' => 'form-control select2'))
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <div class="box-footer">
                                                                <div class="input-group">
                                              <span class="input-group-btn">
                                                <button type="submit" class="btn btn-primary btn-flat">add</button>
                                              </span>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
        </div>

        <div class="col-md-6 boxes" id="pri">
            <div class="box box-solid">
                <div class="box-body">
                    <div class="col-md-6">
                        "Primaries "
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>


<script>

    $(".select2").select2();

    //        $(function () {
    //
    //            $('.selectpicker').on('change', function () {
    //                var selected = $(this).find("option:selected").val();
    //                alert(selected);
    //            });
    //
    //        });


    $(document).ready(function () {
        $('[data-toggle="popover"]').popover({
            container: 'body' });
    });

    var table = $('#lines').dataTable({
        iDisplayLength: 100,
        "sScrollX": "100%"
    });
    table.columnFilter({
            sPlaceHolder: "head:before",
            aoColumns: [
                {type: "text"},
                {type: "select"},
                {type: "select"},
                {type: "select"},
                {type: "select"},
                {type: "select"},
                {type: "select"},
                {type: "select"},
                {type: "select"},
                null,
                null
            ]
        }
    );

    table.fnAdjustColumnSizing();

    $('#client_broker_price*').editable({
        placement: 'right',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params) {
            params.table = 'line';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });

    function deleteFromCart(item) {
        $.post("<?php echo base_url() . 'administrator/cart/deleteCartItem'; ?>", item)
            .success(function (data) {
                try {
                    var message = $.parseJSON(data).message;
                    if (message) {
                        $("#baseModal2").modal().find('.modal-body').text(message).show();
                    } else {
                        location.reload();
                    }
                } catch (e) {
                    location.reload();
                }
            });
    }

    function addItem(item, clients) {
//        alert(clients);
//        alert(item);
//        alert($('#' + clients).val());
//        alert(test.val());
        $.post("<?php echo base_url() . 'administrator/cart/addItem/'; ?>" + $('#' + clients).val(), item)
            .success(function (data) {
                $('#cartItems').html(data + ' tradelines');
                $('#purchase' + item["id"]).removeClass("fa fa-cart-plus fa-lg");
                $('#purchase' + item["id"]).addClass("fa fa-check fa-lg");
            });
//                $('.new_cart').fadeOut(800, function () {
////                    form.html(msg).fadeIn().delay(2000);
//
//                });
//                try {
//                    var message = $.parseJSON(data).message;
//                    if (data1.message) {
//                        $("#baseModal2").modal().find('.modal-body').text(message).show();
//                    } else {
////                        location.reload();
//                    }
//                } catch (e) {
////                    alert(e);
////                    location.reload();
//                }
    }

    $('#quantity*').editable({
        url: '<?php echo base_url() . 'administrator/post'; ?>',

        params: function (params, newValue) {
            params.table = 'cart_item';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') {
                return response.msg;
            }
            location.reload();
        }
    });

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


    $(document).ready(function () {
        $(".select2").select2();

        $("#user").on('init.field.fv', function (e, data) {
            var $icon = data.element.data('fv.icon'),
                options = data.fv.getOptions(),
                validators = data.fv.getOptions(data.field).validators;
            if (validators.notEmpty && options.icon && options.icon.required) {
                $icon.addClass(options.icon.required).show();
            }
        }).formValidation({
            framework: 'bootstrap',
            icon: {
                required: 'fa fa-asterisk',
                valid: 'fa fa-check',
                invalid: 'fa fa-times',
                validating: 'fa fa-refresh'
            },
            excluded: ':disabled',
            fields: {
                mi: {
                    validators: {
                        regexp: {
                            regexp: /^[a-z\s]+$/i,
                            message: 'The middle initial can consist of alphabetical characters and spaces only'
                        }
                    }
                }, email: {
                    validators: {
                        callback: {
                            callback: function (value, validator, $field) {
                                $('#email').val(value.trim());
                                return true;
                            }
                        },
                        emailAddress: {
                            message: 'Enter valid email address'
                        },
                        regexp: {
                            regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                            message: 'The value is not a valid email address'
                        },
                        blank: {}
                    }
                }, firstName: {
                    validators: {
                        notEmpty: {
                            message: 'First Name is required'
                        },
                        regexp: {
                            regexp: /^[a-z\s]+$/i,
                            message: 'The first name can consist of alphabetical characters and spaces only'
                        },
                        blank: {}
                    }
                }, lastName: {
                    validators: {
                        notEmpty: {
                            message: 'Required'
                        },
                        regexp: {
                            regexp: /^[a-z\s]+$/i,
                            message: 'The last name can consist of alphabetical characters and spaces only'
                        },
                        blank: {}
                    }
                }, phone: {
                    validators: {
                        blank: {}
                    }
                }, ssn: {
                    validators: {
                        notEmpty: {
                            message: 'SSN is required'
                        },
                        regexp: {
                            regexp: /^\d{3}-?\d{2}-?\d{4}$/,
                            message: 'SSN format (222-22-2222)'
                        },
                        stringLength: {
                            max: 30
                        },
                        blank: {}
                    }
                }, dob: {
                    validators: {
                        notEmpty: {
                            message: 'Required'
                        },
                        blank: {},
                        date: {
                            format: 'MM-DD-YYYY',
                            max: '01-01-1994',
                            message: 'You should be at 21 yrs'
                        }
                    }
                }
            }
        }).on('status.field.fv', function (e, data) {
            var $icon = data.element.data('fv.icon'),
                options = data.fv.getOptions(),
                validators = data.fv.getOptions(data.field).validators;
            if (validators.notEmpty && options.icon && options.icon.required) {
                $icon.removeClass(options.icon.required).addClass('fa');
            }
        }).on('success.form.fv', function (e) {
            e.preventDefault();
            $.post("<?php echo base_url() . 'administrator/user/addUser'; ?>", $(this).serialize())
                .done(function (data) {
                    serverValidationNew($("#user"), data, '<?php echo base_url() . 'administrator/line/market?option=au_content/'?>');
                });
        });
    });

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

    $("#line").formValidation({
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
