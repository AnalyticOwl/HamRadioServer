<?php 
require	'../../vendor/autoload.php';
//include	'config.json';


  $config = file_get_contents('config.json');
  $config = json_decode($config);
$dbhost = $config->db->host;
$dbname = $config->db->name;
$dbuser = $config->db->user;
$dbpass = $config->db->pass;
  $dbConnection	=	new	PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
				$dbConnection->setAttribute(PDO::ATTR_ERRMODE,	PDO::ERRMODE_EXCEPTION);
  


?>