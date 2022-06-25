<?php 
    if(isset($_COOKIE["profileid"])) {
        //setcookie("profileid", "", time() - 3600, "/Kelvin-Factory-Website");
        setcookie("profileid", "", time() - 3600, "/");
    }
    header("Location: login.php");
    exit();

    // if (isset($_SERVER['HTTP_COOKIE'])) {
    //     $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    //     foreach($cookies as $cookie) {
    //         $parts = explode('=', $cookie);
    //         $name = trim($parts[0]);
    //         setcookie($name, '', time()-1000);
    //         setcookie($name, '', time()-1000, '/');
    //     }
    // }
?>
