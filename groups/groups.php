<?php
	include("../db-connect.php");
	$uacces = '';
	$uid = $_COOKIE['PHPSESSDI'];
	if ($con->query("SELECT type FROM user WHERE id = '$uid'")->fetch()[0] == '0') $uacces = 1;
	else $uacces = 0;
?>
<!DOCTYPE html>
<html>
<head>
	<title>eduscrum</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../styles/index.css">
	<link rel="stylesheet" type="text/css" href="../styles/groups.css">
	<link rel="stylesheet" type="text/css" href="../styles/main.css">
</head>
<body>
	<header>
		<ul>
			<li><a href="/">Home</a></li>
			<li><a href="/lists">Lists</a></li>
			<li><a href="/groups">Groups</a></li>
		</ul>
		<div class="profile">
			<p><a href="/profile">Profile</a></p> <img src="../images/ico-profile.png" alt="profile"> <a href="/signOut.php">Sign out</a>
		</div>
	</header>
	<main>
		<div class="rightSideUl">
			<p> Специальности: </p>
			<li class="rightSideUlLi">
				<?php
					$id = $_COOKIE['PHPSESSDI'];
					$specialities = $con->query("SELECT * FROM speciality")->fetchAll();
					foreach($specialities as $speciality):
						$href = '../speciality?id='.$speciality['id'];
				?>
					<li><a href='<?= $href ?>'><?= $speciality['name'] ?></a></li>
				<?php endforeach; ?>
			</li>
		</div>
		<?php if ($uacces == 1): ?>
			<h1>Создание специальности</h1>
			<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" class="inputs">
				<input name="specialityName" type="text" placeholder="Название специальности">
				<input name="specialityNickName" type="text" placeholder="Аббревиатура специальности">
				<input name="specialityTerm" class="item" type="number" placeholder="Количество курсов" value="4">
				<input type="submit" name="crtSpeciality" value="Создать специальность">
			</form>
		<?php endif; ?>
		<div class="rightSideUl">
			<p> Группы: </p>
			<li class="rightSideUlLi">
				<?php
					$groups = $con->query("SELECT * FROM groups")->fetchAll();
					foreach($groups as $group):
						$href = '../group?id='.$group['id'];
				?>
					<li><a href='<?= $href ?>'><?= $group['name'] ?></a></li>
				<?php endforeach; ?>
			</li>
		</div>
		<?php if ($uacces == 1): ?>
			<h1>Создание группы</h1>
			<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" class="inputs">
				<select name="groupSpeciality">
					<?php foreach($specialities as $speciality): ?>
						<option value="<?= $speciality['abbreviation'] ?>"><?= $speciality['abbreviation']; ?></option>
					<?php endforeach; ?>
				</select>
				<input name="groupCourse" class="item" type="number" min="1" max="<?= $speciality['term'] ?>" placeholder="Курс" value="1">
				<select name="edForm">
					<option value="1">Бюджет</option>
					<option value="2">Контракт</option>
				</select>
				<input type="submit" name="crtList" value="Создать группу">
			</form>
		<?php endif; ?>
	</main>
</body>
</html>