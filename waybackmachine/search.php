<?php
	session_start();
	
	echo 
	"
	<link rel='stylesheet' href='./styles.css' type='text/css'>
	<!--<script src='script.js'></script>-->
	";

	echo
	"
	<link rel='icon' type'image/x-icon' href='./img/favicon.ico'>
	";

	$searchAddress = $_GET['searchAddress'];
	$searchTitle = $_GET['searchTitle'];
	
	$conn = new PDO('mysql:host=localhost;dbname=waybackmachine', 'root', '');
	
	if($_SESSION['role'] == 'admin')
		$sqlSearch = "SELECT * FROM `websitedata` WHERE `Address`=\"$searchAddress\" AND `WebsiteTitle`=\"$searchTitle\"";
	else
		$sqlSearch = "SELECT * FROM `websitedata` WHERE `Address`=\"$searchAddress\" AND `WebsiteTitle`=\"$searchTitle\" AND `AccountID`=".$_SESSION['accountid'];
	$querySearch = $conn->query($sqlSearch) or die("failed!");
	$databasedataSearch = $querySearch->fetchAll(PDO::FETCH_ASSOC);
	
	echo 
	"
	<style>
	td {border: 1px solid black; padding: 3px;}
	th {border: 1px solid black; padding: 3px; background-color: gray;}
	</style>
	";
	
	echo '<table>';
	echo 
	'<tr>
		<th>ID</th>
		<th>Website address</th>
		<th>Website title</th>
		<th>Time last updated</th>
		<th>Account ID</th>
	</tr>';
	
	foreach ($databasedataSearch as $row => $data)
	{
		echo 
		'<tr>
			<td>'.$data['ID'].'</td>
			<td>'.$data['Address'].'</td>
			<td>'.$data['WebsiteTitle'].'</td>
			<td>'.$data['LastUpdated'].'</td>
			<td>'.$data['AccountID'].'</td>
		</tr>';
	}
	echo '</table>';
	
	echo 
	"<button><a href='./mainPage.html'>Return to menu</a></button>";
	
	/*
	echo
	"
	<a href="./mainPage.html">
      <input type="submit"/>
    </a>
	";
	*/
?>