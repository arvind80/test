$(document).ready(function(){
	$('#attendance_form').validate();
	$('#add_new_project_form').validate({rules:{"total_hours":{number:true}}});
	$('#viewAttendance_form').validate();
	$('#viewodeskpdf').validate();
	$('#editAttendance_form').validate({rules:{"date_edit_attendance":{required:true}}});
	$("#editAttendance_show").click(function (){$("#editAttendanceSection").slideDown("slow");$("#userAttendanceView").hide();
	$("#viewAttendanceSection").hide();
	$("#filltodayattendance").hide();});
	$("#viewAttendance_show").click(function (){$("#editAttendanceSection").hide();$("#viewAttendanceSection").slideDown("slow");$("#userAttendanceView").show();$("#filltodayattendance").hide();
	});
	$("#user_status_view").tablesorter({widthFixed: true, widgets: ['zebra']});
	$("#user_status_view").tablesorterPager({container: $("#pager")});  
	$("#halfday_fullday__leave_date").datepicker({showAnim:"clip", showOn: "button",buttonImage: "images/calendar.gif",buttonImageOnly: true,altFormat: 'yy-mm-dd',dateFormat:'yy-mm-dd', changeYear: true,changeMonth: true ,yearRange: '1900',minDate: "today",showWeek: true});$(".tablesorter").tablesorter();
	$("#from_date").datepicker({showAnim:"clip", showOn: "button",buttonImage: "images/calendar.gif",buttonImageOnly: true,altFormat: 'yy-mm-dd',dateFormat:'yy-mm-dd', changeYear: true,changeMonth: true ,yearRange: '1900',minDate: "today",showWeek: true,onClose:function(){compareDatesleaveform();}});
	$("#to_date").datepicker({showAnim:"clip",minDate: "today", showOn: "button",buttonImage: "images/calendar.gif",buttonImageOnly: true,altFormat: 'yy-mm-dd',dateFormat:'yy-mm-dd', changeYear: true,changeMonth: true ,yearRange: '1900',showWeek: true,onClose:function(){compareDatesleaveform();}});
	$("#fillAttendance_show").click(function (){$("#editAttendanceSection").hide();$("#userAttendanceView").hide();$("#viewAttendanceSection").hide();$("#filltodayattendance").slideDown('slow');});
	$("#date_edit_attendance").datepicker({showAnim:"clip",altFormat: 'yy-mm-dd',dateFormat:'yy-mm-dd', changeYear: true,changeMonth: true ,yearRange: '1900',showWeek: true});
	$(function() {$( "#tabs" ).tabs();$( "input:submit,a,button", ".demo" ).button();});
	$("#ajaxHtml").tablesorter({widthFixed: true, widgets: ['zebra']}); function showLoader(){$('.search-background').fadeIn(0);}function hideLoader(){$('.search-background').fadeOut(0);};
	$("#statusform").validate();
	$('input:radio[name=project_type]').click(function(){var project_type=$(this).val();if(project_type=='odesk'){$('#odesk_detail').show();$('#fixed_other').hide();$('#working_hour').removeClass("required");$('#working_hour').val("");$('#odesk_id').addClass("required");$('#client_name').addClass("required");$('#company_name').addClass("required");$('#billing_hour').addClass("required");$('#estimated_hour').addClass("required");}else{$('#odesk_detail').hide();$('#fixed_other').show();$('#working_hour').addClass("required");$('#odesk_id').removeClass("required");$('#client_name').removeClass("required");$('#company_name').removeClass("required");$('#billing_hour').removeClass("required");$('#estimated_hour').removeClass("required");
	$('#odesk_id').val("");$('#client_name').val("");$('#company_name').val("");$('#billing_hour').val("");$('#estimated_hour').val("");}});
	if($('#odesk').attr('checked')){$('#odesk_detail').show();$('#odesk_id').addClass("required");$('#client_name').addClass("required");$('#company_name').addClass("required");$('#billing_hour').addClass("required");$('#estimated_hour').addClass("required");}
	$("#add_user_form").validate({rules:{"email":{required:true,email:true},"full_name":{required:true},"password":{required:true,minlength:5},"department":{required:true}}});
	$("#search_form").validate();
	$("#change_password_frm").validate({rules:{"current_password":{required:true,minlength:5},"new_password":{required:true,minlength:5},"confirm_password":{required:true,minlength:5,equalTo: "#new_password"}}});
	$("#viewpdf").validate();
	$("#paging_button li").click(function(){
		showLoader();
		$("#paging_button li").css({'background-color' : ''});
		$(this).css({'background-color' : '#A5CDFA'});
		$.post('process.php',{ action:'getUserAllStatus',mode:'ajax',page:this.id},function(Response){ hideLoader();$("#ajaxHtml").html(Response);},'');			
	});
	$("#short_leave_time_from").timepicker({ampm: true});
	$("#short_leave_time_to").timepicker({ampm: true});
	$("#view_by_date").datepicker({showAnim:"clip", showOn: "button",buttonImage: "images/calendar.gif",buttonImageOnly: true,altFormat: 'yy-mm-dd',dateFormat:'yy-mm-dd', changeYear: true,changeMonth: true ,yearRange: '1900',showWeek: true});
	$("#short_leave_text_box").datepicker({showAnim:"clip", showOn: "button",minDate: "today",buttonImage: "images/calendar.gif",buttonImageOnly: true,altFormat: 'yy-mm-dd',dateFormat:'yy-mm-dd', changeYear: true,changeMonth: true ,yearRange: '1900',showWeek: true});
	$("#date_view_attendance_start_date").datepicker({showAnim:"clip",altFormat: 'yy-mm-dd',dateFormat:'yy-mm-dd', changeYear: true,changeMonth: true ,yearRange: '1900',showWeek: true});
	$("#date_view_attendance_end_date").datepicker({showAnim:"clip",altFormat: 'yy-mm-dd',dateFormat:'yy-mm-dd', changeYear: true,changeMonth: true ,yearRange: '1900',showWeek: true});
	$("#start_date").datepicker({showAnim:"clip",altFormat: 'yy-mm-dd',dateFormat:'yy-mm-dd', changeYear: true,changeMonth: true ,yearRange: '1900',showWeek: true,onClose:function(){compareDates();}});
	$("#end_date").datepicker({showAnim:"clip",altFormat: 'yy-mm-dd',dateFormat:'yy-mm-dd', changeYear: true,changeMonth: true ,yearRange: '1900',showWeek: true,onClose:function(){compareDates();}});
	$("#loginform").validate({
						rules:{
							"email":{required:true,email:true},
							"password":{required:true,minlength:5}
						}
						});
	
	$('#leave_approvel_form').submit(function(){
			   var getstat= $("input[@name='status']:checked").val();
			   var dept_approvel=$('#approved_by_dept_head').val();
			   if(dept_approvel==0 && getstat==0){alert("Please select a option!");return false;}
			   var msg=$('#msg').val();
			   var  idval=$('#leave_pop_up_id').val();
				  $.ajax({
					  type: "POST",
					  url: "status.php",
					  data: "app="+getstat+"&msg="+msg+"&id="+idval+"&dept_approvel="+dept_approvel,
					  success: function(data){
						 if(data=='failure'){
								alert('There is  some problem in updating the information.Please try again!');
								return false;
						  }
					  $('#popup_bg').css('display','block');	
								$('#popup_form').css('display', 'none'); 
								$('#popup_msg').css('display', 'block'); 
					  setTimeout( function() {
						   $('#popup_msg').hide();
						   $('#popup_bg').hide();
						   window.location.reload();
					   },3000);				
					 }
				  });
		   
			return false;
     });
     
     $("#button_close").click(function(){
		 $("#popup_bg").hide();
		 $("#popup_form").hide();
	});
    //code for leave from
    $("#type_of_leave").change(function(){
			if($(this).val()=='fullday'){
					$('#short_leave_text_box').removeClass("required");
					$('#short_leave_time_from').removeClass("required");
					$('#short_leave_time_to').removeClass("required");
					$('#halfday_fullday__leave_box').slideDown();
					$('#other__leave_date_box').slideUp();
					$('#short_leavebox').hide();
					$('#halfday_fullday__leave__half_select').hide();
					$('#halfday_fullday__leave__half_select').removeClass("required");
					$('#from_date').removeClass("required");
					$('#to_date').removeClass("required");
					$('#total_days').removeClass("required");
					
					$('#halfday_fullday__leave__half_select').val("");
					$('#from_date').val("");
					$('#to_date').val("");
					$('#total_days').val("");
					
			}
			else if($(this).val()=='other'){
					$('#short_leave_text_box').removeClass("required");
					$('#short_leave_time_from').removeClass("required");
					$('#short_leave_time_to').removeClass("required");
				    $('#short_leavebox').hide();
					$('#halfday_fullday__leave_box').slideUp();
					$('#other__leave_date_box').slideDown();
					$('#halfday_fullday__leave__half_select').hide();
					$('#halfday_fullday__leave__half_select').removeClass("required");
					$('#halfday_fullday__leave__half_select').val("");
					$('#halfday_fullday__leave_date').removeClass("required");
					$('#halfday_fullday__leave_date').val("");
					$('#from_date').addClass("required");
					$('#to_date').addClass("required");
					$('#total_days').addClass("required");
					$('#total_days').rules("add","number");
			}
			else if($(this).val()=='halfday'){
					$('#short_leave_text_box').removeClass("required");
					$('#short_leave_time_from').removeClass("required");
					$('#short_leave_time_to').removeClass("required");
					$('#short_leavebox').hide();
					$('#halfday_fullday__leave_box').slideDown();
					$('#halfday_fullday__leave__half_select').show();
					$('#other__leave_date_box').slideUp();
					
					//adding runtime attribute to fields.
					$('#halfday_fullday__leave__half_select').addClass("required");
					$('#halfday_fullday__leave_date').addClass("required");
					
					$('#from_date').removeClass("required");
					$('#to_date').removeClass("required");
					$('#total_days').removeClass("required");
					
					$('#from_date').val("");
					$('#to_date').val("");
					$('#total_days').val("");
			}else if($(this).val()=='shortleave'){
				
				$('#short_leave_text_box').addClass("required");
				$('#short_leave_time_from').addClass("required");
				$('#short_leave_time_to').addClass("required");
				
				$('#short_leavebox').show();
				$('#halfday_fullday__leave__half_select').hide();
				$('#halfday_fullday__leave_box').slideUp();
				$('#other__leave_date_box').slideUp();
				
				$('#from_date').removeClass("required");
				$('#to_date').removeClass("required");
				$('#total_days').removeClass("required");
				$("#total_days").removeClass("number");
				$('#halfday_fullday__leave__half_select').removeClass("required");
				$('#halfday_fullday__leave_date').removeClass("required");
				
				$('#from_date').val("");
				$('#to_date').val("");
				$('#total_days').val("");
				$("#total_days").val("");
				$('#halfday_fullday__leave__half_select').val("");
				$('#halfday_fullday__leave_date').val("");
			}
			else{
				$('#short_leavebox').hide();
				
				$('#halfday_fullday__leave__half_select').hide();
				$('#halfday_fullday__leave_box').slideUp();
				$('#other__leave_date_box').slideUp();
				$('#short_leave_text_box').removeClass("required");
				$('#short_leave_time_from').removeClass("required");
				$('#short_leave_time_to').removeClass("required");
				$('#from_date').removeClass("required");
				$('#to_date').removeClass("required");
				$('#total_days').removeClass("required");
				$("#total_days").removeClass("number");
				$('#halfday_fullday__leave__half_select').removeClass("required");
				$('#halfday_fullday__leave_date').removeClass("required");
				
				$('#from_date').val("");
				$('#to_date').val("");
				$('#total_days').val("");
				$("#total_days").val("");
				$('#halfday_fullday__leave__half_select').val("");
				$('#halfday_fullday__leave_date').val("");
			}
	});
    
    
    //code for leave from ends.
		$("#leave_form").validate({
			rules:{
				"emp_name":{
					required:true
				},
				"emp_dept1":{
					required:true
				},
				"emp_designation":{
					required:true
					
				},
				"reason_for_leave":{
					required:true
				},
				"type_of_leave":{
					required:true
				},
				"emp_cur_Project":{
					required:true
				}
			}
		});
		
		
		//forget Password.
		$('#forget_pass').submit(function(){
									var mailid=$('#email_pass').val();
									if(mailid!=''){
										$.ajax({
										type: "POST",
										url: "forget_password.php",
										data: "mailid="+mailid,
										success: function(data) {
										$('#popup_msg_pass').html(data);
										$('#popup_bg_pass').show();        
										$('#popup_form_pass').hide(); 
										$('#popup_msg_pass').show(); 
										setTimeout( function() {
										$('#popup_msg_pass').hide();
										$('#popup_bg_pass').hide();
										window.location.reload();
										}, 3000 );
										}
									});
									}
                          

                                return false;

                                });
                                
        $("#edit_user_form").validate({
                        rules:{
                                
                                "full_name_edit":{
                                        required:true
                                },
                                "department_edit":{
                                        required:true,
                                        
                                },
                                "email_edit":{
                                        required:true,
                                        email:true
                                }
                        }

                });
	$('#popup_bg_edit').click(function(){
		 $('#popup_bg_edit').hide();
		 $('#popup_form_edit').hide();

	});
	
	$('#button_close_edit').click(function(){
		 $('#popup_bg_edit').hide();
		 $('#popup_form_edit').hide();
	});
                          
});
function hideShowAttendance(value){
	var a=$('#attendancebox'+value).toggle();$('#leavebox'+value).toggle();
	if($('#attendancebox'+value).is(":visible") ){$('#present'+value).addClass("required");$('#absent'+value).addClass("required");$('#late_coming'+value).addClass("required");$('#onleaveSelect'+value).removeClass("required");
	}else{$('#onleaveSelect'+value).addClass("required");$('#present'+value).removeClass("required");$('#absent'+value).removeClass("required");$('#late_coming'+value).removeClass("required");$('#textattendance'+value).removeClass("required");
	}
	$('#type_of_leave_box'+value).toggle();
}

function gettime(val,hide){
	if(hide!='hide'){$('#textattendance'+val).show();$('#textattendance'+val).addClass("required");
	}
	else{$('#textattendance'+val).removeClass("required");$('#textattendance'+val).hide();
	}
}

function checkAll(){
	var check=$('#checkall');
	if((check.is(':checked'))){$('input:checkbox[name="username[]"]').attr("checked",true);
	}else{$('input:checkbox[name="username[]"]').attr("checked",false);
	}
}

function selectRadios(selected){
	$("input:radio[value="+selected+"]").attr('checked',true);$("input:text[name="+'textattendance[]'+"]").removeClass('required');$("input:text[name='textattendance[]']").css('display','none');
}

function editAttendance(){
	var attendance_date=$('#date_edit_attendance').val();
	if(attendance_date!=''){
		disablePageElements();
		$.post('process.php',{action:'editAttendance',date:attendance_date},function(Response){
			enablePageElements();	
			$("#uploadImage").hide(); $('#filltodayattendanceAjax').html(Response);},'');			
	}
	return false;
}

function checkLogin(){
	
	var userpassword=$('#password').val();
	var email=$('#email').val();
	
	if(userpassword!='' && email!=''){
		disablePageElements();
	    $.post('process.php',{action:'checklogin',email:email,password:userpassword},
	function(Response){
	    	enablePageElements();
			if(Response=='admin' || Response=='DeptHead' || Response=='HR' ||Response=='success'){
				window.location.href='index.php?'+Response+'=true';return true;
			}else{$('#eroorlogin').html('<font color="red">Authenticaton Failed! Please Try Again</font>');return false;}
	},'');
				$('input').removeAttr("disabled", true); 
			}
	return false;
}

function viewAttendance(){
		var viewType=$("#date_view_type_attendance").val();
		var viewUser=$("#view_by_user").val();
		var startDate=$("#date_view_attendance_start_date").val();
		var endDate=$("#date_view_attendance_end_date").val();
		if(viewType!=''&&startDate!=''){
		disablePageElements();
		$.post('process.php',
		{action:'viewAttendance',start_date:startDate,end_date:endDate,viewtype:viewType,viewuser:viewUser},function(Response){ 
			enablePageElements();
			$('#userAttendanceView').html(Response);
			},'');	
		}		
		return false;
}



function checkNumeric(val,id,errorId){
	if(isNaN(val)){
		$('#'+id).val('');
		$("#"+errorId).html("<font color='red'>Please enter numeric value. eg 8.00 !</font>");
	}else{
		$("#"+errorId).html("");
	}
}
function compareDates(){
	var fromDate=document.getElementById("start_date").value;
	var toDate=document.getElementById("end_date").value;
	if(fromDate!=='' && toDate!==''){
		if (Date.parse(fromDate) > Date.parse(toDate)) {
			document.getElementById("start_date").value='';
			alert("Invalid Date Range!\nStart Date cannot be after End Date!")
			return false;
		}
	}
}
function compareDatesleaveform(){
       	var fromDate=document.getElementById("from_date").value;
		var toDate=document.getElementById("to_date").value;
		if(fromDate!=='' && toDate!==''){
			if (Date.parse(fromDate) >= Date.parse(toDate)) {
				alert("Invalid Date Range!\nStart Date cannot be after or equal to  End Date!");
							  $("#from_date").val('');
							  $("#total_days").val('');
							 return false;
			}
			var firstDate=fromDate.split('-');
			var secondDate=toDate.split('-');
			$("#total_days").val(1+Math.floor(( Date.parse(toDate) - Date.parse(fromDate) ) / 86400000));
		}
}

function compareDatesReportPeriodform(){
	  	var fromDate=document.getElementById("start_date_odesk").value;
		var toDate=document.getElementById("end_date_odesk").value;
		if(fromDate!=='' && toDate!==''){
			if (Date.parse(fromDate) >= Date.parse(toDate)) {
				alert("Invalid Date Range!\nStart Date cannot be after or equal to  End Date!");
				document.getElementById("start_date_odesk").value='';	 
							 return false;
			}
			
		}
}
function checkPasswordStrength(){
	if(!(/[A-Z]/.test(document.getElementById("new_password").value))){
	  document.getElementById('password_help_error').innerHTML = "<font color='red' size='1'>Required: Passwords must be strong, one uppercase, one number and must be at least 5 characters in length!</font>";
	  if(document.getElementById("current_password").value!=''){
		document.getElementById("new_password").focus();}
	  return false;	
	}
	else  if(!(/[0-9]/.test(document.getElementById("new_password").value))){
	  document.getElementById('password_help_error').innerHTML = "<font color='red' size='1'>Required: Passwords must be strong, one uppercase, one number and must be at least 5 characters in length!</font>";
	  if(document.getElementById("current_password").value!=''){
		document.getElementById("new_password").focus();}
	  return false;	
	}
	
	return true;
}

function passwordHelp(){
	$('#password_help_error').html('<font color="green" size="1">Passwords must be strong, one uppercase, one number and must be at least 5 characters in length!</font>');
}
function displayVals(id,div_id) {
	$("#"+div_id).show();
	var multipleValues = $("#"+id).val() || [];
	$("#"+div_id).html(multipleValues.join("<br/> "));
	$("select#"+id).change(displayVals);
	displayVals();
 }
function getleaveid(id){
	var mailid=id;
	if(mailid!=''){
		 $.ajax({
			   type: "POST",
			   url: "userleave.php",
			   data: "id="+mailid,
			   success: function(data) {
				   $('#leavis').html(data);
				   
			   }
		 });
	 }return false;
}
function approvalform(requestid){
		$('#popup_bg').css('display','block');        
		$('#popup_form').css('display', 'block');
		$("#getpopup_leave_reason").html($('#reason_for_leave_'+requestid).val());
		$("#getpopup_leave_from").html($('#leave_from'+requestid).val());
		$("#getpopup_leave_to").html($('#leave_to'+requestid).val());
		$("#getpopup_created_at").html($('#created_at'+requestid).val());
		$("#getpopup_name_employe").html($('#name_employe'+requestid).val());
		$("#getpopup_designation").html($('#designation'+requestid).val());
		$("#getpopup_curent_project").html($('#curent_project'+requestid).val());
		$("#getpopup_leave_type").html($('#leave_type'+requestid).val());
		
		
		$("#leave_pop_up_id").val($('#leave_id'+requestid).val());
		$('#popup_bg').click(function(){
				$('#popup_bg').css('display','none');        
				$('#popup_form').css('display', 'none');
		});        
	return false;
}

function showShortLeaveBox(id,value){
	if(value=='shortleave'){
		$('#'+id).show();$('#'+id).addClass("required");
		
	}else{
		$('#'+id).hide();$('#'+id).removeClass("required");
	}
}
function disablePageElements(){
	$("#uploadImage").show();
	$('input,select').attr('disabled', 'disabled');
}

function enablePageElements(){
	$("#uploadImage").hide();
	$('input,select').removeAttr('disabled', 'disabled');
}
function validenter(){
	var charfield=document.getElementById("new_password")
	charfield.onkeydown=function(e)
	{
	  var e=window.event || e
	  if(e.keyCode==32)
	  {
	  alert("Password does not contain spaces!");
	  charfield.value='';
	  return false;
	  }
	}
}
function forgetpass(){
	$('#popup_bg_pass').show();
	$('#popup_form_pass').show();
	$('#popup_bg_pass').click(function(){
	$('#popup_bg_pass').hide();
	$('#popup_form_pass').hide();
	});
	$('.close_dd_pass').click(function(){
	$('#popup_bg_pass').hide();
	$('#popup_form_pass').hide();});
}
function edituser(id){
        var userid=id
        if(userid!=''){
        $('#popup_bg_edit').show();
        $('#popup_form_edit').show();
        $.ajax({
			type: "POST",
						url: "useredit.php",
						data: "id="+id+"&case=edit_user",
						success: function(data) {
							 var userinfo=data.split(',');
							 var username=userinfo[0];
							 var department=userinfo[1];
							 var email=userinfo[2];
							 var email2=$.trim(email);
                             var admin=$.trim(userinfo[3]);
 						    var dept_head=$.trim(userinfo[4]); 
						    $('#full_name_edit').val(username);
							$('#department_edit').val(department).attr("selected","selected");
							$('#email_edit').val(email2);
							$('#type1').val(admin);
							$('#dept_head').val(dept_head);
							$('#hd_id').val(userid);
							if(dept_head==1){
							$('input:checkbox[name="dept_head"]').attr("checked",true);
								$('input:checkbox[name="dept_head"]').val(1);
							}else{
								$('input:checkbox[name="dept_head"]').attr("checked",false);
								$('input:checkbox[name="dept_head"]').val(0);
							}
							
							if(type=='admin'){
							$('input:checkbox[name="type1"]').attr("checked",true);
								$('input:checkbox[name="type1"]').val('admin');
							}
							else{
								$('input:checkbox[name="type1"]').attr("checked",false);
								$('input:checkbox[name="type1"]').val('');}
							}
				});       
		}                
}
        
         function setstatus(value,id) {
				var id=id;
					var value=value;
					$.ajax({
					type: "POST",
					url: "useredit.php",
					data: "id="+id+"&value="+value+"&case=status_upd",
					success: function(data){ 
									$('#popup_msg').html(data);
									$('#popup_bg').show();
									$('#popup_form').hide();
									$('#popup_msg').show();
					setTimeout(function(){
									$('#popup_msg').hide();
									$('#popup_bg').hide();      
							}, 3000 );
					}

		  });
		  return false;
		}
