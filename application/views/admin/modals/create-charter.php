<!-- Modal -->
<div class="modal fade" id="createCharter" tabindex="-1" role="dialog" aria-labelledby="createCharter" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h6 class="modal-title">Create New Charter</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-center">
				<div class="animate-box">
					<?php echo validation_errors(); ?>
					<span class="text-success"><?php echo !empty($msg) ? $msg : '';?></span>
					<?php echo form_open('admin/create-charter',['role'=>"submit-charter"]); ?>
						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="name">Name</label>
								<input type="text" id="name" name="name" class="form-control" placeholder="Charter name" required autocomplete autofocus maxlength="15" value="<?php echo set_value('name'); ?>">
							</div>
							
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="email">Email</label>
								<input type="text" id="email" name="email" class="form-control" placeholder="Email address" required autocomplete autofocus maxlength="50" value="<?php echo set_value('email'); ?>">
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-6">
								<label class="sr-only" for="lat">Lattitude</label>
								<input type="tel" id="lat" class="form-control" name="lat" placeholder="Lattitude" autocomplete autofocus maxlength="12" value="<?php echo set_value('lat'); ?>">
							</div>
							<div class="col-md-6">
								<label class="sr-only" for="long">Longitude</label>
								<input type="tel" id="long" class="form-control" name="long" placeholder="Longitude" autocomplete autofocus maxlength="12" value="<?php echo set_value('long'); ?>">
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="area">Service Area</label>
								<input type="text" id="area" name="area" class="form-control" placeholder="Service Area" required autocomplete autofocus maxlength="50" value="<?php echo set_value('area'); ?>">
							</div>
						</div>
					<?php echo form_close(); ?>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-success" data-request="ajax-submit" data-target='[role="submit-charter"]'>Save</button>
			</div>
		</div>
	</div>
</div>