<?php

$conn = new mysqli("localhost", "root", "", "hris");

// Check for connection error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the time inputs from the form
    $time_in  = $_POST["time_in"];
    $time_out = $_POST["time_out"];

    // Convert time-out to military time (24-hour format)
    $time_out_24h = date("H:i:s", strtotime($time_out));

    // Ensure at least one employee was selected
    if (!empty($_POST['selectedEmployees'])) {
        $selectedEmployees = $_POST['selectedEmployees'];

        // Prepare the update query
        // Here, we assume that 'name' uniquely identifies an employee in your masterlist table.
        // If you use an employee ID, update the query and checkbox values accordingly.
        $sql = "UPDATE masterlist SET time_in = ?, time_out = ? WHERE name = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        // Bind and execute for each selected employee
        foreach ($selectedEmployees as $employeeName) {
            // Bind parameters: time_in, time_out, employeeName
            $stmt->bind_param("sss", $time_in, $time_out_24h, $employeeName);
            if (!$stmt->execute()) {
                echo "Error updating record for " . htmlspecialchars($employeeName) . ": " . $stmt->error . "<br>";
                exit();
            }
        }
        $stmt->close();
    } else {
        echo "No employees selected.";
    }

    // Redirect to employee.php after successful update
    header("Location: ../employee.php");

    exit();

    } else {
        echo "Time-in or Time-out value missing.";
        exit();
    }
$conn->close();
?>
