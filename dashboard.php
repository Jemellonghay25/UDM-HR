<?php
session_start();
include('./connection/server.php');

// Fetch user details from the database
$query = "SELECT * FROM user WHERE user_id = '" . $_SESSION["user"] . "'";
$result = mysqli_query($db, $query);
$row = mysqli_fetch_assoc($result);

// Handle search
$name = isset($_GET['name']) ? trim($_GET['name']) : '';

// Get total records
$totalResult = mysqli_query($db, "SELECT COUNT(*) AS total_records FROM masterlist;");
$totalRecords = mysqli_fetch_assoc($totalResult)['total_records'];

//Total Permanent Status
$permanent = mysqli_query($db, "SELECT COUNT(*) AS total_permanent FROM masterlist WHERE status = 'Permanent';");
$permanentCount = mysqli_fetch_assoc($permanent)['total_permanent'];

//Total JO Status
$jo = mysqli_query($db, "SELECT COUNT(*) AS total_jo FROM masterlist WHERE status = 'JO';");
$joCount = mysqli_fetch_assoc($jo)['total_jo'];

//Total COS Status
$cos = mysqli_query($db, "SELECT COUNT(*) AS total_cos FROM masterlist WHERE status = 'COS';");
$cosCount = mysqli_fetch_assoc($cos)['total_cos'];

//Total Part-Time Status
$pt = mysqli_query($db, "SELECT COUNT(*) AS total_pt FROM masterlist WHERE status = 'Part-Time';");
$ptCount = mysqli_fetch_assoc($pt)['total_pt'];

// echo "<scipt>console.log('Permanent: $permanentCount, COS: $cosCount, JO: $joCount, Part-Time: $ptCount);</script>";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRIS Dashboard</title>
    <link rel="stylesheet" href="./styling/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>


</head>

<body>
    <header class="header p-2">
        <div class="logo">
            <span>
                <img id="udm-logo"
                    src="./assets/image/udm-logo-1.png"
                    class="img-fluid ms-2"
                    alt="UDM Logo" />
            </span>

            <span>
                <h5 class="mt-2 ms-3 text-white">
                    UDM HR Information System
                </h5>
            </span>
        </div>

        <div class="logout me-4">
            <a href="./connection/logout.php">
                <i class="bi bi-box-arrow-right text-white"></i>
            </a>
        </div>
    </header>

    <div class="navigation p-3 d-block">
        <div class="user-icon d-flex justify-content-center border-bottom border-black pb-2">
            <img src="./assets/image/userImg.png" alt="User Icon" class="img-fluid">
            <div id="username" class="username mt-1 p-1 ">
                <p class="lh-1 m-auto text-align-start">
                    <?php echo $row['first_name'] . ""; ?>
                </p>
                <p class="lh-1 m-auto text-align-start">
                    <strong><?php echo $row['title']; ?></strong>
                </p>
            </div>
        </div>

         <!-- SIDE NAVIGATION DASHBOARD, CHECK-DTR, VIEW EMPLOYEES, UPLOAD -->
        <div class="nav-menu mt-3">
            <div class="dashboard d-flex justify-content-start w-100 mt-2 p-1">
                <span>
                    <p class="h6 fw-bold">
                        MENU
                    </p>
                </span>
            </div>

            <div class="dashboard d-flex justify-content-center w-100 p-1">
                <span>
                    <i class="bi bi-bar-chart-fill text-black"></i>
                </span>
                <span>
                    <a href="./dashboard.php" class="text-decoration-none">
                        <p class="text-black ms-1">
                            Dashboard
                        </p>
                    </a>
                </span>
            </div>

            <div class="check-dtr d-flex justify-content-center w-100 p-1 ms-1">
                <span>
                    <i class="bi bi-calendar-check-fill text-black"></i>
                </span>
                <span>
                    <a href="./check-dtr.php" class="text-decoration-none">
                        <p class=" text-black ms-1">
                            Check DTR
                        </p>
                    </a>
                </span>
            </div>

            <div class="view-employee d-flex justify-content-center w-100 p-1 ms-3">
                <span>
                    <i class="bi bi-people-fill text-black"></i>
                </span>
                <span>
                    <a href="./employee.php" class="text-decoration-none">
                        <p class=" text-black ms-1">
                            View Employee
                        </p>
                    </a>
                </span>
            </div>

            <div class="upload d-flex justify-content-center w-100 ms-2 p-1">
                <span>
                    <i class="bi bi-file-earmark-arrow-up-fill text-black"></i>
                </span>
                <span>
                    <a href="./upload-window.php" class="text-decoration-none ">
                        <p class="text-black ms-1">
                            Upload Files
                        </p>
                    </a>
                </span>
            </div>
        </div>
    </div>

    <div class="banner">
        <h3 class="mt-1 h1 fs-3">Dashboard</h3>
    </div>

    <div class="card-container mb-3 p-3 rounded-3 w-75">
        <div class="card-content d-flex p-2 m-auto ">
            <div class="card-body mt-5 p-2 rounded-3 ms-4">
                <p class="fs-4 fw-bold text-center">
                    Total Employees
                </p>
                <p class="fs-4 fw-bold text-center ms-5">
                    <?php echo number_format($totalRecords); ?>
                </p>
            </div>
            <div class="chart rounded-3">
                <canvas id="myChart">

                </canvas>
            </div>
        </div>
        <div class="dept-chart rounded-3 m-auto p-2 mt-2">
            <canvas id="chart"></canvas>
        </div>
    </div>

    <footer class="p-1 position-absolute w-100">
        <p class="fs-6 text-center text-white">Universidad De Manila || "Uplifting lives through quality education."</p>
    </footer>


    <script>
        let title = 'Total Job Status';
        let labels = ['Permanent', 'COS', 'JO', 'Part-Time'];

        // Inject PHP variables into JavaScript
        let countings = [
            <?php echo $permanentCount; ?>,
            <?php echo $cosCount; ?>,
            <?php echo $joCount; ?>,
            <?php echo $ptCount; ?>
        ];

        const data = {
            labels: labels,
            datasets: [{
                data: countings,
                backgroundColor: [
                    'rgb(11, 68, 0)', // Dark Green
                    'rgba(3, 45, 73, 0.6)', // Dark Blue
                    'rgb(138, 100, 5)', // Dark Yellow
                    'rgb(88, 0, 252)' // Dark Purple
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
                            size: 14
                        },
                        anchor: 'inside',
                        align: 'inside',
                        formatter: (value) => {
                            return value; // Show count inside the slice
                        }
                    }
                }
            },
            plugins: [ChartDataLabels] // Enable data labels plugin
        };

        // Render chart
        const chart = new Chart(
            document.getElementById('myChart'),
            config
        );

        //DEPARTMENT CHART
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
            datasets: [{
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
                barPercentage: 0.9 // Adjust width of individual bars
            },
            plugins: [ChartDataLabels] // Enable data labels
        };

        const deptChart = new Chart(
            document.getElementById('chart'),
            configure
        );
    </script>

</body>

</html>