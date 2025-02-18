<?php
session_start();
include('./connection/server.php');

// Fetch user details from the database
$query = "SELECT * FROM user WHERE user_id = '" . $_SESSION["user"] . "'";
$result = mysqli_query($db, $query);
$row = mysqli_fetch_assoc($result);

// Handle search
$name = isset($_GET['name']) ? trim($_GET['name']) : '';


$attendance = [];
$monthName = "";

if (!empty($name)) {
    $query = "SELECT * FROM temp_csv_data WHERE name LIKE ? ORDER BY date ASC";
    $stmt = $db->prepare($query);
    $searchParam = "%$name%";
    $stmt->bind_param("s", $searchParam);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($record = $result->fetch_assoc()) {
        $day = date("j", strtotime($record['date']));
        $monthName = date("F", strtotime($record['date'])); // Extract and convert month to words
        $attendance[$day][] = $record;
    }

    $stmt->close();
}

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

    <div class="cta-btn d-flex justify-content-end w-75 p-2">
        <div class="upload-file">
            <form action="./connection/upload.php" method="post" enctype="multipart/form-data" class="upload-form shadow-none">
                <label class="file-label">
                    <input class="file-input" type="file" name="csv_file" id="csvFileInput" />
                </label>
                <button type="submit" class="upload-btn btn btn-dark me-1">
                <i class="bi bi-upload"></i>
                    Upload
                </button>
            </form>
        </div>
        <div class="print-btn">
            <button class="btn btn-primary">
                <span>
                    <i class="bi bi-printer"></i>
                </span>
                print
            </button>
        </div>
    </div>

    <div class="dtcontainer">
        <h1 class="text-center">Daily Time Record</h1>
        <p class="sty text-center">-----o0o-----</p>

        <p class="employee-name text-center">____________________________________________________
        <p class="empname text-center"><?= $name ?: "Employee Name" ?></p>
        </p>

        <div class="epame text-center">
            <p>(Name)</p>
        </div>

        <div class="months">
            <p class="month">For the month of <u><?php echo $monthName; ?></u> </p>
        </div>

        <div>
            <p class="work official"> Official hours for</p>
            <p class="reg text-center"> Regular days _______________</p>
        </div>

        <div class="work1">
            <p class="arrive"> arrival and departure</p>
            <p class="sat text-center"> Saturdays _______________</p>
        </div>
        <table class="tbl table-bordered border-black text-center w-50 m-auto">
            <thead>
                <tr>
                    <th rowspan="2" class="has-text-centered text-black">Day</th>
                    <th colspan="2" class="has-text-centered text-black">A.M.</th>
                    <th colspan="2" class="has-text-centered text-black">P.M.</th>
                    <th colspan="2" class="has-text-centered text-black">Undertime</th>
                </tr>
                <tr>
                    <th class="has-text-centered text-black">Arrival</th>
                    <th class="has-text-centered text-black">Departure</th>
                    <th class="has-text-centered text-black">Arrival</th>
                    <th class="has-text-centered text-black">Departure</th>
                    <th class="has-text-centered text-black">Hours</th>
                    <th class="has-text-centered text-black">Minutes</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($day = 1; $day <= 31; $day++) {
                    echo "<tr>
                        <td class='has-text-centered has-text-dark'>$day</td>";

                    if (isset($attendance[$day])) {
                        $record = $attendance[$day][0];
                        $time_in = date("H:i", strtotime($record['time_in']));
                        $time_out = date("H:i", strtotime($record['time_out']));

                        // AM & PM Splitting
                        $am_arrival = (strtotime($time_in) < strtotime("12:00")) ? $time_in : "";
                        $am_departure = (strtotime($time_out) < strtotime("12:00")) ? $time_out : "";
                        $pm_arrival = (!$am_arrival) ? $time_in : "";
                        $pm_departure = (!$am_departure) ? $time_out : "";

                        // Calculate undertime if shift is less than 8 hours
                        $undertime_hours = "";
                        $undertime_minutes = "";
                        if ($time_in && $time_out) {
                            $shift_hours = 8;
                            $worked_hours = (strtotime($time_out) - strtotime($time_in)) / 3600;
                            if ($worked_hours < $shift_hours) {
                                $undertime = $shift_hours - $worked_hours;
                                $undertime_hours = floor($undertime);
                                $undertime_minutes = ($undertime - $undertime_hours) * 60;
                            }
                        }

                        echo "
                            <td class='has-text-centered has-text-dark'>$am_arrival</td>
                            <td class='has-text-centered has-text-dark'>$am_departure</td>
                            <td class='has-text-centered has-text-dark'>$pm_arrival</td>
                            <td class='has-text-centered has-text-dark'>$pm_departure</td>
                            <td class='has-text-centered has-text-dark'>$undertime_hours</td>
                            <td class='has-text-centered has-text-dark'>$undertime_minutes</td>";
                    } else {
                        echo "<td class='has-text-centered has-text-dark'></td>
                              <td class='has-text-centered has-text-dark'></td>
                              <td class='has-text-centered has-text-dark'></td>
                              <td class='has-text-centered has-text-dark'></td>
                              <td class='has-text-centered has-text-dark'></td>
                              <td class='has-text-centered has-text-dark'></td>";
                    }

                    echo "</tr>";
                }
                ?>
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

    <script src="./js/print.js"></script>
</body>

</html>