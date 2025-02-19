<?php
include('server.php'); 

//COUNTING OF ALL JOB STATUS

// Total Permanent Status
$permanent = mysqli_query($db, "SELECT COUNT(*) AS total_permanent FROM masterlist WHERE status = 'Permanent';");
$permanentCount = mysqli_fetch_assoc($permanent)['total_permanent'];

// Total JO Status
$jo = mysqli_query($db, "SELECT COUNT(*) AS total_jo FROM masterlist WHERE status = 'JO';");
$joCount = mysqli_fetch_assoc($jo)['total_jo'];

// Total COS Status
$cos = mysqli_query($db, "SELECT COUNT(*) AS total_cos FROM masterlist WHERE status = 'COS';");
$cosCount = mysqli_fetch_assoc($cos)['total_cos'];

// Total Part-Time Status
$pt = mysqli_query($db, "SELECT COUNT(*) AS total_pt FROM masterlist WHERE status = 'Part-Time';");
$ptCount = mysqli_fetch_assoc($pt)['total_pt'];




$response = [
    'total_permanent' => $permanentCount,
    'total_cos'       => $cosCount,
    'total_jo'        => $joCount,
    'total_pt'        => $ptCount
];

header('Content-Type: application/json');
echo json_encode($response);
exit();
?>
