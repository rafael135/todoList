const data = {
    labels: [
        "Completo",
        "Pendente"
    ],
    datasets: [{
        label: "Tarefas",
        data: [qteCompletedTasks, qtePendingTasks],
        backgroundColor: [
            "rgb(14, 159, 110)",
            "rgb(224, 36, 36)"
        ],
        hoverOffset: 4
    }]
};

Chart.defaults.backgroundColor = "#374151";
Chart.defaults.color = "#FFF";

new Chart(
    document.getElementById("tasksChart"),
    {
        type: "pie",
        data: data,
    }
);