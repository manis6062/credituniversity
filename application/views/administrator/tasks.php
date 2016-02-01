<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            <?php echo ucfirst($title);?>
            <small>list</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active"><?php echo $title?></li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body">
                <table class="table table-bordered table-striped" id="users">
                    <thead>
                    <tr role="row">
                        <th>ID</th>
                        <th>Title</th>
                        <th>Completion Date</th>
                        <th>Status</th>
                        <th>Delete</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $count = 1 ;
                    if ($task_lists != 0 && count($task_lists) > 0) {
                        foreach ($task_lists as $key => $task) {
                            $dbDate = $task->completion;
                            $convertDate = new DateTime($dbDate);
                            $standard_date =  $convertDate->format('m/d/y');
                            ?>
                            <tr <?php echo $task->status =='unread'?'style="font-weight:bold"':''?>>
                                <td><?php echo $count++; ?></td>
                                <td>
                                    <?php echo anchor(base_url(ADMIN_PATH . 'task/'.$title.'/'. $task->id), $task->task_title) ?></td>
                                <td><?php echo $standard_date; ?></td>

                                <?php if ($task->status == 'complete'){ ?>
                                    <td><?php echo $task->status; ?></td>
                             <?php } else {?>
                                <td><a href="#" data-type="select" id="status" name="status"
                                       data-pk="<?php echo $task->id ?>"
                                       data-original-title="Set Task As"
                                       data-source="[{value:'read',text:'Read'},{value:'unread',text:'Unread'} , {value:'complete',text:'Complete'} ]"><?php echo $task->status; ?></a></td> <?php } ?>
                                <td> <a href="<?php echo 'deleteTask/' . $task->id?>" ><i class="fa fa-trash-o"></i></a></td>
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
    $('#users').dataTable({
        iDisplayLength: 1000
    });


    $('#status*').editable({
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params) {
            params.table = 'task';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });

</script>








