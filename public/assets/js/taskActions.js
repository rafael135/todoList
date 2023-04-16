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



async function deleteTask(element) {
    let id = element.getAttribute("data-task-id");

    let req = await fetch(deleteTaskRoute, {
        method: "DELETE",
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
            
        }
    });
}