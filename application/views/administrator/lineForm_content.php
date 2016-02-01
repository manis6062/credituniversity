<div class="row">
    <form action="<?php echo base_url() . 'administrator/line/addLine'; ?>" method="post"
          id="line">
        <div class="col-md-6">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Information:</h3>

                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="form-group col-md-7">
                            <label class="left">Owner:</label>
                            <?php echo form_dropdown('user_id', $owners, $this->session->userdata(USER_ID), array('class' => 'form-control select2', 'id' => 'user_id')) ?>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-8">
                            <?php echo form_label('Tradeline Type:'); ?>
                            <a style="padding-left: 5em" id="addcard" href="#">add a new type</a>
                            <?php echo form_dropdown('type_id', $banks, '', array('class' => 'form-control select2 type_id', 'id' => 'type_id')) ?>
                            <?php if (isset($website)): ?>
                                <a id="site_link" name="site_link" target="_blank" href=<?php echo $website ?>>Need to look up details? Click here to go to issuer site</a>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="control-label" for="lmt">Limit:</label>

                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-dollar"></i></div>
                                <input type="text" class="form-control" id="lmt" name="lmt"/>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label" for="balance">Balance:</label>

                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-dollar"></i></div>
                                <input type="text" class="form-control" id="balance" name="balance"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="control-label" for="open">Opened:</label>

                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                <input type="text" class="form-control" id="open" name="open" data-mask="0000" placeholder="YYYY"/>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label" for="statement">Statement</label>

                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                <input type="text" class="form-control" id="statement" name="statement" data-mask="00" placeholder="DD"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="control-label" for="price">Price:</label>

                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-dollar"></i></div>
                                <input type="text" class="form-control" id="price" name="price"/>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <?php echo form_label('maximus users:', 'max', array('class' => 'control-label'));
                            echo form_dropdown('max', getNumbers(1, 15), 0, array('class' => 'form-control select2', 'name' => 'max'))
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <?php echo form_label('activate line:', 'activate', array('class' => 'control-label'));
                            echo form_dropdown('status', array(1 => 'activate', 0 => 'activate later'), $this->session->userdata(USER_ID), array('class' => 'form-control select2'))
                            ?>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="input-group">
                                              <span class="input-group-btn">
                                                <button type="submit" class="btn btn-primary btn-flat">add</button>
                                              </span>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>