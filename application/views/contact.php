<?php $CI = &get_instance();
	$content = $CI->ContentModel->getDetails('Contact');
	$contact = $CI->ContactModel->getAll();
?>
<!-- <div class="main">
<div class="wrap">
<div class="section group">
<div class="cont span_2_of_blog">
<div class="login-title">
<h4 class="title">Contact Us</h4>
<?php if ($this->session->flashdata('su_message')) { ?>
<div class="message info"><p><?php echo $this->session->flashdata('su_message') ?><p></div>
<?php } ?>
<div id="loginbox" class="loginbox">
<?php
	$attributes = '';
	echo form_open('contact/login', $attributes);
?>
<fieldset class="input">
<p id="login-form-username">
<label for="modlgn_username">Name*</label>
<?php
	$data = array(
		'name' => 'name',
		'id' => 'name',
		'value' => set_value('name'),
		'class' => 'inputbox',
		'size' => '18'
//'readonly' => 'readonly'
	);
	echo form_input($data);
?>
<?php echo form_error('name'); ?>
</p>
<p id="login-form-password">
<label for="email">Email*</label>
<?php
	$data = array(
		'name' => 'email',
		'id' => 'email',
		'value' => set_value('email'),
		'class' => 'inputbox',
		'size' => '18'
//'readonly' => 'readonly'
	);
	echo form_input($data);
?>
<?php echo form_error('email'); ?>
</p>
<p id="login-form-username">
<label for="subject">Subject*</label>
<?php
	$data = array(
		'name' => 'subject',
		'id' => 'subject',
		'value' => set_value('subject'),
		'class' => 'inputbox',
		'size' => '18'
//'readonly' => 'readonly'
	);
	echo form_input($data);
?>
<?php echo form_error('subject'); ?>
</p>
<p id="login-form-username">
<label for="message">Message*</label>
<?php
	$data = array(
		'name' => 'message',
		'id' => 'message',
		'value' => set_value('message'),
		'class' => 'inputbox',
		'size' => '18'
//'readonly' => 'readonly'
	);
	echo form_textarea($data);
?>
<?php echo form_error('message'); ?>
</p>
<input type="submit" name="Submit" class="button" value="Submit">
</fieldset>
</form>
</div>
</div>
</div>
<div class="bsidebar span_1_of_blog">

<h2 class="head4">Contact Info</h2>
<p>
Location:
</p>
<p>
Phone
</p>
<p>
Email
</p>
<p>
web:www.yourdoamin.com
</p>
</div>
</div>
<div class="clear"></div>
</div>
</div> -->

<section id="contact-info">
	<div class="center">
		<h2>How to Reach Us?</h2>

		<p class="lead">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit
		</p>
	</div>
	<div class="gmap-area">
		<?php if (!empty($contact->source)) { ?>
			<iframe src="<?php echo $contact->source; ?>" width="100%" height="350" frameborder="0"
					style="border:0"></iframe>
		<?php } ?>
	</div>
</section>
<!--/gmap_area -->

<section id="contact-page">
	<div class="container">
		<div class="center">
			<h2>Contact Us</h2>
		</div>
		<div class="col-lg-4">
			<div class="center">
				<i class="fa fa-map-marker fa-5x"></i>

				<p><?php echo $contact->address; ?><br/>
					Website: <a target="_blank"
								href="<?php echo $contact->site; ?>"><?php echo $contact->site; ?></a>
				</p>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="center">
				<i class="fa fa-envelope fa-5x"></i>

				<p>
					Email: <a
						href="mailto:<?php echo $contact->email; ?>"><?php echo $contact->email; ?></a>
				</p>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="center">
				<i class="fa fa-phone fa-5x"></i>

				<p>
					tel: <?php echo $contact->tel; ?>
				</p>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row team-bar">
			<div class="first-one-arrow hidden-xs">
				<hr>
			</div>
			<div class="first-arrow hidden-xs">
				<hr>
				<i class="fa fa-angle-up"></i>
			</div>
			<div class="second-arrow hidden-xs">
				<hr>
				<i class="fa fa-angle-down"></i>
			</div>
			<div class="third-arrow hidden-xs">
				<hr>
				<i class="fa fa-angle-up"></i>
			</div>
			<div class="fourth-arrow hidden-xs">
				<hr>
				<i class="fa fa-angle-down"></i>
			</div>
		</div>
		<div class="row contact-wrap">
			<?php if ($this->session->flashdata('su_message')) { ?>
				<div class="status alert alert-success">
					<div class="message info"><p><?php echo $this->session->flashdata('su_message') ?><p></div>
				</div>
			<?php } ?>
			<form class="contact-form" name="contact-form" method="post"
				  action="<?php echo base_url() . 'contact/sendmail'; ?>">
				<div class="col-sm-5 col-sm-offset">
					<div class="form-group">
						<label>Name *</label>
						<input type="text" name="name" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Email *</label>
						<input type="email" name="email" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Subject *</label>
						<input type="text" name="subject" class="form-control" required>
					</div>
				</div>
				<div class="col-sm-5">
					<div class="form-group">
						<label>Message *</label>
						<textarea name="msg" id="message" required class="form-control" rows="4"></textarea>
					</div>
					<div class="form-group">
						<button type="submit" name="submit" class="btn btn-primary btn-lg">
							Submit Message
						</button>
					</div>
				</div>
			</form>
		</div>
		<!--/.row-->
	</div>
	<!--/.container-->
</section><!--/#contact-page-->
</div>
<hr>
