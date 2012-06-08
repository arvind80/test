<?php 
class admin{
   /* login function */
        function login(){
            $sql='select * from admin where username= "'.$_POST['username'].'"  and 
            password = "'.md5($_POST['password']).'"';
            $execute=mysql_query($sql) or die('error in login admin'.mysql_error());
            
            $row=admin::calculate_rows($execute);
            
            if($row>=1){
            $fetch=admin::fetch_single_row($execute);
            $_SESSION['admin']=$fetch;
            header('location:../admin/welcome.php');
            }else {
				header('location:../admin/index.php?error=1');
            }
        }
   
        function welcome(){
        
        }
        
        function calculate_rows($execute){
			
            $rows= mysql_num_rows($execute);
            return $rows;
            
        }
  
        function fetch_single_row($execute){
			
            $execute= mysql_fetch_array($execute);
            return $execute;
            
        }
        
        function changePassword(){
                $old_pass=$_REQUEST['old_pass'];
                $new_pass=$_REQUEST['new_pass'];
                $confirm_pass=$_REQUEST['confirm_pass'];
                if(isset($old_pass) && $old_pass!=""){
                    $old_pass=md5($old_pass);
                    $sqlpass=mysql_query("select * from admin where password='".$old_pass."'");
                    $count=mysql_num_rows($sqlpass);
                    if($count){
                        $new_pass=md5($new_pass);
                        $update=mysql_query("UPDATE admin set password='".$new_pass."' where password='".$old_pass."'");
                        header('location:../admin/changePassword.php?send=1');
                    }else{
                        $_REQUEST['error']="Passowrd Dose not match form record !!! Please try again";
                    }
                }else{
                    $_REQUEST['error']="Please enter the old password";
                }
        }
        
        
         function updateUser($id){
           $sql='update  users set business_emailaddress = "'.$_POST['business_emailaddress'].'",
                                    company_name = "'.addslashes($_POST['store_name']).'",
                                    group_id = "'.addslashes($_POST['group_id']).'",
                                    telephone = "'.addslashes($_POST['telephone']).'",
                                    store_name = "'.addslashes($_POST['store_name']).'",
                                    fax = "'.addslashes($_POST['fax']).'",
                                    email = "'.addslashes($_POST['email']).'",
                                    firstname = "'.addslashes($_POST['firstname']).'",
                                    lastname = "'.addslashes($_POST['lastname']).'",
                                    company_tax_id = "'.addslashes($_POST['company_tax_id']).'",
                                    street_address = "'.addslashes($_POST['street_address']).'",
                                    ship_company_name = "'.addslashes($_POST['ship_company_name']).'",
                                    ship_firstname = "'.addslashes($_POST['ship_firstname']).'",
                                    ship_lastname = "'.addslashes($_POST['ship_lastname']).'",
                                    ship_street_address = "'.addslashes($_POST['ship_street_address']).'",
                                    ship_city = "'.addslashes($_POST['ship_city']).'",
                                    ship_state = "'.addslashes($_POST['ship_state']).'",
                                    ship_postcode = "'.addslashes($_POST['ship_postcode']).'",
                                     modified="'.date("Y-m-d H:i:s",time()).'" 
            where id= "'.$id.'" ';
            $execute=mysql_query($sql) or die('error' .mysql_error());
            if($execute){
              $_SESSION['sentData']=' User has been updated successfully';
            header('location:viewUsers.php?gid='.$_REQUEST['gid']);
            }
        }
        
        function addGroup(){
            global $doc_root;
            $sql_ckname="select * from groups where name='".$_POST['name']."' and status='1'";
            $execute1=mysql_query($sql_ckname) or die('error' .mysql_error());
            if(mysql_num_rows($execute1) > 0){
                $_REQUEST['error']="Name already exist !!!";
            }else{
                if(!empty($_FILES['file']['name'])){
                
                    $sql='insert into groups set name= "'.$_POST['name'].'",
                                            status= "1",
                                            created="'.date("Y-m-d H:i:s",time()).'"
                                      ';
                    $execute=mysql_query($sql) or die('error' .mysql_error());
                    $lastinsertedid=mysql_insert_id();
                    $imagename=admin::uploadimage($lastinsertedid);
                    $sql2='update  groups set image= "'.$imagename.'" where id= "'.$lastinsertedid.'"';
                    $execute2=mysql_query($sql2) or die('error' .mysql_error());
                    if($execute2){
                       $_SESSION['sentData']='Group has been added successfully';
                      header('location:viewGroups.php');
                    }
                
                }else{
                    $sql='insert into groups set name= "'.$_POST['name'].'",
                                            status= "1",
                                            created="'.date("Y-m-d H:i:s",time()).'"
                                      ';
                    $execute=mysql_query($sql) or die('error' .mysql_error());
                    if($execute){
                       $_SESSION['sentData']='Group has been added successfully';
                      header('location:viewGroups.php');
                    }
                }
            }
        }
        
        function uploadimage($lastinsertedid){
            global $doc_root;
            if(!empty($_FILES['file']['name'])){
            $uploadpath=$doc_root.'images/groups/';
            
            $name = @$_FILES['file']['name'];
            $type = @$_FILES['file']['type'];
            $size = @$_FILES['file']['size'];
            @$target = $uploadpath;
             $vowels = array(" ");
            $_FILES['file']['name'] = str_replace($vowels, "_", $_FILES['file']['name']);
            $target = $target .$lastinsertedid.'_'.basename( @$_FILES['file']['name']) ;
            $namefile=$lastinsertedid.'_'.basename( @$_FILES['file']['name']);
            move_uploaded_file($_FILES['file']['tmp_name'], $target);
            return $namefile;
            
            }
        
        }
        
        function updateGroup(){
            global $doc_root;
            $sql='update  groups set name    = "'.$_POST['name'].'"
            where id= "'.$_POST['id'].'"';
            $execute=mysql_query($sql) or die('error' .mysql_error());
           if(!empty($_FILES['file']['name'])){
                
              $fetch=globalfunction::view('groups',$_POST['id']);
                $uploadpath=$doc_root.'images/groups/'.$fetch['image'];
                @unlink($uploadpath);
               $imagename=admin::uploadimage($_POST['id']);
                $sql2='update  groups set image= "'.$imagename.'" where id= "'.$_POST['id'].'"';
               $execute2=mysql_query($sql2) or die('error' .mysql_error());
             }
            
            if($execute){
                $_SESSION['sentData']='Group has been updated successfully';
             header('location:viewGroups.php');
            }
        
        }
        
        
        
           
        
}

/* global class */
class globalfunction{
     
     function getname($tablename,$id){
        
         $sql="select name from $tablename where id='".$id."'";
         $execute2=mysql_query($sql) or die('error' .mysql_error());
         $fetch=mysql_fetch_array($execute2);
      
          return  $fetch['name']; 
      
    }
     
    function view($tablename,$id){
         $sql="select * from $tablename where id='".$id."' AND status='1'";
         $execute=mysql_query($sql) or die('error' .mysql_error());
         $numrows=mysql_num_rows($execute);
         if($numrows>0)
         {
            $fetch=mysql_fetch_array($execute);
            return $fetch;
         }
         else
         { return 0;}
    }
    
    function viewProduct($tablename,$id){
         $sql="select * from $tablename where id='".$id."'";
         $execute=mysql_query($sql) or die('error' .mysql_error());
         $numrows=mysql_num_rows($execute);
         if($numrows>0)
         {
            $fetch=mysql_fetch_array($execute);
            return $fetch;
         }
         else
         { return 0;}
    }
      
      function delete($tablename,$id){
         global $doc_root;
            $fetch=globalfunction::view($tablename,$id);
            
            if($tablename=='categories'){
               
                globalfunction::deleteproducts($fetch['id']);
            }
            if(!empty($fetch)){
                  $uploadpath=$doc_root.'images/'.$tablename.'/'.$fetch['image'];
                  @unlink($uploadpath);
            }
               
          // $sql="UPDATE $tablename set status='0' where id='".$id."'";
          $sql="Delete from $tablename where id='".$id."'";
           $execute=mysql_query($sql) or die('error' .mysql_error());
             $_SESSION['sentData']='Delete has been done successfully';
               
          return $execute; 
        
      }
      
      function deleteproducts($cat_id){
         
           $sql="select * from products where cat_id='".$cat_id."'";
          $execute2=mysql_query($sql);
           $rows= mysql_num_rows($execute2);
         if($rows>0){
            while($executerow=mysql_fetch_array($execute2)){
            
              $uploadpath=$doc_root.'images/products/'.$executerow['image'];
                  @unlink($uploadpath);
            
              //$sql="UPDATE products set status='0' where id='".$executerow['id']."'";
              $sql="Delete From products where id='".$executerow['id']."'";
              $execute=mysql_query($sql) or die('error' .mysql_error());
            
           }
             return $execute;  
           }  
        }
      
      function activate($tablename,$id,$status){
         global $doc_root;
            $fetch=globalfunction::view($tablename,$id);
            
            if($tablename=='categories'){
               
                globalfunction::activateproducts($fetch['id'],$status);
            }   
           $sql="UPDATE $tablename set status='".$status."' where id='".$id."'";
           $execute=mysql_query($sql) or die('error' .mysql_error());
             //$_SESSION['sentData']='Status has been changed successfully';    
          return $execute; 
        
      }
         
        function activateproducts($cat_id,$status){
            $sql="select * from products where cat_id='".$cat_id."'";
            $execute2=mysql_query($sql);
            $rows= mysql_num_rows($execute2);
            if($rows>0){
                while($executerow=mysql_fetch_array($execute2)){
                   $sql="UPDATE products set status='".$status."' where id='".$executerow['id']."'";
                   $execute=mysql_query($sql) or die('error' .mysql_error());
                }
                  return $execute;  
            }  
        }
      
    function viewall($tablename){
        
        $sql="select * from $tablename order by id desc ";
          return $sql; 
        
    }
    
    function countrow($tablename){
        $sql="select * from $tablename";
        $execute2=mysql_query($sql) or die('error' .mysql_error());
        $rows= mysql_num_rows($execute2);
        return $rows;
        
    }
    
    function countrowproducts($tablename,$cat_id){
        $sql="select * from $tablename where cat_id='".$cat_id."'";
        $execute2=mysql_query($sql) or die('error' .mysql_error());
        $rows= mysql_num_rows($execute2);
        return $rows;
        
    }
    
    function productcount($cat_id){
         $sql="select * from products where cat_id='".$cat_id."' order by id desc";
        $execute2=mysql_query($sql) or die('error' .mysql_error());
        $rows= mysql_num_rows($execute2);
        return $rows;  
        
    }
    
    /* View Product Count for a Group */
    function groupproductcount($cat_id,$group_id){
        //1. $sql="select * from products where cat_id='".$cat_id."' AND status='1' order by id desc";
        $sql="SELECT pd.id as id, pd.name as name, pd.model as model, pd.image as image, pd.price as price FROM `products` AS pd
        LEFT JOIN `product_groups` AS prg ON pd.id = prg.product_id WHERE pd.cat_id = ".$cat_id."
        AND prg.group_id = ".$group_id." AND prg.status = '1' ORDER BY pd.id DESC";
        $execute2=mysql_query($sql) or die('error' .mysql_error());
        $rows= mysql_num_rows($execute2);
        return $rows;  
        
    }
    
    function groupproductcountK($group_id){
        $sql="SELECT * FROM categories c INNER JOIN products p ON p.cat_id = c.id INNER JOIN product_groups pg
        ON pg.product_id = p.id INNER JOIN users u ON u.group_id = pg.group_id WHERE u.group_id = ".$group_id;
        $execute2=mysql_query($sql) or die('error' .mysql_error());
        $rows= mysql_num_rows($execute2);
        return $rows;  
        
    }
    
    
    
   function viewallproducts($tablename,$cat_id){
          $sql="select * from ".$tablename." where cat_id=".$cat_id." order by name ASC ";
          return $sql; 
   }
   
   /* View Products for a Group */
   function groupviewallproducts($tablename,$cat_id,$group_id){
      $sql="SELECT pd.id as id, pd.name as name, pd.model as model, pd.image as image, pd.price as price FROM `products` AS pd
        LEFT JOIN `product_groups` AS prg ON pd.id = prg.product_id WHERE pd.cat_id = ".$cat_id."
        AND prg.group_id = ".$group_id." AND prg.status = '1' And pd.status = '1' ORDER BY pd.id DESC";
   
         return $sql; 
   }
     function groupviewallproductsalphabatic($tablename,$cat_id,$group_id){
      $sql="SELECT pd.id as id, pd.name as name, pd.model as model, pd.image as image, pd.price as price FROM `products` AS pd
        LEFT JOIN `product_groups` AS prg ON pd.id = prg.product_id WHERE pd.cat_id = ".$cat_id."
        AND prg.group_id = ".$group_id." AND prg.status = '1' And pd.status = '1' ORDER BY pd.name ASC";
   
         return $sql; 
   }
   
   function groupviewallproductsK($tablename,$group_id){
         $sql="SELECT * FROM categories c INNER JOIN products p ON p.cat_id = c.id INNER JOIN product_groups pg
        ON pg.product_id = p.id INNER JOIN users u ON u.group_id = pg.group_id WHERE u.group_id = ".$group_id;
         return $sql; 
   }
   
   
   
   function viewall_withoutpagination($tablename){
        $sql="select * from $tablename where status='1' order by id desc";
       $execute2=mysql_query($sql) or die('error' .mysql_error());
         return $execute2; 
   }
   
  function ordercount($tablename,$id){
          $sql="select * from ".$tablename." where order_id=".$id." ";
          $execute2=mysql_query($sql) or die('error' .mysql_error());
          return mysql_num_rows($execute2);
   }
   
   
    function vieworder($tablename,$id){
         $sql="select * from $tablename where order_id='".$id."'";
         $execute=mysql_query($sql) or die('error' .mysql_error());
         $numrows=mysql_num_rows($execute);
         if($numrows>0)
         {
            while($fetch=mysql_fetch_array($execute))
            {
               $sale['pr'][] = $fetch['product_id'];
               $sale['qt'][] = $fetch['quantity'];
               $sale['sp'][] = $fetch['saleprice'];
            }
            return $sale;
         }
         else
         { return 0;}
      }
      
   
    
    function viewProductModel($pid){
               $sql = "select model from products where id = ".$pid;
               $executequery=mysql_query($sql) or die('error' .mysql_error());
               $row =  mysql_fetch_array($executequery);
               return $row['model'];
    }
    
    function viewProductName($pid){
               $sql = "select name from products where id = ".$pid;
               $executequery=mysql_query($sql) or die('error' .mysql_error());
               $row =  mysql_fetch_array($executequery);
               return $row['name'];
    }
    
      
   function viewshipping($tablename,$id){
         $sql="select * from $tablename where id='".$id."'";
         $execute=mysql_query($sql) or die('error' .mysql_error());
         $numrows=mysql_num_rows($execute);
         if($numrows>0)
         {
            $fetch=mysql_fetch_array($execute);
            return $fetch;
         }
         else
         { return 0;}
      }
      
      function viewfranchiseeprice($pid,$uid){
            $SQLquery = "select * from `product_price_franchise` where product_id = ".$pid." and user_id = ".$uid;
			$result = mysql_query($SQLquery) or die(mysql_error());
			$rows = mysql_fetch_array($result);
			$num = mysql_num_rows($result);
			if($num == 0)
            {
               return 0;
            }
            else
			{
			   return $rows['price'];
			}
      }
      
      function viewallwithparentid($tablename,$parent_id){
        $sql="select * from $tablename where parent_id='".$parent_id."' and status=1 order by name ASC";
        $execute=mysql_query($sql) or die('error' .mysql_error());
         return $execute;
      }
      
       function viewallsqlwithparentid($tablename,$parent_id){
         $sql="select * from $tablename where parent_id='".$parent_id."'  order by name ASC";
         return $sql;
       }
       
       function viewallDeactivesqlwithparentid($tablename,$parent_id){
         $sql="select * from $tablename where parent_id='".$parent_id."' and status=0 order by name ASC";
         return $sql;
       }
       
       /* View Categories with Group */
       function groupviewallsqlwithparentid($tablename,$parent_id,$gpid){
         //$sql="select * from $tablename where parent_id='".$parent_id."' and status=1";
         
         //$sql = "SELECT ctg.id,ctg.name,ctg.image FROM `".$tablename."` AS ctg LEFT JOIN (`product_groups` AS prg,`products` AS pd)  
//ON prg.product_id =pd.id AND pd.cat_id = ctg.id WHERE prg.group_id =".$gpid." AND ctg.parent_id =".$parent_id." AND prg.status = '1' group by ctg.id";

    $sql = "SELECT ctg.id,ctg.name,ctg.image FROM `".$tablename."` AS ctg LEFT JOIN (`category_groups` AS crg)  
ON ctg.id=crg.category_id WHERE ctg.parent_id =".$parent_id." AND crg.group_id =".$gpid." group by ctg.id";
         
         return $sql;
       }
       
       function countrowwithparent($tablename,$parent_id){
          $sql="select * from $tablename where parent_id='".$parent_id."' ";
             $execute=mysql_query($sql) or die('error' .mysql_error());
             return mysql_num_rows($execute);
         
       }
       
       function countrowSql($sql){
         // $sql="select * from $tablename where parent_id='".$parent_id."' ";
             $execute=mysql_query($sql) or die('error' .mysql_error());
             return mysql_num_rows($execute);
         
       }
       
       function countrowwithparentDeactive($tablename,$parent_id){
          $sql="select * from $tablename where parent_id='".$parent_id."' and status=0 ";
             $execute=mysql_query($sql) or die('error' .mysql_error());
             return mysql_num_rows($execute);
         
       }
       
       /* Count Categories with Group */
       function groupcountrowwithparent($tablename,$parent_id,$gpid){
          //$sql="select * from $tablename where parent_id='".$parent_id."' and status=1 ";
          //$sql = "SELECT ctg.id,ctg.name,ctg.image FROM `".$tablename."` AS ctg LEFT JOIN (`product_groups` AS prg,`products` AS pd)  
//ON prg.product_id =pd.id AND pd.cat_id = ctg.id WHERE prg.group_id =".$gpid." AND ctg.parent_id =".$parent_id." AND prg.status = '1' group by ctg.id";
$sql = "SELECT ctg.id,ctg.name,ctg.image FROM `".$tablename."` AS ctg LEFT JOIN (`category_groups` AS crg)  
ON ctg.id=crg.category_id WHERE ctg.parent_id =".$parent_id." AND crg.group_id =".$gpid." group by ctg.id";
             $execute=mysql_query($sql) or die('error' .mysql_error());
             return mysql_num_rows($execute);
         
       }
      
      function vieworders($userid){
        $sql="select * from orders where user_id = ".$userid." and status='1'";
        return $sql;
        
      }
      
      function viewAllOrders($userid){
        $sql="select orders.id,orders.created,users.company_name from orders LEFT JOIN users ON orders.user_id = users.id order by orders.created desc";
        return $sql;
        
        } 
      
      function viewrowallwithparentid($tablename,$parent_id){
          $sql="select * from $tablename where parent_id='".$parent_id."' ";
         $execute=mysql_query($sql) or die('error' .mysql_error());
             return mysql_num_rows($execute);
      }
      
      function viewgroup($tablename,$id){
         $sql="select * from $tablename where product_id='".$id."' AND status='1'";
         return $sql;
      }
      
      function viewgroupCategory($tablename,$id){
         $sql="select * from $tablename where category_id ='".$id."' AND status='1'";
         return $sql;
      }
      
}

/* global class*/
/* category calss */
 class category{
    
      
        function addCategory(){
            global $doc_root;
            $sql_ckname="select * from categories where name='".$_POST['name']."'";
            $execute1=mysql_query($sql_ckname) or die('error' .mysql_error());
            if(mysql_num_rows($execute1) > 0){
                $_REQUEST['error']="Name already exist !!!";
            }else{
                if(!empty($_FILES['file']['name'])){
                
                    $sql='insert into categories set name= "'.$_POST['name'].'",
                                                      
                                                      created="'.date("Y-m-d H:i:s",time()).'"
                                      ';
                    $execute=mysql_query($sql) or die('error' .mysql_error());
                    $lastinsertedid=mysql_insert_id();
                    $imagename=category::uploadimage($lastinsertedid);
                    
                    $sql2='update  categories set image= "'.$imagename.'"
                    where id= "'.$lastinsertedid.'"';
                    $execute2=mysql_query($sql2) or die('error' .mysql_error());
                    if($execute2){
                       $_SESSION['sentData']='Category has been added successfully';
                      header('location:viewCategories.php');
                    }
                
                }
            }
        }
        
        
       function addSubCategory(){
            global $doc_root;
           // $sql_ckname="select * from categories where name='".$_POST['name']."'";
           // $execute1=mysql_query($sql_ckname) or die('error' .mysql_error());
           // if(mysql_num_rows($execute1) > 0){
              //  $_REQUEST['error']="Name already exist !!!";
            //}else{
                if(!empty($_FILES['file']['name'])){
                
                    $sql='insert into categories set name= "'.$_POST['name'].'",
                                                     parent_id="'.$_POST['cat_id'].'",
                                                     created="'.date("Y-m-d H:i:s",time()).'"
                                      ';
                    $execute=mysql_query($sql) or die('error' .mysql_error());
                    $lastinsertedid=mysql_insert_id();
                    $imagename=category::uploadimage($lastinsertedid);
                    
                    $sql2='update  categories set image= "'.$imagename.'"
                    where id= "'.$lastinsertedid.'"';
                    $execute2=mysql_query($sql2) or die('error' .mysql_error());
                    if($execute2){
                       $_SESSION['sentData']='Sub Category has been added successfully';
                      header('location:viewCategories.php');
                    }
                
                }
                else{
                    $sql='insert into categories set name= "'.$_POST['name'].'",
                                                     parent_id="'.$_POST['cat_id'].'",
                                                     created="'.date("Y-m-d H:i:s",time()).'"
                                      ';
                    $execute=mysql_query($sql) or die('error' .mysql_error());
                    if($execute){
                       $_SESSION['sentData']='Sub Category has been added successfully';
                      header('location:viewCategories.php');
                    }
                    
                }
            //}
        }
        
        function uploadimage($lastinsertedid){
            global $doc_root;
            if(!empty($_FILES['file']['name'])){
            $uploadpath=$doc_root.'images/categories/';
            
            $name = @$_FILES['file']['name'];
            $type = @$_FILES['file']['type'];
            $size = @$_FILES['file']['size'];
            @$target = $uploadpath;
             $vowels = array(" ");
            $_FILES['file']['name'] = str_replace($vowels, "_", $_FILES['file']['name']);
            $target = $target .$lastinsertedid.'_'.basename( @$_FILES['file']['name']) ;
            $namefile=$lastinsertedid.'_'.basename( @$_FILES['file']['name']);
            move_uploaded_file($_FILES['file']['tmp_name'], $target);
            
            return $namefile;
            
            }
        
        }
        
        
        function updateCategory(){
            global $doc_root;
            $sql='update  categories set name    = "'.$_POST['name'].'",
                                        parent_id    = "'.$_POST['cat_id'].'",
                                        modified   = "'.date("Y-m-d H:i:s",time()).'"

            where id= "'.$_POST['id'].'"';
            $execute=mysql_query($sql) or die('error' .mysql_error());
           if(!empty($_FILES['file']['name'])){
                
              $fetch=globalfunction::view('categories',$_POST['id']);
                $uploadpath=$doc_root.'images/categories/'.$fetch['image'];
                @unlink($uploadpath);
               $imagename=category::uploadimage($_POST['id']);
                $sql2='update  categories set image= "'.$imagename.'" where id= "'.$_POST['id'].'"';
               $execute2=mysql_query($sql2) or die('error' .mysql_error());
             }
            
            if($execute){
                $_SESSION['sentData']='Category has been updated successfully';
             header('location:viewCategories.php');
            }
        
        }
        
function get_cat_selectlist($current_cat_id, $count) {
	static $option_results;
	// if there is no current category id set, start off at the top level (zero)
	if (!isset($current_cat_id)) {
		$current_cat_id =0;
	}
	// increment the counter by 1
	$count = $count+1;

	// query the database for the sub-categories of whatever the parent category is
	$sql =  'SELECT id, name from categories where status="1" AND parent_id =  '.$current_cat_id;
	$sql .=  ' order by name asc ';

	$get_options = mysql_query($sql);
	$num_options = mysql_num_rows($get_options);
         $indent_flag='';
	// our category is apparently valid, so go ahead ?¦
	if ($num_options > 0) {
		while (list($cat_id, $cat_name) = mysql_fetch_row($get_options)) {

		// if its not a top-level category, indent it to
		//show that its a child category

			if ($current_cat_id!=0) {
				$indent_flag =  '--';
				for ($x=2; $x<=$count; $x++) {
					$indent_flag .=  ' >';
				}
			}
			$cat_name = $indent_flag.$cat_name;
			$option_results[$cat_id] = $cat_name;
			// now call the function again, to recurse through the child categories
			category::get_cat_selectlist($cat_id, $count);
		}
	}
	return $option_results;
}

 function getParentCat($id = NULL){
	static $option_results;
	$sql =  'SELECT * from categories where id =  '.$id;
	$get_options = mysql_query($sql);
	$option_result = mysql_fetch_row($get_options);
       $option_result[1];
	if($option_result[1] != 0){
		$option_results[$option_result[0]] = $option_result[2];
		category::getParentCat($option_result[1]);
	}else{
		$option_results[$option_result[0]] = $option_result[2];
	}
	//print_r($option_results);
	return $option_results;
}

        
        
      
}
/* end of categories */


 class product {
    
    
     function addProduct($catid){
         global $doc_root;
//$sql_ckname="select * from products where name='".$_POST['name']."'";
           // $execute1=mysql_query($sql_ckname) or die('error' .mysql_error());
           // if(mysql_num_rows($execute1) > 0){
             //   $_REQUEST['error']="Product name already exist !!!";
          //  }
           // else{
                $sql='insert into products set name= "'.$_POST['name'].'",
                                               cat_id="'.$catid.'",
                                               model="'.$_POST['model'].'",
                                               handlingfee="'.$_POST['handlingfee'].'",
                                               sizes="'.$_POST['sizes'].'",
                                               stock_code="'.$_POST['stock_code'].'",
                                               colours="'.$_POST['colours'].'",
                                               description = "'.addslashes($_POST['description']).'",
                                               price="'.$_POST['price'].'",
                                               special_offer  ="'.$_POST['special_offer'].'",
                                               special_price ="'.$_POST['special_price'].'",
                                      created="'.date("Y-m-d H:i:s",time()).'"
 
                                               ';
                                               
                $execute=mysql_query($sql) or die('error' .mysql_error());
                $lastinsertedid=mysql_insert_id();
                $imagename=product::uploadimage($lastinsertedid);
                 if(!empty($_FILES['file']['name'])){
                $sql2='update  products set image= "'.$imagename.'"  where id= "'.$lastinsertedid.'"';
                $execute2=mysql_query($sql2) or die('error' .mysql_error());
                if(isset($_POST['group_id'])){
                    $sql3 = "INSERT INTO product_groups (product_id,group_id) VALUES";
                      foreach($_POST['group_id'] as $grpid)
                      {
                         $sql3 .= "($lastinsertedid,".$grpid."),";
                      }
                      $execute3=mysql_query(rtrim($sql3,",")) or die('error' .mysql_error());
                }
                else{
                    $execute3=$execute;
                }
                /*$sql3='insert into product_groups set product_id= "'.$lastinsertedid.'"';
                $execute3=mysql_query($sql2) or die('error' .mysql_error());
                //$_POST['group_id']*/
                }
                
                 if($execute3){
                    $_SESSION['sentData']='Product has been added successfully';
                  header('location:viewCategories.php');
                }
                  
            //}
        
        
     }
     
     
     function uploadimage($lastinsertedid){
            global $doc_root;
            if(!empty($_FILES['file']['name'])){
            $uploadpath=$doc_root.'images/products/';
            $name = @$_FILES['file']['name'];
            $type = @$_FILES['file']['type'];
            $size = @$_FILES['file']['size'];
            @$target = $uploadpath;
            $vowels = array(" ");
            $_FILES['file']['name'] = str_replace($vowels, "_", $_FILES['file']['name']);
            $target = $target.$lastinsertedid.'_'.basename( @$_FILES['file']['name']) ;
            $namefile=$lastinsertedid.'_'.basename( @$_FILES['file']['name']);
            move_uploaded_file($_FILES['file']['tmp_name'], $target);
            
            return $namefile;
            
            }
        
        }
        
        
        
        
         function updateProduct(){
            global $doc_root;
           $sql='update  products set name= "'.$_POST['name'].'",
                                          model="'.$_POST['model'].'",
                                               handlingfee="'.$_POST['handlingfee'].'",
                                               sizes="'.$_POST['sizes'].'",
                                               stock_code="'.$_POST['stock_code'].'",
                                               colours="'.$_POST['colours'].'",
                                        description = "'.addslashes($_POST["description"]).'",
                                           price="'.$_POST['price'].'",
                                            special_offer  ="'.$_POST['special_offer'].'",
                                               special_price ="'.$_POST['special_price'].'",
                                           cat_id="'.$_POST['cat_id'].'",
                                    modified="'.date("Y-m-d H:i:s",time()).'"

             where id= "'.$_POST['id'].'"
             
             ';
            $execute=mysql_query($sql) or die('error' .mysql_error());
           if(!empty($_FILES['file']['name'])){
                
              $fetch=globalfunction::view('products',$_POST['id']);
                $uploadpath=$doc_root.'images/products/'.$fetch['image'];
                @unlink($uploadpath);
               $imagename=product::uploadimage($_POST['id']);
                $sql2='update  products set image= "'.$imagename.'" where id= "'.$_POST['id'].'"';
               $execute2=mysql_query($sql2) or die('error' .mysql_error());
               
               }
            $sqldel = "delete from product_groups where product_id = ".$_GET['id'];
               $execute3=mysql_query($sqldel)  or die('error' .mysql_error());
               if(isset($_POST['group_id'])){
                $sql3 = "INSERT INTO product_groups (product_id,group_id) VALUES";
                   foreach($_POST['group_id'] as $grpid)
                   {
                      $sql3 .= "(".$_GET['id'].",".$grpid."),";
                  }
                  //echo "sql3".$sql3;
                   $execute3=mysql_query(rtrim($sql3,",")) or die('error' .mysql_error());
               }
            if($execute){
                $_SESSION['sentData']='Product has been updated successfully';
             header('location:viewProducts.php?cat_id='.$_POST['cat_id']);
            }
        }
}

/* User global fucntion */
 class userglobal{
   
    function getusers($tablename){
     
           $sql="select * from ".$tablename." where status='1'";
           $execute2=mysql_query($sql) or die('error' .mysql_error());
           return $execute2;
     
    }
    
    
    function price_product_franchise(){
      
       if(!empty($_POST['price'])){
          foreach($_POST['price'] as $key=>$value){
            $product=$_POST['product'];
            $execute=userglobal::selectrowwithproductidprice($_POST['franchise_id'],$product[$key]);
            $rows=mysql_num_rows($execute);
             if($rows>0){
               $fetch=mysql_fetch_array($execute);
                 $sql="update  product_price_franchise set 
                                                        price =  $value
                                                     where id='".$fetch['id']."'      ";     
               
             }else {
               $sql="insert into product_price_franchise set product_id = '".$product[$key]."',
                                                        price =  $value,
                                                        user_id ='".$_POST['franchise_id']."'";    
               
             }
            
            $execute=mysql_query($sql);
          }
           return $execute;
           
       }
      
    }
    
         
    
    function selectrowwithproductidprice($user_id,$product_id){
      
        $sql="select * from product_price_franchise where product_id = '".$product_id."'
                                             and  user_id ='".$user_id."'";
                                                        
        $execute=mysql_query($sql) or die('errorrr');
        
      
      
        return $execute;
                                             
      
      
    }
    
    function getpricebyproduct($user_id,$product_id){
        $sql="select * from product_price_franchise where product_id = '".$product_id."'
                                            and  user_id ='".$user_id."'";
                                                        
        $execute=mysql_query($sql) or die('errorrr');
         $fetch=mysql_fetch_array($execute);
       return $fetch;
    }
    
    function copy_product($product_id){
        $sql="select * from products where id = '".$product_id."' ";
        $execute=mysql_query($sql) or die('errorrr');
        $fetch=mysql_fetch_array($execute);
        
       $sql="INSERT INTO products set cat_id = '".$fetch['cat_id']."' ,
                                        name ='".$fetch['name']."' ,
                                        model= '".$fetch['model']."',
                                        handlingfee = '".$fetch['handlingfee']."',
                                        sizes = '".$fetch['sizes']."',
                                        colours= '".$fetch['colours']."' ,
                                        image= '".$fetch['image']."' ,
                                        description= '".$fetch['description']."' ,
                                        price = '".$fetch['price']."',
                                        created= '".$fetch['created']."' ,
                                        modified= '".$fetch['modified']."' ,
                                        status= '".$fetch['status']."'";
        
      
        $execute=mysql_query($sql) or die('error' .mysql_error());
        return $execute;
      
    }
    
    
    function copy_category($category_id){
        $sql="select * from categories where id = '".$category_id."' ";
        $execute=mysql_query($sql) or die('errorrr');
        $fetch=mysql_fetch_array($execute);
        
       $sql="INSERT INTO categories set parent_id  = '".$fetch['parent_id']."' ,
                                        name  ='".$fetch['name']."' ,
                                        image = '".$fetch['image']."',
                                        created  = '".$fetch['created']."',
                                        modified  = '".$fetch['modified']."',
                                        status= '".$fetch['status']."'";
        $execute=mysql_query($sql) or die('error' .mysql_error());
        return $execute;
      
    }
    
    function move_product($product_id,$cat_id){
        $sql="UPDATE products set cat_id='".$cat_id."' where id='".$product_id."'";
        $execute=mysql_query($sql) or die('error' .mysql_error());
        return $execute;
    }
    
     function move_category($category_id,$parent_id){
        $sql="UPDATE categories set parent_id ='".$parent_id."' where id='".$category_id."'";
        $execute=mysql_query($sql) or die('error' .mysql_error());
        return $execute;
    }
    
    function add_group($product_id,$group_id){
        //print_r($group_id);
       foreach($group_id as $grpid)
                  {
                $query = "select * from product_groups  where product_id='".$product_id."' and group_id='".$grpid."' ";
                $executequery=mysql_query($query) or die('error' .mysql_error());
                $fetch = mysql_fetch_assoc($executequery);
                
                if(empty($fetch)){
                    $sql="insert into product_groups set product_id='".$product_id."',group_id='".$grpid."'";
                    $execute=mysql_query($sql) or die('error' .mysql_error());
                  }else{
                    $sql="UPDATE product_groups set group_id='".$grpid."' WHERE id='".$fetch['id']."' ";
                    $execute=mysql_query($sql) or die('error' .mysql_error());
                  }
                    
                  }
                  return $execute;
    }
    
    function add_category_group($category_id,$group_id){
        //print_r($group_id);
        $query = "select * from category_groups  where category_id ='".$category_id."'";
        $executequery=mysql_query($query) or die('error' .mysql_error());
        if(mysql_num_rows($executequery) > 0){
            while($fetch = mysql_fetch_array($executequery)){
                $sqlDelete="delete from category_groups where id ='".$fetch['id']."'";
                $executeDelete=mysql_query($sqlDelete) or die('error' .mysql_error());
            }
        }
       foreach($group_id as $grpid){
                $sql="insert into category_groups set category_id ='".$category_id."',group_id='".$grpid."'";
                $executeinsert=mysql_query($sql) or die('error' .mysql_error());
        }
        return $executeinsert;
    }
    
 }



?>
