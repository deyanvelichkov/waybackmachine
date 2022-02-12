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
	$searchRange = $_GET['searchRange'];
	$sqlSearch = "SELECT * FROM `websitedata` WHERE ";
	$prev = False;
	if ($searchAddress != "") {
		$sqlSearch .= "`Address`=\"$searchAddress\"";
		$prev = True;
	}
	if ($searchTitle != "") {
		if ($prev) {
			$sqlSearch .= " AND ";
		}
		$sqlSearch .= "`WebsiteTitle`=\"$searchTitle\"";
		$prev = True;
	}
	if ($searchDate != "") {
		if ($prev) {
			$sqlSearch .= " AND ";
		}
		$sqlSearch .= "LastUpdated LIKE\"%$searchDate%\"";
		$prev = True;
	}
	if ($sqlSearch == "SELECT * FROM `websitedata` WHERE ") {
		die("CANT SEARCH WITHOUT ADDING SOME INFO");
	}
	if ($searchRange == "local") {
		$sqlSearch .=  "AND `Username`='".$_SESSION['username']."'";
	}

	$conn = new PDO('mysql:host=localhost;dbname=waybackmachine', 'root', '');
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
			<td><button><a href="/waybackmachine/waybackmachine/machine.php?address='.$data["Address"].'&title='.$data["WebsiteTitle"].'&date='.$data["LastUpdated"].'&mode=view" >View</a></button></td>
			<td><button><a href="/waybackmachine/waybackmachine/machine.php?address='.$data["Address"].'&title='.$data["WebsiteTitle"].'&date='.$data["LastUpdated"].'&mode=download" >Download</a></button></td>
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