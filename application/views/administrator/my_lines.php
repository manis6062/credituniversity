<div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
    <section class="content-header">
        <h1>
            My TradeLines
            <a class="btn btn-link" href="<?php echo base_url() . 'administrator/line/lineForm'; ?>">add a tradeline</a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('administrator'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">lines</li>
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
                                <th>Tradline Summary</th>
                                <th>Delete</th>
                                <th>Open</th>
                                <th>Statement</th>
                                <th>Limit</th>
                                <th>Balance</th>
                                <th>Price</th>

                                <th>Used</th>
                                <th>Max User</th>
                                <th>Status</th>
                                <th>Note</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($lines as $line) { ?>
                                <tr class="item">
                                    <td><?php echo $line->id; ?></td>
                                    <td><?php echo $line->line ?></td>
                                    <td><a href="#" id="delete" onclick="deleteLine(<?php echo $line->id ?>)" data="<?php echo singleQuote(array('id' => $line->id)) ?>"><span class="glyphicon glyphicon-trash"></span></a></td>
                                    <td><?php echo anchor('#', $line->open, array('id' => 'open', 'data-type' => 'text', 'data-pk' => $line->id)) ?></td>
                                    <td><?php echo anchor('#', $line->statement, array('id' => 'statement', 'data-type' => 'text', 'data-pk' => $line->id)) ?></td>
                                    <td><?php echo anchor('#', '$' . number_format($line->lmt), array('id' => 'lmt', 'data-type' => 'text', 'data-pk' => $line->id)) ?></td>
                                    <td><?php echo anchor('#', '$' . number_format($line->balance), array('id' => 'balance', 'data-type' => 'text', 'data-pk' => $line->id)) ?></td>
                                    <td><?php echo anchor('#', '$' . number_format($line->price), array('id' => 'price', 'data-type' => 'text', 'data-pk' => $line->id)) ?></td>
                                    <td><?php echo $line->used ?></td>
                                    <td><a href="" data-type="select" id="max" data-value="<?php echo $line->max ?>" data-pk="<?php echo $line->id; ?>"
                                           data-source="[ {value: 0, text: '0'}, {value: 1, text: '1'} , {value: 2, text: '2'}, {value: 3, text: '3'},{value: 4, text: '4'}, {value: 5, text: '5'}, {value: 6, text: '6'}, {value: 7, text: '7'}, {value: 8, text: '8'}, {value: 9, text: '9'}, {value: 10, text: '10'}, {value: 11, text: '11'}, {value: 12, text: '12'}, {value: 13, text: '13'}, {value: 14, text: '14'}, {value: 15, text: '15'}]"></a></td>
                                    <td><a href="" data-type="select" id="status" data-value="<?php echo $line->status ?>" data-pk="<?php echo $line->id; ?>" data-source="[ {value: 0, text: 'Inactive'}, {value: 1, text: 'Active'}]"></a></td>
                                    <td><?php echo anchor('#', $line->note, array('id' => 'note', 'data-type' => 'text', 'data-pk' => $line->id)) ?></td>
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

    $('#lines a:not(#line, #open, #statement, #delete)').editable({
        placement: 'right',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params) {
            params.table = 'line';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });
    $('#open*').editable({
        placement: 'right',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        tpl: '<input type="text" class="year" placeholder="YYYY">',
        params: function (params) {
            params.table = 'line';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });
    $('#statement*').editable({
        placement: 'right',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        tpl: '<input type="text" class="day" placeholder="DD">',
        params: function (params) {
            params.table = 'line';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });

    $(document).on("focus", ".year", function () {
        $(this).mask("0000");
    });
    $(document).on("focus", ".day", function () {
        $(this).mask("00");
    });

    function deleteLine(id) {
        $.post("<?php echo base_url() . 'administrator/line/deleteLine'; ?>", {id: id})
            .success(function (data) {
                try {
                    var data1 = $.parseJSON(data);
                    if (data1.message) {
                        $("#baseModal2").modal().find('.modal-body').text(data1.message).show();
                    } else {
                        location.reload();
                    }
                } catch (e) {
                    location.reload();
                }
            });
    }

</script>