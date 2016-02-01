<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            <?php echo ucfirst($title); ?>es
            <small>list</small>
            <a class="btn btn-link"
               href="<?php echo base_url() . 'administrator/process/processForm'; ?>">Add <?php echo ucfirst($title); ?></a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active"><?php echo $title ?>es</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <strong>Users</strong>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped" id="process">
                    <thead>
                    <tr role="row">
                        <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                            style="width: 180px;" aria-label="Rendering engine: activate to sort column ascending"
                            aria-sort="descending">Id
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                            style="width: 229px;" aria-label="Browser: activate to sort column ascending">Title
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                            style="width: 229px;" aria-label="Browser: activate to sort column ascending">Caption
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                            style="width: 194px;" aria-label="Platform(s): activate to sort column ascending">Descripton
                        </th>

                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                            style="width: 154px;" aria-label="Engine version: activate to sort column ascending">Action
                        </th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($processes != 0 && count($processes) > 0) {
                        foreach ($processes as $key => $process) {
                            ?>
                            <tr role="row" class="odd">
                                <td><?php echo anchor(base_url(ADMIN_PATH . 'process/process/' . $process->process_id), $process->process_id, array('id' => 'process_id')) ?></td>
                                <td>
                                    <button type="button" class="btn-link"
                                            onclick="updateProcess(<?php echo $process->process_id ?>)">
                                        <?php echo $process->process_title; ?>
                                    </button>
                                <td><?php echo $process->process_caption; ?></td>
                                <td>        <?php $description = $process->process_description;
                                    $length = strlen($description);
                                    if ($length > 50) $length = 50;
                                    echo substr($description, 0, $length); ?></td>

                                <td>
                                    <submit type="text"
                                            onclick="deleteProcess(<?php echo $process->process_id ?>)">
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
    $('#process').DataTable();
    $('#process a:not(#process_id)').editable({
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
    function deleteProcess(id) {
        var location = '<?php echo base_url(ADMIN_PATH.'process/deleteProcess');?>' + '/' + id;
        window.location.href = location;
    }
    function updateProcess(id) {
        var location = '<?php echo base_url(ADMIN_PATH.'process/process/');?>' + '/' + id;
        window.location.href = location;
    }
</script>







