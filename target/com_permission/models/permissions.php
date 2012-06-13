<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.model' );

class PermissionModelPermissions extends JModel{
    
	function getPermissions($id=null){
           $db =& JFactory::getDBO();
		   $query = 'SELECT * FROM tcl_permission';
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
			   $query = "insert into tcl_permission(name,isActive,created_at)values('".$_POST['name']."','".$_POST['isActive']."',now())";
			   $db->setQuery( $query );
			   $db->query();	   
	 }
	 
	function updatePermission(){
	           $db =& JFactory::getDBO();
			   $query = "update tcl_permission set name='".$_POST['name']."',isActive='".$_POST['isActive']."' where id='".$_POST['edit_id']."'";
			   $db->setQuery( $query );
			   $db->query();
			   
	 }
	 
function deletePermission(){
		   $db =& JFactory::getDBO();
		   if(isset($_GET['delete_id']) && $_GET['delete_id']!=''){
				$query = "delete from tcl_permission where id='".$_GET['delete_id']."'";
		   }else{
				   $delete=array();
				   
				   if(!empty($_POST)){
						foreach($_POST['selsts'] as $val){
							$delete[]=$val;
						}
						$delete=implode(',',$delete);
						
						 $query = "delete from tcl_permission where id in($delete)";
					}
			}
		   $db->setQuery( $query );
		   $db->query();
	 }
	 
	 function find(){
			   $db =& JFactory::getDBO();
			   $query = "SELECT * FROM   tcl_permission where name like '%".$_REQUEST['search']."%'";
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