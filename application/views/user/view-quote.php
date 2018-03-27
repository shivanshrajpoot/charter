<div class="gtco-loader"></div>
	
<div id="page">


<!-- <div class="page-inner"> -->
<header id="gtco-header" class="gtco-cover gtco-cover-sm" role="banner" style="background-image: url(<?php _url('uploads/aircrafts/'.$quote['image']); ?>)">
	<div class="overlay"></div>
	<div class="gtco-container">
		<div class="row">
			<div class="col-md-12 col-md-offset-0 text-left">
				<div class="row row-mt-15em">

					<div class="col-md-7 mt-text animate-box" data-animate-effect="fadeInUp">
						<span class="intro-text-small">Quote Details...</span>
						<h1><?php echo ucfirst($quote['first_name']).' '.ucfirst($quote['last_name']); ?></h1> 
					</div>
				</div>
				
			</div>
		</div>
	</div>
</header>


<div class="gtco-section border-bottom">
	<div class="gtco-container">
		<div class="row">
			<div class="col-md-12">
				<div class="price-box popular">
					<div class="popular-text">Origin : <?php echo $quote['from']; ?></div>
					<h3 class="pricing-plan">Destination : <?php echo $quote['to']; ?></h3>
					<div class="price"><sup class="currency">$</sup><?php echo $quote['price']; ?></div>
					<hr>
					<ul class="pricing-info">
						<li>Aircraft Name: <?php echo $quote['name']; ?></li>
						<li>Number Of Seats: <?php echo $quote['no_of_pass']; ?></li>
						<li>Departure: <?php echo $quote['dep_time']; ?></li>
						<li>Flight Time: <?php echo $quote['flight_time']; ?></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>