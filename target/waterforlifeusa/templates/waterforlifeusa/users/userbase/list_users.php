<div class="bottom-content">
  <div class="left" id="useri">
    <h2 class="tvtitle tvorange isleft" style="margin:30px 2px 3px 31px;width:200px">Потребители</h2>
    <? foreach($users_list as $item): ?>
    <br class="clear" />
    <div class="preview"> <a href="<? print $this->content_model->contentGetHrefForPostId($item['id']) ; ?>"> <img src="<? print   $thumb = $this->users_model->getUserThumbnail($item['id'], 118); ?>" width="118" height="88" alt="" /></a>
      <div class="description"> <span class="title"><? print $item['username'] ?></span> <span class="date"><? print $item['created_on'] ?></span><br />

        <p><? print character_limiter($item['user_information'], 60, '...'); ?></p>
        <br />
        
        <a href="<? print site_url('userbase/action:profile/username:').$item['username'] ?>" class="orangebtn">Виж</a> </div>
    </div>
    <? endforeach; ?>
    <? if(!empty($content_pages_links)): ?>
    <ul class="paginator">
      <!--<li class="back"><a href="javascript:;">&nbsp;</a></li>-->
      <? $i = 1; foreach($content_pages_links as $page_link) : ?>
      <li <? if($content_pages_curent_page == $i) : ?>  class="selected"  <?  endif; ?> ><a href="<? print $page_link ;  ?>"   ><? print $i ;  ?></a></li>
      <!--<li class="next"><a href="javascript:;">&nbsp;</a></li>
      <li class="forward"><a href="javascript:;">&nbsp;</a></li>-->
      <? $i++; endforeach;  ?>
    </ul>
    <? endif; ?>
  </div>
    <? require (ACTIVE_TEMPLATE_DIR.'users/userbase/right_sidebar.php') ?>
</div>


