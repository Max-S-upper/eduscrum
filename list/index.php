<?php 
	if (isset($_COOKIE['PHPSESSDI'])) {
		session_start();
		$lid = $_SESSION['list_id'];
		include('../db-connect.php');
		include('list.php');
		if (isset($_POST['group_id'])) {
            $groupId = $_POST['group_id'];
            $_SESSION['group_id'] = $groupId;
			header('Location: /group_list');
		}
	}

	else header("Location: /");