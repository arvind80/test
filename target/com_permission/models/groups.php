<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.model' );

class PermissionModelGroups extends JModel{
    
	function getGroups($id=null){
           $db =& JFactory::getDBO();
		   $query = 'SELECT * FROM tcl_group';
		   $db->setQuery( $query );
		   $group = $db->loadRowList();
		   if($id!=''){
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
			   $query = "insert into tcl_group(name,isActive,created_at)values('".$_POST['name']."','".$_POST['isActive']."',now())";
			   $db->setQuery( $query );
			   $db->query();	   
	 }
	 
	function updateGroup(){
	           $db =& JFactory::getDBO();
			   $query = "update tcl_group set name='".$_POST['name']."',isActive='".$_POST['isActive']."' where id='".$_POST['edit_id']."'";
			   $db->setQuery( $query );
			   $db->query();
			   
	 }
	 
function deleteGroup(){
		   $db =& JFactory::getDBO();
		   if(isset($_GET['delete_id']) && $_GET['delete_id']!=''){
				$query = "delete from tcl_group where id='".$_GET['delete_id']."'";
		   }else{
				   $delete=array();
				   
				   if(!empty($_POST)){
						foreach($_POST['selsts'] as $val){
							$delete[]=$val;
						}
						$delete=implode(',',$delete);
						
						 $query = "delete from tcl_group where id in($delete)";
					}
			}
		   $db->setQuery( $query );
		   $db->query();
	 }
	 
	 function find(){
			   $db =& JFactory::getDBO();
			   $query = "SELECT * FROM   tcl_group where name like '%".$_REQUEST['search']."%'";
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