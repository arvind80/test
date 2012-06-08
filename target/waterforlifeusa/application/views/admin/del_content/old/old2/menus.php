 <script type="text/javascript">
	function delete_menu_item($delete_menu_item){
	
	
	var answer = confirm("Sure?")
	if (answer){
		$.post("<? print site_url('admin/content/menus_delete_menu_item') ?>", { delete_menu_item: $delete_menu_item },
  function(data){
 //alert(data); 
 $("#menu_item_id_" +$delete_menu_item ).addClass("light_red_background");
  $("#menu_item_id_" +$delete_menu_item  ).fadeOut();
  
  });
	}
	else{
	//	alert("Thanks for sticking around!")
	}


	}
	
	
	
	
	function menu_item_update_placeholder($id){
	$.get("<? print site_url('admin/content/menus_show_menu_ajax') ?>/id:"+$id, { name: "John", time: "2pm" },
  function(data){
    $("#menu_container_"+$id).html(data);
  });
	
	}
</script>


















<? //  var_dump($menus); ?>
<? foreach($menus as $item): ?>
<div class="boo">




<h2><?php print $item['item_title'] ;  ?></h2>


<!--<a href="<? print site_url('admin/content/menus_edit_small') ?>/id:<?php print $item['id'] ;  ?>/?height=200&width=300" class="thickbox" title="">Edit</a>-->

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
<? endforeach; ?>
<br />
<br />
<br />

<hr />
<form action="<? print $this->uri->uri_string(); ?>" method="post" enctype="multipart/form-data">
  <fieldset>
    <legend>
    <h1>Add/Edit menu</h1>
    </legend>
    <label>Menu title:
      <input name="item_title" type="text" value="<?php print $form_values['item_title']; ?>">
    </label>
    <label>is_active:
      <select name="is_active">
        <option  <? if($form_values['is_active'] == 'y' ): ?> selected="selected" <? endif; ?>  value="y">yes</option>
        <option  <? if($form_values['is_active'] == 'n' ): ?> selected="selected" <? endif; ?>  value="n">no</option>
      </select>
    </label>
    <input name="Save" value="Save" type="submit">
    <input name="id" type="hidden" value="<?php print $form_values['id']; ?>">
  </fieldset>
</form>
</div>