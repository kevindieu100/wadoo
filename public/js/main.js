var currentPostion;
var currentLatLng;
var map;
var marker;
var geocoder;
var preferencesHTML;
var key = "AIzaSyBHBfWp-XSikyJkxa2wnvL-KKTYP_wRXwg";
var dataCopy;
var itineraryCopy;
// Initialize collapse button
$(".button-collapse").sideNav();

//sets the location
function setLocation(position){
  console.log("in set location");
  console.log(position);
  currentPosition = position;
  currentLatLng = {
    lat: position.coords.latitude,
    lng: position.coords.longitude
  };
  map = new google.maps.Map(document.getElementById('map'), {
    center: {
      lat: position.coords.latitude,
      lng: position.coords.longitude
    },
    zoom: 15
  });
  marker = new google.maps.Marker({
      map: map,
      position:  {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      },
      draggable: true
  });
  geocoder.geocode({
    latLng:{
      lat: position.coords.latitude,
      lng: position.coords.longitude
    }
  }, function(responses) {
    if (responses && responses.length > 0) {
      updateMarkerAddress(responses[0].formatted_address);
    } else {
      updateMarkerAddress('Cannot determine address at this location.');
    }
  });

  // Add dragging event listeners.
  google.maps.event.addListener(marker, 'dragstart', function() {
    updateMarkerAddress('Dragging...');
  });

  google.maps.event.addListener(marker, 'drag', function() {
    updateMarkerStatus('Dragging...');
    updateMarkerPosition(marker.getPosition());
  });

  google.maps.event.addListener(marker, 'dragend', function() {
    updateMarkerStatus('Drag ended');
    geocodePosition(marker.getPosition());
    map.panTo(marker.getPosition());
  });

  google.maps.event.addListener(map, 'click', function(e) {
    updateMarkerPosition(e.latLng);
    geocodePosition(marker.getPosition());
    marker.setPosition(e.latLng);
    map.panTo(marker.getPosition());
  });
}//end of setLocation

//function to get the user's current location
function getLocation() {
  $.getJSON("http://ipinfo.io", function(ipinfo){
      console.log("Found location ["+ipinfo.loc+"] by ipinfo.io");
      latLong = ipinfo.loc.split(",");
      var newPosition = {
          coords: {
            latitude: parseFloat(latLong[0]),
            longitude: parseFloat(latLong[1])
          }
      };
      console.log(newPosition);
      setLocation(newPosition);
  });
}//end of getLocation\

//function that initiates the budget slider
function initiateSlider(){
  var slider = document.getElementById('budgetSlider');
  var durationSlider = document.getElementById('durationSlider');
  noUiSlider.create(slider, {
   start: 0,
   connect: true,
   behavior: 'tap-drag',
   step: 1,
   range: {
     'min': [5],
     'max': [100]
   }
  });

  noUiSlider.create(durationSlider, {
   start: 0,
   connect: true,
   behavior: 'tap-drag',
   step: 60,
   range: {
     'min': [1800],
     'max': [21600]
   }
  });

  durationSlider.noUiSlider.on('update', function( values, handle ) {
    var h = Math.floor(values[handle]/ 3600);
    var m = Math.floor(values[handle] % 3600 / 60);
  	document.getElementById('durationDisplay').innerHTML = '~' +h +" hrs "+ m +" mins";
  });

  slider.noUiSlider.on('update', function( values, handle ) {
  	document.getElementById('budgetDisplay').innerHTML = '~$' + Math.round(parseInt(values[handle]));
  });

  //change the color of slider buttons
  var sliderButtons = document.getElementsByClassName("noUi-tooltip");
  var i = 0;
  for(i = 0; i < sliderButtons.length; i++){
    sliderButtons[i].style.backgroundColor = "rgb(255, 147, 38)";
  }
}//end of initiateSlider

//calls function when file loads
$(document).ready(function(){
  $('#loadingContainer').show();
  getLocation();
  $('ul.tabs').tabs();
  initiateSlider();
  $('.modal').modal();
  geocoder = new google.maps.Geocoder();
  var myPlacesPicker = new google.maps.places.Autocomplete(document.getElementById('pickupLocation'));
  google.maps.event.addListener(myPlacesPicker, 'place_changed', function(){
    var place = myPlacesPicker.getPlace();
    if(!place.geometry){
      return;
    }
    if(place.geometry.viewport){
      map.fitBounds(place.geometry.viewport);
      map.setCenter(place.geometry.location);
      marker.setPosition(place.geometry.location);
    }else{
      map.setCenter(place.geometry.location);
      marker.setPosition(place.geometry.location);
    }
  });
  $('#loadingContainer').hide();
});//end of window load

//calls geocode the the current position
function geocodePosition(pos) {
  geocoder.geocode({
    latLng: pos
  }, function(responses) {
    if (responses && responses.length > 0) {
      updateMarkerAddress(responses[0].formatted_address);
    } else {
      updateMarkerAddress('Cannot determine address at this location.');
    }
  });
}//end of geocodePosition

//updates the current marker's status
function updateMarkerStatus(str) {
  // console.log(str);
}//end of updateMarkerStatus

//updates the marker's info
function updateMarkerPosition(latLng) {
  currentLatLng = {
    lat: latLng.lat(),
    lng: latLng.lng()
  };
}//end of updateMarkerPositon

function updateMarkerAddress(str) {
  document.getElementById('pickupLocation').value = str;
}

function postPreferences(){
  //Retreive the data from the form:
  var data = $('#mainForm').serializeArray();
  var budget = parseInt(document.getElementById('budgetDisplay').innerHTML.substring(2));
  var location = document.getElementById('pickupLocation').value;
  // //Add in additional data to the original form data
  var durationSlider = document.getElementById('durationSlider');
  var seconds = durationSlider.noUiSlider.get();
  data.push(
    {name: 'seconds',      value: seconds},
    {name: 'budget',   value: budget},
    {name: 'location', value: location}
  );
  dataCopy = data;
  $('#loadingContainer').show();
  //Submit the form via Ajax POST request:
  $.ajax({
    'type': 'POST',
    'url':  '/preferences',
    'data':  data,
    'Content-Type': 'application/json',
    'dataType': 'JSON'
    // 'datatype': 'text/html'
  })
  .success(function(data){
    //$('#mainForm').submit();
    if(data.error){
      alert(data.error + ", please refresh the page and try again.");
      $('#loadingContainer').hide();
    }else{
      itineraryCopy = JSON.parse(data.itinerary);
      console.log(itineraryCopy);
      // $('#optionsContainer').hide();
      $('#itineraryContainer').html(data.html);
      $('ul.tabs').tabs('select_tab', 'itineraryContainer');
      $('#loadingContainer').hide();
    }
  })
  .error(function(jqXHR, textStatus, errorThrown) {
    alert("Error, " + errorThrown +", please refresh the page and try again.");
    console.log(textStatus);
    console.log(errorThrown);
    console.log(jqXHR.getAllResponseHeaders());
    $('#loadingContainer').hide();
  });
}//end of postPreferences

function getNewItinerary(){
  // //Add in additional data to the original form data:
  //Submit the form via Ajax POST request:
  $('#loadingContainer').show();
  $.ajax({
    'type': 'POST',
    'url':  '/preferences',
    'data':  dataCopy,
    'Content-Type': 'application/json',
    'dataType': 'JSON'
    // 'datatype': 'text/html'
  })
  .success(function(data){
    //$('#mainForm').submit();
    if(data.error){
      alert(data.error + ", please refresh the page and try again.");
      $('#loadingContainer').hide();
    }else{
      itineraryCopy = JSON.parse(data.itinerary);
      console.log(itineraryCopy);
      $('#itineraryContainer').html(data.html);
      $('ul.tabs').tabs('select_tab', 'itineraryContainer');
      $('#loadingContainer').hide();
    }
  })
  .error(function(jqXHR, textStatus, errorThrown) {
    alert("Error, " + errorThrown +", please refresh the page and try again.");
    console.log(textStatus);
    console.log(errorThrown);
    console.log(jqXHR.getAllResponseHeaders());
    $('#loadingContainer').hide();
  });
}//end of get new Itienrary

function saveItinerary(){
  var data = $('#mainForm').serializeArray();
  data.push(
    {name: 'itinerary',      value: JSON.stringify(itineraryCopy)}
  );
  $('#loadingContainer').show();
  $.ajax({
    'type': 'POST',
    'url':  '/itineraries/save',
    'data':  data,
    'Content-Type': 'application/json',
    'dataType': 'JSON'
    // 'datatype': 'text/html'
  })
  .success(function(data){
    //$('#mainForm').submit();
    if(data.error){
      alert(data.error + ", please refresh the page and try again.");
      $('#loadingContainer').hide();
    }else if(data.success){
      console.log(data);
      alert(data.success);
      $('#loadingContainer').hide();
    }
  })
  .error(function(jqXHR, textStatus, errorThrown) {
    alert("Error, " + errorThrown +", please refresh the page and try again.");
    console.log(textStatus);
    console.log(errorThrown);
    console.log(jqXHR.getAllResponseHeaders());
    $('#loadingContainer').hide();
  });
}//end of saveItinerary

$('#mainForm').submit(function(e){
  postPreferences();
  return false;
});//end of processForm

$('#mainForm').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) {
    e.preventDefault();
    return false;
  }
});

//grabs and displays the itinerary
function getDisplayItinerary(id){
  var data = $('#mainForm').serializeArray();
  data.push(
    {name: 'id',      value: id}
  );
  $('#loadingContainer').show();
  $.ajax({
    'type': 'GET',
    'url':  '/itineraries/'+id+'/preview',
    'data':  data,
    'Content-Type': 'application/json',
    'dataType': 'JSON'
    // 'datatype': 'text/html'
  })
  .success(function(data){
    console.log(data);
    $('#itineraryPreviewModalContent').html(data.html);
    $('#itineraryPreviewModal').modal('open');
    $('#loadingContainer').hide();
  })
  .error(function(jqXHR, textStatus, errorThrown) {
    alert("Error, " + errorThrown +", please refresh the page and try again.");
    console.log(textStatus);
    console.log(errorThrown);
    console.log(jqXHR.getAllResponseHeaders());
    $('#loadingContainer').hide();
  });
}//end of getDisplayItinerary

//updates the itinerary
function updateItinerary(id){
  var data = $('#profileForm').serializeArray();
  var newTitle = $('#title_'+id)[0].value;
  data.push(
    {name: 'id',      value: id},
    {name: 'newTitle', value: newTitle}
  );
  $.ajax({
    'type': 'POST',
    'url':  '/itineraries/'+id+'/update',
    'data':  data,
    'Content-Type': 'application/json'
    // 'datatype': 'text/html'
  });
  // .success(function(data){
  //   $('#loadingContainer').hide();
  // })
  // .error(function(jqXHR, textStatus, errorThrown) {
  //   alert("Error, " + errorThrown +", please refresh the page and try again.");
  //   console.log(textStatus);
  //   console.log(errorThrown);
  //   console.log(jqXHR.getAllResponseHeaders());
  //   $('#loadingContainer').hide();
  // });
}//end of updateItinerary

//grabs the itinerary and displays it
$('.preview_button').click(function(event){
  getDisplayItinerary(event.target.id);
});

$('.update_button').click(function(event){
  updateItinerary(event.target.id);
});

$('#optionsNav').click(function(event){
  getLocation();
});
