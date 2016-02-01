<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            <?php echo ucfirst($title) ?>
            <small>detail</small>
            <a class="btn btn-link"
               href="<?php echo base_url() . 'administrator/task/' . $title . 's'; ?>"><?php echo $title ?>s</a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="<?php echo base_url() . 'administrator/task/' . $title . 's'; ?>"><?php echo $title ?>s</a>
            </li>
            <li class="active">detail</li>
        </ol>
    </section>

    <section class="content ">
        <div class="row">

            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo ucfirst($task->task_category); ?></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-6 ">
                                <?php echo form_label('Title : ', 'title'); ?>
                                <?php
                                $taskTitle = $task->task_title ;
                                $text = wordwrap($taskTitle, 85, "\n", true);
                                echo "$text";?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <?php echo form_label('Detail: ', 'detail'); ?>
                                <?php
                                $taskDetail = $task->task_detail ;
                                $text1 = wordwrap($taskDetail, 85, "\n", true);
                                echo "$text1";?>


                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </section>
</div>