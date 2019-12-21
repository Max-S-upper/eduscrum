<?php
include("../db-connect.php");
$uid = $_COOKIE['PHPSESSDI'];
$grade = $_POST['grade'];
$dataStudentId = $_POST['dataStudentId'];
$dataTaskId = $_POST['dataTaskId'];
$con->query("UPDATE `workflow` SET `grade` = $grade WHERE `studentId` = $dataStudentId AND `taskId` = $dataTaskId");
echo 1;