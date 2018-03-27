<div class="wrapper">
	<?php include_once(APPPATH.'views/admin/templates/main-header.php'); ?>
	<?php include_once(APPPATH.'views/admin/templates/sidebar.php'); ?>
	<?php include_once(APPPATH.'views/admin/modals/create-charter.php'); ?>
	<?php include_once(APPPATH.'views/admin/modals/assign-user.php'); ?>
	<div class="main-panel">
		<div class="content">
			<div class="container-fluid">
				<h4 class="page-title">Charters</h4>
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#createCharter">
									<i class="la la-plus"></i>Create New
								</button>
								<div class="card-title">Available Charters</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-hover">
										<thead>
											<tr>
												<th scope="col">#</th>
												<th scope="col">Name</th>
												<th scope="col">Quote Email</th>
												<th scope="col">Lattitude</th>
												<th scope="col">Longitude</th>
												<th scope="col">Service Area</th>
												<th scope="col"></th>
											</tr>
										</thead>
										<tbody>
											<?php if (!empty($charters)): ?>
												<?php foreach ($charters as $index => $charter): ?>
													<tr>
														<td><?php echo $index+1; ?></td>
														<td><?php echo $charter['name']; ?></td>
														<td><?php echo $charter['email']; ?></td>
														<td><?php echo $charter['lat']; ?></td>
														<td><?php echo $charter['long']; ?></td>
														<td><?php echo $charter['area']; ?></td>
														<td style="text-align: center;">
															<button type="button" data-toggle="tooltip" data-title="Delete User" data-target="<?php echo $charter['id']; ?>" class="btn btn-danger delete-charter" ><i class="la la-close"></i></button>
															<button type="button" data-toggle="tooltip" data-title="Edit User" data-target="<?php echo $charter['id']; ?>" class="btn btn-success edit-charter" ><i class="la la-edit"></i></button>
															<button <?php echo $charter['user_id'] > 0 ? 'disabled' : '' ?>
															 type="button" data-toggle="tooltip" data-title="Assign User" data-target="<?php echo $charter['id']; ?>" class="btn btn-<?php echo $charter['user_id'] > 0 ? 'default' : 'info' ?> assign-charter" ><i class="la la-user<?php echo $charter['user_id'] > 0 ? '' : '-plus' ?>"></i></button>
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