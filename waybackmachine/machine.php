<?php
	$address = $_GET['address'];
	$title = $_GET['title'];
	$mode = $_GET['mode'];
	$saved_location = "./saved/\"$title\".html";
	$saved_location_1 = "./saved/$title.html";
	echo 'Website at <b>'.$address.'</b> has been archived!<br>';
	echo '<br>';

	$conn = new PDO('mysql:host=localhost;dbname=waybackmachine', 'root', '');
	
	/*INSERT INTO `websitedata` (`ID`, `Address`, `WebsiteTitle`, `ArchiveAddress`, `LastUpdated`, `UpdateTime`, `AccountID`) 
						 VALUES (NULL, 'abc', 'ABC', '', current_timestamp(), NULL, NULL)*/
	
	$sqlSelect = "SELECT * FROM `websitedata`";
	$sqlInsertInto = "INSERT INTO `websitedata` (`Address`, `WebsiteTitle`, `ArchiveAddress`) VALUES ('".$address."','" .$title."','" .$saved_location_1."')";

	$queryInsertInto = $conn->query($sqlInsertInto) or die("failed!");
	$querySelect = $conn->query($sqlSelect) or die("failed!");
	
	$databasedata = $querySelect->fetchAll(PDO::FETCH_ASSOC);
	
	if ($mode=="add")
	{
		$cmd = "wget -q -O \"$saved_location\" \"$address\"";
		exec($cmd);
	}
	if ($mode=="download")
	{
		$sqlSelect_find_to_download = "SELECT * FROM `websitedata` WHERE `Address`=\"$address\" OR `WebsiteTitle`=\"$title\" ORDER BY `LastUpdated` DESC LIMIT 1";
		$querySelect_download = $conn->query($sqlSelect_find_to_download) or die("failed!");
		$databasedata_download = $querySelect_download->fetchAll(PDO::FETCH_ASSOC);
		foreach ($databasedata_download as $row => $data)
		{
			echo 'Auto-generated ID is <b>'.$data['ID'].'</b> and it is ... auto-generated.<br>';
			echo 'Website address is <b>'.$databasedata_download[$row]['Address'].'</b> and it looks cool ... for a website ... address!?<br>';
			echo 'Site title is <b>'.$databasedata_download[$row]['WebsiteTitle'].'</b> and it looks cool!<br>';
			echo 'It was last updated <b>'.$databasedata_download[$row]['LastUpdated'].'</b> and that\'s ... actually did we abandon that after the 16th?<br>';
			echo 'Account ID of the cool guy who wanted this archive is <b>'.$databasedata_download[$row]['AccountID'].'</b> and it is probably NULL.<br>';
			echo '<br>';
		}
	}
	else 
	{
		foreach ($databasedata as $row => $data)
		{
			echo 'Auto-generated ID is <b>'.$data['ID'].'</b> and it is ... auto-generated.<br>';
			echo 'Website address is <b>'.$databasedata[$row]['Address'].'</b> and it looks cool ... for a website ... address!?<br>';
			echo 'Site title is <b>'.$databasedata[$row]['WebsiteTitle'].'</b> and it looks cool!<br>';
			echo 'It was last updated <b>'.$databasedata[$row]['LastUpdated'].'</b> and that\'s ... actually did we abandon that after the 16th?<br>';
			echo 'Account ID of the cool guy who wanted this archive is <b>'.$databasedata[$row]['AccountID'].'</b> and it is probably NULL.<br>';
			echo '<br>';
		}
	}
?>