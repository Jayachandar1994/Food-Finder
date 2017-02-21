<?php 
	require_once("generateMap.php");
	require_once("generateMainPage.php");
	
	$title = "Food Finder"; 
	$map = generateMap("[\"\", \"\", 0.0, 0.0, \"\"]", $title);
	echo generatePage($map, $title);
?>