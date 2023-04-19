let editInputTitle = document.getElementById("editTitle");
let editInputColor = document.getElementById("editColor");


let idToDelete = 0;

function setDeleteId(element) {
    idToDelete = element.getAttribute("data-category-id");
}

async function deleteTask() {
    let req = await fetch(deleteCategoryRoute, {
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
            document.querySelector(`.category-instance[data-category-id="${idToDelete}"]`).remove();
        }
    });
}