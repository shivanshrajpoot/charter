<!-- Modal -->
<div class="modal fade" id="assignUser" tabindex="-1" role="dialog" aria-labelledby="assignUser" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h6 class="modal-title">Assign User</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-center">
				<div class="animate-box">
					<?php echo form_open('admin/assign-user',['role'=>"assign-user"]); ?>
						<div class="form-group">
							<label for="name">Name</label>
							<select class="form-control input-pill" id="name" name="user_id">
								<?php foreach ($users as $key => $user): ?>
									<option value="<?php echo $user['id']; ?>">
										<?php echo $user['first_name'].' '.$user['last_name']; ?>		
									</option>
								<?php endforeach ?>
							</select>
						</div>
					<?php echo form_close(); ?>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-success" data-request="ajax-submit" data-target='[role="assign-user"]'>Save</button>
			</div>
		</div>
	</div>
</div>