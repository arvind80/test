<?php ob_start();
require_once('includes/confignew.php');
require_once('ps_pagination.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">  
<html lang="en" xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>PayPal Transaction Search And Ebay </title>
    <link rel="stylesheet" href="js/themes/ui-lightness/jquery.ui.all.css">
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.ui.js"></script>
    <script type="text/javascript" src="js/timepicker.js"></script>
    <script type="text/javascript" src="js/slider.js"></script>
     <script type="text/javascript" src="js/jqueryvalidator.js"></script>
</head>
<script>
$(function() {
    $('#datepicker').datetimepicker({
        showSecond: true,
	timeFormat: 'hh:mm:ss',
	dateFormat: 'yy-mm-dd',
         maxDate:'0',
        onClose: function(dateText, inst) {
        var endDateTextBox = $('#datepicker2');
        if (endDateTextBox.val() != '') {
            var testStartDate = new Date(dateText);
            var testEndDate = new Date(endDateTextBox.val());
            if (testStartDate > testEndDate)
                endDateTextBox.val(dateText);
        }
        
    },
    onSelect: function (selectedDateTime){
        var start = $(this).datetimepicker('getDate','+1d');
         start.setDate(start.getDate()+1); 
        $('#datepicker2').datetimepicker('option', 'minDate', new Date(start.getTime()));
    }
});

$( "#datepicker2" ).datetimepicker({
    showSecond: true,
     timeFormat: 'hh:mm:ss',
	dateFormat: 'yy-mm-dd' ,
       maxDate:'0',
         onClose: function(dateText, inst) {
        var startDateTextBox = $('#datepicker');
        if (startDateTextBox.val() != '') {
            var testStartDate = new Date(startDateTextBox.val());
            var testEndDate = new Date(dateText);
            if (testStartDate > testEndDate)
                startDateTextBox.val(dateText);
        }
        
    },
    onSelect: function (selectedDateTime){
        var end = $(this).datetimepicker('getDate','-1d');
         end.setDate(end.getDate()-1);
        $('#datepicker').datetimepicker('option', 'maxDate', new Date(end.getTime() ) );
        
        
    }
    
                              });


 $("#searchfrm").validate({
            submitHandler: function(form) {
              form.submit();
              $('.waitblock').show();
            }
        });
});
</script>
<script type="text/javascript"> 
function confirmdelete() { 
 return confirm("Are you sure you want to delete?");   
} 
</script>
 
<body>
    


