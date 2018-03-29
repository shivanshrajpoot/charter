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
						<span class="intro-text-small">Don't be shy</span>
						<h1>Join Us</h1> </div>
					
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
				<h3>Register Here</h3>
				<?php echo validation_errors(); ?>
				<span class="text-success"><?php echo !empty($msg) ? $msg : '';?></span>
				<?php echo form_open(); ?>
					<div class="row form-group">
						<div class="col-md-12">
							<label class="sr-only" for="name">First Name</label>
							<input type="text" id="first_name" name="first_name" class="form-control" placeholder="Your first name" required autocomplete autofocus maxlength="15" value="<?php echo set_value('first_name'); ?>">
							<?php echo form_error('first_name','<span class="text-danger">','</span>'); ?>
						</div>
						
					</div>
					<div class="row form-group">
						<div class="col-md-12">
							<label class="sr-only" for="name">Last Name</label>
							<input type="text" id="last_name" name="last_name" class="form-control" placeholder="Your Last name" required autocomplete autofocus maxlength="15" value="<?php echo set_value('last_name'); ?>">
							<?php echo form_error('last_name','<span class="text-danger">','</span>'); ?>
						</div>
						
					</div>

					<div class="row form-group">
						<div class="col-md-12">
							<label class="sr-only" for="email">Email</label>
							<input type="text" id="email" name="email" class="form-control" placeholder="Your email address" required autocomplete autofocus maxlength="50" value="<?php echo set_value('email'); ?>">
							<?php echo form_error('email','<span class="text-danger">','</span>'); ?>
						</div>
					</div>

					<div class="row form-group">
						<div class="col-md-12">
							<label class="sr-only" for="subject">Password</label>
							<input type="password" id="password" class="form-control" name="password" placeholder="Enter Password" required autocomplete autofocus maxlength="25" minlength="8" value="">
							<?php echo form_error('password','<span class="text-danger">','</span>'); ?>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-12">
							<label class="sr-only" for="subject">Confirm Password</label>
							<input type="password" id="password_conf" class="form-control" name="password_conf" placeholder="Confirm Password" required autocomplete autofocus maxlength="25" minlength="8" value="">
							<?php echo form_error('password_conf','<span class="text-danger">','</span>'); ?>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-12">
							<label class="sr-only" for="subject">Contact No.</label>
							<input type="tel" id="contact" class="form-control" name="contact" placeholder="Contact Number" autocomplete autofocus maxlength="12" minlength="8" value="<?php echo set_value('contact'); ?>">
							<?php echo form_error('contact','<span class="text-danger">','</span>'); ?>
						</div>
					</div>
					<div class="form-group form-check">
						<label>Gender:</label><br>
						<label class="form-radio-label">
							<input type="radio" id="male" class="form-radio-input" name="gender" required autofocus value="m" <?php echo  set_radio('gender', 'm', TRUE); ?> >
							<span class="form-radio-sign">Male</span>
						</label>
						<label class="form-radio-label ml-3">
							<input type="radio" id="female" class="form-radio-input" name="gender" required autofocus value="f" <?php echo  set_radio('gender', 'f'); ?> >
							<span class="form-radio-sign">Female</span>
						</label>
						<label class="form-radio-label ml-3">
							<input type="radio" id="other" class="form-radio-input" name="gender" required autofocus value="o" <?php echo  set_radio('gender', 'o'); ?> >
							<span class="form-radio-sign">Other</span>
						</label>
					</div>
					<div class="form-group">
						<input type="submit" value="Register" class="btn btn-primary">
					</div>
				<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>