<?php ob_start();
include('header.php');
?>
<?php $sql = "SELECT * FROM customers ";
 //   $customer_record = $db->query_first($sql);
   $pager = new PS_Pagination($con,$sql,20,10);  
   $rs = $pager->paginate();
 $query=mysql_query($sql);
  $rows=mysql_num_rows($query);
 ?>
 
 <?php 
 
  if(!empty($_GET['delete'])){
             $sql = "delete from customers where id>0 ";
            mysql_query($sql);
             $sql1 = "delete from transactions where id>0 ";
            mysql_query($sql1);
              $sql2 = "delete from transaction_items where id>0 ";
            mysql_query($sql2);
            
       
       header('location:getDetails.php');
    
    
    
  }
 
 ?>
 
 
 
 
 <div class="main">
<div class="container">
   
    
    
<div class="box">
<div class="detail-box">

<div class="detial-box-tp"></div>
<div class="detial-box-mid">
   <div style="width:593px; min-height:150px; position:relative; z-index:2; margin-top:60px; display:none" class="waitblock"> 
    <div class="wait">
    
     <b> Please wait !!!! Data is loading ............. </b>
 </div>
   </div>
 
     <div>
       
        <h4>GET TRANSACTION DETAILS FROM PAYPAL And  EBAY   </h4>
         <form action="getTransaction.php" method="post" id="searchfrm" name="getdetails">
            
    <table  align="center" cellpadding='1' cellspacing='1'  style="font-family:arial;" width="600">
    
    <tr> <td  style="padding:5px;"> Enter Start Date : <span class="red">*</span> </td>
          <td  style="padding:5px;"><input type="text" name="startdate" class="required" id="datepicker"> e.g Y-m-d H:i:s</td>
    </tr>
    <tr><td  style="padding:5px;"> Enter End Date  :  <span class="red">*</span></td>
        <td  style="padding:5px;"><input type="text" name="enddate" class="required" id="datepicker2"> e.g Y-m-d H:i:s</td>
    </tr>
       <tr><td colspan="2" align="center"  style="padding:5px;">
       <input type="submit" name="getdetails" value="GetRecords"></td></tr>
</table>
</form>
    </div>


</div>

<div class="detial-box-bt"></div>
</div>
</div>



<table width="800" border="0" cellspacing="0" cellpadding="0" align="center" >
    
    <tr><td colspan="2"> <?php
         if(!empty($_GET['msg']) && $_GET['msg']=='succ'){
    
     echo "<b><span style='color:red;padding-left:40px; margin-bottom:30px;'>Records has been inserted and updated in the database. Please view your transaction in below.</span> </b> ";
    
    
 }
        ?></td></tr>
  <tr class="head">
  	
        <td>Existing Records in our Database</td>
        <td><img src="images/database.png" alt="" align="absmiddle" /> <a href="?delete=all" onclick="return confirmdelete();">X Click here to Flush Database</a></td>
       
 </tr>
 <tr class="head">
  	
        <td colspan="2">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0"  >
            	<tr>
                    <td width="3%" class="pl5">S.no</td>
                    <td width="10%" class="pl5">First Name</td>
                    <td width="10%" class="pl5">Last Name</td>
                    <td width="26%" class="pl5">Email</td>
                    <td width="19%" class="pl5">PAYERID</td>
                    <td width="15%" class="pl5">BUYERID</td>
                    <td width="17%">Actions</td>
            	</tr>
            </table>
         </td>
</tr>
</table>
<table width="800" border="0" cellspacing="0" cellpadding="0" align="center" style="border:1px solid #b8c7d1;" >
     <?php
     if(!empty($rows)){
        $i=1;
      while($data=mysql_fetch_array($rs)){ ?>
       <tr>
      <td class="borders pl5" width="3%"><?php echo $i; ?> </td>
      <td class="borders pl5" width="10%"><?php echo $data['FIRSTNAME']; ?></td>
      <td class="borders pl5" width="10%"><?php echo $data['LASTNAME']; ?></td>
      <td class="borders pl5"  width="26%"><?php echo $data['EMAIL']; ?></td>
      <td class="borders pl5" width="19%"><?php echo $data['PAYERID']; ?></td>
       <td class="borders pl5" width="15%"><?php echo $data['BUYERID']; ?></td>
      <td class="borders pl5" width="17%"><a href="viewDetail.php?customerid=<?php echo $data['id']; ?>" class="view-tran"> View transaction</a></td> 
    </tr>
      
      <?php $i++;
      
      } }?>
    

	

</table>

 <table  align="center" width="300">
    <tr><td>
       <?php  if(!empty($rows)){ echo $pager->renderFullNav();  }  ?></td>
    </tr>
 </table>

</div>
</div>
 
 
 
 
 
 </body>
            
            
</html>
 
   
  