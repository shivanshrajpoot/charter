<div class="gtco-loader"></div>
	
<div id="page">


<!-- <div class="page-inner"> -->
<header id="gtco-header" class="gtco-cover gtco-cover-sm" role="banner" style="background-image: url(images/img_bg_3.jpg)">
	<div class="overlay"></div>
	<div class="gtco-container">
		<div class="row">
			<div class="col-md-12 col-md-offset-0 text-left">
				<div class="row row-mt-15em">

					<div class="col-md-7 mt-text animate-box" data-animate-effect="fadeInUp">
						<span class="intro-text-small">Here is a list of all quotes...</span>
						<h1>Available Quotes...</h1> 
					</div>
				</div>
				
			</div>
		</div>
	</div>
</header>

<div class="gtco-section border-bottom">
	<div class="gtco-container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
				<h2>Most Popular Destination</h2>
				<p><?php echo @POPULAR_DESTINATION_TEXT; ?></p>
			</div>
		</div>
		<div class="row">
				<?php foreach ($popular_destinations as $key => $destination): ?>
					<div class="col-lg-4 col-md-4 col-sm-6">
						<a href="<?php _url('uploads/destinations/'.$destination['image']);?>" class="fh5co-card-item image-popup">
							<figure>
								<div class="overlay"><i class="ti-plus"></i></div>
								<img src="<?php _url('uploads/destinations/'.$destination['image']);?>" alt="Image" class="img-responsive">
							</figure>
							<div class="fh5co-text">
								<h2><?php echo $destination['title']; ?></h2>
								<p><?php echo $destination['description']; ?></p>
								<p><span class="btn btn-primary">Schedule a Trip</span></p>
							</div>
						</a>
					</div>
				<?php endforeach ?>

		</div>
		<div class="row">
			<?php if (!empty($quotes)): ?>
				<?php foreach ($quotes as $key => $quote): ?>
					<div class="col-lg-4 col-md-4 col-sm-6">
						<a href="<?php _url('uploads/aircrafts/'.$quote['image']);?>" class="fh5co-card-item image-popup">
							<figure>
								<div class="overlay"><i class="ti-plus"></i></div>
								<img src="<?php _url('uploads/aircrafts/'.$quote['image']);?>" alt="Image" class="img-responsive">
							</figure>
							<div class="fh5co-text">
								<h2><?php echo ucfirst($quote['destination']); ?></h2>
								<p><?php echo ucfirst($quote['origin']); ?></p>
								<p><span class="btn btn-primary" onClick="window.location.assign('<?php _url('view-quote/'.base64_encode($quote['quote_id'])); ?>')">View Quote</span></p>
							</div>
						</a>
					</div>
				<?php endforeach ?>
			<?php else: ?>
				<h3 class="text-warning text-center">No quotes available for you...</h3>
			<?php endif ?>
		</div>
	</div>
</div>