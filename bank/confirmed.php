<!DOCTYPE html>
<html>
<head>
<style>
body{background-color:black;color:white;text-align:center}
a{text-decoration:none;color:#ccf}
#zdiv{border:1px solid white;width:600px;margin:auto;margin-top:10px;background-color:#222}
#titl{border:1px solid white;width:600px;font-size:30pt;margin:auto;margin-top:10px;background-color:#222}
#links{font-size:14pt;margin-top:5px}
</style>
</head>
<body>
<div id="titl">
Twój bank
<div id="links">
<?php
session_start();
if(isset($_SESSION['userlogged'])){
    $login = $_SESSION['userlogged'];
    echo("Zalogowany: ".$_SESSION['userlogged'] . '<br/>' . file_get_contents('logged.txt'));
} else {
    header("Location: login.php");
}
?>
</div>
</div>
<div id="zdiv">

<p>
<h3>Przelew został zarejestrowany.</h3>
</p>
<table style="width:100%">
<?php

    $con = mysqli_connect("localhost","root","zaq1@WSX","bank");
    
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    } else {
        $id = $_GET['i'];
        $stmt = $con->prepare("SELECT * FROM transfer INNER JOIN users ON transfer.userid=users.id WHERE transfer.id=? AND users.login=?;");
        $stmt->bind_param('is',$id,$login);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result){
            if($row=$result->fetch_object()){
                $name = $row->trName;
                $account = $row->trNr;
                $amount = $row->amount;
                $address = $row->address;
                $title = $row->title;
                $date = $row->trDate;
echo "<tr><td>" . "Nazwa odbiorcy" . "</td><td>" . $name . "</td></tr>";
echo "<tr><td>" . "Numer rachunku" . "</td><td>" . $account . "</td></tr>";
echo "<tr><td>" . "Kwota" . "</td><td>" . $amount . " zł</td></tr>";
echo "<tr><td>" . "Adres" . "</td><td>" . $address . "</td></tr>";
echo "<tr><td>" . "Tytuł przelewu" . "</td><td>" . $title . "</td></tr>";
echo "<tr><td>" . "Data zarejestrowania" . "</td><td>" . $date . "</td></tr>";
            } else {
                echo "Nie ma takiego hakierzenia!";
            }
            
        } else {
            echo "uuu";
        }
    }


?>
</table>
</div>
</body>
</html>
