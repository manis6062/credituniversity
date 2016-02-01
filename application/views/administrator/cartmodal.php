<div id="shopping_cart">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Shopping Cart</h3>

            <?php if (count($items) == 0) :
            {
            ?>
            <br/><br/>
            Your shopping cart is empty.<br/>
            <a href="<?php echo base_url('administrator/line/market'); ?>">Purchase Tradelines</a>
        </div>


        <div class="box-body">
            <form method="post" action="<?php echo base_url() . 'administrator/payment/paymentPaypal'; ?>">
                <?php } else: {
                ; ?>
                <table class="table table-bordered table-striped table-hover" id="cart">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Summary</th>
                        <th>Month</th>
                        <th>Price</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($items as $item) { ?>
                        <tr>
                            <td><?php echo $item->line_id ?></td>
                            <td><?php echo $item->line ?></td>
                            <td>
                                <div class="form-group">
                                    <a href="#" id="quantity" data-type="select"
                                       data-value="<?php echo $item->quantity ?>"
                                       data-pk=<?php echo singleQuote(array('id' => $item->id, 'line_id' => $item->line_id)); ?>
                                       data-source="<?php echo '[{value:1,text:1},{value:2,text:2}, {value:3,text:3}]' ?>"
                                       data-emptytext="select no. of months"><?php echo $item->quantity ?></a>
                                </div>
                            </td>
                            <td><?php echo '$' . $item->client_broker_price ?></td>
                            <td><a href="#" id="deleteCart"
                                   onclick='deleteFromCart(<?php echo json_encode(array('id' => $item->id, 'line_id' => $item->line_id)); ?>)'><i
                                        class="fa fa-trash fa-lg"></i></a></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <?php }; ?>

                <input type="submit" value="Checkout">
                <input type="button" data-dismiss="modal" value="close">
            </form>
            <?php endif; ?>

        </div>
    </div>
</div>

<script>
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

</script>