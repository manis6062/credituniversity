<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            card types
            <small>all</small>
            <a class="btn btn-link" href="<?php echo base_url() . 'administrator/cardType/cardTypeForm'; ?>">add a card
                type</a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">card types</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-10">
                <div class="box">
                    <div class="box-body">
                        <table class="table table-bordered table-striped table-hover" id="cardTypes">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Bank</th>
                                <th>Type</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Site</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($data != 0 && count($data) > 0) {
                                foreach ($data as $key => $card) {
                                    ?>
                                    <tr role="row">
                                        <td><?php echo $card->id; ?></td>
                                        <td><a href="" data-type="text" id="bank"
                                               data-emptytext="Enter Issuer Bank"
                                               data-pk=<?php echo $card->id; ?>> <?php echo $card->bank; ?> </a>
                                        </td>
                                        <td><a href="" data-type="text" id="type"
                                               data-emptytext="enter card type"
                                               data-pk=<?php echo $card->id; ?>> <?php echo $card->type; ?> </a>
                                        </td>
                                        <td><a href="" data-type="text" id="name"
                                               data-emptytext="enter card name"
                                               data-pk=<?php echo $card->id; ?>> <?php echo $card->name; ?> </a>
                                        </td>
                                        <td><a href="" data-type="text" id="phone"
                                               data-emptytext="enter phone"
                                               data-pk=<?php echo $card->id; ?>> <?php echo $card->phone; ?> </a>
                                        </td>
                                        <td><a href="" data-type="text" id="site"
                                               data-emptytext="enter website"
                                               data-pk=<?php echo $card->id; ?>> <?php echo $card->site; ?> </a>
                                        </td>
                                        <td>
                                            <button type="button"
                                                    onclick="deleteCard(<?php echo $card->id ?>)">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                <?php }
                            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    $('#cardTypes').DataTable({
        iDisplayLength: 100
    });





    $.fn.editable.defaults.mode = 'inline';
    $('#cardTypes a').editable({
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params) {
            params.table = 'line_type';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });


    function deleteCard(id) {
        $.post("<?php echo base_url(ADMIN_PATH.'cardType/deleteCard');?>" + '/' + id)
            .done(function (data) {
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








