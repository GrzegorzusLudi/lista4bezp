<!DOCTYPE html>
<html>
<head>
<style>
body{background-color:black;color:white;text-align:center}
a{text-decoration:none;color:#ccf}
#zdiv{border:1px solid white;width:400px;margin:auto;margin-top:10px;background-color:#222}
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
    header("Location: przelew.php");
} else {
    echo(file_get_contents('./unlogged.txt'));
}
?>
</div>
</div>
<div id="zdiv">

<p>
Zarejestruj:
</p>
<form method="POST" action="registertodatabase.php">

Numer konta: <input type="text" name="login"/><br>
Hasło: <input type="password" name="passwd"/><br>
Powtórz hasło: <input type="password" name="passwd2"/><br>


<div style="color:red">
<?php
if(empty($_GET["error"])){
    echo "";
}else if($_GET["error"]=="emptylogin") {
    echo "Pusty login!";
}else if($_GET["error"]=="emptypass") {
    echo "Puste hasło!";
}else if($_GET["error"]=="loginlength") {
    echo "Login powinien mieć od 5 do 20 znaków!";
}else if($_GET["error"]=="passlength") {
    echo "Hasło powinien mieć od 8 do 40 znaków!";
}else if($_GET["error"]=="passnotmatch") {
    echo "Powtórz hasło poprawnie!";
}else if($_GET["error"]=="loginexists") {
    echo "Istnieje użytkownik o podanej nazwie!";
}
?>
</div>

<input type="submit" value="Rejestruj" />
</form>
</div>
</body>
</html>
