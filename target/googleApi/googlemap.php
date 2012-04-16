<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<style type="text/css">

</style>
<script src="jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=true">
</script>
<script type="text/javascript">
   //making  a ajax call to google api.
   var lat='';
   var lng='';
   var count=0;
   var geocoder = new google.maps.Geocoder();
   //var address = 'Chandigarh, India';
   var address = 'Bilaspur,Himachal Pardesh, India';
   var getmap='';
   function showMap(){
	   if(geocoder){
		  geocoder.geocode({ 'address': address },function(results, status){
			 if (status == google.maps.GeocoderStatus.OK){
				//console.log(results[0].geometry.location);
					var myJSONText = JSON.stringify(results, function replacer(key, value) {
						if (typeof value === 'number' && !isFinite(value)) {
							return String(value);
						}
						if(key=='d'&&count==0){
							lat=value;
							count++;
						}
						if(key=='b'&&count>0&&count<2){
							lng=value;
							count++;
							initialize();
							function initialize(){
								var latlng = new google.maps.LatLng(lat,lng);
								var myOptions = {
								  zoom: 18,
								  center: latlng,
								  mapTypeId: google.maps.MapTypeId.HYBRID
								};
								var map = new google.maps.Map(document.getElementById("map_canvas"),
									myOptions);
								map.setTilt(45);
								map.setHeading(90);
								//Placing the marker on the api.
								var marker = new google.maps.Marker({
									  position: latlng, 
									  map: map, 
									  title:"Hello World!",
									  draggable:true,
									  animation: google.maps.Animation.DROP,
									  position: latlng
								});
								google.maps.event.addListener(marker, 'click', toggleBounce);
								rectangle = new google.maps.Rectangle();

								  google.maps.event.addListener(map, 'zoom_changed', function() {

									// Get the current bounds, which reflect the bounds before the zoom.
									var rectOptions = {
									  strokeColor: "#FF0000",
									  strokeOpacity: 0.8,
									  strokeWeight: 2,
									  fillColor: "#FF0000",
									  fillOpacity: 0.35,
									  map: map,
									  bounds: map.getBounds()
									};
									rectangle.setOptions(rectOptions);
								  });
								
							}
							 function drop() {
								  for (var i =0; i < markerArray.length; i++) {
									setTimeout(function() {
									  addMarkerMethod();
									}, i * 200);
								  }
							}
							 function toggleBounce() {
							  if (marker.getAnimation() != null) {
								marker.setAnimation(null);
							  } else {
								marker.setAnimation(google.maps.Animation.BOUNCE);
							  }
							}
							//Polylines
							
						}
						return value;
						
					});
			 }
			 else{
				console.log("Geocoding failed: " + status);
			 }
		  });
	   }
   }
</script>
</head>
<form name="form1" id="form1">
<body onload="showMap();">
	<div id="map_canvas"  style="padding:100px;width:300px;height:300px;"></div>
	<div id="photoPanel"></div>
</body>
</form>
</html>
