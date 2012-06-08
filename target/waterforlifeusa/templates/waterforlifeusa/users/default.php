<div class="bottom-content">
  <div class="left">
    <div class="clear">
      <!--  -->
    </div>
     
     
 
          <? if(strval($user_session['is_logged'] ) == 'yes'):  ?>
           <? $user_data = $this->users_model->getUserById ( $user_session ['user_id'] );   ?>
         <? //   var_dump($user_data); ?>
         Hello, <? print $user_data['username'] ;  ?><br />
<br />
<br />
<br />

         
         
          <a style="width: 140px;" <? if($item['is_act11111ive'] == true): ?>  class="active btn"  <? else: ?>  class="btn" <? endif; ?> href="<? print site_url('affiliate_center/affiliate/products.php'); ?>">Launch affiliate panel</a> <br />
 <br />
<br />

  <a style="width: 140px;" <? if($item['is_act11111ive'] == true): ?>  class="active btn"  <? else: ?>  class="btn" <? endif; ?> href="<? print site_url('users/user_action:profile'); ?>">Edit profile</a>
  
  <br />
<br />
  <a style="width: 140px;"  class="btn"  href="<? print $this->content_model->taxonomyGetUrlForTaxonomyIdAndCache(357); ?>">Read affiliates news</a>
         
         
         
         <? else :  ?>
          <a href="<? print site_url('users/user_action:login'); ?>" class="<? if($user_action == 'login') : ?> active<? endif; ?>">Login</a>
          <a href="<? print site_url('users/user_action:register'); ?>" class="<? if($user_action == 'register') : ?> active<? endif; ?>">Register</a>
          <? endif; ?>
          
 
     
  </div>
  <? require (ACTIVE_TEMPLATE_DIR.'users/right_sidebar.php') ?>
</div>
