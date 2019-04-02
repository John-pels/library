<?php
$hostServer = 'localhost';
$username = 'root';
$password = '';
$databaseName = 'books_library';
$con = mysqli_connect($hostServer, $username, $password, $databaseName) or die('Connection Failed: '. mysqli_error());
?>