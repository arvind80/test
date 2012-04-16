<?php //$Obj->checkAdmin('LoginId',1);
//au9i1@5et0r8
//dauMonday5@o
//7i>r>&CrJ`{SJDnM
//update top_university set `country_id`='' where `country_name`='India';

$connection =mysql_connect("localhost","root","root")
or die('Cannot connect to MySQL');
mysql_select_db("franchis_dbclients");                    
if(isset($_REQUEST['Submit']))
{
    if(isset($_FILES['userfile']['name']) && $_FILES['userfile']['name']!="")
    {
          $extension = strtolower(substr($_FILES['userfile']['name'], strrpos($_FILES['userfile']['name'], '.') + 1));
          $extension=strtolower($extension);
          if($extension=='csv')
          {
                       $file_handle = fopen($_FILES['userfile']['tmp_name'],'r') or die("can't open file");
                       /////////////////////////////Upload Csv File////////////////
                       // connect to database
                       //$connection =mysql_connect("localhost","hypnotic_dose","Q}kqoEW-U}#$")
                         //or die('Cannot connect to MySQL');
                       //mysql_select_db("hypnotic_db")
                         //or die('Cannot connect to database');
                       // clear the table down
                       $sql = "TRUNCATE TABLE users";
                       // run the first query to clear table
                       mysql_query($sql) or die(mysql_error());
                       // open the csv file
                       $data = file($_FILES['userfile']['tmp_name']);
                       //echo "<pre>"; print_r($data); exit;
                       // create an insert statement for each row in the csv file
                       foreach ($data as $row){
                       //$row=str_replace(",INC","*INC",$row);
                           $cols = explode(";",$row); // put each piece of data seperated by a comma, into an array called $cols
                           //echo "<pre>"; print_r($cols); //exit;
                                //$count=count($cols);
                                //$date=date("Y-m-d H:i:s",time());
                                     $customers_id=trim(str_replace('"','',$cols[0]));
                                     $customers_company=trim(str_replace('"','',$cols[17]));
                                     $customers_firstname=trim(str_replace('"','',$cols[2]));
                                     $customers_lastname=trim(str_replace('"','',$cols[3]));
                                     $customers_street_address=trim(str_replace('"','',$cols[21]));
                                     $customers_suburb=trim(str_replace('"','',$cols[22]));
                                     $customers_postcode=trim(str_replace('"','',$cols[23]));
                                     $customers_city=trim(str_replace('"','',$cols[24]));
                                     $customers_state=trim(str_replace('"','',$cols[25]));
                                     $customers_email_address=trim(str_replace('"','',$cols[9]));
                                     $customers_newsletter=trim(str_replace('"','',$cols[10]));
                                     $customers_telephone=trim(str_replace('"','',$cols[11]));
                                     $customers_fax=trim(str_replace('"','',$cols[12]));
                                     $customers_password=trim(str_replace('"','',$cols[13]));
                                     $customers_group_id=trim(str_replace('"','',$cols[14]));
                                     if($customers_group_id==7){
										 $customers_group_id=5;
									}elseif($customers_group_id==1){
										 $customers_group_id=20;
									}
									elseif($customers_group_id==2){
										 $customers_group_id=6;
									}
									elseif($customers_group_id==3){
										 $customers_group_id=13;
									}elseif($customers_group_id==4){
										 $customers_group_id=18;
									}elseif($customers_group_id==6){
										 $customers_group_id=11;
									}
									elseif($customers_group_id==8){
										 $customers_group_id=16;
									}
									elseif($customers_group_id==9){
										 $customers_group_id=14;
									}
									elseif($customers_group_id==10){
										 $customers_group_id=17;
									}
									elseif($customers_group_id==11){
										 $customers_group_id=17;
									}
									elseif($customers_group_id==12){
										 $customers_group_id=19;
									}
									elseif($customers_group_id==13){
										 $customers_group_id=10;
									}
									elseif($customers_group_id==14){
										 $customers_group_id=12;
									}
									elseif($customers_group_id==15){
										 $customers_group_id=21;
									}
									elseif($customers_group_id==16){
										 $customers_group_id=7;
									}
									elseif($customers_group_id==17){
										 $customers_group_id=15;
									}
									elseif($customers_group_id==18){
										 $customers_group_id=9;
									}
									elseif($customers_group_id==19){
										 $customers_group_id=8;
									}else{ $customers_group_id=20; }
                       //$sql ="INSERT INTO top_university(country_name,rank,name,status) VALUES('".$cols3."','".$cols1."','".$cols2."','1')";
                       echo $sql='insert into users set business_emailaddress = "'.$customers_email_address.'",
                                            company_name = "'.$customers_company.'",
                                            group_id = "'.$customers_group_id.'",
                                            username = "'.$customers_email_address.'",
                                            password = "'.$customers_password.'",
                                            telephone = "'.$customers_telephone.'",
                                            fax = "'.$customers_fax.'",
                                            email = "'.$customers_email_address.'",
                                            firstname = "'.$customers_firstname.'",
                                            lastname = "'.$customers_lastname.'",
                                            city = "'.$customers_city.'",
                                            street_address = "'.$customers_street_address.'",
                                            state = "'.$customers_state.'",
                                            suburd = "'.$customers_suburb.'",
                                            status = "1",
                                            active = "1",
                                            postcode = "'.$customers_postcode.'",
                                            modified="'.date("Y-m-d H:i:s",time()).'" ,
                                            created="'.date("Y-m-d H:i:s",time()).'"';
						$execute=mysql_query($sql) or die('error' .mysql_error());
                       //$result=mysql_query($sql);
                       }//exit;
                      
          }
          else { echo "<script type='text/javascript'>alert('Plesae upload csv file');</script>"; }
    }
     else { echo "<script type='text/javascript'>alert('Plesae upload csv file');</script>"; }
     
}

?>

<div class="title-bar">Payment Details</div> 
  <div style=" padding-top:10px; height:auto; width:100%;">
	<fieldset>
	<h3 style='color:#5E5E5E;font-size:13px'>Please Upload the CSV File For <a href="couponcode.csv">Example</a> </h3>
        <form enctype="multipart/form-data" method="POST">
        <input type="hidden" name="act" value="insert">
        <input name="userfile" type="file" >
        <input type="submit" value="Submit" name="Submit" class="button" style=" cursor:pointer">
        </form>
	</fieldset>
	  </div>
  </br>
