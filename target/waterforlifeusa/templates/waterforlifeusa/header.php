<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" xmlns:v='urn:schemas-microsoft-com:vml'>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="googlebot" content="index,follow" />
<meta name="robots" content="index,follow" />
<meta http-equiv="imagetoolbar" content="no" />
<meta name="rating" content="GENERAL" />
<meta name="MSSmartTagsPreventParsing" content="TRUE" />
<link rel="start" href="<? print site_url(); ?>" />
<link rel="home" type="text/html" href="<? print site_url(); ?>"  />
<link rel="index" type="text/html" href="<? print site_url(); ?>" />
<meta name="generator" content="Microweber" />
<title>{content_meta_title}</title>
{content_meta_other_code}
<meta name="keywords" content="{content_meta_keywords}" />
<meta name="description" content="{content_meta_description}" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<link rel="alternate" type="application/rss+xml" title="RSS" href="<? print site_url('main/rss'); ?>" />
<link rel="sitemap" type="application/rss+xml" title="Sitemap" href="<? print site_url('main/sitemaps'); ?>" />
<meta name="reply-to" content="<? print $this->core_model->optionsGetByKey ( 'creator_email' ); ?>" />
<link rev="made" href="mailto:<? print $this->core_model->optionsGetByKey ( 'creator_email' ); ?>" />
<meta name="author" content="http://ooyes.net" />
<meta name="language" content="en" />
<meta name="distribution" content="global" />
<?  include (ACTIVE_TEMPLATE_DIR.'header_scripts_and_css.php') ?>
</head><body class="front<? if(!empty($subdomain_user)): ?> affiliates<? endif;?> ">
<div id="container">
<div id="maincontainer">
<div id="fcontainer">
<div id="wrapper">
<div id="header" class="wrap">
  <!--<img src="http://waterforlifeusa.com/aff/scripts/sale.php?AccountId=default1&TotalCost=120.50&OrderID=ORD_12345XYZ&ProductID=test_product" width="1" height="1" >-->
  <? if(empty($subdomain_user)): ?>
  <div id="user-logged">
       <a class="top-links top-login-link" target="_blank" href="<? print ('http://waterforlifeusa.com/aff/affiliates/login.php'); ?>?ref=<? print $this->session->userdata ( 'ref' ) ?>">Affiliate Login</a><strong>|</strong> <a class="top-links top-profile-link" target="_blank"  href="<? print  ('http://waterforlifeusa.com/aff/affiliates/signup.php'); ?>?ref=<? print $this->session->userdata ( 'ref' ) ?>">Register</a>
  </div>
  <? else: ?>
  <? if(strval($user_session['is_logged'] ) != 'yes'): ?>
  <div id="user-logged"> <a class="top-links top-profile-link" href="<? print site_url('aff/affiliates/signup.php'); ?>?ref=<? print $this->session->userdata ( 'ref' ) ?>">Sign up as a WFL affiliate!</a> </div>
  <? endif; ?> 
  <? endif; ?>
  <a href="http://waterforlifeusa.zendesk.com" target="_blank" class="btn right" style="margin: 3px 23px 0 20px" title="Customer Support">Customer Support</a>
  <address id="phone">
  CALL NOW <? print $user_data['phone'] ;  ?>
  </address>
  <div class="c"></div>
  <div id="cart">
    <div align="center"> <span id="cartico"></span> <span id="cart-items"> <span id="cart-items-qty">0</span>&nbsp;items </span>
      <div class="c" style="padding-top: 0px"></div>
      <?
$sid=$this->session->userdata('session_id' );
$cart_item = array();
$cart_item['sid'] = $sid;
$cart_item['order_completed'] ='n';

$cart_items = $this->cart_model->itemsGet($cart_item);
 ?>
      <? if(empty($cart_items)): ?>
      <? $blurbs = array('Your cart is empty.', 'See our products <small></small>', 'Go to our products <small></small>');
shuffle($blurbs);

?>
      <a href="<? print $this->content_model->getContentURLByIdAndCache(2) ; ?>"><? print $blurbs[0]; ?></a>
      <? else: ?>
      <a href="<? print $this->content_model->getContentURLByIdAndCache(39) ; ?>" id="view-cart">View cart</a> | <a href="<? print $this->content_model->getContentURLByIdAndCache(48) ; ?>" id="cart-checkout">Checkout</a>
      <? endif; ?>
    </div>
  </div>
  <? if(!empty($subdomain_user)): ?>
  <a id="user_logo" href="<? print site_url(); ?>">
  <? $logo = $this->users_model->getUserThumbnail($subdomain_user['id']); ?>
  <? if($logo != ''): ?>
  <img alt="" src="<? print $logo; ?>">
  <? else: ?>
  <img alt="" src="<? print TEMPLATE_URL; ?>/affimg/demo_user_logo.png">
  <? endif; ?>
  </a>
  <? endif; ?>
  <div class="c"></div>
  <? if(!empty($subdomain_user)): ?>
  <? $menu_items = $this->content_model->getMenuItemsByMenuUnuqueId('affiliates_main_menu'); ?>
  <div id="nav-affiliates">
    <div id="nav_bg">&nbsp;</div>
    <ul>
      <? foreach($menu_items as $item): ?>
      <? $content_id_item = $this->content_model->contentGetByIdAndCache ( $item['content_id'] ); ?>
      <? if($the_section_layout == false): ?>
      <li <? if($item['is_active'] == true): ?>  class="active"  <? endif; ?>><a <? if($item['is_active'] == true): ?>  class="active"  <? endif; ?> href="<? print $item['the_url'] ?>"><? print ucwords( $item['item_title'] ) ?><span></span></a></li>
      <? else : ?>
      <li <? if($content_id_item['content_section_name'] == $the_section_layout): ?>  class="active"  <? endif; ?>><a <? if($content_id_item['content_section_name'] == $the_section_layout): ?>  class="active"  <? endif; ?> href="<? print $item['the_url'] ?>"><? print ucwords( $item['item_title'] ) ?><span></span></a></li>
      <?  endif; ?>
      <? endforeach ;  ?>
    </ul>
  </div>
  <?  else: ?>
  <? $menu_items = $this->content_model->getMenuItemsByMenuUnuqueId('main_menu'); ?>
  <a href="<? print site_url(); ?>" id="logo">Water For Life</a>
  <ul id="nav">
    <? foreach($menu_items as $item): ?>
    <?  	$content_id_item = $this->content_model->contentGetByIdAndCache ( $item['content_id'] );		
	 
	  	     ?>
    <? if($the_section_layout == false): ?>
    <li <? if($item['is_active'] == true): ?>  class="active"  <? endif; ?>><a <? if($item['is_active'] == true): ?>  class="active"  <? endif; ?> href="<? print $item['the_url'] ?>"><? print ucwords( $item['item_title'] ) ?></a></li>
    <? else : ?>
    <li <? if(  ( $content_id_item['id'] == $page['id']  ) or ($content_id_item['id'] == $page['content_parent'] )       ): ?>  class="active"  <? endif; ?>><a <? if( ( $content_id_item['id'] == $page['id']  ) or ($content_id_item['id'] == $page['content_parent'] )): ?>  class="active"  <? endif; ?> href="<? print $item['the_url'] ?>"><? print ucwords( $item['item_title'] ) ?></a></li>
    <?  endif; ?>
    <? endforeach ;  ?>
  </ul>
  <? endif;?>
</div>
<!-- /#header -->
