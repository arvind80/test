<div id="sidebar">
  <div class="side-nav">
    <? 
$link = false;
$link = $this->content_model->getContentURLByIdAndCache($page['id']).'/category:{taxonomy_value}' ;
$active = '  class="active"   ' ;
$actve_ids = $active_categories;
if( empty($actve_ids ) == true){
$actve_ids = array($page['content_subtype_value']);
}
$this->content_model->content_helpers_getCaregoriesUlTree($page['content_subtype_value'], "<a href='$link'  {active_code}    >{taxonomy_value}</a>" , $actve_ids = $actve_ids, $active_code = $active, $remove_ids = false, $removed_ids_code = false, $ul_class_name = 'big', $include_first = true); ?>
 
  </div>
  
  
  
  
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
  
  
<?  include(ACTIVE_TEMPLATE_DIR.'facebook_sidebar.php') ;  ?>
</div>
