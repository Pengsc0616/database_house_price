
<?php
//setting header to json
//header('Content-Type: application/json');
//print "hahaha";
//database
/*define('DB_HOST', 'localhost');

define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');I
define('DB_NAME', 'dn_name');

//get connection
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);*/
$db_host= "localhost";
//print "\nset db_host";
$db_user="root";
//print "\nset db_user";
$db_pass="";
//print "\nset db_pass";
$db_name="db_name";
//print "\nset db_name";
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
//print "\nall done create mysqli";
$mysqli->set_charset("utf8");////


if($mysqli){
	//print "Connection Okay";
}
if(!$mysqli){
	//print "Connection Fail";
	die("Connection failed: " . $mysqli->error);
}


$query = sprintf("SELECT district, AVG(unit_price) as price FROM test GROUP BY district");
$result = $mysqli->query($query);
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}
//free memory associated with result
$result->close();

//close connection
$mysqli->close();

//now print the data
print json_encode($data);
