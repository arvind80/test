<?php
//---------------------------Dynamic Variable----------------------------------------------------
	$user=42+2;
	echo "$user<br>";
	$holder="user";//dynamic variable
	$test="holder";

	echo "${$holder}<br>";
	echo "$$holder<br>";

	echo "${$test}<br>";
	echo "$$test<br>";

	echo "$$$test<br>";

	echo "${${$test}}<br>";
	echo "${$$test}<br>";
	echo "<br>";
//-----------------------------------Variables Are Assigned by Value-----------------------------
	$aVariable="Testing";
	$anotherVariable=$aVariable;  //a copy of the contents of $aVariable is placed in $anotherVariable
	$aVariable="test";
	echo "Value of anotherVariable is $anotherVariable<br> ";
	echo "<br>";


//-----------------------------Reference Variable----------------------------------------------------

$varName="Testing";
$firstname=&$varName;      // a reference to $varName to be assigned to $firstname
$varName="test";
echo "Value of firstname is $firstname<br>";


//------------------------------To test the type of the variable-------------------------------------------

$var=10;
echo "Result of gettype() function is "."(1) ".gettype($firstname)." <br>"."(2) ".gettype($var)."<br>";
echo "<br>";

//----------------------------To Change the type of the variable-----------------------------------------

 $user1 = 3.14;
 echo gettype( $user1 ); // double
 echo " $user1<br>";
 settype( $user1, "string" );
 echo gettype( $user1 ); // string
 echo " $user1<br>"; 
 settype( $user1, "integer" );
 echo gettype( $user1 ); // integer
 echo " $user1<br>"; 
 settype( $user1, "Double" );
 echo gettype( $user1 ); // double
 echo " $user1<br>"; 
 settype( $user1, "boolean" );
 echo gettype( $user1 ); // boolean
 echo " $user1<br>"; 

 //---------------------------Casting---------------------------------------------------------------------


echo "------------------------Casting-----------------------------------<br>";
$undecided = 3;
 $holder = ( double ) $undecided;
 echo gettype( $holder ) ; // double
 echo " $holder<br>"; 
 $holder = ( string ) $undecided;
 echo gettype( $holder ); // string
 echo "$holder<br>"; 
 $holder = ( integer ) $undecided;
 echo gettype( $holder ); // integer
 echo "$holder<br>"; 
 $holder = ( double ) $undecided;
 echo gettype( $holder ); // double
 echo "$holder<br>"; 
 $holder = ( boolean ) $undecided;
 echo gettype( $holder ); // boolean
 echo "$holder<br>";

//The difference between settype() and a cast is the fact that casting produces a copy,leaving the original variable untouched.

//----------------------------Constant----------------------------------------------------------------------


define("USER","hello world");
echo "----------------------Constant-------------------------<br>";
echo "Constant Variable ".USER."<br>";

//----------------------------Operator-----------------------------------------------------------------------

$var1="12";
$var2=12;
echo "<br>----------------------Result of Equivalence(==) & Identical(===) operator-------------------------<br>";
if($var1==$var2)
{
	echo "<br>Right side value equal to Left Side value<br>";
}
else
{
	echo "Right side value not equal to Left Side value<br>";
}

if($var1===$var2)
{
	echo "Right side value equal to Left Side value and same data type<br>";
}
else
{
	echo "Right side value equal to Left Side value but not same data type<br>";
}
/*

//----------------------------------Returning Values from User-Defined Functions------------------------------------------------------------
echo "<br>-----------------------------function-----------------------------------<br>";
function  addNum($a,$b)
{
	$sum=$a+$b;
	return $sum; 
}
$result=addNum(12,16);
echo "<br>Function Return value is $result<br>";

//---------------------------------Calling a Function Dynamically-----------------------------------------------------
function sayHello($a)
 {
 echo "Dynamic function value is ";
 echo "$a<br>";
 }
 $function_holder = "sayHello";
 $function_holder(25);
 
//-------------------------------Variable Scope--------------------------------------------------------------------------

//-------------------------------A Variable Declared Within a Function Is Unavailable Outside the Function------------------


 $testvariable="hello world";
 
 function test()
{
	$testvariable="testing";
	echo "<h4>$testvariable</h4><br>" ;
 }
 test();
 echo "test variable: $testvariable<br>";

 //--------Using the global Statement to Remember the Value of a Variable Between Function Calls-----------------


 $num_of_calls = 0;

 function andAnotherThing( $txt )
 {
 global $num_of_calls;
 $num_of_calls++;
 echo "Global value is <h4>$num_of_calls. $txt</h4>";
 }
 echo "<b>First call to andAnotherThing function</b><br>";
 andAnotherThing("hello");
 echo "<b>Second call to andAnotherThing function</b><br>";
 andAnotherThing("world");





function anotherThing()
 {
	  global $num_of_calls;
	  $num_of_calls++;

	  echo "Global statement value is <h4>$num_of_calls</h4><br>";
 }
echo "<b>First call to anotherThing function</b>s<br>";
 anotherThing();


 //-----Using the static Statement to Remember the Value of a Variable Between Function Calls---------------------

 function static_statement()
 {
	 static $num;
	 $num++;
	 echo "static value is <h4>$num</h4><br>";
 }
 echo "<b>First call to static_statement function </b><br>";
 static_statement();
 echo "<b>Second call to static_statement function </b><br>";
 static_statement();

function static_statement1()
{
	static $num;
	$num++;
	 echo "<b>First call to static_statement1 function</b><br> ";
	 echo "static value is  <h4>$num</h4><br>";
}

static_statement1(); 
/*
//--------------------------A Function with an Optional Argument--------------------------------

function fontWrap( $txt, $num=3 )
 {
echo "<h4>$num . $txt</h4>";

 }
 fontWrap("A heading<br>",5);
 fontWrap("some body text<br>");
 fontWrap("some more body text<br>");

 //-----------------------Passing an Argument to a Function by Value----------------------------

 function addFive( $num )
 {
 $num += 5;
 }
 $orignum = 10;
 addFive( $orignum );
 echo "$orignum<br>";


//---------------------a Function Definition to Pass an Argument to a Function by Reference--------------------------

function addFive1( &$num )
 {
 $num += 5;
 }
 $num1 = 10;
 addFive1( $num1 );
 echo "$num1<br>"; 

*/
 
 ?>