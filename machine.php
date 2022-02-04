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

	$address = $_GET['address'];
	$title = $_GET['title'];
	$mode = $_GET['mode'];
	$saved_location = "./saved/\"$title\".html";
	$saved_location_1 = "./saved/$title.html";
	//echo 'Website at <b>'.$address.'</b> has been archived!<br>';
	//echo '<br>';

	$conn = new PDO('mysql:host=localhost;dbname=waybackmachine', 'root', '');
	
	/*INSERT INTO `websitedata` (`ID`, `Address`, `WebsiteTitle`, `ArchiveAddress`, `LastUpdated`, `UpdateTime`, `AccountID`) 
						 VALUES (NULL, 'abc', 'ABC', '', current_timestamp(), NULL, NULL)*/
	if($_SESSION['role'] == 'admin')
		$sqlSelect = "SELECT * FROM `websitedata`";
	else
		$sqlSelect = "SELECT * FROM `websitedata` WHERE `AccountID`=".$_SESSION['accountid'];
		$sqlInsertInto = "INSERT INTO `websitedata` (`Address`, `WebsiteTitle`, `ArchiveAddress`) VALUES (\'$address\',\'$title\',\'$saved_location_1\')";

	//when adding gets done, and the query is edited to add all the data, this will add the info to the database
	//$queryInsertInto = $conn->query($sqlInsertInto) or die("failed!");
	$querySelect = $conn->query($sqlSelect) or die("failed!");
	
	$databasedata = $querySelect->fetchAll(PDO::FETCH_ASSOC);
	
	if ($mode=="add")
	{
		$cmd = "wget -q -O \"$saved_location\" \"$address\"";
		exec($cmd);
		
		$queryInsertInto = $conn->query($sqlInsertInto) or die("failed!");
	}
	if ($mode=="download")
	{
		if($_SESSION['role'] == 'admin')
			$sqlSelect_find_to_download = "SELECT * FROM `websitedata` WHERE `Address`=\"$address\" OR `WebsiteTitle`=\"$title\" ORDER BY `LastUpdated` DESC LIMIT 1";
		else
			$sqlSelect_find_to_download = "SELECT * FROM `websitedata` WHERE (`Address`=\"$address\" OR `WebsiteTitle`=\"$title\") AND `AccountID`=".$_SESSION['accountid']." ORDER BY `LastUpdated` DESC LIMIT 1";
	
		$querySelect_download = $conn->query($sqlSelect_find_to_download) or die("failed!");
		$databasedata_download = $querySelect_download->fetchAll(PDO::FETCH_ASSOC);
		
		//you can use fetch, cause it's 1 result, and fetch gives you one each time, fetchAll - all of them, your choice
		
		echo '<table>';
		echo 
		'<tr>
			<th>ID</th>
			<th>Website address</th>
			<th>Website title</th>
			<th>Time last updated</th>
			<th>Account ID</th>
		</tr>';
		
		foreach ($databasedata_download as $row => $data)
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
	}
	else 
	{
		
		echo '<table>';
		echo 
		'<tr>
			<th>ID</th>
			<th>Website address</th>
			<th>Website title</th>
			<th>Time last updated</th>
			<th>Account ID</th>
		</tr>';
		
		foreach ($databasedata as $row => $data)
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
	}
	
	echo 
	"<button><a href='./mainPage.html'>Return to menu</a></button>";
?>