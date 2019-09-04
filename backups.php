<?php
function backup_mysql_database($options) {
	$mtables = array ();
	$contents = "-- Database: `" . $options ['db_to_backup'] . "` --\n";
	
	$mysqli = new mysqli ( $options ['db_host'], $options ['db_uname'], $options ['db_password'], $options ['db_to_backup'] );
	if ($mysqli->connect_error) {
		die ( 'Error : (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error );
	}
	
	$results = $mysqli->query ( "SHOW TABLES" );
	
	while ( $row = $results->fetch_array () ) {
		if (! in_array ( $row [0], $options ['db_exclude_tables'] )) {
			$mtables [] = $row [0];
		}
	}
	
	foreach ( $mtables as $table ) {
		$contents .= "-- Table `" . $table . "` --\n";
		
		$results = $mysqli->query ( "SHOW CREATE TABLE " . $table );
		while ( $row = $results->fetch_array () ) {
			$contents .= $row [1] . ";\n\n";
		}
		
		$results = $mysqli->query ( "SELECT * FROM " . $table );
		$row_count = $results->num_rows;
		$fields = $results->fetch_fields ();
		$fields_count = count ( $fields );
		
		$insert_head = "INSERT INTO `" . $table . "` (";
		for($i = 0; $i < $fields_count; $i ++) {
			$insert_head .= "`" . $fields [$i]->name . "`";
			if ($i < $fields_count - 1) {
				$insert_head .= ', ';
			}
		}
		$insert_head .= ")";
		$insert_head .= " VALUES\n";
		
		if ($row_count > 0) {
			$r = 0;
			while ( $row = $results->fetch_array () ) {
				if (($r % 400) == 0) {
					$contents .= $insert_head;
				}
				$contents .= "(";
				for($i = 0; $i < $fields_count; $i ++) {
					$row_content = str_replace ( "\n", "\\n", $mysqli->real_escape_string ( $row [$i] ) );
					
					switch ($fields [$i]->type) {
						case 8 :
						case 3 :
							if($row_content == ""){
								$contents .= "NULL";
							}
							$contents .= $row_content;
							break;
						case 10 :
						case 12 :
						default:
							if($row_content == ""){
								$contents .= "NULL";
							}else{
								$contents .= "'" . $row_content . "'";
							}
							break;
					}
					if ($i < $fields_count - 1) {
						$contents .= ', ';
					}
				}
				if (($r + 1) == $row_count || ($r % 400) == 399) {
					$contents .= ");\n\n";
				} else {
					$contents .= "),\n";
				}
				$r ++;
			}
		}
	}
	
	if (! is_dir ( $options ['db_backup_path'] )) {
		mkdir ( $options ['db_backup_path'], 0777, true );
	}
	
	$backup_file_name = $options ['db_to_backup'] . " sql-backup- " . date ( "d-m-Y--h-i-s" ) . ".sql";
	
	$fp = fopen ( $options ['db_backup_path'] . '/' . $backup_file_name, 'w+' );
	if (($result = fwrite ( $fp, $contents ))) {
		echo "Backup file created '--$backup_file_name' ($result)";
	}
	fclose ( $fp );
	return $backup_file_name;
}

$options = array (
		'db_host' => 'localhost', // mysql host
		'db_uname' => 'root', // user
		'db_password' => 'password', // pass
		'db_to_backup' => 'alpine', // database name
		'db_backup_path' => '/Applications/MAMP/htdocs/tradeshows/', // where to backup
		'db_exclude_tables' => array ('classcodes') 
) // tables to exclude
;
$backup_file_name = backup_mysql_database ( $options );