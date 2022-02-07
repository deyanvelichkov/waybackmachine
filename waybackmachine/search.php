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
	$searchDate = $_GET['searchDate'];
	
	$conn = new PDO('mysql:host=localhost;dbname=waybackmachine', 'root', '');
	
	if($_SESSION['role'] == 'admin')
		$sqlSearch = "SELECT * FROM `websitedata` WHERE `Address`=\"$searchAddress\" AND `WebsiteTitle`=\"$searchTitle\" AND UNIX_TIMESTAMP(LastUpdated)=\"$searchDate\"";
	else
		$sqlSearch = "SELECT * FROM `websitedata` WHERE `Address`=\"$searchAddress\" AND `WebsiteTitle`=\"$searchTitle\" AND UNIX_TIMESTAMP(LastUpdated)=\"$searchDate\" AND (`Username`='".$_SESSION['username']."' OR `Username`='')";
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
		<th>Username</th>
		<th>View</th>
		<th>Download</th>
	</tr>';
	
	foreach ($databasedataSearch as $row => $data)
	{
		echo 
		'<tr>
			<td>'.$data['ID'].'</td>
			<td>'.$data['Address'].'</td>
			<td>'.$data['WebsiteTitle'].'</td>
			<td>'.$data['LastUpdated'].'</td>
			<td>'.$data['Username'].'</td>
			<td><button><a href=\"http://localhost/waybackmachine/waybackmachine/?adress='.$data["Address"].'&name='.$data["WebsiteTitle"].'&date='.$data["LastUpdated"].'&mode="view"\">View</a></button></td>
			<td><button><a href=\"http://localhost/waybackmachine/waybackmachine/?adress='.$data["Address"].'&name='.$data["WebsiteTitle"].'&date='.$data["LastUpdated"].'&mode="download"\">Download</a></button></td>
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