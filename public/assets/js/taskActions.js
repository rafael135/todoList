let titleEditInput = document.getElementById("title");
let descriptionEditInput = document.getElementById("description");
let dueDateEditInput = document.getElementById("due_date");


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
            console.log(res);
            titleEditInput.value = res.task.title;
            descriptionEditInput.value = res.task.description;
            dueDateEditInput.value = res.task.due_date;
        }
    });
}