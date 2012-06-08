<?php
/*
type: layout
name: Shop layout
description: Shop site layout






*/

?>
<? $no_class_richtext_in_content = true; ?>
<?php include "header.php" ?>
   
    <? if(!empty($post)) : ?>
    <?php include "shop_items_view.php" ?>
    <? else : ?>
    <?php include "shop_items_list.php" ?>
    <? endif; ?>
    <?php include "footer.php" ?>
