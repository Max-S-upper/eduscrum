<!DOCTYPE html>
<html>
<head>
	<title>List</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../styles/lists.css">
	<link rel="stylesheet" type="text/css" href="../styles/list.css">
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
		<?php
		$listName = $con->query("SELECT * FROM lists WHERE id = '$lid'")->fetch();
		?>
		<form method="POST" action="" class="groups">
			<?php 
			$id = $_COOKIE['PHPSESSDI'];
			$group_ids = $con->query("SELECT `group_id` FROM `group_lists` WHERE `list_id` = $lid AND `teacher_id` = $id")->fetchAll();
			foreach($group_ids as $group_id): 
				$group = $con->query("SELECT * FROM `groups` WHERE `id` = $group_id[0]")->fetch();
			?>
				<button name="group_id" value="<?= $group['id']; ?>"><?= $group['name']; ?></button>
			<?php endforeach;
			$groups = $con->query("SELECT * FROM `groups`")->fetchAll(); ?>
		</form>
		<h1><?= $listName['name'] ?></h1>
		<?php $list = $con->query("SELECT * FROM tasks WHERE listId = '$lid'")->fetchAll(); ?>
		<?php foreach($list as $task): ?>
			<p><?= $task['name']; ?></p>
		<?php endforeach; ?>
	</main>
</body>
<script src="../lists.js"></script>
</html>