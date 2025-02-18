<?php
include('server.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    
    $username = mysqli_real_escape_string($db, $_POST['u']);
    $password = mysqli_real_escape_string($db, $_POST['p']);  

    $login_query = "SELECT * FROM access WHERE status = 'A' 
                    AND user_id = '$username' 
                    AND password = SHA1('$password')";

    $result_login = mysqli_query($db, $login_query);

    if (mysqli_num_rows($result_login) > 0) {
        $row_login = mysqli_fetch_assoc($result_login);
        $_SESSION["user"] = $row_login['user_id'];
        
        // Redirect to index.php after successful login
        header("Location: ../dashboard.php");
        exit();
    } else {
        // Destroy session and show error message
        session_destroy();
        echo "<script>alert('Invalid username or password!'); window.location.href='login.php';</script>";
        exit();
    }
}
?>
