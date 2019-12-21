for (let item of document.querySelectorAll('input[name=personal-task]')) {
    item.addEventListener('change', function(e) {
        sendAjaxPersonalTask(this.value, this.getAttribute('data-student-id'), this.getAttribute('data-task-id'));
    });
}

for (let item of document.querySelectorAll('input[name=grade]')) {
    item.addEventListener('change', function(e) {
        sendAjaxGrade(this.value, this.getAttribute('data-student-id'), this.getAttribute('data-task-id'));
    });
}

function sendAjaxPersonalTask(personalTask, dataStudentId, dataTaskId) {
    $.ajax({
        url: 'send_data.php',
        type: 'POST',
        cache: false,
        data: {'personalTask': personalTask, 'dataStudentId': dataStudentId, 'dataTaskId': dataTaskId},
        dataType: 'html',
        success: function(data) {
            if (!data) alert("There were some errors.");
            else alert('Data successfully saved');
        }
    });
}

function sendAjaxGrade(grade, dataStudentId, dataTaskId) {
    $.ajax({
        url: 'send_grade.php',
        type: 'POST',
        cache: false,
        data: {'grade': grade, 'dataStudentId': dataStudentId, 'dataTaskId': dataTaskId},
        dataType: 'html',
        success: function(data) {
            if (!data) alert("There were some errors.");
            else alert('Grade successfully saved');
        }
    });
}