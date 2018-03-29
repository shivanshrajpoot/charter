<div class="wrapper">
	<?php include_once(APPPATH.'views/admin/templates/main-header.php'); ?>
	<?php include_once(APPPATH.'views/admin/templates/sidebar.php'); ?>
	<div class="main-panel">
		<div class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-6">
						<div class="card">
						<div class="card-header">
							<div class="card-title">Charter Details <span class="text-info pull-right"><?php echo $charter ? $charter['id'] : ''; ?></span></div>
						</div>
						<div class="card-body">
							<?php echo form_open(); ?>
								<div class=" form-group">
									<div class="col-md-12">
										<label class="" for="name">Charter Name</label>
										<input type="text" id="name" name="name" class="form-control" placeholder="Charter Name" autofocus maxlength="15" value="<?php echo $charter ? $charter['name'] : ''; ?>">
										<?php echo form_error('name','<span class="text-danger">','</span>'); ?>
									</div>
									
								</div>
								<div class=" form-group">
									<div class="col-md-12">
										<label class="" for="email">Email</label>
										<input type="text" id="email" name="email" class="form-control" placeholder="Charter email" required autofocus maxlength="50" value="<?php echo $charter ? $charter['email'] : ''; ?>">
										<?php echo form_error('email','<span class="text-danger">','</span>'); ?>
									</div>
								</div>
								<div class=" form-group">
									<div class="col-md-12">
										<label class="" for="subject">Lattitude</label>
										<input type="text" id="lat" class="form-control" name="lat" placeholder="Lattitude" autofocus maxlength="12" minlength="1" value="<?php echo $charter ? $charter['lat'] : ''; ?>">
										<?php echo form_error('contact','<span class="text-danger">','</span>'); ?>
									</div>
								</div>
								<div class=" form-group">
									<div class="col-md-12">
										<label class="" for="subject">Longitude</label>
										<input type="text" id="long" class="form-control" name="long" placeholder="Longitude" autofocus maxlength="12" minlength="1" value="<?php echo $charter ? $charter['long'] : ''; ?>">
										<?php echo form_error('contact','<span class="text-danger">','</span>'); ?>
									</div>
								</div>
								<div class=" form-group">
									<div class="col-md-12">
										<label class="" for="area">Service Area</label>
										<input type="text" id="area" name="area" class="form-control" placeholder="Service Area" autofocus maxlength="15" value="<?php echo $charter ? $charter['area'] : ''; ?>">
										<?php echo form_error('area','<span class="text-danger">','</span>'); ?>
									</div>
									
								</div>
								<div class="form-group pull-right">
									<input type="submit" value="Save" class="btn btn-lg btn-primary">
								</div>
							<?php echo form_close(); ?>
						</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="card">
						<div class="card-header">
							<div class="card-title">Map<span class="text-info pull-right">Drag Marker To Change Location</span></div>
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
    <script>
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.
      var map, infoWindow;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map_canvas'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 6
        });
        infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('Location found.');
            infoWindow.open(map);
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }
    </script>
    <script async defer
       src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApE06HhYE0h6SNfnsxOZKVMS6NmwBzxxo&callback=initMap">
     </script>