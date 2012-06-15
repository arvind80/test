<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');
class PermissionViewUsers extends JView{
    function display($tpl = null){
    		$model = &$this->getModel('Users');
    		
    		if(JRequest::getVar(deleteRecord)==1){
    			$model->deleteUser();
    		}
    		
    		if(JRequest::getVar(saveRecord)==1){
    			  if(isset($_POST['edit_id']) && $_POST['edit_id']!=''){
    			  	$result=$model->updateUser();
						if($result==0){
						$success=0;
						header("Location:index.php?option=com_permission&view=edit&controller=users&id=".$_POST['edit_id']."&editRecord=1&result=".$success);
						}else{
							$success=1;
							header("Location:index.php?option=com_permission&view=users&controller=users&savemsg=1&result=update");
						}
    			  }
	    	}
	    	
	    	if(JRequest::getVar(editRecord)==1){
				    $user = $model->getUsers(JRequest::getVar(id));
					$this->assignRef( 'user',	$user );
					//code to fetch all the groups.
					$groups=$model->fetchGroups();
					$this->assignRef( 'groups',	$groups );
					//code to fetch all the permissions
					$permissions=$model->fetchPermissions();
					
					$this->assignRef( 'permissions',	$permissions );
					//fetch the groups belongs to user.
					$usergroups=$model->fetchGroupsBelongsToUser(JRequest::getVar(id));
					$this->assignRef( 'usergroups',	$usergroups );
					//fetch the permissions belongs to user
					$userpermissions=$model->fetchPermissionsBelongsToUser(JRequest::getVar(id));
					$this->assignRef( 'userpermissions',	$userpermissions );

	    	}else{
		    	if(JRequest::getVar(searchRecord)==1){
	    			$user =$model->find();
	    			$totalPages=array_pop($user);
		        	$this->assignRef( 'totalPages',$totalPages['totalPages']);
	    			$this->assignRef( 'user',	$user );
	    			$this->assignRef( 'searchterm',	$_REQUEST['search'] );
	    			
	    		}else{
		        	$user = $model->getUsers(JRequest::getVar(id));
					
		        	$totalPages=array_pop($user);
		        	$this->assignRef( 'user',	$user );
		        	$this->assignRef( 'totalPages',$totalPages['totalPages']);
		        	
	    		}
	    	}
	    	
	    	parent::display($tpl);
    }
}