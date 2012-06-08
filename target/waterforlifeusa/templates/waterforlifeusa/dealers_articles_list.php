<div id="content" class="gradient_top content-inner"> <? print $this->content_model->getBreadcrumbsByURLAndPrintThem(); ?>
  <div style="height: 40px;">
    <!--  -->
  </div>
  
  <script src="http://maps.google.com/maps/api/js?sensor=false" 
          type="text/javascript"></script>
          
          <script>
          var locations = [];
          </script>
          
     <div id="map" style="width: 800px; height: 500px;"></div>

  
 
  <div id="map"></div>
  <!-- main -->
  <? 
	 
      $related = array();
	  $related['selected_categories'] = array($page['content_subtype_value']);
	  $limit[0] = 0;
	  $limit[1] = 3000;
	  $posts = $this->content_model->getContentAndCache($related, false,$limit ); 

	  ?>
      
      <br />


      <h2>All dealers list</h2>
      <br />
  <table width="100%" border="0" cellspacing="10" cellpadding="5" style="border:1px, solid; border-color:#09C">
    <? if(!empty($posts)): ?>
    <?  //include(ACTIVE_TEMPLATE_DIR.'articles_img_slider_top.php') ;  ?>
    <?  //include(ACTIVE_TEMPLATE_DIR.'articles_search_bar.php') ;  ?>
    <? foreach ($posts as $the_post): ?>
       
    <? 	$more = false; $more = $this->core_model->getCustomFields('table_content', $the_post['id']);	$the_post['custom_fields'] = $more;  ?>
    <script>
	
	var locations1 = ['<? print $more['dealer_city']; ?>, <? print $more['dealer_zip']; ?>', '<? print addslashes($the_post['content_title']); ?>', '<? print $this->content_model->contentGetHrefForPostId($the_post['id']) ; ?>'];
 
	
    locations.push(locations1);

    
    </script>
    
 
    <tr>
     <td>
     <? //p($more); ?>
     <img src="<? print  $thumb = $this->content_model->contentGetThumbnailForContentId($the_post['id'], 150); ?>" alt="logo" /></td>
      <td><a title="<? print $the_post['content_title']; ?>" href="<? print $this->content_model->contentGetHrefForPostId($the_post['id']) ; ?>"><? print $the_post['content_title']; ?></a></td>
     
      <td><? if($the_post['content_description'] != ''): ?>
        <? print (character_limiter($the_post['content_description'], 400, '...')); ?>
        <? else: ?>
        <? print character_limiter($the_post['content_body_nohtml'], 400, '...'); ?>
        <? endif; ?>
        </td>
        <td><a href="<? print $this->content_model->contentGetHrefForPostId($the_post['id']) ; ?>" class="read-more">Read More</a></td>
    </tr>
    <? endforeach; ?>
  </table>
  
  
  
  <script type="text/javascript">
   /* var locations = [
      ['Bondi Beach', -33.890542, 151.274856, 4],
      ['Coogee Beach', -33.923036, 151.259052, 5],
      ['Cronulla Beach', -34.028249, 151.157507, 3],
      ['Manly Beach', -33.80010128657071, 151.28747820854187, 2],
      ['Maroubra Beach', -33.950198, 151.259302, 1]
    ];*/
 geocoder = new google.maps.Geocoder();
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 10,
      center: new google.maps.LatLng(-33.92, 151.25),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();
function attachSecretMessage(marker, msg) {
  //var message = ["This","is","the","secret","message"];
  var infowindow = new google.maps.InfoWindow(
      { content: msg,
        size: new google.maps.Size(50,50)
      });
  google.maps.event.addListener(marker, 'click', function() {
    infowindow.open(map,marker);
  });
}
    var marker, i;
//alert(locations);
    for (i = 0; i < locations.length; i++) {  
     /* marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map
      });*/


 var address = locations[i][0];
  var title1 = locations[i][1];
   var link1 = locations[i][2];
// alert(address);
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        map.setCenter(results[0].geometry.location);
        var marker = new google.maps.Marker({
            map: map, 
			title: title1,
            position: results[0].geometry.location
        });
		msg = '<a href="'+link1+'">'+title1+'</a>' ; 
		 attachSecretMessage(marker, msg);
		
	 
		
		
		
      } else {
        //alert("Geocode was not successful for the following reason: " + status);
      }
    });


      
    }
  </script>
  <? else : ?>
  No posts here!
  <? endif; ?>
   
  <div class="c d"></div>
  <br />
  <br />
  <? //include(ACTIVE_TEMPLATE_DIR.'bottom_banners.php');  ?>
 
<!-- /#main -->
<?  //include(ACTIVE_TEMPLATE_DIR.'dealers_side_nav.php') ;  ?>
</div>
<!-- /#content -->
