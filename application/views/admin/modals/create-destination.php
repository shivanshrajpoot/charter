<!-- Modal -->
<div class="modal fade" id="createDestination" tabindex="-1" role="dialog" aria-labelledby="createDestination" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h6 class="modal-title">Create New Destination</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-center">
				<div class="animate-box">
					<?php echo validation_errors(); ?>
					<span class="text-success"><?php echo !empty($msg) ? $msg : '';?></span>
					<?php echo form_open_multipart('admin/create-destination',['role'=>"submit-destination"]); ?>
						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="title">Title</label>
								<input type="text" id="title" name="title" class="form-control" placeholder="Destination title" required autocomplete autofocus maxlength="15" value="<?php echo set_value('title'); ?>">
							</div>
							
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="description">Description</label>
								<input type="text" id="description" name="description" class="form-control" placeholder="Destination description" required autocomplete autofocus value="<?php echo set_value('description'); ?>">
							</div>
							
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="image">Image</label>
								<input type="file" id="image" name="image" class="form-control" placeholder="Image" required autocomplete autofocus maxlength="50" value="<?php echo set_value('image'); ?>"  accept="image/*">
								<small>Standar Size 800x600 px</small>
							</div>
						</div>
					<?php echo form_close(); ?>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-success" data-request="ajax-submit" data-target='[role="submit-destination"]'>Save</button>
			</div>
		</div>
	</div>
</div>