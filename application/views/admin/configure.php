<div class="wrapper">
	<?php include_once(APPPATH.'views/admin/templates/main-header.php'); ?>
	<?php include_once(APPPATH.'views/admin/templates/sidebar.php'); ?>
	<div class="main-panel">
		<div class="content">
			<div class="container-fluid">
				<h4 class="page-title">Website Configuration</h4>
				<form action="<?php _url('admin/configure'); ?>" method="POST" accept-charset="utf-8">
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Current Configuration</div>
								</div>
								<div class="card-body">
									<?php foreach ($configuration as $key => $value): ?>
										<div class="form-group form-inline">
											<label for="inlineinput" class="col-md-3 col-form-label"><?php echo $value['name']; ?></label>
											<div class="col-md-9 p-0">
												<input type="text" class="form-control input-full" id="<?php echo $value['key'] ?>" name="<?php echo $value['key'] ?>" placeholder="Please Enter Only Valid Values" value="<?php echo $value['value'] ?>">
											</div>
										</div>
									<?php endforeach ?>
									<div class="card-action pull-right">
										<button class="btn btn-lg btn-success" type="submit">Submit</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>