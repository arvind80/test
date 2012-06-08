<?php

$table_name = false;
$table_name = TABLE_PREFIX . "cacaomail_mails_to_send_log";
$query = $this->db->query ( "show tables like '$table_name'" );
$query = $query->row_array ();
$query = (array_values ( $query ));
if ($query [0] != $table_name) {
	$sql = "CREATE TABLE " . $table_name . " (
						id int(11) NOT NULL auto_increment,
						UNIQUE KEY id (id)
						);";
	$this->db->query ( $sql );
}

$sql = "show tables like '$table_name'";
$query = $this->db->query ( $sql );
$query = $query->row_array ();
$query = (array_values ( $query ));

if ($query [0] == $table_name) {
	//$columns = $db->fetchAll("show columns from $table_name");
	$sql = "show columns from $table_name";
	$query = $this->db->query ( $sql );
	$columns = $query->result_array ();
	
	$exisiting_fields = array ( );
	foreach ( $columns as $fivesdraft ) {
		$fivesdraft = array_change_key_case ( $fivesdraft, CASE_LOWER );
		$exisiting_fields [strtolower ( $fivesdraft ['field'] )] = true;
	}
	$fields_to_add = array ( );
	$fields_to_add [] = array ('mail_id', "int(11) default NULL" );
	$fields_to_add [] = array ('account_id', "int(11) default NULL" );
	$fields_to_add [] = array ('campaign_id', "int(11) default NULL" );
	$fields_to_add [] = array ('feed_id', "int(11) default NULL" );
	$fields_to_add [] = array ('job_email', "varchar(1500) default NULL" );
	$fields_to_add [] = array ('mailsent_date', 'datetime default NULL' );
	$fields_to_add [] = array ('mailread_date', 'datetime default NULL' );
	
	$fields_to_add [] = array ('updated_on', 'datetime default NULL' );
	//$fields_to_add[] = array( 'is_active',   'int(1) default 1');
	//$fields_to_add[] = array( 'limit_per_day',   'int(100) default NULL');
	

	foreach ( $fields_to_add as $the_field ) {
		$sql = false;
		$the_field [0] = strtolower ( $the_field [0] );
		if ($exisiting_fields [$the_field [0]] != true) {
			$sql = "alter table $table_name add column {$the_field[0]} {$the_field[1]} ";
			$this->db->query ( $sql );
		} else {
			$sql = "alter table $table_name modify {$the_field[0]} {$the_field[1]} ";
			$this->db->query ( $sql );
		}
	
	}

}

$sql = "SHOW INDEXES FROM $table_name 	";
//print $sql; 
$query = $this->db->query ( $sql );
$query = $query->result_array ();
$query = array_change_key_case ( $query, CASE_LOWER );
$indexes = array ( );
foreach ( $query as $item ) {
	$item = array_change_key_case ( $item, CASE_LOWER );
	$indexes [] = $item ['key_name'];
}

if (in_array ( 'job_email', $indexes ) == false) {
	$q = "ALTER IGNORE TABLE $table_name ADD FULLTEXT KEY job_email (job_email)  ";
	$this->db->query ( $q );
}

?>