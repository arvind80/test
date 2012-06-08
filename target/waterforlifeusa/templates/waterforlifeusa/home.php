<div id="home_head">
  <div id="home_head_image_2" class="tbib"></div>
  <? 
	 //var_dump($active_categories); 
	 $the_lowest_price = false;
      $related = array();
	  $related['id'] = (1534); 
//	  $related['title'] = 'Genesis Platinum Water Ionizer';
	  $limit[0] = 0;
	  $limit[1] = 1;
	  $related = $this->content_model->getContentAndCache($related, false,$limit );
	  ?>
  <? if(!empty($related)): ?>
  <? foreach($related as $item): ?>
  <?
 
     
	$more = false;
 $more = $this->core_model->getCustomFields('table_content', $item['id']);
	$item['custom_fields'] = $more;
 
 
 
 for ($i = 1; $i <= 10;  $i++) : ?>
  <? if(intval($item['custom_fields']['price'.$i]) > 0): ?>
  <?	if($lowest_price != false){
			if($the_post['custom_fields']['price'.$i] > $lowest_price){
				$lowest_price = $item['custom_fields']['price'.$i];
			}
		} else {
			$lowest_price = 	intval($item['custom_fields']['price'.$i]);
		}

		?>
  <? endif; ?>
  <? endfor ; ?>
  <?
	  $the_lowest_price = $lowest_price;
	  endforeach; ?>
  <? endif;  ?>
  <a style="display: block;width:486px;height:225px;position: absolute;top:75px;left:100px;" href="<? print site_url('products'); ?>">&nbsp;</a>
  <h2 id="baner_h2" class="d">Water for Life USA Water Ionizers</h2>
  <img src="<? print TEMPLATE_URL; ?>img/walogo.png" class="d png" alt="" style="left:620px;position:absolute;top:81px;"  /> <img src="<? print TEMPLATE_URL; ?>img/banner_product_new.png" class="d png" alt="" style="left:-74px;position:absolute;top:-63px;display:none" /> <span class="d" id="banprice">From $<? print  $the_lowest_price; ?><b></b></span>
  <ul id="bnav" class="d">
    <li><a href="<? print $this->content_model->getContentURLByIdAndCache(1534) ; ?>">Learn more</a></li>
    <li><a href="<? print site_url('products'); ?>">See our products</a></li>
    <li><a href="<? print site_url('testimonials'); ?>">Loved by many</a></li>
    <li><a href="<? print site_url('certificates'); ?>">Certifications</a></li>
  </ul>
  <div id="btextintro" class="d" style="text-align: justify;width:260px;">&ldquo;I cannot say enough about the <? /*Hybrid  Portable Water Ionizer */ ?>Genesis, it works perfectly, the installation was simple, and the water tastes great&rdquo; </div>
  <script type="text/javascript">
                            $(function(){
                                FLIR.replace(document.getElementById('baner_h2'),  new FLIRStyle({ cFont:'kozukagoprobold', cColor:'1D3D85', cSize:'17'}));
                                FLIR.replace(document.getElementById('banprice'),  new FLIRStyle({ cFont:'kozukagoprobold', cColor:'F7417E', cSize:'29'}));

                             

                            })
                        </script>
</div>
<? 
      $announcements = array();
	  $announcements['selected_categories'] = array(448);
	  $limit[0] = 0;
	  $limit[1] = 1;
	  $announcements = $this->content_model->getContentAndCache($announcements, false,$limit,  $count_only = false, $short = true, $only_fields = array ('id', 'content_type', 'content_url', 'content_title' ) );

	  ?>
<? //include "certificates_rotator.php" ?>
<? if(!empty($announcements)): ?>
<div id="Announcements">
  <p> <strong><a href="<? print $this->taxonomy_model->getUrlForIdAndCache(448); ?>">Announcements: </a></strong> <span><a href="<? print $this->content_model->contentGetHrefForPostId($announcements[0]['id']) ; ?>"><? print $announcements[0]['content_title']; ?></a></span> </p>
</div>
<? endif; ?>

<div id="content" class="gradient_top">
<? if(!empty($subdomain_user)): ?>
 <a href="#" id="top_add">
    <span id="top_add_image">
       <img alt="" src="<? print TEMPLATE_URL; ?>affimg/add_image_2.jpg">
    </span>
    <span id="top_add_txt">
        <strong>Genesis Platinum</strong>
        <span>alkaline water ionizer</span>
    </span>
</a>
<? endif; ?>

    <a href="<? print site_url('testimonials'); ?>" class="btn right" style="margin-right:40px">See All testimonials</a>
    <h2 class="title" id="fvideo">Featured testimonials</h2>
  <? 
      $related = array();
	  $related['selected_categories'] = array(831);
	  $related['have_videos'] = 'y';
	  
	  
	  $limit[0] = 0;
	  $limit[1] = 10;
	  $related = $this->content_model->getContentAndCache($related, false,$limit,  $count_only = false, $short = true, $only_fields = array ('id', 'content_type', 'content_url', 'content_title', 'content_description',  'content_body' ) ); 
	// print count( $related);
	  ?>
  
	  
	  <? 
  // p($related);
  include "functions_make_playlist.php" ;
  $playlist_url = make_jw_player_playlists_from_posts_and_return_url($related);
  $playlist_url = $playlist_url.'?refresh='.rand();
  
  ?>














  <? if(!empty($subdomain_user)): ?>
   <div id="featured_video" style="width: 880px;padding-left: 0">

    <embed src="<? print TEMPLATE_URL; ?>waterforlife_wb.swf"
    quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash"
    type="application/x-shockwave-flash" width="880" height="320" style="width:880px;"></embed>

 </div>
  <? else: ?>



  <div id="featured_video" style="width: 911px">
  
  <!--

  <p id='preview'>The player will show in this paragraph</p>

<script type='text/javascript'>
var s1 = new SWFObject('/userfiles/media/flash/waterForLife_wb.swf','/userfiles/media/flash/waterForLife_wb','400','300','9');
s1.addParam('allowfullscreen','true');
s1.addParam('allowscriptaccess','always');
s1.addParam('flashvars','file=/userfiles/media/flash/waterForLife_wb.swf');
s1.write('preview');
</script>
  -->
  
  <script type="text/javascript">
	   /*	AC_FL_RunContent(
			'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0',
			'width','495',
			'height','320',
			'title','Water for Life',
			'src','/userfiles/media/flash/waterForLife_wb',
			'quality','high',
			'pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash',
			'movie','/userfiles/media/flash/waterForLife_wb', 
			'autostart', 'false',
			'autoplay', 'false',
			'flashvars', 'autoPlay=false'
		);*/ //end AC code
	</script>
	<noscript>
		<? /*<object
			classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" 
			codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0"
			width="495" 
			height="320" 
			title="Water for Life"
		>
	    	<param name="movie" value="/userfiles/media/flash/waterForLife_wb.swf">
	    	<param name="quality" value="high">
	    	<embed
	    		src="/userfiles/media/flash/waterForLife_wb.swf"
	    		quality="high" 
	    		pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash"
	    		type="application/x-shockwave-flash"
	    		width="495"
	    		height="320"
	    	></embed>
		</object> */?>


	</noscript>
    <embed src="<? print site_url();  ?>waterforlife_wb.swf" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="911" height="320" style="width:911px;"></embed>

  	<? //$homeVideo = $this->content_model->contentGetByIdAndCache(183); ?>
    <? //print html_entity_decode($homeVideo['content_body']); ?>
  
  
  <? if(FALSE) : ?>
  <object id="player-<? print  $media ['videos'][0]['id'] ?>" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" name="player" width="900" height="350">
    <param name="movie" value="<?php print_the_static_files_url() ; ?>js/media_player/player-viral.swf" />
    <param name="allowfullscreen" value="true" />
    <param name="allowscriptaccess" value="always" />
    <param name="wmode" value="transparent" />
    <param name="flashvars" value="file=<? print $playlist_url ?>&playlist=right&playlistsize=300&image=<? print $this->core_model->mediaGetThumbnailForMediaId($media ['videos'][0]['id'], '600');	?>" />
    <embed
			type="application/x-shockwave-flash"
			id="player2-<? print $media ['videos'][0]['id'] ?>"
			name="player2-<? print $media ['videos'][0]['id']  ?>"
			src="<?php print_the_static_files_url() ; ?>js/media_player/player-viral.swf"
			width="900"
			height="350"
			allowscriptaccess="always"
			allowfullscreen="true"
			wmode="transparent"
			flashvars="file=<? print $playlist_url ?>&playlist=right&playlistsize=300&image=<? print $this->core_model->mediaGetThumbnailForMediaId($media ['videos'][0]['id'], '600');	?>"	/>
  </object>
 	<? endif; ?>
 
  </div>


<? endif; ?>























  
  	<?php 
    	//$c = $this->content_model->contentGetById(1499);
		//echo $c['content_body'];
	?>

<div class="br"></div>
  
  <!--<h2 class="title" id="fvideo">Featured video</h2>
  <div id="featured_video"> <img src="<? print TEMPLATE_URL; ?>img/featured_video.jpg" alt="" /> </div>
  <div id="home_video_preview"> <a href="#" class="btn right">See All Videos</a>
    <h2 class="title left">Alderin Ordell's Testimonial</h2>
    <span class="clear subtitle">Alderin Ordell's Testimonial</span>
    <p class="p"> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
    <ul>
      <li> <a href="#"> <span style="background-image: url('<? print TEMPLATE_URL; ?>img/demo/preview1.jpg')"></span> <strong>Alderin Ordell's Testimonial</strong> </a> </li>
      <li> <a href="#"> <span style="background-image: url('<? print TEMPLATE_URL; ?>img/demo/preview2.jpg')"></span> <strong>Chuck and Kat "Infomercial"</strong> </a> </li>
      <li> <a href="#"> <span style="background-image: url('<? print TEMPLATE_URL; ?>img/demo/preview3.jpg')"></span> <strong>Alderin Ordell's Testimonial</strong> </a> </li>
      <li> <a href="#"> <span style="background-image: url('<? print TEMPLATE_URL; ?>img/demo/preview4.jpg')"></span> <strong>Chuck and Kat "Infomercial"</strong> </a> </li>
    </ul>
  </div>-->
  <!-- /home_video_preview -->
  
  	<? if(!empty($subdomain_user)): ?>
  	<div id="home_blocks" class="cblock wrap gradient_top">
	    <div class="xtext">
        <? if(trim($subdomain_user['user_homepage']) == ''): ?>
	        <? $affiliateHome = $this->content_model->contentGetByIdAndCache(181); ?>
		    <? print $affiliateHome['content_body']; ?>
            <? else: ?>
            
            <? print $subdomain_user['user_homepage']; ?><? endif; ?>
		</div>
		<br /><br />
	  	
	    <div id="aff_subscribe">
	        <?php include "subscribe_form.php" ?>
		</div>
	</div>
    <? else: ?>
    <div id="home_blocks" class="cblock wrap gradient_top" style="width: 905px">
    	 <? print htmlspecialchars_decode ( html_entity_decode(html_entity_decode($page['content_body']))); ?>
    </div>
    <? endif; ?>
  
  <!-- /home_blocks -->
</div>
<!-- /#content -->
