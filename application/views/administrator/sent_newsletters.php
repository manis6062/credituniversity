<div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
    <section class="content-header">
        <h1>
            Sent NewsLetters
            <a class="btn btn-link" href="<?php echo base_url() . 'administrator/newsletter/sendNewsletter'; ?>">Send Newsletters</a>
            <a class="btn btn-link" href="<?php echo base_url() . 'administrator/newsletter/newsletterForm'; ?>">Add Newsletter Template</a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="<?php echo base_url() . 'administrator/newsletter'; ?>"><i class="fa fa-newspaper-o"></i>Newsletters Templates</a></li>
            <li class="active">Sent Newsletters</li>
        </ol>
    </section>
    <section class="content">
        <div id="row">
            <section class="content">
                <div class="row">
                    <div id="row">
                        <div class="col-md-12">
                            <div class="box box-danger">
                                <div class="box-header">
                                    <h3 class="box-title"><?php echo $title1; ?></h3>
                                </div>
                                <div class="box-body">
                                    <table class="table table-bordered table-striped" id="send_templates">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Recipient</th>
                                            <th>Newsletter Heading</th>
                                            <th>Sent Date</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if (!empty($getAllSubscribers)) {
                                            $count = 1;
                                            foreach ($getAllSubscribers as $values) {
                                                ?>
                                                <tr class="item">
                                                    <td><?php echo $count++; ?></td>
                                                    <td><?php  echo $values->first_name ; ?></td>
                                                    <td><?php echo $values->subject; ?></td>
                                                    <td><?php echo $values->sent_date; ?></td>
                                                    <td><a class="" href="<?php echo 'delete' . '/' . $values->news_id ?>"><i class="glyphicon glyphicon-trash"></i></a></td>
                                                </tr>
                                            <?php }
                                        } ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
</div>
<script type="text/javascript">
    $('#send_templates').dataTable();
</script>
