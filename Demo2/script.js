const taskInput = document.getElementById("task-input");
const taskList = document.getElementById("task-list");

function addTask() {
    const taskText = taskInput.value;

    if (taskText === '') {
        alert("Please enter a task");
        return;
    }

    // Buat elemen <li>
    const li = document.createElement("li");
    li.innerHTML = `<span>${taskText}</span>
                <div>
                    <button class="edit-btn" onclick="editTask(this)">Edit</button>
                    <button class="delete-btn" onclick="deleteTask(this)">Delete</button>
                </div>`;

    taskList.appendChild(li);
    taskInput.value = ''; // Reset input setelah menambahkan task
}

function deleteTask(button) {
    const li = button.parentElement.parentElement;
    taskList.removeChild(li);
}

function editTask(button) {
    const li = button.parentElement.parentElement;
    const span = li.querySelector('span');
    const newTaskText = prompt("Edit your task:", span.textContent);

    if (newTaskText !== null && newTaskText.trim() !== '') {
        span.textContent = newTaskText;
    }
}