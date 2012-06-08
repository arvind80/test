<h2>Comments</h2><br />
<br />

     <table width="100%" border="0" cellpadding="2">
  <tr>
    <td>
    
    <label class="lbl">Comments enabled?</label>
<input name="comments_enabled" type="radio" value="y" <? if($form_values['comments_enabled'] != 'n') : ?> checked="checked" <? endif; ?> />Yes<br />
<input name="comments_enabled" type="radio" value="n" <? if($form_values['comments_enabled'] == 'n') : ?> checked="checked" <? endif; ?> />No<br />
 <br />
    </td>
  </tr>
  <tr>
    <td>  <? $comments = $temp= $this->content_model->commentsGetForContentId( $form_values['id']); ?>
        <? include (ADMINVIEWSPATH.'comments/comments_list.php') ?></td>
  </tr>
</table>
 