<?php

function loadDatabase()
{
   $dbHost = "";
   $dbPort = "";
   $dbUser = "";
   $dbPassword = "";

   $openShiftVar = getenv('OPENSHIFT_MYSQL_DB_HOST');

	if ($openShiftVar === null || $openShiftVar == "")
	{
		// Not in the openshift environment
		//echo "Using local credentials: ";
		//require("setLocalDatabaseCredentials.php");
		$dbUser = "php";
		$dbPassword = "php-pass";
		$dbHost = "127.0.0.1";
		$dbName = "project";
		$dbPort = 3306;
	}
	else
	{
		// In the openshift environment
		//echo "Using openshift credentials: ";

		$dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');
		$dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT');
		$dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
		$dbPassword = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
		$dbName = "php";
	}

	//echo "host:$dbHost:$dbPort dbName:$dbName user:$dbUser password:$dbPassword<br />\n";


	$db = new PDO("mysql:host=$dbHost:$dbPort;dbname=$dbName", $dbUser, $dbPassword);

	return $db;
}

?>