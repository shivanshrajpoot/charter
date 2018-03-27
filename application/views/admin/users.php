<div class="wrapper">
	<?php include_once(APPPATH.'views/admin/templates/main-header.php'); ?>
	<?php include_once(APPPATH.'views/admin/templates/sidebar.php'); ?>
	<?php include_once(APPPATH.'views/admin/modals/create-user.php'); ?>

	<div class="main-panel">
		<div class="content">
			<div class="container-fluid">
				<h4 class="page-title">Users</h4>
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#createUser">
									<i class="la la-plus"></i>Create New
								</button>
								<div class="card-title">Available Users</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">		
									<table class="table table-hover">
										<thead>
											<tr>
												<th scope="col">#</th>
												<th scope="col">Email</th>
												<th scope="col">First Name</th>
												<th scope="col">Last Name</th>
												<th scope="col">Contact No.</th>
												<th scope="col">Gender</th>
												<th scope="col">User Type</th>
												<th scope="col">Status</th>
												<th scope="col"></th>
											</tr>
										</thead>
										<tbody>
											<?php if (!empty($users)): ?>
												<?php foreach ($users as $index => $user): ?>
													<tr>
														<td><?php echo $index+1; ?></td>
														<td><?php echo $user['email']; ?></td>
														<td><?php echo $user['first_name']; ?></td>
														<td><?php echo $user['last_name']; ?></td>
														<td><?php echo $user['contact']; ?></td>
														<td><?php echo $user['gender'] == 'm' ? "Male" : "Female" ; ?></td>
														<?php if ($user['type'] == '3'): ?>
															<td class="<?php echo 'text-info'; ?>" ><?php echo 'User'; ?></td>
														<?php else: ?>
															<td class="<?php echo 'text-success'; ?>" ><?php echo 'Charter'; ?></td>
														<?php endif ?>
														<td><?php echo ucfirst($user['status']); ?></td>
														<td style="text-align: center;">
															<button type="button" data-target="#submitUser" data-id="<?php echo $user['id']; ?>" class="btn btn-danger delete-user" ><i class="la la-close"></i></button>
															<button type="button" data-target="#submitUser" data-id="<?php echo $user['id']; ?>" class="btn btn-success edit-user" ><i class="la la-edit"></i></button>
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