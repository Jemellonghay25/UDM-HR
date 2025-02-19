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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRIS Dashboard</title>
    <link rel="shortcut icon" href="./assets/image/udm-logo-1.png" />
    <link rel="stylesheet" href="./styling/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            <canvas id="chart">

            </canvas>
        </div>
    </div>

    <footer class="p-1 position-absolute w-100">
        <p class="fs-6 text-center text-white">Universidad De Manila || "Uplifting lives through quality education."</p>
    </footer>


    <script src="./js/charts.js"></script>
    <script src="./js/deptCharts.js"></script>

</body>

</html>