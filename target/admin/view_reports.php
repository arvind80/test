<div id="tabs-1" style="min-height:250px;margin-top:50px;">
		<font color="skyblue">View Reports</font>
		<form name="viewpdf" id ="viewpdf" action="viewpdf.php" method="post">
			<table class='tablesorter'><tr><td>
			<label>View By Date</label>
			<input type="text"  name="view_by_date" readonly id="view_by_date"/>
			<span>
			<select name="dept" id="dept" class="required">
				<option value="">Select Department</option>
				<?php foreach($StatusReport->getDepartmentList($fetchDepartmentById) as $dept){
						if($dept->id!=''){
							
							echo "<option value='$dept->id'>".ucwords($dept->dept_name)."</option>";
						}
					}
				if($_SESSION['type']=='admin'){
					echo'<option value="all">View All</option>';
				}
				?>
			</select><font color="#FF0000">*</font></span>
			<input type="submit" value="Get Pdf"/>
		</td></tr></table>
		</form>
		<font color="skyblue">View reports in the Period</font>
		<form name="viewodeskpdf" id ="viewodeskpdf" action="viewodeskpdf.php" method="post">
			<table class='tablesorter'><tr><td>
			<label>Start Date</label>
			<input type="text" class="required"  name="start_date_odesk" readonly id="start_date_odesk"/>
			
			<label>End Date</label>
			<input type="text" class="required" name="end_date_odesk" readonly id="end_date_odesk"/>
			<script>
			$("#start_date_odesk").datepicker({showAnim:"clip",altFormat: 'yy-mm-dd',dateFormat:'yy-mm-dd', changeYear: true,changeMonth: true ,yearRange: '1900',showWeek: true});
			$("#end_date_odesk").datepicker({showAnim:"clip",altFormat: 'yy-mm-dd',dateFormat:'yy-mm-dd', changeYear: true,changeMonth: true ,yearRange: '1900',showWeek: true,onClose:function(){compareDatesReportPeriodform();}});
			</script>
			<span>
			<select name="dept" id="dept" class="required">
				<option value="">Select Department</option>
				<?php foreach($StatusReport->getDepartmentList($fetchDepartmentById) as $dept){
						if($dept->id!=''){
							echo "<option value='$dept->id'>".ucwords($dept->dept_name)."</option>";
						}
					}
				if($_SESSION['type']=='admin'){
					echo'<option value="all">View All</option>';
				}
				?>
			</select><font color="#FF0000">*</font></span>
			<input type="submit" value="Get Pdf"/>
		</td></tr></table>
		</form>
	</div>
