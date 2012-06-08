<div id="sidebar">
  <ul class="side-nav">
    <?	$menu_items = $this->content_model->getMenuItemsByMenuUnuqueId('about_us', false);	?>
    <? foreach($menu_items as $item): ?>
    <?  	$content_id_item = $this->content_model->contentGetById ( $item['content_id'] );		
	 
	  	     ?>
    <li <? if($item['is_active'] == true): ?>  class="active"  <? endif; ?>><a <? if($item['is_active'] == true): ?>  class="active"  <? endif; ?> href="<? print $item['the_url'] ?>"><? print ucwords( $item['item_title'] ) ?></a></li>
    <? endforeach ;  ?>
  </ul>
  <? include "certificates_rotator.php" ?>
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
  <div class="related wrap">
    <h2 class="title" style="padding: 14px 0">Our products</h2>
    <? foreach($related as $item): ?>
    
    <? 
		$more = false;
 $more = $this->core_model->getCustomFields('table_content', $item['id']);
	$item['custom_fields'] = $more;
	
 $lowest_price = false;
 for ($i = 1; $i <= 10; $i++) : ?>
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
      <? endforeach; ?>
    </ul>
  </div>
  <!-- /related -->
  <? endif;  ?>
</div>
