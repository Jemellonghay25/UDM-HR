$(document).ready(function() {
    $.ajax({
        url: "./connection/deptCharts.php", // Adjust the path if needed
        type: "GET",
        dataType: "json",
        success: function(data) {
            console.log("Dept Chart Data:", data); // For debugging

            let departmentTitle = 'No. of Permanent, Contract, JO Employee in Every Department';
            let departmentLabels = data.departments; // ['CAS', 'CET', 'CED', 'CBA', 'CHS', 'CCJ']

            const deptData = {
                labels: departmentLabels,
                datasets: [
                    {
                        label: 'Permanent',
                        data: data.permanentEmployees,
                        backgroundColor: 'rgba(0, 4, 255, 0.7)',
                    },
                    {
                        label: 'Contract',
                        data: data.contractEmployees,
                        backgroundColor: 'rgba(255, 166, 0, 0.7)',
                    },
                    {
                        label: 'JO',
                        data: data.jobOrderEmployees,
                        backgroundColor: 'rgba(255, 0, 0, 0.7)',
                    }
                ]
            };

            const config = {
                type: 'bar',
                data: deptData,
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: departmentTitle,
                            font: { size: 15 },
                            color: 'black'
                        },
                        legend: {
                            display: true,
                            position: 'bottom'
                        },
                        datalabels: {
                            display: false
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                    categoryPercentage: 0.8,
                    barPercentage: 0.9
                },
                plugins: [ChartDataLabels]
            };

            const ctx = document.getElementById('chart').getContext('2d');
            new Chart(ctx, config);
        },
        error: function(xhr, status, error) {
            console.error("Error fetching department chart data:", error);
        }
    });
});
