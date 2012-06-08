<script type="text/javascript">

     function testimonialsFade(){
       var length = $("#testimonials-rotator li").length;
       $("#testimonials-rotator li").each(function(){
          if($(this).is(":visible")){
             var index = $("#testimonials-rotator li").index(this)+1;
             if(index==length){
                $(this).fadeOut();
                $("#testimonials-rotator li:first-child").fadeIn('slow');
             }
             else if(index!=length){
                 $(this).fadeOut();
                 $("#testimonials-rotator li").eq(index).fadeIn('slow');
             }
             return false;
          }
       });
     }
     setInterval("testimonialsFade()", 5000);
</script>

<div id="sidebar">
  <?
$link = false;
$link = $this->content_model->getContentURLByIdAndCache($page['id']).'/categories:{id}' ;
$active = '  class="active"   ' ;
$actve_ids = $active_categories;
if( empty($actve_ids ) == true){
$actve_ids = array($page['content_subtype_value']);
}
$this->content_model->content_helpers_getCaregoriesUlTree($page['content_subtype_value'], "<a href='$link'  {active_code}    >{taxonomy_value}</a>" , $actve_ids = $actve_ids, $active_code = $active, $remove_ids = false, $removed_ids_code = false, $ul_class_name = 'side-nav', $include_first = true); ?>
  <h2 class="title" style="padding: 30px 0 12px 0">Testimonials</h2>
  <?
	 //var_dump($active_categories);
      $related = array();
	  $related['selected_categories'] = array(427);
	  $limit[0] = 0;
	  $limit[1] = 30;
	  $related = $this->content_model->getContentAndCache($related, false,$limit );
	  shuffle( $related );
	  $related = array_slice($related,0,4);
	  ?>
  <? if(!empty($related)): ?>
  <!-- related -->
  <div class="related wrap">
    <ul class="feature" id="testimonials-rotator">
      <? $i = 0 ;  foreach($related as $item): ?>
      <li <? if ($i==0) : ?>  style="display:list-item;"   <? endif; ?>    > <a href="<? print $this->content_model->contentGetHrefForPostId($item['id']) ; ?>" class="img" style="background-image: url('<? print   $thumb = $this->content_model->contentGetThumbnailForContentId($item['id'], 90); ?>')"></a><strong><? print character_limiter($item['content_title'], 30, '...'); ?></strong> <br />
        <a href="<? print $this->content_model->contentGetHrefForPostId($item['id']) ; ?>" class="read-more">Read More</a> </li>
      <? $i++; endforeach; ?>
    </ul>
    <div style="clear: both">&nbsp;</div>
    <? endif;  ?>
    <a href="<? print site_url('main/rss') ?>" class="siderss">Subscribe for RSS</a>
    <?
	 //var_dump($active_categories);
      $related = array();
	  $related['selected_categories'] = array(327);
	  $limit[0] = 0;
	  $limit[1] = 30;
	  $related = $this->content_model->getContentAndCache($related, false,$limit ); 
	  shuffle( $related );
	  $related = array_slice($related,0,4);
	  ?>
    <? if(!empty($related)): ?>
    <!-- related -->
    <div class="related wrap" style="padding-bottom: 30px;">
      <h2 class="title" style="padding: 30px 0 12px 0">Our products</h2>
      <? foreach($related as $item): ?>
      <?
	  	$more = false;
 $more = $this->core_model->getCustomFields('table_content', $item['id']);
	$item['custom_fields'] = $more;
 $lowest_price = false;
 for ($i = 1; $i <= 5; $i++) : ?>
      <? if(intval($item['custom_fields']['price'.$i]) > 0): ?>
      <?
		if($lowest_price != false){
					if($the_post['custom_fields']['price'.$i] < $lowest_price){
						$lowest_price = $item['custom_fields']['price'.$i];
					}
				} else {
				$lowest_price = 	intval($item['custom_fields']['price'.$i]);
				}

		?>
      <? endif; ?>
      <? endfor ; ?>
      <ul class="feature">
        <li> <a href="<? print $this->content_model->contentGetHrefForPostId($item['id']) ; ?>" class="img" style="background-image: url('<? print   $thumb = $this->content_model->contentGetThumbnailForContentId($item['id'], 90); ?>')"></a><strong><? print character_limiter($item['content_title'], 30, '...'); ?></strong> <br />
          starting at: $<? print $lowest_price  ?> <a href="<? print $this->content_model->contentGetHrefForPostId($item['id']) ; ?>" class="read-more">Read More</a> </li>
      </ul>
      <? endforeach; ?>
      <? include "certificates_rotator.php" ?>
    </div>
    <!-- /related -->
    <? endif;  ?>
  </div>
  
  <? include "facebook_sidebar.php" ?>
</div>
<!-- /#sidebar -->
<div class="c d"></div>
