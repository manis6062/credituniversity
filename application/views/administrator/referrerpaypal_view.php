<script type="text/javascript">
    function pageredirect(data, id) {
        window.location = "<?php echo base_url().'administrator/affiliate/view/';?>" + id + '#' + data;
    }
</script>
<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            TradeLines Lists
            <a class="btn btn-link" href="<?php echo base_url() . 'administrator/line/lineForm'; ?>">add a tradeline</a>
            <a class="btn btn-link" href="<?php echo base_url() . 'administrator/line/lineClientForm'; ?>">assign a tradeline</a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">lines</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-8">
                <div class="box">
                    <div class="box-body">
                        <?php echo form_open_multipart(ADMIN_PATH . 'payment/paymentPaypal');
                        ?>
                        <table class="table table-bordered table-striped table-hover">
                            <tr>
                                <td class="col1">
                                    <?php $attributes = array('class' => 'left',);
                                    echo form_label('Payment Title', 'title', $attributes);
                                    ?>
                                </td>
                                <td class="col2">
                                    <?php
                                    $data = array(
                                        'name' => 'ptitle',
                                        'id' => 'ptitle',
                                        'value' => set_value('ptitle'),
                                        'class' => 'medium'
                                        //'readonly' => 'readonly'
                                    );
                                    echo form_input($data);
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="col1">
                                    <?php $attributes = array('class' => 'left',);
                                    echo form_label('Payment Amount:', 'amount', $attributes);
                                    ?>
                                </td>
                                <td class="col2">
                                    <?php $data = array('name' => 'amount', 'id' => 'amount', 'value' => set_value('amount'), 'class' => 'medium');
                                    echo form_input($data);
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        &nbsp;</label>
                                </td>
                                <td>
                                    <?php $data = array('name' => 'submit', 'id' => 'submit', 'value' => 'Process', 'class' => 'btn btn-navy',);
                                    echo form_submit($data);
                                    $data = array('name' => 'reset', 'id' => 'reset', 'value' => 'Clear', 'class' => 'btn btn-grey',);
                                    echo form_reset($data);
                                    ?>
                                </td>
                            </tr>
                        </table>
                        <?php
                        echo form_close();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
