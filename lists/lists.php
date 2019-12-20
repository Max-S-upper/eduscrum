<?php
	include('../db-connect.php');
	$uacces = '';
	$uid = $_COOKIE['PHPSESSDI'];
	if ($con->query("SELECT type FROM user WHERE id = '$uid'")->fetch()[0] == '0') $uacces = 1;
	else $uacces = 0;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Lists</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../styles/lists.css">
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
	<div class="rightSideUl">
			<p> Ваши списки </p>
			<form class='rightSideUlLi' method="POST" action="">
			<?php
				$id = $_COOKIE['PHPSESSDI'];
				$lists;
				if ($uacces == 0) {
					$usr_group = $con->query("SELECT `group` FROM `user` WHERE `id` = $id")->fetch();
					$usr_group = $usr_group[0];
					$lists = $con->query("SELECT `list_id` FROM `group_lists` WHERE `group_id` = '$usr_group'")->fetchAll();
				}

				else $lists = $con->query("SELECT * FROM `lists` WHERE `teacher` = '$id'")->fetchAll();
				
				foreach($lists as $list_id):
					if ($uacces == 0) {
						$cur_list = $con->query("SELECT * FROM `lists` WHERE `id` = '$list_id[0]'")->fetch();
						$name = $cur_list['name'];
					}

					else {
						$cur_list = $list_id['name'];
						$name = $list_id['name'];
					}
				?>
					<li>
						<button name="list_id" value="<?= $list_id['id'] ?>"><?= $name ?></button>
					</li>
				<?php endforeach; ?>
				</form>
		</div>
	</div>
	<?php if ($uacces == 1): ?>
		<h1>Создание списка</h1>
		<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" class="inputs">
			<input name="listName" type="text" placeholder="List name">
			<div class="addGroupContainer">
				<select name="group0">
					<?php
						$groups = $con->query("SELECT * FROM groups")->fetchAll();
						foreach($groups as $group):
					?>
						<option value="<?= $group['id']; ?>"><?= $group['name']; ?></option>
					<?php endforeach; ?>
				</select>
				<img class="addGroup" src="../images/lightPlus.svg" alt="Add more groups">
			</div>
			<div class="addTaskContainer">
				<input name="item0" class="item" type="text" placeholder="List item">
				<img class="addTask" src="../images/lightPlus.svg" alt="Add more items">
			</div>
			<input type="hidden" name="itemsQuant" id="itemsQuant" value="1">
			<input type="hidden" name="groupsQuant" id="groupsQuant" value="1">
			<input type="submit" name="crtList" value="Create list">
		</form>
	<?php endif; ?>
</body>
<script src="../lists.js"></script>
</html>
