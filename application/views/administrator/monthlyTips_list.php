<script>
    <?php
    $months = array();
    $currentMonth = (int)date('m');
    for ($x = $currentMonth; $x < $currentMonth + 12; $x++) {
    $months[] = date('F', mktime(0, 0, 0, $x, 1));
    }
    ?>
</script>

<script>
    <?php
    $years = array();
    for($i = 2014;$i<= 2016;$i++)
    $years["$i"] = $i;
    ?>




</script>

<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            <?php echo $title; ?>
            <small>Archive</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Lists</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <form action="<?php echo base_url() . 'administrator/line/addLine'; ?>" method="post"
                  id="line">
                <div class="col-md-7">
                    <div class="box box-danger">
                        <div class="box-header">

                        </div>

                        <div class="container">
                            <div class="panel-group col-md-6" id="accordion">
                                <?php foreach ($years as $key => $year)  :     ?>

                                    <?php foreach ($tips as $tip) : ?>

                                        <?php  $TipDateOfYear = $tip->value;
                                        $get_year = date("Y", strtotime($TipDateOfYear));
                                        $monthlyTipDate = $tip->value;
                                        $monthName = date('F', strtotime($monthlyTipDate)); ?>


                                        <?php if ( ($get_year == $year)) : ?>

                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title" style="text-align: center; font-size: 20px;">
                                                        <a data-toggle="collapse" data-parent="#accordion" title="Click On The Year"
                                                           href="#collapse<?php echo $key ?>"><?php echo $year ?></a>
                                                    </h4>
                                                </div>
                                                <div id="collapse<?php echo $key ?>" class="panel-collapse collapse in">
                                                    <div class="panel-body">
                                                        <?php foreach ($months as $month) : ?>
                                                            <ul class="list-group">
                                                                <li class="list-group-item" style="text-align: center; padding: 10px; background-color: #f9f9f9;"><span style="font-size: 18px; font-weight: 20px;"><?php echo $month; ?>  -  <?php echo $year ?></span>

                                                                    <ul class="list-group">
                                                                        <?php foreach ($tips as $tip) : ?>

                                                                            <?php  $TipDateOfYear = $tip->value;
                                                                            $get_year = date("Y", strtotime($TipDateOfYear));
                                                                            $monthlyTipDate = $tip->value;
                                                                            $monthName = date('F', strtotime($monthlyTipDate)); ?>


                                                                            <?php if (($monthName == $month) && ($get_year == $year)) : ?>

                                                                                <li class="list-group-item">
                                                                                    Title :    <a href="<?php echo base_url('administrator/content/loadTip') . '/' . $tip->id; ?>"> <?php echo $tip->name; ?></a>
                                                                                    <br/> Published Date : <?php echo $tip->value; ?>
                                                                                </li>
                                                                            <?php endif; ?>
                                                                        <?php endforeach; ?>

                                                                    </ul>
                                                                </li>

                                                            </ul>
                                                        <?php endforeach; ?>

                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>


                            </div>


                        </div>
            </form>
        </div>
    </section>
</div>

<script>

    $('.collapse').collapse()

</script>