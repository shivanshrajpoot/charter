<div class="content login">
	<div class="container-fluid">
	<h4 class="page-title">Charter | Admin</h4>
	<div class="row">
		<div class="col-md-6">
			<?php echo form_open(); ?>
			<div class="card">
				<div class="card-header">
					<div class="card-title">Login to continue</div>
				</div>
				<div class="card-body">
				<?php echo validation_errors(); ?>
				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" class="form-control" id="username" name="username" placeholder="Enter Username">
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" class="form-control" id="password" name="password" placeholder="Password">
				</div>
				<div class="form-check">
					<label class="form-check-label">
					<input class="form-check-input" name="remember_me" type="checkbox" value="true">
					<span class="form-check-sign">Keep me logged in</span>
				</label>
				</div>
				</div>
				<div class="card-action">
				<button class="btn btn-success">Submit</button>
				<button class="btn btn-danger">Cancel</button>
				</div>
			</div>
			<?php echo form_close(); ?>+.
		</div>
	</div>
	</div>
</div>