<?php 
	if (isset($_COOKIE['PHPSESSDI'])) {
		include('../db-connect.php');
		include('lists.php');
		if (isset($_POST['crtList'])) {
			$listName = $_POST['listName'];
			$teacher = $_COOKIE['PHPSESSDI'];
			$query = $con->exec("INSERT INTO `lists`(`name`, `teacher`) VALUES('$listName', '$teacher')");
			$lid = $con->query("SELECT `id` FROM `lists` WHERE `name` = '$listName'")->fetch();
			$lid = $lid[0];
			for ($i = 0; $i < (int)$_POST['itemsQuant']; $i++) {
				$iName = $_POST['item'.$i];
				$con->exec("INSERT INTO `tasks`(`name`, `description`, `listId`) VALUES('$iName', 'test description', '$lid')");
			}

			$tasks = $con->query("SELECT `id` FROM `tasks` WHERE `listId` = $lid")->fetchAll();
			for ($j = 0; $j < (int)$_POST['groupsQuant']; $j++) {
				$group = $_POST['group'.$j];
				$con->query("INSERT INTO `group_lists`(`group_id`, `list_id`, `teacher_id`) VALUES('$group', '$lid', '$teacher')");
				$group = $_POST['group'.$j];
				$students = $con->query("SELECT `id` FROM `user` WHERE `group` = $group")->fetchAll();
				foreach($students as $student) {
					foreach($tasks as $task) {
						$task_id = $task[0];
						$student_id = $student[0];
						$con->exec("INSERT INTO `workflow`(`studentId`, `taskId`, `listId`) VALUES('$student_id', '$task_id', '$lid')");
					}
				}
			}

			header("Location: /lists");
		}

		else if (isset($_POST['list_id'])) {
			session_start();
			$_SESSION['list_id'] = $_POST['list_id'];
			header("Location: /list");
		}
	}

	else header("Location: /");
?>