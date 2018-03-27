<div class="wrapper">
	<?php include_once(APPPATH.'views/charter/templates/main-header.php'); ?>
	<?php include_once(APPPATH.'views/charter/templates/sidebar.php'); ?>
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
											<i class="la la-money"></i>
										</div>
									</div>
									<div class="col-7 d-flex align-items-center">
										<div class="numbers">
											<p class="card-category">Requests</p>
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
											<i class="la la-quote-left"></i>
										</div>
									</div>
									<div class="col-7 d-flex align-items-center">
										<div class="numbers">
											<p class="card-category">Qutoes</p>
											<h4 class="card-title"><?php echo $count_info['quotes'] ?></h4>
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
					<div class="col-md-3">
						<div class="card card-stats card-primary">
							<div class="card-body ">
								<div class="row">
									<div class="col-5">
										<div class="icon-big text-center">
											<i class="la la-check-circle"></i>
										</div>
									</div>
									<div class="col-7 d-flex align-items-center">
										<div class="numbers">
											<p class="card-category">Submitted Quotes</p>
											<h4 class="card-title"><?php echo $count_info['submitted_quotes'] ?></h4>
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