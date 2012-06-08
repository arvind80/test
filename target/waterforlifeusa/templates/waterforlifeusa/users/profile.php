<div class="bottom-content">
  <div class="left">
    <div class="clear">
      <!--  -->
    </div>
    <? if(!empty($user_edit_errors)) : ?>
    <ul class="error">
      <? foreach($user_edit_errors as $k => $v) :  ?>
      <li><? print $v ?></li>
      <? endforeach; ?>
    </ul>
    <? endif ?>
    <? if($user_edit_done == true) : ?>
    <h2>Profile updated!</h2>
    <? endif ?>
    <form action="<? print site_url('users/user_action:profile'); ?>" method="post" enctype="multipart/form-data" id="profileForm">
      <div class="TheTab">
        <ul class="tabcontrol">
          <li><a class="active" href="#tab1"><span>Your details</span></a></li>
            <li><a href="#tab3" class=""><span>Home page text</span></a></li>
          <li><a class="" href="#tab_about"><span>Your about page</span></a></li>
          <li><a href="#tab2" class=""><span>Your contacts</span></a></li>
        
          <li><input name="Save profile" type="submit" value="Save profile" /></li>
        </ul>
        <div class="tab" id="tab1" style="display: block">
          <label><strong>Username: </strong>
            <input name="username"  type="text" value="<? print $form_values['username'];  ?>">
          </label>
          <label class="noc"><strong>Email:</strong>
            <input name="email" type="text" value="<? print $form_values['email'];  ?>">
          </label>
          <label><strong>First name:</strong>
            <input name="first_name" type="text" value="<? print $form_values['first_name'];  ?>">
          </label>
          <label class="noc"><strong>Last name:</strong>
            <input name="last_name" type="text" value="<? print $form_values['last_name'];  ?>">
          </label>
          <label><strong>Website: </strong>
            <input name="website" type="text" value="<? print $form_values['website'];  ?>">
          </label>
          <!--<label class="noc"><strong>Blog: </strong>
            <input name="user_blog" type="text" value="<? print $form_values['user_blog'];  ?>">
          </label>-->
          <!-- <label><strong>Skype: </strong>
            <input name="chat_skype" type="text" value="<? print $form_values['chat_skype'];  ?>">
          </label>
          <label class="noc"><strong>Gtalk:</strong>
            <input name="chat_googletalk" type="text" value="<? print $form_values['chat_googletalk'];  ?>">
          </label>
          <label><strong>ICQ:</strong>
            <input name="chat_icq" type="text" value="<? print $form_values['chat_icq'];  ?>">
          </label>
          <label class="noc"><strong>MSN: </strong>
            <input name="chat_msn" type="text" value="<? print $form_values['chat_msn'];  ?>">
          </label>
          <label><strong>Facebook:</strong>
            <input name="social_facebook" type="text" value="<? print $form_values['social_facebook'];  ?>">
          </label>
          <label class="noc"><strong>Myspace: </strong>
            <input name="social_myspace" type="text" value="<? print $form_values['social_myspace'];  ?>">
          </label>
          <label><strong>Linkedin:</strong>
            <input name="social_linkedin" type="text" value="<? print $form_values['social_linkedin'];  ?>">
          </label>
          <label class="noc"><strong>Twitter: </strong>
            <input name="social_twitter" type="text" value="<? print $form_values['social_twitter'];  ?>">
          </label>-->
          <label><strong>New password:</strong>
            <input name="password" type="password" value="<? print $form_values['password'];  ?>">
          </label>
          <div >
          <? // p($form_values); ?>
          
          <label>
          	<strong>Picture/Logo:</strong>
            <? $thumb = $this->users_model->getUserThumbnail( $form_values['id'], 128); ?>
            <? if($thumb != ''): ?>
            <img id='user_image' src="<? print $thumb; ?>" />
            <br /><a id='user_image_href' href="javascript:userPictureDelete('<?php echo $form_values['id']?>')">Delete photo</a>
            <? endif; ?>
            
            <input class="input_Up" name="picture_0" style="height:auto" type="file">            
          </label>
          </div>
          <div class="clear"></div>
         
        </div>
        <!-- /tab1 -->
        <div id="tab_about" class="tab">
         <br />
          <br />
          <label><strong>About me:</strong>
            <textarea name="user_information" class="richtext" cols="" rows=""><? print $form_values['user_information'];  ?></textarea>
          </label>
          <div class="clear"></div>
         </div>
        
        <div id="tab2" class="tab">
          <label class="noc"><strong>Country: </strong>
            <input name="zip" type="text" value="<? print $form_values['country'];  ?>">
          </label>
          <label  class="noc"><strong>City: </strong>
            <input name="city" type="text" value="<? print $form_values['city'];  ?>">
          </label>
          <label  class="noc"><strong>Adress:</strong>
            <textarea name="addr1" cols="" rows="5" style="height: 40px"><? print $form_values['addr1'];  ?></textarea>
          </label>
          <div class="clear"></div>
          <label  class="noc"><strong>Zip: </strong>
            <input name="zip" type="text" value="<? print $form_values['zip'];  ?>">
          </label>
          <label class="noc"><strong>Phone: </strong>
            <input name="phone" type="text" value="<? print $form_values['phone'];  ?>">
          </label>
          <div class="clear"></div>
          <label class="noc"><strong>Fax: </strong>
            <input name="fax" type="text" value="<? print $form_values['fax'];  ?>">
          </label>
          <div class="clear"></div>
          <div class="clear"></div>
          <br />
          <br />
          <label>
          	<strong>Notes:</strong>
            <textarea name="user_contacts" class="richtext" cols="" rows=""><? print $form_values['user_contacts'];  ?></textarea>
          </label>
          <div class="clear"></div>
        </div>
        <!-- /tab2 -->
        <div id="tab3" class="tab">
          <label>
          	<strong>Home page text:</strong>
            <textarea name="user_homepage" class="richtext" cols="" rows=""><? print $form_values['user_homepage'];  ?></textarea>
          </label>
          <div class="clear"></div>
        </div>
        <!-- /tab2 -->
      </div>
      <!-- /The Tab -->
      <div style="clear:both;height:12px">&nbsp;</div>
      <a href="javascript:;" class="btn submit">SAVE</a>
    </form>
  </div>
  <? require (ACTIVE_TEMPLATE_DIR.'users/right_sidebar.php') ?>
</div>
