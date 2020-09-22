<?php
$mysql_host = 'localhost';
$username   = 'root';
$password   = '1';
$database   = 'rss';

try
{
	$pdo = new PDO('mysql:host='.$mysql_host.';dbname='.$database, $username, $password );
}catch(PDOException $e)
{
	echo 'Połączenie nie mogło zostać utworzone.<br />';
}
?>


