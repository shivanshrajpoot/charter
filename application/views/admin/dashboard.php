<div class="wrapper">
	<?php include_once(APPPATH.'views/admin/templates/main-header.php'); ?>
	<?php include_once(APPPATH.'views/admin/templates/sidebar.php'); ?>
	<div class="main-panel">
		<div class="content">
			<div class="container-fluid">
				<h4 class="page-title">Dashboard</h4>
				<div class="row">
					<div class="col-md-3">
						<div class="card card-stats card-warning">
							<div class="card-body ">
								<div class="row">
									<div class="col-5">
										<div class="icon-big text-center">
											<i class="la la-bar-chart"></i>
										</div>
									</div>
									<div class="col-7 d-flex align-items-center">
										<div class="numbers">
											<p class="card-category">Reuests</p>
											<h4 class="card-title"><?php echo $count_info['requests'] ?></h4>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="card card-stats card-success">
							<div class="card-body ">
								<div class="row">
									<div class="col-5">
										<div class="icon-big text-center">
											<i class="la la-users"></i>
										</div>
									</div>
									<div class="col-7 d-flex align-items-center">
										<div class="numbers">
											<p class="card-category">Users</p>
											<h4 class="card-title"><?php echo $count_info['users']-1; ?></h4>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="card card-stats card-danger">
							<div class="card-body">
								<div class="row">
									<div class="col-5">
										<div class="icon-big text-center">
											<i class="la la-newspaper-o"></i>
										</div>
									</div>
									<div class="col-7 d-flex align-items-center">
										<div class="numbers">
											<p class="card-category">Charters</p>
											<h4 class="card-title"><?php echo $count_info['charters'] ?></h4>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="card card-stats card-primary">
							<div class="card-body ">
								<div class="row">
									<div class="col-5">
										<div class="icon-big text-center">
											<i class="la la-fighter-jet"></i>
										</div>
									</div>
									<div class="col-7 d-flex align-items-center">
										<div class="numbers">
											<p class="card-category">Aircrafts</p>
											<h4 class="card-title"><?php echo $count_info['aircrafts'] ?></h4>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>