<div class="wrapper">
	<?php include_once(APPPATH.'views/user/templates/main-header.php'); ?>
	<?php include_once(APPPATH.'views/user/templates/sidebar.php'); ?>
	<div class="main-panel">
		<div class="content">
			<div class="container-fluid">
				<h4 class="page-title">Request</h4>
				<div class="row">
					<div class="col-md-6">
						<div class="card">
							<div class="card-header">
								<div class="card-title">Request Details</div>
							</div>
							<div class="card-body">
								<div class="form-group">
									<label class="control-label text-default">Request ID</label>
									<p class="form-control-static text-info pull-right"><?php echo $request['id'] ?></p>
								</div>
								<div class="form-group">
									<label class="control-label text-default">From</label>
									<p class="form-control-static text-info pull-right"><?php echo $request['from'] ?></p>
								</div>
								<div class="form-group">
									<label class="control-label text-default">To</label>
									<p class="form-control-static text-info pull-right"><?php echo $request['to'] ?></p>
								</div>
								<div class="form-group">
									<label class="control-label text-default">Departure Date</label>
									<p class="form-control-static text-info pull-right"><?php echo $request['dep_date'] ?></p>
								</div>
								<div class="form-group">
									<label class="control-label text-default">Departure Time</label>
									<p class="form-control-static text-info pull-right"><?php echo $request['dep_time'] ?></p>
								</div>
								<div class="form-group">
									<label class="control-label text-default">Return Date</label>
									<p class="form-control-static text-info pull-right"><?php echo $request['ret_date']=="0000-00-00 00:00:00" || empty($request['ret_date']) ? 'N/A' : $request['ret_date']; ?></p>
								</div>
								<div class="form-group">
									<label class="control-label text-default">Return Time</label>
									<p class="form-control-static text-info pull-right">
										<?php echo $request['ret_date']=="0000-00-00 00:00:00" || empty($request['ret_date']) ? 'N/A' : $request['ret_time']; ?>
									</p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="card">
							<div class="card-header">
								<div class="card-title">Request Details</div>
							</div>
							<div class="card-body">
								<?php echo $map['html']; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>