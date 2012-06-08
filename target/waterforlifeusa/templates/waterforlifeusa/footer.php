
<div id="footer">
  <div id="subfooter">
    <div id="from_the_blog">
      <h2 class="white-title">From our blog</h2>
      <ul style="height: 97px">
        <? 

      $related = array();
	  $related['selected_categories'] = array(305);
	  $limit[0] = 0;
	  $limit[1] = 3;
	  $related = $this->content_model->getContentAndCache($related, false,$limit,  $count_only = false, $short = true, $only_fields = array ('id', 'content_type', 'content_url', 'content_title' ) ); 
	 
	  ?>
        <? if(!empty($related)): ?>
        <? foreach($related as $item): ?>
        <li><a href="<? print $this->content_model->contentGetHrefForPostId($item['id']) ; ?>"><? print $item['content_title'] ?></a></li>
        <? endforeach; ?>
        <? endif;  ?> 
      </ul>
      
    </div>
    <div id="footer_serach_bar">
      <h2 class="white-title">Keep in touch</h2>
      <p>Sign up for the WFL weekly newsletter </p>
<!--      <form id="footer-search" action="<? print $this->content_model->getContentURLByIdAndCache(97) ?>" method="post">
        <input type="text" value="Enter your ZIP code" name="zip" id="zip"
                                onfocus="if(this.value=='Enter your ZIP code'){this.value=''}"
                                onblur="if(this.value==''){this.value='Enter your ZIP code'}"  />
        <a href="#" id="search_submit" onclick="$('#footer-search').submit()">Search</a>
      </form>
      -->
      
      
      <form  id="footer-search" target="_blank" name="ccoptin" action="http://visitor.constantcontact.com/d.jsp" method="post">
  
 
         
          <input type="ea" id="zip" value="Type your e-mail here"
          onfocus="if(this.value=='Type your e-mail here'){this.value=''};this.className='focus'"
          onblur="if(this.value==''){this.value='Type your e-mail here'};this.className=''"
         />
    <input type="hidden" name="m" value="1102776244579">
    <input type="hidden" name="p" value="oi">
 
     <a href="#" id="search_submit" onclick="$('#footer-search').submit()">Subscribe
      
     </a>
</form>
      
      
      <small>Subscribe to the WFL Newsletter</small> </div>
      <div style="height: 1px; overflow: hidden;clear: both">&nbsp;</div>
      <address id="created-by"><a href="http://ooyes.net" title="Web Design Company">Website design</a> by <a href="http://ooyes.net" title="Web Design Company">OOYES.NET</a> </address>
      <br />

  </div>
  <?	$menu_items = $this->content_model->getMenuItemsByMenuUnuqueId('footer_menu');	?>
  <? if(!empty($subdomain_user)): ?>
  <a href="<? print site_url(); ?>" id="logo">Water For Life</a>
  <? endif ?>
  <ul id="footer-nav">
    <? foreach($menu_items as $item): ?>
    <? if(empty($subdomain_user) || ($item['content_id'] != 3 && $item['content_id'] != 7)): ?>
	    <?  	$content_id_item = $this->content_model->contentGetByIdAndCache ( $item['content_id'] );
	
		  	     ?>
	    <? if($the_section_layout == false): ?>
	    <li <? if($item['is_active'] == true): ?>  class="active"  <? endif; ?>><a <? if($item['is_active'] == true): ?>  class="active"  <? endif; ?> href="<? print $item['the_url'] ?>"><? print ucwords( $item['item_title'] ) ?></a></li>
	    <? else : ?>
	    <li <? if($content_id_item['content_section_name'] == $the_section_layout): ?>  class="active"  <? endif; ?>><a <? if($content_id_item['content_section_name'] == $the_section_layout): ?>  class="active"  <? endif; ?> href="<? print $item['the_url'] ?>"><? print ucwords( $item['item_title'] ) ?></a></li>
    	<?  endif; ?>
    <?  endif; ?>
    <? endforeach ;  ?>
 
    
  
  </ul>
  <div id="footer_share">
    <h2 class="white-title">Follow us on</h2>
    
    <a href="http://www.facebook.com/pages/Water-Ionizers/139659392735750"><img src="<? print TEMPLATE_URL; ?>img/facebook.jpg" alt=""  /></a> <a href="#"><img src="<? print TEMPLATE_URL; ?>img/im.jpg" alt=""  /></a> <a href="#"><img src="<? print TEMPLATE_URL; ?>img/twitter.jpg" alt=""  /></a> </div>
</div>
<!-- /#footer -->
</div>
<!-- /#wrapper -->
</div><!-- /#fcontainer -->
</div><!-- /#maincontainer -->
</div>


<!-- /#container -->
<div id="overlay"></div>
<div id="obox"><a href="javascript:;" class="close"><span></span></a></div>

<div id="toolTip"></div>
<img id="shareasale_trackimg" src="" width="1" height="1">
<? include (ACTIVE_TEMPLATE_DIR.'footer_stats_scripts.php') ?>

<? if(is_file(ACTIVE_TEMPLATE_DIR.'users/users_login_register_form.php') == true){ include (ACTIVE_TEMPLATE_DIR.'users/users_login_register_form.php'); } ?>  









<div style="display: none;width:400px;height: 180px;text-align: center" id="cart-add-success">
<br />
<br />

 <span style="font-size:x-large">Your items are added to the cart</span><br />
  <br />
  <table width="400" border="0" cellspacing="5" cellpadding="5" align="center">
    <tr valign="middle">
      <td align="center"><a href="javascript:Modal.close()" class="btn">Continue shopping</a></td>
       <td align="center">
      <a href="<? print $this->content_model->getContentURLByIdAndCache(39) ; ?>"><img src="<? print TEMPLATE_URL ?>img/btn/checkout.png" border="0" alt="Buy" /></a>
      <!--<a href="<? print $this->content_model->getContentURLByIdAndCache(39) ; ?>" class="btn info-btn">Go to checkout</a>--></td>
    </tr>
    
  </table>
</div>






</body>
</html>