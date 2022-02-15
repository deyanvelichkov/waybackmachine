<?php
/* Create connection */
//
/* Check connection */
$host = "localhost";
$root = "root";
$root_password = "";
$dbname= "waybackmachine";
try {
    $dbh = new PDO("mysql:host=$host", $root, $root_password);

    $dbh->exec("CREATE DATABASE `waybackmachine`;")
    or die(print_r($dbh->errorInfo(), true));
}
catch (PDOException $e) {
    die("DB ERROR: " . $e->getMessage());
}

$conn = new PDO('mysql:host=$host;dbname=$dbname', '$root', '$root_password', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

$sql = "CREATE TABLE `websitedata` (
  `ID` int(11) NOT NULL,
  `Address` varchar(256) NOT NULL,
  `WebsiteTitle` varchar(64) NOT NULL,
  `ArchiveAddress` varchar(256) NOT NULL,
  `LastUpdated` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdateTime` int(11) DEFAULT NULL,
  `Username` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

$conn->query($sql) or die("failed!");

$sql = "CREATE TABLE `users` (
  `Username` varchar(64) NOT NULL,
  `PasswordHash` varchar(256) NOT NULL,
  `Role` varchar(32) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

$conn->query($sql) or die("failed!");

$sql = "INSERT INTO `users` (`Username`, `PasswordHash`, `Role`) VALUES
('admin', '".password_hash('admin',PASSWORD_DEFAULT)."', 'admin'),
('name', '".password_hash('qwerty',PASSWORD_DEFAULT)."', 'user'),
('username', '".password_hash('password',PASSWORD_DEFAULT)."', 'user');";
$conn->query($sql) or die("failed!");

$sql = "ALTER TABLE `users`
  ADD PRIMARY KEY (`Username`);";
$conn->query($sql) or die("failed!");

$sql = "ALTER TABLE `websitedata`
  ADD PRIMARY KEY (`ID`);";
$conn->query($sql) or die("failed!");

$sql = "ALTER TABLE `websitedata`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;";
$conn->query($sql) or die("failed!");

$conn = null;
?>