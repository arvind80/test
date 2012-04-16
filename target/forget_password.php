<?php
session_start();
include("config/dbConf.php");
mysql_connect(DATABASE_HOST,DATABASE_USERNAME,DATABASE_PASSWORD);
mysql_select_db(DATABASE_NAME);
 $mailid=$_REQUEST['mailid'];
 $select="select full_name,email from users where email='".$mailid."'";
 $exeselect=mysql_query($select);
 $row=mysql_fetch_array($exeselect);
 $name=$row['full_name'];
 $numrows=mysql_num_rows($exeselect);
if($numrows==0){
echo "Your mail id not found in our Database";
}
else
{

function createPassword($length) {
	$chars = "234567890abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$i = 0;
	$password = "";
	while ($i <= $length) {
		$password .= $chars{mt_rand(0,strlen($chars))};
		$i++;
	}
	return $password;
}
 
$password = createPassword(6);
 $upd="update users set
         password='".md5($password)."' where email='".$mailid."'";
         $exeupd=mysql_query($upd);
         if($exeupd){
			$message='<table align="center" style=" border:2px solid #000000;" width="785" border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                                <td>
                                                                <div style="float:left; width:781px;">
                                                                <div style="float:left; width:781px; height:90px;">
                                                                        <img src="http://192.168.1.3/vivek/target/images/logo.png" alt="" />
                                                                </div>
                                                                <div style="float:left; width:751px; padding:15px; font-size:13px; height:auto !important; height:320px;font-family: Arial,Helvetica,sans-serif;">
                                                                        <p style="float:left; width:751px; margin:0px; color:#000000; padding-top:15px;"><br/>
                                                                        <strong></strong>Hello '.$name.' your password change sucessfully<br><br>
                                                                        <strong>MailId:</strong> '.$mailid.'<br><br>
                                                                        <strong>Password:</strong> '.$password.'<br><br>
                                                                      
                                                                      
                                                                       
                                                                </div>
                                                        </div>
                                                </td>
                                        </tr>
                                        </table>'; 
			$subject="Password Reminder";
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			// Additional headers
			$headers .= 'To:'.$name.'' . "\r\n";
			$headers .= 'From: Password Reminder <admin@kindlebit.com>' . "\r\n";

			$mail=mail($mailid,$subject,$message,$headers);
			if($mail){
				echo "Mail has been sent to you";
				} 
			}
}
?>
