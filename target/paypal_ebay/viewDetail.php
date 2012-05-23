<style>
  .first{
    
    float:left;
    width:400px;
    margin-left:10px;
  }
  .first ul{
     float:left;
    width:400px;
    list-style:none;
    padding:0px;
    margin:0px;
    
    
  }
   .first ul li{
     float:left;
     font-family:"arial";
     font-size:12px;
     font-weight:normal;
     color:#000;
     padding:0px 5px;
   
    
  }
  .first ul li a{
     float:left;
     font-family:"arial";
     font-size:12px;
     font-weight:normal;
     color:#000;
   
    
  }
  
  .first ul li.first{
     float:left;
     font-family:"arial";
     font-size:12px;
     font-weight:normal;
     color:#000;
     width:auto !important;
   
    
  }
  .first ul li.last{
     float:left;
     font-family:"arial";
     font-size:12px;
     font-weight:normal;
     color:#000;
     width:auto !important;
   
    
  }
 </style>
 
<?php require_once('ps_pagination.php');
$con = mysql_connect('localhost','harvest_newuser','pas448877') or die("Could not connect");   
mysql_select_db('harvest_newdb', $con) or die('Could not select Database');
      $sql = "SELECT * FROM transactions where customer_id= ".$_GET['customerid'];
 //   $customer_record = $db->query_first($sql);
   $pager = new PS_Pagination($con,$sql,20,4,'customerid='.$_GET['customerid']);  
   $rs = $pager->paginate();
 
  $rows=mysql_num_rows($rs);
 ?>
 <table  align="center" cellpadding='1' cellspacing='1' bgcolor="#ccc" style="font-family:arial ;font-size:12px; margin-top:30px;" width="600">
    <tr><td><b><a href="getDetails.php">Click here to go back to main page</a></b></td></tr>
    
    <tr><td>S.no </td>
        <td>L_TRANSACTIONID</td><td>RECEIVERBUSINESS </td>
        <td>RECEIVEREMAIL</td> <td>PAYERSTATUS 	</td><td>TRANSACTIONID</td>
       <td> PAYMENTSTATUS</td>
    </tr>
    <?php
    if(!empty($rows)){
   while($data=mysql_fetch_array($rs)){ ?>
    <tr>
      <td bgcolor="#fff" style="padding:5px;"><?php echo $data['id']; ?> </td>
    
      <td bgcolor="#fff" style="padding:5px;"><?php echo $data['L_TRANSACTIONID']; ?></td>
      <td bgcolor="#fff" style="padding:5px;"><?php echo $data['>RECEIVERBUSINESS']; ?></td>
     <td bgcolor="#fff" style="padding:5px;"><?php echo $data['RECEIVEREMAIL']; ?></td>
      <td bgcolor="#fff" style="padding:5px;"><?php echo $data['PAYERSTATUS']; ?></td>
    <td bgcolor="#fff" style="padding:5px;"><?php echo $data['TRANSACTIONID']; ?></td>
    <td bgcolor="#fff" style="padding:5px;"><?php echo $data['PAYMENTSTATUS']; ?></td> 
    </tr>
  <?php 
  
   }
   }else {
    
      echo "No records for this customer ";
   }
  
  ?>
  <tr><td colspan="2">
     <?php     if(!empty($rows)){  echo $pager->renderFullNav();  }  ?></td></tr>
 </table>
  
 
 
   