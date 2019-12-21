<?php
	include('db-connect.php');
	$uacces = '';
	$uid = $_COOKIE['PHPSESSDI'];
	if ($con->query("SELECT `type` FROM `user` WHERE `id` = '$uid'")->fetch()[0] == '0') $uacces = 1;
	else $uacces = 0;
?>
<!DOCTYPE html>
<html>
<head>
	<title>eduscrum</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="styles/index.css">
	<link rel="stylesheet" type="text/css" href="styles/main.css">
	<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous"> -->
</head>
<body>
	<header>
		<ul>
			 <li><a href="/">Home</a></li>
			<li><a href="/lists">Lists</a></li>
			 <li><a href="/groups">Groups</a></li>
		</ul>
		<div class="profile">
			<p><a href="/profile">Profile</a></p> <img src="images/ico-profile.png" alt="profile"> <a href="/signOut.php">Sign out</a>
		</div>
	</header>
	<main>
		<div>
			<div class="rightSide">
				<div class="rightSideUl">
					<p> Ваши списки </p>
					<li class='rightSideUlLi'>
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
								$href = '../list?id='.$cur_list['id'];
								$name = $cur_list['name'];
							}

							else {
								$cur_list = $list_id['name'];
								$href = '../list?id='.$list_id['id'];
								$name = $list_id['name'];
							}
						?>
							<li><a href='<?= $href; ?>'><?= $name; ?></a></li>
						<?php endforeach; ?>
					</li>
				</div>
			</div>
		<?php if ($uacces == 1) echo '<a href="lists" class="crtNewList">Создать новый список</a>'; ?>
		</div>
		<div class="groups">
			<?php 
			$id = $_COOKIE['PHPSESSDI'];
			$groups = $con->query("SELECT * FROM groups")->fetchAll();
			foreach($groups as $group):
			?>
				<a class="group-block" href="group?id=<?= $group['id']; ?>"><?= $group['name']; ?></a>
			<?php endforeach; ?>
		</div>
	</main>
	<footer>
		
	</footer>
	<script src="index.js"></script>
</body>
</html>