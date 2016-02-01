<section id="forum">
	<div class="top-legal">
		<div class="center">
			<h1><?php echo $title;?></h1>
		</div>
	</div>
	<div class="container">
		<h2><?php echo $title1;?></h2>
		<div class="comment">

			<div class="tab-wrap">
				<div class="media">
					<div class="parrent pull-left">
						<ul class="nav nav-tabs nav-stacked">
							<li <?php if($this->uri->segment(1)=='forum' && $this->uri->segment(2)==''){?>class='active'<?php }?>>
								<a href="<?php echo base_url().'forum'?>" class="analistic-01">View All Topics</a>
							</li>
							<?php if($this->session->userdata(USER_ID)){?>
								<li <?php if($this->uri->segment(2)=='ask'){?>class='active'<?php }?>>
									<a href="<?php echo base_url().'forum/ask'?>" class="analistic-01">Create Topic</a>
								</li>
							<?php }else{?>
								<li <?php if($this->uri->segment(2)=='ask'){?>class='active'<?php }?>>
									<a href="<?php echo base_url().'member'?>" class="analistic-01">Create Topic</a>
								</li>
							<?php }?>	
							<?php if($this->session->userdata(USER_ID)){?>
								<li <?php if($this->uri->segment(2)=='myquestion'){?>class='active'<?php }?>>
									<a href="<?php echo base_url().'forum/myquestion'?>" class="analistic-02">My Topics</a>
								</li>
							<?php }else{?>
								<li <?php if($this->uri->segment(2)=='myquestion'){?>class='active'<?php }?>>
									<a href="<?php echo base_url().'member'?>" class="analistic-02">My Topics</a>
								</li>
							<?php }?>	
							<!--<li class=""><a href="#tab3" data-toggle="tab" class="tehnical">Predefine Layout</a></li>
							<li class=""><a href="#tab4" data-toggle="tab" class="tehnical">Our Philosopy</a></li>
							<li class=""><a href="#tab5" data-toggle="tab" class="tehnical">What We Do?</a></li>-->
						</ul>
					</div>
					<div class="parrent media-body">
						<div class="tab-content">
							<div class="tab-pane active in" id="tab1">
								<div class="media">

									<div class="comment-title">
										<strong>Forum Topics</strong>
									</div>

									<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th width="2%">Sn</th>
												<th width="80%">Topic Title</th>
												<th width="10%">Replies</th>
												<th width="8%" align="center"><i class="fa fa-eye fa-1x"> </th>
											</tr>
										</thead>

										<tbody>
											<?php if(!empty($forum)){
												$i=1;
												foreach ($forum as $key => $value) {?>
													<tr>
														<td><?php echo $i;?></td>
														<td><a href="<?php echo base_url().'forum/detail/'.$value->forum_id;?>"><?php echo $value->question;?></a></td>
														<td><?php echo $value->total_answer;?></td>
														<td><?php echo $value->views;?></td>
													</tr>													
											<?php 	
												$i++;}
											}else{?>
													<tr>
														<td colspan="4">No Forums yet.</td>
													</tr>	
											<?php }?>	
										</tbody>

									</table>

								</div>
							</div>

							<div class="tab-pane active in" id="tab2">
								<div class="media">

								</div>
							</div>
						</div>
						<!--/.tab-content-->
					</div>

					<!--/.media-body-->
				</div>
				<!--/.media-->
			</div><!--/.tab-wrap-->
		</div>
	</div>
</section>
</div>
<hr>