<?php
session_start();
if (isset($_SESSION['user']))
    header('location: ./index.php');
else
    session_destroy();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Information System Login</title>
    <link rel="shortcut icon" href="./assets/image/udm-logo-1.png" />
    <link rel="stylesheet" href="./styling/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    

</head>

<body>
    <div class="container-fluid d-flex justify-content-center align-items-center">
        <form class="form w-25 p-3 rounded-3" action="./connection/log-in.php" method="POST">
            <h5 class="text-black text-center fw-bold m-3">
                UDM HR Login
            </h5>
            <div class="mb-3 mt-3 position-relative">
                <i class="bi bi-envelope position-absolute fs-5 ps-3 pt-1"></i>
                <input type="text" class="form-control" name="u" id="username" placeholder="Username" required>
            </div>
            <div class="mb-3 position-relative">
                <i class="bi bi-lock position-absolute fs-5 ps-3 pt-1"></i>
                <input type="password" class="form-control" name="p" id="pass" placeholder="Password" required>
            </div>
            <button type="submit" class="btn mt-1 w-100">Submit</button>
        </form>
        <p class="footerText fs-6 text-center">Universidad De Manila || "Uplifting lives through quality education."</p>
    </div>
</body>

</html>