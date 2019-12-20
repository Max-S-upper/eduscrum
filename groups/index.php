<?php 
	if (isset($_COOKIE['PHPSESSDI'])) {
		include('../db-connect.php');
		include('groups.php');
		if (isset($_POST['crtSpeciality'])) {
			$name = $_POST['specialityName'];
			$term = $_POST['specialityTerm'];
			$abbreviation = $_POST['specialityNickName'];
			var_dump("INSERT INTO speciality(`name`, `term`, `abbreviation`) VALUES('$name', '$term', '$abbreviation')");
			$con->exec("INSERT INTO speciality(`name`, `term`, `abbreviation`) VALUES('$name', '$term', '$abbreviation')");
			header("Location: /groups");
		}

		if (isset($_POST['crtList'])) {
			$year = (intval(date('y')[1]) - intval($_POST['groupCourse']) + 1);
			if ($year < 0) $year = 10 + $year;
			$group = $_POST['groupSpeciality'] . '-' . $_POST['groupCourse'] . $_POST['edForm'] . $year;
			$con->exec("INSERT INTO groups(`name`) VALUES('$group')");
			header("Location: /groups");
		}
	}

	else header("Location: /");
?>