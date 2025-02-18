<?php
session_start();
include('./connection/server.php');

// Fetch user details from the database
$query = "SELECT * FROM user WHERE user_id = '" . $_SESSION["user"] . "'";
$result = mysqli_query($db, $query);
$row = mysqli_fetch_assoc($result);

// Handle search
$name = isset($_GET['name']) ? trim($_GET['name']) : '';
?>

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
        <div class="user-icon d-flex justify-content-center border-bottom border-black">
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
        <div class="nav-menu mt-3">
            <div class="dashboard d-flex justify-content-center border-bottom border-black w-100 p-1">
                <span>
                    <img
                        src="./assets/image/dashboardIcon.png"
                        class="img-fluid"
                        alt="dashboard icon" />
                </span>
                <span>
                    <a href="./dashboard.php" class="text-decoration-none">
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

    <div class="container w-50 mt-2">
        <h4 class="text-center">DAILY TIME RECORD</h1>
            <!-- Search Form -->
            <!-- <form method="GET" action="">
                <input id="input" name="name" class="input is-centered block has-background-light has-text-dark custom-placeholder" type="text" placeholder="Search by Name" />
                <button type="submit" class="button is-primary mt-2">Search</button>
            </form> -->

            <p class="month ms-5">For the month of __________________________</p>

            <table id="dtrTable" class="table table-bordered border-black w-75 text-center m-auto">
                <thead>
                    <tr>
                        <th rowspan="2" class="has-text-centered has-text-dark">Day</th>
                        <th colspan="2" class="has-text-centered has-text-dark">A.M.</th>
                        <th colspan="2" class="has-text-centered has-text-dark">P.M.</th>
                        <th colspan="2" class="has-text-centered has-text-dark">Undertime</th>
                    </tr>
                    <tr>
                        <th class="has-text-centered has-text-dark">Arrival</th>
                        <th class="has-text-centered has-text-dark">Departure</th>
                        <th class="has-text-centered has-text-dark">Arrival</th>
                        <th class="has-text-centered has-text-dark">Departure</th>
                        <th class="has-text-centered has-text-dark">Hours</th>
                        <th class="has-text-centered has-text-dark">Minutes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($day = 1; $day <= 31; $day++): ?>
                        <tr>
                            <td class='has-text-centered has-text-dark'><?= $day; ?></td>
                            <td class='has-text-centered has-text-dark'></td>
                            <td class='has-text-centered has-text-dark'></td>
                            <td class='has-text-centered has-text-dark'></td>
                            <td class='has-text-centered has-text-dark'></td>
                            <td class='has-text-centered has-text-dark'></td>
                            <td class='has-text-centered has-text-dark'></td>
                        </tr>
                    <?php endfor; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" class="text-end">Total</td>
                        <td class="has-text-centered has-text-dark"></td>
                        <td class="has-text-centered has-text-dark"></td>
                    </tr>
                </tfoot>
            </table>
    </div>
    <footer class="p-1 position-absolute w-100">
        <p class="fs-6 text-center text-white">Universidad De Manila || "Uplifting lives through quality education."</p>
    </footer>
</body>

</html>