let getUserCurrentLocation = new function(){
	this.location 	= null
	this.url 		= typeof base_url != 'undefined' ? base_url : ''
	this.target		= 'update-user-location'
	this.error		= null
	this.showError 	= function(error){
		switch(error.code) {
		    case error.PERMISSION_DENIED:
		    	this.error = 'Geolocation request is denied,tracking will not be available.'
		    	break
		    case error.POSITION_UNAVAILABLE:
		    	this.error = 'Location information is unavailable,tracking will not be available.'
		    	break
		    case error.TIMEOUT:
		    	this.error = 'The request to get location timed out,tracking will not be available.'
		    	break
		    case error.UNKNOWN_ERROR:
		        this.error = "An unknown error occurred, tracking will not be available."
		        break
		}
		this.sweet_alert;
	}
	this.sweet_alert = function(){
		swal({
		    title: "Location Error",
		    text: this.error,
		    buttons: {
		        cancel: false,
		        confirm: true,
		    },
		})
	}
	this.fetchLocation = function(){
		if (navigator.geolocation) {
		    return navigator.geolocation.getCurrentPosition(this.saveLocation,this.showError);
		} else {
			this.error = 'Geolocation is not supported by this browser, tracking will not be available.'
		    this.showError
		}
	}
	this.saveLocation = function(position){
		let latitude 	= position.coords.latitude
		let longitude 	= position.coords.longitude
		if (typeof latitude != 'undefined' && typeof longitude != 'undefined') {
			_this = this
			$.ajax({
				type: "POST",
				url: base_url+'update-user-location',
				data: {'latitude':latitude,'longitude':longitude},
				dataType:'JSON',
				success:function(result){
					if (result.status == 'success') {
						console.log('Location Updated.')
					}
				}
			});

		}else{
			this.error = 'Could not update location,tracking will not be available.'
			this.sweet_alert;
		}
	}
}
getUserCurrentLocation.fetchLocation();