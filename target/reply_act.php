<?php
include('config/dbConf.php');
mysql_connect(DATABASE_HOST,DATABASE_USERNAME,DATABASE_PASSWORD);
mysql_select_db(DATABASE_NAME);
if(isset($_POST['submit'])&& ($_POST['submit']!=''))
{   echo "insert into soupport(`userto_id`,`userfrom_id`,`subject`,`meassage`,`status`,`read_status`,`createddate`,`massgae_id`)
          values('".$_POST['reply_to']."','".$_POST['reply_from']."','".$_POST['re_subject']."','".$_POST['support_msg']."','".$_POST['re_status']."','0','".$date."','".$_POST['msg_id']."')" ;

    $date=date('Y-m-d');
    $insert="insert into soupport(`userto_id`,`userfrom_id`,`subject`,`meassage`,`status`,`read_status`,`createddate`,`massgae_id`)
          values('".$_POST['reply_to']."','".$_POST['reply_from']."','".$_POST['re_subject']."','".$_POST['re_support_msg']."','".$_POST['re_status']."','0','".$date."',".$_POST['msg_id'].")";
       $exequery=mysql_query($insert);
       if($exequery)
       {
      header("location:index.php?action_view=inbox&msg=sent#tabs-5");
      }
}


?>