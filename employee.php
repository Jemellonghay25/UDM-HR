<?php
session_start();
include('./connection/server.php');

// Fetch user details
$query = "SELECT * FROM user WHERE user_id = '" . $_SESSION["user"] . "'";
$result = mysqli_query($db, $query);
$row = mysqli_fetch_assoc($result);

// Pagination settings
$limit = 10;
$page = max(1, (int) ($_GET['page'] ?? 1));
$offset = ($page - 1) * $limit;

// Get total records
$totalResult = mysqli_query($db, "SELECT COUNT(DISTINCT emp_id) AS total FROM temp_csv_data");
$totalRecords = mysqli_fetch_assoc($totalResult)['total'];
$totalPages = ceil($totalRecords / $limit);

// Fetch paginated employee data
$employeeResult = mysqli_query($db, "SELECT DISTINCT emp_id, name FROM temp_csv_data LIMIT $limit OFFSET $offset");

// Pagination range
$displayPages = 10;
$startPage = max(1, min($page - floor($displayPages / 2), $totalPages - $displayPages + 1));
$endPage = min($totalPages, $startPage + $displayPages - 1);

$attendance = isset($_SESSION['attendance']) ? $_SESSION['attendance'] : [];
$searched_name = isset($_SESSION['searched_name']) ? $_SESSION['searched_name'] : '';

unset($_SESSION['attendance'], $_SESSION['searched_name']); // Clear session after use

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details</title>
    <link rel="stylesheet" href="./styling/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./js/search.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1b039bb504.js" crossorigin="anonymous"></script>


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
        </div>
    </div>

    <div class="banner">
        <p class="mt-1 h1 fs-3">Permanent Employee</p>
    </div>

    <div class="main-content w-75 p-1">
        <div class="field d-flex d-flex justify-content-between p-1">
            <!-- Search Bar -->
            <div class="search-bar p-2">
                <p>
                    <span class="icon is-small is-left">
                        <i id="glass" class="fas fa-magnifying-glass mt-2 ms-1 p-1 "></i>
                    </span>
                    <input type="text" id="search" class="input" placeholder="Search Faculty" />
                </p>
            </div>
            <div class="dropdown-center ml-1 p-2">
                <button id="deptDropdown" class="btn border border-black rounded-3 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Department
                </button>
                <ul class="dropdown-menu ">
                     <li><a class="dropdown-item" href="#" data-dept="all">All Departments</a></li>
                    <li><a class="dropdown-item" href="#" data-dept="cet">CET</a></li>
                    <li><a class="dropdown-item" href="#" data-dept="ccj">CCJ</a></li>
                    <li><a class="dropdown-item" href="#" data-dept="chs">CHS</a></li>
                    <li><a class="dropdown-item" href="#" data-dept="cba">CBA</a></li>
                    <li><a class="dropdown-item" href="#" data-dept="ced">CED</a></li>
                    <li><a class="dropdown-item" href="#" data-dept="cas">CAS</a></li>
                </ul>
            </div>
        </div>

        <div class="employee-table p-2">
            <table id="empTable" class="table">
                <thead>
                    <tr>
                        <th>USERID</th>
                        <th>NAME</th>
                        <th>STATUS</th>
                        <th>DEPARTMENT</th>
                        <th>VIEW</th>
                    </tr>
                </thead>
                <tbody id="empTableBody">
                    <?php while ($row = mysqli_fetch_assoc($employeeResult)) : ?>
                        <tr>
                            <td><?php echo $row['emp_id']; ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td>Permanent</td>
                            <td>QUAD</td>
                            <td> <a href="./connection/preview.php?name=<?php echo urlencode($row['name']); ?>">
                                    <img src="./assets/image/preview.png" alt="preview">
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <!-- Pagination Controls -->
            <nav class="d-flex justify-content-end">
                <ul class="pagination">
                    <?php if ($page > 1) : ?>
                        <li class="page-item"><a class="page-link text-black" href="?page=<?php echo $page - 1; ?>">Previous</a></li>
                    <?php endif; ?>

                    <?php for ($i = $startPage; $i <= $endPage; $i++) : ?>
                        <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                            <a class="page-link text-black" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($page < $totalPages) : ?>
                        <li class="page-item"><a class="page-link text-black" href="?page=<?php echo $page + 1; ?>">Next</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>

    <footer class="p-1 position-absolute w-100">
        <p class="fs-6 text-center text-white">Universidad De Manila || "Uplifting lives through quality education."</p>
    </footer>
</body>

</html>