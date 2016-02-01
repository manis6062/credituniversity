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
										<strong>Create Topic</strong>
									</div>
									<div class="well clearfix">
										<form class="form-horizontal" method="post" role="form" action="<?php echo base_url().'forum/createTopic';?>">
											<?php if ($this->session->flashdata('su_message')) { ?>
												<div class="status alert alert-success">
							                          <div class="message info"><p><?php echo $this->session->flashdata('su_message') ?><p></div> 
							                    </div>      	
							                <?php } ?>
											<div class="form-group">
												<label for="firstname" class="col-sm-2 control-label">Question Title</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="question" name="question" required placeholder="Enter Question Title">
												</div>

											</div>
											<div class="form-group">
												<label for="lastname" class="col-sm-2 control-label">Question Detail</label>
												<div class="col-sm-10">
													<textarea class="form-control" rows="5" name="question_detail" required placeholder="Description"></textarea>
												</div>
											</div>
											<input type="submit" class="btn btn-success pull-right" value="Create Topic">
										</form>
									</div>

								</div>
							</div>

							<div class="tab-pane active in" id="tab2">
								<div class="media">

								</div>
							</div>

							<!--   <div class="tab-pane" id="tab3">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.</p>
							</div>

							<div class="tab-pane" id="tab4">
							<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words</p>
							</div>

							<div class="tab-pane" id="tab5">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.</p>
							</div>-->
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