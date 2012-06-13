<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');
class PermissionViewGroups extends JView{
    function display($tpl = null){
    		$model = &$this->getModel('Groups');
    		
    		if(JRequest::getVar(deleteRecord)==1){
    			$model->deleteGroup();
    		}
    		
    		if(JRequest::getVar(saveRecord)==1){
    			  if(isset($_POST['edit_id']) && $_POST['edit_id']!=''){
    			  	$model->updateGroup();
    			  }else{
	    		  	$model->saveGroup();
	    		  	header("Location:index.php?option=com_permission&view=groups&controller=groups&savemsg=1");
    			  }
	    	}
	    	
	    	if(JRequest::getVar(newRecord)==1){
	    		 $this->assignRef( 'newRecord',	JRequest::getVar(newRecord) );
	    	}else{
		    	if(JRequest::getVar(searchRecord)==1){
	    			$group =$model->find();
	    			$totalPages=array_pop($group);
		        	$this->assignRef( 'totalPages',$totalPages['totalPages']);
	    			$this->assignRef( 'group',	$group );
	    			$this->assignRef( 'searchterm',	$_REQUEST['search'] );
	    			
	    		}else{
		        	$group = $model->getGroups(JRequest::getVar(id));
		        	$totalPages=array_pop($group);
		        	$this->assignRef( 'group',	$group );
		        	$this->assignRef( 'totalPages',$totalPages['totalPages']);
		        	
	    		}
	    	}
	    	
	    	parent::display($tpl);
    }
}