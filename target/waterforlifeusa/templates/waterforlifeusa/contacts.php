<? if(!empty($subdomain_user)): ?>
<?  include(ACTIVE_TEMPLATE_DIR.'contacts-logged.php') ;  ?>
<? else: ?>

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
   <!-- <h2 id="contact-slogan">Contact us for now</h2>-->
    <a id="contact-mail" href="mailto:info@waterforlifeusa.com" title="info@waterforlifeusa.com">Info@waterforlifeusa.com</a> </div>
  <!-- /in-banner -->
</div>
<div id="content" class="gradient_top content-inner"> <? print $this->content_model->getBreadcrumbsByURLAndPrintThem(); ?>
  <div style="height: 40px;">
    <!--  -->
  </div>
  <h2 class="blue-title left">Contact Us</h2>
  <div class="clear" style="height: 1px;overflow: hidden"></div>
  <div class="half-width">
    <!--<iframe width="420" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=usa+new+york&amp;sll=36.5626,-119.421387&amp;sspn=10.018618,23.269043&amp;g=usa+california&amp;ie=UTF8&amp;ll=40.741274,-73.905888&amp;spn=0.024061,0.076389&amp;z=14&amp;output=embed"></iframe>-->
    <h2 class="blue-title" style="padding: 15px 0">Send us an E-mail</h2>
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
  <!-- /half-width -->
  <div class="half-width">
    <? print html_entity_decode($page['content_body']); ?>
    <br />
    <br />
    <!--<a href="<? print $this->content_model->contentGetHrefForPostId(97) ; ?>" class="dmaplink">USA Dealers map</a>--> <br />
    <br />
    <table width="90%" cellspacing="1" cellpadding="1">
      <tr>
        <td><h2 class="title" style="padding: 15px 0">Follow us on</h2>
          <div class="share"> <a href="#"></a> <a href="#"></a> <a href="#"></a> </div></td>
        <td><h2 class="title" style="padding: 15px 0">More contacts</h2>
          <div class="more-contacts"> <a href="#"></a> <a href="#"></a> <a href="#"></a> </div></td>
      </tr>
    </table>
    <br />
    <br />
  </div>
  <div class="clear"></div>
  <br />
</div>
<? endif; ?>
