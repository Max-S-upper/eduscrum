document.querySelectorAll('.stateItem').forEach((item) =>{
	item.addEventListener('click', () => {
		document.querySelectorAll('.stateItem').forEach((item) => {
			item.style.borderBottom = "0px solid #fff";
		});
		item.style.borderBottom = "4px solid #B7C3D7";
	});
});

for (let item of document.querySelectorAll('input[name=move-to-do]')) {
    item.addEventListener('click', function(e) {
        e.preventDefault();
        let inp = document.createElement('input');
        inp.setAttribute('type', 'hidden');
        inp.setAttribute('value', this.getAttribute('data-task-id'));
		inp.setAttribute('name', 'move-item-data');
        this.after(inp);
        sendAjax(this.getAttribute('name'), this.getAttribute('data-task-id'));
    });
}

for (let item of document.querySelectorAll('input[name=move-doing]')) {
    item.addEventListener('click', function(e) {
        e.preventDefault();
        let inp = document.createElement('input');
        inp.setAttribute('type', 'hidden');
        inp.setAttribute('value', this.getAttribute('data-task-id'));
		inp.setAttribute('name', 'move-item-data');
        this.after(inp);
        sendAjax(this.getAttribute('name'), this.getAttribute('data-task-id'));
    });
}

for (let item of document.querySelectorAll('input[name=move-doing-back]')) {
    item.addEventListener('click', function(e) {
        e.preventDefault();
        let inp = document.createElement('input');
        inp.setAttribute('type', 'hidden');
        inp.setAttribute('value', this.getAttribute('data-task-id'));
		inp.setAttribute('name', 'move-item-data');
        this.after(inp);
        sendAjax(this.getAttribute('name'), this.getAttribute('data-task-id'));
    });
}

for (let item of document.querySelectorAll('input[name=move-done-back]')) {
    item.addEventListener('click', function(e) {
        e.preventDefault();
        let inp = document.createElement('input');
        inp.setAttribute('type', 'hidden');
        inp.setAttribute('value', this.getAttribute('data-task-id'));
		inp.setAttribute('name', 'move-item-data');
        this.after(inp);
        sendAjax(this.getAttribute('name'), this.getAttribute('data-task-id'));
    });
}

for (let item of document.querySelectorAll('input[name=student-move-to-do]')) {
    item.addEventListener('click', function(e) {
        e.preventDefault();
        let inp = document.createElement('input');
        inp.setAttribute('type', 'hidden');
        inp.setAttribute('value', this.getAttribute('data-task-id'));
		inp.setAttribute('name', 'move-item-data');
        this.after(inp);
        sendAjax(this.getAttribute('name'), this.getAttribute('data-task-id'));
    });
}

for (let item of document.querySelectorAll('input[name=student-move-doing]')) {
    item.addEventListener('click', function(e) {
        e.preventDefault();
        let inp = document.createElement('input');
        inp.setAttribute('type', 'hidden');
        inp.setAttribute('value', this.getAttribute('data-task-id'));
		inp.setAttribute('name', 'move-item-data');
        this.after(inp);
        sendAjax(this.getAttribute('name'), this.getAttribute('data-task-id'));
    });
}

for (let item of document.querySelectorAll('input[name=student-move-doing-back]')) {
    item.addEventListener('click', function(e) {
        e.preventDefault();
        let inp = document.createElement('input');
        inp.setAttribute('type', 'hidden');
        inp.setAttribute('value', this.getAttribute('data-task-id'));
		inp.setAttribute('name', 'move-item-data');
        this.after(inp);
        sendAjax(this.getAttribute('name'), this.getAttribute('data-task-id'));
    });
}

for (let item of document.querySelectorAll('input[name=student-move-done-back]')) {
    item.addEventListener('click', function(e) {
        e.preventDefault();
        let inp = document.createElement('input');
        inp.setAttribute('type', 'hidden');
        inp.setAttribute('value', this.getAttribute('data-task-id'));
		inp.setAttribute('name', 'move-item-data');
        this.after(inp);
        sendAjax(this.getAttribute('name'), this.getAttribute('data-task-id'));
    });
}

function sendAjax(name, task_id) {
    $.ajax({
        url: 'move_tasks.php',
        type: 'POST',
        cache: false,
        data: {'name': name, 'task_id': task_id},
        dataType: 'html',
        success: function(data) {
            if (!data) alert("There were some errors.");
            else location.reload();
        }
    });
}