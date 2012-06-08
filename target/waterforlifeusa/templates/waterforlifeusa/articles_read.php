<div id="content" class="gradient_top content-inner"> <? print $this->content_model->getBreadcrumbsByURLAndPrintThem(); ?>
  <div style="height: 40px;">
    <!--  -->
  </div>
  <div id="main">
    <!-- main -->
    <?  // include(ACTIVE_TEMPLATE_DIR.'articles_img_slider_top.php') ;  ?>
    <div class="news news-inner">
      
      <a href="javascript:;" class="comments-number" onclick="scrollto('#the_comments_anchor')"><? print $this->comments_model->commentsGetCountForContentId($post['id']); ?> comments</a>
      <h2 class="blue-title-normal"><? print $post['content_title']; ?></h2>
      <div class="c"></div>
      <span class="date"><? print $post['created_on']; ?></span>
      <div class="gradient_top cblock richtext imagelimiter" style="overflow: hidden"> <? print (html_entity_decode($post['content_body'])); ?> </div>
      <?  $media = $this->content_model->mediaGetForContentId($post['id'], 'video');    
	if( $media ['videos'][0]['filename'] != '') :	?>
      <div class="c"></div>
      <br />
      <br />
      <br />
      <h2 class="blue-title-normal">Videos</h2>
      <br />
      <? foreach( $media['videos'] as $vid): ?>
      <? if(strval(trim($vid['media_name'])) != '')  : ?>
      <h3 class="blue-title-normal"> <? print($vid['media_name']); ?></h3>
      <br />
      <? endif; ?>
      <object id="player-<? print $vid['id'] ?>" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" name="player" width="640" height="480">
        <param name="movie" value="player-viral.swf" />
        <param name="allowfullscreen" value="true" />
        <param name="allowscriptaccess" value="always" />
        <param name="flashvars" value="file=<? print $vid['url']; ?>&image=<? print $this->core_model->mediaGetThumbnailForMediaId($vid['id'], '640');	?>" />
        <embed
			type="application/x-shockwave-flash"
			id="player2-<? print $vid['id'] ?>"
			name="player2-<? print $vid['id'] ?>"
			src="<?php print_the_static_files_url() ; ?>js/media_player/player-viral.swf"
			width="640"
			height="480"
			allowscriptaccess="always"
			allowfullscreen="true"
			flashvars="file=<? print $vid['url']; ?>&image=<? print $this->core_model->mediaGetThumbnailForMediaId($vid['id'], '640');	?>"	/>
      </object>
      <br />
      <? if(strval(trim($vid['media_description'])) != '')  : ?>
      <? print($vid['media_description']); ?>
      <div class="c"></div>
      <br />
      <? endif; ?>
      <br />
      <br />
      <? endforeach; ?>
      <? endif; ?>
      <? $pictures = $this->content_model->contentGetPicturesFromGalleryForContentId($post['id'], '900');
							$pictures_small1 = $this->content_model->contentGetPicturesFromGalleryForContentId($post['id'], '300');
							//$pictures_small2 = $this->content_model->contentGetPicturesFromGalleryForContentId($post['id'], '75'); 
							
							  ?>
      <? if(!empty($pictures)): ?>
      <div class="c"></div>
      <br />
      <div class="product-title">
        <h2 class="blue-title">Gallery</h2>
      </div>
      <br />
      <div class="islide">
        <div class="islider">
          <? $i = 0 ; foreach($pictures as $img): ?>
          <a href="<? print $pictures[$i]; ?>"><img style="height: 150px" src="<? print $pictures_small1[$i]; ?>" alt="" /></a>
          <? $i++; endforeach; ?>
        </div>
        <span class="islideleft"></span> <span class="islideright"></span> </div>
      <!-- /islide -->
      <? endif; ?>
      
      
      <table border="0" cellspacing="5" cellpadding="5">
  <tr>
    <td>  
          <script>var fbShare = {
url: '<? print $this->content_model->contentGetHrefForPostId($post['id']) ; ?>',
size: 'large',
badge_text: 'fff',
badge_color: '3b5998',
google_analytics: 'true'
}</script>
          <script src="http://widgets.fbshare.me/files/fbshare.js"></script>
         </td>
    <td><script src="http://www.stumbleupon.com/hostedbadge.php?s=5"></script></td>
    <td><script type="text/javascript">
tweetmeme_source = 'waterforlife';
</script>
          <script type="text/javascript" src="http://tweetmeme.com/i/scripts/button.js"></script>
 </td>
    <td> <script type="text/javascript">
(function() {
var s = document.createElement('SCRIPT'), s1 = document.getElementsByTagName('SCRIPT')[0];
s.type = 'text/javascript';
s.async = true;
s.src = 'http://widgets.digg.com/buttons.js';
s1.parentNode.insertBefore(s, s1);
})();
</script>
          <a class="DiggThisButton DiggMedium"></a></td>
  </tr>
</table>

      
      <!--<a class="addthis_button" style="margin-left: 15px;" href="http://www.addthis.com/bookmark.php?v=250&amp;username=xa-4b2a30fa44999ef0"> <img src="http://s7.addthis.com/static/btn/v2/lg-share-en.gif" alt="Bookmark and Share" /> </a>
      <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=xa-4b2a30fa44999ef0"></script>-->
      <br />
      <br />
      <? include(ACTIVE_TEMPLATE_DIR.'bottom_banners.php');  ?>
    </div>
    <!-- /news -->
    <?  include(ACTIVE_TEMPLATE_DIR.'articles_comments.php') ;  ?>
    <div class="c d"></div>
  </div>
  <!-- /#main -->
  <? if($the_section_layout  == 'testimonials'): ?>
  <?  include(ACTIVE_TEMPLATE_DIR.'testimonials_sidebar.php') ;  ?>
  <? else : ?>
  <?  include(ACTIVE_TEMPLATE_DIR.'articles_side_nav.php') ;  ?>
  <? endif; ?>
  <div class="c d"></div>
</div>
