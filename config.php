<?php 

session_start();

include_once 'function.php';

$title = "Pathfinder Character";


if($_SERVER["HTTP_HOST"] == "localhost") {
	$route = "/charcreator/";
	$mysqlHost="localhost";
	$mysqlDB="pathfinder";
	$mysqlUser="root";
	$mysqlPass="";
} else if($_SERVER["HTTP_HOST"] == "jsostaric.byethost32.com") {
	$route = "/ljetni-zadatak/";
	$mysqlHost="sql212.byethost.com";
	$mysqlDB="nova baza";
	$mysqlUser="user";
	$mysqlPass="password";
} else {
	$route = "/";
}


try{
	$conn = new PDO("mysql:host=".$mysqlHost.";dbname=". $mysqlDB, $mysqlUser, $mysqlPass);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$conn->exec("SET CHARACTER SET utf8");
	$conn->exec("SET NAMES utf8");
}catch(PDO_Exception $e){
	echo "Somethin went wrong!";
}
