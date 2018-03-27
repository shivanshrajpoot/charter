<div class="wrapper">
	<?php include_once(APPPATH.'views/charter/templates/main-header.php'); ?>
	<?php include_once(APPPATH.'views/charter/templates/sidebar.php'); ?>
	<?php include_once(APPPATH.'views/charter/modals/submit-price.php'); ?>
	<div class="main-panel">
		<div class="content">
			<div class="container-fluid">
				<h4 class="page-title">Quotes Submitted By You</h4>
				<div class="row">
					<div class="col-md-12">
						<div class="card card-tasks">
							<div class="card-header ">
								<h4 class="card-title">Quotes</h4>
								<p class="card-category">Quotes can be managed here...</p>
							</div>
							<div class="card-body ">
								<div class="table-responsive">
									<table class="table">
										<thead>
											<tr>
												<th>
													<div class="form-check">
														<label class="form-check-label">
															<input class="form-check-input  select-all-checkbox" type="checkbox" data-select="checkbox" data-target=".task-select">
															<span class="form-check-sign"></span>
														</label>
													</div>
												</th>
												<th>Aircraft</th>
												<th>Flight Time</th>
												<th>Origin</th>
												<th>Destination</th>
												<th>Price</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($quotes as $key => $quote): ?>
												<tr>
													<td>
														<div class="form-check">
															<label class="form-check-label">
																<input class="form-check-input task-select" type="checkbox">
																<span class="form-check-sign"></span>
															</label>
														</div>
													</td>
													<td><?php echo $quote['aircraft_id'];?></td>
													<td><?php echo $quote['flight_time'];?></td>
													<td><?php echo $quote['origin'];?></td>
													<td><?php echo $quote['destination'];?></td>
													<td><?php echo $quote['price'];?></td>
													<td style="text-align: center;">
														<button type="button" data-target="<?php echo $quote['id']; ?>" class="btn btn-danger delete-quote" ><i class="la la-close"></i></button>
													</td>
												</tr>
											<?php endforeach ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>