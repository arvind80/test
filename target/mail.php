<?php
$name=$_POST['contact_first_name'];
$lname=$_POST['contact_last_name'];
$email=$_POST['contact_email'];
$msubject=$_POST['contact_message'];
$phone=$_POST['contact_phone'];
$address=$_POST['contact_address'];

$to = "jdthakur11@gmail.com";
$from = "jdthakur11@gmail.com";
$subject="User Details";
$messages = '<table align="center" style=" border:2px solid #003D7D;" width="785" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
        <div style="float:left; width:781px;">
            <div style="float:left; width:781px; height:90px; border-bottom:solid 2px #003D7D;">
            <br/>
  <h3>User Details</h3>
            </div>
            <div style="float:left; width:751px; padding:15px; font-size:12px; height:auto !important; height:320px;">
              
                   <p style="float:left; width:751px; margin:0px; color:#000000; padding-top:15px;">Here user contact details:<br/><br/> 
                    First Name: '.$name.'<br/>
                    Last Name: '.$lname.'<br/>
                    Phone: '.$phone.'<br/>
		    Email id: '.$email.'<br/>
		    Address: '.$address.'<br/> 
                    Message: '.$msubject.'</p>              
            </div>
            <div style="float:left; width:751px; padding:15px; font-size:12px; color:#000000; background:#F2E9C4;">
            </div>
        </div>
    </td>
</tr>
</table>'; 
        $headers = "MIME-Version: 1.0\n" ;
        $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"\n";
        $headers .= "X-Priority: 1 (Higuest)\n";
        $headers .= "X-MSMail-Priority: High\n";
        $headers .= "Importance: High\n";
        $headers .= 'From:  '.$from.'' . "\r\n";     

if(mail($to, $subject, $messages, $headers)){
	echo "<script type='text/javascript'>alert('Your Information has been successfully saved!');</script>";
	echo "<script type='text/javascript'>history.go(-1);</script>";
}
