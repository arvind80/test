<div id="content">

	<div align="center" style="padding-top: 40px;">
		<h2 class="blue-title">Payment Error</h2>
	    <h2 id="products-baner-sub-title"></h2>
	    <div class="richtext"><? print html_entity_decode($page['content_body']); ?></div>
	</div>
	  
	<div align="center" id="confirm_payment_placeholder" style="padding-top: 25px;">
	    <div style="height: 7px;overflow: hidden">&nbsp;</div>
	    <a class="btn" href="<? print $this->content_model->getContentURLByIdAndCache(48) ; ?>"><span>Back</span></a>
	    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <a class="btn" href="<? print $this->content_model->getContentURLByIdAndCache(2) ; ?>"><span>Explore more products</span></a>
	    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <a class="btn" href="<? print $this->content_model->getContentURLByIdAndCache(1) ; ?>"><span>Back to home</span></a>
	</div>
  
</div>