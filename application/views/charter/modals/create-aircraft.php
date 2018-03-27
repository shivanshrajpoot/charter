<!-- Modal -->
<div class="modal fade" id="createAircraft" tabindex="-1" role="dialog" aria-labelledby="createAircraft" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h6 class="modal-title">Create New Aircraft</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-center">
				<div class="animate-box">
					<?php echo validation_errors(); ?>
					<span class="text-success"><?php echo !empty($msg) ? $msg : '';?></span>
					<?php echo form_open_multipart('charter/create-aircraft',['role'=>"submit-aircraft"]); ?>
						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="name">Name</label>
								<input type="text" id="name" name="name" class="form-control" placeholder="Aircraft name" required autocomplete autofocus maxlength="15" value="<?php echo set_value('name'); ?>">
							</div>
							
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="image">Image</label>
								<input type="file" id="image" name="image" class="form-control" placeholder="Image" required autocomplete autofocus maxlength="50" value="<?php echo set_value('image'); ?>"  accept="image/*">
							</div>
						</div>
					<?php echo form_close(); ?>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-success" data-request="ajax-submit" data-target='[role="submit-aircraft"]'>Save</button>
			</div>
		</div>
	</div>
</div>