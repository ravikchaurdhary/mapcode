<!-- map start -->
	<style type="text/css"> 
	 #map {
				  height: 400px;
				  width: 600px;
				  border: 1px solid #333;
				  margin-top: 0.6em;
			}
	</style>

		<?php if($service->category_id==2)
		 {  ?>
		  <h2 class="title_common">Location</h2>
		  <div id="map" style="width:100%;height:213px;"></div>   
			     <div class="time-address-sec location"> 
		           <form class="direction_btn dirform" action="http://maps.google.com/maps" method="get" target="_blank">
		           <input type="hidden" name="daddr" value="<?php echo $vendorDetail->vendor_detail->business_additional_address; ?>" />
		        <input type="submit" class="btn btn-info direction_btn" value="Get  directions" />
		       </form>
		    </div>
		<?php } ?>


		
  <!-- map End -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAj656VgQU399m2ia0LN6cKfLI-2nk0qMc">
	
  </script>

   <script>
		var geocoder;
		var map;
		var infowindow;

		function initialize() {
		  geocoder = new google.maps.Geocoder();
		  var loca = new google.maps.LatLng(41.7475, -74.0872);

		  map = new google.maps.Map(document.getElementById('map'), {
		    mapTypeId: google.maps.MapTypeId.ROADMAP,
		    center: loca,
		    zoom: 8
		  });

		}

		function callback(results, status) {
		  if (status == google.maps.places.PlacesServiceStatus.OK) {
		    for (var i = 0; i < results.length; i++) {
		      createMarker(results[i]);
		    }
		  }
		}

		function createMarker(place) {
		  var placeLoc = place.geometry.location;
		  var marker = new google.maps.Marker({
		    map: map,
		    position: place.geometry.location
		  });

		  google.maps.event.addListener(marker, 'mouseover', function() {
		    infowindow.setContent(place.name);
		    infowindow.open(map, this);
		  });
		}
		function abc(){
		 
		  var address ='<?php echo $vendorDetail->vendor_detail->business_additional_address; ?>';
		  //var address = document.getElementById("address").value;

		  geocoder.geocode({
		    'address': address
		  }, function(results, status) {
		    /*alert(google.maps.GeocoderStatus.OK);*/
		    //alert(status);
		    if (status == google.maps.GeocoderStatus.OK) {
		      map.setCenter(results[0].geometry.location);
		      var marker = new google.maps.Marker({
		        map: map,
		        position: results[0].geometry.location
		      });
		      var request = {
		        location: results[0].geometry.location,
		        radius: 50000,
		        name: 'ski',
		        keyword: 'mountain',
		        type: ['park']
		      };
		      infowindow = new google.maps.InfoWindow();
		      var service = new google.maps.places.PlacesService(map);
		      service.nearbySearch(request, callback);
		    } else {
		      //alert("Geocode was not successful for the following reason: " + status);
		    }
		  });
		}

		google.maps.event.addDomListener(window, 'load', initialize);
		google.maps.event.addDomListener(window, 'load', abc);

   </script>