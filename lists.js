function addTask() {
	let newItem = document.createElement('input'),
		container = document.createElement('div'),
		img = document.createElement('img'),
		id = document.querySelectorAll('.inputs .addTaskContainer')[document.querySelectorAll('.inputs .addTaskContainer').length - 1].firstElementChild.getAttribute('name').split('item')[1];
	img.classList.add('addTask');
	img.setAttribute('src', '../images/lightPlus.svg');
	img.setAttribute('alt', 'Add more items');
	img.addEventListener('click', addTask);
	container.classList.add('addTaskContainer');
	document.querySelectorAll('.inputs .addTaskContainer')[document.querySelectorAll('.inputs .addTaskContainer').length - 1].after(container);
	this.parentNode.removeChild(this);
	container.append(newItem);
	container.append(img);
	id++;
	newItem.setAttribute('placeholder', 'List item');
	newItem.setAttribute('type', 'text');
	newItem.setAttribute('name', ('item' + id));
	newItem.classList.add('item');
	id++;
	document.querySelector('#itemsQuant').setAttribute('value', id);
}

function addGroup() {
	let newSelect = document.createElement('select'),
		container = document.createElement('div'),
		img = document.createElement('img'),
		lastSelect = document.querySelectorAll('.inputs .addGroupContainer')[document.querySelectorAll('.inputs .addGroupContainer').length - 1],
		options = [];
	for (let item of lastSelect.firstElementChild.children) options.push(item);
	if (options.length) {
		for (let item of options) {
			let option = document.createElement('option');
			option.value = item.value;
			option.textContent = item.textContent;
			newSelect.append(option);
		}

		let id = lastSelect.firstElementChild.getAttribute('name').split('group')[1];
		img.classList.add('addGroup');
		img.setAttribute('src', '../images/lightPlus.svg');
		img.setAttribute('alt', 'Add more groups');
		img.addEventListener('click', addGroup);
		container.classList.add('addGroupContainer');
		lastSelect.after(container);
		container.append(newSelect);
		container.append(img);
		this.parentNode.removeChild(this);
		id++;
		newSelect.setAttribute('name', ('group' + id));
		id++;
		document.querySelector('#groupsQuant').setAttribute('value', id);
	}
}

document.querySelector('.addTask').addEventListener('click', addTask);
document.querySelector('.addGroup').addEventListener('click', addGroup);