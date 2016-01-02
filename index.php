<?php 

	//https://github.com/KnpLabs/php-github-api/blob/master/doc/repos.md
	
	require_once 'vendor/autoload.php';
	$client = new \Github\Client();

	$repos = $client->api('user')->repositories('ICE-WOLF');// Gets all repos of ICE-WOLF

	//print_r ($repos);


	$following = $client->api('user')->following('ICE-WOLF');//Gets all users ICE-WOLF is following
	//print_r($following[3]);

	$followers = $client->api('user')->followers('ICE-WOLF');//Gets all users that are following ICE-WOLF
	//print_r($followers[3]);

	$languages = $client->api('repo')->languages('ICE-WOLF', 'phpcodelink');//Gets all the languages of repo phpcodelink belonging to ICE-WOLF
	print_r($languages);//http://php.net/manual/en/function.array-keys.php


 ?>