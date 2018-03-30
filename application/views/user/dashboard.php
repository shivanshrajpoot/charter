<div class="wrapper">
	<?php include_once(APPPATH.'views/user/templates/main-header.php'); ?>
	<?php include_once(APPPATH.'views/user/templates/sidebar.php'); ?>
	<div class="main-panel">
		<div class="content">
			<div class="container-fluid">
				<h4 class="page-title">Requests Submitted</h4>
				<div class="row">
					<div class="col-md-12">
						<div class="card card-tasks">
							<div class="card-header ">
								<h4 class="card-title">Requests</h4>
								<p class="card-category">Please review requests as per requirement...</p>
							</div>
							<div class="card-body ">
								<table class="table" id="request_table">
									<thead>
										<tr>
											<th>#</th>
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
												<td><?php echo $key+1;?></td>
												<td><?php echo $request['to'];?></td>
												<td><?php echo $request['from'];?></td>
												<td><?php echo $request['dep_date'];?></td>
												<td><?php echo $request['dep_time'];?></td>
												<td><?php echo $request['no_of_pass'];?></td>
												<td class="td-actions text-right">
													<div class="form-button-action">
															<a class="btn btn-info" href="<?php _url('user/view-request/'.base64_encode($request['id'])); ?>">
																<i class="la la-eye"></i>
															</a>
															<button type="button" class="btn btn-danger delete-request" data-target="<?php echo $request['id']; ?>" >
																<i class="la la-close"></i>
															</button>
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