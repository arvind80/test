
<div id="sidebar">
  <!-- <ul class="side-nav">
      <li class="big"><a href="#">KYK Genesis Water Ionizer</a></li>
      <li class="big"><a href="#">KYK Prefilters</a></li>
      <li class="big"><a href="#">KYK Replacement Filters</a></li>
      <li><a href="#">Shower Filter</a></li>
      <li><a href="#">Books</a></li>
    </ul>-->
  <div class="side-nav">
    <? 
$link = false;
$link = $this->content_model->getContentURLByIdAndCache($page['id']).'/categories:{id}' ;
$active = '  class="active"   ' ;
$actve_ids = $active_categories;
if( empty($actve_ids ) == true){
$actve_ids = array($page['content_subtype_value']);
}
$this->content_model->content_helpers_getCaregoriesUlTree($page['content_subtype_value'], "<a href='$link'  {active_code}    >{taxonomy_value}</a>" , $actve_ids = $actve_ids, $active_code = $active, $remove_ids = false, $removed_ids_code = false, $ul_class_name = 'big', $include_first = true); ?>
    
  </div>
  <? 

      $related = array();
	 // $related['selected_categories'] = array(427);
	//  $limit[0] = 0;
	//  $limit[1] = 1;
	//  $related = $this->content_model->getContentAndCache($related, false,$limit,  $count_only = false, $short = true, $only_fields = array ('id', 'content_type', 'content_url', 'content_title' ) ); 
	 
	  ?>
  <? include "certificates_rotator.php" ?>
  <? include "facebook_sidebar.php" ?>
  <br />
  <br />
  <br />
</div>
