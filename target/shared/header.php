<?php ob_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<noscript>
		Your browser does not support JavaScript! Please Enable it to continue!
		<style type="text/css">
			body {display:none;}
		</style>
</noscript> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Status Report</title>
<link href="css/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
<link href="css/jquery.cleditor.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/jquery.ui.timepicker.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="js/application.js"></script>
<script type="text/javascript" src="js/jquery.tablesorter.min.js"></script>
<script type="text/javascript" src="js/jquery.cleditor.min.js"></script>
<script type="text/javascript" src="js/jquery.tablesorter.pager.js"></script>
<script type="text/javascript" src="js/jquery.ui.timepicker.js"></script>
<script type="text/javascript" src="js/jquery.ui.core.min.js"></script>
<script type="text/javascript" src="js/jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="js/jquery.ui.tabs.min.js"></script>
<script type="text/javascript" src="js/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript" src="js/support.js"></script>
<style>
body{font-family:arial; color:#000; font-size:12px; padding:0; margin:0;}
.cont_header{width:100%; float:left;position:relative;z-index:2; height:auto; background-color: #FFF;}
.cont_header .header{width:900px; height:auto;}
.cont_content{width:100%; float:left; height:auto;}
.cont_content .main{width:900px; margin:0 auto; height:auto; min-height:340px;}
.cont_content .main .demo{width:443px; margin:60px auto 0 auto; height:auto;color: #555555; font-family: arial;font-size: 16px;}
.cont_footer{width:100%; float:left; position:relative; bottom:0;  height:80px; background:color:#F0F0F6;}
.cont_footer .footer{width:900px; margin:0 auto; height:auto; background:color:#F0F0F6; font-family:arial; color:#ffffff; font-size:12px;}
.cont_footer .footer h6{width:900px; text-align:center; height:auto; font-family:arial; color:#ffffff; font-size:12px; padding-top:20px;}
</style>
<style>
.ui-tabs-vertical { width: 55em; }
.ui-tabs-vertical .ui-tabs-nav { padding: .2em .1em .2em .2em; float: left; width: 12em;min-height: 700px;}
.ui-tabs-vertical .ui-tabs-nav li { clear: left; width: 100%; border-bottom-width: 1px !important; border-right-width: 0 !important; margin: 0 -1px .2em 0; }
.ui-tabs-vertical .ui-tabs-nav li a { display:block; }
.ui-tabs-vertical .ui-tabs-nav li.ui-tabs-selected { padding-bottom: 0; padding-right: .1em; border-right-width: 1px; border-right-width: 1px; }
.ui-tabs-vertical .ui-tabs-panel { padding: 2em; float: left; width: 40em;}
.ui-button .ui-button-text {
    width: 100px;
}
</style>
<script>
    $(document).ready(function() {
        $("#tabs").tabs().addClass('ui-tabs-vertical ui-helper-clearfix');
        $("#tabs li").removeClass('ui-corner-top').addClass('ui-corner-left');
    });
</script>
</head>
<body>
	<div id="popup_bg" style="background:#333; color:ffffff; width:100%; display:none; height:100%; position:fixed; left:0; top:0; z-index:11; opacity:0.7;"></div>
<div id="popup_form" style="display:none;float:left;background:#fff; width:620px; position:fixed; top:25%; left:30%; z-index:5000; -moz-border-radius: 10px 30px;border:solid 5px #49A4CB;">
<div class="close_dd" style="position:relative;" id=""><a href="javascript:void(0);" id="button_close" style="position:absolute; right:-16px; top:-15px;"><img src="images/close.png" alt="" /></a></div>
<form name="leave_approvel" id="leave_approvel_form" method="post">
<table id="leave_approvel_tab" name="leave_approvel_tab">
	<tr><td colspan="3"></td></tr>
	<tr><td style="padding:5px 5px 5px 10px">Action </td>
		<td width="10px"></td>
		
<?php if(@!$_SESSION['dept_head']){ ?>
<td>
	<input type="radio" name="status" class="required"  value="1" >Approve
	<input type="radio" name="status" class="required" value="0" >Not Approve
	</td>
<?php }?>
<td>
<?php if(@$_SESSION['dept_head']!=''){ ?>
	<select name="approved_by_dept_head" class="required" id="approved_by_dept_head">
		<option value="">Please Select One</option>
		<option value="approved">Approved</option>
		<option value="notapproved">Not Approved</option>  
	</select>
<?php }?>
</td></tr>
<tr><td style="padding:5px 5px 5px 10px" valign="top">Comment</td>
<td width="10px"></td>
<td><textarea name="msg" id="msg"  rows="10" class="textarea_class" cols="60" ></textarea></td></tr>
<tr><td>Name of Employee :</td><td colspan="2" style="background-color:#EEE;" id="getpopup_name_employe"></td></tr>
<tr><td>Designation :</td><td colspan="2" style="background-color:#EEE;" id="getpopup_designation"></td></tr>
<tr><td>Current Project :</td><td colspan="2" style="background-color:#EEE;" id="getpopup_curent_project"></td></tr>
<tr><td>Leave Type :</td><td colspan="2" style="background-color:#EEE;" id="getpopup_leave_type"></td></tr>
<tr><td>Leave Apply Date :</td><td colspan="2" style="background-color:#EEE;" id="getpopup_created_at"></td></tr>
<tr><td>Reason For Leave :</td><td colspan="2" style="background-color:#EEE;" id="getpopup_leave_reason"></td></tr>
<tr><td>Leave From :</td><td colspan="2" style="background-color:#EEE;" id="getpopup_leave_from"></td></tr>
<tr><td>Leave To :</td><td colspan="2" style="background-color:#EEE;" id="getpopup_leave_to"></td></tr>
<input type="hidden" name="leave_pop_up_id" id="leave_pop_up_id" value=""/>
<tr><td colspan="3" height="10px"></td></tr>
<tr><td colspan="3" align="center"><input type="submit" id="submit1" name="submit1" value="Submit"></td></tr>
<tr><td colspan="3" height="10px"></td></tr>
</table>
</form>
</div>
<div id="popup_msg" style="display:none;color:float:left;background:#fafafa; height:50px; line-height: 50px; text-align: center; text-transform: uppercase; width:280px; position:fixed; top:20%; left:40%; z-index:50; -moz-border-radius: 10px 30px; border: 5px solid #49A4CB; font-size: 15px;">Mail has been sent to user regarding approvel</div>
<div id="uploadImage" style="display:none;position:fixed;width:49px;height:49px;left:50%;top:50%;margin-left:-24px;margin-top:-24px;">
		<img src="images/loading_ani.gif"></img>
</div>
