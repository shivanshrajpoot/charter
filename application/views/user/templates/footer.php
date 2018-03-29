<footer id="gtco-footer" role="contentinfo">
	<div class="gtco-container">
		<div class="row row-p	b-md">

			<div class="col-md-4">
				<div class="gtco-widget">
					<h3>About Us</h3>
					<p><?php echo ABOUT_US; ?></p>
				</div>
			</div>

			<div class="col-md-4 col-md-push-1">
				<div class="gtco-widget">
					<h3>Pages</h3>
					<ul class="gtco-footer-links">
						<?php foreach ($static_content as $key => $value) { ?>
						<?php if ($value['type'] == 'page'): ?>
							<li>
								<a href="<?php echo base_url($value['url']); ?>">
									<?php echo strtoupper(str_replace('_',' ',$value['page_name'])); ?>		
								</a>
							</li>
						<?php endif ?>
						<?php } ?>
					</ul>
				</div>
			</div>
			<div class="col-md-3 col-md-push-1">
				<div class="gtco-widget">
					<h3>Get In Touch</h3>
					<ul class="gtco-quick-contact">
						<li><a href="void:javascript(0)"><i class="icon-phone"></i><?php echo CONTACT_NO; ?></a></li>
						<li><a href="mailto:<?php echo ADMIN_EMAIL; ?>"><i class="icon-mail2"></i><?php echo ADMIN_EMAIL; ?></a></li>
						<li><a href="void:javascript(0)"><i class="la la-home"></i> <?php echo ADDRESS; ?></address></li>
					</ul>
				</div>
			</div>

		</div>

		<div class="row copyright">
			<div class="col-md-12">
				<p class="pull-left">
					<small class="block"><?php echo COPY_RIGHT; ?></small> 
				</p>
				<p class="pull-right">
					<ul class="gtco-social-icons pull-right">
						<li><a href="<?php echo TWITTER_URL; ?>"><i class="icon-twitter"></i></a></li>
						<li><a href="<?php echo FACEBOOK_URL; ?>"><i class="icon-facebook"></i></a></li>
						<li><a href="<?php echo GOOGLE_PLUS_URL; ?>"><i class="la la-google-plus-square"></i></a></li>
					</ul>
				</p>
			</div>
		</div>

	</div>
</footer>
<!-- </div> -->

</div>

<div class="gototop js-top">
	<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
</div>

<!-- jQuery -->
<script src="<?php _url('assets/js/jquery.min.js');?>"></script>
<!-- jQuery Easing -->
<script src="<?php _url('assets/js/jquery.easing.1.3.js');?>"></script>
<!-- jQuery UI -->
<script src="<?php _url('assets/js/jquery-ui.min.js');?>"></script>
<!-- Bootstrap -->
<script src="<?php _url('assets/js/bootstrap.min.js');?>"></script>
<!-- Waypoints -->
<script src="<?php _url('assets/js/jquery.waypoints.min.js');?>"></script>
<!-- Carousel -->
<script src="<?php _url('assets/js/owl.carousel.min.js');?>"></script>
<!-- countTo -->
<script src="<?php _url('assets/js/jquery.countTo.js');?>"></script>

<!-- Stellar Parallax -->
<script src="<?php _url('assets/js/jquery.stellar.min.js');?>"></script>

<!-- Magnific Popup -->
<script src="<?php _url('assets/js/jquery.magnific-popup.min.js');?>"></script>
<script src="<?php _url('assets/js/magnific-popup-options.js');?>"></script>

<!-- Datepicker -->
<script src="<?php _url('assets/js/bootstrap-datepicker.min.js');?>"></script>
<!-- Timepicker -->
<script src="<?php _url('assets/js/wickedpicker.min.js');?>"></script>

<!-- Main -->
<script src="<?php _url('assets/js/main.js');?>"></script>
<!-- App -->
<script src="<?php _url('assets/js/app.js');?>"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1mlx2rBrPllOEAS4Go8POjJNsKbAG0lY&libraries=places&callback=initAutocomplete" async defer></script>
<script src="<?php _url('assets/js/address-suggestion.js');?>"></script>
<script type="text/javascript">
	<?php if (!empty($show_loader)): ?>
		var show_loader = false;
	$('#loader_hel').show();
    $('#cont_to_quotes').hide();
    setTimeout(function(){
        $('#cont_to_quotes').show();
    },10000);
	<?php endif ?>

</script>
<!-- SignUp Via Facebook -->
<script src="<?php _url('assets/js/signup-via-fb.js');?>"></script>
<!-- SignUp Via Facebook -->
</body>
</html>