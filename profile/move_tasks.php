<?php 
    include("../db-connect.php");
    $uid = $_COOKIE['PHPSESSDI'];
    $task_id = $_POST['task_id'];
    switch($_POST['name']) {
        case 'student-move-to-do': {
            $con->query("UPDATE `workflow` SET `status` = 2 WHERE `studentId` = $uid AND `taskId` = $task_id");
            break;
        }
        case 'move-to-do': {
            $con->query("UPDATE `tasks` SET `status` = 2 WHERE `id` = $task_id");
            break;
        }
        case 'student-move-doing': {
            $con->query("UPDATE `workflow` SET `status` = 3 WHERE `studentId` = $uid AND `taskId` = $task_id");
            break;
        }
        case 'move-doing': {
            $con->query("UPDATE `tasks` SET `status` = 3 WHERE `id` = $task_id");
            break;
        }
        case 'student-move-doing-back': {
            $con->query("UPDATE `workflow` SET `status` = 1 WHERE `studentId` = $uid AND `taskId` = $task_id");
            break;
        }
        case 'move-doing-back': {
            $con->query("UPDATE `tasks` SET `status` = 1 WHERE `id` = $task_id");
            break;
        }
        case 'student-move-done-back': {
            $con->query("UPDATE `workflow` SET `status` = 2 WHERE `studentId` = $uid AND `taskId` = $task_id");
            break;
        }
         case 'move-done-back': {
            $con->query("UPDATE `tasks` SET `status` = 2 WHERE `id` = $task_id");
            break;
        }
    }

    echo 'done';
?>