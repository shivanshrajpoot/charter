<!-- Modal -->
<div class="modal fade" id="submitPrice" tabindex="-1" role="dialog" aria-labelledby="submitPrice" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h6 class="modal-title">Submit Price</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-center">
				<div class="animate-box">
					<span class="text-success"><?php echo !empty($msg) ? $msg : '';?></span>
					<?php echo form_open('charter/submit-price',['role'=>"submit-price"]); ?>
						<div class="row form-group">
							<div class="col-md-12">
								<label for="name">Aircraft</label>
								<select required name="aircraft_id" id="aircraft_id" class="form-control" >
									<?php if (!empty($aircrafts)): ?>
										<?php foreach ($aircrafts as $key => $aircraft): ?>
											<option value="<?php echo $aircraft['id']; ?>"><?php echo $aircraft['name']; ?></option>
										<?php endforeach ?>
									<?php else: ?>
											<option value="" disabled>Please Create An Aircraft</option>
									<?php endif ?>
								</select>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-6">
								<label for="flight_time">Flight Time</label>
								<input required type="time" id="flight_time" class="form-control" name="flight_time" placeholder="Flight Time" autocomplete autofocus value="<?php echo set_value('flight_time'); ?>">
							</div>
							<div class="col-md-6">
								<label for="price">Price</label>
								<input type="number" id="price" name="price" class="form-control" placeholder="Price" required autocomplete autofocus maxlength="50" value="<?php echo set_value('price'); ?>">
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-6">
								<label for="origin">Origin Heliport</label>
								<input type="text" id="origin" class="form-control" name="origin" placeholder="Origin Heliport" required autocomplete autofocus onfocus="geolocate(this)" value="<?php echo set_value('origin'); ?>">
							</div>
							<div class="col-md-6">
								<label for="destination">Destination Heliport</label>
								<input type="text" id="destination" class="form-control" name="destination" placeholder="Destination Heliport" required autocomplete autofocus onfocus="geolocate(this)" value="<?php echo set_value('destination'); ?>">
							</div>
							<input type="hidden" name="request_id" id="request_id">
						</div>
					<?php echo form_close(); ?>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-success submit-price" data-request="ajax-submit" data-target='[role="submit-price"]'>Submit</button>
			</div>
		</div>
	</div>
</div>