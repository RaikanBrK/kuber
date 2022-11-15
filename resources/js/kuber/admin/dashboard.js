const ctx = document.getElementById("myChartDashboard");

new Chart(ctx, {
    type: "bar",
    data: {
        labels: labels,
        datasets: [
            {
                label: "Visitas",
                data: data,
                borderWidth: 1,
                backgroundColor: "#cc65fe",
            },
        ],
    },
    options: {
        plugins: {
            title: { display: true, text: "Visitas por mẽs" },
            legend: { display: false },
        },
    },
});
