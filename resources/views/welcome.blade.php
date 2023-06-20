<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'DAVS') }}</title>

  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('vendors/feather/feather.css')}}">
  <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" href="{{ asset('vendors/typicons/typicons.css')}}">
  <link rel="stylesheet" href="{{ asset('vendors/simple-line-icons/css/simple-line-icons.css')}}">
  <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css')}}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
  <link rel="stylesheet" href="{{ asset('js/select.dataTables.min.css')}}">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('css/vertical-layout-light/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('images/favicon.png ')}}" />
  <!-- dataTable -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

</head>


<style>
  * {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
  }

  #map {
    height: 500px;
    width: 100%;
  }
</style>

<body>
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Logo</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container-fluid mt-5">
    <div class="row mb-4">
      <div class="col-md-4" style="margin: 0 auto; ">
        <button id="set-location-btn" class="btn btn-primary w-100">Set My Location</button>
      </div>
    </div>
    <div class="row">
      <div class="col-md-10" style="margin: 0 auto;">
        <div id="map"></div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-4" style="margin: 0 auto;">
      <div id="marker-content" class="mt-4 mb-3"></div>
    </div>
  </div>

  <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCiLMZ3-Tmq-6e0e8CZfXePdNEWyTC9OlY&libraries=geometry&callback=initMap"
    defer></script>

  {{-- {{ dd($location) }} --}}


  <script>
    var map;
    var currentLocationMarker;
    var markerContentContainer;
    // var locations;

    // var locations = [
    //       { lat: 14.58691, lng: 121.0614, title: 'Pasig City', content: 'Content for Location 2' },
    //       { lat: 15.9200001, lng: 120.330002, title: 'Pangasinan', content: 'Content for Location 2' },
    //   // Add more locations as needed
    // ];

    // console.log(locationData);


// locationData.forEach(function(loc) {

// locations = [
//     { lat:  parseFloat(loc.lat), lng: parseFloat(loc.long), title: loc.address, content: loc.content},
//   ];

// console.log(locations);
// });


function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    center: { lat: 15.9200001, lng: 120.330002 },
    zoom: 10
  });

  markerContentContainer = document.getElementById('marker-content');

  // Add a button click event listener to set the current location as a marker
  var setLocationBtn = document.getElementById('set-location-btn');
  setLocationBtn.addEventListener('click', setCurrentLocationMarker);
}

function setCurrentLocationMarker() {
  // Check if the geolocation API is supported by the browser
  if (navigator.geolocation) {
    // Get the current location
    navigator.geolocation.getCurrentPosition(function(position) {
      var currentLatLng = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };

      // Remove the previous marker (if any)
      if (currentLocationMarker) {
        currentLocationMarker.setMap(null);
      }

      // Create a marker for the current location
      currentLocationMarker = new google.maps.Marker({
        position: currentLatLng,
        map: map,
        title: 'My Location'
      });

      // Center the map on the current location
      map.setCenter(currentLatLng);

      // Display the marker content and distance
      displayMarkerContent(currentLatLng);
    }, function(error) {
      // Handle geolocation error
      console.error('Error getting current location:', error);
    });
  } else {
    // Geolocation is not supported
    console.error('Geolocation is not supported by this browser.');
  }
}

function displayMarkerContent(latLng) {
  var locationData = @json($location);
  // Clear the previous marker content
  markerContentContainer.innerHTML = '';

  for (var i = 0; i < locationData.length; i++) {
   var loc = locationData[i];
    var  locations = [
        { lat:  parseFloat(loc.lat), lng: parseFloat(loc.long), title: loc.address, content: loc.content},
      ];


     // Check if there are markers nearby
  var nearbyMarkers = locations.filter(function(location) {
    var distance = google.maps.geometry.spherical.computeDistanceBetween(
      new google.maps.LatLng(location.lat, location.lng),
      new google.maps.LatLng(latLng.lat, latLng.lng)
    );

    // Consider a distance of 1km as nearby (adjust as needed)
    // return distance <= 100000;
    return distance;
  });

  if (nearbyMarkers.length > 0) {
    // Display the content for nearby markers
    nearbyMarkers.forEach(function(marker) {
      var markerLatLng = { lat: marker.lat, lng: marker.lng };

      // Create a marker for the current location
      var markerInstance = new google.maps.Marker({
        position: markerLatLng,
        map: map,
        title: marker.title
      });

      // Compute distance between the current location and the marker
      var distance = google.maps.geometry.spherical.computeDistanceBetween(
        new google.maps.LatLng(latLng.lat, latLng.lng),
        new google.maps.LatLng(marker.lat, marker.lng)
      );

      // Convert distance to kilometers and round to two decimal places
      var distanceInKm = (distance / 1000).toFixed(2);

      // Display the content and distance for the marker
      var markerContent = document.createElement('div');
      // markerContent.innerHTML = '<h3 class="card-title">' + marker.title + '</h3><div class="card-body"><p>' + marker.content + '</p><p>Distance: ' + distanceInKm + ' km</p></div>';

      // Create an empty string to store the generated list
        var listHTML = "";


        var arrService =marker.content.split(",");
        // Convert PHP list to JavaScript array



        // Iterate over the items array
        // for (var i = 0; i < arrService.length; i++) {
        //   // Concatenate each item as an <li> element to the listHTML string
        //   listHTML += `<li class="text-success">${arrService}</li>`;
        // }

        var phpList = marker.content; // Assign the PHP list to a JavaScript variable

        // Split the PHP list into an array using the comma delimiter
        var jsArray = phpList.split(',');

        // Generate <li> elements and append them to a container element
        var container = document.getElementById('listContainer');
        jsArray.forEach(function(item) {
           listHTML += `<li class="text-success mb-1"><span class="badge badge-success">${item}</span></li>`;
        });

        markerContent.innerHTML = `<div class="card mb-3">
                                  <div class="card-body">
                                    <h4 class="card-title">${marker.title}</h4>
                                    <p>Services</p>
                                    <ul id="listContainer">
                                      ${listHTML}
                                      </ul>
                                    <p class="card-text">Distance: ${distanceInKm} km</p>
                                  </div>
                                </div>`;

      markerContentContainer.appendChild(markerContent);
    });
  } else {
    // No markers found nearby
    var noMarkerContent = document.createElement('div');
    noMarkerContent.innerHTML = 'No markers found nearby.';
    markerContentContainer.appendChild(noMarkerContent);
  }

}


}

// Initialize the map when the page loads
window.onload = function() {
                        initMap();
                      };
  </script>


</body>



</html>