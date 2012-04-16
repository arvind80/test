<?php 
    include("scripts/db_connection.php");
	class Registration{
		
		  public $author;
  		  public $title;
  		  public $date;
		  public $data;
		  
		  function __construct($author, $title, $date,$data){
		  							
		  		$this->author = $author;
    			$this->title = $title;
    			$this->date = $date;
		  		$this->data=$data;
			    
		  }
	}
	
	$myConnection = mysqli_connect("$db_host","$db_username","$db_pass", "$db_name") or die ("could not connect to mysql"); 
	
	$resultSet = mysqli_query($myConnection, "SELECT * FROM a1_Registrations order by date_registered desc limit 0,20") or die (mysqli_error($myConnection));
	$Registration=array();
	while($row=mysqli_fetch_array($resultSet)){
		array_push($Registration,new Registration(
	    "Naveen Kumar",
	    "Registration Info",
	    "8/3/2011",
	    array(
	      'email1'=>$row['email1'],
	      'first_name'=>$row['first_name'],
	      'last_name'=>$row['last_name'],
	      'primary_phone'=>$row['primary_phone'],
	      'state'=>$row['state'],
	      'zip_code'=>$row['zip_code'],
	      'date_registered'=>$row['date_registered'],
	      'time_registered'=>$row['time_registered']
	    )
	  ));
	}
	
	//create the xml document
	$xmlDoc = new DOMDocument();
	//create the root element
	$root = $xmlDoc->appendChild($xmlDoc->createElement("RegistrationData"));
	foreach($Registration as $tut){	
		  //create a tutorial element
		  $tutTag = $root->appendChild($xmlDoc->createElement("Registration"));
		           
		  //create the author attribute
		  $tutTag->appendChild(
		    $xmlDoc->createAttribute("author"))->appendChild(
		      $xmlDoc->createTextNode($tut->author));
		   
		  //create the title element
		  $tutTag->appendChild(
		    $xmlDoc->createElement("Title", $tut->title));
		   
		  //create the date element
		  $tutTag->appendChild(
		    $xmlDoc->createElement("Date", $tut->date));
		
		  //create the categories element
		  $catTag = $tutTag->appendChild(
		              $xmlDoc->createElement("UserInfos"));
		
		  //create a category element for each category in the array
		  foreach($tut->data as $key=>$cat)
		  {
		    $catTag->appendChild(
		      $xmlDoc->createElement($key, $cat));
		  }
	}
	
	header("Content-Type: text/plain");
	
	//make the output pretty
	$xmlDoc->formatOutput = true;
	
	echo $xmlDoc->saveXML();
	//Save the xml files.
	$myFile = "user_info.xml";
	$fh = fopen($myFile, 'w') or die("can't open file");
	$stringData =  $xmlDoc->saveXML();
	fwrite($fh, $stringData);
	
	fclose($fh);
?>