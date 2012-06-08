<?
	$more = false;
 $more = $this->core_model->getCustomFields('table_content', $post['id']);
	$post['custom_fields'] = $more;

?>

 <script type="text/javascript">
                            function add_c_popup(){
								
							
							$("#gbox-price").html().popup()
								
							
							
							}
                        </script>


<div id="home_head" style="height: auto">
  <div id="in-banner" class="product-inner-baner">
    <script type="text/javascript">
                            $(function(){
                                    FLIR.replace(document.getElementById('products-baner-title'),  new FLIRStyle({ cFont:'kozukagopro', cColor:'007AC0', cSize:'21' }));
                                    FLIR.replace(document.getElementById('products-baner-sub-title'),  new FLIRStyle({ cFont:'kozukagopro', cColor:'007AC0', cSize:'28' }));
                            })
                        </script>
    <div id="product-inner-baner-content">
      <h2 class="blue-title"><? print $post['content_title'] ?></h2>
      <p><? print (nl2br(character_limiter($post['content_description'], 300, '...')) ); ?></p>
    </div>
  </div>
  <!-- /in-banner -->
</div>
<!-- /home_head -->
<div id="content" class="gradient_top content-inner"> <? print $this->content_model->getBreadcrumbsByURLAndPrintThem(); ?>
  <div style="height: 40px;">
    <!--  -->
  </div>
  <div id="main" class="product-inner">
    <? $pictures = $this->content_model->contentGetPicturesFromGalleryForContentId($post['id'], '900');
							$pictures_small1 = $this->content_model->contentGetPicturesFromGalleryForContentId($post['id'], '300');
							//$pictures_small2 = $this->content_model->contentGetPicturesFromGalleryForContentId($post['id'], '75'); 
							
							  ?>
    <? if(!empty($pictures)): ?>
    <div class="product-title">
      <h2 class="blue-title">Pictures</h2>
      <a href="javascript::" class="btn cart-btn right" onclick="scrollto('#gbox-price')">Buy now</a> </div>
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
     <table width="100%" border="0" cellspacing="5" cellpadding="5">
  <tr>
    <td align="left">      <h2 class="blue-title" style="margin: 0">Product description</h2></td>
    <td align="right"><a href="javascript:add_c_popup();"><img src="<? print TEMPLATE_URL; ?>img/carty.jpg" border="0" /></a></td>
  </tr>
</table>
    <div class="cblock gradient_top richtext">
    
   


      
      
      
      <? print ((html_entity_decode($post['content_body'])) ); ?>
      
    </div>
    <a name="add_to_cart" id="add_to_cart"></a> <br />
    <!--<div class="cblock gradient_top">
      <h2 class="blue-title">Video of the product</h2>
      <div class="videos">
        <div class="the-video">
          <object width="320" height="265">
            <param name="movie" value="http://www.youtube.com/v/WudNXt8dAts&hl=en&fs=1&">
            </param>
            <param name="allowFullScreen" value="true">
            </param>
            <param name="allowscriptaccess" value="always">
            </param>
            <embed src="http://www.youtube.com/v/WudNXt8dAts&hl=en&fs=1&" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="320" height="265"></embed>
          </object>
        </div>
        <div class="video-info">
          <h2 class="blue-title">Video title</h2>
          <br />
          Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. <br />
          <h2 class="blue-title" style="padding: 10px 0">More videos</h2>
          <br />
          <img src="img/demo/video_thumb.jpg" alt=""  /> <img src="img/demo/video_thumb.jpg" alt=""  /> <img src="img/demo/video_thumb.jpg" alt=""  /> </div>
      </div>
    </div>-->
    <!--    <div class="cblock gradient_top">
      
      
      
    </div>
    <br />
    <br />-->
    <div class="gbox" id="gbox-price">
      <h2 class="atitle">Buy now</h2>
      <br />
      <div class="sidegbox right">
        <div class="ban dollar-ban right"  onclick="window.location='<? print $this->content_model->getContentURLByIdAndCache(49) ; ?>'" style="cursor:pointer"></div>
        <br class="c" />
        <br />
        
        <? if(strval($post['custom_fields']['waranty_label']) != 'n'): ?>
        <div class="ban star-ban right" onclick="window.location='<? print $this->content_model->getContentURLByIdAndCache(111) ; ?>'" style="cursor:pointer"></div>
        <? endif; ?>
        
      </div>
      <div class="sidegbox left">
        <? for ($i = 1; $i <= 10; $i++) : ?>
        <? if(intval($post['custom_fields']['price'.$i]) > 0): ?>
        <? $sku = 'ID'.($post['id']).'-'.($post['custom_fields']['price_desc'.$i]); ?>
        <form    id="add_to_cart_form_<? print md5($sku); ?>"  enctype="multipart/form-data" method="post" action="<? print site_url('ajax_helpers/cart_itemAdd'); ?>" >
          <p class="pricetxt"><b>$<? print intval($post['custom_fields']['price'.$i] ) ; ?></b> <span><? print ($post['custom_fields']['price_desc'.$i]); ?></span></p>
         <!-- <a href="javascript:;" onclick='$(this).parents("form").submit();' class="btn cart-btn">Add to Cart</a> <br />-->
         
         <a onclick='add_to_cart("add_to_cart_form_<? print md5($sku); ?>")' class="btn cart-btn">Add to Cart</a> <br />
         
         
          <br />
          <input name="sku" type="hidden" value="<? print $sku; ?>" /> 
        <input name="qty" type="hidden" value="1" />
        <input name="to_table_id" type="hidden" value="<? print ($post['id']) ?>" />
          <input name="price" value="<? print addslashes(intval($post['custom_fields']['price'.$i]) ) ; ?>" type="hidden" />
          <input name="item_name" value="<? print addslashes(strval($post['custom_fields']['price_desc'.$i])) ; ?>" type="hidden" />
          <input name="weight" value="<? print addslashes($post['custom_fields']['package_weight']) ?>" type="hidden" />
          <input name="height" value="<? print addslashes($post['custom_fields']['package_height']) ?>" type="hidden" />
          <input name="item_length" value="<? print addslashes(floatval($post['custom_fields']['package_length'])) ?>" type="hidden" />
          <input name="width" value="<? print addslashes($post['custom_fields']['package_width']) ?>" type="hidden" />
    <!--     <input name="s" type="submit" value="s" />-->
        </form>
        <? endif; ?>
        <? endfor ; ?>
        <!--  <a href="#" class="spec" style="clear: both;float: left;margin-top:15px; ">Click here to read full specification of this product</a> -->
      </div>
    </div>
    <!-- /gbox-price -->
    
    
    
    
    
    
    
    <?  $media = $this->content_model->mediaGetForContentId($post['id'], 'video');    
	if( $media ['videos'][0]['filename'] != '') :	?>
      <div class="c"></div>
      <br />
      <br />
      <br />
      <h2 class="blue-title-normal">Videos</h2><br />

      <? foreach( $media['videos'] as $vid): ?>
      <? if(strval(trim($vid['media_name'])) != '')  : ?>
       <br />
      <h3 class="blue-title-normal"> <? print($vid['media_name']); ?></h3>
      <br />
      <? endif; ?>
      <object id="player-<? print $vid['id'] ?>" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" name="player" width="640" height="480">
        <param name="movie" value="<?php print_the_static_files_url() ; ?>js/media_player/player-viral.swf" />
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
    
    
    
    
    
    
    
    <br />
    <br />
    
    <? if(strval(html_entity_decode($post['custom_fields']['features'])) != ''): ?>
    <div class="cblock gradient_top">
      <h2 class="blue-title">Features</h2>
      <? print html_entity_decode($post['custom_fields']['features']); ?> </div>
    <br />
    <br />
    <? endif; ?>
    <? if(strval($post['custom_fields']['Xmore_details']) != ''): ?>
    <div class="cblock gradient_top">
      <h2 class="blue-title">Details</h2>
      <div class="detail"> <? print html_entity_decode($post['custom_fields']['more_details']); ?> </div>
    </div>
    <br />
    <br />
    <? endif; ?>
    <div class="clear"></div>
    <? if(strval(html_entity_decode($post['custom_fields']['specs'])) != ''): ?>
    <div class="gradient_top active" id="specification-table"> <b class="xpand xpand-table right" style="padding-right: 15px;"><span></span><b>Collapse</b></b>
      <h2 class="blue-title" style="padding-left: 15px"><? print $post['content_title'] ?> specifications</h2>
      <? print html_entity_decode($post['custom_fields']['specs']); ?> </div>
    <br />
    <br />
    <a href="<? print $this->taxonomy_model->getUrlForIdAndCache(850); ?>" title="Instructions" class="tbtn">Instructions</a>
    <a href="<? print site_url('testimonials'); ?>" title="Testimonials" class="tbtn">Testimonials</a>

    
    
    
    <? endif; ?>


    <br />
    <!--<div class="cblock gradient_top"> <a href="#" class="btn right" style="margin-right: 25px">More Info</a>
      <h2 class="title">KYK Genesis Product Specifications</h2>
      <a href="#" class="link">Click here to read full specification of this product</a> <br />
      <br />
      <h2 class="title">FAQ</h2>
      <a href="#" class="link">Click here to read full specification of this product</a> </div>-->
  </div>
  <!-- /main -->
  <?  include(ACTIVE_TEMPLATE_DIR.'shop_side_nav.php') ;  ?>
  <!-- /sidebar -->
  <div class="clear"></div>
</div>
