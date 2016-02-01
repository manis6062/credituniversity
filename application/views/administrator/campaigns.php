<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            Campaigns List
            <a class="btn btn-link" href="<?php echo base_url() . 'administrator/campaign/campaignForm'; ?>">Add a Campaign</a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('administrator') ;?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">roles</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table class="table table-bordered table-striped table-hover" id="campaigns">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Coupon Code</th>
                                <th>Type</th>
                                <th>Name</th>
                                <th>Discount Percentage</th>
                                <th>Start</th>
                                <th>End</th>
                                <th>Duration (days)</th>
                                <th>Status</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($campaigns != 0 && count($campaigns) > 0) {
                                foreach ($campaigns as $campaign) {
                                    ?>
                                    <tr role="row" class="odd">
                                        <td class="sorting_1"><?php echo $campaign->id; ?></td>
                                        <td class="sorting_1"><?php echo $campaign->coupon; ?></td>
                                        <td><a href="#" data-type="select" id="type" data-pk="<?php echo $campaign->id ?>" data-source="<?php echo $campaignTypes ?>" data-value="<?php echo $campaign->type_id ?>"><?php echo $campaign->type ?></a></td>
                                        <td><a href="" data-type="text" id="name" data-pk=<?php echo $campaign->id; ?>> <?php echo $campaign->name; ?> </a></td>
                                        <td><a href="" data-type="text" id="percentage" data-pk=<?php echo $campaign->id; ?>> <?php echo number_format($campaign->percentage, 2) . ' %'; ?> </a> </td>
                                        <td><a href="#" data-type="date" name="start" id="start" data-viewformat="yyyy-mm-dd" data-pk="<?php echo $campaign->id ?>"><?php echo $campaign->start ?></a></td>
                                        <td><a href="#" data-type="date" name="end" id="end" data-viewformat="yyyy-mm-dd" data-pk="<?php echo $campaign->id ?>"><?php echo $campaign->end ?></a></td>
                                        <td><a href="" data-type="text" id="duration" data-pk=<?php echo $campaign->id; ?>> <?php echo $campaign->duration; ?> </a></td>
                                        <td><a href="" data-type="select" id="status" data-pk=<?php echo $campaign->id; ?> data-source="<?php echo $statuses ?>" data-value="<?php echo $campaign->status_id ?>"> <?php echo $campaign->status; ?> </a></td>
                                        <td>
                                            <a href="javascript:void(0);" class="delete" id="delete" onclick="deleteCampaign(<?php echo $campaign->id ?>)"><i class="fa fa-trash fa-lg"></i></a>
                                        </td>
                                    </tr>
                                <?php }
                            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </section>
</div>
<script>
    $('#roles').DataTable();
    $.fn.editable.defaults.mode = 'inline';
    $('#campaigns a:not(#delete, #start, #end)').editable({
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params) {
            params.table = 'campaign';
            return params;
        }
    });

    $('#start*, #end*').editable({
        mode: 'popup',
        placement: 'right',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        datepicker: {
            todayBtn: 'linked'
        },
        params: function (params, newValue) {
            params.table = 'campaign';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') {
                return response.msg;
            }
        }
    });

    function deleteCampaign(id) {
        var location = '<?php echo base_url(ADMIN_PATH.'campaign/deleteCampaign');?>' + '/' + id;
        window.location.href = location;
    }
</script>








