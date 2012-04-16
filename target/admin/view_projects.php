<?php if(isset($_GET['action_view']) && $_GET['action_view']=='view_projects' && (isset($_GET['success'])&& $_GET['success']==true ||isset($_GET['failure']) && $_GET['failure']==true)){
					echo $_GET['failure']==true?"There is some problem in saving the project.Please try again!":"Project successfully saved!";
	   } ?>
<?php
			print <<<LoginForm
			<div id="container" style="min-height:340px;">
			<div id="content">
				<div class="create_project" style="float:left;margin-top: 22px;">
					  <div class="desc" style="width:auto;">
					  <div class="form_bg" style="width:auto;margin-top:10px;">
							<strong><font color='skyblue'>Projects</font></strong>
							<table style="width:1000px;height:auto;padding:0px 10px 0px 0px;" id="ajaxHtml" class="tablesorter">
							<thead>
								<tr>
									<th class='header' style="width:20px;">Department</th>
									<th class='header'>Project Name</th>
									<th class='header'>Project Type</th>
									<th class='header'>Project Description</th>
									<th class='header'>Odesk Id</th>
									<th class='header'>Client Name</th>
									<th class='header'>Company Name</th>
									<th class='header'>Total hours</th>
									<th class='header'>Status</th>
									<th class='header'>Company Name</th>
									<th class='header'>Start Date</th>
									<th class='header'>End Date</th>
									<th class='header'>Created At</th>
									<th class='header'>Action</th>
								</tr>
							</thead>
							<tbody>		
LoginForm;
								foreach($Projects->getProjects() as $val){ 
									if($val->id!=''){
										$val->project_description=substr($val->project_description,0,10);
										$deptName=$StatusReport->getDepartmentNameById($val->dept_id);
										print <<<LoginForm
										<tr>
											<td align='center'>$deptName</td>
											<td align='center'>$val->project_name</td>
											<td align='center'>$val->project_type</td>
											<td align='center' onmouseover="this.style.cursor='pointer'" title=''>$val->project_description ...</td>
											<td align='center'>$val->odesk_id</td>
											<td align='center'>$val->client_name</td>
											<td align='center'>$val->company_name</td>
											<td align='center'>$val->total_hours</td>
											<td align='center'>$val->status</td>
											<td align='center'>$val->start_date</td>
											<td align='center'>$val->end_date</td>
											<td align='center'>$val->status</td>
											<td align='center'>$val->created_at</td>
											<td align='center'><a href="?action_view=add_new_project&action=edit&id=$val->id#tabs-7">Edit</a></td>
										</tr>
LoginForm;
									}else{
										echo "<tr><td>Currently no projects exists in the database!</td></tr>";
										}
								}
?>	
							</tbody>
							</table>
							<div id="paging_button" style="font-size:9px;width:300px;">
					<ul>
					<?php
					$range=0;
					if($Projects->currentPage > 1){
					   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=1&action_view=view_projects#tabs-7'>First</a> ";
					   $prevpage = $Projects->currentPage - 1;
					   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage&action_view=view_projects#tabs-7'>Prev</a> ";
					}
					for($x = ($Projects->currentPage - $range); $x < (($Projects->currentPage + $range) + 1); $x++){
					   if(($x > 0) && ($x <= $Projects->numOfPages)){
						  if ($x == $Projects->currentPage){
							 echo " <b>$x</b> ";
						  }else{
							 
							 echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$x&action_view=view_projects#tabs-7'>$x</a> ";
						  }
					   }
					}      
					if($Projects->currentPage != $Projects->numOfPages){
					   $nextpage = $Projects->currentPage + 1;
					   echo " <a style='width:auto;' href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage&action_view=view_projects#tabs-7'>Next</a>";
					   echo " <a style='width:auto;' href='{$_SERVER['PHP_SELF']}?currentpage=$Projects->numOfPages&action_view=view_projects#tabs-7'>Last</a> ";
					}
					?>
					</ul>
				</div>	
					  </div>
					  </div>
				</div>
			</div>
				</div>
<!--Code For Search Result-->
<table style="width:1000px;height:auto;padding:0px 10px 0px 0px;" id="ajaxHtml1" class="tablesorter">
							
<?php
	if($_SESSION['search_result']!=''){
		if($_SESSION['search_result'][0]->id!=''){
			echo "<thead>
								<tr><th class='header' style='width:20px;'>Department</th>
									<th class='header'>Project Name</th>
									<th class='header'>Project Type</th>
									<th class='header'>Project Description</th>
									<th class='header'>Odesk Id</th>
									<th class='header'>Client Name</th>
									<th class='header'>Company Name</th>
									<th class='header'>Total hours</th>
									<th class='header'>Status</th>
									<th class='header'>Company Name</th>
									<th class='header'>Start Date</th>
									<th class='header'>End Date</th>
									<th class='header'>Created At</th>
									<th class='header'>Action</th></thead><tbody>";
			foreach($_SESSION['search_result'] as $val){ 
				$val->project_description=substr($val->project_description,0,10);
									$deptName=$StatusReport->getDepartmentNameById($val->dept_id);
									echo"
									<tr>
										<td align='center'>$deptName</td>
										<td align='center'>$val->project_name</td>
										<td align='center'>$val->project_type</td>
										<td align='center' onmouseover=\"this.style.cursor='pointer'\" title=''>$val->project_description ...</td>
										<td align='center'>$val->odesk_id</td>
										<td align='center'>$val->client_name</td>
										<td align='center'>$val->company_name</td>
										<td align='center'>$val->total_hours</td>
										<td align='center'>$val->status</td>
										<td align='center'>$val->start_date</td>
										<td align='center'>$val->end_date</td>
										<td align='center'>$val->status</td>
										<td align='center'>$val->created_at</td>
										<td align='center'><a href=\"?action_view=add_new_project&action=edit&id=$val->id#tabs-7\">Edit</a></td>
									</tr>";
			}
			echo"</tbody>";
		}else{
				if(isset($_GET['search'])&& $_GET['search']!='false'){
				echo"Search criteria does not match any results!";}
				else if(isset($_GET['search'])&& $_GET['search']=='false' ){
					echo"There is some problem in getting the results please try again!";
				}
			}
	}
?>	
						</tbody>
						</table>	
