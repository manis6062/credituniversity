<script type="text/javascript">
	function submitform(){
		document.replytopic.submit();
	}
</script>
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
										<strong>Topic: <?php echo $forumquestion->question;?></strong>
									</div>
									<div class="comment-box clearfix">
										<div class="col-md-10">
											<strong>Creator:</strong> <?php echo $forumquestion->user_name;?>
										</div>
										<div class="col-md-2">
											<strong>Created:</strong> <?php echo $forumquestion->forum_date;?>
										</div>
									</div>
									<div class="well">
										<div class="row">
											<?php if ($this->session->flashdata('su_message')) { ?>
												<div class="status alert alert-success">
							                          <div class="message info"><p><?php echo $this->session->flashdata('su_message') ?><p></div> 
							                    </div>      	
							                <?php } ?>
											<div class="question clearfix">
												<div class="col-md-2">
													<div class="profile-img">
														<a class="center-profile"><img src="<?php echo base_url(); ?>frontend/images/ana1.png"></a>
														<div class="center">
															<a><?php echo $forumquestion->user_name;?></a>
															<br>
															<?php echo $forumquestion->forum_date;?>
														</div>
													</div>
												</div>
												<div class="col-md-10">
													<p><?php echo $forumquestion->question_detail;?></p>
												</div>
											</div>
											<?php if(!empty($forumanswer)){
												foreach ($forumanswer as $key => $value) {?>
													<div class="answer clearfix">
														<div class="col-sm-2">
															<div class="profile-img">
																<a><img src="<?php echo base_url(); ?>frontend/images/ana1.png"></a>
																<div class="center">
																	<a><?php echo $value->user_name;?></a>
																	<br>
																	<?php echo $value->answer_date;?>
																</div>
															</div>
		
														</div>
														<div class="col-sm-10">
															<p><?php echo $value->answer;?></p>
														</div>
													</div>
											<?php 	
												}
											} if($this->session->userdata(USER_ID)){?>
											<div class="answer clearfix">
													<form role="form" name="replytopic" id="replytopic" method="post" action="<?php echo base_url().'forum/reply'?>">
														<div class="col-sm-10">
															<div class="form-group">
																<textarea class="form-control" rows="5" required name="reply" placeholder="Answer"></textarea>
																<input type="hidden" name="qid" value="<?php echo $forumquestion->forum_id;?>">
															</div>
														</div>	
														<div class="col-sm-2">
															<div class="media-body post_reply_comments">
																<a style="cursor: pointer;" onclick="submitform()">Answer</a>
																<!-- <input type="submit"  name="submit" value="Reply" id="submit" class="submit" /> -->
															</div>
														</div>
													</form>
											</div>
											<?php }?>
										</div>
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