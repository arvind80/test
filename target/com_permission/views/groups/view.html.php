<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');
class PermissionViewGroups extends JView{
    function display($tpl = null){
    		$model = &$this->getModel('Groups');
    		
    		if(JRequest::getVar(deleteRecord)==1){
    			$model->deleteGroup();
    		}
    		if(JRequest::getVar(viewUser)==1){
    			$users_in_group=$model->fetchUsers(JRequest::getVar(group_id));
				$this->assignRef( 'view_users_in_group',$users_in_group );
    		}
    		if(JRequest::getVar(saveRecord)==1){
    			  if(isset($_POST['edit_id']) && $_POST['edit_id']!=''){
						$result=$model->updateGroup();
						if($result==0){
						$success=0;
						header("Location:index.php?option=com_permission&view=edit&controller=groups&id=".$_POST['edit_id']."&editRecord=1&result=".$success);
						}else{
							$success=1;
							header("Location:index.php?option=com_permission&view=groups&controller=groups&savemsg=1&result=update");
						}
    			  }else{
	    		  	$result=$model->saveGroup();
					if($result==0){
						$success=0;
						header("Location:index.php?option=com_permission&view=add&controller=groups&newRecord=1&result=".$success);
					}else{
						$success=1;
						header("Location:index.php?option=com_permission&view=groups&controller=groups&savemsg=1&result=".$success);
					}
	    		  	
    			  }
	    	}
	    	
	    	if(JRequest::getVar(newRecord)==1){
				 $users=$model->fetchUsers();
				 $permissions=$model->fetchPermissions();
				 $this->assignRef( 'newRecord',	JRequest::getVar(newRecord) );
				 $this->assignRef( 'users',	$users );
				 $this->assignRef( 'permissions',$permissions);
	    	}else{
		    	if(JRequest::getVar(searchRecord)==1){
	    			$group =$model->find();
	    			$totalPages=array_pop($group);
		        	$this->assignRef( 'totalPages',$totalPages['totalPages']);
	    			$this->assignRef( 'group',	$group );
	    			$this->assignRef( 'searchterm',	$_REQUEST['search'] );
	    			
	    		}else{
		        	$group = $model->getGroups(JRequest::getVar(id));
					
					if(JRequest::getVar(id)!=''){
						//fetch users belongs to group and all users.
						$fetchUsersBelongToGroup=$model->fetchUsersBelongToGroup(JRequest::getVar(id));
						$fetchPermissionsBelongToGroup=$model->fetchPermissionsBelongToGroup(JRequest::getVar(id));
						$users=$model->fetchUsers();
						$permissions=$model->fetchPermissions();
						$this->assignRef( 'users',	$users );
						$this->assignRef( 'permissions',$permissions);
						$this->assignRef( 'fetchUsersBelongToGroup',	$fetchUsersBelongToGroup );
						$this->assignRef( 'fetchPermissionsBelongToGroup',$fetchPermissionsBelongToGroup);
						//fetch permission according to group.
					}
		        	$totalPages=array_pop($group);
		        	$this->assignRef( 'group',	$group );
		        	$this->assignRef( 'totalPages',$totalPages['totalPages']);
		        	
	    		}
	    	}
	    	
	    	parent::display($tpl);
    }
}