<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.model' );

class PermissionModelGroups extends JModel{
    
	function getGroups($id=null){
           $db =& JFactory::getDBO();
		   $query = 'SELECT tlc_group.* ,count(tlc_users_groups_links.user_id) FROM tlc_group  lEFT join tlc_users_groups_links on tlc_group.id=tlc_users_groups_links.group_id GROUP BY tlc_group.id';
		   $db->setQuery( $query );
		   $group = $db->loadRowList();
		   if($id!=''){
				$query="select * from tlc_group ";
		   		$query.=" where id=".$id;
		   		$db->setQuery( $query );
		    	$group = $db->loadRowList();
		   }
			   	$page_rows = 4;
			    $pagenum=isset($_GET['pagenum']) && $_GET['pagenum']!='' ?$_GET['pagenum']:1;
			    $totalPages=array('totalPages'=>ceil(count($group)/$page_rows));
			    if ($pagenum < 1){ 
	 				$pagenum = 1; 
	 			} 
				elseif ($pagenum > $totalPages) { 
				 	$pagenum = $totalPages; 
				} 
				if(isset($_GET['orderby']) && $_GET['orderby']!=''){
					$orderby=$_GET['orderby'];
					$query.=' order by '.$orderby;
				}
				 $query.='  limit ' .($pagenum - 1) * $page_rows .',' .$page_rows;
				$db->setQuery( $query );
		    	$group = $db->loadRowList();
		    	array_push($group,$totalPages);
		   	//code to set the total number of pages.
		   	return $group;
    }
    
	function saveGroup(){
	           $db =& JFactory::getDBO();
			   $query = "insert into tlc_group(name,isActive,created_at)values('".$_POST['name']."','".$_POST['isActive']."',now())";
			   $db->setQuery( $query );
			   $db->query();	   
			   $groupId= $db->insertid();
			   
			   if($groupId!=''){
				
				   if(isset($_POST['users']) && !empty($_POST['users'])){
				   //insert in to  tlc_users_groups_links
						$insertUsersGoups="insert into tlc_users_groups_links(user_id,group_id)values";
						$countUsers=count($_POST['users']);
						$incrementer=1;
						
						foreach($_POST['users'] as $val){
							if($incrementer==$countUsers){
								$insertUsersGoups.="($val,$groupId)";
							}else{
								$insertUsersGoups.="($val,$groupId),";
							}
							$incrementer++;
						}
						
						$db->setQuery( $insertUsersGoups );
						$db->query();
				   }
				   
				   if(isset($_POST['permissions']) && !empty($_POST['permissions'])){
				   //insert in to  tlc_users_permissions_links
						$insertUsersPermissions="insert into  tlc_group_permission_links(permission_id,group_id)values";
						$countPermissions=count($_POST['permissions']);
						$incrementer=1;
						foreach($_POST['permissions'] as $val){
							if($incrementer==$countPermissions){
								$insertUsersPermissions.="($val,$groupId)";
							}else{
								$insertUsersPermissions.="($val,$groupId),";
							}
							$incrementer++;	
						}
						$db->setQuery( $insertUsersPermissions );
						$db->query();
				   }
				   return 1;
			   }else{
					return 0;
			   }
	 }
	 
	function updateGroup(){
	           $db =& JFactory::getDBO();
			   //code to check if group name exists or not.
			   $query = "select name from  tlc_group where name='".$_POST['name']."' and id !='".$_POST['edit_id']."'";
			   $db->setQuery( $query );
			   $db->query();	 
			   $groupstocheck = $db->loadRowList();
			  
			if(in_array($_POST['name'],$groupstocheck[0])!=1){
			   $query = "update tlc_group set name='".$_POST['name']."',isActive='".$_POST['isActive']."' where id='".$_POST['edit_id']."'";
			   $obj=  $db->setQuery( $query );
			   $db->query();	
			if($_POST['edit_id']!=''){
				$groupId=$_POST['edit_id'];
			   if(isset($_POST['users']) && !empty($_POST['users'])){
				   //insert in to  tlc_users_groups_links
						$insertUsersGoups="insert into tlc_users_groups_links(user_id,group_id)values";
						$countUsers=count($_POST['users']);
						$incrementer=1;
						
						foreach($_POST['users'] as $val){
							if($incrementer==$countUsers){
								$insertUsersGoups.="($val,$groupId)";
							}else{
								$insertUsersGoups.="($val,$groupId),";
							}
							$incrementer++;
						}
						//truncate the table before saving data.
					    $deleteQuery="delete from   tlc_users_groups_links where group_id=".$_POST['edit_id'];
						
						$db->setQuery( $deleteQuery);
						$db->query();
						
						$db->setQuery( $insertUsersGoups );
						$db->query();
				   }else{
						
							$deleteQuery="delete from   tlc_users_groups_links where group_id=".$_POST['edit_id'];
							
							$db->setQuery( $deleteQuery);
							$db->query();
						
				   }
				   
				   if(isset($_POST['permissions']) && !empty($_POST['permissions'])){
				   //insert in to  tlc_users_permissions_links
						$insertUsersPermissions="insert into  tlc_group_permission_links(permission_id,group_id)values";
						$countPermissions=count($_POST['permissions']);
						$incrementer=1;
						foreach($_POST['permissions'] as $val){
							if($incrementer==$countPermissions){
								$insertUsersPermissions.="($val,$groupId)";
							}else{
								$insertUsersPermissions.="($val,$groupId),";
							}
							$incrementer++;	
						}
						//truncate the table.
						$db->setQuery( "delete from  tlc_group_permission_links where group_id=".$_POST['edit_id']);
						$db->query();
						
						$db->setQuery( $insertUsersPermissions );
						$db->query();
				   }else{
						//truncate the table  .
						
							$db->setQuery( "delete from  tlc_group_permission_links where group_id=".$_POST['edit_id']);
							$db->query();
						
					
				   }
				   return 1;
			}
			}else{
				return 0;
			}
			
	 }
	 
function deleteGroup(){
		   $db =& JFactory::getDBO();
		   if(isset($_GET['delete_id']) && $_GET['delete_id']!=''){
				$query = "delete from tlc_group where id='".$_GET['delete_id']."'";
				
				
		   }else{
				   $delete=array();
				   
				   if(!empty($_POST)){
						foreach($_POST['selsts'] as $val){
							$delete[]=$val;
						}
						$delete=implode(',',$delete);
						
						 $query = "delete from tlc_group where id in($delete)";
					}
			}
			//before deleting delete the record from 
		   $db->setQuery( "delete from  tlc_group_permission_links where group_id=".$_GET['delete_id']);
		   $db->query();		
		   $db->setQuery( "delete from   tlc_users_groups_links where group_id=".$_GET['delete_id']);
		   $db->query();			
		   $db->setQuery( $query );
		   $db->query();
	 }
	  function fetchUsers($groupId=null){
		   $db =& JFactory::getDBO();
		   $query = 'SELECT * FROM  wlycz_users ';
		   if($groupId!=''){
				$query.="inner join  tlc_users_groups_links on  tlc_users_groups_links.user_id= wlycz_users.id where tlc_users_groups_links.group_id=$groupId";
		   }
		   $db->setQuery( $query );
		   return $db->loadRowList();
	 }
	 
	 function fetchUsersBelongToGroup($groupId=null){
		   $db =& JFactory::getDBO();
		   $query = 'SELECT user_id FROM  tlc_users_groups_links';
		   if($groupId!=''){
				$query.=" where group_id=$groupId";
		   }
		   $db->setQuery( $query );
		   return $db->loadRowList();
	 }
	 function fetchPermissionsBelongToGroup($groupId=null){
		   $db =& JFactory::getDBO();
		   $query = 'SELECT permission_id FROM  tlc_group_permission_links';
		   if($groupId!=''){
				$query.=" where group_id=$groupId";
		   }
		   $db->setQuery( $query );
		   return $db->loadRowList();
	 }
	 function fetchPermissions(){
		   $db =& JFactory::getDBO();
		   $query = 'SELECT * FROM  tlc_permission where isActive=1';
		   $db->setQuery( $query );
		   return $db->loadRowList();
	 }
	 function find(){
			   $db =& JFactory::getDBO();
			    $query = "SELECT tlc_group.* ,count(tlc_users_groups_links.user_id) FROM tlc_group  lEFT join tlc_users_groups_links
			   on tlc_group.id=tlc_users_groups_links.group_id where name like '%".$_REQUEST['search']."%' 
			    GROUP BY tlc_group.id ";
			 $db->setQuery( $query );
			   $group = $db->loadRowList();
			   
			   $page_rows = 4;
			   $pagenum=isset($_GET['pagenum']) && $_GET['pagenum']!='' ?$_GET['pagenum']:1;
			   $totalPages=array('totalPages'=>ceil(count($group)/$page_rows));
			   if ($pagenum < 1){ 
			 		$pagenum = 1; 
			 	} 
				elseif ($pagenum > $totalPages) { 
			 		$pagenum = $totalPages; 
				} 
				$query.=' order by id desc limit ' .($pagenum - 1) * $page_rows .',' .$page_rows; 
				$db->setQuery( $query );
			    $group = $db->loadRowList();
			    array_push($group,$totalPages);
			    //code to set the total number of pages.
			    return $group;
	 }
}