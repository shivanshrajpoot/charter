<div class="wrapper">
	<?php include_once(APPPATH.'views/admin/templates/main-header.php'); ?>
	<?php include_once(APPPATH.'views/admin/templates/sidebar.php'); ?>
	<div class="main-panel">
		<div class="content">
			<div class="container-fluid">
				<h4 class="page-title">Contact Us Reply</h4>
				<div class="row">
					<div class="col-md-6">
						<div class="card">
						<div class="card-header">
							<div class="card-title">Details</div>
						</div>
						<div class="card-body">
							<div class="form-group">
								<label class="control-label text-default">Email</label>
								<p class="form-control-static text-info pull-right"><?php echo $contact_us['email'] ?></p>
							</div>
							<div class="form-group">
								<label class="control-label text-default">Message</label>
								<p class="form-control-static text-info pull-right"><?php echo $contact_us['message'] ?></p>
							</div>
						</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="card">
						<div class="card-header">
							<div class="card-title">Reply</div>
						</div>
						<div class="card-body">
							<?php echo form_open(); ?>
								<div class=" form-group">
									<div class="col-md-12">
										<label for="name">Reply</label>
										<textarea id="reply" name="reply" class="form-control" placeholder="Reply Via Email" required autofocus>
										</textarea>
										<?php echo form_error('reply','<span class="text-danger">','</span>'); ?>
									</div>
								</div>
								<div class=" form-group">
									<div class="col-md-12">
										<button type="submit" class="btn btn-primary pull-right">Send</button>
									</div>
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