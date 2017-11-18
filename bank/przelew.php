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
Przelew:
</p>
<form method="POST" id="f" action="przelewregister.php">
Nazwa odbiorcy: <input type="text" name="name"/><br>
Numer konta: <input type="text" name="account"/><br>
Kwota: <input type="text" name="amount"/> zł<br>
Adres:<br/>
<textarea name="address" form="f"></textarea><br/>
Tytuł:<br/>
<textarea name="title" form="f"></textarea>
<div style="color:red">
<?php
if(empty($_GET["error"])){
    echo "";
} else if($_GET["error"]=="account") {
    echo "Numer konta musi składać się z 26 cyfr opcjonalnie oddzielonych spacjami.";
} else if($_GET["error"]=="amount") {
    echo "Zły format kwoty.";
} else if($_GET["error"]=="smallamount") {
    echo "Kwota musi być dodatnia.";
} else if($_GET["error"]=="bigamount") {
    echo "Kwota za duża.";
} else if($_GET["error"]=="longname") {
    echo "Nazwa odbiorcy musi mieć do 70 znaków.";
} else if($_GET["error"]=="longaddr") {
    echo "Adres musi zawierać do 70 znaków.";
} else if($_GET["error"]=="longtitle") {
    echo "Tytuł musi mieć do 140 znaków.";
} else if($_GET["error"]=="err") {
    echo "Coś chyba próbowałeś kombinować. >:/";
}
?>
</div>
<input type="submit" value="Wykonaj" />
</form>
</div>
</body>
</html>
