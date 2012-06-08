<div id="content" class="gradient_top content-inner"> <? print $this->content_model->getBreadcrumbsByURLAndPrintThem(); ?>
  <div style="height: 40px;">
    <!--  -->
  </div>
  <div id="main">
    <!-- main -->
    <? if(!empty($posts)): ?>
    <?  //include(ACTIVE_TEMPLATE_DIR.'articles_img_slider_top.php') ;  ?>
    <?  include(ACTIVE_TEMPLATE_DIR.'articles_search_bar.php') ;  ?>
    <? foreach ($posts as $the_post): ?>
    <div class="news"> <a class="comments-number" href="<? print $this->content_model->contentGetHrefForPostId($the_post['id']) ; ?>#the_comments_anchor"><? print $this->comments_model->commentsGetCountForContentId($the_post['id']); ?> comments</a>
      <h2 class="blue-title-normal"><a title="<? print $the_post['content_title']; ?>" href="<? print $this->content_model->contentGetHrefForPostId($the_post['id']) ; ?>"><? print $the_post['content_title']; ?></a></h2>
      <div class="c"></div>
      <span class="date"><? print $the_post['created_on']; ?></span>
      <div class="gradient_top cblock"> 
      
      <? if($the_section_layout  == 'testimonials'): ?>
  
      <div class="richtext">
      
      <?  $media = $this->content_model->mediaGetForContentId($the_post['id'], 'video');    
	if( $media ['videos'][0]['filename'] != '') : ?>
    <object id="player-<? print  $media ['videos'][0]['id'] ?>" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" name="player" width="640" height="480"> 
      <param name="movie" value="player-viral.swf" />
      <param name="allowfullscreen" value="true" />
      <param name="allowscriptaccess" value="always" />
      <param name="flashvars" value="file=<? print $media ['videos'][0]['url']; ?>&image=<? print $this->core_model->mediaGetThumbnailForMediaId($media ['videos'][0]['id'], '640');	?>" />
      <embed
			type="application/x-shockwave-flash"
			id="player2-<? print $media ['videos'][0]['id'] ?>"
			name="player2-<? print $media ['videos'][0]['id'] ?>"
			src="<?php print_the_static_files_url() ; ?>js/media_player/player-viral.swf"
			width="640"
			height="480"
			allowscriptaccess="always"
			allowfullscreen="true"
			flashvars="file=<? print $media ['videos'][0]['url']; ?>&image=<? print $this->core_model->mediaGetThumbnailForMediaId($media ['videos'][0]['id'], '640');	?>"	/>
    </object>
    <? endif; ?>
      
        <? print  ($the_post['the_content_body']); ?>
   
        </div>
         <a href="<? print $this->content_model->contentGetHrefForPostId($the_post['id']) ; ?>" class="read-more">Read More</a> 
  <? else : ?>
  <a href="<? print $this->content_model->contentGetHrefForPostId($the_post['id']) ; ?>" class="articleimg" style="background-image: url(<? print  $thumb = $this->content_model->contentGetThumbnailForContentId($the_post['id'], 150); ?>)"> </a>
	 <? if($the_post['content_description'] != ''): ?>
            <? print (character_limiter($the_post['content_description'], 400, '...')); ?>
            <? else: ?>
            <? print character_limiter($the_post['content_body_nohtml'], 400, '...'); ?>
            <? endif; ?>
             <a href="<? print $this->content_model->contentGetHrefForPostId($the_post['id']) ; ?>" class="read-more">Read More</a> 
  <? endif; ?>
      
      
       
       </div>
    </div>
    <? endforeach; ?>
    <? else : ?>
    No posts here!
    <? endif; ?>
    <? if(!empty($posts_pages_links)): ?>
    <? print $page_link ;  ?>
    <ul class="paging">
      <? $i = 1; foreach($posts_pages_links as $page_link) : ?>
      <li><a <? if($posts_pages_curent_page == $i) : ?>  class="active"  <?  endif; ?> href="<? print $page_link ;  ?>"><? print $i ;  ?></a></li>
      <? $i++; endforeach;  ?>
    </ul>
    <span class="paging-label">Browse pages</span>
    <? endif ; ?>
    <div class="c d"></div>
    <br />
    <br />
    <? include(ACTIVE_TEMPLATE_DIR.'bottom_banners.php');  ?>
  </div>
  <!-- /#main -->
  <? if($the_section_layout  == 'testimonials'): ?>
  <?  include(ACTIVE_TEMPLATE_DIR.'testimonials_sidebar.php') ;  ?>
  <? else : ?>
  <?  include(ACTIVE_TEMPLATE_DIR.'articles_side_nav.php') ;  ?>
  <? endif; ?>
</div>
<!-- /#content -->
