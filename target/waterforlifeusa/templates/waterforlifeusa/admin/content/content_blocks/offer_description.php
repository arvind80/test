 
    <label class="lbl">Is special?</label>
    <select name="is_special">
      <option <? if($form_values['is_special'] == 'n' ): ?> selected="selected" <? endif; ?> value="n">no</option>
      <option <? if($form_values['is_special'] == 'y' ): ?> selected="selected" <? endif; ?> value="y">yes</option>
    </select>
 
<br />
<br />


 <label class="lbl">Tabs layout?</label>
      <select name="custom_field_tabs_layout">
        <option  <? if( $form_values['custom_fields']['tabs_layout'] == 'n' ): ?> selected="selected" <? endif; ?>  value="n">&nbsp;no&nbsp;</option>
        <option  <? if( $form_values['custom_fields']['tabs_layout'] == 'y' ): ?> selected="selected" <? endif; ?>  value="y">&nbsp;yes&nbsp;</option>
      </select>
<br />

<label class="lbl">Prices</label>
<textarea id="custom_field_prices" class="richtext" style="width:350px;height: 150px" cols="10" rows="10" name="custom_field_prices"><?php print  $form_values['custom_fields']['prices']; ?></textarea>
<br />
<label class="lbl">Promotions</label>
<textarea id="custom_field_promotions" class="richtext" style="width:350px;height: 150px" cols="10" rows="10" name="custom_field_promotions"><?php print  $form_values['custom_fields']['promotions']; ?></textarea>