<?php
// Check if a file was uploaded

$conn = new mysqli("localhost", "root", "", "hris");

// Check for connection error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (!isset($_FILES["csv_file"]) || $_FILES["csv_file"]["error"] !== UPLOAD_ERR_OK) {
    die("Error: No file uploaded or upload error.");
}

// Open and Read CSV File
if (($handle = fopen($_FILES["csv_file"]["tmp_name"], "r")) !== FALSE) {
    $header = fgetcsv($handle); // Read the first row (headers)

    // Identify column indexes dynamically
    $userIdIndex = array_search("USERID", $header);
    $nameIndex = array_search("Name", $header);
    $statusIndex = array_search("STATUS", $header);
    $departmentIndex = array_search("DEPARTMENT", $header);

    if ($userIdIndex === false || $nameIndex === false || $statusIndex === false || $departmentIndex === false) {
        die("Error: Required columns not found in CSV file.");
    }

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO masterlist (emp_id, name, status, department) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $userid = trim($data[$userIdIndex]);
        $name = trim($data[$nameIndex]);
        $status = trim($data[$statusIndex]);
        $department = trim($data[$departmentIndex]);

        // Skip rows where name, status, or department are "#N/A" or "0"
        if ($name == "#N/A" || $status == "#N/A" || $department == "#N/A" || $name == "0" || $status == "0" || $department == "0") {
            continue;
        }

        $stmt->bind_param("isss", $userid, $name, $status, $department);
        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }
    }
    fclose($handle);

    echo "<script>
        alert('File uploaded and processed successfully!');
        setTimeout(function() {
            window.location.href = '../employee.php';
        }, 1000);
    </script>";
}

$stmt->close();
$conn->close();
?>
