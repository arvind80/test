






<h2><?php print $item['item_title'] ;  ?></h2>


<a href="<? print site_url('admin/content/menus_edit_small') ?>/id:<?php print $item['id'] ;  ?>/?height=200&width=300" class="thickbox" title="">Edit</a>

<a href="<? print $this->uri->uri_string(); ?>/edit:<?php print $item['id'] ;  ?>">edit</a>&nbsp;|&nbsp;<a href="<? print $this->uri->uri_string(); ?>/delete:<?php print $item['id'] ;  ?>">delete</a>
<?
$this->firecms = get_instance();  
$menu_items = $this->firecms->content_model->getMenuItems($item['id']);
//var_dump($menu_items); 
?>
<? if(!empty($menu_items)): ?>
<table border="1" width="100%">
  <? foreach($menu_items as $menu_item): ?>
  <tr id="menu_item_id_<?php print $menu_item['id'] ;  ?>">
    <td><?php print $menu_item['id'] ;  ?></td>
    <td><?php print $menu_item['item_title'] ;  ?></td>
    <td><?php print $menu_item['is_active'] ;  ?></td>
    <td><a href="<? print $this->uri->uri_string(); ?>/move_up:<?php print $menu_item['id'] ;  ?>">up</a></td>
    <td><a href="<? print $this->uri->uri_string(); ?>/move_down:<?php print $menu_item['id'] ;  ?>">down</a></td>
    <td><a href="javascript:delete_menu_item('<?php print $menu_item['id'] ;  ?>');">delete</a></td>
  </tr>
  <? endforeach; ?>
</table>
<? endif; ?>
