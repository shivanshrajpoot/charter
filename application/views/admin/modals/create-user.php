<!-- Modal -->
<div class="modal fade" id="createUser" tabindex="-1" role="dialog" aria-labelledby="createUser" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h6 class="modal-title">Create New User</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-center">
				<div class="animate-box">
					<?php echo validation_errors(); ?>
					<span class="text-success"><?php echo !empty($msg) ? $msg : '';?></span>
					<?php echo form_open('admin/create-user',['role'=>"submit-user"]); ?>
						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="email">Email</label>
								<input type="text" id="email" name="email" class="form-control" placeholder="Email address" required autocomplete autofocus maxlength="50" value="<?php echo set_value('email'); ?>">
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-6">
								<label class="sr-only" for="name">First Name</label>
								<input type="text" id="name" name="first_name" class="form-control" placeholder="First name" required autocomplete autofocus maxlength="15" value="<?php echo set_value('first_name'); ?>">
							</div>
							<div class="col-md-6">
								<label class="sr-only" for="name">Last Name</label>
								<input type="text" id="name" name="last_name" class="form-control" placeholder="Last name" required autocomplete autofocus maxlength="15" value="<?php echo set_value('last_name'); ?>">
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="contact">Contact</label>
								<input type="tel" id="contact" class="form-control" name="contact" placeholder="Contact" autocomplete autofocus maxlength="12" value="<?php echo set_value('contact'); ?>">
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-6">
								<label class="sr-only" for="password">Password</label>
								<input type="text" id="password" class="form-control" name="password" placeholder="Password" autocomplete autofocus maxlength="12" value="<?php echo set_value('password'); ?>">
							</div>
							<div class="col-md-6">
								<label class="sr-only" for="password_conf">Confirm Password</label>
								<input type="password" id="password_conf" class="form-control" name="password_conf" placeholder="Confirm Password" autocomplete autofocus maxlength="12" value="<?php echo set_value('password_conf'); ?>">
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-4">
								<label class="sr-only" for="gender">Gender</label>
								<select required name="gender" id="gender" class="form-control" >
									<option value="m">Male</option>
									<option value="f">Female</option>
								</select>
							</div>
							<div class="col-md-4">
								<label class="sr-only" for="type">User Type</label>
								<select required name="type" id="type" class="form-control" >
									<option class="text-info" value="3">User</option>
									<option class="text-success" value="2">Charter</option>
								</select>
							</div>
							<div class="col-md-4">
								<label class="sr-only" for="status">Status</label>
								<select required name="status" id="status" class="form-control" >
									<option class="text-info" value="active">Active</option>
									<option class="text-warning" value="inactive">In-active</option>
									<option class="text-danger" value="deleted">Deleted</option>
								</select>
							</div>
						</div>
					<?php echo form_close(); ?>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-success" data-request="ajax-submit" data-target='[role="submit-user"]'>Save</button>
			</div>
		</div>
	</div>
</div>