<div class="sidebar">
	<div class="scrollbar-inner sidebar-wrapper">
		<div class="user">
			<div class="photo">
				<img src="<?php _url('assets/img/profile.jpg');?>">
			</div>
			<div class="info">
				<a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
					<span>
						<?php echo $user['first_name'].' '.$user['last_name']; ?>
						<span class="user-level">Administrator</span>
						<span class="caret"></span>
					</span>
				</a>
				<div class="clearfix"></div>

				<div class="collapse in" id="collapseExample" aria-expanded="true" style="">
					<ul class="nav">
						<li>
							<a href="<?php _url('my-profile'); ?>">
								<span class="link-collapse">My Profile</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<ul class="nav">
			<li class="nav-item <?php echo $this->uri->segment(2)=='dashboard' ? 'active' :'' ;?>">
				<a href="<?php _url('admin/dashboard')?>">
					<i class="la la-dashboard"></i>
					<p>Dashboard</p>
					<span class="badge badge-count"></span>
				</a>
			</li>
			<li class="nav-item <?php echo $this->uri->segment(2)=='charters' ? 'active' :'' ;?>">
				<a href="<?php _url('admin/charters')?>">
					<i class="la la-table"></i>
					<p>Manage Charters</p>
					<span class="badge badge-count"><?php echo $count_info['charters'] ?></span>
				</a>
			</li>
			<li class="nav-item <?php echo $this->uri->segment(2)=='users' ? 'active' :'' ;?>">
				<a href="<?php _url('admin/users')?>">
					<i class="la la-table"></i>
					<p>Manage Users</p>
					<span class="badge badge-count"><?php echo $count_info['users']-1; ?></span>
				</a>
			</li>
			<li class="nav-item <?php echo $this->uri->segment(2)=='requests' ? 'active' :'' ;?>">
				<a href="<?php _url('admin/requests')?>">
					<i class="la la-table"></i>
					<p>Requests</p>
					<span class="badge badge-count"><?php echo $count_info['requests'] ?></span>
				</a>
			</li>
			<li class="nav-item <?php echo $this->uri->segment(2)=='aircrafts' ? 'active' :'' ;?>">
				<a href="<?php _url('admin/aircrafts')?>">
					<i class="la la-table"></i>
					<p>Aircrafts</p>
					<span class="badge badge-count"><?php echo $count_info['aircrafts'] ?></span>
				</a>
			</li>
			<li class="nav-item <?php echo $this->uri->segment(2)=='popular-destinations' ? 'active' :'' ;?>">
				<a href="<?php _url('admin/popular-destinations')?>">
					<i class="la la-table"></i>
					<p>Popular Destinations</p>
					<span class="badge badge-count"><?php echo $count_info['config'] ?></span>
				</a>
			</li>
			<li class="nav-item <?php echo $this->uri->segment(2)=='configure' ? 'active' :'' ;?>">
				<a href="<?php _url('admin/configure')?>">
					<i class="la la-table"></i>
					<p>Configuration</p>
					<span class="badge badge-count"><?php echo $count_info['config'] ?></span>
				</a>
			</li>
			<li class="nav-item <?php echo $this->uri->segment(2)=='email-templates' ? 'active' :'' ;?>">
				<a href="<?php _url('admin/email-templates')?>">
					<i class="la la-table"></i>
					<p>Email Templates</p>
					<span class="badge badge-count"><?php echo $count_info['email_templates'] ?></span>
				</a>
			</li>
			</li>
			<li class="nav-item <?php echo $this->uri->segment(2)=='static-content' ? 'active' :'' ;?>">
				<a href="<?php _url('admin/static-content')?>">
					<i class="la la-table"></i>
					<p>Static Content</p>
				</a>
			</li>
		</ul>
	</div>
</div>