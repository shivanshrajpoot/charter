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
					<?php echo validation_errors('<span class="text-danger">','</span>'); ?>
					<span class="text-warning">
						<?php echo @$this->session->flashdata('msg') ? @$this->session->flashdata('msg') : '' ?>
					</span>
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
							<div class="form-group pull-right">
									<a class="btn btn-link pull-right" href="<?php _url('forgot-password'); ?>" >Forgot Password</a>
							</div>
							<div class="form-group">
								<input type="submit" value="Login" class="btn btn-success">
							</div>
						</div>
					<?php echo form_close(); ?>
				</div>

				<div class="col-md-5 col-md-push-1 animate-box">
					<div class="gtco-contact-info">
						<h3>Login With Facebook</h3>
						<div class="row form-group">
							<span class="la la-link"></span>	
							<a href="<?php get_fb_login_url(); ?>" class="btn btn-primary">Facebook Login</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>