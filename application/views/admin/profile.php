<div class="wrapper">
	<?php include_once(APPPATH.'views/admin/templates/main-header.php'); ?>
	<?php include_once(APPPATH.'views/admin/templates/sidebar.php'); ?>
	<div class="main-panel">
		<div class="content">
			<div class="container-fluid">
				<h4 class="page-title">My Profile</h4>
				<div class="row">
					<div class="col-md-12">
						<div class="card">
						<div class="card-header">
							<div class="card-title">User Details</div>
						</div>
						<div class="card-body">
							<?php echo form_open(); ?>
								<div class=" form-group">
									<div class="col-md-12">
										<label class="sr-only" for="name">First Name</label>
										<input type="text" id="first_name" name="first_name" class="form-control" placeholder="Your first name" required autofocus maxlength="15" value="<?php echo $userdata ? $userdata['first_name'] : set_value('first_name'); ?>">
										<?php echo form_error('first_name','<span class="text-danger">','</span>'); ?>
									</div>
									
								</div>
								<div class=" form-group">
									<div class="col-md-12">
										<label class="sr-only" for="name">Last Name</label>
										<input type="text" id="last_name" name="last_name" class="form-control" placeholder="Your Last name" required autofocus maxlength="15" value="<?php echo $userdata ? $userdata['last_name'] : set_value('last_name'); ?>">
										<?php echo form_error('last_name','<span class="text-danger">','</span>'); ?>
									</div>
									
								</div>

								<div class=" form-group">
									<div class="col-md-12">
										<label class="sr-only" for="email">Email</label>
										<input type="text" id="email" name="email" class="form-control" placeholder="Your email address" required autofocus maxlength="50" value="<?php echo $userdata ? $userdata['email'] : set_value('email'); ?>">
										<?php echo form_error('email','<span class="text-danger">','</span>'); ?>
									</div>
								</div>

								<div class=" form-group">
									<div class="col-md-12">
										<label class="sr-only" for="subject">Password</label>
										<input type="password" id="password" class="form-control" name="password" placeholder="Enter Password" required autofocus maxlength="25" minlength="8" value="">
										<?php echo form_error('password','<span class="text-danger">','</span>'); ?>
									</div>
								</div>
								<div class=" form-group">
									<div class="col-md-12">
										<label class="sr-only" for="subject">Confirm Password</label>
										<input type="password" id="password_conf" class="form-control" name="password_conf" placeholder="Confirm Password" required autofocus maxlength="25" minlength="8" value="">
										<?php echo form_error('password_conf','<span class="text-danger">','</span>'); ?>
									</div>
								</div>
								<div class=" form-group">
									<div class="col-md-12">
										<label class="sr-only" for="subject">Contact No.</label>
										<input type="tel" id="contact" class="form-control" name="contact" placeholder="Contact Number" autofocus maxlength="12" minlength="8" value="<?php echo $userdata ? $userdata['contact'] : set_value('contact'); ?>">
										<?php echo form_error('contact','<span class="text-danger">','</span>'); ?>
									</div>
								</div>
								<div class="form-group form-check">
									<label>Gender:</label><br>
									<label class="form-radio-label">
										<input type="radio" id="male" class="form-radio-input" name="gender" required autofocus value="m" <?php echo  $userdata['gender']=='m' ? 'checked' : set_radio('gender', 'm', TRUE); ?> >
										<span class="form-radio-sign">Male</span>
									</label>
									<label class="form-radio-label ml-3">
										<input type="radio" id="female" class="form-radio-input" name="gender" required autofocus value="f" <?php echo $userdata['gender']=='f' ? 'checked' : set_radio('gender', 'f'); ?> >
										<span class="form-radio-sign">Female</span>
									</label>
									<label class="form-radio-label ml-3">
										<input type="radio" id="other" class="form-radio-input" name="gender" required autofocus value="o" <?php echo  $userdata['gender']=='o' ? 'checked' : set_radio('gender', 'o'); ?> >
										<span class="form-radio-sign">Other</span>
									</label>
								</div>
								<div class="form-group pull-right">
									<input type="submit" value="Update" class="btn btn-lg btn-primary">
									<input type="hidden" value="<?php echo $userdata['id']; ?>" name="user_id">
								</div>
							<?php echo form_close(); ?>
						</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>