let labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July'];

let dates = ['12', '19', '3', '5', '2', '3', '10'];

const data ={
    labels: labels,
    datasets: [{
        data: dates,
        backgroundColor: 'rgba(255, 99, 132, 0.2)'
    }]
};

const config = {
    type: 'bar',
    data: data
}

const chart = new Chart(
    document.getElementById('chart'),
    config
);