<aside class="main-sidebar">
	<section class="sidebar">
		<div class="user-panel">
			<div class="pull-left image">
				<p><?php echo $this->session->userdata(NAME) ?></p>
				<!-- Status -->
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>

		<!-- search form (Optional) -->
		<!-- /.search form -->

		<!-- Sidebar Menu -->
		<ul class="sidebar-menu">

			<li class="header">Menu</li>

			<li class="active treeview">
				<a href="#"><i class='fa fa-user'></i> <span>User Management</span> <i
						class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li class="active"><a href="<?php echo base_url() . 'administrator/user'; ?>"><i
								class='fa fa-circle-o'></i>Manage Users</a></li>
					<li><a href="<?php echo base_url() . 'administrator/user/userForm'; ?>"><i
								class='fa fa-circle-o'></i>Add User</a></li>
				</ul>
			</li>
			<li class="treeview">
				<a href="#"><i class='fa fa-users'></i> <span>Role Management</span> <i
						class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li class="active"><a href="<?php echo base_url() . 'administrator/role/roles'; ?>"><i
								class='fa fa-circle-o'></i>Manage Roles</a></li>
					<li><a href="<?php echo base_url() . 'administrator/role/roleForm'; ?>"><i
								class='fa fa-circle-o'></i>Add Role</a></li>
				</ul>
			</li>

			<li class="treeview">
				<a href="<?php echo base_url() . 'administrator/mail'; ?>"><i class='fa fa-envelope'></i>
					<span>Mail Box</span></a>
			</li>


			<li class="treeview">
				<a href="#"><i class='fa fa-link'></i> <span>Client Management</span> <i
						class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li class="active"><a href="<?php echo base_url('administrator/client') ?>">Client List</a></li>
                    <li><a href="<?php echo base_url() . 'administrator/client/clientForm'; ?>"><i
                                class='fa fa-circle-o'></i>Add User</a></li>

				</ul>
			</li>

			<li class="treeview">
				<a href="#"><i class='fa fa-link'></i> <span>referrer Management</span> <i
						class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li class="active"><a href="<?php echo base_url('administrator/referrer') ?>">referrer List</a></li>
				</ul>
			</li>

			<li class="treeview">
				<a href="#"><i class='fa fa-link'></i> <span>Lines Management</span> <i
						class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li class="active"><a href="<?php echo base_url('administrator/ChooseAndCharge') ?>">Choose And
							Charge</a></li>

					<li class="active"><a href="<?php echo base_url() . 'administrator/cardType/cardTypes'; ?>"><i
								class='fa fa-check-square-o'></i>card types</a></li>
					<li class="active"><a href=""><i class='fa fa-check-square-o'></i>manage lines</a></li>
					<li class="active"><a
							href="<?php echo base_url() . 'administrator/lineowner/lineForm'; ?>"><i
								class='fa fa-check-square-o'></i>add line</a></li>

				</ul>
			</li>

			<li class="treeview">
				<a href="#"><i class='fa fa-link'></i> <span>Newsletter</span> <i
						class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li class="active"><a href="<?php echo base_url('administrator/Newsletter') ?>">Add Templates</a>
					</li>
					<li><a href="<?php echo base_url('administrator/Newsletter/sendNewsletter') ?>">Send Newsletter</a>
					</li>
				</ul>
			</li>

			<li class="treeview">
				<a href="#"><i class='fa fa-link'></i> <span>Banner Management</span> <i
						class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li class="active"><a href="<?php echo base_url('administrator/banner') ?>">Manage Banner</a></li>
					<li><a href="<?php echo base_url('administrator/banner/bannerAdd') ?>">Add Banner</a></li>
				</ul>
			</li>

			<li class="treeview">
				<a href="#"><i class='fa fa-link'></i> <span>Content Management</span> <i
						class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li class="active"><a href="<?php echo base_url('administrator/content') ?>">Manage Content</a></li>
					<li><a href="<?php echo base_url('administrator/content/contentAdd') ?>">Add Content</a></li>
				</ul>
			</li>

			<li class="treeview">
				<a href="#"><i class='fa fa-link'></i> <span>Menu Management</span> <i
						class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li class="active"><a href="<?php echo base_url('administrator/menu') ?>">Manage Menu</a></li>
					<li><a href="<?php echo base_url('administrator/menu/menuAdd') ?>">Add Menu</a></li>
				</ul>
			</li>

			<li class="treeview">
				<a href="<?php echo base_url('administrator/referrer') ?>"><i class='fa fa-link'></i> <span>Faq Management</span>
					<i class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li class="active"><a href="<?php echo base_url('administrator/faq') ?>">Manage Faq</a></li>
				</ul>
			</li>

			<li class="treeview">
				<a href="<?php echo base_url('administrator/referrer') ?>"><i class='fa fa-link'></i> <span>Process Management</span>
					<i class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li class="active"><a href="<?php echo base_url('administrator/process') ?>">Manage Process</a></li>
				</ul>
			</li>

			<li class="treeview">
				<a href="<?php echo base_url('administrator/referrer') ?>"><i class='fa fa-link'></i> <span>Social Media Management</span>
					<i class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li class="active"><a href="<?php echo base_url('administrator/social') ?>">Manage Social Media</a>
					</li>
				</ul>
			</li>

			<li class="treeview">
				<a href="<?php echo base_url('administrator/referrer') ?>"><i class='fa fa-link'></i> <span>Contact Management</span>
					<i class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li class="active"><a href="<?php echo base_url('administrator/contact') ?>">Update Contact</a></li>
				</ul>
			</li>

			<li class="treeview">
				<a href="<?php echo base_url('administrator/referrer') ?>"><i class='fa fa-link'></i> <span> Theme Option</span>
					<i class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li class="active"><a href="<?php echo base_url('administrator/themeoption') ?>">Manage Theme
							Option</a></li>
				</ul>
			</li>

		</ul>
		<!-- /.sidebar-menu -->
	</section>
	<!-- /.sidebar -->
</aside>