<?php
	$uid = $_COOKIE['PHPSESSDI'];
	if ($con->query("SELECT `type` FROM `user` WHERE `id` = '$uid'")->fetch()[0] == '0') $uacces = 1;
	else $uacces = 0;
	$id = $_COOKIE['PHPSESSDI'];
	if ($uacces == 0) {
		$usr_group = $con->query("SELECT `group` FROM `user` WHERE `id` = $id")->fetch();
		$usr_group = $usr_group[0];
		$student_lists = $con->query("SELECT `list_id` FROM `group_lists` WHERE `group_id` = '$usr_group'")->fetchAll();
	}

	else $student_lists = $con->query("SELECT * FROM `lists` WHERE `teacher` = '$id'")->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
	<title>eduscrum</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../styles/index.css">
	<link rel="stylesheet" type="text/css" href="../styles/profile.css">
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
			<p><a href="/profile">Profile</a></p> <img src="../images/ico-profile.png" alt="profile"> <a href="/signOut.php">Sign out</a>
		</div>
	</header>
	<main id = "mainProfile">
		<div class="leftSide">
			<div class="profileHeadImg">
				<div class="profilePhoto"></div>
			</div>
			<input type="submit" name="profileSettings" class="profileSettingsButton" value="Profile Settings"> 
			<div class="profileContent">
				<div class="profileInfo">
					<?php $tid = $_COOKIE['PHPSESSDI']; ?>
					<?php $usr_data = $con->query("SELECT `name`, `surname` FROM `user` WHERE `id` = $tid")->fetch(); ?>
					<p class="name"><?= $usr_data['name'] . ' ' . $usr_data['surname'] ?></p>
				</div>
			</div>
			<div class="csrumEl">
				<div class="state">
					<input type="submit" name="toDo" class="toDo stateItem" value="To do">
					<input type="submit" name="doing" class="doing stateItem" value="Doing">
					<input type="submit" name="done" class="done stateItem" value="Done">
				</div>
				<form class="toDoLists" action="" method="POST">
					<?php 
					$usr = $con->query("SELECT `type` FROM `user` WHERE `id` = {$tid}")->fetch();
					$usr = $usr[0];
					if ($usr == 0) $listToDo = $con->query("SELECT * FROM `lists` WHERE `teacher` = '$tid'")->fetchAll();
					else $listToDo = $student_lists;
					?>
						<div class='toDo'>
							<?php foreach ($listToDo as $list):?>
								<?php $cur_list_id = $list[0]; ?>
								<?php $list = $con->query("SELECT * FROM `lists` WHERE `id` = $cur_list_id")->fetch() ?>
								<?php $href = '../list?id='.$list['id']; ?>
								<a href='<?= $href ?>'><?= $list['name'] ?></a>
								<?php
								$listId = $list['id'];
								if ($usr == 0) {
									$tasks = $con->query("SELECT * FROM `tasks` WHERE `listId` = '$listId' AND `status` = '1' ORDER BY `id`")->fetchAll();
									// if (count($tasks) == 1) echo "<p>Done</p>";
									foreach ($tasks as $key => $task):
									?>
										<div>
											<li class="task"><?php echo $task[1]; ?></li>
											<input data-task-id="<?= $task[0] ?>" value=">" name="<?php if ($usr == 0): ?>move-to-do<?php endif?><?php if ($usr == 1): ?>student-move-to-do<?php endif?>" type="submit">
										</div>
									<?php endforeach;
								}
								
								else {
									$task_ids = $con->query("SELECT `taskId`, `personalTask` FROM `workflow` WHERE `studentId` = $uid AND `listId` = $listId AND `status` = 1 ORDER BY `id`")->fetchAll();
									foreach($task_ids as $task_id) {
										if (!$task_ids[1]) $task = $con->query("SELECT * FROM `tasks` WHERE `id` = $task_id[0]")->fetch();
										else $task = $task_ids[1];
										?>
										<div>
											<li class="task"><?php echo $task[1]; ?></li>
											<input data-task-id="<?= $task[0] ?>" value=">" name="<?php if ($usr == 0): ?>move-to-do<?php endif?><?php if ($usr == 1): ?>student-move-to-do<?php endif?>" type="submit">
										</div>
										<?php
									}
								}
							endforeach;?>
						</div>
						<div class='doing'>
							<?php foreach ($listToDo as $list):
								$cur_list_id = $list[0]; 
								$list = $con->query("SELECT * FROM `lists` WHERE `id` = $cur_list_id")->fetch();
								$href = '../list?id='.$list['id'];
								$listId = $list['id'];
								if ($usr == 0) {
									$tasks = $con->query("SELECT * FROM `tasks` WHERE `listId` = '$listId' AND `status` = '2' ORDER BY `id`")->fetchAll();
									foreach ($tasks as $key => $task):
									?>
										<div>
											<input data-task-id="<?= $task[0] ?>" value="<" name="<?php if ($usr == 0): ?>move-doing-back<?php endif?><?php if ($usr == 1): ?>student-move-doing-back<?php endif?>" type="submit">
											<li class="task"><?php echo $task[1]; ?></li>
											<input data-task-id="<?= $task[0] ?>" value=">" name="<?php if ($usr == 0): ?>move-doing<?php endif?><?php if ($usr == 1): ?>student-move-doing<?php endif?>" type="submit">
										</div>
									<?php endforeach;
								}
								
								else {
									$task_ids = $con->query("SELECT `taskId` FROM `workflow` WHERE `studentId` = $uid AND `listId` = $listId AND `status` = 2 ORDER BY `id`")->fetchAll();
									foreach($task_ids as $task_id) {
										$task = $con->query("SELECT * FROM `tasks` WHERE `id` = $task_id[0]")->fetch();
										?>
										<div>
											<input data-task-id="<?= $task[0] ?>" value="<" name="<?php if ($usr == 0): ?>move-doing-back<?php endif?><?php if ($usr == 1): ?>student-move-doing-back<?php endif?>" type="submit">
											<li class="task"><?php echo $task[1]; ?></li>
											<input data-task-id="<?= $task[0] ?>" value=">" name="<?php if ($usr == 0): ?>move-doing<?php endif?><?php if ($usr == 1): ?>student-move-doing<?php endif?>" type="submit">
										</div>
										<?php
									}
								}
							endforeach;?>
						</div>
						<div class='done'>
							<?php foreach ($listToDo as $list):?>
								<?php $cur_list_id = $list[0]; ?>
								<?php $list = $con->query("SELECT * FROM `lists` WHERE `id` = $cur_list_id")->fetch() ?>
								<?php $href = '../list?id='.$list['id']; ?>
								<?php
								$listId = $list['id'];
								if ($usr == 0) {
									$tasks = $con->query("SELECT * FROM `tasks` WHERE `listId` = '$listId' AND `status` = '3' ORDER BY `id`");
									foreach ($tasks as $key => $task):
									?>
										<div>
											<input data-task-id="<?= $task[0] ?>" value="<" name="<?php if ($usr == 0): ?>move-done-back<?php endif?><?php if ($usr == 1): ?>student-move-done-back<?php endif?>" type="submit">
											<li class="task"><?php echo $task[1]; ?></li>
										</div>
									<?php endforeach;
								}
								
								else {
									$task_ids = $con->query("SELECT `taskId` FROM `workflow` WHERE `studentId` = $uid AND `listId` = $listId AND `status` = 3 ORDER BY `id`")->fetchAll();
									foreach($task_ids as $task_id) {
										$task = $con->query("SELECT * FROM `tasks` WHERE `id` = $task_id[0]")->fetch();
										?>
										<div>
										<input data-task-id="<?= $task[0] ?>" value="<" name="<?php if ($usr == 0): ?>move-done-back<?php endif?><?php if ($usr == 1): ?>student-move-done-back<?php endif?>" type="submit">
											<li class="task"><?php echo $task[1]; ?></li>
										</div>
										<?php
									}
								}
							endforeach;?>
						</div>
				</form>
			</div>
		</div>
		<div class="rightSide">
			<div class="rightSideUl">
				<p> Ваши списки </p>
				<li class='rightSideUlLi'>
					<?php
						foreach($student_lists as $list_id):
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
	</main>
</body>
<script src="../jquery-3.4.1.min.js"></script>
<script src="../profile.js"></script>
</html>
