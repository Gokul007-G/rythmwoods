<?php
define("Title", 'Music');
try {
	$con = new pdo ('mysql:host=localhost;dbname=neha','root','qwerty*B@Q2468#');
	//$con = new pdo ('mysql:host=localhost;dbname=pmg','root','');
} 
catch (Exception $e) 
{
	echo $e->getMessage();
}
?>