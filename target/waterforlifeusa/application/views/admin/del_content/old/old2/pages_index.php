
<? if(!empty($dbdata['pages'])) : ?>



<table border="0" class="tablesorter tables" cellspacing="0" cellpadding="0">
<thead>
  <tr>
    <th scope="col">ID</th>
    <th scope="col">content_title</th>
    <th scope="col">content_url</th>
    <th scope="col">content_filename</th>
    <th scope="col">is_active</th>
    <th scope="col">updated_on</th>
    <th scope="col">edit</th>
    <th scope="col">delete</th>
  </tr></thead>
  <tbody>
  <?php foreach($dbdata['pages'] as $item): ?>
  <tr id="content_row_id_<? print $item['id']; ?>">
    <td><? print($item['id']) ; ?></td>
    <td><? print($item['content_title']) ; ?>
    <? if($item['is_home'] == 'y') : ?>
    <img src="<?php print_the_static_files_url() ; ?>icons/home.png"  border="0" alt=" " />
    <? endif;  ?>
     <? if($item['content_subtype'] == 'module') : ?>
    <img src="<?php print_the_static_files_url() ; ?>icons/puzzle.png"  border="0" alt="<? print addslashes($item['content_subtype_value']); ?>" />
    <? endif;  ?>
     <? if($item['content_subtype'] == 'blog_section') : ?>
    <img src="<?php print_the_static_files_url() ; ?>icons/blog.png"  border="0" alt="<? print addslashes($item['content_subtype_value']); ?>" />
    <? endif;  ?>
    
    
    
    </td>
    <td><? print($item['content_url']) ; ?></td>
    <td><? print($item['content_filename']) ; ?></td>
    <td><? print($item['is_active']) ; ?></td>
    <td><? print($item['updated_on']) ; ?></td>
    <td><a href="<?php print site_url('admin/content/pages_edit/id:'.$item['id'])  ?>">Edit</a></td>
     <td><a href="javascript:deleteContentItem(<? print $item['id']; ?>, 'content_row_id_<? print $item['id']; ?>')">Delete</a></td>
  </tr>
  <? endforeach ?></tbody>
</table>
<? endif; ?>
