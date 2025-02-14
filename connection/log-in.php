<?php
    include('server.php'); 
    $username = mysqli_real_escape_string($db,$_POST['u']);
    $password = mysqli_real_escape_string($db,$_POST['p']);  

    $login_query = "SELECT * FROM access WHERE status = 'A' AND user_id = '".$username."' AND password = SHA1('".$password."');";
    $result_login = mysqli_query($db, $login_query);
    $row_login = mysqli_fetch_assoc($result_login);

    if(mysqli_num_rows($result_login) > 0){
        session_start();
        $_SESSION["user"] = $row_login['user_id'];
            echo './index.php';
        exit();
    }
    else{
        if(session_start())
            session_destroy();
        echo "invalid";
        exit();
    }