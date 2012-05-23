<?php require("db.php");ob_start(); ?>

<script type="text/javascript" src="jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="jquery-ui-1.7.1.custom.min.js"></script>



<style>
body {font-family: Arial, Helvetica, sans-serif;font-size: 16px;margin-top: 10px;}
ul{margin: 0;}
#contentWrap {width: 700px;margin: 0 auto;height: auto;overflow: hidden;}
#contentTop {width: 600px;padding: 10px;margin-left: 30px;}
#contentLeft {float: left;width: 400px;}
#contentLeft li {list-style: none;margin: 0 0 4px 0;padding: 10px;background-color:#00CCCC;border: #CCCCCC solid 1px;color:#fff;}
#contentRight {float: right;width: 260px;padding:10px;background-color:#336600;color:#FFFFFF;}
</style>


<script type="text/javascript">
$(document).ready(function(){ 
						   
	$(function() {
		$("#contentLeft ul").sortable({ opacity: 0.6, cursor: 'move', update: function() {
			var order = $(this).sortable("serialize") + '&action=updateRecordsListings'; 
			$.post("updateDB.php", order, function(theResponse){
				$("#contentRight").html(theResponse);
			}); 															 
		}								  
		});
	});

});	
</script>



	<div id="contentWrap">

		<!--<div id="contentTop">
		  <p>To read more &amp; download the demo files:		    <a href="http://www.webresourcesdepot.com/dynamic-dragn-drop-with-jquery-and-php">Dynamic Drag’n Drop With jQuery And PHP</a><br />
		  </p>
		  <p>Drag'n drop the items below. Their new positions are updated in the database with an Ajax request in the backend.<img src="arrow-down.png" alt="Arrow Down" width="32" height="32" /></p>
	  </div>-->
	
		<div id="contentLeft">
			<ul>
				<?php
				$query  = "SELECT * FROM records ORDER BY recordListingID ASC";
				$result = mysql_query($query);
				
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
				?>
					<li id="recordsArray_<?php echo $row['recordID']; ?>"><?php echo $row['recordID'] . ". " . $row['recordText']; ?></li>
				<?php } ?>
			</ul>
		</div>
		
		<div id="contentRight">
		  <p>Array will be displayed here.</p>
		  <p>&nbsp; </p>
		</div>
	
	</div>


