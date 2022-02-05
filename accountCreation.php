<?php

	echo
	"
	<link rel='icon' type'image/x-icon' href='./img/favicon.ico'>
	";

	$conn = new PDO('mysql:host=localhost;dbname=waybackmachine', 'root', '');
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	$repeatPassword = $_POST['repeatPassword'];
	
	$sqlSelect = "SELECT COUNT(*) FROM `users` WHERE `Username`=\"$username\"";
	$querySelect = $conn->query($sqlSelect) or die("failed!");

	if($password != $repeatPassword)
	{
		echo "Passwords don't match";
		include 'index.html';
	}
	else if($querySelect != 0)
	{
		echo "Username already in use";
		include 'index.html';
	}
	else
	{
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
		
		$sqlInsertInto = "INSERT INTO `users` (`Username`, `PasswordHash`) VALUES (\"$username\",\"$hashedPassword\")";
	
		$queryInsertInto = $conn->query($sqlInsertInto) or die("failed!");
		
		echo "Account creation successful";
		include 'index.html';
	}
?>