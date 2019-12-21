<?php
$group_id = $_SESSION['group_id'];
$group_name = $con->query("SELECT `name` FROM `groups` WHERE `id` = $group_id")->fetch();
$list_id = $_SESSION['list_id'];
$list_name = $con->query("SELECT `name` FROM `lists` WHERE `id` = $list_id")->fetch();
?>
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
        <h1><?= $list_name[0] ?></h1>
        <h2><?= $group_name[0]?></h2>
        <div class="group-tasks-inf">
            <?php
            session_start();
            $students = $con->query("SELECT * FROM  `user` WHERE `type` = 1 AND `group` = $group_id")->fetchAll();
            if (!$students) echo "<p>There're no such users</p>";
            foreach($students as $student) :
                $student_id = $student[0];
                $taskIds = $con->query("SELECT * FROM `workflow` WHERE `listId` = $list_id AND `studentId` = $student_id ORDER BY `taskId`")->fetchAll();
                foreach ($taskIds as $taskId) :
                    $task_id = $taskId['taskId'];
                    $task = $con->query("SELECT `name`, `description` FROM `tasks` WHERE `id` = $task_id")->fetch();
                    $personalTask = $con->query("SELECT `personalTask` FROM `workflow` WHERE `studentId` = $student_id AND `taskId` = $task_id")->fetch();
                    $personalTask = $personalTask[0];
                    ?>
                    <form method="post" action="">
                        <span>
                            <?= $student['name'] ?>
                        </span>
                        <span>
                            <?= $student['surname'] ?>
                        </span>
                        <span>
                            <?= $task[0] ?>
                        </span>
                        <input type="text" name="personal-task" data-student-id="<?= $student_id ?>" data-task-id="<?= $task_id ?>" placeholder="description" value="<?php if ($personalTask) echo $personalTask; else if ($task[1]) echo $task[1]; else ''; ?>">
                        <span>
                            <?php
                            if ($taskId['status'] == 1) echo 'To do';
                            else if ($taskId['status'] == 2) echo 'Doing';
                            else echo 'Done';
                            ?>
                        </span>
                        <input type="number" name="grade" data-student-id="<?= $student_id ?>" data-task-id="<?= $task_id ?>" placeholder="grade" value="<?= $taskId['grade'] === NULL ? 0 : $taskId['grade']; ?>">
                    </form>
                <?php
                endforeach;
            endforeach;
            ?>
        </div>
    </main>
    <script src="../jquery-3.4.1.min.js"></script>
    <script src="../group_list.js"></script>
</body>
</html>