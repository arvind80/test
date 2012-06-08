<?
$form_values = $user_data;
  /*
    <TD> SAS KLAS 'checkMe' SE PROVERQVAT DALI SA PRAZNI I AKO SA SE TRIE <TR>-TO

  */
?>
<script type="text/javscript">

$(document).ready(function(){

});
 </script>

<div id="public_profile">
  <div id="profile_photo">
    <? $thumb = $this->users_model->getUserThumbnail( $form_values['id'], 330); ?>
    <? if($thumb != ''): ?>
    <img src="<? print $thumb; ?>" />
    <? endif; ?>
    <div id="tvMask"></div>
  </div>
  <table border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td><strong>Потребителско Име: </strong></td>
      <td class="checkMe"><? print $form_values['username'];  ?></td>
    </tr>
    <tr>
      <td><strong>Име: </strong></td>
      <td class="checkMe"><? print $form_values['first_name'];  ?>&nbsp;<? print $form_values['last_name'];  ?></td>
    </tr>
    <!-- <tr>
        <td><strong>Фамилия:  </strong></td>
        <td class="checkMe"></td>
      </tr>
      <tr>
        <td><strong>Email:</strong></td>
        <td class="checkMe"><? print auto_link($form_values['email'], 'both', TRUE); ?></td>
      </tr>-->
    <tr>
      <td><strong>Website:</strong></td>
      <td class="checkMe"><? print auto_link($form_values['user_website'], 'both', TRUE); ?></td>
    </tr>
    <tr>
      <td><strong>Блог:</strong></td>
      <td class="checkMe"><? print  auto_link($form_values['user_blog'], 'both', TRUE); ?></td>
    </tr>
    <tr>
      <td><strong>За Мен:</strong></td>
      <td class="checkMe"><? print($form_values['user_information']); ?></td>
    </tr>
    <tr>
      <td><strong>Виж публикациите на този потребител:</strong>
      <br />
<ul>
          <li><a class="orange" href="<? print $this->content_model->taxonomyGetUrlForTaxonomyId(4); ?>/author:<? print $form_values['id'];  ?>">Новини</a></li>
          <li><a class="orange" href="<? print $this->content_model->taxonomyGetUrlForTaxonomyId(1); ?>/author:<? print $form_values['id'];  ?>">Видео</a></li>
           <li><a class="orange" href="<? print $this->content_model->taxonomyGetUrlForTaxonomyId(2); ?>/author:<? print $form_values['id'];  ?>">Рубрики</a></li>
           <li><a  class="orange" href="<? print $this->content_model->taxonomyGetUrlForTaxonomyId(3); ?>/author:<? print $form_values['id'];  ?>">Онлайн телевизии</a></li>
        </ul>
      
      </td>
      <td ></td>
    </tr>
    <tr>
      <td><a href="javascript:;" id="showContacts"><strong>Контакти</strong></a></td>
      <td></td>
    </tr>
    <tr class="contacts">
      <td><strong>Skype:</strong></td>
      <td class="checkMe"><? print($form_values['chat_skype']); ?></td>
    </tr>
    <tr class="contacts">
      <td><strong>Gtalk:</strong></td>
      <td class="checkMe"><? print($form_values['chat_googletalk']); ?></td>
    </tr>
    <tr class="contacts">
      <td><strong>ICQ:</strong></td>
      <td class="checkMe"><? print($form_values['chat_icq']); ?></td>
    </tr>
    <tr class="contacts">
      <td><strong>MSN:</strong></td>
      <td class="checkMe"><? print($form_values['chat_msn']); ?></td>
    </tr>
    <tr class="contacts">
      <td><strong>Facebook:</strong></td>
      <td class="checkMe"><? print($form_values['social_facebook']); ?></td>
    </tr>
    <tr class="contacts">
      <td><strong>Myspace:</strong></td>
      <td class="checkMe"><? print($form_values['social_myspace']); ?></td>
    </tr>
    <tr class="contacts">
      <td><strong>Linkedin:</strong></td>
      <td class="checkMe"><? print($form_values['social_linkedin']); ?></td>
    </tr>
    <tr class="contacts">
      <td><strong>Twitter:</strong></td>
      <td class="checkMe"><? print($form_values['social_twitter']); ?></td>
    </tr>
  </table>
</div>
