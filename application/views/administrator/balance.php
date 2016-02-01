<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            Financial
            <small>Balance</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('administrator') ;?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Balance</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table class="table table-bordered table-striped table-hover" id="lineAssignment">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Line#</th>
                                <th>Owner</th>
                                <th>Line</th>
                                <th>Client</th>
                                <th>Verified Balance</th>
                                <th>Unverified Balance</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ((array)$lines as $key => $line) {
                                ?>
                                <tr class="item">
                                    <td><?php echo($line->id) ?></td>
                                    <td><?php echo $line->line_id; ?></td>
                                    <td><?php echo anchor('/administrator/user/user/' . $line->owner_id, $line->owner_name, array('id' => 'owner', 'data-type' => 'text')) ?></td>
                                    <td><?php echo anchor('/administrator/line/lineClientForm/' . $line->line_id, $line->line, array('id' => 'line', 'data-type' => 'text')) ?></td>
                                    <td><?php echo anchor('/administrator/user/user/' . $line->client_id, $line->client_name, array('title' => "Client Description", 'data-id' => $line->client_id, 'id' => 'client', 'data-type' => 'text')) ?></td>
                                    <td><?php
                                        if ($line->verified_broker != NULL) {
                                            echo '$' . $line->owner_price;
                                        }else{ echo '$' . 0 ;} ?></td>
                                    <td><?php
                                        if ($line->verified_broker == NULL) {
                                            echo '$' . $line->owner_price;
                                        }else{ echo '$' . 0 ;}?></td>
                                    <td><?php
                                        if ($line->owner_price != 0) {
                                            echo '$' . ($line->owner_price);
                                        }else{ echo '$' . 0 ;} ?></td>
                                </tr>

                            <?php } ?>
                            </tbody>
                            <tr>
                                <td colspan="5">Total :</td>
                                <td><?php
                                    if (($line->verified_sum) != 0) {
                                        echo '$' . ($line->verified_sum);
                                    } else{ echo '$' . 0 ;}?></td>
                                <td><?php
                                    if (($line->unverified_sum) != 0) {
                                        echo '$' . ($line->unverified_sum);
                                    } else{ echo '$' . 0 ;}?></td>
                                <td> <?php
                                    if (($line->total_sum) != 0) {
                                        echo '$' . ($line->total_sum);
                                    }else{ echo '$' . 0 ;}?> </td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>
        </div>


    </section>
</div>
<script>

    $.fn.editable.defaults.mode = 'popup';
    $('#lineAssignment').DataTable({
        iDisplayLength: 100,
        "scrollX": true,
        "sScrollY": $(window).height()
    });


</script>

<script>
    $('#popoverOption<?php echo $key?>').popover({trigger: "hover"});
</script>