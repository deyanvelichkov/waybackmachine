<?php
	session_start();
	error_reporting(E_ALL ^ E_WARNING);
	echo 
	"
	<link rel='stylesheet' href='./styles.css' type='text/css'>
	<!--<script src='script.js'></script>-->
	";

	echo
	"
	<link rel='icon' type'image/x-icon' href='./favicon.ico'>
	";

	$address = $_GET['address'];
	$title = $_GET['title'];
	$mode = $_GET['mode'];
	$date = $_GET['date'];
	if($title != "")
	{
		$saved_location_1 = "./saved/$title.html";
	}
	else $saved_location_1 = "./saved/$address.html";

	$conn = new PDO('mysql:host=localhost;dbname=waybackmachine', 'root', '');
	
	if ($date == "") {
		$sqlSelect_find_to_process_count = "SELECT COUNT(*) FROM `websitedata` WHERE `Address`=\"$address\" OR `WebsiteTitle`=\"$title\" ORDER BY `LastUpdated` DESC LIMIT 1";
		$sqlSelect_find_to_process = "SELECT * FROM `websitedata` WHERE `Address`=\"$address\" OR `WebsiteTitle`=\"$title\" ORDER BY `LastUpdated` DESC LIMIT 1";
	} else 
{		$sqlSelect_find_to_process_count = "SELECT COUNT(*) FROM `websitedata` WHERE (`Address`=\"$address\" OR `WebsiteTitle`=\"$title\") AND `LastUpdated` LIKE \"%$date%\" ";
		$sqlSelect_find_to_process = "SELECT * FROM `websitedata` WHERE (`Address`=\"$address\" OR `WebsiteTitle`=\"$title\") AND `LastUpdated` LIKE \"%$date%\" ";
	}
	
	// if($argv[1] == "add")
	// {
	// 	add();
	// }
	
	if ($mode=="add")
	{
		$cmd = "wget -q -O \"$saved_location_1\" \"$address\"";
		exec($cmd);
		// uncomment when using usernames!!!!!
		$sqlInsertInto = "INSERT INTO `websitedata` (`Address`, `WebsiteTitle`, `ArchiveAddress`, `Username`) VALUES ('".$address."','" .$title."','" .$saved_location_1."','" .$_SESSION['username']."')";
		//$sqlInsertInto = "INSERT INTO `websitedata` (`Address`, `WebsiteTitle`, `ArchiveAddress`) VALUES ('".$address."','" .$title."','" .$saved_location_1."')";
		$queryInsertInto = $conn->query($sqlInsertInto) or die("failed!");
		//$time_between_adds = $_GET['timebetweenadds']; //КОЛЕГА, ТУК МИСЛЯ СИ ТИ
		//$command = 'schtasks /Create /SC MINUTE /MO '.$time_between_adds.' /TN "$title'.'Schedule'.'" /TR "./update.bat"';
		//system($command);
	}
	else if ($mode=="download")
	{
		// echo($conn->query($sqlSelect_find_to_process_count));
		if ($res = $conn->query($sqlSelect_find_to_process_count)) {

		    /* Check the number of rows that match the SELECT statement */
		    if ($res->fetchColumn() > 0) {

		        /* Issue the real SELECT statement and work with the results */

				$querySelect_find_to_download = $conn->query($sqlSelect_find_to_process) or die("failed!");
				$to_be_downloaded = $querySelect_find_to_download->fetch(PDO::FETCH_ASSOC);

				$file_location = $to_be_downloaded['ArchiveAddress'];
				$file_name = substr($file_location, strpos($file_location, "saved/") + 6);
		        if (file_exists($file_location)) {

		            header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
		            header("Cache-Control: public"); // needed for internet explorer
		            header("Content-Type: text/html");
		            header("Content-Transfer-Encoding: Binary");
		            header("Content-Length:".filesize($file_location));
		            header("Content-Disposition: attachment; filename=$file_name");
		            readfile($file_location);
		            die();        
		        } else {
		            die("Error: File not found.");
		        } 
		    }
		    /* No rows matched -- do something else */
		    else {
		        print "No rows matched the query.";
		    }
		}
	}
	else if ($mode == "view") {

		if ($res = $conn->query($sqlSelect_find_to_process_count)) {

		    /* Check the number of rows that match the SELECT statement */
		    if ($res->fetchColumn() > 0) {

		        /* Issue the real SELECT statement and work with the results */

				$querySelect_find_to_preview = $conn->query($sqlSelect_find_to_process) or die("failed!");
				$to_be_previewed = $querySelect_find_to_preview->fetch(PDO::FETCH_ASSOC);

				$file_location = $to_be_previewed['ArchiveAddress'];
				$url_name_to_be_proc = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
				$url_name = substr($url_name_to_be_proc, 0 ,strpos($url_name_to_be_proc, "machine.php"))."$file_location";
				header("Location: $url_name");
		        } else {
		            die("Error: File not found.");
		        } 
		    }
		    /* No rows matched -- do something else */
		    else {
		        print "No rows matched the query.";
		    }
		die();
	}
	echo 
	"<button><a href='./mainPage.html'>Return to menu</a></button>";
?>