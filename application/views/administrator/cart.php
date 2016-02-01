<div class="content-wrapper bg-main">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Invoice
            <small>#<?php echo $lastTrasactionId->last_id + 1 ;?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('administrator'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url('administrator/line/market'); ?>">Tradelines Marketplace</a></li>
            <li class="active">Invoice</li>
        </ol>
    </section>

    <div class="pad margin no-print">
        <div class="callout callout-info" style="margin-bottom: 0!important;">
            <h4><i class="fa fa-info"></i> Note:</h4>
            Once your payment is sucessfully processed owners will be automatically notified to add clients under
            their tradelines.
            <br/>
            Once successfully added by tradeline owner, respective broker and / or client will be notified.
        </div>
    </div>

    <!-- Main content -->
    <section  class="invoice">
        <div id="mainContent">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-globe"></i> The Credit University
                    <small class="pull-right"><?php echo date("m/d/Y"); ?></small>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                From
                <address>
                    <strong>Cybernetics Technology, Inc.</strong><br>
                    1266 Jungermann Road <br>
                    San Peters, MO 93376<br>
                    Phone: (636) 333-9200<br>
                    Email: invoice@thecredituniversity.com
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                To
                <address>
                    <strong><?php echo $this->session->userdata['first_last_name'] ?></strong><br>
                    <?php echo $this->session->userdata['street'] ?><br>
                    <?php echo $this->session->userdata['city'] ?>, <?php echo $this->session->userdata['state'] ?>  <?php echo $this->session->userdata['postal_code'] ?><br>
                    Phone: <?php echo $this->session->userdata['phone'] ?><br>
                    Email: <?php echo $this->session->userdata['email'] ?>
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-2 invoice-col">
                <b>Invoice #<?php echo $lastTrasactionId->last_id + 1 ;?></b><br>
                <br>
                <b>Payment Due:</b> <?php echo date("m/d/Y"); ?><br>
                <b>Account:</b> <?php echo $this->session->userdata[USER_ID] ?>
            </div>

            <div class="row">
                <div class="col-sm-2 invoice-col">
                    <a href="<?php echo base_url(ADMIN_PATH . 'cart/emptyCart') ?>">
                        <button class="btn btn-danger pull-right"><i class="fa fa-trash fa-lg"></i> Empty Cart</button>
                    </a>
                </div>
                <div class="col-sm-2 invoice-col">

                </div>
                <div class="col-sm-2 invoice-col">

                </div>
                <div class="col-sm-2 invoice-col">
                    <a href="<?php echo base_url(ADMIN_PATH . 'line/market') ?>">
                        <button class="btn btn-primary pull-right"><i class="fa fa-forward fa"></i> Continue Shopping
                        </button>
                    </a>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead style="text-align: left">
                    <tr style="text-align: left">
                        <th>Tradeline</th>
                        <th>Product</th>
                        <th>Client</th>
                        <th>Line Price</th>
                        <th>Months</th>
                        <th>Subtotal</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($cartItem as $i => $items):
                        ?>

                        <?php echo form_hidden($i . '[rowid]', $items['rowid']); ?>
                        <tr>
                            <div id="<?php echo $i ;?>message" style="width: 300px; float: right; margin-right: 150px; padding-left: 70px;"></div>
                            <td> <?php echo $items['id']; ?></td>

                            <td>
                                <?php echo $items['name'];
                                ?>
                                <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>
                                    <p>
                                        <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>
                                            <!--                                            <strong>--><?php //echo $option_name; ?><!--:</strong> --><?php //echo $option_value; ?>
                                            <!--                                            <br/>-->
                                        <?php endforeach; ?>
                                    </p>
                                <?php endif; ?>
                            </td>
                            <td> <?php echo $items['clientName']; ?></td>

                            <td > <?php echo $this->cart->format_number($items['price']); ?></td>
                            <td><?php echo form_input(array( 'id' => $i .  'whatever' , 'name' => $i . '[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5')); ?>




                            </td>
                            <td id="<?php echo $i ;?>subtotal">
                                $<?php echo $this->cart->format_number($items['subtotal']); ?></td>

                            <script>
                                $(document).ready(function(){
                                    $("#<?php echo $i ;?>whatever").change(function(){
                                        var new_value = $(this).val();
                                        var row_id = '<?php echo $items['rowid'] ;?>';
                                        $.ajax({
                                            type: "POST",
                                            url: "<?php echo base_url('administrator/cart/updateCart'); ?>",
                                            data:{row_id : row_id , qty : new_value},
                                            success: function(data){
                                                console.log('success');
                                                $('#<?php echo $i ;?>message').append('Updated Successfully');
                                                $('#<?php echo $i ;?>message').css('background' , 'lightskyblue');
                                                $('#<?php echo $i ;?>message').css('line-height' , '250%');
                                                $('#<?php echo $i ;?>message').css('font-size' , '18px');
                                                $("#<?php echo $i ;?>message").fadeOut(3000);

                                                $('#<?php echo $i ;?>subtotal').html(data);
                                                var new_total = new_value * 100;
                                                $('#<?php echo $i ;?>subtotal').append('$'+new_total);

                                            }
                                        });





                                    });
                                });
                            </script>


                            <td><a href="#" onClick="return RemoveItem('<?php echo $items['rowid'] ?>')"><span
                                        class="fa fa-trash fa-lg"></span> </a></td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>



        <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">
                <p class="lead">Payment Methods:</p>
                <img src="<?php echo base_url(); ?>backend/image/credit/visa.png" alt="Visa">
                <img src="<?php echo base_url(); ?>backend/image/credit/mastercard.png" alt="Mastercard">
                <img src="<?php echo base_url(); ?>backend/image/credit/american-express.png"
                     alt="American Express">
                <img src="<?php echo base_url(); ?>backend/image/credit/paypal2.png" alt="Paypal">

                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                    Please note that though Paypal can accept most major credit cards without having an account
                    with them, we are diligently working on adding other payment options in near future.
                </p>
            </div>
            <!-- /.col -->
            <div class="col-xs-6">
                <p class="lead">Amount Due : Now</p>

                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">Subtotal:</th>
                            <td>$<?php echo $this->cart->format_number($this->cart->total()); ?></td>
                        </tr>
                        <tr>
                            <th>Tax (0.00%)</th>
                            <td>$0.00</td>
                        </tr>
                        <tr>
                            <th>Shipping:</th>
                            <td>$0.00</td>
                        </tr>
                        <tr>
                            <th>Total:</th>
                            <td>$<?php echo $this->cart->format_number($this->cart->total()); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        </div>
        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <a href="<?php echo base_url(ADMIN_PATH . 'line/invoicePrint') ?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i>
                    Print</a>
                <!--                <button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>-->
                <a href="<?php echo base_url(ADMIN_PATH . 'payment/buyLineByBroker') ?>">
                    <button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Checkout</button>
                </a>
                <button class="btn btn-primary pull-right" style="margin-right: 5px;" onclick="generatePdf()"><i class="fa fa-download"></i>
                    Generate PDF
                </button>
            </div>
        </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
</div>
<!-- /.content-wrapper -->


<script>
    function RemoveItem(id) {
        $.post('<?php echo base_url(ADMIN_PATH.'cart/removeCartItem')?>',
            {itemId: id})
            .done(function (data) {
                location.reload();
                //$('#cartItemList').html(data);
            });
    }

    function generatePdf(){
        var pdf = new jsPDF('l', 'pt', 'a2')


// source can be HTML-formatted string, or a reference
// to an actual DOM element from which the text will be scraped.
            , source = $('#mainContent')[0]

// we support special element handlers. Register them with jQuery-style
// ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
// There is no support for any other type of selectors
// (class, of compound) at this time.
            , specialElementHandlers = {
            // element with id of "bypass" - jQuery style selector
            '#mainContent': function(element, renderer){
                // true = "handled elsewhere, bypass text extraction"
                return true
            }
        }

        margins = {
            top: 80,
            bottom: 60,
            left: 40,
            width: 522
        };
        // all coords and widths are in jsPDF instance's declared units
        // 'inches' in this case

        pdf.fromHTML(
            source // HTML string or DOM elem ref.
            , margins.left // x coord
            , margins.top // y coord
            , {
                'width': margins.width // max width of content on PDF
                ,'elementHandlers': specialElementHandlers
            },
            function (dispose) {
                // dispose: object with X, Y of the last line add to the PDF
                //          this allow the insertion of new lines after html
                //pdf.save('Test.pdf');
                pdf.output('dataurlnewwindow',{});
            },
            margins
        )
    }
</script>
