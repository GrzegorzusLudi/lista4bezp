<?php


require_once("functions.php");
function err($message){
    
    header("Location: register.php?error=" . $message);
}
session_start();
                    
$login = $_POST["login"];
$pass = $_POST["passwd"];
$pass2 = $_POST["passwd2"];
if($login==""){
    err("emptylogin");
} else if($pass==""){
    err("emptypass");
} else if(strlen($login)<5 || strlen($login)>20){
    err("loginlength");
} else if(strlen($pass)<8 || strlen($pass)>40){
    err("passlength");
} else if($pass!=$pass2){
    err("passnotmatch");
} else {
    $con = mysqli_connect("localhost","root","zaq1@WSX","bank");

    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    } else {
        $stmt = $con->prepare("SELECT * FROM users WHERE login=?;");
        $stmt->bind_param('s',$login);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result){
            if($row=$result->fetch_object()){
                err("loginexists");
            } else {
                $con->begin_transaction();
                if($stmt = $con->prepare("CALL adduser(?, ?);")){
                    $stmt->bind_param('ss',$login,hashpassword($pass));
                    $stmt->execute();
                    
                    $_SESSION['userlogged'] = $login;
                    header("Location: register.php");
                    
                }
                $con->commit();
            }
        }
    }
    
}

?>