<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            <?php echo $title; ?>s
            <small>list</small>
            <a class="btn btn-link"
               href="<?php echo base_url() . 'administrator/' . $title . '/' . $title . 'Form'; ?>">add a
                <?php echo $title ?></a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><?php echo $title ?>s</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table class="table table-bordered table-striped table-hover" id="banners">
                            <thead>
                            <tr role="row">
                                <th></th>
                                <th>Title</th>
                                <th>Background</th>
                                <th>Middle</th>
                                <th>Right</th>
                                <th>Publish</th>
                                <th>action</th>


                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($banners != 0 && count($banners) > 0) {
                                foreach ($banners as $key => $banner) {
                                    ?>
                                    <tr role="row" class="odd" data-position="<?php echo $banner->slider_index; ?>">
                                        <td><?php echo $banner->slider_index; ?></td>
                                        <td>
                                            <button type="button" class="btn-link"
                                                    onclick="updateBanner(<?php echo $banner->slider_id ?>)">
                                                <?php echo $banner->slider_name ?>
                                            </button>
                                        </td>
                                        <td><img src="<?php echo base_url(BANNER_IMAGE_PATH . $banner->path); ?>"
                                                 width="100"></td>
                                        <td><img src="<?php echo base_url(BANNER_IMAGE_PATH . $banner->mimage); ?>"
                                                 width="100"></td>
                                        <td><img src="<?php echo base_url(BANNER_IMAGE_PATH . $banner->rimage); ?>"
                                                 width="100"></td>

                                        <td><a href="" data-type="select" id="publish"
                                               data-value="<?php echo $banner->publish ?>"
                                               data-source="[ {value: 'no', text: 'No'}, {value: 'yes', text: 'Yes'}]"
                                               data-pk=<?php echo $banner->slider_id; ?>></a>
                                        </td>

                                        <td>
                                            <submit type="text"
                                                    onclick="deleteBanner(<?php echo $banner->slider_id ?>)">
                                                <i class="btn btn-danger fa fa-trash"></i>
                                            </submit>
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
    var table = $('#banners').dataTable({
        iDisplayLength: 100,
        "createdRow": function (row, data, dataIndex) {
            $(row).attr('id', 'row-' + dataIndex);
        },
        rowReorder: true
    });

    var jQuery = table.rowReordering({
        sURL: '<?php echo base_url() . 'administrator/banner/reOrder'; ?>'
    });



    $.fn.editable.defaults.mode = 'inline';
    $('#banners a').editable({
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params) {
            params.table = 'homepage_slider';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });
    function deleteBanner(id) {
        var location = '<?php echo base_url(ADMIN_PATH.'banner/deleteBanner');?>' + '/' + id;
        window.location.href = location;
    }
    function updateBanner(id) {
        var location = '<?php echo base_url(ADMIN_PATH.'banner/banner/');?>' + '/' + id;
        window.location.href = location;
    }
</script>








