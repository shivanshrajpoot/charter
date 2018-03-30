<div class="main-header">
	<div class="logo-header">
		<a href="<?php _url('charter/dashboard'); ?>" class="logo">
			Charter Dashboard
		</a>
		<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
	</div>
	<nav class="navbar navbar-header navbar-expand-lg">
		<div class="container-fluid">
			<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
				<li class="nav-item dropdown">
					<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false"> <img src="<?php _url('assets/img/user.png');?>" alt="user-img" width="36" class="img-circle"><span ><?php echo $first_name.' '.$last_name; ?></span>
					</a>
					<ul class="dropdown-menu dropdown-user">
						<li>
							<div class="user-box">
								<div class="u-img"><img src="<?php _url('assets/img/user.png');?>" alt="user"></div>
								<div class="u-text">
									<h4><?php echo $first_name.''.$last_name; ?></h4>
									<p class="text-muted"><?php echo $email; ?></p><a href="<?php _url('my-profile'); ?>" class="btn btn-rounded btn-danger btn-sm">View Profile</a>
								</div>
							</div>
						</li>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="" data-url="<?php _url('logout'); ?>"onclick="return logOut(this);"><i class="fa fa-power-off"></i> Logout</a>
					</ul>
						<!-- /.dropdown-user -->
				</li>
			</ul>
		</div>
	</nav>
</div>