let taskIdEditInput = document.getElementById("editTask_id");
let titleEditInput = document.getElementById("editTitle");
let descriptionEditInput = document.getElementById("editDescription");
let dueDateEditInput = document.getElementById("editDue_date");


async function getTaskData(element) {
    let id = element.getAttribute("data-task-id");
    
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

    response.then((res) => {
        if(res.success == true) {
            //console.log(res);
            taskIdEditInput.value = res.task.id;
            titleEditInput.value = res.task.title;
            descriptionEditInput.value = res.task.description;
            dueDateEditInput.value = res.task.due_date;
        }
    });
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