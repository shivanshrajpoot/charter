<div class="sidebar">
	<div class="scrollbar-inner sidebar-wrapper">
		<div class="user">
			<div class="photo">
				<img src="<?php _url('assets/img/user.png');?>">
			</div>
			<div class="info">
				<a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
					<span>
						<?php echo $userdata['first_name'].' '.$userdata['last_name']; ?>
						<span class="user-level">User</span>
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
			<li class="nav-item <?php echo $this->uri->segment(2)=='dashboard' ? 'active' :'' ;?> ">
				<a href="<?php _url('user/dashboard')?>">
					<i class="la la-dashboard"></i>
					<p>My Requests</p>
					<span class="badge badge-count"><?php echo $this->user_session['requests']; ?></span>
				</a>
			</li>
		</ul>
	</div>
</div>