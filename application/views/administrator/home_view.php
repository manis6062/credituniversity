<?php
$blob_length = strlen($this->session->userdata(PROFILE_PIC));
$profilePicture = $this->session->userdata(PROFILE_PIC);
$imageUrl = base_url() . 'uploads/profile/' . $profilePicture;
if (!($profilePicture && profileImageExists($imageUrl))) {
    $imageUrl = base_url() . 'uploads/profile/empty_profile.jpg';
}
?>

<style>

    .toggle {
        float: right;
    }

    .datepicker table tr td.old, .datepicker table tr td.new {
        color: lightsteelblue;
    }

    div.bg-profile {
        background-image: url(<?php echo $imageUrl ;?>);
        background-repeat: no-repeat;
        background-size: 100% 100%;
    }

    .small-box > .small-box-footer {
        text-align: left;
    }

    .slow .toggle-group {
        transition: left 0.7s;
        -webkit-transition: left 0.7s;
    }


</style>
<div class="content-wrapper bg28">
    <section class="content-header">
        <h1 style="color: white;">
            Dashboard
            <small style="color: white;">Control panel</small>
        </h1>
        <br/>

        <?php if ((in_array(role(), array(CLIENT, OWNER, BROKER)))) : ?>
            <ul class="legend">
                <li><span class="blue"></span>Blue Membership</li>
                <li><span class="red"></span>Red Membership</li>
                <li><span class="platinum"></span>Platinum Membership</li>
            </ul>
        <?php endif; ?>


        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('administrator'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
    <section class="content">

        <div class="row">

            <?php if ((in_array(role(), array(BROKER)))) : ?>
                <div class="col-lg-3 col-xs-6"
                     onclick="document.location='<?php echo base_url() . 'administrator/user/showUsersByRole' . '/' . 'client'; ?>'"
                     style="cursor:pointer">
                    <div class="small-box blue">
                        <div class="inner bg-clients hover">
                            <h3>&nbsp;</h3>

                            <p>&nbsp;</p>
                        </div>
                        <p class="small-box-footer">
                            <strong>Clients</strong>
                        </p>
                    </div>
                </div>
            <?php endif ?>

            <?php if ((in_array(role(), array(OWNER)))) : ?>
                <div class="col-lg-3 col-xs-6"
                     onclick="document.location='<?php echo base_url() . 'administrator/line/lineAssignment'; ?>'"
                     style="cursor:pointer">
                    <div class="small-box blue">
                        <div class="inner bg-clients hover">
                            <h3>&nbsp;</h3>

                            <p>&nbsp;</p>
                        </div>
                        <p class="small-box-footer">
                            <strong>Active Clients</strong>
                        </p>
                    </div>
                </div>
            <?php endif ?>

            <?php if ((in_array(role(), array(BROKER)))) : ?>
                <div class="col-lg-3 col-xs-6"
                     onclick="document.location='<?php echo base_url() . 'administrator/user/showUsersByRole' . '/' . 'broker'; ?>'"
                     style="cursor:pointer" id="funding">
                    <div class="small-box blue">
                        <div class="inner bg-brokers hover">
                            <h3>&nbsp;</h3>

                            <p>&nbsp;</p>
                        </div>
                        <p class="small-box-footer">
                            <strong>&nbsp;Brokers</strong></p>
                    </div>
                </div>

            <?php endif ?>

            <!-----------Prospects--------------------->
            <?php if (in_array(role(), array(BROKER))) : ?>
                <?php if (array_intersect($membership, array(BROKER_PLATINUM))) { ?>
                    <div class="col-lg-3 col-xs-6"
                        onclick="document.location='<?php echo base_url() . 'administrator/prospect/'; ?>'" style="cursor:pointer;">
                        <div class="small-box red">
                            <div class="inner bg-prospects hover">
                                        <h3>&nbsp;</h3> <p>&nbsp;</p>


                            </div>

                            <p class="small-box-footer">
                                <strong>&nbsp;Prospects</strong></p>
                        </div>
                    </div>


                <?php } else { ?>
                <div class="col-lg-3 col-xs-6"
                     onclick="document.location='<?php echo base_url() . 'administrator/prospect/'; ?>'" style="cursor:pointer;  opacity: 0.3;">
                    <div class="small-box red">
                        <div class="inner bg-prospects hover">
                            <div class="inner bg-upgrade">
                                <a href="<?php echo site_url(ADMIN_PATH . 'user/membershipUpgrade/' . $this->session->userdata(USER_ID)); ?>">
                                    <h3>&nbsp;</h3> <p>&nbsp;</p> </a>


                            </div>
                        </div>

                        <p class="small-box-footer">
                            <strong>&nbsp;Prospects</strong></p>
                    </div>
                </div>

                    <?php } ?>

            <?php endif; ?>

            <!-----------Credit Status--------------------->
            <?php if ((in_array(role(), array(CLIENT, ADMIN)))): ?>
                <div class="col-lg-3 col-xs-6"
                     onclick="document.location='<?php echo base_url() . 'administrator/creditStatus/creditStatus/' . $user_id . '?option=descript'; ?>'"
                     style="cursor:pointer">
                    <div class="small-box blue">
                        <div class="inner bg-cs">
                            <h3>&nbsp;</h3>

                            <p>&nbsp;</p>
                        </div>
                        <p class="small-box-footer"><strong>Credit
                                Status</strong></p>
                    </div>
                </div>
            <?php endif; ?>


            <!-----------Financial Tools------------------->
            <?php if ((in_array(role(), array(BROKER))))  : ?>
                <?php if (array_intersect($membership, array(BROKER_PLATINUM))) { ?>
                <div class="col-lg-3 col-xs-6"
                        onclick="document.location='<?php echo base_url() . 'administrator/financialTools'; ?>'"
                        style="cursor:pointer" >
                    <div class="small-box red">
                        <div class="inner bg-financial">
                                    <h3>&nbsp;</h3> <p>&nbsp;</p>



                        </div>
                        <p class="small-box-footer"><strong>
                                Financial
                                Tools</strong></p>
                    </div>
                </div>
                    <?php } else { ?>
            <div class="col-lg-3 col-xs-6"
                        onclick="document.location='#'"
                        style="cursor:pointer; opacity: 0.3;">

                <div class="small-box red">
                    <div class="inner bg-financial">
                        <div class="inner bg-upgrade">
                            <a href="<?php echo site_url(ADMIN_PATH . 'user/membershipUpgrade/' . $this->session->userdata(USER_ID)); ?>">
                                <h3>&nbsp;</h3> <p>&nbsp;</p> </a>


                        </div>

                    </div>
                    <p class="small-box-footer"><strong>
                            Financial
                            Tools</strong></p>
                </div>


                        </div>
                <?php } ?>

            <?php endif ?>


            <!-----------Tradelines Marketplace--------------------->
            <?php if ((in_array(role(), array(BROKER, CLIENT, ADMIN)))) : ?>

            <div class="col-lg-3 col-xs-6" id="marketplace"
                <?php if (array_intersect($membership, array(BROKER_PLATINUM, BROKER_GOLD, BROKER_SILVER, CLIENT_PLATINUM, CLIENT_GOLD, CLIENT_SILVER))) { ?>
                    onclick="document.location='<?php echo base_url() . 'administrator/line/market?option=descript'; ?>'"
                    style="cursor:pointer"
                <?php } else { ?>
                    onclick="document.location='#'"
                    style="cursor:pointer; opacity: 0.3;"
                <?php } ?> >
                <?php if (role() == BROKER) { ?>
                <div class="small-box platinum">
                    <?php } else { ?>
                    <div class="small-box blue">
                        <?php } ?>
                        <div class="inner bg-market">
                                    <h3>&nbsp;</h3>

                                    <p>&nbsp;</p>

                        </div>
                        <p class="small-box-footer">
                            <strong>
                                &nbsp; Tradelines Marketplace</strong></p>
                    </div>
                </div>
                <?php endif; ?>


                <!-----------Real Estate--------------------->

                <?php if ((in_array(role(), array(CLIENT, ADMIN)))) : ?>
                        <?php if (array_intersect($membership, array(CLIENT_PLATINUM, CLIENT_GOLD))) { ?>
                        <div class="col-lg-3 col-xs-6" id="realEstate" onclick="document.location='<?php echo base_url() . 'administrator/realEstate?option=descript' ?>'"
                            style="cursor:pointer" >
                            <div class="small-box red">
                                <div class="inner bg-real">

                                            <h3>&nbsp;</h3> <p>&nbsp;</p>

                                </div>
                                <p class="small-box-footer"><strong> Real
                                        Estate</strong></p>
                            </div>



                        </div>
                        <?php } else { ?>
                            <div class="col-lg-3 col-xs-6" id="realEstate" onclick="document.location='#'"
                                 style="cursor:pointer; opacity: 0.3;" >
                                <div class="small-box red">
                                    <div class="inner bg-real">
                                        <div class="inner bg-upgrade">
                                            <a href="<?php echo site_url(ADMIN_PATH . 'user/membershipUpgrade/' . $this->session->userdata(USER_ID)); ?>">
                                                <h3>&nbsp;</h3> <p>&nbsp;</p> </a>
                                        </div>
                                    </div>
                                    <p class="small-box-footer"><strong> Real
                                            Estate</strong></p>
                                </div>
                            </div>
                        <?php } ?>
                <?php endif ?>


                <!-----------Vehicle Financing--------------------->
                <?php if (in_array(role(), array(CLIENT, ADMIN))) : ?>

                    <?php if (array_intersect($membership, array(CLIENT_PLATINUM, CLIENT_GOLD))) { ?>
                    <div class="col-lg-3 col-xs-6"
                            onclick="document.location='<?php echo base_url() . 'administrator/vehicleFinancing?option=descript' ?>'"
                            style="cursor:pointer; ">
                        <div class="small-box red">
                            <div class="inner bg-vf">
                                        <h3>&nbsp;</h3> <p>&nbsp;</p>

                            </div>

                            <p class="small-box-footer">
                                <strong>&nbsp;Vehicle Financing</strong></p>
                        </div>
                        </div>
                        <?php } else { ?>
                        <div class="col-lg-3 col-xs-6"      onclick="document.location='#'"
                            style="cursor:pointer; opacity: 0.3;">
                        <div class="small-box red">
                            <div class="inner bg-vf">
                                <div class="inner bg-upgrade">
                                    <a href="<?php echo site_url(ADMIN_PATH . 'user/membershipUpgrade/' . $this->session->userdata(USER_ID)); ?>">
                                        <h3>&nbsp;</h3> <p>&nbsp;</p> </a>


                                </div>
                            </div>

                            <p class="small-box-footer">
                                <strong>&nbsp;Vehicle Financing</strong></p>
                        </div>
                            </div>
                        <?php } ?>
                <?php endif ?>


                <!----------Funding------------------>
                <?php if (in_array(role(), array(CLIENT, ADMIN))): ?>
                    <?php if (array_intersect($membership, array(CLIENT_PLATINUM))) { ?>
                    <div class="col-lg-3 col-xs-6" id="funding"
                            onclick="document.location='<?php echo base_url() . 'administrator/funding?option=descript' ?>'"
                            style="cursor:pointer">
                        <div class="small-box platinum">
                            <div class="inner bg-funding">
                                        <h3>&nbsp;</h3> <p>&nbsp;</p>

                            </div>
                            <p class="small-box-footer">
                                <strong>Funding</strong>
                            </p>
                        </div>
                        </div>
                        <?php } else { ?>
                        <div class="col-lg-3 col-xs-6" id="funding"   onclick="document.location='#'"
                            style="cursor:pointer; opacity: 0.3;" >
                        <div class="small-box platinum">
                            <div class="inner bg-funding">
                                <div class="inner bg-upgrade">
                                    <a href="<?php echo site_url(ADMIN_PATH . 'user/membershipUpgrade/' . $this->session->userdata(USER_ID)); ?>">
                                        <h3>&nbsp;</h3> <p>&nbsp;</p> </a>
                                </div>
                            </div>
                            <p class="small-box-footer">
                                <strong>Funding</strong>
                            </p>
                        </div>
                        </div>
                        <?php } ?>
                <?php endif ?>


                <!----------Monthly Tips----------------->
                <?php if (in_array(role(), array(CLIENT, BROKER, ADMIN))): ?>
                    <?php if (array_intersect($membership, array(BROKER_PLATINUM, CLIENT_PLATINUM))) { ?>
                    <div class="col-lg-3 col-xs-6" id="monthlyTips"
                            onclick="document.location='<?php echo base_url() . 'administrator/content/monthlyTipsOnly/monthly_tips' ?>'"
                            style="cursor:pointer">
                        <div class="small-box platinum">
                            <div class="inner bg-mt">
                                        <h3>&nbsp;</h3> <p>&nbsp;</p>


                            </div>
                            <p class="small-box-footer">
                                <strong>Monthly Tips</strong>
                            </p>
                        </div>
                        </div>
                        <?php } else { ?>
                        <div class="col-lg-3 col-xs-6" id="monthlyTips"
                             onclick="document.location='#'"
                            style="cursor:pointer; opacity:0.3;" >
                            <div class="small-box platinum">
                                <div class="inner bg-mt">
                                    <div class="inner bg-upgrade">
                                        <a href="<?php echo site_url(ADMIN_PATH . 'user/membershipUpgrade/' . $this->session->userdata(USER_ID)); ?>">
                                            <h3>&nbsp;</h3> <p>&nbsp;</p> </a>


                                    </div>
                                </div>
                                <p class="small-box-footer">
                                    <strong>Monthly Tips</strong>
                                </p>
                            </div>




                            </div>
                        <?php } ?>

                <?php endif; ?>


                <!---------PDF Books----------------->
                <?php if (in_array(role(), array(CLIENT, BROKER, ADMIN))): ?>
                    <?php if (array_intersect($membership, array(BROKER_PLATINUM, CLIENT_PLATINUM))) { ?>

                    <div class="col-lg-3 col-xs-6" id="pdfBooks"
                            onclick="document.location='<?php echo base_url() . 'administrator/content/pdfContentsOnly/pdf' ?>'"
                            style="cursor:pointer" >
                        <div class="small-box platinum">
                            <div class="inner bg-pb hover">
                                        <h3>&nbsp;</h3> <p>&nbsp;</p>

                            </div>
                            <p class="small-box-footer"
                               style="color: black;background:#E5E4E2">
                                <strong>PDF
                                    Books</strong></p>
                        </div>
                    </div>
                        <?php } else { ?>
                        <div class="col-lg-3 col-xs-6" id="pdfBooks"   onclick="document.location='#'"
                            style="cursor:pointer; opacity: 0.3;" >

                            <div class="small-box platinum">
                                <div class="inner bg-pb hover">
                                    <div class="inner bg-upgrade">
                                        <a href="<?php echo site_url(ADMIN_PATH . 'user/membershipUpgrade/' . $this->session->userdata(USER_ID)); ?>">
                                            <h3>&nbsp;</h3> <p>&nbsp;</p> </a>


                                    </div>
                                </div>
                                <p class="small-box-footer"
                                   style="color: black;background:#E5E4E2">
                                    <strong>PDF
                                        Books</strong></p>
                            </div>

                            </div>
                        <?php } ?>

                <?php endif; ?>


                <!-------Transactions---------------->
                <?php if ((in_array(role(), array(BROKER))))  : ?>


                        <?php if (array_intersect($membership, array(BROKER_PLATINUM))) { ?>
                        <div class="col-lg-3 col-xs-6" id="pdfBooks"     onclick="document.location='<?php echo base_url() . 'administrator/line/balance' ?>'"
                            style="cursor:pointer">
                            <div class="small-box platinum">
                                <div class="inner bg-transactions hover">
                                            <h3>&nbsp;</h3> <p>&nbsp;</p>



                                </div>
                                <p class="small-box-footer">
                                    <strong>
                                        Transactions</strong>
                                </p>
                            </div>
                        </div>
                        <?php } else { ?>
                        <div class="col-lg-3 col-xs-6" id="pdfBooks"       onclick="document.location='#'"
                            style="cursor:pointer; opacity: 0.3;">
                            <div class="small-box platinum">
                                <div class="inner bg-transactions hover">
                                    <div class="inner bg-upgrade">
                                        <a href="<?php echo site_url(ADMIN_PATH . 'user/membershipUpgrade/' . $this->session->userdata(USER_ID)); ?>">
                                            <h3>&nbsp;</h3> <p>&nbsp;</p> </a>


                                    </div>
                                </div>
                                <p class="small-box-footer">
                                    <strong>
                                        Transactions</strong>
                                </p>
                            </div>


                            </div>
                        <?php } ?>


                <?php endif; ?>


                <!-----------Business Credit------------------->
                <?php if ((in_array(role(), array(CLIENT, ADMIN))))  : ?>
                    <?php if (array_intersect($membership, array(CLIENT_PLATINUM))) { ?>
                    <div class="col-lg-3 col-xs-6"  onclick="document.location='#'"
                        style="cursor:pointer; opacity: 0.3;" >
                        <div class="small-box platinum">
                            <div class="inner bg-bc">
                                <div class="bg-soon">
                                    <h3>
                                        &nbsp;</h3>

                                    <p>
                                        &nbsp;</p>
                                </div>
                            </div>
                            <p class="small-box-footer">
                                <strong> Business Credit</strong>
                            </p>
                        </div>
                    </div>

                        <?php } else { ?>
                        <div class="col-lg-3 col-xs-6"  onclick="document.location='#'"
                             style="cursor:pointer;" >
                            <div class="small-box platinum">
                                <div class="inner bg-bc">
                                    <div class="bg-soon">
                                        <h3>
                                            &nbsp;</h3>

                                        <p>
                                            &nbsp;</p>
                                    </div>
                                </div>
                                <p class="small-box-footer">
                                    <strong> Business Credit</strong>
                                </p>
                            </div>
                        </div>

                        <?php } ?>



                <?php endif ?>
            </div>

            <div class="row">
                <section
                    class="col-lg-7 connectedSortable">
                    <?php if (in_array(role(), array(CLIENT, BROKER, ADMIN))): ?>
                        <div
                            class="box box-primary">
                            <div
                                class="box-header">
                                <i class="ion ion-clipboard"></i>

                                <h3 class="box-title">
                                    To
                                    Do
                                    List </h3>

                                <div
                                    id="message">
                                    <div
                                        class="alert fade in"
                                        style="display:none;"
                                        role="alert">
                                                                                                                    <span
                                                                                                                        class="message"></span>
                                    </div>
                                </div>

                                <div
                                    class="btn-group  pull-right"
                                    data-toggle="btn-toggle">

                                    <input
                                        id="toggle-todo"
                                        data-on="Incomplete"
                                        data-off="Complete"
                                        data-toggle="toggle"
                                        type="checkbox"
                                        checked>
                                </div>

                            </div>

                            <script>
                                $(function () {
                                    $('#toggle-todo').bootstrapToggle();
                                })
                            </script>

                            <script>
                                $(function () {
                                    $('#toggle-todo').change(function () {
                                        if ($(this).prop('checked')) {
                                            $('#todo_complete').css('display', 'none');
                                            $('#todo_incomplete').css('display', 'block');
                                        }
                                        ;

                                        if ($(this).prop('checked') == false) {
                                            $('#todo_complete').css('display', 'block');
                                            $('#todo_incomplete').css('display', 'none');
                                        }

                                    })
                                });


                            </script>

                            <div
                                class="box-body">

                                <ul class="todo-list"
                                    id='todo_incomplete'>

                                    <?php foreach ($uncompleted_tasks as $key => $task) { ?>
                                        <li style="font-size: 12px; ">
                                            <?php
                                            /*
                                             * Provide sharing option if the role of the user is broker
                                             */
                                            if ($this->session->userdata(ROLE_NAME) == 'broker'): ?>
                                                <select
                                                    id="multi<?php echo $key; ?>"
                                                    data-task-id="<?php echo $task->id; ?>"
                                                    data-task-name="<?php echo $task->task_title; ?>"
                                                    class="share-todo"
                                                    multiple="multiple"
                                                    name="share_todo[]"
                                                    >
                                                    <?php
                                                    /*
                                                    * List of the system users of broker
                                                    */
                                                    if (count($shareUsers)): ?>

                                                        <?php foreach ($shareUsers as $systemUserId => $systemUser) : ?>
                                                            <option
                                                                value="<?php echo $systemUserId ?>" <?php echo($task->user_id == $systemUserId ? 'disabled' : ''); ?> ><?php echo $systemUser; ?>
                                                            </option>
                                                        <?php endforeach; ?>

                                                    <?php endif; ?>

                                                </select>
                                            <?php endif; ?>

                                            <?php if ($task->view == 'unread') { ?>
                                                <div
                                                    style="font-weight: bold; font-size: 14px;"
                                                    class="<?php echo($this->session->userdata(ROLE_NAME) == 'broker' ? 'to-do-list-elememt' : ''); ?>">

                                                    <?php
                                                    $dbDate = $task->completion;
                                                    $convertDate = new DateTime($dbDate);
                                                    $standard_date = $convertDate->format('m/d/y');
                                                    ?>
                                                    <input
                                                        type="checkbox"
                                                        value="<?php echo $task->id; ?>"
                                                        id="checkbox<?php echo $key; ?>"/>


                                                    <?php if ($task->task_category == 'goal') { ?>

                                                        <?php
                                                        if ($task->user_id == $this->session->userdata(USER_ID)) {
                                                            ?>

                                                            <span
                                                                class="text"><a
                                                                    href="#"
                                                                    id="task_title"
                                                                    name="task_title"
                                                                    data-type="text"
                                                                    data-pk="<?php echo $task->id ?>"><?php echo $task->task_title ?></a></span>

                                                        <?php } else { ?>

                                                            <span
                                                                class="text">   <?php echo $task->task_title ?></span>
                                                        <?php } ?>
                                                        <?php if ($task->user_id == $this->session->userdata(USER_ID)) { ?>

                                                            <span
                                                                class="text"><a
                                                                    href="#"
                                                                    data-type="date"
                                                                    class="<?php echo (new DateTime() > date_create($task->completion)) ? 'red' : '' ?>"
                                                                    name="completion"
                                                                    id="completion"
                                                                    data-viewformat="yyyy-mm-dd"
                                                                    data-pk="<?php echo $task->id ?>"><?php echo $standard_date ?>
                                                                    &nbsp;<i
                                                                        class="fa fa-clock-o"></i></a> - <a
                                                                    href="<?php echo base_url('administrator') . '/' . 'task/task/' . $task->id ?>"
                                                                    style="font-family: Ionicons ; font-size: 11px; color: green"
                                                                    href="">Read
                                                                    More</a>  </span>

                                                        <?php } else { ?>

                                                            <span
                                                                class="text"
                                                                data-viewformat="yyyy-mm-dd"
                                                                data-pk="<?php echo $task->id ?>"><?php echo $standard_date ?>
                                                                &nbsp;<i
                                                                    class="fa fa-clock-o"></i> - <a
                                                                    href="<?php echo base_url('administrator') . '/' . 'task/task/' . $task->id ?>"
                                                                    style="font-family: Ionicons ; font-size: 11px; color: green"
                                                                    href="">Read
                                                                    More</a> </span>

                                                        <?php } ?>


                                                        <span>Created By : <?php echo $task->creator; ?> </span>

                                                        <?php if ($task->user_id == $this->session->userdata(USER_ID)) : ?>
                                                            <div
                                                                class="tools">
                                                                <a href="<?php echo base_url('administrator') . '/' . 'task/deleteTask/' . $task->id; ?> "><i
                                                                        class="fa fa-trash-o"></i></a>
                                                            </div>
                                                        <?php endif; ?>


                                                    <?php } else { ?>

                                                        <span
                                                            class="text"><?php echo $task->task_title ?> </span>


                                                        <?php if ($task->user_id == $this->session->userdata(USER_ID)) { ?>


                                                            <span
                                                                class="text <?php echo (new DateTime() > date_create($task->completion)) ? 'red' : '' ?>"><?php echo $task->completion ?>
                                                                &nbsp;<i
                                                                    class="fa fa-clock-o"></i></span>

                                                            <?php
                                                        } else {
                                                            ?>
                                                            <span><?php echo $task->completion ?></span>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </div>

                                            <?php } elseif (($task->view == 'read')) { ?>

                                                <div
                                                    class="<?php echo($this->session->userdata(ROLE_NAME) == 'broker' ? 'to-do-list-elememt' : ''); ?>">
                                                    <?php
                                                    $dbDate = $task->completion;
                                                    $convertDate = new DateTime($dbDate);
                                                    $standard_date = $convertDate->format('m/d/y');
                                                    ?>

                                                    <input
                                                        type="checkbox"
                                                        value="<?php echo $task->id; ?>"
                                                        id="checkboxs<?php echo $key; ?>"/>
                                                    <?php if ($task->task_category == 'goal') { ?>


                                                        <?php
                                                        if ($task->user_id == $this->session->userdata(USER_ID)) {
                                                            ?>

                                                            <span
                                                                class="text"><a
                                                                    href="#"
                                                                    id="task_title"
                                                                    name="task_title"
                                                                    data-type="text"
                                                                    data-pk="<?php echo $task->id ?>"><?php echo $task->task_title ?></a></span>

                                                        <?php } else { ?>

                                                            <span
                                                                class="text">   <?php echo $task->task_title ?></span>
                                                        <?php } ?>

                                                        <?php if ($task->user_id == $this->session->userdata(USER_ID)) { ?>

                                                            <span
                                                                class="text"><a
                                                                    href="#"
                                                                    data-type="date"
                                                                    class="<?php echo (new DateTime() > date_create($task->completion)) ? 'red' : '' ?>"
                                                                    name="completion"
                                                                    id="completion"
                                                                    data-viewformat="yyyy-mm-dd"
                                                                    data-pk="<?php echo $task->id ?>"><?php echo $standard_date ?>
                                                                    &nbsp;<i
                                                                        class="fa fa-clock-o"></i></a> - <a
                                                                    href="<?php echo base_url('administrator') . '/' . 'task/task/' . $task->id ?>"
                                                                    style="font-family: Ionicons ; font-size: 11px; color: green"
                                                                    href="">Read
                                                                    More</a>  </span>


                                                        <?php } else { ?>

                                                            <span
                                                                class="text"
                                                                class="red"
                                                                data-viewformat="yyyy-mm-dd">
                                                                                                            <?php echo $standard_date ?>
                                                                &nbsp;<i
                                                                    class="fa fa-clock-o"></i> - <a
                                                                    href="<?php echo base_url('administrator') . '/' . 'task/task/' . $task->id ?>"
                                                                    style="font-family: Ionicons ; font-size: 11px; color: green"
                                                                    href="">Read
                                                                    More</a>  </span>

                                                        <?php } ?>

                                                        <span>Created By : <?php echo $task->creator; ?></span>
                                                        <?php if ($task->user_id == $this->session->userdata(USER_ID)) { ?>
                                                            <div
                                                                class="tools">
                                                                <a href="<?php echo base_url('administrator') . '/' . 'task/deleteTask/' . $task->id; ?> "><i
                                                                        class="fa fa-trash-o"></i></a>
                                                            </div>
                                                        <?php } ?>


                                                    <?php } else { ?>
                                                        <span
                                                            class="text"><?php echo $task->task_title ?> </span>

                                                        <span
                                                            class="text <?php echo (new DateTime() > date_create($task->completion)) ? 'red' : '' ?>"><?php echo $task->completion ?>
                                                            &nbsp;<i
                                                                class="fa fa-clock-o"></i></span>
                                                    <?php } ?>
                                                </div>
                                                <?php
                                            } ?>
                                            <div
                                                class="clearfix"></div>
                                        </li>
                                    <?php } ?>

                                </ul>

                                <ul class="todo-list done"
                                    id='todo_complete'
                                    style="display: none;">

                                    <?php
                                    foreach ($completed_tasks as $key => $task) {
                                        ?>
                                        <li class="done">

                                            <?php
                                            $dbDate = $task->completion;
                                            $convertDate = new DateTime($dbDate);
                                            $standard_date = $convertDate->format('m/d/y');
                                            ?>

                                            <input
                                                type="checkbox"
                                                value="<?php echo $task->id; ?>"
                                                name=""
                                                id="checkbox_com<?php echo $key ?>"
                                                checked="checked"/>

                                            <?php if ($task->user_id == $this->session->userdata(USER_ID)) { ?>

                                                <?php if ($task->task_category == 'goal') { ?>
                                                    <span
                                                        class="text"><a
                                                            href="#"
                                                            id="task_title"
                                                            name="task_title"
                                                            data-type="text"
                                                            data-pk="<?php echo $task->id ?>"><?php echo $task->task_title ?></a></span>

                                                <?php } else { ?>
                                                    <span
                                                        class="text"><?php echo $task->task_title ?></span>

                                                <?php } ?>
                                                <a
                                                    href="<?php echo base_url('administrator') . '/' . 'task/task/' . $task->id ?>"
                                                    style="font-family: Ionicons ; font-size: 11px; color: green"
                                                    href="">Read
                                                    More</a>

                                                <span>Created By : <?php echo $task->creator; ?></span>

                                                <?php if ($task->user_id == $this->session->userdata(USER_ID)) { ?>
                                                    <div
                                                        class="tools">
                                                        <a href="<?php echo ADMIN_PATH . 'task/deleteTask/' . $task->id; ?> "><i
                                                                class="fa fa-trash-o"></i></a>
                                                    </div>
                                                <?php } ?>


                                            <?php } else { ?>


                                                <span
                                                    class="text"><?php echo $task->task_title ?> </span>
                                                <span
                                                    class="text"
                                                    class="red"
                                                    data-viewformat="yyyy-mm-dd">
                                                                                                <?php echo $standard_date ?>
                                                    &nbsp;<i
                                                        class="fa fa-clock-o"></i> - <a
                                                        href="<?php echo base_url('administrator') . '/' . 'task/task/' . $task->id ?>"
                                                        style="font-family: Ionicons ; font-size: 11px; color: green"
                                                        href="">Read
                                                        More</a>  </span>

                                                <span
                                                    class="text"><?php echo $task->creator ?> </span>

                                            <?php } ?>

                                        </li>

                                    <?php } ?>

                                </ul>
                            </div>
                        </div>
                    <?php endif ?>


                    <!-- Calendar -->
                    <div
                        class="box box-solid bg-blue-gradient">
                        <div
                            class="box-header">
                            <i class="fa fa-calendar"></i>

                            <h3 class="box-title">
                                <a href="<?php echo base_url(ADMIN_PATH) . '/calendar' ?>"
                                   style="color:#ffffff !important;">
                                    Calendar</a>
                            </h3>
                            <!-- tools box -->
                            <div
                                class="pull-right box-tools">
                                <!-- button with a dropdown -->
                                <div
                                    class="btn-group">
                                    <button
                                        class="btn btn-primary btn-sm dropdown-toggle"
                                        data-toggle="dropdown">
                                        <i
                                            class="fa fa-bars"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right"
                                        role="menu">
                                        <li>
                                            <a href="<?php echo base_url(ADMIN_PATH . 'calendar') ?>">Add
                                                new
                                                event</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url(ADMIN_PATH . 'calendar') ?>">Clear
                                                events</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="<?php echo base_url(ADMIN_PATH . 'calendar') ?>">View
                                                calendar</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /. tools -->
                        </div>
                        <!-- /.box-header -->
                        <div
                            class="box-body no-padding">
                            <!--The calendar -->
                            <div
                                id="calendar"
                                style="width: 100%"></div>
                        </div>


                        <div
                            class="box-footer text-black">

                            <input
                                id="toggle-trigger"
                                data-on="All"
                                data-off="Categorized"
                                data-toggle="toggle"
                                type="checkbox"
                                checked>

                            <script>
                                $(function () {
                                    $('#toggle-trigger').bootstrapToggle();
                                })
                            </script>

                            <script>
                                $(function () {
                                    $('#toggle-trigger').change(function () {
                                        if ($(this).prop('checked')) {
                                            $('#categorized').css('display', 'none');
                                            $('#comprehensive').css('display', 'block');
                                        }
                                        ;

                                        if ($(this).prop('checked') == false) {
                                            $('#categorized').css('display', 'block');
                                            $('#comprehensive').css('display', 'none');
                                        }

                                    })
                                });


                            </script>

                            <!---------------------Comprehensive ---------------------->

                            <div
                                class="row"
                                id="comprehensive">
                                <?php
                                $comprehensive_tasks = array_merge($uncompleted_tasks, $completed_tasks);

                                ?>
                                <div
                                    class="col-sm-6"
                                    style="margin-top: 33px;">
                                    <h3 class="box-title">
                                        All</h3>

                                    <?php foreach ($comprehensive_tasks as $key => $task) : ?>
                                        <div
                                            class="todo-calendar-tasks"
                                            data-start-date="<?php echo $task->startDate; ?>"
                                            data-completion-date="<?php echo $task->completion; ?>">


                                            <ul class="legend">
                                                <?php if ($task->status == 'complete') : ?>
                                                    <li>
                                                                                                                                        <span
                                                                                                                                            class="platinum"></span>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if ($task->status == 'incomplete') : ?>
                                                    <li>
                                                                                                                                        <span
                                                                                                                                            class="gold"></span>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                            <div
                                                class="clearfix">
                                                                                         <span
                                                                                             class="pull-left">
                                                                                            <?php echo $task->task_title; ?>

                                                                                             <?php
                                                                                             /*
                                                                                              * October-16-2015
                                                                                              * Show the end date of an incomplete task.
                                                                                              * This will show when the task has to be completed.
                                                                                              */
                                                                                             if (!empty($task->completion)):

                                                                                                 $convertDate = new DateTime($task->completion);
                                                                                                 $completiondate = $convertDate->format('m/d/Y');
                                                                                                 ?>
                                                                                                 <span data-type="date"
                                                                                                       class="todo-calendar-date <?php echo (strtotime($task->completion) < time()) ? 'red' : '' ?>"
                                                                                                       data-viewformat="yyyy-mm-dd"
                                                                                                       data-toggle="tooltip"
                                                                                                       data-placement="top"
                                                                                                       title="Goal completion target date">
                                                                                                &nbsp;
                                                                                                <i class="fa fa-clock-o"></i>
                                                                                                     <?php echo $completiondate; ?>
                                                                                            </span>
                                                                                             <?php endif; ?>

                                                                                        </span>
                                                <small
                                                    class="pull-right">
                                                </small>
                                            </div>
                                            <div
                                                class="progress xs">
                                                <div
                                                    <?php if ($task->status == 'incomplete') { ?>
                                                        class="progress-bar progress-bar-info"
                                                    <?php } else { ?>
                                                        class="progress-bar progress-bar-success"
                                                    <?php } ?>

                                                    style="width: 100%;"></div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>


                            <!---------------------Categorized ---------------------->


                            <div
                                class="row"
                                id="categorized"
                                style="display: none;">
                                <div
                                    class="col-sm-6"
                                    style="margin-top: 33px;">
                                    <h3 class="box-title">
                                        Incomplete
                                        Tasks</h3>

                                    <?php foreach ($uncompleted_tasks as $key => $task) : ?>
                                        <div
                                            class="todo-calendar-tasks"
                                            data-start-date="<?php echo $task->startDate; ?>"
                                            data-completion-date="<?php echo $task->completion; ?>">
                                            <div
                                                class="clearfix">
                                                                                        <span
                                                                                            class="pull-left">
                                                                                            <?php echo $task->task_title; ?>

                                                                                            <?php
                                                                                            /*
                                                                                             * October-16-2015
                                                                                             * Show the end date of an incomplete task.
                                                                                             * This will show when the task has to be completed.
                                                                                             */
                                                                                            if (!empty($task->completion)):

                                                                                                $convertDate = new DateTime($task->completion);
                                                                                                $completiondate = $convertDate->format('m/d/Y');
                                                                                                ?>
                                                                                                <span data-type="date"
                                                                                                      class="todo-calendar-date <?php echo (strtotime($task->completion) < time()) ? 'red' : '' ?>"
                                                                                                      data-viewformat="yyyy-mm-dd"
                                                                                                      data-toggle="tooltip"
                                                                                                      data-placement="top"
                                                                                                      title="Goal completion target date">
                                                                                                &nbsp;
                                                                                                <i class="fa fa-clock-o"></i>
                                                                                                    <?php echo $completiondate; ?>
                                                                                            </span>
                                                                                            <?php endif; ?>

                                                                                        </span>
                                                <small
                                                    class="pull-right">
                                                </small>
                                            </div>
                                            <div
                                                class="progress xs">
                                                <div
                                                    class="progress-bar progress-bar-info"
                                                    style="width: 100%;"></div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>


                                <div
                                    class="col-sm-6">
                                    <h3 class="box-title">
                                        Completed
                                        Tasks</h3>
                                    <?php foreach ($completed_tasks as $key => $task) : ?>
                                        <div
                                            class="todo-calendar-tasks"
                                            data-start-date="<?php echo $task->startDate; ?>"
                                            data-completion-date="<?php echo $task->completion; ?>">
                                            <div
                                                class="clearfix">
                                                                                        <span
                                                                                            class="pull-left"><?php echo $task->task_title; ?></span>

                                                <?php
                                                /*
                                                 * October-16-2015
                                                 * Show the the date on which the task is marked as complete.
                                                 */
                                                if (!empty($task->date_of_completion) && $task->date_of_completion != '0000-00-00'):
                                                    $convertDate = new DateTime($task->date_of_completion);
                                                    $date_of_completion = $convertDate->format('m/d/Y');
                                                    ?>
                                                    <span
                                                        class="todo-calendar-date"
                                                        data-type="date"
                                                        data-viewformat="yyyy-mm-dd"
                                                        data-toggle="tooltip"
                                                        data-placement="top"
                                                        title="Date of completion">
                                                                                                &nbsp;
                                                                                                <i class="fa fa-clock-o"></i>
                                                        <?php echo $date_of_completion ?>
                                                                                            </span>
                                                <?php endif; ?>

                                                <small
                                                    class="pull-right">
                                                </small>
                                            </div>
                                            <div
                                                class="progress xs">
                                                <div
                                                    class="progress-bar  progress-bar-success"
                                                    style="width: 100%;"></div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>


                    </div>

                </section>


                <?php if (in_array(role(), array(CLIENT, BROKER, OWNER, ADMIN))): ?>
                    <section
                        class="col-lg-5 connectedSortable">
                        <div
                            class="box box-success">
                            <div
                                class="box-header">
                                <i class="fa fa-trophy"></i>

                                <h3 class="box-title">
                                    Goals</h3>
                            </div>
                            <div
                                class="box-footer">

                                <div
                                    class="box box-info">
                                    <div
                                        class="box-header">
                                    </div>
                                    <div
                                        class="box-body">
                                        <form
                                            action="<?php echo base_url(ADMIN_PATH . 'task/addTask') ?>"
                                            method="post"
                                            id='goal'>
                                            <div
                                                class="input-group col-md-12">
                                                                                                                            <textarea
                                                                                                                                placeholder="Type message..."
                                                                                                                                style="width: 100%; height: 100px"
                                                                                                                                name="title"
                                                                                                                                required></textarea>
                                            </div>
                                            <br/>
                                            <input
                                                id="date-picker-1"
                                                type="text"
                                                class="date-picker form-control"
                                                name="startDate"
                                                placeholder="Start Date"/>
                                            <br/>
                                            <input
                                                id="date-picker-1"
                                                type="text"
                                                class="date-picker form-control"
                                                name="date"
                                                placeholder="Goal completion target date"
                                                required/>
                                            <br>
                                            <?php

                                            /*
                                             * Provide sharing option if the role of the user is broker
                                             */
                                            if ($this->session->userdata(ROLE_NAME) == 'broker'): ?>
                                                <select
                                                    id="goalShare"
                                                    class="share-todo"
                                                    multiple="multiple"
                                                    name="share_goal[]"
                                                    >
                                                    <?php
                                                    /*
                                                    * List of the system users of broker
                                                    */
                                                    if (count($shareUsers)): ?>

                                                        <?php foreach ($shareUsers as $key => $system_user) : ?>
                                                            <option
                                                                value="<?php echo $key ?>"><?php echo $system_user; ?>
                                                            </option>
                                                        <?php endforeach; ?>

                                                    <?php endif; ?>

                                                </select>
                                            <?php endif; ?>

                                            <div
                                                class="box-footer clearfix">
                                                <button
                                                    class="pull-right btn btn-default"
                                                    id="addGoal"
                                                    type="submit">
                                                    Add
                                                    Goal
                                                    <i
                                                        class="fa fa-arrow-circle-right"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>


                                </div>
                            </div>
                    </section>

                    <section
                        class="col-lg-5 connectedSortable">

                        <div
                            class="box box-info">
                            <?php if ($this->session->flashdata('supportMessage')) { ?>
                                <div
                                    class="alert alert-success">
                                    <a href="#"
                                       class="close"
                                       data-dismiss="alert">&times;</a>
                                    <?php echo $this->session->flashdata('supportMessage'); ?>
                                </div>
                            <?php } ?>
                            <div
                                class="box-header">

                                <i class="fa fa-users"></i>

                                <h3 class="box-title">
                                    Support
                                    &
                                    Suggestions</h3>
                            </div>
                            <div
                                class="box-body">
                                <form
                                    action="<?php echo base_url(ADMIN_PATH . 'home/supportEmail') ?>"
                                    method="post"
                                    id="support">
                                    <div
                                        class="form-group">
                                        <input
                                            type="hidden"
                                            class="form-control"
                                            name="name"
                                            value="<?php echo $name ?>"/>
                                    </div>
                                    <div
                                        class="form-group">
                                        <input
                                            type="hidden"
                                            class="form-control"
                                            name="sender"
                                            value="<?php echo $email ?>"/>
                                    </div>
                                    <div
                                        class="form-group">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="subject"
                                            placeholder="Subject"/>
                                    </div>
                                    <div>
                        <textarea class="textarea" placeholder="Message" name="msg"
                                  style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                    </div>
                                    <div
                                        class="box-footer clearfix">
                                        <button
                                            class="pull-right btn btn-default"
                                            id="sendEmail"
                                            type="submit">
                                            Send
                                            <i
                                                class="fa fa-arrow-circle-right"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </section>
                <?php endif ?>


                <?php if (in_array(role(), array())): ?>
                    <section
                        class="col-lg-5 connectedSortable">
                        <div
                            class="box box-solid bg-light-blue-gradient">
                            <div
                                class="box-header">
                                <!-- tools box -->
                                <div
                                    class="pull-right box-tools">
                                    <button
                                        class="btn btn-primary btn-sm daterange pull-right"
                                        data-toggle="tooltip"
                                        title="Date range">
                                        <i
                                            class="fa fa-calendar"></i>
                                    </button>
                                    <button
                                        class="btn btn-primary btn-sm pull-right"
                                        data-widget="collapse"
                                        data-toggle="tooltip"
                                        title="Collapse"
                                        style="margin-right: 5px;">
                                        <i
                                            class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <i class="fa fa-map-marker"></i>

                                <h3 class="box-title">
                                    Visitors
                                </h3>
                            </div>
                            <div
                                class="box-body">
                                <div
                                    id="world-map"
                                    style="height: 250px; width: 100%;"></div>
                            </div>
                            <div
                                class="box-footer no-border">
                                <div
                                    class="row">
                                    <div
                                        class="col-xs-4 text-center"
                                        style="border-right: 1px solid #f4f4f4">
                                        <div
                                            id="sparkline-1"></div>
                                        <div
                                            class="knob-label">
                                            Visitors
                                        </div>
                                    </div>
                                    <div
                                        class="col-xs-4 text-center"
                                        style="border-right: 1px solid #f4f4f4">
                                        <div
                                            id="sparkline-2"></div>
                                        <div
                                            class="knob-label">
                                            Online
                                        </div>
                                    </div>
                                    <div
                                        class="col-xs-4 text-center">
                                        <div
                                            id="sparkline-3"></div>
                                        <div
                                            class="knob-label">
                                            Exists
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="box box-solid bg-teal-gradient">
                            <div
                                class="box-header">
                                <i class="fa fa-th"></i>

                                <h3 class="box-title">
                                    Sales
                                    Graph</h3>

                                <div
                                    class="box-tools pull-right">
                                    <button
                                        class="btn bg-teal btn-sm"
                                        data-widget="collapse">
                                        <i
                                            class="fa fa-minus"></i>
                                    </button>
                                    <button
                                        class="btn bg-teal btn-sm"
                                        data-widget="remove">
                                        <i
                                            class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div
                                class="box-body border-radius-none">
                                <div
                                    class="chart"
                                    id="line-chart"
                                    style="height: 250px;"></div>
                            </div>
                            <div
                                class="box-footer no-border">
                                <div
                                    class="row">
                                    <div
                                        class="col-xs-4 text-center"
                                        style="border-right: 1px solid #f4f4f4">
                                        <input
                                            type="text"
                                            class="knob"
                                            data-readonly="true"
                                            value="20"
                                            data-width="60"
                                            data-height="60"
                                            data-fgColor="#39CCCC"/>

                                        <div
                                            class="knob-label">
                                            Mail-Orders
                                        </div>
                                    </div>
                                    <div
                                        class="col-xs-4 text-center"
                                        style="border-right: 1px solid #f4f4f4">
                                        <input
                                            type="text"
                                            class="knob"
                                            data-readonly="true"
                                            value="50"
                                            data-width="60"
                                            data-height="60"
                                            data-fgColor="#39CCCC"/>

                                        <div
                                            class="knob-label">
                                            Online
                                        </div>
                                    </div>
                                    <div
                                        class="col-xs-4 text-center">
                                        <input
                                            type="text"
                                            class="knob"
                                            data-readonly="true"
                                            value="30"
                                            data-width="60"
                                            data-height="60"
                                            data-fgColor="#39CCCC"/>

                                        <div
                                            class="knob-label">
                                            In-Store
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="box box-solid bg-green-gradient">
                            <div
                                class="box-header">
                                <i class="fa fa-calendar"></i>

                                <h3 class="box-title">
                                    Calendar</h3>

                                <div
                                    class="pull-right box-tools">
                                    <div
                                        class="btn-group">
                                        <button
                                            class="btn btn-success btn-sm dropdown-toggle"
                                            data-toggle="dropdown">
                                            <i
                                                class="fa fa-bars"></i>
                                        </button>
                                        <ul class="dropdown-menu pull-right"
                                            role="menu">
                                            <li>
                                                <a href="#">Add
                                                    new
                                                    event</a>
                                            </li>
                                            <li>
                                                <a href="#">Clear
                                                    events</a>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <a href="#">View
                                                    calendar</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <button
                                        class="btn btn-success btn-sm"
                                        data-widget="collapse">
                                        <i
                                            class="fa fa-minus"></i>
                                    </button>
                                    <button
                                        class="btn btn-success btn-sm"
                                        data-widget="remove">
                                        <i
                                            class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div
                                class="box-body no-padding">
                                <div
                                    id="calendar"
                                    style="width: 100%"></div>
                            </div>
                            <div
                                class="box-footer text-black">
                                <div
                                    class="row">
                                    <div
                                        class="col-sm-6">
                                        <div
                                            class="clearfix">
<span
    class="pull-left">Task #1</span>
                                            <small
                                                class="pull-right">
                                                90%
                                            </small>
                                        </div>
                                        <div
                                            class="progress xs">
                                            <div
                                                class="progress-bar "
                                                style="width: 90%;"></div>
                                        </div>
                                        <div
                                            class="clearfix">
<span
    class="pull-left">Task #2</span>
                                            <small
                                                class="pull-right">
                                                70%
                                            </small>
                                        </div>
                                        <div
                                            class="progress xs">
                                            <div
                                                class="progress-bar "
                                                style="width: 70%;"></div>
                                        </div>
                                    </div>
                                    <div
                                        class="col-sm-6">
                                        <div
                                            class="clearfix">
<span
    class="pull-left">Task #3</span>
                                            <small
                                                class="pull-right">
                                                60%
                                            </small>
                                        </div>
                                        <div
                                            class="progress xs">
                                            <div
                                                class="progress-bar progress-bar-blue"
                                                style="width: 60%;"></div>
                                        </div>

                                        <div
                                            class="clearfix">
<span
    class="pull-left">Task #4</span>
                                            <small
                                                class="pull-right">
                                                40%
                                            </small>
                                        </div>
                                        <div
                                            class="progress xs">
                                            <div
                                                class="progress-bar progress-bar-blue"
                                                style="width: 40%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php endif ?>
            </div>
    </section>
</div>


<script src="<?php echo base_url(); ?>backend/js/jquery.multiple.select.js" type="text/javascript"></script>


<script>

    <?php foreach($uncompleted_tasks as $key=>$task):?>/*todo: do not name your variable like this - name it "incompleteTasks" instead - notice the udnerscore gone and the lower upper combination. manish remove this comment after you fix this*/

    $("#multi<?php echo $key ;?>").multiselect({
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        includeSelectAllOption: true,
        nonSelectedText: 'Share',
        numberDisplayed: 1,
        onDropdownHide: function (event) {
            var data = new FormData();
            var task_id = $('#multi<?php echo $key ;?>').data('task-id');
            data.append('share_todo_id', task_id);
            var brands = $('#multi<?php echo $key ;?> option:selected');
            if (brands.length) {
                $(brands).each(function () {
                    data.append('share_todo[]', $(this).val());
                    $(this).prop('selected', false);
                });
                shareTodo(data);
            }
            $('#multi<?php echo $key ;?>').multiselect('refresh');
        }
    });


    $("#checkbox<?php echo $key;?>").click(function () {
        var val = $('#checkbox<?php echo $key;?>:checked').val();
        if ($("#checkbox<?php echo $key;?>").is(':checked')) {
            window.location.href = "<?php echo base_url() . 'administrator/task/ChangeToComplete/'?>" + val;
        } else {
            console.log("Cannot Pass the value");
        }

    });


    $("#checkboxs<?php echo $key;?>").click(function () {
        var value1 = $('#checkboxs<?php echo $key;?>:checked').val();
        if ($("#checkboxs<?php echo $key;?>").is(':checked')) {
            window.location.href = "<?php echo base_url() . 'administrator/task/ChangeToUnread/'?>" + value1;
        } else {
            console.log("Cannot Pass the value");
        }
    });
    <?php endforeach;?>





    <?php foreach($completed_tasks as $key=>$task):?>

    $("#checkbox_com<?php echo $key;?>").click(function () {
        var value1 = $('#checkbox_com<?php echo $key?>').val();
        if ($(this).not(':checked')) {
            window.location.href = "<?php echo base_url() . 'administrator/task/ChangeToInComplete/'?>" + value1;
        }
    });

    <?php endforeach;?>


    $("#date-picker-1").datepicker({
        minDate: 0,
        todayHighlight: true
    });

    $(".date-picker").datepicker({
        todayHighlight: true
    });

    $(".date-picker").on("change", function () {
        var id = $(this).attr("id");
        var val = $("label[for='" + id + "']").text();
        $("#msg").text(val + " changed");
    });

    /*
     * Dashboard calendar
     * Highlight the event if the selected date falls between start date and end date of the event.
     */


    $("#calendar").datepicker({

        todayHighlight: true
    }).on('changeDate', function (e) {
        console.log(e);
        var selected_date = new Date(e.date).getTime();

        $('.todo-calendar-tasks').each(function () {
            var start_date = new Date($(this).attr('data-start-date')).getTime();
            var end_date = new Date($(this).attr('data-completion-date')).getTime();

            if (selected_date >= start_date && selected_date <= end_date) {
                $(this).addClass('well');
                $(this).addClass('well-sm');
            } else {
                $(this).removeClass('well');
                $(this).removeClass('well-sm');
            }

        });

    });

    $('#task_title* , #status').editable({
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params, newValue) {
            params.table = 'task';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') {
                return response.msg;
            }
        }
    });
    $('#completion*').editable({
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        datepicker: {
            todayBtn: 'linked'
        },
        params: function (params, newValue) {
            params.table = 'task';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') {
                return response.msg;
            }
        }
    });

    function insert(value, task_id) {

        var client_id = value;
        var taskId = task_id;
        $.ajax({
            url: '<?php echo base_url('administrator/task/insertToTaskUser')?>',
            type: 'POST',
            data: {c_id: client_id, t_id: taskId},
            success: function () {
                $("#message").html("Task has been shared." + "</br>");
            },
            error: function () {
                $('#message').html('Something Wrong');
            }
        });


    }


    <?php $this->session->userdata(MEMBERSHIPS);?>

    if ($(".roles").find("option:selected").val() == 'client') {
//        $('#marketplace, #funding, #realEstate').css('pointer-events', 'none').fadeTo(500, 0.2);
    }

    //    $('#soon2').css('pointer-events', 'none').fadeTo(500, 0.2);
    //    $('#soon3').css('pointer-events', 'none').fadeTo(500, 0.2);

    /*
     * Goal share: share new goals with multiple users
     * Plugin used: Bootstrap multiselect (http://davidstutz.github.io/bootstrap-multiselect/)
     */
    $('#goalShare').multiselect({
        nonSelectedText: 'Share With',
        includeSelectAllOption: true
    });

    /*
     * ====================================================================
     *                      To Do sharing
     * ====================================================================
     */

    /*
     * Share to-do modal (http://getbootstrap.com/javascript/#modals)
     */
    $('#shareToDoModal').on('show.bs.modal', function (event) {
        var task = $(event.relatedTarget); // Task that is to be shared
        var task_title = task.data('task-name'); // Extract the task name
        var task_id = task.data('task-id');

        var modal = $(this);
        modal.find('.share-todo-title').text(task_title);
        modal.find('#shareToDoId').val(task_id);
    });

    $('#shareToDoModal').on('hide.bs.modal', function () {
        /*Reset form.*/
        $("#shareToDoForm")[0].reset();
        $('.modal-body .alert').fadeOut();
    });

    /*Toggle between select all*/
    $('#shareToDoSelectAll').click(function () {
        var checked = this.checked;
        $("#shareToDoForm input[type=checkbox]").each(function () {
            $(this).prop('checked', checked);
        });
    });

    /*
     * Share tasks with users
     */
    function shareTodo(data) {

        $.ajax({
            url: "<?php echo base_url('administrator/task/shareToDoTask') ?>",
            type: "POST",
            data: data,
            processData: false,  // tell jQuery not to process the data
            contentType: false   // tell jQuery not to set contentType
        }).done(function (response) {

            var resonse_data = JSON.parse(response);

            $('#message .alert').removeClass('alert-warning');
            $('#message .alert').removeClass('alert-danger');
            $('#message .alert').removeClass('alert-success');

            $('#message .alert').addClass('alert-' + resonse_data.status);
            $('#message .alert').fadeIn();
            $('#message .message').text(resonse_data.message);
            $('#message .alert').fadeOut(5000);

        });
    }

</script>
<script>

    $("#support").formValidation({
        message: 'This value is not valid',
        fields: {

            subject: {
                validators: {
                    notEmpty: {
                        message: 'Required'

                    }
                }
            }, msg: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            }
        }
    });

    $("#quick").formValidation({
        message: 'This value is not valid',
        fields: {

            subject: {
                validators: {
                    notEmpty: {
                        message: 'Required'

                    }
                }
            }, msg: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            }, emailto: {
                validators: {

                    notEmpty: {
                        message: 'Required'
                    },
                    regexp: {
                        regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                        message: 'Invalid email address'
                    },
                    blank: {}
                }
            }
        }
    });


</script>

<script src="<?php echo base_url(); ?>backend/dist/js/pages/dashboard.js" type="text/javascript"></script>

