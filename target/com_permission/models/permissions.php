<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.model' );

class PermissionModelPermissions extends JModel{
    
	function getPermissions($id=null){
           $db =& JFactory::getDBO();
		   $query = 'SELECT * FROM tlc_permission';
		   $db->setQuery( $query );
		   $permission = $db->loadRowList();
		   if($id!=''){
		   		$query.=" where id=".$id;
		   		$db->setQuery( $query );
		    	$permission = $db->loadRowList();
		   }
			   	$page_rows = 4;
			    $pagenum=isset($_GET['pagenum']) && $_GET['pagenum']!='' ?$_GET['pagenum']:1;
			    $totalPages=array('totalPages'=>ceil(count($permission)/$page_rows));
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
		    	$permission = $db->loadRowList();
		    	array_push($permission,$totalPages);
		   	//code to set the total number of pages.
		   	return $permission;
    }
    
	function savePermission(){
	           $db =& JFactory::getDBO();
			   $query = "insert into tlc_permission(name,isActive,created_at)values('".$_POST['name']."','".$_POST['isActive']."',now())";
			   $db->setQuery( $query );
			   $db->query();
			   $permissionId= $db->insertid();
			   if($permissionId==''){
					return 0;
			   }else{
					return 1;
			   }
	 }
	 
	function updatePermission(){
	           $db =& JFactory::getDBO();
			   //code to check if group name exists or not.
			   $query = "select name from   tlc_permission where name='".$_POST['name']."' and id !='".$_POST['edit_id']."'";
			   $db->setQuery( $query );
			   $db->query();	 
			   $pemissionstocheck = $db->loadRowList();
			  
			if(in_array($_POST['name'],$pemissionstocheck[0])!=1){
			   $query = "update tlc_permission set name='".$_POST['name']."',isActive='".$_POST['isActive']."' where id='".$_POST['edit_id']."'";
			   $db->setQuery( $query );
			   $db->query();
			   return 1;
			}else{
				return 0;
			}
			   
	 }
	 
	function deletePermission(){
		   $db =& JFactory::getDBO();
		   if(isset($_GET['delete_id']) && $_GET['delete_id']!=''){
				$query = "delete from tlc_permission where id='".$_GET['delete_id']."'";
		   }else{
				   $delete=array();
				   
				   if(!empty($_POST)){
						foreach($_POST['selsts'] as $val){
							$delete[]=$val;
						}
						$delete=implode(',',$delete);
						
						 $query = "delete from tlc_permission where id in($delete)";
					}
			}
			
		//before deleting delete the record from 
		   $db->setQuery( "delete from  tlc_group_permission_links where permission_id=".$_GET['delete_id']);
		   $db->query();		
		   $db->setQuery( "delete from   tlc_user_permission_links where permission_id=".$_GET['delete_id']);
		   $db->query();	
			
		   $db->setQuery( $query );
		   $db->query();
	 }
	 
	 function find(){
			   $db =& JFactory::getDBO();
			   $query = "SELECT * FROM   tlc_permission where name like '%".$_REQUEST['search']."%'";
			   $db->setQuery( $query );
			   $permission = $db->loadRowList();
			   
			   $page_rows = 4;
			   $pagenum=isset($_GET['pagenum']) && $_GET['pagenum']!='' ?$_GET['pagenum']:1;
			   $totalPages=array('totalPages'=>ceil(count($permission)/$page_rows));
			   if ($pagenum < 1){ 
			 		$pagenum = 1; 
			 	} 
				elseif ($pagenum > $totalPages) { 
			 		$pagenum = $totalPages; 
				} 
				$query.=' order by id desc limit ' .($pagenum - 1) * $page_rows .',' .$page_rows; 
				$db->setQuery( $query );
			    $permission = $db->loadRowList();
			    array_push($permission,$totalPages);
			    //code to set the total number of pages.
			    return $permission;
	 }
}