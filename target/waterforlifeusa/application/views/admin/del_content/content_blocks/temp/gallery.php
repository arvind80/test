<table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><script type="text/javascript">
	
	
	function  contentMediaEditPicture($id){

	if($("#content_form_object").hasClass("save_disabled")){
	alert("Error: You cannot delete while uploading!");
	return false;
	} else {
	
	}


}
	
function  contentMediaDeletePicture($id){

if($("#content_form_object").hasClass("save_disabled")){
alert("Error: You cannot delete while uploading!");
return false;
}



var answer = confirm("Are you sure?")
	if (answer){
		$.post("<? print site_url('admin/core/mediaDelete') ?>", { id: $id, time: "2pm" },
  function(data){
	  //$("#gallery_module_sortable_pics_positions_"+$id).fadeOut();
	  $("#gallery_module_sortable_pics_positions_"+$id).remove();
	// contentMediaPicturesRefreshList();
   //alert("Data Loaded: " + data);
  });
	}
	else{
		//alert("Thanks for sticking around!")
	}
 
}



function contentMediaPicturesRefreshList(){
var media_upload_queue1 = $('#media_queue_pictures').val();
var to_table_id1 = $('#id').val();

$.post("<? print site_url('admin/media/contentMediaPicturesList') ?>/to_table:table_content/queue_id:"+media_upload_queue1+"/to_table_id:"+to_table_id1, function(data){
  $("#media_pictures_placeholder").html(data);

if ( $("#gallery_module_sortable_pics").exists() ){
	$("#gallery_module_sortable_pics").sortable(
	{
	update : function () {
	var order = $('#gallery_module_sortable_pics').sortable('serialize');
	$.post("<? print site_url('admin/media/reorderMedia') ?>", order,
	function(data){
	});
	}
	}				
	);
}




 
});

}
</script>
      <script type="text/javascript">

 $(document).ready(function(){
contentMediaPicturesRefreshList();
var media_upload_queue = $('#media_queue_pictures').val();

$("#pictures_upload_progressbar").progressbar({
			value: 0
		});
 });
 
 
 
 
 
 
 
 
 
 
 
 
</script>
      <script type="text/javascript">

	function picturesUploadUpdateProgressbar(){
	
	//$total = $('#pictures_upload_progressbar_total_count').html();
	//$total = parseInt($total);
	
	//$currently_uploaded = $('#pictures_upload_progressbar_currently_uploaded').html();
	//$currently_uploaded = parseInt($currently_uploaded);
		
		//if($currently_uploaded == $total){
			
		//} else {
			//if(($total > 0)){
			//	a = $currently_uploaded;
			//	b = $total;
			//	c = a/b;
			//	d = Math.round(c*100);
			//	d = 100 - d;
				//$('#pictures_upload_progressbar').progressbar('option', 'value', d);
		//	}
		//}
	
	}
	</script>
      <script type="text/javascript">
$(document).ready(function() {
var media_upload_queue = $('#media_queue_pictures').val();
	$("#uploadify").uploadify({
		'uploader'       : uploadify_uploader_swf_url,
		'script'         : "<? print site_url('admin/media/mediaUploadPictures') ?>/to_table:table_content/queue_id:"+media_upload_queue,
		'cancelImg'      : uploadify_cancel_image_url,
		'folder'         : "<? print site_url('admin/media/mediaUploadPictures') ?>/to_table:table_content/queue_id:"+media_upload_queue,
		'queueID'        : 'fileQueue'+media_upload_queue,
		'method'		 : "POST",
		'auto'           : true,
		'simUploadLimit' : 1,
		'multi'          : true,
		//'scriptAccess':  'always',
		'fileDesc':  'Image files',
		'fileExt': '*.jpg;*.png;*.gif;',
			
 
		/*//'displayData': 'speed',
		 onComplete   : function(event, queueID, fileObj, reposnse, data) {
         contentMediaPicturesRefreshList();
		 $('#pictures_upload_progressbar_currently_uploaded').html(data.fileCount  );
		 picturesUploadUpdateProgressbar();
		 $("#content_form_object").removeClass("save_disabled");
		 
        },*/
		/*onProgress   : function(event, queueID, fileObj,  data) {
		//$('#pictures_upload_progressbar').progressbar('option', 'value', data.percentage);
		//$('#pictures_upload_progressbar3').html( data.percentage );
		$('#pictures_upload_progressbar1').html(data.allBytesLoaded );
		
       	$("#content_form_object").addClass("save_disabled");
        },*/
		
		//onSelectOnce   : function(event, data) {
		//$('#pictures_upload_progressbar').progressbar('option', 'value', data.percentage);
		//$('#pictures_upload_progressbar_total_count').html( data.fileCount );
       //	$("#content_form_object").addClass("save_disabled");
       // },
		onAllComplete : function(event, data) {
		//$('#pictures_upload_progressbar').progressbar('option', 'value', data.percentage);
		 contentMediaPicturesRefreshList();
       	$("#content_form_object").removeClass("save_disabled");
        }
		
		
		
	 
		
		
		
		
		
		
		
		
	});
	
	
});
</script>
      <div id="fileQueue"></div>
      <input type="file" name="uploadify" id="uploadify" />
      <p><a href="javascript:jQuery('#uploadify').uploadifyClearQueue()">Cancel All Uploads</a></p>
      <div id="pictures_upload_progressbar"></div>
      <div id="pictures_upload_progressbar_currently_uploaded"></div>
      <hr />
       <div id="pictures_upload_progressbar1"></div>
      <hr />


      <div id="pictures_upload_progressbar_total_count"></div>
      <hr />
      <div id="media_pictures_placeholder">Loading gallery module...</div></td>
  </tr>
</table>
