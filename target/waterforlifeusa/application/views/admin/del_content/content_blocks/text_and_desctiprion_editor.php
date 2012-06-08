<?
/*   $dir = ROOTPATH.'/colors/';
	$color_files = array();
   $dirHandle = opendir($dir);
   $count = -1;
   $returnstr = "";
   while ($file = readdir($dirHandle)) {
      if(!is_dir($file) && strpos($file, '.png')>0) {
         $count++;
		 $color_files[] = $file;
       }
   } 
   closedir($dirHandle);
   asort($color_files);*/
?>
<? // if(!empty($color_files)) :?>
<? // foreach($color_files as $color): ?>
<? // $color_name = str_replace('_', ' ', $color); ?>
<?  //$color_name = str_replace('.png', '', $color_name); ?>
<? //$color_name = ucwords($color_name); ?>
<!--<img src="<? print base_url() ?>colors/<? print $color; ?>" height="25" /><? print $color_name ?><br />-->
<? //endforeach; ?>
<? //endif; ?>
<label class="lbl">Short Description </label>
<textarea name="content_description"  rows="10" cols="100" style="width: 645px"><?php print $form_values['content_description']; ?></textarea>
<br />
<br />
<label class="lbl"><strong>Choose type: *</strong></label>
      <span class="linput">
        <select name="content_subtype" style="width:230px;" id="postSet">
          <option <? if(($form_values['content_subtype'] == '' ) or ($form_values['content_subtype'] == 'none' )): ?> selected="selected" <? endif; ?>  value="none">Select:</option>
          <option <? if($form_values['content_subtype'] == 'article' ): ?> selected="selected" <? endif; ?>  value="services">Article</option>
          <option <? if($form_values['content_subtype'] == 'trainings' ): ?> selected="selected" <? endif; ?>  value="trainings">Trainings</option>
          <option <? if($form_values['content_subtype'] == 'products' ): ?> selected="selected" <? endif; ?>  value="products">Product</option>
          <option <? if($form_values['content_subtype'] == 'services' ): ?> selected="selected" <? endif; ?>  value="services">Service</option>
        </select><br />
<br />

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><label class="lbl">Content</label>
      <textarea name="content_body" class="richtext" id="content_body" rows="10" cols="10" style="width:645px"><?php print $form_values['content_body']; ?></textarea></td>
  </tr>
</table>
