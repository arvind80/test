<div id="home_head" style="height: auto">
  <div id="in-banner" class="product-baner">
    <script type="text/javascript">
                            $(function(){
                                    //FLIR.replace(document.getElementById('products-baner-title'),  new FLIRStyle({ cFont:'kozukagopro', cColor:'007AC0', cSize:'21' }));
                                  //  FLIR.replace(document.getElementById('products-baner-sub-title'),  new FLIRStyle({ cFont:'kozukagopro', cColor:'007AC0', cSize:'28' }));
                            })
                        </script>
    <div id="products-baner-txt">
    
    
    
    <? 
	//
	$myLastElement = end($active_categories);
	
	$t = $this->taxonomy_model->getSingleItem($myLastElement);//  getSingleItem;
	
	// var_dump($t); ?>
    <? if(trim($t['content_body']) != ''): ?>
    <? print html_entity_decode($t['content_body']); ?>
    
    <? else: ?>
    <? print html_entity_decode($page['content_body']); ?>
    <? endif; ?>
    
    <!--  <h2 class="blue-title">Water for life</h2>
      <h2 id="products-baner-sub-title"></h2>
      <br />
      <br />
      <p>Water is not just some colorless and tasteless one dimensional liquid; on the contrary, life on earth originated from water, and all life forms depend on water to sustain them, therefore water is the fundamental foundation and source of eternal life on earth. <strong>Dr. Kim Young Kwi</strong>.</p>-->
    </div>
  </div>
  <!-- /in-banner -->
</div>
<div id="content" class="gradient_top content-inner"> <? print $this->content_model->getBreadcrumbsByURLAndPrintThem(); ?>
  <!-- <ul class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li><a href="#">Current Page</a></li>
  </ul>-->
  <div style="height: 40px;">
    <!--  -->
  </div>
  <div id="main">
    <h2 class="blue-title-normal">OUR PRODUCTS</h2> 
    <!-- <p style="padding-bottom: 15px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>-->
    <!--    <div class="gradient_top cblock product"> <a href="#" class="product-image"> <span style="background-image: url(img/demo/product_1.jpg)"></span> </a>
      <h2 class="blue-title">Jupiter Venus</h2>
      <p>The Venus is being billed as being potent as the Melody. It has replaced the popular  Jupiter Microlite and has all the features that anyone would ever need in an above counter water ionizer. Ease of use and exceptional performance come with the latest touch screen technology at an amazing price.</p>
      <span class="price">Price $1200</span> <a href="#" class="btn cart-btn">Add to Cart</a> <a href="#" class="btn info-btn">More Info</a> </div>
    <div class="gradient_top cblock product"> <a href="#" class="product-image"> <span style="background-image: url(img/demo/product_2.jpg)"></span> </a>
      <h2 class="blue-title">Jupiter Venus</h2>
      <p>The Venus is being billed as being potent as the Melody. It has replaced the popular  Jupiter Microlite and has all the features that anyone would ever need in an above counter water ionizer. Ease of use and exceptional performance come with the latest touch screen technology at an amazing price.</p>
      <span class="price">Price $1200</span> <a href="#" class="btn cart-btn">Add to Cart</a> <a href="#" class="btn info-btn">More Info</a> </div>-->
    <? if(!empty($posts)): ?>
    <? foreach ($posts as $the_post): ?>
    
    <?    
	$more = false;
 $more = $this->core_model->getCustomFields('table_content', $the_post['id']);
	$the_post['custom_fields'] = $more;
	?>
    
    
      <? // p($the_post);  ?>
    <?   
 $lowest_price = false;
 for ($i = 1; $i <= 5; $i++) : ?>
    <? if(intval($the_post['custom_fields']['price'.$i]) > 0): ?>
    <?
		if($lowest_price != false){
					if($the_post['custom_fields']['price'.$i] < $lowest_price){
						$lowest_price = $the_post['custom_fields']['price'.$i];
					}
				} else {
				$lowest_price = 	intval($the_post['custom_fields']['price'.$i]);
				}

		?>
    <? endif; ?>
    <? endfor ; ?>
    <? //p($the_post, 1) ?>
    <div class="xst_product cblock">
      <div class="xst_content"> <a class="TheProductimg" href="<? print $this->content_model->contentGetHrefForPostId($the_post['id']) ; ?>"> <img class="reflex" src="<? print $thumb = $this->content_model->contentGetThumbnailForContentId($the_post['id'], 240); ?>" alt=""  /> </a>
        <div class="product_list_right">
          <h2 class="blue-title"><a href="<? print $this->content_model->contentGetHrefForPostId($the_post['id']) ; ?>"><? print character_limiter($the_post['content_title'], 50, '...'); ?></a></h2>
          <p><? print character_limiter($the_post['content_description'], 350, '...'); ?></p>
          <span class="price">From $<? print $lowest_price ?></span><a href="<? print $this->content_model->contentGetHrefForPostId($the_post['id']) ; ?>" class="infobtn-style info-btn">More Info</a><a href="#" class="byunow-style buynowbtn" style="float: right;margin-right: 8px;">Buy Now</a> </div>
        <div class="byunow-box">
          <table cellpadding="0" cellspacing="0">
        
            <? for ($i = 1; $i <= 5; $i++) : ?>
            <? $sku = '' ?>
            <? if(intval($the_post['custom_fields']['price'.$i]) > 0) : ?>
            <? for($j=0; $j < count($posts); $j++) : ?>
            <? if($posts[$j]['id'] == $the_post['id']) :?>
            <? $sku = 'ID'.($the_post['id']).'-'.($the_post['custom_fields']['price_desc'.$i]); ?>
            <form  id="add_to_cart_form_<? print md5($sku); ?>"  enctype="multipart/form-data" method="post" action="<? print site_url('ajax_helpers/cart_itemAdd'); ?>" >
              <input name="sku" type="hidden" value="<? print $sku; ?>" />
              <input name="qty" type="hidden" value="1" />
              <input name="to_table_id" type="hidden" value="<? print ($the_post['id']) ?>" />
              <input name="price" value="<? print addslashes(intval($the_post['custom_fields']['price'.$i]) ) ; ?>" type="hidden" />
              <input name="item_name" value="<? print addslashes(strval($the_post['custom_fields']['price_desc'.$i])) ; ?>" type="hidden" />
              <input name="weight" value="<? print addslashes($the_post['custom_fields']['package_weight']) ?>" type="hidden" />
              <input name="height" value="<? print addslashes($the_post['custom_fields']['package_height']) ?>" type="hidden" />
              <input name="item_length" value="<? print addslashes(floatval($the_post['custom_fields']['package_length'])) ?>" type="hidden" />
              <input name="width" value="<? print addslashes($the_post['custom_fields']['package_width']) ?>" type="hidden" />
              <tr>
                <td><p class="pricetxt"><b>
                    $ <?=$the_post['custom_fields']['price'.$i] ?>
                    </b> <span>
                    <?=$the_post['custom_fields']['price_desc'.$i] ?>
                    </span></p></td>
                <td align="right" ><a onclick='add_to_cart("add_to_cart_form_<? print md5($sku); ?>")' class="btn cart-btn">Add to Cart</a></td>
              </tr>
            </form>
            <? endif; ?>
            <? endfor; ?>
            <? endif; ?>
            <? endfor ; ?>
          </table>
        </div>
      </div>
      <span class="xst_tl">&nbsp;</span> <span class="xst_tr">&nbsp;</span> <span class="xst_bl">&nbsp;</span> <span class="xst_br">&nbsp;</span>
      <div class="lista">&nbsp;</div>
      <div class="kapki">&nbsp;</div>
      <a href="<? print $this->content_model->contentGetHrefForPostId($the_post['id']) ; ?>" class="abslink">&nbsp;</a> </div>
    <? endforeach; ?>
    <? else : ?>
    No products in this category! Please come back later.
    <? endif; ?>
  </div>
  <!-- /main -->
  <?  include(ACTIVE_TEMPLATE_DIR.'shop_side_nav.php') ;  ?>
  <!-- /sidebar -->
  <div class="clear"></div>
</div>
