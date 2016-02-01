<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
           <?php echo $title?>
            <small>Request</small>

            <a class="btn btn-link" href="<?php echo base_url() . 'administrator/line/lines'; ?>">tradelines</a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="<?php echo base_url() . 'administrator/line/lines'; ?>">tradelines</a></li>
            <li class="active">request</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-default col-md-2">
            <div class="box-header with-border">Line Details</div>
            <div class="box-body">
                <strong>Name: </strong><?php echo $line->name;?><br>
                <strong>Type: </strong><?php echo $line->type;?><br>
                <strong>Issued Bank: </strong><?php echo $line->bank;?><br>
                <strong>Limit: </strong><?php echo $line->lmt;?><br>
                <strong>Balance: </strong><?php echo $line->balance;?><br>
                <strong>Open: </strong><?php echo $line->open;?><br>
                <strong>Statement: </strong><?php echo $line->statement;?><br>
                <strong>Charge: </strong><?php echo $line->charge;?><br>
            </div>
        </div>
        <div class="row">
            <form action="<?php echo base_url() . 'administrator/line/paypalPayment'; ?>" method="post"
                  id="line">
                <div class="col-md-6">
                    <div class="box box-danger">
                        <div class="box-header">
                            <h3 class="box-title">Purchase</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group col-md-8">
                                <label class="left">No. of Month:</label>
                                <?php
                                $options = array(
                                    '3'  => '3',
                                    '6'    => '6',
                                    '9'   => '9',
                                    '12'   => '12',
                                );
                                echo form_dropdown('months', $options, '3', array('class' => 'form-control', 'id' => 'month'))
                                ?>
                            </div>
                            <div class="form-group col-md-8">
                                <label class="left">Paypal Payment Type</label>
                                <?php
                                $options = array(
                                    'recurring'  => 'Recurring',
                                    'direct'    => 'Direct',
                                );
                                echo form_dropdown('paymentmethod', $options, 'recurring', array('class' => 'form-control', 'id' => 'client_id'))
                                ?>
                                <input type="hidden" name="charge" value="<?php echo $line->charge;?>">
                                <input type="hidden" name="lineid" value="<?php echo $line->id;?>">
                                <input type="hidden" name="userid" value="<?php echo $line->user_id;?>">
                            </div>

                        </div>
                        <div class="box-footer">
                            <div class="input-group">
                                              <span class="input-group-btn">
                                                <button type="submit" class="btn btn-primary btn-flat">Purchase</button>
                                              </span>
                            </div>
                        </div>
                    </div>
                    <div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>




