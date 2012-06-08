<div id="home_head" style="height: auto;margin-bottom: 15px">
  <div id="home_head_image_3" class="tbib">
    <script>

  document.getElementById('nav').getElementsByTagName('li')[0].className = 'active';

  $(document).ready(function(){
    //$(".E-mage img").draggable()
    $(".home_test:last").css("border","none");
  });
  </script>
    <div class="XV_slogan"> Exclusive Distributor of EOS and Hyungsung Water Ionizers </div>
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
      <div class="home_prd"> <span class="E-mage"> <img style="left: -50px;top: -88px;" src="<? print TEMPLATE_URL ?>img/prd_1.png" alt="" /> </span>
        <div class="home_prd_content"> <span class="home_prd_txt">
          <? //print character_limiter($related['content_description'], 175) ?>
          <strong>Revelation TURBO Undersink Water Ionizer</strong>:  9 plate TURBO water ionizer with 325 watts of power. 76 pH settings, premium four filter system, seven color LCD screen and luxurious design. </span> <span class="home_prd_price"> Price $<? print  $more['price1']; ?> </span> <a href="<? print $this->content_model->getContentURLByIdAndCache($the_id) ; ?>" class="btn">Buy it now</a>
          <div class="c" style="padding-bottom: 5px;"></div>
          <a href="<? print $this->content_model->getContentURLByIdAndCache($the_id) ; ?>" class="somelnk">Learn More</a> </div>
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
      <div class="home_prd"> <span class="E-mage"> <img style="left: -74px; top: -75px;" src="<? print TEMPLATE_URL ?>img/img_02.png" alt="" /> </span>
        <div class="home_prd_content"> <span class="home_prd_txt">
          <? // print character_limiter($related['content_description'], 175) ?>
          <strong>Genesis Platinum 9 TURBO Water Ionizer</strong>:  Countertop 9 plate Turbo water ionizer with 325 watts of power,  76 pH levels, dual filtration system, seven color LCD, and modern design. </span> <span class="home_prd_price"> Price $<? print  $more['price1']; ?> </span> <a href="<? print $this->content_model->getContentURLByIdAndCache($the_id) ; ?>" class="btn">Buy it now</a>
          <div class="c" style="padding-bottom: 5px;"></div>
          <a href="<? print $this->content_model->getContentURLByIdAndCache($the_id) ; ?>" class="somelnk">Learn More</a> </div>
      </div>
      <? /*
 Product 3
 */ ?>
      <?

$the_id = 1506;
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
      <div class="home_prd"> <span class="E-mage"> <img style="left: -77px; top: -66px;" src="<? print TEMPLATE_URL ?>img/img_01.png" alt="" /> </span>
        <div class="home_prd_content"> <span class="home_prd_txt">
          <? // print character_limiter($related['content_description'], 175) ?>
          <strong>Genesis Platinum Water Ionizer</strong>:  7 plate countertop water ionizer with 300 watts of power, 76 pH levels, dual filtration system, seven color LCD screen and modern design. </span> <span class="home_prd_price"> Price $<? print  $more['price1']; ?> </span> <a href="<? print $this->content_model->getContentURLByIdAndCache($the_id) ; ?>" class="btn">Buy it now</a>
          <div class="c" style="padding-bottom: 5px;"></div>
          <a href="<? print $this->content_model->getContentURLByIdAndCache($the_id) ; ?>" class="somelnk">Learn More</a> </div>
      </div>
      <? /*
 Product 4
 */ ?>
      <?

$the_id = 1516;
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
      <div class="home_prd"> <span class="E-mage"> <img style="left: -61px; top: -106px;" src="<? print TEMPLATE_URL ?>img/prd_4.png" alt="" /> </span>
        <div class="home_prd_content"> <span class="home_prd_txt">
          <? //print character_limiter($related['content_description'], 175) ?>
          <strong>Hybrid Portable Water Ionizer</strong>:  World's first Hybrid, can connect to your tap or you can pour water directly inside!  Convenient handle for easy carrying. Powerful ionization and internal filter. </span> <span class="home_prd_price"> Price $<? print  $more['price1']; ?> </span> <a href="<? print $this->content_model->getContentURLByIdAndCache($the_id) ; ?>" class="btn">Buy it now</a>
          <div class="c" style="padding-bottom: 5px;"></div>
          <a href="<? print $this->content_model->getContentURLByIdAndCache($the_id) ; ?>" class="somelnk">Learn More</a> </div>
      </div>
    </div>
    <div class="c">&nbsp;</div>
    <div style="text-align: center;color: #0B5989;padding: 43px 0 25px;font-size: 11px;"> For all of our products we have: </div>
    <div class="evolution_ico"> <a href="<? print $this->content_model->getContentURLByIdAndCache(1563) ; ?>"> <strong><img src="<? print TEMPLATE_URL ?>img/mbg.jpg" alt="" /> </strong> <span>60 Day Money Back Guarantee</span> </a> <a href="<? print $this->content_model->getContentURLByIdAndCache(111) ; ?>"> <strong><img src="<? print TEMPLATE_URL ?>img/war.jpg" alt="" /></strong> <span>5 Years Unlimited Parts and Labor Warranty</span> </a> <a href="<? print $this->content_model->getContentURLByIdAndCache(1564) ; ?>"> <strong><img src="<? print TEMPLATE_URL ?>img/tf.jpg" alt="" /></strong> <span>All Orders Are Sales Tax Free</span> </a> </div>
    <div class="c">&nbsp;</div>
    <div class="c" style="border-bottom: 3px solid #0B5A8A; margin: 0 0 0 10px;width: 947px;">&nbsp;</div>
  </div>
  <style>
.home_sep_11_hl {
	background-color:#fffbba;
	width:100%;
	height:40px;
	
	
}
.home_sep_11_hl_table {
	font-family:Verdana, Geneva, sans-serif;
	font-size:14px;
	color:#084873;
	
}
.home_sep_11_hl_table td {
	padding-left:10px;
	
}

.home_sep_11_hl_table td a{
		font-family:Verdana, Geneva, sans-serif;
	font-size:14px;
	color:#084873;
	text-decoration:none;
	line-height:40px;
}

.home_sep_11_hl_table td a img {
	margin-left:10px;
	margin-top:13px;
	margin-right:2px;
	
}

.home_sep_11_hl_table .comm {
	margin-left:0px !important;
	margin-top:0px !important;
	margin-right:0px !important;
	margin: 0px !important; 
	
}

.home_sep_11_hl_div {
 height:210px;	
}
</style>
  <div class="home_sep_11_hl_div">
    <h2 class="titleX">See also:</h2>
    <div style="padding-bottom: 12px;" class="c">&nbsp;</div>
    <div class="home_sep_11_hl">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="home_sep_11_hl_table">
        <tr valign="middle">
          <td><a href="<? print site_url("products/categories:437"); ?>"><img src="<? print TEMPLATE_URL ?>img/arr_home_sep.png" alt="" align="left" /> Prefilters</a></td>
          <td><a href="<? print site_url("products/categories:436"); ?>"><img src="<? print TEMPLATE_URL ?>img/arr_home_sep.png" alt="" align="left" /> Replacement Filters</a></td>
          <td><a href="<? print site_url("products/categories:12596"); ?>"><img src="<? print TEMPLATE_URL ?>img/arr_home_sep.png" alt="" align="left" />Special Filters</a></td>
          <td><a href="<? print site_url("products/categories:438"); ?>"><img src="<? print TEMPLATE_URL ?>img/arr_home_sep.png" alt="" align="left" />Accessories</a></td>
          <td><a href="<? print site_url("products/about-us"); ?>"><img src="<? print TEMPLATE_URL ?>img/arr_home_sep.png" alt="" align="left" />Why WFL?</a></td>
          <td><style>
      

      .audiojs { height: 31px; background: #f19dba;
	  width: 280px; 
	  box-shadow: 1px 1px 8px rgba(0, 0, 0, 0);
	  border-radius: 5px; 

-moz-border-radius: 5px; 

-webkit-border-radius: 5px; 

border: 1px solid #f19dba;
       }
      .audiojs .play-pause { width: 15px; height: 31px; padding: 0px 8px 0px 0px;  border-right: 1px solid #FFF; }
     .audiojs p {
    height: 31px;
    margin: 2px 0 0 -1px;
    width: 25px;
}

 
      .audiojs .scrubber { background: #FFF; width: 230px; height: 20px; margin: 5px; }
	  .audiojs .time { display:none;}
	  
      .audiojs .progress { height: 31px; width: 0px; background-color:#CCC;
        background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #ccc), color-stop(0.5, #ddd), color-stop(0.51, #ccc), color-stop(1, #ccc));
        background-image: -moz-linear-gradient(center top, #ccc 0%, #ddd 50%, #ccc 51%, #ccc 100%); }
      .audiojs .loaded { height: 31px; background: #dbeff8;
        background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #dbeff8), color-stop(0.5, white), color-stop(0.51, #dbeff8), color-stop(1, white));
        }
      .audiojs .time { float: left; height: 25px; line-height: 25px; }
      .audiojs .error-message { height: 24px;line-height: 24px; }

      .track-details { clear: both; height: 20px; width: 448px; padding: 1px 6px; background: #eee; color: #222; font-family: monospace; font-size: 11px; line-height: 20px;
        -webkit-box-shadow: inset 1px 1px 5px rgba(0, 0, 0, 0.15); -moz-box-shadow: inset 1px 1px 5px rgba(0, 0, 0, 0.15); }
      .track-details:before { content: '♬ '; }
      .track-details em { font-style: normal; color: #999; }
    </style>
            <script src="<? print TEMPLATE_URL ?>js/audiojs/audiojs/audio.min.js"></script>
            <script>
			
			function audiopl(){
				 $("#play_commercial_a").html('<audio src="<? print TEMPLATE_URL ?>mp3/WATERFORLIFEUSA COMMERCIAL.mp3" preload="auto" autoplay></audio>');
				 $("#play_commercial").remove();
				
				
				  var a = audiojs;
				  var a1 = a.createAll();
 
			}
			
    
	  
	  
	  
	  
    </script>
            <a onclick="audiopl()" id="play_commercial"><img  class="comm" src="<? print TEMPLATE_URL ?>img/listen.png" alt="" /></a>
            <div id="play_commercial_a"> </div></td>
        </tr>
      </table>
      <br />
      <a href="<? print site_url("resources/countertop-water-ionizer-comparison"); ?>"><img src="<? print TEMPLATE_URL ?>img/banner_september.png" alt=""  /></a> </div>
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
  <a href="#" id="top_add"> <span id="top_add_image"> <img alt="" src="<? print TEMPLATE_URL; ?>affimg/add_image_2.jpg"> </span> <span id="top_add_txt"> <strong>Genesis Platinum</strong> <span>alkaline water ionizer</span> </span> </a>
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
  <table width="100%" border="0" cellspacing="5" cellpadding="5">
    <tr>
      <td><a href="<? print site_url('certificates'); ?>" class="certx">See our certifications </a> <a href="<? print site_url('testimonials'); ?>" class="testx">Read All Testimonials</a></td>
      <td><div id="frogit_seal_1931" style="width:129px !important; height: auto !important;">
          <div><a href="http://www.frogit.com" target="_blank" title="FrogIt - Price Comparison Shopping"><img src="https://www.frogit.com/images/frogit_banner_top.png" alt="FrogIt - Price Comparison Shopping" border="0" width="129" height="41" /></a></div>
          <div align="center" style="background: #FFFFFF !important;word-wrap:break-word !important;"><a target="_blank" href="http://www.frogit.com/store_view/Water-for-Life-USA-1931" style="color:#3e3e3e !important;font-family:sans-serif !important;font-weight:bold !important;font-size:11px !important;text-decoration:none !important;">Water for Life USA</a></div>
          <div style="background: #20bc30 !important;padding-top: 3px !important; vertical-align: middle !important;text-align: center !important;word-wrap:break-word !important;height: auto !important;"><a target="_blank" href="http://www.frogit.com/results/water+ionizers" style="color:#FFFFFF !important;font-family:sans-serif !important;font-weight:bold !important;font-size:11px !important;text-decoration:none !important;">water ionizers</a></div>
        </div>
        <img src="https://www.frogit.com/images/frogit_banner_bottom.png" width="129" height="4"></td>
        <td> 
<p>
<a class="tf_upfront_badge" href="http://www.thefind.com/store/about-waterforlifeusa" title="TheFind Upfront"><img alt="Water for Life USA is an Upfront Merchant on TheFind. Click for info." border="0" src="//upfront.thefind.com/images/badges/s/e7/14/e714c3b2bda36921c13de13dd077dcc1.png" /></a></p>
<script type="text/javascript">// <![CDATA[
    (function() {
      var upfront = document.createElement('SCRIPT'); upfront.type = "text/javascript"; upfront.async = true;
      upfront.src = document.location.protocol + "//upfront.thefind.com/scripts/main/utils-init-ajaxlib/upfront-badgeinit.js";
      upfront.text = "thefind.upfront.init('tf_upfront_badge', 'e714c3b2bda36921c13de13dd077dcc1')";
      document.getElementsByTagName('HEAD')[0].appendChild(upfront);
    })();
// ]]></script></td>
 
    </tr>
  </table>
  <? /*
  	<? if(!empty($subdomain_user)): ?>
  <div id="home_blocks" class="cblock wrap gradient_top">
    <div class="xtext">
      <? if(trim($subdomain_user['user_homepage']) == ''): ?>
      <? $affiliateHome = $this->content_model->contentGetByIdAndCache(181); ?>
      <? print $affiliateHome['content_body']; ?>
      <? else: ?>
      <? print $subdomain_user['user_homepage']; ?>
      <? endif; ?>
    </div>
    <br />
    <br />
    <div id="aff_subscribe">
      <?php include "subscribe_form.php" ?>
    </div>
  </div>
  <? else: ?>
  <div id="home_blocks" class="cblock wrap gradient_top" style="width: 905px"> <? print htmlspecialchars_decode ( html_entity_decode(html_entity_decode($page['content_body']))); ?> </div>
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
  <div class="home_test"> <strong><a href="<? print $this->content_model->contentGetHrefForPostId($announcement['id']) ; ?>"><? print $announcement['content_title']; ?></a></strong>
    <p> <? print $announcement['content_description']; ?> </p>
  </div>
  <? endforeach; ?>
  <div class="xn_title"> <a href="<? print $this->taxonomy_model->getUrlForIdAndCache(448); ?>">WFL News</a> </div>
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
    <a href="<? print $this->content_model->contentGetHrefForPostId($announcements[0]['id']) ; ?>" class="img"> <img src="<? print $thumb = $this->content_model->contentGetThumbnailForContentId($announcements[0]['id'], 200); ?>" alt="" /> </a>
    <div class="xn_news_content richtext"> <? print html_entity_decode( $announcements[0]['content_body']); ?> </div>
  </div>
  <div class="c" style="padding-bottom: 20px;">&nbsp;</div>
  <a href="<? print $this->content_model->contentGetHrefForPostId($announcements[0]['id']) ; ?>" class="btn right" style="margin:0 40px;">Read more</a> <a href="<? print $this->taxonomy_model->getUrlForIdAndCache(448); ?>" class="btn right">Read All News</a>
  <div class="c" style="padding-bottom: 10px;"></div>
  <div class="xn_title"> Why Ionized Water Instead of Bottled Water or Tap Water? </div>
  <div class="xn_news"> <a href="<? print $this->content_model->contentGetHrefForPostId($announcements[0]['id']) ; ?>" class="img"> <img src="<? print TEMPLATE_URL; ?>img/Earth-in-GlassWEB.jpg" alt="" /> </a>
    <div class="xn_news_content richtext">
      <p><strong>EOS Water Ionizers</strong> produce medical grade <strong>ionized water, </strong>which <a href="http://waterforlifeusa.com/resources/wfl-download-center">peer reviewed</a> research has shown has tremendous health benefits for you and your family.  Using <strong>water electrolysis</strong> to create <strong>alkaline, ionized water</strong> is the only way to restore water's natural <strong>antioxidant</strong> - <strong>hydroxl ions</strong>.  </p>
      <p><br />
      </p>
      <p>Natural water, like from a spring or a glacial stream, is full of ions from the sun.  These ions combine with hydrogen to form <strong>hydroxl ions</strong>, which neutralize <strong>free radicals</strong> in our body and<strong> detoxify</strong> us.  But when we take natural water and put it in a tank like at a   municipal water treatment plant, or in a bottle, those ions fizzle out   and we are left with dead,<strong> acidic water with no antioxidants.</strong></p>
      <p><strong><br />
        </strong></p>
      <p>Dead,   acidic water takes important nutrients and minerals from our body, and   builds up acidic waste, leading to a condition called <strong>acidosis</strong>.    Acidosis starts with muscle aches, poor digestion, poor sleep pattern   and irritability, and progresses to adult onset diseases like arthritis,   pulmonary disease, and even cancer. </p>
      <p><br />
      </p>
      <p>Conversely,   alkaline, ionized water as part of an <strong>alkaline diet</strong> full of <strong>alkaline food</strong> cleanses the free radicals from our body,   neutralizes acid waste with its alkaline properties, and hydrates us   three times better than tap or bottled water!</p>
      <p><br />
      </p>
      <p>The only way to bring dead water back to life is through <strong>water electrolysis</strong> and no <strong>water ionizer </strong>manufacturer on the market does it better than EOS! Plus EOS Water Ionizers have<strong> medical grade water filtration</strong> to remove all the dangerous impurities from your water.<br />
      </p>
      <p><br />
      </p>
      <p>EOS   <a href="http://waterforlifeusa.com/products">Water Ionizers</a>, like the<strong> <a href="http://waterforlifeusa.com/products/genesis-platinum-water-ionizer101104095027">Genesis Platinum</a></strong> and<strong> <a href="http://waterforlifeusa.com/products/genesis-equus-turbo-water-ionizer">Genesis Equus</a></strong>, and <strong><a href="<? print $this->content_model->getContentURLByIdAndCache(1497) ; ?>">Revelation</a></strong> distributed by <strong>Water for Life USA</strong>, are the best health   investment for you and your family.  Our water ionizers are KFDA   approved as a medical device, FDA listed, NRTL certified for electrical safety, have   patented slotted plate technology from the top metal company in Japan,   and are backed by an unconditional 5 year parts, labor, and shipping   warranty and 60 day money back guarantee (link &quot;60 day money back guarantee&quot; to <a href="http://waterforlifeusa.com/water-for-life-usa-policies" target="_blank">http://waterforlifeusa.com/water-for-life-usa-policies</a>)</p>
      <p> Have questions?  <strong>Call 877-255-3713</strong> or  email us at info@waterforlifeusa.com.  We have knowledgeable staff waiting to hear from you!</p>
    </div>
  </div>
  <!-- /home_blocks -->
</div>
<!-- /#content -->
