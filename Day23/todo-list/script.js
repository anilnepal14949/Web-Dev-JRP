var formEl = document.querySelector('.form');
var inputEl = document.querySelector('.input');
var tasksEl = document.querySelector('.tasks');

var list = JSON.parse(localStorage.getItem("tasks"));

// console.log(list);

if(list) {
	for(task of list) {
		addTask(task);
	}
}

formEl.addEventListener("submit", function() {
	event.preventDefault();
	addTask();
});

function addTask(task) {
	var newTask = inputEl.value;

	if(task) {
		newTask = task.name;
	}

	var liEl = document.createElement("li");
	if(task && task.checked) {
		liEl.classList.add("checked");
	}
	liEl.innerText = newTask;

	var checkBtnEl = document.createElement("span");
	checkBtnEl.innerHTML = "<i class='fas fa-check-square'></i>";
	liEl.appendChild(checkBtnEl);

	var trashBtnEl = document.createElement("span");
	trashBtnEl.innerHTML = "<i class='fas fa-trash'></i>";
	liEl.appendChild(trashBtnEl);

	tasksEl.appendChild(liEl);

	inputEl.value = '';

	checkBtnEl.addEventListener("click", function() {
		liEl.classList.toggle("checked");
		updateLocalStorage();
	});

	trashBtnEl.addEventListener("click", function() {
		var del = confirm("Are you sure to delete this task?");
		if(del) {			
			liEl.remove();
			updateLocalStorage();
		}
	});

	updateLocalStorage();
}

function updateLocalStorage() {
	var liEls = document.querySelectorAll('.tasks li');

	list = [];

	for (liEl of liEls) {
		list.push({
			name: liEl.innerText,
			checked: liEl.classList.contains("checked")
		});
	}

	localStorage.setItem("tasks", JSON.stringify(list));
}