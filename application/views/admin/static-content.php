<div class="wrapper">
	<?php include_once(APPPATH.'views/admin/templates/main-header.php'); ?>
	<?php include_once(APPPATH.'views/admin/templates/sidebar.php'); ?>
	<div class="main-panel">
		<div class="content">
			<div class="container-fluid">
				<h4 class="page-title">Static Content</h4>
				<form action="<?php _url('admin/static-content'); ?>" method="POST" accept-charset="utf-8">
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Content Pages</div>
								</div>
								<div class="card-body">
									<div class="row text-center">
										<div class="col-md-2" >
											Page Name
										</div>
										<div class="col-md-3" >
											URL
										</div>
										<div class="col-md-7" >
											Content
										</div>
									</div>
									<?php foreach ($static_content as $key => $value): ?>
										<div class="row text-center form-group form-inline">
												<div class="col-md-2 ">
													<div class="form-group">
														<label for="inlineinput" class="col-form-label"><?php echo strtoupper(str_replace('_',' ', $value['page_name'])); ?></label>
													</div>
												</div>
												<div class="col-md-3 p-0">
													<div class="form-group">
														<input type="text" class="form-control input-full" id="<?php echo $value['url'] ?>" name="<?php echo $value['page_name'] ?>[url]" value="<?php echo $value['url'] ?>" readonly>
													</div>
												</div>
												<div class="col-md-7 p-0">
													<div class="form-group">
														<textarea class="form-control" id="" name="<?php echo $value['page_name'] ?>[content]" rows="10" style="min-width: 530px;">
															<?php echo $value['content'] ?>
														</textarea>
													</div>
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