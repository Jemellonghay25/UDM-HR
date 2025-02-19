$(document).ready(function() {
    $.ajax({
        url: "./connection/charts.php", // Adjust the URL if needed
        type: "GET",
        dataType: "json",
        success: function(data) {
            // Data expected: { total_permanent: ..., total_cos: ..., total_jo: ..., total_pt: ... }
            let title = 'Total Job Status';
            let labels = ['Permanent', 'COS', 'JO', 'Part-Time'];
            let countings = [
                data.total_permanent,
                data.total_cos,
                data.total_jo,
                data.total_pt
            ];

            const chartData = {
                labels: labels,
                datasets: [{
                    data: countings,
                    backgroundColor: [
                        'rgb(11, 68, 0)',       // Dark Green
                        'rgba(3, 45, 73, 0.6)',  // Dark Blue
                        'rgb(138, 100, 5)',      // Dark Yellow
                        'rgb(88, 0, 252)'        // Dark Purple
                    ]
                }]
            };

            const config = {
                type: 'doughnut',
                data: chartData,
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: title,
                            font: { size: 15 },
                            color: 'black'
                        },
                        legend: {
                            display: true,
                            position: 'bottom'
                        },
                        datalabels: {
                            color: 'white', // Text color inside slices
                            font: { weight: 'bold', size: 14 },
                            anchor: 'inside',
                            align: 'inside',
                            formatter: (value) => value // Show count inside the slice
                        }
                    }
                },
                plugins: [ChartDataLabels] // Ensure the ChartDataLabels plugin is loaded
            };

            // Render chart
            const ctx = document.getElementById('myChart').getContext('2d');
            new Chart(ctx, config);
        },
        error: function(xhr, status, error) {
            console.error("Error fetching chart data: " + error);
        }
    });
});
