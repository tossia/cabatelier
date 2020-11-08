<?php
include("../../inc/config.inc");

$_SESSION=array();
session_destroy();
//Add a record about user disconnection

header("location:../login.php");
die;
?>