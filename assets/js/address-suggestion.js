// This example displays an address form, using the autocomplete feature
// of the Google Places API to help users fill in the information.

// This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

var placeSearch, autocomplete;
var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
  postal_code: 'short_name'
};

function initAutocomplete(el) {
  // Create the autocomplete object, restricting the search to geographical
  // location types.
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {!HTMLInputElement} */(el),
      {types: ['geocode']});

  // When the user selects an address from the dropdown, populate the address
  // fields in the form.
   if ($(el).attr('name')=='from') {
        autocomplete.addListener('place_changed', fillInAddressFrom);
      }else if($(el).attr('name')=='to'){
        autocomplete.addListener('place_changed', fillInAddressTo);
      } 
}

function fillInAddressTo() {
    var place = autocomplete.getPlace();
    let latitude = place.geometry.location.lat()
    let longitude =  place.geometry.location.lng()
    $('#to_lat').val(latitude);
    $('#to_long').val(longitude);
}

function fillInAddressFrom() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();
  let latitude = place.geometry.location.lat()
  let longitude =  place.geometry.location.lng()
  $('#from_lat').val(latitude);
  $('#from_long').val(longitude);

  // for (var component in componentForm) {
    /*document.getElementById(component).value = '';
    document.getElementById(component).disabled = false;*/
    // $('#' + component).val('');
    // $('#' + component).attr('disabled', false);
  // }

  // Get each component of the address from the place details
  // and fill the corresponding field on the form.
  /*for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType).value = val;
    }
  }*/
}

// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate(el) {
  initAutocomplete(el)
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
     /* if ($(el).attr('name')=='from') {
        console.log('from')
        $('#from_lat').val(position.coords.latitude);
        $('#from_long').val(position.coords.longitude);
      }else if($(el).attr('name')=='to'){
        console.log('to')
        $('#to_lat').val(position.coords.latitude);
        $('#to_long').val(position.coords.longitude);
      } */
      var geolocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      var circle = new google.maps.Circle({
        center: geolocation,
        radius: position.coords.accuracy
      });
      autocomplete.setBounds(circle.getBounds());
    });
  }
}
