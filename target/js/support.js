$(document).ready(function(){
	$("#support_form1").validate({
			rules:{
				"dept_id":{
					required:true
				},
				"subject":{
					required:true
				},
				"support_msg":{
					required:true
					
				},
				"status":{
					required:true
				}
			}
		});
	$("#reply_form").validate({
			rules:{
				"re_subject":{
					required:true
				},
				
				"re_support_msg":{
					required:true
					
				},
				"re_status":{
					required:true
				}
			}
		});
		
		});
	

function fancypop(id){
	
		$("#"+id).fancybox();

}
 function fancypop2(id){
		$("#"+id).fancybox();
			
return false;
}
function statusupdate(id)
{

		$.ajax({
			            type: "POST",
						url: "detailmessage.php",
						data: "id="+id+"&case=statusupdate",
						success: function(data) {
							//alert(data);
						}
			
			
			});
}
		function statusupdate2(id)
{       

		$.ajax({
			
			            type: "POST",
						url: "detailmessage.php",
						data: "id="+id+"&case=statusupdate",
						success: function(data) {
							//alert(data);
						}
			
			
			});


} 
