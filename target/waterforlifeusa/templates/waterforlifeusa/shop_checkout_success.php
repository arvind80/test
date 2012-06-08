<script type="text/javascript">var journeycode='7480a130-d7ba-40ce-93bc-dc3ef1cbdb70';var captureConfigUrl='cdsusa.veinteractive.com/CaptureConfigService.asmx/CaptureConfig';</script> <script type="text/javascript">try { var vconfigHost = (("https:" == document.location.protocol) ? "https://" : "http://"); document.write(unescape("%3Cscript src='" + vconfigHost + "configusa.veinteractive.com/vecapture.js' type='text/javascript'%3E%3C/script%3E")); } catch(err) {} </script>

<div id="content">

	<div align="center" style="padding-top: 40px;">
		<h2 class="blue-title">Payment Successful</h2>
	    <h2 id="products-baner-sub-title"></h2>
	    <div class="richtext"><? print html_entity_decode($page['content_body']); ?></div>
	</div>
	  
	<div align="center" id="confirm_payment_placeholder" style="padding-top: 25px;">
	    <div style="height: 7px;overflow: hidden">&nbsp;</div>
	    <a class="btn" href="<? print $this->content_model->getContentURLById(2) ; ?>"><span>Explore more products</span></a>
	    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <a class="btn" href="<? print site_url() ; ?>"><span>Back to home</span></a>
	</div>
  
</div>