<div class="content-wrapper bg23">
    <section class="content-header">
        <h1>
            Registration Options
        </h1>
    </section>
    <section class="content">
        <form action="<?php echo base_url() . 'member/registrationPay/' . $userId . '/' . $campaignId ?>" method="post" id="charge">
            <div class="row col-md-6">
                <div class="box box-info">
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-8">
                                <div class="input-group">
                                    <?php echo form_dropdown('membershipType', $items, 'monthly_recurring') ?>
                                </div>
                            </div>

                        </div>
                        <div class="box-footer">
                            <div class="input-group">
                                              <span class="input-group-btn">
                                                <button type="submit" class="btn btn-info btn-flat">Pay</button>
                                              </span>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </section>
</div>
