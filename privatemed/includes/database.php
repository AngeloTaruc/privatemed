<?php
error_reporting(0);
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'privatemed';
global $db_connection;
$db_connection = mysqli_connect($host,$user,$password) or die('Failed to connect to Database Server');
$db = mysqli_select_db($db_connection,$dbname);

function GetValue($sql_query) {
	global $db_connection;
	$result = mysqli_query($db_connection,$sql_query);
	$row = mysqli_fetch_array($result);
	return $row[0];

	
}
function isDBTableExist($dbname,$table) {
	return GetValue("SELECT COUNT(*)
			FROM information_schema.tables
			WHERE table_schema = '".$dbname."' 
				AND table_name = '".$table."'
			LIMIT 1;") + 0;
}
if (!isDBTableExist($dbname,'tbldoctor')) {
	mysqli_query($db_connection, 'CREATE TABLE tbldoctor(
	                                  doctorid int(11) NOT NULL AUTO_INCREMENT,
									  dlastname varchar(255) default \'\',
									  dfirstname varchar(255) default \'\',
									  middlename varchar(255) default \'\',
									  sex char(1) default \'M\',
									  emailaddress varchar(255) default \'\',
									  medstaff varchar(255) default \'\',
									  primary key(doctorid))');
									  
    mysqli_query($db_connection, 'CREATE TABLE tbluser(
									    userid int(11) NOT NULL AUTO_INCREMENT,
										doctorid int(11) default 0,
										user_name varchar(30) default \'\',
                                        password varchar(100) default \'\',
										primary key(userid))');
										
	mysqli_query($db_connection, 'CREATE TABLE tblmedicine(
									    mid int(11) NOT NULL AUTO_INCREMENT,
										medicinename varchar(255) default \'\',
										primary key(mid))');
										
	mysqli_query($db_connection, 'CREATE TABLE tblmedicine_details(
									    mdid int(11) NOT NULL AUTO_INCREMENT,
										med_quantity varchar(255) default \'\',
										mid int(11) default 0,
										primary key(mdid))');
										
	mysqli_query($db_connection, 'CREATE TABLE tblpatient(
									    pid int(11) NOT NULL AUTO_INCREMENT,
										doctorid int(11) default 0,
										lastname varchar(255) default \'\',
										firstname varchar(255) default \'\',
										middlename varchar(255) default \'\',
										sex char(1) default \'M\',
										age int(11),
										dateofbirth date,
										emailaddress varchar(255) default \'\',
										illness varchar(255) default \'\',
										primary key(pid))');									
				
	mysqli_query($db_connection, 'CREATE TABLE tblpatient_history(
									    phid int(11) NOT NULL AUTO_INCREMENT,
										pid int(11) default 0,
										appointment_id int(11) default 0,
                                        result_of_diagnosis varchar(255) default \'\',
										primary key(phid))');
									
	mysqli_query($db_connection, 'CREATE TABLE tblappointment(
									    appointment_id int(11) NOT NULL AUTO_INCREMENT,
										pid int(11) default 0,
										time_and_date date,
										primary key(appointment_id))');
}






?>