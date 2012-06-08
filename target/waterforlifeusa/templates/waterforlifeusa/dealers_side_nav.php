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
 
  <div style="height: 7px;overflow: hidden">&nbsp;</div>
  <ul class="side-nav">
    <li><a <? if($item['is_act11111ive'] == true): ?>  class="active"  <? endif; ?> href="<? print site_url('affiliates'); ?>">Become a dealer</a></li> 
  </ul>
</div>
<!-- /#sidebar -->
<div class="c d"></div>
