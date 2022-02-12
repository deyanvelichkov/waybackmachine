<?php
	echo
	"
	<link rel='icon' type'image/x-icon' href='./favicon.ico'>
	";

	session_start();
	session_unset();
	session_destroy();
	include 'index.html';
?>