<?php
			print <<<LoginForm
			<div id="container" style="min-height:340px;">
					<div class="search-background" style="width:1000px;height:100px;">
						<label><img src="images/loading_ani.gif" alt="" /></label>
					</div>
					
			<div id="content">
				<div class="create_project" style="float:left;margin-top: 22px;">
					  <div class="desc" style="width:auto;">
					  <div class="form_bg" style="width:auto;margin-top:10px;">
						
							<strong><font color='skyblue'>View Your Status</font></strong>
							<table style="width:1000px;height:auto;padding:0px 10px 0px 0px;" id="ajaxHtml" class="tablesorter">
							<thead>
								<tr>
									<th class='header' style="width:10px;">Department</th>
									<th class='header'>Project Name</th>
									<th class='header'>Project Type</th>
									<th class='header'>Project Description</th>
									<th class='header'>Odesk Id</th>
									<th class='header'>Client Name</th>
									<th class='header'>Company Name</th>
									<th class='header'>Hour Billed</th>
									
									<th class='header'>Working Hour</th>
									<th class='header'>Others Hour</th>
									<th class='header'>Created At</th>
								</tr>
							</thead>
							<tbody>		
LoginForm;
								$dept=  $_SESSION["department"];
								foreach($StatusReport->userAllStatus as $val){
									$title=strip_tags($val->project_description);
									   
									$val->project_description=substr($val->project_description,0,10);
									print <<<LoginForm
									<tr>
										<td align='center'>$dept</td>
										<td align='center'>$val->project_name</td>
										<td align='center'>$val->project_type</td>
										<td align='center' onmouseover="this.style.cursor='pointer'" title='$title'>$val->project_description ...</td>
										<td align='center'>$val->odesk_id</td>
										<td align='center'>$val->client_name</td>
										<td align='center'>$val->company_name</td>
										<td align='center'>$val->hour_billed</td>
										
										<td align='center'>$val->working_hour</td>
										<td align='center'>$val->free_hour</td>
										<td align='center'>$val->created_at</td>
									</tr>
LoginForm;
								}
?>	
							</tbody>
							</table>
					  </div>
					  </div>
				</div>
			</div>
				</div>
				<div id="paging_button">
					<ul>
					<?php
					//Show page links
					for($i=1; $i<=$StatusReport->numOfPages; $i++){
						echo '<li id="'.$i.'">'.$i.'</li>';
					}?>
					</ul>
				</div>	
	
