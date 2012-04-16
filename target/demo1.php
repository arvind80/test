<html>
<head>
<title>Array</title>
</head>
<body>

<?php

//------------------Array-----------------------
$user=array("harry","marry","betty","lappy");
echo "$user[2]<br>";

echo "--------------foreach()-----------------<br>";
foreach($user as $val)
{
	echo "$val<br>";
}

$num[]="1";
$num[]="2";
$num[]="3";
echo "$num[1]<br>";
$use[]="hypertext Preprocessor";
echo "$use[0]<br>";

//-----------------------Multidimensional Array-------------------------
echo "---------------------Multidimensional Array-----------<br>";
$users=array(array("a","b","c"), array(1,2,3) ,array("e","f","g"));

foreach($users as $val)
{
	foreach($val as $var)
	{
		echo "$var<br>";
	}
}

//------------------------------ Associative Array-------------------------
echo "---------------------------Associative array-------------<br>";
$character = array("name" => "bob","qualification" => "MCA","age" => 23 );

echo $character['name']."<br>";
echo $character['qualification']."<br>";
echo $character['age']."<br>";
echo "------------------------Foreach() loop-------------------------------<br>";
foreach($character as $key=>$val)
{
	echo "$key=$val<br>";
}

//---------------------------Multidimensional Associative Array----------------

$characters = array (
 array ( "name"=>"bob", "qualification"=>"MCA", "age"=>21 ),
 array ( "name"=>"sally", "qualification"=>"MBA", "age"=>24 ),
 array ( "name"=>"mary", "qualification"=>"BCA", "age"=>20 )
 );
echo $characters[0]['name']."<br>";
echo $characters[2]['qualification']."<br>";
echo $characters[1]['age']."<br>";

//------------------------------Nested Foreach() loop------------------------
echo "------------------Nested foreach()---------------------<br>";
foreach($characters as $val)
{
	foreach($val as $key=>$var)
	{
		echo "$key=$var<br>";
		
	}
echo "----------------------------<br>";
} 
//--------------------Joining Two Arrays with array_merge()---------------------

echo "----------------Joining Two Arrays with array_merge()---------------<br>";
$first = array("a", "b", "c");
$second = array(1,2,3);
$third = array_merge( $first, $second );
foreach ( $third as $val )
{
echo "$val<BR>";
}

//--------Adding Multiple Variables to an Array with array_push()--------------

echo "---------Adding Multiple Variables to an Array with array_push()------------s<br>";

$first = array("a", "b", "c");
$total = array_push( $first, 1, 2, 3 );

foreach ( $first as $val )
{
echo "$val<BR>";
}

//-------Removing the First Element of an Array with array_shift()----------------

echo "-------------Removing the First Element of an Array with array_shift()-------<br>";

$an_array = array("a", "b", "c");
while ( count( $an_array) )
{
$val = array_shift( $an_array);
echo "$val<BR>";
echo "there are ".count($an_array)." elements in \$an_array <br>";
}

//----------Slicing Arrays with array_slice()------------------------

echo "-----------Slicing Arrays with array_slice()---------------------<br>";

$first = array("a", "b", "c", "d", "e", "f");
$second = array_slice($first, 2, 3);
foreach ( $second as $var )
{
echo "$var<br>";
}

//--------------Sorting Numerically Indexed Arrays with sort()----------------------

echo "-------Sorting Numerically Indexed Arrays with sort()-----------<br>";

$an_array = array("x","a","f","c");
sort( $an_array);
foreach ( $an_array as $var )
{
echo "$var<BR>";
}

//--------------------Sorting an Associative Array by Value with asort()--------------------------

echo "----------------Sorting an Associative Array by Value with asort()---------------<br>";

$first = array("first"=>"shiv","second"=>4.5,"third"=>1,"fourth"=>"5");
asort( $first );
foreach ( $first as $key => $val )
{
echo "$key = $val<BR>";
}

//-----------------Sorting an Associative Array by Key with ksort()-------------------

echo "----------------Sorting an Associative Array by Key with ksort()-------------------<br>";

$first = array("x"=>5,"a"=>2,"f"=>1);
ksort( $first );
foreach ( $first as $key => $val )
{
echo "$key = $val<BR>";
}
?>
 </form>
</body>
</html>