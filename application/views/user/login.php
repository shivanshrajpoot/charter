<div class="gtco-loader"></div>
	
<div id="page">


<!-- <div class="page-inner"> -->
<header id="gtco-header" class="gtco-cover gtco-cover-sm" role="banner" style="background-image: url(images/img_bg_3.jpg)">
	<div class="overlay"></div>
	<div class="gtco-container">
		<div class="row">
			<div class="col-md-12 col-md-offset-0 text-left">
				<div class="row row-mt-15em">

					<div class="col-md-7 mt-text animate-box" data-animate-effect="fadeInUp">
						<span class="intro-text-small">Please login to proceed.</span>
						<h1>Login</h1> 
					</div>
				</div>
				
			</div>
		</div>
	</div>
</header>


<div class="gtco-section border-bottom">
	<div class="gtco-container">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-6 animate-box">
				<h3>Login</h3>
					<?php echo validation_errors(); ?>
					<?php echo form_open('login'); ?>
						<div class="row form-group">
							<div class="row form-group">
								<div class="col-md-12">
									<label class="sr-only" for="email">Email</label>
									<input type="text" id="login_email" name="username" class="form-control" placeholder="Your email address" required autocomplete autofocus maxlength="50" value="<?php echo set_value('username'); ?>">
								</div>
							</div>
							<div class="row form-group">
								<div class="col-md-12">
									<label class="sr-only" for="subject">Password</label>
									<input type="password" id="login_password" class="form-control" name="password" placeholder="Enter Password" required autocomplete autofocus maxlength="25" minlength="8" value="">
								</div>
							</div>
							<div class="form-group">
								<input type="submit" value="Login" class="btn btn-primary">
							</div>
						</div>
					<?php echo form_close(); ?>
				</div>

				<div class="col-md-5 col-md-push-1 animate-box">
					<div class="gtco-contact-info">
						<h3>Login With Facebook</h3>
						<ul>
							<li class="url">
								<a href="<?php get_fb_login_url(); ?>" class="btn btn-primary">Facebook Login</a>
							</li>
							<!-- <li class="url">
								<fb:login-button 
								  scope="public_profile,email"
								  onlogin="checkLoginState();">
								</fb:login-button>
							</li> -->
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>