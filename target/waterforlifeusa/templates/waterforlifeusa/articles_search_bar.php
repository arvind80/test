
<form style="padding-left: 18px;" id="sort-reports"  method="post" action="<?  print  $this->content_model->getContentURLByIdAndCache($page['id']);   ?>">
    <span style="width: 522px;margin:32px 12px 9px 0px;">
        <input style="width:500px;" id="sort-reports-input" type="text" value="<? if($search_for_keyword): ?><? print $search_for_keyword ?><? else: ?>Search<? endif; ?>"  name="search_by_keyword"   />
    </span>
    <input type="submit" value="" id="tsubmit"   />

</form>
