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
