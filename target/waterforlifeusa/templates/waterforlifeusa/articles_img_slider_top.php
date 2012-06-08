
<? if($the_section_layout  == 'testimonials'): ?>
<? 
	 //var_dump($active_categories); 
      $related = array();
	  $related['selected_categories'] = $active_categories;
	  $limit[0] = 0;
	  $limit[1] = 1000;
	  $related = $this->content_model->getContentAndCache($related, false,$limit,  $count_only = false, $short = true, $only_fields = array ('id', 'content_type', 'content_url' ) ); 
	 
	  ?>
<? if(!empty($related)): ?>
<div id="testimonial-slide">
  <? foreach($related as $item): ?>
  <a href="<? print $this->content_model->contentGetHrefForPostId($item['id']) ; ?>" <? if($item['id'] == $post['id']) : ?>  class="active" <? endif; ?> style="background-image: url('<? print   $thumb = $this->content_model->contentGetThumbnailForContentId($item['id'], 90); ?>')"></a>
  <? endforeach; ?>
</div>
<? endif;  ?>
<? endif;  ?>   
   

