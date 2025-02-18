<?php
$targetDir = "uploads/";

// Ensure the uploads folder exists
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
}

$csvFile = $targetDir . basename($_FILES["csv_file"]["name"]);

if (move_uploaded_file($_FILES["csv_file"]["tmp_name"], $csvFile)) {
    // Database Connection
    $conn = new mysqli("localhost", "root", "", "hris");

    // Check for connection error
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Open and Read CSV File
    if (($handle = fopen($csvFile, "r")) !== FALSE) {
        $header = fgetcsv($handle); // Read the first row (headers)

        // Identify column indexes dynamically
        $empIdIndex = array_search("AC-No.", $header);
        $nameIndex = array_search("Name", $header);
        $dateTimeIndex = array_search("Month/Date/Year/Time", $header);

        if ($empIdIndex === false || $nameIndex === false || $dateTimeIndex === false) {
            die("Error: Required columns not found in CSV file.");
        }

        $attendance = [];

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $emp_id = preg_replace('/[^0-9]/', '', $data[$empIdIndex]); // Extract only numbers
            $name = trim($data[$nameIndex]);

            // Extract date and time
            $datetime = strtotime($data[$dateTimeIndex]); // Convert to timestamp
            $date = date("Y-m-d", $datetime); // Extract date
            $time = date("h:i A", $datetime); // Extract time in AM/PM format
            $military_time = date("H:i:s", $datetime); // Convert to 24-hour format
            $ampm = date("A", $datetime); // Extract AM/PM

            // Group by Employee ID and Date
            $key = $emp_id . "_" . $date;

            if (!isset($attendance[$key])) {
                $attendance[$key] = [
                    "emp_id" => $emp_id,
                    "name" => $name,
                    "date" => $date,
                    "time_in" => "",
                    "time_out" => ""
                ];
            }

            // Assign time-in (earliest AM time) and time-out (latest PM time)
            if ($ampm == "AM") {
                if (empty($attendance[$key]["time_in"]) || $military_time < $attendance[$key]["time_in"]) {
                    $attendance[$key]["time_in"] = $military_time;
                }
            } else { // PM time
                if (empty($attendance[$key]["time_out"]) || $military_time > $attendance[$key]["time_out"]) {
                    $attendance[$key]["time_out"] = $military_time;
                }
            }
        }
        fclose($handle);
    }

    // Insert Data into the Database
    $stmt = $conn->prepare("INSERT INTO temp_csv_data (emp_id, name, date, time_in, time_out) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    foreach ($attendance as $entry) {
        $stmt->bind_param(
            "issss",
            $entry["emp_id"],
            $entry["name"],
            $entry["date"],
            $entry["time_in"],
            $entry["time_out"]
        );
        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }
    }

    echo "<script>
        alert('File uploaded successfully!');
        setTimeout(function() {
            window.location.href = '../employee.php';
        }, 1000);
      </script>";

} else {
    echo "Error moving uploaded file. Check folder permissions.";
}
?>
