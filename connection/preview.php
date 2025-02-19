<?php
include('../connection/server.php'); // Ensure DB connection is included

if (isset($_GET['name']) && !empty($_GET['name'])) {
    $name = urldecode($_GET['name']); // Decode name from URL
    
    // Prepare and execute search query
    $query = "SELECT * FROM temp_csv_data WHERE name LIKE ? ORDER BY date ASC";
    $stmt = $db->prepare($query);
    $searchParam = "%$name%";
    $stmt->bind_param("s", $searchParam);
    $stmt->execute();
    $result = $stmt->get_result();

    // Store attendance data in an array
    $attendance = [];
    while ($record = $result->fetch_assoc()) {
        $day = date("j", strtotime($record['date']));
        $attendance[$day][] = $record;
    }

    $stmt->close();

    // Redirect to index.php with the attendance data
    session_start();
    $_SESSION['attendance'] = $attendance;
    $_SESSION['searched_name'] = $name;
    
    header("Location: ../dtr.php?name=" . urlencode($name));
    exit();
    
}
?>
