<?php
	session_start();

	echo
	"
	<link rel='icon' type'image/x-icon' href='./favicon.ico'>
	";

	$conn = new PDO('mysql:host=localhost;dbname=waybackmachine', 'root', '');
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	$userPasswordHash = '';

	$sqlSelect = "SELECT PasswordHash, Role FROM `users` WHERE Username = \"$username\"";
	$sqlCount = "SELECT COUNT(*) FROM `users` WHERE `Username`=?";
	
	$querySelect = $conn->query($sqlSelect) or die("failed!");
	$queryCount = $conn->prepare($sqlCount);
	
	$databasedata = $querySelect->fetch(PDO::FETCH_ASSOC);
	$queryCount->execute([$username]);
	
	$dataCount = $queryCount->fetchColumn();
	
	if($dataCount == 0)
	{
		echo 'User not found';
		include 'index.html';
	}
	else 
	{
		$userPasswordHash = $databasedata['PasswordHash'];
	
		if(password_verify($password, $userPasswordHash)) 
		{
			$_SESSION['username'] = $username;
			$_SESSION['role'] = $databasedata['Role'];
			
			include 'mainPage.html';
		}
		else
		{			
			echo 'Wrong password';
			include 'index.html';
		}
	}
?>