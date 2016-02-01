<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>The Credit University | Invoice</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link href="<?php echo base_url(); ?>frontend/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>backend/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css"/>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body onload="window.print();">
<div class="wrapper">
    <!-- Main content -->
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-globe"></i> The Credit University, Inc.
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
                    St Peters, MO 93376<br>
                    Phone: (636) 333-9200<br>
                    Email: invoice@thecredituniversity.com
                </address>
            </div>
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
            <div class="col-sm-4 invoice-col">
                <b>Invoice #<?php echo $lastTrasactionId->last_id + 1 ;?></b><br>
                <br>
                <b>Payment Due:</b> <?php echo date("m/d/Y"); ?><br>
                <b>Account:</b> <?php echo $this->session->userdata[USER_ID] ?>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Tradeline</th>
                        <th>Product</th>
                        <th>Client</th>
                        <th>Line Price</th>
                        <th>Months</th>
                        <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($cartItem as $items): ?>
                        <?php echo form_hidden($i . '[rowid]', $items['rowid']); ?>
                        <tr>
                            <td><?php echo $items['id'] ?></td>
                            <td><?php echo $items['name'] ?></td>
                            <td><?php echo $items['clientName'] ?></td>
                            <td><?php echo $items['price'] ?></td>
                            <td><?php echo $items['qty'] ?></td>
                            <td><?php echo $this->cart->format_number($items['subtotal']) ?></td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">
                <p class="lead">Payment Methods:</p>
                <img src="<?php echo base_url(); ?>backend/image/credit/visa.png" alt="Visa">
                <img src="<?php echo base_url(); ?>backend/image/credit/mastercard.png" alt="Mastercard">
                <img src="<?php echo base_url(); ?>backend/image/credit/american-express.png" alt="American Express">
                <img src="<?php echo base_url(); ?>backend/image/credit/paypal2.png" alt="Paypal">

                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                    Please note that though Paypal can accept most major credit cards without having an account
                    with them, we are diligently working on adding other payment options in near future.
                </p>
            </div>
            <!-- /.col -->
            <div class="col-xs-6">
                <p class="lead">Amount Due: Now</p>

                <div class="table-responsive">
                    <table class="table">
                        <?php $totalAmt = $this->cart->total(); ?>
                        <?php $tax = $totalAmt * (0/100); ?>
                        <?php $shippingAmt = 0; ?>
                        <tr>
                            <th style="width:50%">Subtotal:</th>
                            <td><?php echo "$" . $this->cart->format_number($totalAmt); ?></td>
                        </tr>
                        <tr>
                            <th>Tax</th>
                            <td><?php echo "$" . $this->cart->format_number($tax); ?></td>
                        </tr>
                        <tr>
                            <th>Shipping:</th>
                            <td><?php echo "$" . $this->cart->format_number($shippingAmt); ?></td>
                        </tr>
                        <tr>
                            <th>Total:</th>
                            <td><?php echo "$" . $this->cart->format_number($totalAmt + $shippingAmt + $tax); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- ./wrapper -->

<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>backend/dist/js/app.min.js" type="text/javascript"></script>

</body>
</html>
