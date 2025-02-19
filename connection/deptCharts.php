<?php
include('server.php'); 

// PERMANENT
$permaCas = mysqli_query($db, "SELECT COUNT(*) AS stats FROM masterlist WHERE status = 'Permanent' AND department = 'cas';");
$permaCasCount = mysqli_fetch_assoc($permaCas)['stats'];

$permaCet = mysqli_query($db, "SELECT COUNT(*) AS stats FROM masterlist WHERE status = 'Permanent' AND department = 'cet';");
$permaCetCount = mysqli_fetch_assoc($permaCet)['stats'];

$permaCed = mysqli_query($db, "SELECT COUNT(*) AS stats FROM masterlist WHERE status = 'Permanent' AND department = 'ced';");
$permaCedCount = mysqli_fetch_assoc($permaCed)['stats'];

$permaCba = mysqli_query($db, "SELECT COUNT(*) AS stats FROM masterlist WHERE status = 'Permanent' AND department = 'cba';");
$permaCbaCount = mysqli_fetch_assoc($permaCba)['stats'];

$permaChs = mysqli_query($db, "SELECT COUNT(*) AS stats FROM masterlist WHERE status = 'Permanent' AND department = 'chs';");
$permaChsCount = mysqli_fetch_assoc($permaChs)['stats'];

$permaCcj = mysqli_query($db, "SELECT COUNT(*) AS stats FROM masterlist WHERE status = 'Permanent' AND department = 'ccj';");
$permaCcjCount = mysqli_fetch_assoc($permaCcj)['stats'];

// PART-TIME (or COS)
$ptCas = mysqli_query($db, "SELECT COUNT(*) AS stats FROM masterlist WHERE status = 'Part-Time' AND department = 'cas';");
$ptCasCount = mysqli_fetch_assoc($ptCas)['stats'];

$ptCet = mysqli_query($db, "SELECT COUNT(*) AS stats FROM masterlist WHERE status = 'Part-Time' AND department = 'cet';");
$ptCetCount = mysqli_fetch_assoc($ptCet)['stats'];

$ptCed = mysqli_query($db, "SELECT COUNT(*) AS stats FROM masterlist WHERE status = 'Part-Time' AND department = 'ced';");
$ptCedCount = mysqli_fetch_assoc($ptCed)['stats'];

$ptCba = mysqli_query($db, "SELECT COUNT(*) AS stats FROM masterlist WHERE status = 'Part-Time' AND department = 'cba';");
$ptCbaCount = mysqli_fetch_assoc($ptCba)['stats'];

$ptChs = mysqli_query($db, "SELECT COUNT(*) AS stats FROM masterlist WHERE status = 'Part-Time' AND department = 'chs';");
$ptChsCount = mysqli_fetch_assoc($ptChs)['stats'];

$ptCcj = mysqli_query($db, "SELECT COUNT(*) AS stats FROM masterlist WHERE status = 'Part-Time' AND department = 'ccj';");
$ptCcjCount = mysqli_fetch_assoc($ptCcj)['stats'];

// JO STATUS
$joCas = mysqli_query($db, "SELECT COUNT(*) AS stats FROM masterlist WHERE status = 'JO' AND department = 'cas';");
$joCasCount = mysqli_fetch_assoc($joCas)['stats'];

$joCet = mysqli_query($db, "SELECT COUNT(*) AS stats FROM masterlist WHERE status = 'JO' AND department = 'cet';");
$joCetCount = mysqli_fetch_assoc($joCet)['stats'];

$joCed = mysqli_query($db, "SELECT COUNT(*) AS stats FROM masterlist WHERE status = 'JO' AND department = 'ced';");
$joCedCount = mysqli_fetch_assoc($joCed)['stats'];

$joCba = mysqli_query($db, "SELECT COUNT(*) AS stats FROM masterlist WHERE status = 'JO' AND department = 'cba';");
$joCbaCount = mysqli_fetch_assoc($joCba)['stats'];

$joChs = mysqli_query($db, "SELECT COUNT(*) AS stats FROM masterlist WHERE status = 'JO' AND department = 'chs';");
$joChsCount = mysqli_fetch_assoc($joChs)['stats'];

$joCcj = mysqli_query($db, "SELECT COUNT(*) AS stats FROM masterlist WHERE status = 'JO' AND department = 'ccj';");
$joCcjCount = mysqli_fetch_assoc($joCcj)['stats'];

// Prepare arrays for the response
$departments = ['CAS', 'CET', 'CED', 'CBA', 'CHS', 'CCJ'];
$permanentEmployees = [$permaCasCount, $permaCetCount, $permaCedCount, $permaCbaCount, $permaChsCount, $permaCcjCount];
$partTimeEmployees   = [$ptCasCount, $ptCetCount, $ptCedCount, $ptCbaCount, $ptChsCount, $ptCcjCount];
$jobOrderEmployees   = [$joCasCount, $joCetCount, $joCedCount, $joCbaCount, $joChsCount, $joCcjCount];

$response = [
    'departments' => $departments,
    'permanentEmployees' => $permanentEmployees,
    'contractEmployees'  => $partTimeEmployees, // if "Contract" is equivalent to "Part-Time"
    'jobOrderEmployees'  => $jobOrderEmployees
];

header('Content-Type: application/json');
echo json_encode($response);
exit();
?>
