<script type="text/javascript">
function check_all_categories(){
			alert('test');
			/*$("#paradigm_all").click(function()				
			{
				var checked_status = this.checked;
				$("input[@name=paradigm]").each(function()
				{
					this.checked = checked_status;
				});
			});			*/		
}
function uncheck_all_categories(){
			alert('test');
			/*$("#paradigm_all").click(function()				
			{
				var checked_status = this.checked;
				$("input[@name=paradigm]").each(function()
				{
					this.checked = checked_status;
				});
			});			*/		
}
	
	
$(document).ready(function() {
 do_the_content_search_assign()   
 do_the_content_batch_edit_assign()
test = $("#subheader");
	var tax = $("input[name='taxonomy_categories[]']");
	tax.click(function(){
		do_the_content_search_assign();
		})
	
	
	var tags = $("input[name='taxonomy_tags[]']");
	tags.click(function(){
		do_the_content_search_assign();
		})
	
	
	
	var content_item_batch = $("input[name='content_item_batch[]']");
	content_item_batch.click(function(){
		do_the_content_batch_edit_assign();
		})
	
	
})
       
function do_the_content_batch_edit_assign(){



var tax_parent = $("#the_content_items_container");
		var find_c = tax_parent.find(":checked");
			var cc = find_c.serializeArray();
			//alert(cc)
			// $("#the_content_search_form").empty();
			var temp = new Array();
			 jQuery.each(cc, function(i, field){
       		 //$("#the_content_search_form").append(field.value + " ");
			 temp[i] = field.value;
      		});
			temp = temp.join(',') 
			$("#the_batch_edit_items").val(temp);





$test = $("#the_batch_edit_items").val();
if($test == ''){
$("#the_batch_edit_button").hide();
} else {
$("#the_batch_edit_button").show();
}




}
	   
	   
	   
	   
	   
	   
function do_the_content_search_assign(){
		var tax_parent = $("#categories_container");
		var find_c = tax_parent.find(":checked");
			var cc = find_c.serializeArray();
			//alert(cc)
			// $("#the_content_search_form").empty();
			var temp = new Array();
			 jQuery.each(cc, function(i, field){
       		 //$("#the_content_search_form").append(field.value + " ");
			 temp[i] = field.value;
      		});
			temp = temp.join(',') 
			$("#the_content_search_form_categories").val(temp);
			//
			
			
			
			var tax_parent = $("#tags_container");
		var find_c = tax_parent.find(":checked");
			var cc = find_c.serializeArray();
			//alert(cc)
			// $("#the_content_search_form").empty();
			var temp = new Array();
			 jQuery.each(cc, function(i, field){
       		 //$("#the_content_search_form").append(field.value + " ");
			 temp[i] = field.value;
      		});
			temp = temp.join(',') 
			$("#the_content_search_form_tags").val(temp);
			//
	
			
	
}	   
	   
	   






function do_the_content_search(){
	$("#the_content_search_form").submit();
	
}


	
</script>
<script type="text/javascript">
	function tags_append_csv_to_search($tag){
		$the_val = $("#search_by_tags").val();
		
 $("#search_by_tags").val($the_val+ ", "+ $tag);
 
 
	}
</script>

<form method="post" action="<? print site_url('admin/content/posts_manage_do_search');  ?>" id="the_content_search_form">
  <input type="hidden" value="" name="categories" id="the_content_search_form_categories" />
  <input type="hidden" value="" name="tags" id="the_content_search_form_tags"  />
</form>
<table border="0" cellpadding="0" cellspacing="0" id="istable" >
  <tr valign="top">
    <td width="250" ><h2>Categories</h2>
      <p> <a href="javascript: d.openAll();">open all</a> |<a href="javascript: d.closeAll();">close all</a> </p>
      <? 
		$data = array();
		$data['taxonomy_type'] = 'category';
		$data['to_table'] = 'table_content';
		
		
		$orderby[0] = 'taxonomy_value';
		$orderby[1] = 'ASC';
		$cats = $this->content_model->taxonomyGet($data, $orderby ); 
		
		//var_dump($cats);
		foreach($cats as $c){
			
		}
		?>
      <script type="text/javascript">
		<!--


/*Name  	Type  	Description
id 	Number 	Unique identity number.
pid 	Number 	Number refering to the parent node. The value for the root node has to be -1.
name 	String 	Text label for the node.
url 	String 	Url for the node.
title 	String 	Title for the node.
target 	String 	Target for the node.
icon 	String 	Image file to use as the icon. Uses default if not specified.
iconOpen 	String 	Image file to use as the open icon. Uses default if not specified.
open 	Boolean 	Is the node open.

Example

mytree.add(1, 0, 'My node', 'node.html', 'node title', 'mainframe', 'img/musicfolder.gif');







Variable  	Type  	Default  	Description
target 	String 	true 	Target for all the nodes.
folderLinks 	Boolean 	true 	Should folders be links.
useSelection 	Boolean 	true 	Nodes can be selected(highlighted).
useCookies 	Boolean 	true 	The tree uses cookies to rember it's state.
useLines 	Boolean 	true 	Tree is drawn with lines.
useIcons 	Boolean 	true 	Tree is drawn with icons.
useStatusText 	Boolean 	false 	Displays node names in the statusbar instead of the url.
closeSameLevel 	Boolean 	false 	Only one node within a parent can be expanded at the same time. openAll() and closeAll() functions do not work when this is enabled.
inOrder 	Boolean 	false 	If parent nodes are always added before children, setting this to true speeds up the tree.
Example

mytree.config.target = "mytarget";



*/




		d = new dTree('d');
		d.config.useCookies = true;

		d.add(0,-1,'Categories', '<? print site_url('admin/content/posts_manage/'); ?>'); 
		
		<? foreach($cats as $item) : ?>
		<? $link = site_url('admin/content/posts_manage/categories:'. $item['id']); 
		$thumb = $this->content_model->taxonomyGetThumbnailImageById($item['id'] , 16); 
		if($thumb == ''){
		$thumb = 'false';	
		} else {
			$thumb = "'$thumb'";	
		}
		?> 
		
		
		
		
		
	  <?php $actve_ids = $content_selected_categories; ?>
	  <?
	  $is_open = false;	
	  if(!empty($actve_ids )) :?>		
	  <? if(in_array($item['id'], $actve_ids ) == true){
	  $is_open = '<img src="'.THE_STATIC_URL.'icons/arrow.png"  border="0" alt=" " />';	
	  $is_open = addslashes($is_open);
	  } 
	  
	  ?>
	  <? endif; ?>
		
		
		d.add(<? print $item['id'] ?>,<? print $item['parent_id'] ?>,'<? print $is_open ?><? print addslashes(character_limiter($item['taxonomy_value'], 35, ' ') )?>','<? print $link ; ?>',false,false,<? print $thumb ?>,<? print $thumb ?>);
		
		<? endforeach; ?>
		
		
		
		
		/*d.add(1,0,'Node 1','example01.html');
		d.add(2,0,'Node 2','example01.html');
		d.add(3,1,'Node 1.1','example01.html');
		d.add(4,0,'Node 3','example01.html');
		d.add(5,3,'Node 1.1.1','example01.html');
		d.add(6,5,'Node 1.1.1.1','example01.html');
		d.add(7,0,'Node 4','example01.html');
		d.add(8,1,'Node 1.2','example01.html');
		d.add(9,0,'My Pictures','example01.html','Pictures I\'ve taken over the years','','','img/imgfolder.gif');
		d.add(10,9,'The trip to Iceland','example01.html','Pictures of Gullfoss and Geysir');
		d.add(11,9,'Mom\'s birthday','example01.html');
		d.add(12,0,'Recycle Bin','example01.html','','','img/trash.gif');*/








		document.write(d);

		//-->
		
		<? $actve_ids = $content_selected_categories; ?>
		<? if(!empty($actve_ids )) :?>
<? foreach($actve_ids as $item) : ?>
d.openTo(<? print $item ; ?>, true);

<? endforeach; ?>
<? endif; ?>
		
		

	</script>
      <br />
      <br />
      <h2>Tags</h2>
<br />

      <div class="admin_tag_cloud">
        <? $this->content_model->taxonomy_helpers_generateTagCloud("javascript:tags_append_csv_to_search('{taxonomy_value}')");  ?>
      </div>
      <br />

      </td>
    <td><h2>Search</h2>
      <table border="0" cellspacing="0" cellpadding="0" width="100%">
        <tr>
          <td><form action="<? print site_url('admin/content/posts_manage_do_search_by_keyword/'); ?>" method="post">
              <table width="100%" border="0" cellspacing="5" cellpadding="5">
                <tr>
                  <td colspan="6"><table width="100%" border="0" cellspacing="0">
                      <tr>
                        <td width="100"><img src="<?php print_the_static_files_url() ; ?>/icons/magnifier (2).png" alt=" " border="0" />Keywords: </td>
                        <td><input name="keyword" type="text" style="width:80%;" value="<? print $search_by_keyword ?>" /></td>
                      </tr>
                    </table></td>
                </tr>
                <tr> 
                  <td colspan="6"><table width="100%" border="0" cellspacing="0">
                      <tr>
                        <td width="100"><img src="<?php print_the_static_files_url() ; ?>/icons/tag_green.png" alt=" " border="0">Tags: </td>
                        <td><input name="tags" id="search_by_tags" type="text" style="width:80%;" value="<? print $content_selected_tags ?>" /></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td><label><img src="<?php print_the_static_files_url() ; ?>/icons/star.png" alt=" " border="0">In Featured?
                      <select name="is_featured">
                        <option value=""  <? if($search_by_is_is_featured == '') : ?> selected="selected" <? endif; ?> >Any</option>
                        <option value="y" <? if($search_by_is_is_featured == 'y') : ?> selected="selected" <? endif; ?> >Yes</option>
                        <option value="n" <? if($search_by_is_is_featured == 'n') : ?> selected="selected" <? endif; ?>>No</option>
                      </select>
                    </label></td>
                  <td colspan="2"><label><img src="<?php print_the_static_files_url() ; ?>/icons/comment.png" alt=" " border="0">With comments?
                      <select name="with_comments">
                        <option value=""  <? if($search_by_with_comments == '') : ?> selected="selected" <? endif; ?> >Any</option>
                        <option value="y" <? if($search_by_with_comments == 'y') : ?> selected="selected" <? endif; ?> >Yes</option>
                        <option value="n" <? if($search_by_with_comments == 'n') : ?> selected="selected" <? endif; ?>>No</option>
                      </select>
                    </label></td>
                  <td><? if($this->core_model->plugins_isPluginLoaded('rss_grabber') == true) : ?>
                    <? $grabber = new rss_grabber_model(); 
   $feeds = $grabber->getActiveFeeds();
   //var_dump($search_by_is_from_rss );
   ?>
                    <? if(!empty( $feeds )) : ?>
                    <label><img src="<?php print_the_static_files_url() ; ?>/icons/feed__arrow.png" alt=" " border="0">From RSS?
                      <select name="is_from_rss">
                        <optgroup label="From RSS feeds">
                        <option value=""  <? if($search_by_is_from_rss == '') : ?> selected="selected" <? endif; ?> >Any</option>
                        <option value="y" <? if($search_by_is_from_rss == 'y') : ?> selected="selected" <? endif; ?> >Yes</option>
                        <option value="n" <? if($search_by_is_from_rss == 'n') : ?> selected="selected" <? endif; ?>>No</option>
                        </optgroup>
                        <optgroup label="From Specific RSS feed">
                        <? foreach($feeds as $item):  ?>
                        <option value="<? print $item['id'] ?>"   <? if($search_by_is_from_rss == $item['id']) : ?> selected="selected" <? endif; ?>  ><? print addslashes(character_limiter($item['feed_name'],20, '...') )?></option>
                        <? endforeach; ?>
                        </optgroup>
                        <? endif; ?>
                        <? endif; ?>
                      </select>
                    </label></td>
                    
                    
                     <td>
                    <label><img src="<?php print_the_static_files_url() ; ?>/icons/thumb_up.png" alt=" " border="0">Only voted
                      <select name="voted">
                        <option value=""  <? if($selected_voted == false) : ?> selected="selected" <? endif; ?> >No</option>
                       <? 
$number = 365*2;
for ($x = 1; $x <= $number; $x++) : ?>
<option value="<? print $x ?>"  <? if($selected_voted ==  $x) : ?> selected="selected" <? endif; ?> ><? print $x ?> days</option>
<?	endfor; ?>
                      </select>
                    </label></td>
                    
                    
                    
                    
                     <td>
                     <label>Results per page
                      <select name="items_per_page">
                        
                       <? 
$number = 100*1; 
for ($x = 1; $x <= $number; $x++) : ?>
<option value="<? print $x ?>"  <? if($search_items_per_page ==  $x) : ?> selected="selected" <? endif; ?> ><? print $x ?></option> 
<?	endfor; ?>
                      </select>
                    </label>
                     
                     
                     </td>
                </tr>
              </table>
              <br />
              <input name="search_all_categories" type="submit" value="Търси във всички категории" />
              <? if(!empty($content_selected_categories)): ?>
              <input name="search_this_category" type="submit" value="Търси само в текущата категория" />
              <? endif; ?>
              <input name="do_keyword_search" type="hidden" value="1" />
              <? if(!empty($content_selected_categories)): ?>
              <input name="categories" type="hidden" value="<? print implode(',',$content_selected_categories) ;  ?>" />
              <? endif; ?>
            </form></td>
        </tr>
      </table>
      <br />
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><h2>Content</h2></td>
          <td align="right">
          
          <table border="0" cellspacing="0" align="right">
  <tr>
    <td>
    
    
    <div id="the_batch_edit_form_container" style="height:500px; width:400px; overflow:scroll; display:none">
  
  
  
   <script type="text/javascript">
$(document).ready(function() {
     $('#the_batch_edit_tabs').tabs({ });
	 
	 
	 
	 
	 
	 
	 
})



$(document).ready(function() { 
    var options = { 
        //target:        '#output1',   // target element(s) to be updated with server response 
       url : '<?php print site_url('admin/content/posts_batch_edit')  ?>',
	   clearForm: true,
	   resetForm: true ,
	   beforeSubmit:  posts_batch_edit_form_showRequest,  // pre-submit callback 
        success:       posts_batch_edit_form_showResponse  // post-submit callback 
 
        // other available options: 
        //url:       url         // override for form's 'action' attribute 
        //type:      type        // 'get' or 'post', override for form's 'method' attribute 
        //dataType:  null        // 'xml', 'script', or 'json' (expected server response type) 
        //clearForm: true        // clear all form fields after successful submit 
        //resetForm: true        // reset the form after successful submit 
 
        // $.ajax options can be used here too, for example: 
        //timeout:   3000 
    }; 
 
    // bind form using 'ajaxForm' 
    $('#posts_batch_edit_form').ajaxForm(options); 
}); 
 
// pre-submit callback 
function posts_batch_edit_form_showRequest(formData, jqForm, options) { 
    // formData is an array; here we use $.param to convert it to a string to display it 
    // but the form plugin does this for you automatically when it submits the data 
    var queryString = $.param(formData); 
 	/*$test = $("#the_batch_edit_items").val();
	$test = $test.split(',');
	jQuery.each($test, function() {
	//alert(this);
      $("#content_row_id_"+this).fadeOut();
    });*/
    // jqForm is a jQuery object encapsulating the form element.  To access the 
    // DOM element for the form do this: 
    // var formElement = jqForm[0]; 
 
    //alert('About to submit: \n\n' + queryString); 
 
    // here we could return false to prevent the form from being submitted; 
    // returning anything other than false will allow the form submit to continue 
    return true; 
} 
 
// post-submit callback 
function posts_batch_edit_form_showResponse(responseText, statusText)  { 
    
	$test = responseText;
	//alert(responseText);
	$test = $test.split(',');
	jQuery.each($test, function() {
	//alert(this);
      $("#content_row_id_"+this).fadeOut();
	  $("#content_row_id_"+this).remove();
    });
	 $("#the_batch_edit_items").val('');
	tb_remove();
	

	
	
	
	
	// for normal html responses, the first argument to the success callback 
    // is the XMLHttpRequest object's responseText property 
 
    // if the ajaxForm method was passed an Options Object with the dataType 
    // property set to 'xml' then the first argument to the success callback 
    // is the XMLHttpRequest object's responseXML property 
 
    // if the ajaxForm method was passed an Options Object with the dataType 
    // property set to 'json' then the first argument to the success callback 
    // is the json data object returned by the server 
 
   //alert('status: ' + statusText + '\n\nresponseText: \n' + responseText + '\n\nThe output div should have already been updated with the responseText.'); 
} 
















function batch_delete_all_items(){

}




</script>
  
  
  
  
   <form     id="posts_batch_edit_form"  method="post">
    <input type="submit" name="Save" value="Save"/>
    
    
    
   

    

    
    
    
    <div id="the_batch_edit_tabs" style="display:none">
   <ul>
      <li><a href="#tabs-1">Nunc tincidunt</a></li>
      <li><a href="#tabs-2">Proin dolor</a></li>
      <li><a href="#tabs-3">Aenean lacinia</a></li>
   </ul>
   <div id="tabs-1">
      <p>Tab 1 content</p>
   </div>
   <div id="tabs-2">
      <p>Tab 2 content</p>
   </div>
   <div id="tabs-3">
      <p>Tab 3 content</p>
   </div>
</div>
    
    
     <h2>Move to section</h2>
		<?php  
	$this->firecms = get_instance();  
	$sections = $this->firecms->content_model->getBlogSections();  
	?>
        <? foreach($sections as $section) : ?>
        <label><input name="content_parent" type="radio" value="<? print $section['id'] ?>"      />
        <input type="hidden" name="content_subtype_value_<? print $section['id'] ?>"  id="content_subtype_value_<? print $section['id'] ?>"  value="<? print $section['content_subtype_value'] ?>" /><span id="content_url_<? print $section['id'] ?>"><? print site_url($section['content_url']); ?></span>
        </label>
        
        <br />
        <? endforeach;  ?>
        
        <br />
 <h2>Categories</h2>
        <div class="ullist"  id="categories1">
          <? 
	 $this->firecms = get_instance();
	// $active_categories = $this->firecms->content_model->taxonomyGetTaxonomyIdsForContentId( $form_values['id'] , 'categories');
	// var_dump($active_categories );
	  $actve_ids = $active_categories;
	 $active_code = ' checked="checked"  ';
	//function content_helpers_getCaregoriesUlTree($content_parent, $link = false, $actve_ids = false, $active_code = false, $remove_ids = false, $removed_ids_code = false) {

 $this->firecms = get_instance();
 $this->firecms->content_model->content_helpers_getCaregoriesUlTree(0, "<label><input name='taxonomy_categories[]' type='checkbox'  {active_code}   id='category_selector_{id}' value='{id}' />{taxonomy_value}</label>", $actve_ids , $active_code , $remove_ids = false, $removed_ids_code = false);  ?>
        </div>
   
   <input type="submit" name="Save1" value="Save"/>
   
   
    Edit Items:<textarea name="the_batch_edit_items" cols="" rows="" id="the_batch_edit_items"></textarea>
    
    
   </form>
      
      
      
      </div>
    
    
    
    
    
    
    
    
    
    
    
    <div align="right">
    
    
    
      
      
      
      
      
      
     <a class="ovalbutton thickbox" href="#TB_inline?height=500&width=400&inlineId=the_batch_edit_form_container&modal=false" id="the_batch_edit_button"><span><img src="<?php print_the_static_files_url() ; ?>/icons/page_white_lightning.png" alt=" " border="0">Batch edit</span></a>

    
              <a class="ovalbutton<?php if( $className == 'content' and $the_action == 'posts_add')  : ?> active<? endif; ?>" href="<?php print site_url('admin/content/posts_edit/id:0')  ?>"><span><img src="<?php print_the_static_files_url() ; ?>/icons/document__plus.png" alt=" " border="0">Create new content</span></a>
              
              </div></td>
  </tr>
</table>

          
          
              
          </td>
        </tr>
      </table>
      <? 	 $this->firecms = get_instance();	 ?>
      <? if(!empty($form_values)) :   ?>
      <table border="0" class="tablesorter tables" id="sortedtable" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Go</th>
            <th scope="col">Url</th>
            <th scope="col">Title</th>
            <th scope="col">Active?</th>
            <th scope="col">Comments</th>
            <th scope="col">Votes</th>
            <th scope="col">Created</th>
            <th scope="col">Updated</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
          </tr>
        </thead>
        <tbody id="the_content_items_container">
          <? foreach($form_values as $item):  ?>
          <tr id="content_row_id_<? print $item['id']; ?>">
            <td><? print $item['id']; ?><a href="<? print $this->content_model->contentGetHrefForPostId($item['id']) ; ?>" target="_blank" ><img src="<?php print_the_static_files_url() ; ?>admin/icons/silk/page_go.png"  border="0" alt=" " /></a>
            <input type="checkbox" value="<? print $item['id'] ?>" name="content_item_batch[]" />
            
            
            </td>
            <td><div style="display:block; overflow:hidden; height:64px; width:64px; vertical-align:middle; text-align:center"> <img src="<? print   $thumb = $this->content_model->contentGetThumbnailForContentId($item['id'], 64); ?>" height="64" /></div></td>
            <td><?  //print $the_url.'/'.$item['content_url'] ?>
              <? print $this->content_model->contentGetHrefForPostId($item['id']) ; ?></td>
            <td><? print ($item['content_title']) ?></td>
            <td><? print ($item['is_active']) ?></td>
            <td>
			<? 	$temp= $this->content_model->commentsGetForContentId( $item['id']); print (count(  $temp )); ?>
            </td>
            
            <td>
            <? if($selected_voted == false) : ?><? $temp = 7 ?><? else: ?><? $temp = $selected_voted ?><? endif; ?>
			<? print $this->content_model->contentGetVotesCountForContentId($item['id'], $temp); ?>
            </td>
            
            <td><? print ($item['created_on']) ?></td>
            <td><? print ($item['updated_on']) ?></td>
            <td><a target="_blank" href="<?php print site_url('admin/content/posts_edit/id:'.$item['id'])  ?>">Edit post</a></td>
            <td><a  href="javascript:deleteContentItem(<? print $item['id']; ?>, 'content_row_id_<? print $item['id']; ?>')">Delete</a></td>
          </tr>
          <? endforeach; ?>
        </tbody>
      </table>
      <? if($content_pages_count > 1) :   ?>
      <div align="center" id="admin_content_paging">
        <? for ($i = 1; $i <= $content_pages_count; $i++) : ?>
        <a href="<? print  $content_pages_links[$i]  ?>" <? if($content_pages_curent_page == $i) :   ?> class="active" <? endif; ?> ><? print $i ?></a>
        <?  endfor; ?>
      </div>
      <? endif; ?>
      <? else : ?>
      No posts found!
      <? endif; ?></td>
  </tr>
</table>
