<div class="wrapper">
	<?php include_once(APPPATH.'views/charter/templates/main-header.php'); ?>
	<?php include_once(APPPATH.'views/charter/templates/sidebar.php'); ?>
	<?php include_once(APPPATH.'views/charter/modals/submit-price.php'); ?>
	<div class="main-panel">
		<div class="content">
			<div class="container-fluid">
				<h4 class="page-title">Price Requests Recieved</h4>
				<div class="row">
					<div class="col-md-12">
						<div class="card card-tasks">
							<div class="card-header ">
								<h4 class="card-title">Requests</h4>
								<p class="card-category">Please update requests as per requirement...</p>
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
												<th>From</th>
												<th>To</th>
												<th>Departure Date</th>
												<th>Departure Time</th>
												<th>No. of Passengers</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($requests as $key => $request): ?>
												<tr>
													<td>
														<div class="form-check">
															<label class="form-check-label">
																<input class="form-check-input task-select" type="checkbox">
																<span class="form-check-sign"></span>
															</label>
														</div>
													</td>
													<td><?php echo $request['to'];?></td>
													<td><?php echo $request['from'];?></td>
													<td><?php echo $request['dep_date'];?></td>
													<td><?php echo $request['dep_time'];?></td>
													<td><?php echo $request['no_of_pass'];?></td>
													<td class="td-actions text-right">
														<div class="form-button-action">
															<?php if ($request['is_requested']): ?>
																<button type="button" class="btn btn-outline-warning" disabled>
																	Already Submitted
																</button>
															<?php else: ?>	
																<button data-id="<?php echo $request['id'];?>" type="button" data-toggle="modal" data-target="#submitPrice" class="btn btn-primary">
																	Submit Price
																</button>
															<?php endif ?>
														</div>
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