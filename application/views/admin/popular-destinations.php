<div class="wrapper">
	<?php include_once(APPPATH.'views/admin/templates/main-header.php'); ?>
	<?php include_once(APPPATH.'views/admin/templates/sidebar.php'); ?>
	<?php include_once(APPPATH.'views/admin/modals/create-destination.php'); ?>
	<div class="main-panel">
		<div class="content">
			<div class="container-fluid">
				<h4 class="page-title">Popular Destinations</h4>
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#createDestination">
									<i class="la la-plus"></i>Create New
								</button>
								<div class="card-title">Please add popular destinations for website to reflect on the front-end...</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-hover">
										<thead>
											<tr>
												<th scope="col">#</th>
												<th scope="col">Name</th>
												<th scope="col">Image</th>
												<th scope="col">Description</th>
												<th scope="col"></th>
											</tr>
										</thead>
										<tbody>
											<?php if (!empty($popular_destination)): ?>
												<?php foreach ($popular_destination as $index => $destination): ?>
													<tr>
														<td><?php echo $index+1; ?></td>
														<td><?php echo $destination['title']; ?></td>
														<td><img src="<?php _url('uploads/destinations/thumb_'.$destination['image']); ?>" alt="Destination Image" style="max-height: 100px;"></td>
														<td><?php echo $destination['description']; ?></td>
														<td style="text-align: center;">
															<button type="button" data-target="<?php echo $destination['id']; ?>" class="btn btn-danger delete-destination" ><i class="la la-close"></i></button>
															<button type="button" data-target="<?php echo $destination['id']; ?>" class="btn btn-success edit-destination" ><i class="la la-edit"></i></button>
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