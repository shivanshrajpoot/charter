<div class="wrapper">
	<?php include_once(APPPATH.'views/admin/templates/main-header.php'); ?>
	<?php include_once(APPPATH.'views/admin/templates/sidebar.php'); ?>
	<?php include_once(APPPATH.'views/charter/modals/create-aircraft.php'); ?>
	<div class="main-panel">
		<div class="content">
			<div class="container-fluid">
				<h4 class="page-title">Aircrafts Available</h4>
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#createAircraft">
									<i class="la la-plus"></i>Create New
								</button>
								<div class="card-title">Please add aircrafts for submitting quotes...</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-hover">
										<thead>
											<tr>
												<th scope="col">#</th>
												<th scope="col">Name</th>
												<th scope="col">Image</th>
												<th scope="col">Created By</th>
												<th scope="col"></th>
											</tr>
										</thead>
										<tbody>
											<?php if (!empty($aircrafts)): ?>
												<?php foreach ($aircrafts as $index => $aircraft): ?>
													<tr>
														<td><?php echo $index+1; ?></td>
														<td><?php echo $aircraft['name']; ?></td>
														<td><img src="<?php _url('uploads/aircrafts/thumb_'.$aircraft['image']); ?>" alt="Aircraft Image" style="max-height: 100px;"></td>
														<td><?php echo $aircraft['user_name']; ?></td>
														<td style="text-align: center;">
															<?php if ($aircraft['user_id'] == $this->user_session['id']): ?>
																<button type="button" data-target="<?php echo $aircraft['id']; ?>" class="btn btn-danger delete-aircraft" ><i class="la la-close"></i></button>
																<button type="button" data-target="<?php echo $aircraft['id']; ?>" class="btn btn-success edit-aircraft" ><i class="la la-edit"></i></button>
															<?php endif ?>
														</td>
													</tr>
												<?php endforeach ?>
											<?php endif ?>
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