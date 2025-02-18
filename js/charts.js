let title = 'Total Job Status';
let labels = ['Permanent', 'Contract', 'JO'];
let countings = [500, 70, 80];

const data = {
    labels: labels,
    datasets: [{
        data: countings,
        backgroundColor: [
            'rgb(11, 68, 0)', // Dark Green
            'rgba(3, 45, 73, 0.6)', // Dark Blue
            'rgb(138, 100, 5)' // Dark Yellow
        ],
    }]
};

const config = {
    type: 'doughnut',
    data: data,
    options: {
        plugins: {
            title: {
                display: true,
                text: title,
                font: {
                    size: 15
                },
                color: 'black'
            },
            legend: {
                display: true,
                position: 'bottom'
            },
            datalabels: {
                color: 'white', // Text color inside slices
                font: {
                    weight: 'bold',
                    size: 14,

                },
                anchor: 'inside',
                align: 'inside',
                formatter: (value) => {
                    return value; // Show count (500, 70, 80) inside the slice
                }
            }
        }
    },
    plugins: [ChartDataLabels] // Enable data labels plugin
};

const chart = new Chart(
    document.getElementById('myChart'),
    config
);


// Department Chart

let delayed;

let departmentTitle = 'No. of Permanent, Contract, JO Employee in Every Department';

let departmentLabels = ['CAS', 'CET', 'CED', 'CBA', 'CHS', 'CCJ'];


//DATA EACH DEPARTMENT
let permanentEmployees = [29, 14, 23, 9, 6, 7];
let contractEmployees = [20, 19, 13, 12, 2, 9];
let jobOrderEmployees = [2, 1, 2, 2, 1, 1];

const deptData = {
    labels: departmentLabels,
    datasets: [
        {
            label: 'Permanent',
            data: permanentEmployees,
            backgroundColor: 'rgba(0, 4, 255, 0.7)', // Blue
        },
        {
            label: 'Contract',
            data: contractEmployees,
            backgroundColor: 'rgba(255, 166, 0, 0.7)', // Orange
        },
        {
            label: 'JO',
            data: jobOrderEmployees,
            backgroundColor: 'rgba(255, 0, 0, 0.7)', // Red
        }
    ]
};

const configure = {
    type: 'bar',
    data: deptData,
    options: {
        plugins: {
            title: {
                display: true,
                text: departmentTitle,
                font: {
                    size: 15
                },
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
        categoryPercentage: 0.8, // Adjust width of group bars
        barPercentage: 0.9        // Adjust width of individual bars
    },
    plugins: [ChartDataLabels] // Enable data labels
};

const deptChart = new Chart(
    document.getElementById('chart'),
    configure
);