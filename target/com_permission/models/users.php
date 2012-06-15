<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.model' );

class PermissionModelUsers extends JModel{
    
	function getUsers($id=null){
           $db =& JFactory::getDBO();
		   $query = 'SELECT * FROM  wlycz_users ';
		   $db->setQuery( $query );
		   $user = $db->loadRowList();
		   if($id!=''){
		   		$query.=" where id=".$id;
		   		$db->setQuery( $query );
		    	$user = $db->loadRowList();
		   }
			   	$page_rows = 4;
			    $pagenum=isset($_GET['pagenum']) && $_GET['pagenum']!='' ?$_GET['pagenum']:1;
			    $totalPages=array('totalPages'=>ceil(count($user)/$page_rows));
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
		    	$user = $db->loadRowList();
		    	array_push($user,$totalPages);
		   	//code to set the total number of pages.
		   	return $user;
    }
    
	
	function updateUser(){
		   $db =& JFactory::getDBO();
		   if($_POST['edit_id']!=''){
				$userId=$_POST['edit_id'];
			   if(isset($_POST['groups']) && !empty($_POST['groups'])){
				   //insert in to  tlc_users_groups_links
						$insertUsersGoups="insert into  tlc_users_groups_links(user_id,group_id)values";
						$countUsers=count($_POST['groups']);
						$incrementer=1;
						
						foreach($_POST['groups'] as $val){
							if($incrementer==$countUsers){
								$insertUsersGoups.="($userId,$val)";
							}else{
								$insertUsersGoups.="($userId,$val),";
							}
							$incrementer++;
						}
						//truncate the table before saving data.
					    $deleteQuery="delete from   tlc_users_groups_links where user_id=".$_POST['edit_id'];
						
						$db->setQuery( $deleteQuery);
						$db->query();
						
						$db->setQuery( $insertUsersGoups );
						$db->query();
				   }else{
						
							$deleteQuery="delete from   tlc_users_groups_links where user_id='".$_POST['edit_id']."'";
							
							$db->setQuery( $deleteQuery);
							$db->query();
						
 				   }
				   
				   if(isset($_POST['permissions']) && !empty($_POST['permissions'])){
				   //insert in to  tlc_users_permissions_links
						$insertUsersPermissions="insert into   tlc_user_permission_links(user_id,permission_id)values";
						$countPermissions=count($_POST['permissions']);
						$incrementer=1;
						foreach($_POST['permissions'] as $val){
							if($incrementer==$countPermissions){
								$insertUsersPermissions.="($userId,$val)";
							}else{
								$insertUsersPermissions.="($userId,$val),";
							}
							$incrementer++;	
						}
						//truncate the table.
						$db->setQuery( "delete from  tlc_user_permission_links where user_id=".$_POST['edit_id']);
						$db->query();
						
						$db->setQuery( $insertUsersPermissions );
						$db->query();
				   }else{
						//truncate the table  .
						
							$db->setQuery( "delete from  tlc_user_permission_links where user_id=".$_POST['edit_id']);
							$db->query();
						
					
				   }
				   return 1;
			}
	 }
	
	function deleteUser(){
		   $db =& JFactory::getDBO();
		   if(isset($_GET['delete_id']) && $_GET['delete_id']!=''){
				$query = "delete from  wlycz_users where id='".$_GET['delete_id']."'";
		   }else{
				   $delete=array();
				   
				   if(!empty($_POST)){
						foreach($_POST['selsts'] as $val){
							$delete[]=$val;
						}
						$delete=implode(',',$delete);
						
						 $query = "delete from  wlycz_users where id in($delete)";
					}
			}
			
			//before deleting delete the record from these tables also.
		   $db->setQuery( "delete from  tlc_user_permission_links where user_id=".$_GET['delete_id']);
		   $db->query();		
		   $db->setQuery( "delete from   tlc_users_groups_links where user_id=".$_GET['delete_id']);
		   $db->query();	
		   $db->setQuery( $query );
		   $db->query();
	 }
	 
	 function find(){
			   $db =& JFactory::getDBO();
			   $query = "SELECT * FROM    wlycz_users where name like '%".$_REQUEST['search']."%'";
			   $db->setQuery( $query );
			   $user = $db->loadRowList();
			   
			   $page_rows = 4;
			   $pagenum=isset($_GET['pagenum']) && $_GET['pagenum']!='' ?$_GET['pagenum']:1;
			   $totalPages=array('totalPages'=>ceil(count($user)/$page_rows));
			   if ($pagenum < 1){ 
			 		$pagenum = 1; 
			 	} 
				elseif ($pagenum > $totalPages) { 
			 		$pagenum = $totalPages; 
				} 
				$query.=' order by id desc limit ' .($pagenum - 1) * $page_rows .',' .$page_rows; 
				$db->setQuery( $query );
			    $user = $db->loadRowList();
			    array_push($user,$totalPages);
			    //code to set the total number of pages.
			    return $user;
	 }
	 
	 function fetchGroupsBelongsToUser($userId=null){
		$db =& JFactory::getDBO();
		   $query = "SELECT distinct(group_id) FROM   tlc_users_groups_links where user_id='".$userId."'";
		   
		   $db->setQuery( $query );
		   return $db->loadRowList();
	 }
	 
	 function fetchPermissionsBelongsToUser($userId=null){
		$db =& JFactory::getDBO();
		   $query = "SELECT distinct(permission_id) FROM    tlc_user_permission_links where user_id='".$userId."'";
		   
		   $db->setQuery( $query );
		   return $db->loadRowList();
	 }
	 
	function fetchGroups(){
		   $db =& JFactory::getDBO();
		    $query = 'SELECT * FROM  tlc_group where isActive=1';
		   $db->setQuery( $query );
		   return $db->loadRowList();
	 }
	 
	 function fetchPermissions(){
		   $db =& JFactory::getDBO();
		   $query = 'SELECT * FROM  tlc_permission where isActive=1';
		   $db->setQuery( $query );
		   return $db->loadRowList();
	 }
}