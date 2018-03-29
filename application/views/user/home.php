<div class="gtco-loader"></div>

<div id="page">


<!-- <div class="page-inner"> -->

<header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" style="background-image: url(<?php _url('assets/images/img_bg_2.jpg');?>)">
	<div class="overlay"></div>
	<div class="gtco-container">
		<div class="row">
			<div class="col-md-12 col-md-offset-0 text-left">
				

				<div class="row row-mt-15em">
					<div class="col-md-7 mt-text animate-box" data-animate-effect="fadeInUp">
						<h1>Planing Trip To Anywhere in The World?</h1>	
					</div>
					<div class="col-md-5 col-md-push-1 animate-box" data-animate-effect="fadeInRight">
						<div class="form-wrap">
							<div class="tab">
								
								<div class="tab-content">
									<div class="tab-content-inner active" data-content="signup">
										<h3>Search Your Trip</h3>
										<?php echo form_open('',['role'=>"submit-search",'id'=>'search_form']); ?>
											<div class="row form-group">
												<div class="col-md-6">
													<label for="from">From</label>
													<input type="text" onfocus="geolocate(this)" id="autocomplete" name="from" class="form-control" value="<?php echo set_value('from'); ?>">
													<input type="hidden" id="lat" name="lat" value="">
													<input type="hidden" id="long" name="long" value="">
													<?php echo form_error('from','<span class="text-danger">','</span>'); ?>
												</div>
												<div class="col-md-6">
													<label for="to">To</label>
													<input type="text" onfocus="geolocate(this)" name="to" id="to" class="form-control" value="<?php echo set_value('to'); ?>">
													<?php echo form_error('to','<span class="text-danger">','</span>'); ?>
												</div>
											</div>
											<div class="row form-group">
												<div class="col-md-6">
													<label for="dep_time">Departure Time</label>
													<input type="text" id="dep_time" name="dep_time" class="form-control hasTimepicker" value="<?php echo set_value('dep_time'); ?>">
													<?php echo form_error('dep_time','<span class="text-danger">','</span>'); ?>
												</div>
												<div class="col-md-6">
													<label for="dep_date">Departure Date</label>
													<input type="text" readonly id="dep_date" name="dep_date" class="form-control hasDatepicker" value="<?php echo set_value('dep_date'); ?>">
													<?php echo form_error('dep_date','<span class="text-danger">','</span>'); ?>
												</div>
											</div>
											<div class="row form-group">
												<div class="col-md-12">
													<label for="no_of_pass">No. Of Passengers</label>
													<input type="number" min="0" max="10" name="no_of_pass" id="no_of_pass" class="form-control" value="<?php echo set_value('no_of_pass'); ?>">
													<?php echo form_error('no_of_pass','<span class="text-danger">','</span>'); ?>
												</div>
											</div>
											<div class=" form-group">
												<div class="form-check">
													<label class="form-check-label">
														<input class="form-check-input"  checked name="return" id="return" type="checkbox" <?php echo set_value('return'); ?> >
														<span class="form-check-sign">Return</span>
													</label>
												</div>
											</div>
											<div class="row form-group" id="return_info">
												<div class="col-md-6">
													<label for="ret_time">Return Time</label>
													<input type="text" id="ret_time" name="ret_time" class="form-control hasTimepicker" value="<?php echo set_value('ret_time'); ?>">
												</div>
												<div class="col-md-6">
													<label for="ret_date">Return Date</label>
													<input type="text" readonly id="ret_date" name="ret_date" class="form-control hasDatepicker" value="<?php echo set_value('ret_date'); ?>">
												</div>
											</div>
											<div class="row form-group">
												<div class="col-md-12">
													<input id="charter_search" type="submit" class="btn btn-primary btn-block" value="Search" data-request="ajax-submit" data-target='[role="submit-search"]' >
												</div>
											</div>
										</form>	
									</div>

									
								</div>
							</div>
						</div>
					</div>
				</div>
						
				
			</div>
		</div>
	</div>
</header>

<?php if (@$popular_destinations): ?>
<div class="gtco-section">
	<div class="gtco-container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
				<h2>Most Popular Destinations</h2>
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
	</div>
</div>
<?php endif ?>

<div id="gtco-features">
	<div class="gtco-container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 text-center gtco-heading animate-box">
				<h2>How It Works</h2>
				<p><?php echo @HOW_IT_WORKS; ?></p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 col-sm-6">
				<div class="feature-center animate-box" data-animate-effect="fadeIn">
					<span class="icon">
						<i>1</i>
					</span>
					<h3><?php echo @HOW_IT_WORKS_1; ?></h3>
				</div>
			</div>
			<div class="col-md-4 col-sm-6">
				<div class="feature-center animate-box" data-animate-effect="fadeIn">
					<span class="icon">
						<i>2</i>
					</span>
					<h3><?php echo @HOW_IT_WORKS_2; ?></h3>
				</div>
			</div>
			<div class="col-md-4 col-sm-6">
				<div class="feature-center animate-box" data-animate-effect="fadeIn">
					<span class="icon">
						<i>3</i>
					</span>
					<h3><?php echo @HOW_IT_WORKS_3; ?></h3>
				</div>
			</div>
			

		</div>
	</div>
</div>


<div class="gtco-cover gtco-cover-sm" style="background-image: url(<?php _url('assets/images/img_bg_1.jpg');?>)"  data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="gtco-container text-center">
		<div class="display-t">
			<div class="display-tc">
				<h1><?php echo @QUALITY_TEXT; ?></h1>
			</div>	
		</div>
	</div>
</div>

<div id="gtco-counter" class="gtco-section">
	<div class="gtco-container">

		<div class="row">
			<div class="col-md-8 col-md-offset-2 text-center gtco-heading animate-box">
				<h2>Our Success</h2>
				<p><?php echo @OUR_SUCCESS; ?></p>
			</div>
		</div>

		<div class="row">
			
			<div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInUp">
				<div class="feature-center">
					<span class="counter js-counter" data-from="0" data-to="196" data-speed="5000" data-refresh-interval="50">1</span>
					<span class="counter-label">Destination</span>

				</div>
			</div>
			<div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInUp">
				<div class="feature-center">
					<span class="counter js-counter" data-from="0" data-to="97" data-speed="5000" data-refresh-interval="50">1</span>
					<span class="counter-label">Hotels</span>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInUp">
				<div class="feature-center">
					<span class="counter js-counter" data-from="0" data-to="12402" data-speed="5000" data-refresh-interval="50">1</span>
					<span class="counter-label">Travelers</span>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInUp">
				<div class="feature-center">
					<span class="counter js-counter" data-from="0" data-to="12202" data-speed="5000" data-refresh-interval="50">1</span>
					<span class="counter-label">Happy Customer</span>

				</div>
			</div>
				
		</div>
	</div>
</div>



<div id="gtco-subscribe">
	<div class="gtco-container">
		<div class="row animate-box">
			<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
				<h2>Contact Us</h2>
				<p>We will never share your email...</p>
			</div>
		</div>
		<div class="row animate-box">
			<div class="col-md-8 col-md-offset-2">
				<?php echo form_open('',['class'=>"form-group",'id'=>'contact_us_form']); ?>
					<div class="col-md-4 col-sm-4">
						<div class="form-group">
							<label for="email" class="sr-only">Email</label>
							<input required type="email" class="form-control" name="email" id="email" placeholder="Your Email">
							<?php echo form_error('email','<span class="text-danger">','</span>'); ?>
						</div>
					</div>
					<div class="col-md-4 col-sm-4">
						<div class="form-group">
							<label for="message" class="sr-only">Message</label>
							<textarea required type="text" class="form-control" name="message" id="message" placeholder="Message"></textarea>
							<?php echo form_error('message','<span class="text-danger">','</span>'); ?>
						</div>
					</div>
					<div class="col-md-4 col-sm-4">
						<div class="form-group">
							<label for="send" class="sr-only">Send</label>
							<input type="hidden" name="contact_us" value="contact_us">
							<input type="submit" id="send" class="btn btn-default" data-toggle="tooltip" title="Send" value="Send" name="send">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>