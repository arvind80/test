<div id="subheader">
  <ul>
    <li><a class="ovalbutton<?php if( $className == 'content' and $functionName == 'pages_index')  : ?> active<? endif; ?>" href="<?php print site_url('admin/content/pages_index')  ?>">Manage pages</a></li>
    <?php if( $className == 'content' and $functionName == 'pages_edit')  : ?>
    <li><a class="ovalbutton<?php if( $className == 'content' and $functionName == 'pages_edit')  : ?> active<? endif; ?>" href="<?php print site_url('admin/content/posts_edit/id:')  ?>/<? print $form_values['id'];?>"><?php print character_limiter($form_values['content_title'], 30, ' ') ; ?></a></li>
    <?  else :?>
    <li><a class="ovalbutton<?php if( $className == 'content' and $functionName == 'pages_edit')  : ?> active<? endif; ?>" href="<?php print site_url('admin/content/pages_edit/id:0')  ?>">Add page</a></li>
    <? endif; ?>
  </ul>
</div>
<div class="content-title">
  <h2 class="left">Site structure management</h2>
</div>
