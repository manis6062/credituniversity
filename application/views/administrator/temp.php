<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            <span id="marketplace" style="cursor: pointer"><?php echo "Shopping Cart" ?></span>


        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('administrator'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url() . 'administrator/line/market?option=au_content'; ?>">Marketplace</a></li>
            <li class="active">shopping cart</li>
        </ol>
    </section>
    <section class="content col-md-8">

        <div class="box">
            <div class="box-header">
            </div>
            <div class="box-body" id="cartItemList">


                <table cellpadding="6" cellspacing="1" style="width:100%" border="0"  id="cartItemList" >

                    <tr>
                        <th>QTY</th>
                        <th>Item Description</th>
                        <th>Client</th>
                        <th>Remove</th>
                        <th style="text-align:right">Item Price</th>
                        <th style="text-align:right">Sub-Total</th>
                    </tr>

                    <?php $i = 1;

                    ?>

                    <?php foreach ($cartItem as $items): ?>

                        <?php echo form_hidden($i . '[rowid]', $items['rowid']); ?>

                        <tr>
                            <td><?php echo form_input(array('name' => $i . '[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5')); ?></td>
                            <td>
                                <?php echo $items['name']; ?>

                                <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>

                                    <p>
                                        <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>

                                            <!--                                            <strong>--><?php //echo $option_name; ?><!--:</strong> --><?php //echo $option_value; ?>
                                            <!--                                            <br/>-->

                                        <?php endforeach; ?>
                                    </p>

                                <?php endif; ?>

                            </td>
                            <td>
                                <?php echo $items['clientName']; ?></td>
                            </td>
                            <td><a href="#" onClick="return RemoveItem('<?php echo $items['rowid'] ?>')" ><span class="fa fa-trash"></span> </a></td>
                            <td style="text-align:right"><?php echo $this->cart->format_number($items['price']); ?></td>
                            <td style="text-align:right">
                                $<?php echo $this->cart->format_number($items['subtotal']); ?></td>
                        </tr>

                        <?php $i++; ?>

                    <?php endforeach; ?>
                    <?php if($cartItem):?>
                        <tr>
                            <td colspan="3"></td>
                            <td class="right" colspan="2"><strong>Total</strong></td>
                            <td style="text-align: right;">$<?php echo $this->cart->format_number($this->cart->total()); ?></td>
                        </tr>
                    <?php endif;?>
                    <tr>
                        <td><a href="<?php echo base_url(ADMIN_PATH.'payment/buyLineByBroker')?>" >checkout</a></td>
                    </tr>

                </table>

            </div>
        </div>

    </section>
</div>