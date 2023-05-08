let taskIdEditInput = document.getElementById("editTask_id");
let titleEditInput = document.getElementById("editTitle");
let descriptionEditInput = document.getElementById("editDescription");
let dueDateEditInput = document.getElementById("editDue_date");

/*
    // TO DO
const showTaskModal = document.getElementById("showTask-modal");

const opts = {
    onHide: () => {

    }
}

*/



let taskDetails = false;

async function getTaskData(id) {
    let req = await fetch(taskDataRoute, {
        method: "POST",
        body: JSON.stringify({
            _token: csrfToken,
            id: id
        }),

        headers: {
            "Content-type": "application/json",
            "Accept": "application/json"
        }
    });

    let response = req.json();

    await response.then((res) => {
        if(res.success) {
            taskDetails = {
                id: res.task.id,
                title: res.task.title,
                description: res.task.description,
                due_date: res.task.due_date,
                status: res.task.is_done
            };
        } else {
            taskDetails = false;
        }
    })
    .catch((ex) => {
        taskDetails = false;
    });
}


async function showTaskEditData(task) {
    let id = task.getAttribute("data-task-id");

    await getTaskData(id);

    if(taskDetails != false) {
        taskIdEditInput.value = taskDetails.id;
        titleEditInput.value = taskDetails.title;
        descriptionEditInput.value = taskDetails.description;
        dueDateEditInput.value = taskDetails.due_date;
    }
}


let idToDelete = 0;

function setDeleteId(element) {
    idToDelete = element.getAttribute("data-task-id");
}

async function deleteTask() {
    let req = await fetch(deleteTaskRoute, {
        method: "DELETE",
        body: JSON.stringify({
            _token: csrfToken,
            id: idToDelete
        }),

        headers: {
            "Content-type": "application/json",
            "Accept": "application/json"
        }
    });

    let response = req.json();

    response.then((res) => {
        if(res.success == true) {
            document.querySelector(`.task-instance[data-task-id="${idToDelete}"]`).remove();
        }
    });
}



async function updateStatus(element) {
    let id = element.getAttribute("data-task-id");
    let originalStatus = element.hasAttribute("checked");

    //console.log(originalStatus);

    let status = (originalStatus == true) ? false : true;

    //console.log(status);

    let req = await fetch(taskUpdateRoute, {
        method: "POST",
        body: JSON.stringify({
            _token: csrfToken,
            id: id,
            status: status
        }),

        headers: {
            "Content-type": "application/json",
            "Accept": "application/json"
        }
    });

    let response = req.json();

    response.then((res) => {
        if(res.success == true) {
            //document.location.reload();
        } else {
            if(originalStatus == true) {
                element.checked = true;
            } else {
                element.checked = false;
            }
        }
    });
}



async function getTaskView(task) {
    let id = task.getAttribute("data-task-id");

    await getTaskData(id);

    if(taskDetails != false) {
        let taskTitle = document.getElementById("showTask-title");
        let taskDescription = document.getElementById("showTaskDescription");
        let taskDueDate = document.getElementById("showTaskDueDate");


        taskTitle.innerHTML = taskDetails.title;
        //taskTitle.classList.add("text-slate-100");
        //taskTitle.classList.remove("loading-text");

        taskDescription.innerHTML = taskDetails.description;
        //taskDescription.classList.add("text-slate-100");
        //taskDescription.classList.remove("loading-text");

        taskDueDate.innerHTML = taskDetails.due_date;
        //taskDueDate.classList.add("text-slate-100");
        //taskDueDate.classList.remove("loading-text");
    }
}