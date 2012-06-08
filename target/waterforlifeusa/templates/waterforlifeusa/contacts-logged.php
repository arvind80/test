<div id="home_head" style="height: auto">
  <div id="in-banner" class="contact-baner">
    <script type="text/javascript">
                            $(function(){
                                    FLIR.replace(document.getElementById('contact-phone'),  new FLIRStyle({ cFont:'kozukagoprobold', cColor:'ffffff', cSize:'24' }));
                                    FLIR.replace(document.getElementById('contact-slogan'),  new FLIRStyle({ cFont:'kozukagopro', cColor:'ffffff', cSize:'24' }));
                                    FLIR.replace(document.getElementById('contact-mail'),  new FLIRStyle({ cFont:'kozukagoprobold', cColor:'ffffff', cSize:'12' }));
                            })
                        </script>
    <address id="contact-phone">
    1.877.255.3713
    </address>
    <h2 id="contact-slogan">Contact us for now</h2>
    <a id="contact-mail" href="mailto:info@waterforlifeusa.com" title="info@waterforlifeusa.com">Info@waterforlifeusa.com</a> </div>
  <!-- /in-banner -->
</div>
<div id="content" class="gradient_top content-inner"> <? print $this->content_model->getBreadcrumbsByURLAndPrintThem(); ?>
  <div style="height: 40px;">
    <!--  -->
  </div>
  <div class="half-width">
	  <h2 class="blue-title left">Contact Us</h2>
	  <div class="clear" style="height: 15px;overflow: hidden"></div>
	  
	    <form method="post" action="#" id="contact-form" class="validate">
	      <div class="cinput">
	        <input type="text" name="name" value="Name" title="Name" class="required" onfocus="this.value=='Name'?this.value='':''" onblur="this.value==''?this.value='Name':''" />
	      </div>
	      <div class="cinput">
	        <input type="text" name="email" value="Email" title="Email" class="required" onfocus="this.value=='Email'?this.value='':''" onblur="this.value==''?this.value='Email':''" />
	      </div>
	      <div class="cinput">
	        <input type="text" name="phone_number" value="Phone Number" title="Phone Number" class="" onfocus="this.value=='Phone Number'?this.value='':''" onblur="this.value==''?this.value='Phone Number':''" />
	      </div>
	      <div class="carea">
	        <textarea title="Message" name="message" rows="" cols="" onfocus="this.value=='Message'?this.value='':''" onblur="this.value==''?this.value='Message':''">Message</textarea>
	      </div>
	      <span id="cloading"></span>
	      <input type="submit" class="csubmit" value="" />
	    </form>
	  
	  
	</div>
 
	<div class="half-width">
		<? print $subdomain_user['user_contacts']; ?>
	</div>

</div>

 <div class="clear"></div>
  <br />