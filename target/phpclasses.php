<?php 
class a{
 	public  $var;
 	private $priv;
 	const   STAT = 'S' ; // no dollar sign for constants (they are always static)
	public static  $stat;
    protected   $prot;
    public static $foo = 'I am foo';
	// constructor
    public function __construct() {
        $this->age = 0;
        $this->weight = 100;
        $this->var = $this->var.'a default value';
        $this->priv='private';
        ++$this->stat;
        $this->protected='protected';
    }
	public static function getFoo() 
	{ 
		echo "Static variable inside a static function:-".self::$foo;    
	}
    public static function setFoo() 
	{ 
		self::$foo='setting static variable';    
	}
	// property declaration
    // method declaration
     function displayVar() {
     	echo "upper class".'<br>';
     	echo $this->age.'<br>';
        echo $this->var.'<br>';
        echo $this->priv.'<br>';
        echo $this->stat.'<br>';
        echo $this->protected.'<br>';
        echo $this->STAT.'<br>';
    }
}
class b extends a
{
	public function __construct() {
        parent::__construct();
        $this->height = 100;
        ++$this->stat;
    }
	function displayVar() {
			//a::displayVar();	
			parent::displayVar();
			echo "Lower class".'<br>';
	        echo $this->var.'<br>';;
	        echo  $this->height.'<br>';;
        	echo $this->stat.'<br>';;
        	echo $this->protected.'<br>';;
	    }
}
$obj=new b();
$obj1=&$obj;
$obj1->displayVar();
//calling static function.
a::setFoo();
a::getFoo();
?>