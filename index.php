<?php 
	
	require_once 'vendor/autoload.php';
	$client = new \Github\Client();

	$repos = $client->api('user')->repositories('ICE-WOLF');

	var_dump($repos);




 ?>