<?php
	session_start();

	echo
	"
	<link rel='icon' type'image/x-icon' href='./img/favicon.ico'>
	";

	$conn = new PDO('mysql:host=localhost;dbname=waybackmachine', 'root', '');
	
	$username = $_POST['username'];
	$password = $_POST['password'];

	$sqlSelect = "SELECT PasswordHash, Role FROM `users` WHERE Username = \"$username\"";
	
	$querySelect = $conn->query($sqlSelect) or die("failed!");
	
	$databasedata = $querySelect->fetch(PDO::FETCH_ASSOC);
	
	$userPasswordHash = $databasedata['PasswordHash'];
	if(password_verify($password, $userPasswordHash)) 
	{
		$_SESSION['username'] = $username;
		$_SESSION['role'] = $databasedata['Role'];
		
		include 'mainPage.html';
	}
	else echo 'Wrong password';
?>