<?php
	$host = "localhost";
	$dbname = "waybackmachine";
	$root = "root";
	$pass = "";
	echo
	"
	<link rel='icon' type'image/x-icon' href='./favicon.ico'>
	";

	$conn = new PDO('mysql:host=$host;dbname=$dbname', '$root', '$pass');
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	$repeatPassword = $_POST['repeatPassword'];
	
	$sqlCount = "SELECT COUNT(*) FROM `users` WHERE `Username`=?";
	$queryCount = $conn->prepare($sqlCount);
	$queryCount->execute([$username]);
	$dataCount = $queryCount->fetchColumn();

	if($password != $repeatPassword)
	{
		echo "Passwords don't match";
		include 'index.html';
	}
	else if($dataCount != 0)
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