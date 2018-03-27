<div class="sidebar">
	<div class="scrollbar-inner sidebar-wrapper">
		<div class="user">
			<div class="photo">
				<img src="<?php _url('assets/img/profile.jpg');?>">
			</div>
			<div class="info">
				<a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
					<span>
						<?php echo $first_name.' '.$last_name; ?>
						<span class="user-level">Charter</span>
						<span class="caret"></span>
					</span>
				</a>
				<div class="clearfix"></div>

				<div class="collapse in" id="collapseExample" aria-expanded="true" style="">
					<ul class="nav">
						<li>
							<a href="#profile">
								<span class="link-collapse">My Profile</span>
							</a>
						</li>
						<li>
							<a href="#edit">
								<span class="link-collapse">Edit Profile</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<ul class="nav">
			<li class="nav-item <?php echo $this->uri->segment(2)=='dashboard' ? 'active' :'' ;?> ">
				<a href="<?php _url('charter/dashboard')?>">
					<i class="la la-dashboard"></i>
					<p>Dashboard</p>
					<span class="badge badge-count">5</span>
				</a>
			</li>
			<li class="nav-item <?php echo $this->uri->segment(2)=='requests' ? 'active' :'' ;?>">
				<a href="<?php _url('charter/requests')?>">
					<i class="la la-table"></i>
					<p>View Price Requests</p>
					<span class="badge badge-count"><?php echo $count_info['requests']; ?></span>
				</a>
			</li>
			<li class="nav-item <?php echo $this->uri->segment(2)=='quotes' ? 'active' :'' ;?>">
				<a href="<?php _url('charter/quotes')?>">
					<i class="la la-table"></i>
					<p>View Quotes</p>
					<span class="badge badge-count"><?php echo $count_info['quotes']; ?></span>
				</a>
			</li>
			<li class="nav-item <?php echo $this->uri->segment(2)=='aircrafts' ? 'active' :'' ;?>">
				<a href="<?php _url('charter/aircrafts')?>">
					<i class="la la-table"></i>
					<p>View Aircrafts</p>
					<span class="badge badge-count"><?php echo $count_info['aircrafts']; ?></span>
				</a>
			</li>
		</ul>
	</div>
</div>