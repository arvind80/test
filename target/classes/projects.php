<?php 
	require_once("configuration.php");
	class Projects extends Database{
		public $numOfPages;
		public $rowPerPage;
		public $currentPage;
		public $offset;
		public function __construct(){
			parent::__construct();
			$this->rowPerPage=3;
		}
		
		final public function saveProject(){
			$date = date('Y-m-d H:i:s');
			$newtime = strtotime($date . ' + 12 hours 30 minutes');
			$created_at = date('Y-m-d', $newtime);

			$hour= date('H', $newtime);
			$minute= date('i',$newtime);
			$updated_at=date('Y-m-d h:i:s',$newtime);
			if(isset($_SESSION['edit_project_id']) && $_SESSION['edit_project_id']!=''){
			    $saveProject="UPDATE projects set dept_id='".strtolower(mysql_real_escape_string($_POST['department'],$this->openDatabase()))."',
													  project_name='".strtolower(mysql_real_escape_string($_POST['project_name'],$this->openDatabase()))."',
													  project_type=  '".strtolower(mysql_real_escape_string($_POST['project_type'],$this->openDatabase()))."',
													  project_description= '".strtolower(mysql_real_escape_string($_POST['project_description_new'],$this->openDatabase()))."',
													  project_detail='".strtolower(mysql_real_escape_string($_POST['project_detail'],$this->openDatabase()))."',
													  site_url='".strtolower(mysql_real_escape_string($_POST['site_url'],$this->openDatabase()))."',
													  odesk_id='".strtolower(mysql_real_escape_string($_POST['odesk_id'],$this->openDatabase()))."',
													  client_name='".strtolower(mysql_real_escape_string($_POST['client_name'],$this->openDatabase()))."',
													  status='".strtolower(mysql_real_escape_string($_POST['status'],$this->openDatabase()))."',
													  company_name='".strtolower(mysql_real_escape_string($_POST['company_name'],$this->openDatabase()))."',
													  total_hours='".strtolower(mysql_real_escape_string($_POST['total_hours'],$this->openDatabase()))."',
													  start_date='".strtolower(mysql_real_escape_string($_POST['start_date'],$this->openDatabase()))."',
													  end_date= '".strtolower(mysql_real_escape_string($_POST['end_date'],$this->openDatabase()))."',
													  modified_user_id= '".$_SESSION['user_id']."',
													  updated_at= '".$updated_at."'
											  WHERE id='".$_SESSION['edit_project_id']."'";
				}else{$saveProject="INSERT INTO  projects(user_id,
												  dept_id,
												  project_name,
												  project_type,
												  project_description,
												  project_detail,
												  site_url,
												  odesk_id,
												  client_name,
												  company_name,
												  total_hours,
												  start_date,
												  end_date,
												  status,
												  created_at,
												  updated_at)VALUES(
												  '".$_SESSION['user_id']."',
												  '".strtolower(mysql_real_escape_string($_POST['department'],$this->openDatabase()))."',
												  '".strtolower(mysql_real_escape_string($_POST['project_name'],$this->openDatabase()))."',
												  '".strtolower(mysql_real_escape_string($_POST['project_type'],$this->openDatabase()))."',
												  '".strtolower(mysql_real_escape_string($_POST['project_description_new'],$this->openDatabase()))."',
												  '".strtolower(mysql_real_escape_string($_POST['project_detail'],$this->openDatabase()))."',
												  '".strtolower(mysql_real_escape_string($_POST['site_url'],$this->openDatabase()))."',
												  '".strtolower(mysql_real_escape_string($_POST['odesk_id'],$this->openDatabase()))."',
												  '".strtolower(mysql_real_escape_string($_POST['client_name'],$this->openDatabase()))."',
												  '".strtolower(mysql_real_escape_string($_POST['company_name'],$this->openDatabase()))."',
												  '".strtolower(mysql_real_escape_string($_POST['total_hours'],$this->openDatabase()))."',
												  '".strtolower(mysql_real_escape_string($_POST['start_date'],$this->openDatabase()))."',
												  '".strtolower(mysql_real_escape_string($_POST['end_date'],$this->openDatabase()))."',
												  '".strtolower(mysql_real_escape_string($_POST['status'],$this->openDatabase()))."',
												  '".$created_at."',
												  '".$updated_at."'
												  )";
					}
				return $this->execQry($saveProject) or die('error'.mysql_error()) ;	
		}
		
		final public function getProjects($fetchProjectById=null){
				$this->db_query="SELECT * FROM projects ";
				if(isset($fetchProjectById) && $fetchProjectById!=''){
				$this->db_query.=" WHERE id='".$fetchProjectById."'";}
				$this->db_query.=" order by id"; 
				
				//Pagination Code goes here.
			    $this->numOfPages=ceil($this->numRows($this->execQry($this->db_query))/$this->rowPerPage);
		
				if(isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
				   $this->currentPage = (int) $_GET['currentpage'];
				}else{
				   $this->currentPage = 1;
				} 
				
				if ($this->currentPage > $this->numOfPages) {
				   $this->currentPage = $this->numOfPages;
				} 
				if ($this->currentPage < 1) {
				   $this->currentPage = 1;
				}

				$this->offset = ($this->currentPage - 1) * $this->rowPerPage;
					
				//Pagination Code ends here
				
				$this->db_query="SELECT * FROM projects ";
				if(isset($fetchProjectById) && $fetchProjectById!=''){
				$this->db_query.=" WHERE id='".$fetchProjectById."'";}
				$this->db_query.=" order by id desc LIMIT $this->offset,$this->rowPerPage"; 
				return  $this->fetchQuery();
		}
		
		final public function searchProject(){
				$this->table='projects';
				$result = $this->listFields();
				$this->count_fields;
				if ($this->count_fields > 0){
					  $i=0;
					  while ($row = $this->fetchField($result)){
							if($i==0){
								$this->db_query="select * from projects where ".$row->name."='".$_POST['search_project']."'";
							}
							else{
								$this->db_query.=" or ".$row->name."='".mysql_real_escape_string($_POST['search_project'],$this->openDatabase())."'";
							}
							$i++;
						}
				 }
				 if(isset($_SESSION['dept_id']) && $_SESSION['dept_id']!='')
				 $this->db_query.=" AND dept_id='".$_SESSION['dept_id']."'";
				return  $this->fetchQuery();
		}
	}
	
	$Projects=new Projects();
?>
