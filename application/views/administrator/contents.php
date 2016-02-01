<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            <?php echo ucfirst($title); ?>s
            <small>list</small>
            <a class="btn btn-link"
               href="<?php echo base_url() . 'administrator/content/contentForm'; ?>">Add <?php echo ucfirst($title); ?></a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active"><?php echo $title ?>s</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <strong>Users</strong>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped" id="content">
                    <thead>
                    <tr role="row">
                        <th>Id</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($contents != 0 && count($contents) > 0) {
                        foreach ($contents as $key => $content) {
                            ?>
                            <tr role="row" class="odd">
                                <td><?php echo anchor(base_url(ADMIN_PATH . 'content/content/' . $content->content_id), $content->content_id, array('id' => 'content_id')) ?></td>
                                <td>
                                    <button type="button" class="btn-link"
                                            onclick="updateContent(<?php echo $content->content_id ?>)">
                                        <?php echo $content->content_title; ?>
                                    </button>
                                <td><?php echo $content->content_description;
                       ?></td>

                                <td>
                                    <submit type="text"
                                            onclick="deleteContent(<?php echo $content->content_id ?>)">
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
    </section>
</div>
<script>
    $('#content').dataTable();
    $('#content a:not(#content_id)').editable({
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params) {
            var table = $(this).attr("table");
            params.table = table;
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });
    function deleteContent(id) {
        var location = '<?php echo base_url(ADMIN_PATH.'content/deleteContent');?>' + '/' + id;
        window.location.href = location;
    }
    function updateContent(id) {
        var location = '<?php echo base_url(ADMIN_PATH.'content/content/');?>' + '/' + id;
        window.location.href = location;
    }
</script>







