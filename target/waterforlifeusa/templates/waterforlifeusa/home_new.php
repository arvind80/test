<div id="home_head" style="height: auto;margin-bottom: 15px">
  <div id="home_head_image_3" class="tbib">

  <script>

  document.getElementById('nav').getElementsByTagName('li')[0].className = 'active';

  $(document).ready(function(){
    //$(".E-mage img").draggable()
    $(".home_test:last").css("border","none");
  });
  </script>

 <div class="XV_slogan">
    Exclusive Distributor of EOS and Hyungsung Water Ionizers
 </div>

  <div class="home_images_XV">

<?

$the_id = 1497;
	 //var_dump($active_categories); 
	 $the_lowest_price = false;
      $related = array();
	  $related['id'] = ($the_id);
//	  $related['title'] = 'Genesis Platinum Water Ionizer';
	  $limit[0] = 0;
	  $limit[1] = 1;
	  $related = $this->content_model->getContentAndCache($related, false,$limit );
	  
	  
	  $more = false;
 $more = $this->core_model->getCustomFields('table_content', $the_id);
	// var_dump( $more); 
	  ?>
  
  <? /*
  Product 1
  */ ?>
 
  
  <div class="home_prd">
    <span class="E-mage">
        <img style="left: -50px;top: -88px;" src="<? print TEMPLATE_URL ?>img/prd_1.png" alt="" />
    </span>

    <div class="home_prd_content">
        <span class="home_prd_txt">
            <? //print character_limiter($related['content_description'], 175) ?>
            <strong>Revelation TURBO Undersink Water Ionizer</strong>:  9 plate TURBO water ionizer with 325 watts of power. 76 pH settings, premium four filter system, seven color LCD screen and luxurious design.
        </span>
        <span class="home_prd_price">
            Price $<? print  $more['price1']; ?>
        </span>
        <a href="<? print $this->content_model->getContentURLByIdAndCache($the_id) ; ?>" class="btn">Buy it now</a>
        <div class="c" style="padding-bottom: 5px;"></div>
        <a href="<? print $this->content_model->getContentURLByIdAndCache($the_id) ; ?>" class="somelnk">Learn More</a>
    </div>
  </div>

  <? /*
  Product 2
  */ ?>


<?

$the_id = 1565;
	 //var_dump($active_categories); 
	 $the_lowest_price = false;
      $related = array();
	  $related['id'] = ($the_id);
//	  $related['title'] = 'Genesis Platinum Water Ionizer';
	  $limit[0] = 0;
	  $limit[1] = 1;
	  $related = $this->content_model->getContentAndCache($related, false,$limit );
	   $more = false;
 $more = $this->core_model->getCustomFields('table_content', $the_id);
	  ?>
   
  
   <?  $related =  $related[0] ?>

  <div class="home_prd">
    <span class="E-mage">
        <img style="left: -74px; top: -75px;" src="<? print TEMPLATE_URL ?>img/prd_2.png" alt="" />
    </span>

    <div class="home_prd_content">
        <span class="home_prd_txt"> <? // print character_limiter($related['content_description'], 175) ?>
        
        <strong>Genesis Equus TURBO Water Ionizer</strong>:  Countertop 9 plate Turbo water ionizer with 325 watts of power,  76 pH levels, dual filtration system, seven color LCD, and modern design.
        </span>
        <span class="home_prd_price">
            Price $<? print  $more['price1']; ?>
        </span>
         <a href="<? print $this->content_model->getContentURLByIdAndCache($the_id) ; ?>" class="btn">Buy it now</a>
        <div class="c" style="padding-bottom: 5px;"></div>
        <a href="<? print $this->content_model->getContentURLByIdAndCache($the_id) ; ?>" class="somelnk">Learn More</a>
    </div>
  </div>


 <? /*
 Product 3
 */ ?>
 <?

$the_id = 1544;
	 //var_dump($active_categories); 
	 $the_lowest_price = false;
      $related = array();
	  $related['id'] = ($the_id);
//	  $related['title'] = 'Genesis Platinum Water Ionizer';
	  $limit[0] = 0;
	  $limit[1] = 1;
	  $related = $this->content_model->getContentAndCache($related, false,$limit );
	  
	   $more = false;
 $more = $this->core_model->getCustomFields('table_content', $the_id);
	  ?>
   
   <?  $related =  $related[0] ?>
   
  <div class="home_prd">
    <span class="E-mage">
        <img style="left: -77px; top: -66px;" src="<? print TEMPLATE_URL ?>img/prd_3.png" alt="" />
    </span>

    <div class="home_prd_content">
        <span class="home_prd_txt"><? // print character_limiter($related['content_description'], 175) ?>
        <strong>Genesis Platinum Water Ionizer</strong>:  7 plate countertop water ionizer with 300 watts of power, 76 pH levels, dual filtration system, seven color LCD screen and modern design.
        </span>
        <span class="home_prd_price">
            Price $<? print  $more['price1']; ?>
        </span>
           <a href="<? print $this->content_model->getContentURLByIdAndCache($the_id) ; ?>" class="btn">Buy it now</a>
        <div class="c" style="padding-bottom: 5px;"></div>
        <a href="<? print $this->content_model->getContentURLByIdAndCache($the_id) ; ?>" class="somelnk">Learn More</a>
    </div>
  </div>


   <? /*
 Product 4
 */ ?>
  <?

$the_id = 1534;
	 //var_dump($active_categories); 
	 $the_lowest_price = false;
      $related = array();
	  $related['id'] = ($the_id);
//	  $related['title'] = 'Genesis Platinum Water Ionizer';
	  $limit[0] = 0;
	  $limit[1] = 1;
	  $related = $this->content_model->getContentAndCache($related, false,$limit );
	  
	    
	   $more = false;
 $more = $this->core_model->getCustomFields('table_content', $the_id);
	  ?>
 
  
   <?  $related =  $related[0] ?>
   
   
  <div class="home_prd">
    <span class="E-mage">
        <img style="left: -61px; top: -106px;" src="<? print TEMPLATE_URL ?>img/prd_4.png" alt="" />
    </span>

    <div class="home_prd_content">
        <span class="home_prd_txt"><? //print character_limiter($related['content_description'], 175) ?>
        <strong>Hybrid Portable Water Ionizer</strong>:  World's first Hybrid, can connect to your tap or you can pour water directly inside!  Convenient handle for easy carrying. Powerful ionization and internal filter. 
        </span>
        <span class="home_prd_price">
            Price $<? print  $more['price1']; ?>
        </span>
         <a href="<? print $this->content_model->getContentURLByIdAndCache($the_id) ; ?>" class="btn">Buy it now</a>
        <div class="c" style="padding-bottom: 5px;"></div>
        <a href="<? print $this->content_model->getContentURLByIdAndCache($the_id) ; ?>" class="somelnk">Learn More</a>
    </div>
  </div>

    </div>
 <div class="c">&nbsp;</div>


 <div style="text-align: center;color: #0B5989;padding: 43px 0 25px;font-size: 11px;">

 For all of our products we have:
 </div>

<div class="evolution_ico">

    <a href="<? print $this->content_model->getContentURLByIdAndCache(1563) ; ?>">
        <strong><img src="<? print TEMPLATE_URL ?>img/mbg.jpg" alt="" /> </strong>
        <span>60 Day Money Back Guarantee</span>
    </a>
    
    
    
    <a href="<? print $this->content_model->getContentURLByIdAndCache(111) ; ?>">
        <strong><img src="<? print TEMPLATE_URL ?>img/war.jpg" alt="" /></strong>
        <span>5 Years Unlimited Parts and Labor Warranty</span>
    </a>
    <a href="<? print $this->content_model->getContentURLByIdAndCache(1564) ; ?>">
        <strong><img src="<? print TEMPLATE_URL ?>img/tf.jpg" alt="" /></strong>
        <span>All Orders Are Sales Tax Free</span>
    </a>

</div>
<div class="c">&nbsp;</div>
<div class="c" style="border-bottom: 3px solid #0B5A8A; margin: 0 0 0 10px;width: 947px;">&nbsp;</div>


</div>








  


 <? /*
     <? print site_url('products'); ?>
     <? print site_url('testimonials'); ?>
     <? print site_url('certificates'); ?>
     <? print $this->content_model->getContentURLByIdAndCache(1534) ; ?>
 */ ?>


  <script type="text/javascript">
                            $(function(){
                                FLIR.replace(document.getElementById('baner_h2'),  new FLIRStyle({ cFont:'kozukagoprobold', cColor:'1D3D85', cSize:'17'}));
                                FLIR.replace(document.getElementById('banprice'),  new FLIRStyle({ cFont:'kozukagoprobold', cColor:'F7417E', cSize:'29'}));

                             

                            })
                        </script>
</div>


<div id="content">
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


    <h2 class="titleX" >What our clients say:</h2>
    <div class="c" style="padding-bottom: 12px;">&nbsp;</div>
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



  <div id="featured_video" class="fx_2" style="width: 943px;padding-left:0; ">
  
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
<div class="c" style="padding-bottom: 10px;">&nbsp;</div>




<a href="<? print site_url('certificates'); ?>" class="certx">See our certifications </a>
<a href="<? print site_url('testimonials'); ?>" class="testx">Read All Testimonials</a>




  
<? /*
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
*/ ?>

  <div class="c" style="padding-bottom: 22px;">&nbsp;</div>

   <? 
      $announcements = array();
	  $announcements['selected_categories'] = array(427);
	  $limit[0] = 0;
	  $limit[1] = 3;
	  $announcements = $this->content_model->getContentAndCache($announcements, false,$limit,  $count_only = false, $short = true, $only_fields = array ('id', 'content_type', 'content_url', 'content_title' ) );

	  ?>
      
      <? foreach($announcements as $announcement): ?>
   <div class="home_test">
   <strong><a href="<? print $this->content_model->contentGetHrefForPostId($announcement['id']) ; ?>"><? print $announcement['content_title']; ?></a></strong>

<p>
  <? print $announcement['content_description']; ?>
</p>



   </div>

<? endforeach; ?>

    


   <div class="xn_title">
    <a href="<? print $this->taxonomy_model->getUrlForIdAndCache(448); ?>">WFL News</a>
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
 
<? endif; ?>
   
   
  <div class="c" style="padding-bottom: 10px;"></div>
   <div class="xn_news">
        <h2><a href="<? print $this->content_model->contentGetHrefForPostId($announcements[0]['id']) ; ?>"><? print $announcements[0]['content_title']; ?></a></h2>
        <a href="<? print $this->content_model->contentGetHrefForPostId($announcements[0]['id']) ; ?>" class="img">
            <img src="<? print $thumb = $this->content_model->contentGetThumbnailForContentId($announcements[0]['id'], 200); ?>" alt="" />
        </a>
        <div class="xn_news_content richtext">


<? print html_entity_decode( $announcements[0]['content_body']); ?>





        </div>
   </div>

  <div class="c" style="padding-bottom: 20px;">&nbsp;</div>

  <a href="<? print $this->content_model->contentGetHrefForPostId($announcements[0]['id']) ; ?>" class="btn right" style="margin:0 40px;">Read more</a>
  <a href="<? print $this->taxonomy_model->getUrlForIdAndCache(448); ?>" class="btn right">Read All News</a>


  <!-- /home_blocks -->
</div>
<!-- /#content -->
