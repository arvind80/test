<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" xmlns:v='urn:schemas-microsoft-com:vml'>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
		<title>Water For Life</title>
        <script type="text/javascript">
            imgurl = "img/"
        </script>
		<link rel="stylesheet" href="css/style.css" type="text/css" media="screen"  />
        <? echo '<!--[if IE]><?import namespace="v" implementation="#default#VML" ?><![endif]-->'  ?>
        <script type="text/javascript" src="http://omnitom.com/facelift/flir.js"></script>
        <script type="text/javascript" src="js/jquery1.3.2.js"></script>
        <script type="text/javascript" src="js/form.validator.js"></script>
        <script type="text/javascript" src="js/jquery.form.js"></script>
        <script type="text/javascript" src="js/functions.js"></script>

	</head>
	<body>

<ol id="current_pages">
       <h3>Ready Pages</h3><?php $dir = opendir ("./");
    	while (false !== ($file = readdir($dir))) {
    	if (strpos($file, '.php',1)) {
    	if(($file!="header.php") && ($file!="footer.php") && ($file!="!template.php") && ($file!="test.php")){
        echo "<li><a href='$file'>$file</a></li>";}}} ?>
</ol>


        <div id="container">
          <div id="wrapper">
            <div id="header" class="wrap">

