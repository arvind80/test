<?php
 
$dealers = array();
$dealers_zip_buf = array();
$dealers_zip = array();
$dealers['is_admin'] = 'n';
$dealers['is_active'] = 'y';
$dealers['show_on_map'] = 'y';
//$dealers['country'] = 'USA';
if(isset($_POST['zip'])){
	$dealers['zip'] = $_POST['zip'];
}

$dealers_zip_buf = $this->users_model->getUsersForGMaps($dealers,false, $count_only = false );
$foundRows = count($dealers_zip_buf);

// if serarch by zip and there is nothing found, show all results
if (isset($dealers['zip']) && !$foundRows) {
	unset($dealers['zip']);
	$dealers_zip_buf = $this->users_model->getUsersForGMaps($dealers,false, $count_only = false );
}

//array_unique($dealers);
$cnt = (count($dealers_zip_buf) > 20) ? 20 : count($dealers_zip_buf);
$dealers = array();
$p = 0;
for($i=0; $i < $cnt; $i++){
	$zip = trim($dealers_zip_buf[$i]['zip']);
	$addr1 = trim($dealers_zip_buf[$i]['addr1']);
	$country = trim($dealers_zip_buf[$i]['country']);
	if($zip && $addr1 && $country ){
		$dealers[$p]['zip'] = $zip;
		$dealers[$p]['addr1'] = str_replace('#','',$addr1);
		$dealers[$p]['country'] = $country;
		$dealers[$p]['phone'] = trim($dealers_zip_buf[$i]['phone']);
		$dealers[$p]['fax'] = trim($dealers_zip_buf[$i]['fax']);
		$dealers[$p]['email'] = trim($dealers_zip_buf[$i]['email']);
		$dealers[$p]['website'] = trim($dealers_zip_buf[$i]['website']);
		if($dealers[$p]['first_name'])
			$dealers[$p]['name'] = trim($dealers_zip_buf[$i]['first_name']);
		if($dealers[$p]['last_name'])
			$dealers[$p]['name'] .= " ".trim($dealers_zip_buf[$i]['last_name']);
		$p++;
	}		
}
$cnt = (count($dealers) > 500) ? 500 : count($dealers);
for($i=0; $i < $cnt; $i++){
	$dealers_zip[$i]['zip'] = trim($dealers[$i]['zip']) . ',' .trim($dealers[$i]['addr1']) . ',' . trim($dealers[$i]['country']);
	$dealers_zip[$i]['address'] = '<span style=&quote;font: 12px Verdana, Arial, Helvetica, sans-serif; color: #000;&quote;><b>ZIP:</b> ' . trim($dealers[$i]['zip']) .'<br /><b>Address:</b> '. trim($dealers[$i]['addr1']) . ',' . trim($dealers[$i]['country']);
	if($dealers[$i]['name']) $dealers_zip[$i]['address'] .= "<br /><b>Name:</b> {$dealers[$i]['name']}";	
	if($dealers[$i]['phone']) $dealers_zip[$i]['address'] .= "<br /><b>Phone:</b> {$dealers[$i]['phone']}";
	if($dealers[$i]['fax']) $dealers_zip[$i]['address'] .= "<br /><b>FAX:</b> {$dealers[$i]['fax']}";
	if($dealers[$i]['email']) $dealers_zip[$i]['address'] .= "<br /><b>Email:</b> <a href='mailto:{$dealers[$i]['email']}' >{$dealers[$i]['email']}</a>";	
	if($dealers[$i]['website'] != '' && $dealers[$i]['website'] != 'http://') {
		$dealers_zip[$i]['address'] .= "<br /><b>Site:</b> <a target=\"_blank\" href='http://{$dealers[$i]['website']}' >{$dealers[$i]['website']}</a>";
	}
 	$dealers_zip[$i]['address'] .= '</span>';	
}

//$dealers_zip = array_unique($dealers_zip_buf);
//p($dealers_zip);
?>


<div id="home_head" style="height: auto">
  <div id="in-banner" class="contact-baner">
    <script type="text/javascript">
                            $(function(){
                                    FLIR.replace(document.getElementById('contact-phone'),  new FLIRStyle({ cFont:'kozukagoprobold', cColor:'ffffff', cSize:'24' }));
                                    FLIR.replace(document.getElementById('contact-slogan'),  new FLIRStyle({ cFont:'kozukagopro', cColor:'ffffff', cSize:'24' }));
                                    FLIR.replace(document.getElementById('contact-mail'),  new FLIRStyle({ cFont:'kozukagoprobold', cColor:'ffffff', cSize:'12' }));
                            })
                        </script>
    <address id="contact-phone">
    1.877.255.3713
    </address>
    <h2 id="contact-slogan">Contact us for now</h2>
    <a id="contact-mail" href="mailto:info@waterforlifeusa.com" title="info@waterforlifeusa.com">Info@waterforlifeusa.com</a> </div>
  <!-- /in-banner -->
</div>
<div id="content" class="gradient_top content-inner"> <? print $this->content_model->getBreadcrumbsByURLAndPrintThem(); ?>
  <div style="height: 40px;"><!--  --></div>
  <h2 class="blue-title left">Find a dealer</h2>
  <div class="clear" style="height: 1px;overflow: hidden"></div>
  <div class="clear"></div>
  <div id="dealers_map_canvas" style="width:100%; height:400px"></div>
  <div class="clear"></div>
</div>


<script>
var zip_arr = new Array();
<?php 
for($i=0; $i < count($dealers_zip); $i++){
	if($dealers_zip[$i]['zip']){?>
zip_arr[<? print $i;?>] = new Array();
zip_arr[<? print $i;?>][0] = "<? print str_replace(array("\r\n", "\r", "\n", "\t"), ' ', $dealers_zip[$i]['zip']);    ?>";
zip_arr[<? print $i;?>][1] = "<? print addslashes(str_replace(array("\r\n", "\r", "\n", "\t"), ' ', $dealers_zip[$i]['address']));   ?>";
<?	} 
}?>

var map = new GMap2(document.getElementById("dealers_map_canvas"));
map.addControl(new GLargeMapControl());
var geocoder = new GClientGeocoder();
var latlngbounds = new GLatLngBounds();// used for map centering

$(document).ready(function(){
	showAddresses(zip_arr);
	setTimeout("centerMap();",1000);
});

function showAddresses(zip_arr)
{
	for(i = 0; i < zip_arr.length; i++) {
		var address = zip_arr[i][0];
		var info = zip_arr[i][1];
		showAddress(address, info);
	}
}

function showAddress(address, info) {
	geocoder.getLatLng(
		address,
	    function(point) {
	    	if (!point) {
	    		console.log("not found: " + address);
	      	} else {
		    	console.log("found: " + address);
		    	marker = createMarker(point, info);
		    	latlngbounds.extend(point);
	        	map.addOverlay(marker);
			}
		}
	);
}

function centerMap()
{
	map.setCenter(new GLatLng(0,0),0);
	map.setCenter(latlngbounds.getCenter(), map.getBoundsZoomLevel(latlngbounds));
	console.log("Map centered.");
}


function createMarker(point,html) {
	var marker = new GMarker(point);
    GEvent.addListener(marker, "click", function() {
      marker.openInfoWindowHtml(html);
    });
    return marker;
}

$(document).unload( function () {
	GUnload();
} );

function __example() {

// Display the map, with some controls and set the initial location 
  var map = new GMap2(document.getElementById("dealers_map_canvas"));
  map.addControl(new GLargeMapControl());
  map.addControl(new GMapTypeControl());
  map.setCenter(new GLatLng(43.907787,-79.359741),8);

  // Set up three markers with info windows 

  var point = new GLatLng(43.65654,-79.90138);
  var marker = createMarker(point,'<div style="width:240px">Some stuff to display in the First Info Window. With a <a href="http://www.econym.demon.co.uk">Link<\/a> to my home page<\/div>');
  map.addOverlay(marker);

  var point = new GLatLng(43.91892,-78.89231);
  var marker = createMarker(point,'Some stuff to display in the<br>Second Info Window');
  map.addOverlay(marker);

  var point = new GLatLng(43.82589,-79.10040);
  var marker = createMarker(point,'Some stuff to display in the<br>Third Info Window');
  map.addOverlay(marker);

}

</script>