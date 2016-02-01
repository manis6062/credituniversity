<div class="content-wrapper bg-main">
    <?php $role = $this->session->userdata(ROLE_NAME); ?>
    <section class="content-header">
        <h1>
            Purchased

        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">purchase</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table class="table table-bordered table-striped table-hover" id="lines">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Summary</th>
                                <th>Purchased Date</th>
                                <?php if ($role != CLIENT): ?>
                                    <th>Client</th>
                                <?php endif ?>
                                <th>Cost</th>
                                <?php if ($role != CLIENT): ?>
                                    <th>Sell</th>
                                <?php endif ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($purchase as $purchase) { ?>
                                <tr class="item">
                                    <td><?php echo $purchase->id; ?></td>
                                    <td><?php echo $purchase->line; ?></td>
                                    <td><?php echo $purchase->requested; ?></td>
                                    <?php if ($role != CLIENT): ?>
                                        <td><?php echo $this->session->userdata(NAME); ?></td>
                                    <?php endif ?>
                                    <td><?php echo $purchase->client_broker_price; ?></td>
                                    <?php if ($role != CLIENT): ?>
                                        <td><?php echo '$' . number_format($purchase->client_broker_price) ?></td>
                                    <?php endif ?>
                                    <?php if ($role == BROKER): ?>
                                        <td><?php echo '$' . number_format($purchase->broker_price) ?></td>
                                        <td><a href="#" id="client_broker_price" data-type="text"
                                               data-pk=<?php echo $purchase->id ?>><?php echo '$' . number_format($purchase->client_broker_price) ?></a>
                                        </td>
                                    <?php endif ?>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
<script>
    var table = $('#lines').dataTable({
        iDisplayLength: 100,
        "scrollX": true,
        responsive: false
    });
    table.fnAdjustColumnSizing();
</script>
