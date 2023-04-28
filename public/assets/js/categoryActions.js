let editInputTitle = document.getElementById("editTitle");
let editInputColor = document.getElementById("editColor");
let editInputId = document.getElementById("editCategory_id");

let createInputTitle = document.getElementById("createTitle");
let createInputColor = document.getElementById("createColor");


/*

const pickr = Pickr.create({
    el: '.pickr-btn',
    theme: 'monolith', // or 'monolith', or 'nano'

    swatches: [
        'rgba(244, 67, 54, 1)',
        'rgba(233, 30, 99, 0.95)',
        'rgba(156, 39, 176, 0.9)',
        'rgba(103, 58, 183, 0.85)',
        'rgba(63, 81, 181, 0.8)',
        'rgba(33, 150, 243, 0.75)',
        'rgba(3, 169, 244, 0.7)',
        'rgba(0, 188, 212, 0.7)',
        'rgba(0, 150, 136, 0.75)',
        'rgba(76, 175, 80, 0.8)',
        'rgba(139, 195, 74, 0.85)',
        'rgba(205, 220, 57, 0.9)',
        'rgba(255, 235, 59, 0.95)',
        'rgba(255, 193, 7, 1)'
    ],

    components: {

        // Main components
        preview: true,
        opacity: true,
        hue: true,

        // Input / output Options
        interaction: {
            hex: true,
            rgba: true,
            input: true,
            clear: true,
            save: true
        }
    }
});

*/


async function getCategoryData(element) {
    id = element.getAttribute("data-category-id");

    let req = await fetch(getCategoryDataRoute, {
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
            editInputTitle.value = res.category.title;
            editInputColor.value = res.category.color;
            editInputId.value = res.category.id;
        }
    });
}




let idToDelete = 0;

function setDeleteId(element) {
    idToDelete = element.getAttribute("data-category-id");
}

async function deleteCategory() {
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



