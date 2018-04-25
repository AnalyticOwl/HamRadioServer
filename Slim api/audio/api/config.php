<?php 
function getDB()	{
				$dbhost="109.203.112.164";
				$dbuser="atif_test";
				$dbpass="qKy1jB6fovd@u3n4d";
				$dbname="atif_audiodb";
				$dbConnection	=	new	PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
				$dbConnection->setAttribute(PDO::ATTR_ERRMODE,	PDO::ERRMODE_EXCEPTION);
				return	$dbConnection;
}

?>