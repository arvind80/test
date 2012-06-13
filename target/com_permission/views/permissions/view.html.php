<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');
class PermissionViewPermissions extends JView{
    function display($tpl = null){
    		$model = &$this->getModel('Permissions');
    		if(JRequest::getVar(deleteRecord)==1){
    			$model->deletePermission();
    		}
    		if(JRequest::getVar(saveRecord)==1){
    			  if(isset($_POST['edit_id']) && $_POST['edit_id']!=''){
    			  	$model->updatePermission();
    			  }else{
	    		  	$model->savePermission();
	    		  	header("Location:index.php?option=com_permission&view=permissions&controller=permissions&savemsg=1");
    			  }
	    	}
	    	if(JRequest::getVar(newRecord)==1){
	    		 $this->assignRef( 'newRecord',	JRequest::getVar(newRecord) );
	    	}else{
		    	if(JRequest::getVar(searchRecord)==1){
	    			$permission =$model->find();
	    			$totalPages=array_pop($permission);
		        	$this->assignRef( 'totalPages',$totalPages['totalPages']);
	    			$this->assignRef( 'permission',	$permission );
	    			$this->assignRef( 'searchterm',	$_REQUEST['search'] );
	    			
	    		}else{
		        	$permission = $model->getPermissions(JRequest::getVar(id));
		        	$totalPages=array_pop($permission);
		        	$this->assignRef( 'permission',	$permission );
		        	$this->assignRef( 'totalPages',$totalPages['totalPages']);
		        	
	    		}
	    	}
	    	parent::display($tpl);
    }
}