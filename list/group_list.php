<div class="group-tasks-inf">
    <?php 
    session_start();
    $tasks = $_SESSION['tasks'];
    foreach ($tasks as $task) {
        $students = $con->query("SELECT * FROM `workflow` WHERE `taskId` = $task[0]")->fetchAll();
        foreach($students as $student_data):
            $sid = $student_data['studentId'];
            $student = $con->query("SELECT `name`, `surname` FROM `user` WHERE `id` = $sid")->fetch(); ?>
            <div>
                <span>
                    <?= $student['name'] ?>
                </span>
                <span>
                    <?= $student['surname'] ?>
                </span>
                <span>
                    <?= $task[1] ?>
                </span>
                <span>
                    <?= $task[2] ?>
                </span>
                <span>
                    <?php
                    if ($student_data['status'] == 1) echo 'To do';
                    else if ($student_data['status'] == 2) echo 'Doing';
                    else echo 'Done';
                    ?>
                </span>
                <span>
                    <?= $student_data['grade'] == NULL ? 'Null' : $student_data['grade']; ?>
                </span>
            </div>
        <?php endforeach;
    }
    ?>
</div>