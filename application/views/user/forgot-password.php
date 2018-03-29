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
						<span class="intro-text-small">Please enter details to recover your password...</span>
						<h1>Password Recovery</h1> 
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
				<h3>Forgot Password <small>
					<span class="la la-info" data-toggle="tooltip" title="Enter your email address and we’ll send you a password reset link."></span></small>
				</h3>					

					<?php echo form_open(); ?>
						<div class="row form-group">
							<div class="row form-group">
								<div class="col-md-12">
									<label class="sr-only" for="email">Email</label>
									<input type="text" id="login_email" name="email" class="form-control" placeholder="Your email address" required autocomplete autofocus maxlength="50" value="<?php echo set_value('username'); ?>">
								</div>
							</div>
							<div class="row form-group">
								<div class="col-md-12">
									<?php echo validation_errors('<span class="text-danger">','</span>'); ?>
									<span class="text-warning">
										<?php echo @$this->session->flashdata('msg') ? @$this->session->flashdata('msg') : '' ?>
									</span>
										
								</div>
							</div>
							<div class="form-group">
								<input type="submit" value="Submit" class="btn btn-outline-warning">
								<a href="<?php _url('login') ?>" class="btn btn-link pull-right" >Log In</a>
							</div>
						</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>