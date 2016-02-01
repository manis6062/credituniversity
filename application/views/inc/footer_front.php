<?php
	$CI = &get_instance();
	$menu = $CI->MenuModel->getAllByType('', '', 'footer-menu');
	$contact = $CI->ContactModel->getAll();
	$content = $this->ContentModel->getHomeContent();
?>
<section id="bottom">
	<div class="container wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
		<div class="row">
<!--			<div class="col-md-4 col-sm-6">-->
<!--				<div class="widget">-->
<!--					<h3>--><?php //echo $content->content_title; ?><!--</h3>-->
<!---->
<!--					<p style="color:#fff; margin-top:25px;">--><?php //echo strip_tags(word_limiter($content->content_description, 60, '')); ?><!--</p>-->
<!--				</div>-->
<!--			</div>-->
			<div class="col-md-6 col-sm-9" style="padding-left: 55px;">
				<div class="widget_menu">
					<h3>Navigation</h3>
					<ul>

						<?php
							foreach ($menu as $mmenu) {
								if ($mmenu->menu_name != 'Home') {
									?>
									<li <?php
									if (($mmenu->module_controller == 'content') && ($this->uri->segment(2) == $mmenu->content_id)) {
										echo 'class="active">';
									} elseif (($mmenu->module_controller == $this->uri->segment(1)) && ($mmenu->module_controller != 'content')) {
										echo 'class="active">';
									} else {
										echo '>';
									}
									?>

										<a href="<?php
											echo site_url($mmenu->module_controller);
											if ($mmenu->module_controller == 'content') {
												?>/<?php
										   echo $mmenu->content_id;
									   }
									   ?>"><?php echo $mmenu->menu_name; if ($mmenu->menu_name== 'Forum'){echo '<span class="forumbadge">4</span>';} ?>


									  </a>
									<?php
								}
							}
						?>
					</ul>
				</div>
			</div>
			<div class="col-md-6 col-sm-9">
				<div class="widget">
					<h3>QUICK CONNECT</h3>

					<form role="form" method="post" action="<?php echo base_url() . 'contact/quickConnect'; ?>">
						<div class="form-group">
							<input type="name" name="name" class="form-control" required id="exampleInputEmail1"
								   placeholder="Enter Fullname">
						</div>
						<div class="form-group">
							<input type="email" name="email" class="form-control" required id="exampleInputEmail1"
								   placeholder="Enter Email">
						</div>

						<div class="form-group">
							<textarea class="form-control" rows="3" required name="msg"
									  placeholder="Message"></textarea>
							<input type="hidden" name="subject" value="Quick Connect">
						</div>

						<button type="submit" class="btn btn-danger">
							Submit
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</section><!--/#bottom-->

<footer id="footer" class="midnight-blue">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<?php echo SITE_NAME; ?> © <?php echo CRTD_DT; ?>
			</div>
			<div class="col-sm-6">
				<ul class="pull-right">

					<li>
						Powered By: <a href="<?php echo POWERED_URL; ?>"><?php echo POWERED; ?></a> <span
							style="margin-left: 30px; color:#12b801;">Version 1.0</span>
					</li>

				</ul>
			</div>
		</div>
	</div>
</footer><!--/#footer-->

</body>
<script src="<?php echo base_url(); ?>backend/plugins/jQuery-Mask-Plugin-master/dist/jquery.mask.min.js" type="text/javascript"></script>
</html>