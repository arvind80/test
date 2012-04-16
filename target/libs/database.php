<?php
class Database {
	// class public variable
	var $db_host = "";
	var $db_user = "";
	var $db_password = "";
	var $db_port = "";
	var $db_name = "";
	var $db_query = "";
	var $record_count='';
	var $last_insert_id='';
	var $debug='';
	
	//constructor.
	public function __construct(){
		$this->db_host = DATABASE_HOST;
		$this->db_user = DATABASE_USERNAME;
		$this->db_password = DATABASE_PASSWORD;
		$this->db_port = DATABASE_PORT;
		$this->db_name = DATABASE_NAME;
		$this->debug = true;
	}
	// open database connection
	function openDatabase(){
		
		$result = @mysql_pconnect($this->db_host.":".$this->db_port, $this->db_user, $this->db_password);
		if(mysql_errno() == 1203) {
		  // 1203 == ER_TOO_MANY_USER_CONNECTIONS (mysqld_error.h)
		  print "Your request could not be processed due to high server traffic.<br><br>&nbsp;Please try refreshing the page again, by using your browser's refresh/ reload button, or <a href='javascript:window.location.reload();'>Click Here</a> to refresh the page.";
		  exit;
	}
		if(! $result){
			//print '<!-- '."\n".mysql_error().'-->'; 
			exit();
		}
		return $result;
	}
	
	function createDatabase($name){
		mysql_create_db($name, $this->openDatabase());
	}
	
	//execute query like insert, update or delete.	
	function updateQuery(){
		$link_id = $this->openDatabase();
		if(true == $this->debug) 
		$result = mysql_db_query ($this->db_name, $this->query, $link_id);
		if(!$result){
			print mysql_error();
			exit();
		}
		$this->last_insert_id = mysql_insert_id($link_id);
		mysql_close($link_id);
		return $result;
	}
	
	function listFields(){
		$link_id = $this->openDatabase();
		if(true == $this->debug) 
			print '<!--'."\nGetting fields from:".$this->table.'-->';
		$result = mysql_list_fields($this->db_name, $this->table, $link_id);
		if(!$result){
			print mysql_error();
			exit();
		}
		$this->count_fields= mysql_num_fields($result);
		mysql_close($link_id);
		return $result;
	}
	//fetch query and return object.
	function fetchQuery(){
		$link_id = $this->openDatabase();
		
		$result = mysql_db_query ($this->db_name, $this->db_query, $link_id);
		if(! $result){
			//print '<!--'."\n".mysql_error().'-->';
			exit();
		}
		$record_count=mysql_num_rows($result);
		if($record_count){
			while($obj=mysql_fetch_object($result)){
			 $row[]=$obj;
			}// end of while
		}else{
			while($fields=mysql_fetch_field($result)){
				$column_name = $fields->name;
				$row[0]->$column_name="";
			}// end of while
		}// end of record count
		$this->record_count = $record_count;
		$this->last_insert_id = mysql_insert_id($link_id);
		mysql_close($link_id);
		return $row;
	}
	function execQry($qStr){
		$link_id = $this->openDatabase();
		//if(true == $this->debug) print '<!--'."\nUpdating:".$qStr.'-->';
		$result = mysql_db_query ($this->db_name, $qStr, $link_id);
		if(!$result)
			return 0;
		return $result;
    }
	function fetchObj($res){
	  return mysql_fetch_object ($res);
	}
	function fecthRow($res){
	  return mysql_fetch_array($res);
	}
	function numRows($res){
	  return mysql_num_rows($res);
	}
	function last_insert_id(){
	  return mysql_insert_id();
	}
	function affectedRow($res){
	  return mysql_affected_rows($res);
	}
	function numFields($res){
	  return mysql_num_fields($res);
	}
	function fetchField($res){
	  return mysql_fetch_field($res);
	}
}
?>
