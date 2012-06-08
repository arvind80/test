<div id="sidebar"> <br />
  <? ($the_session = $this->session->userdata ( 'user' )) ; ?>
  <? if(intval($the_session['id'] ) != 0):  ?>
  <? //$user_data = $this->users_model->getUserById ( $session ['id'] );   ?>
  <h2 class="title">User menu</h2>
  <br />
  Hello, <? print $the_session['username'] ; ?> <br />
  <div style="height: 8px;overflow: hidden">&nbsp;</div>
  <a style="width: 140px;" <? if($item['is_act11111ive'] == true): ?>  class="active btn"  <? else: ?>  class="btn" <? endif; ?> href="<? print site_url('affiliate_center/affiliate/products.php'); ?>">Launch affiliate panel</a> <br />
  <div style="height: 7px;overflow: hidden">&nbsp;</div>
  <a style="width: 140px;" <? if($item['is_act11111ive'] == true): ?>  class="active btn"  <? else: ?>  class="btn" <? endif; ?> href="<? print site_url('users/user_action:profile'); ?>">Edit profile</a><br />
<div style="height: 7px;overflow: hidden">&nbsp;</div>
  
  <a style="width: 140px;"   class="btn"   href="<? print $this->taxonomy_model->getUrlForIdAndCache(357); ?>" target="_blank">Affiliates news</a><br />

  <div style="height: 7px;overflow: hidden">&nbsp;</div>
  <a style="width: 140px;"   class="btn"   href="http://<? print $the_session['username'] ; ?>.<?php echo $_SERVER['HTTP_HOST']?>" target="_blank">Launch your site</a><br />

    <div style="height: 7px;overflow: hidden">&nbsp;</div>
  <a style="width: 140px;"   class="btn"   href="<? print site_url('users/user_action:exit'); ?>" target="_blank">Exit</a><br />
  
  
  
  <? // var_dump($shipping_service = $this->session->userdata ( 'user' )) ; ?>
  <? else :  ?>
  
  
  
 
  
   <a href="<? print  ('http://waterforlifeusa.com/aff/affiliates/signup.php'); ?>?ref=<? print $this->session->userdata ( 'ref' ) ?>"><img src="<? print TEMPLATE_URL ?>img/btn/register.png" border="0" alt="Register" /></a>
   <br /><br />   
 
    <a href="<? print ('http://waterforlifeusa.com/aff/affiliates/login.php'); ?>?ref=<? print $this->session->userdata ( 'ref' ) ?>"><img src="<? print TEMPLATE_URL ?>img/btn/login.png" border="0" alt="login" /></a>
  
  
  
  
  
  
  <? endif; ?>
  <br />
  <br />
  <br />
  <h2 class="title">Affiliates info</h2>
  <div style="height: 7px;overflow: hidden">&nbsp;</div>
  <ul class="side-nav">
    <!--   <li><a <? if($item['is_act11111ive'] == true): ?>  class="active"  <? endif; ?> href="<? print site_url('affiliate_center/affiliate/products.php'); ?>">Launch affiliate panel</a></li>-->
    <?	$menu_items = $this->content_model->getMenuItemsByMenuUnuqueId('affiliates_menu', false);	?>
    <? foreach($menu_items as $item): ?>
    <?  	$content_id_item = $this->content_model->contentGetById ( $item['content_id'] );		
	 
	  	     ?>
    <li <? if($item['is_active'] == true): ?>  class="active"  <? endif; ?>><a <? if($item['is_active'] == true): ?>  class="active"  <? endif; ?> href="<? print $item['the_url'] ?>"><? print ucwords( $item['item_title'] ) ?></a></li>
    <? endforeach ;  ?>
  </ul>
  <? include "certificates_rotator.php" ?>
  <? include "facebook_sidebar.php" ?>
  <a href="<? print site_url('main/rss') ?>" class="siderss">Subscribe for RSS</a> </div>
