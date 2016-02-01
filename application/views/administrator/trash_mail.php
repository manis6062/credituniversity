

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper bg-main">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo $this->session->userdata(NAME) ?>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url('administrator/mail');?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Trash</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-3">
				<a href="<?php echo base_url('administrator/mail/compose')?>" class="btn btn-primary btn-block margin-bottom">Compose</a>
				<div class="box box-solid">
					<div class="box-header with-border">
						<h3 class="box-title">Folders</h3>
						<div class='box-tools'>
							<button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
						</div>
					</div>
					<div class="box-body no-padding">
						<ul class="nav nav-pills nav-stacked">
							<li ><a href="<?php echo base_url('administrator/mail');?>"><i class="fa fa-inbox"></i> Inbox <span class="label label-primary pull-right"><?php if(!empty($count_receivedEmails)){echo $count_receivedEmails ;}?></span></a></li>
							<li ><a href="<?php echo base_url('administrator/mail/sent_mail');?>"><i class="fa fa-envelope-o"></i> Sent<span class="label label-primary pull-right"></span></a></li>
							<li  class="active"><a href="<?php echo base_url('administrator/mail/trash_mail');?>"><i class="fa fa-trash-o"></i> Trash</a></li>
						</ul>
					</div><!-- /.box-body -->
				</div><!-- /. box -->
			</div><!-- /.col -->
			<div class="col-md-9">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Trash</h3>
                        <?php
                        if(!empty($trashEmails)){ ?>
                            <a class="refresh" href="<?php echo base_url('administrator/mail/trash_mail');?> " <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button></a>
                        <?php } ?>
					</div><!-- /.box-header -->
					<div class="box-body">
						<div class="table-responsive ">
							<table class="table table-hover table-striped" id = 'trash'>
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>User</th>
                                    <th>Subject</th>
                                    <th>Sent Date</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
								<tbody>
								<form method="post" action="<?php echo base_url('administrator/mail/permanentDeleteMultiple')?>">
									<?php
                                    $count = 1 ;
									if(!empty($trashEmails)){
										foreach ($trashEmails as $values) {
                                            ?>
											<tr>
                                                <td><?php echo $count++ ?> </td>
<!--												<td><input type="checkbox" name = "checkbox[]" value="--><?php //echo $values->id ?><!--"/></td>-->
												<td class="mailbox-name">
                                                        <?php
                                                        if($values->receiver == 0){
                                                            {echo $values->receiver_name ;}
                                                        }
                                                        if(!empty($values->receiver_name))
                                                              {echo $values->receiver ;}
                                                        else{echo $values->sender ;}  ?></td>
												<td class="mailbox-subject"><b><a href="<?php echo base_url('administrator/mail/read_mail'). '/' .$values->id?>"><?php echo character_limiter($values->subject, 30) ?></a></b></td>
												<td class="mailbox-date"><?php echo $values->date ?></td>
												<td><a href="<?php echo base_url('administrator/mail/deleteFromTrash') . '/' .$values->id .'/'.$values->receiver_id ?>" class="btn btn-default btn-sm" data-toggle="tooltip" title="Delete"><i class="fa fa-trash-o"></i></a></td>
											</tr>
										<?php }}?>
									<div class="mailbox-controls">

									</div>
								</form>
								</tbody>
							</table><!-- /.table -->
						</div><!-- /.mail-box-messages -->
					</div><!-- /.box-body -->
					<div class="box-footer no-padding">
						<div class="mailbox-controls">

						</div>
					</div>
				</div><!-- /. box -->
			</div><!-- /.col -->
		</div><!-- /.row -->
		</div><!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
    $('#trash').dataTable({
        iDisplayLength: 1000
    });
</script>



