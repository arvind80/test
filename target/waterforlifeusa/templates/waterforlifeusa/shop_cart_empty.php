<div id="content">
  <div style="width:850px;margin: auto">
<div id="home_head" style="height: auto">
  <div id="in-banner" class="view-cart-baner" style="width: 930px;height: 190px;">
    <script type="text/javascript">
                            $(function(){
                                    //FLIR.replace(document.getElementById('products-baner-title'),  new FLIRStyle({ cFont:'kozukagopro', cColor:'007AC0', cSize:'21' }));
                                    FLIR.replace(document.getElementById('products-baner-sub-title'),  new FLIRStyle({ cFont:'kozukagopro', cColor:'007AC0', cSize:'28' }));


                            $("#checkout_table th").each(function(){
                                 FLIR.replace(this,  new FLIRStyle({ cFont:'kozukagoprobold', cColor:'007AC0', cSize:'14' }));
                            })

                            });
                        </script>
    <div id="products-baner-txt">
      <h2 class="blue-title">
      	<?php 
      		$c = $this->content_model->contentGetById(1498);
      		echo  html_entity_decode($c['content_body']);
      	?>
      </h2>
      <h2 id="products-baner-sub-title"></h2>
      <br />
      <br />
      <a href="<? print $this->content_model->getContentURLByIdAndCache(2) ; ?>"  class="btn center">Products</a> </div>
  </div>
  <!-- /in-banner -->
</div>
<div id="main" style="height: 465px;">&nbsp;</div>
</div></div>