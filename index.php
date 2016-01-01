<?php 

	//https://github.com/KnpLabs/php-github-api/blob/master/doc/repos.md
	
	require_once 'vendor/autoload.php';
	$client = new \Github\Client();

	$repos = $client->api('user')->repositories('ICE-WOLF');

	//print_r ($repos);


	$following = $client->api('user')->following('ICE-WOLF');
	//print_r($following[3]);

	$followers = $client->api('user')->followers('ICE-WOLF');
	print_r($followers[3]);

 ?>