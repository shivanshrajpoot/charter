<nav class="gtco-nav" role="navigation">
	<div class="gtco-container">
		
		<div class="row">
			<div class="col-sm-4 col-xs-12">
				<div id="gtco-logo"><a href="<?php $dashboard_url = $this->session->userdata('dashboard_url'); _url(); ?>"><?php echo WEBSITE_NAME; ?> <em>.</em></a></div>
			</div>
			<div class="col-xs-8 text-right menu-1">
				<ul>
					<li class="has-dropdown">
						<?php if (empty($dashboard_url)): ?>
							<a href="#">Register/Sign In</a>
							<ul class="dropdown">
								<li><a href="<?php _url('register');?>">Register</a></li>
								<li><a href="<?php _url('login');?>">Log In</a></li>
							</ul>
						<?php else: ?>
							<a href="<?php echo @$dashboard_url?@$dashboard_url:_url(); ?> ">My Account</a>
							<button onclick="logOut();">Log Out</button>
						<?php endif ?>
					</li>
				</ul>	
			</div>
		</div>
		
	</div>
</nav>