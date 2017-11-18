<?php

require_once("functions.php");

function err($message){
    
    header("Location: login.php?error=" . $message);
}
session_start();
                    
$login = $_POST["login"];
$pass = $_POST["passwd"];
if($login==""){
    err("emptylogin");
} else if($pass==""){
    err("emptypass");
} else if(strlen($login)<5 || strlen($login)>20){
    err("loginlength");
} else if(strlen($pass)<8 || strlen($pass)>40){
    err("passlength");
} else {
    $con = mysqli_connect("localhost","root","zaq1@WSX","bank");

    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    } else {
        $stmt = $con->prepare("SELECT passwd FROM users WHERE login=?;");
        $stmt->bind_param('s',$login);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result){
            if($row=$result->fetch_object()){
                if(checkpassword($pass,$row->passwd)){
                    $_SESSION['userlogged'] = $login;
                    header("Location: login.php");
                } else {
                    err("wrongdata");
                }
                
            } else {
                err("wrongdata");
            }
        }
    }
    
}

?>