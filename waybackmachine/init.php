<?php
/* Create connection */
//
/* Check connection */
$host = "localhost";
$root = "root";
$root_password = "";
try {
    $dbh = new PDO("mysql:host=$host", $root, $root_password);

    $dbh->exec("CREATE DATABASE `waybackmachine`;")
    or die(print_r($dbh->errorInfo(), true));
}
catch (PDOException $e) {
    die("DB ERROR: " . $e->getMessage());
}

$conn = new PDO('mysql:host=localhost;dbname=waybackmachine', 'root', '');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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
('admin', '$2y$10$A9xaC/W0S7Zsa3W2CEyPOePbOcgOAe4wYa3jBkhoYkKZ4vW3/GoBS', 'admin'),
('name', '$2y$10$IBfXKhejNuQcOJ.2C8iVyeHk3o6AWo.S0v6wRW/zwbFq4Ma2I6Uaq', 'user'),
('username', '$2y$10$EwxAG87WFF3ameA8WflD6efZ1rJe68FBTq4yo1QdMZ8tounRs77se', 'user');";
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