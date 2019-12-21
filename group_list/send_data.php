<?php
include("../db-connect.php");
$uid = $_COOKIE['PHPSESSDI'];
$personalTask = $_POST['personalTask'];
$dataStudentId = $_POST['dataStudentId'];
$dataTaskId = $_POST['dataTaskId'];
$con->query("UPDATE `workflow` SET `personalTask` = '$personalTask' WHERE `studentId` = $dataStudentId AND `taskId` = $dataTaskId");
echo 1;