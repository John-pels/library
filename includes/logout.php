<?php
require_once "config.php";
?>

<?php
session_start();
session_destroy();
$_SESSION['id'] = array();
header("location: ../admin/index.php");

?>