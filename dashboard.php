<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Date Time Record</title>
    <link rel="stylesheet" href="./styling/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</head>

<body>
    <header class="header p-1">
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

        <div class="logout m-2 me-4">
            <a href="#">
                <i class="bi bi-box-arrow-right text-white"></i>
            </a>
        </div>
    </header>

    <div class="navigation p-3">
        <div class="user-icon d-flex justify-content-center border-bottom border-black">
            <div id="icon" class="mt-2">
                <img src="./assets/image/userImg.png" alt="User Icon" class="img-fluid">
            </div>
            <div id="username" class="username mt-2 ms-2 p-1">
                <p class="lh-1 me-5">
                    jelo Flores
                </p>
                <p class="lh-1">
                    <strong>Human Resource</strong>
                </p>
            </div>
        </div>
        <div class="nav-menu mt-3">
            <div class="dashboard d-flex justify-content-center border-bottom border-black w-100 p-1">
                <span>
                    <img
                        src="./assets/image/dashboardIcon.png"
                        class="img-fluid"
                        alt="dashboard icon" />
                </span>
                <span>
                    <a href="#" class="text-decoration-none">
                        <p class="text-black">
                            Dashboard
                        </p>
                    </a>
                </span>
            </div>

            <div class="dashboard d-flex justify-content-start w-100 mt-2 p-1">
                <span>
                    <p class="h6 fw-bold">
                        MENU
                    </p>
                </span>
            </div>

            <div class="employee d-flex justify-content-center w-100 p-1 ">
                <span>
                    <img
                        src="./assets/image/employeesIcon.png"
                        class="img-fluid"
                        alt="Employee icon" />
                </span>
                <span>
                    <a href="./employee.php" class="text-decoration-none">
                        <p class=" text-black me-2">
                            Employees
                        </p>
                    </a>
                </span>
            </div>
            <div class="department d-flex justify-content-center w-100 p-1 ">
                <span>
                    <img
                        src="./assets/image/departmentIcon.png"
                        class="img-fluid"
                        alt="employee icon" />
                </span>
                <span>
                    <a href="#" class="text-decoration-none">
                        <p class=" text-black ">
                            Department
                        </p>
                    </a>
                </span>
            </div>
            <div class="department d-flex justify-content-center w-100 p-1 ms-2">
                <span>
                    <img
                        src="./assets/image/calendar.png"
                        class="img-fluid "
                        alt="Record icon" />
                </span>
                <span>
                    <a href="./index.php" class="text-decoration-none">
                        <p class=" text-black me-2 ms-2">
                            Date Record
                        </p>
                    </a>
                </span>
            </div>
        </div>
    </div>

    <div class="card-container mt-3 p-3">
        <div class="card-header">
            <h3 class="text-start">Dashboard</h3>
        </div>
        <div class="card-body 5 mt-5 p-2 rounded-3">
            <p class="fs-4 fw-bold text-center">
                Employee
            </p>
            <p class="fs-4 fw-bold text-center ms-5">
                3,000
            </p>
        </div>
    </div>

    <canvas id="chart"></canvas>


<script src="./js/charts.js"></script>

</body>

</html>