<div class="wrapper">
	<?php include_once(APPPATH.'views/admin/templates/main-header.php'); ?>
	<?php include_once(APPPATH.'views/admin/templates/sidebar.php'); ?>
	<div class="main-panel">
		<div class="content">
			<div class="container-fluid">
				<h4 class="page-title">Contact Us</h4>
				<div class="row">
					<div class="col-md-12">
						<div class="card card-tasks">
							<div class="card-header ">
								<h4 class="card-title">All Queries</h4>
								<p class="card-category">Please reply as per requirement...</p>
							</div>
							<div class="card-body ">
								<table class="table" id="request_table">
									<thead>
										<tr>
											<th>#</th>
											<th>From</th>
											<th>Message</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($contact_us as $key => $value): ?>
											<tr>
												<td><?php echo $key+1;?></td>
												<td><?php echo $value['email'];?></td>
												<td><?php echo $value['message'];?></td>
												<td class="td-actions text-right">
													<div class="form-button-action">
															<a class="btn btn-info" href="<?php _url('admin/reply-contact-us/'.base64_encode($value['id'])); ?>">
																<i class="la la-eye"></i>
															</a>
															<button type="button" class="btn btn-danger delete-contact-us" data-target="<?php echo $value['id']; ?>" >
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