<?php
	echo form_open(ADMIN_PATH . 'role/addRole');
?>


<h2><?php echo $title; ?></h2>

<label>Value *</label>

<?php $data = array('name' => 'v_name', 'placeholder' => 'Enter Role Value', 'value' => set_value('v_name'));
	echo form_input($data);
	echo form_error('v_name');
?>
<p class="note">(Maximum Characters is 10)</p>

<label>Label *</label>
<?php $data = array('name' => 'label', 'type' => 'label', 'placeholder' => 'Enter Role Name', 'value' => set_value('label'));
	echo form_input($data);
	echo form_error('label');
?>




<?php $data = array('name' => 'submit', 'id' => 'submit', 'value' => 'ADD');
	echo form_submit($data);
?>

<a href="<?php echo site_url(ADMIN_PATH . 'role/roles'); ?>" class="btn btn-default">Cancel</a>


<?php echo form_close(); ?>


<hr>