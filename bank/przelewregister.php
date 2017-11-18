<?php


function err($message){
    
    header("Location: przelew.php?error=" . $message);
}
$name = $_POST['name'];
$acc = str_replace(' ', '', $_POST['account']);
$amount = str_replace(',','.',$_POST['amount']);
$addr = $_POST['address'];
$title = $_POST['title'];

if(strlen($acc)!=26 || !ctype_digit($acc)){
    err("account");
} else if(!is_numeric($amount) || floor($amount*100)!=$amount*100) {
    err("amount");
} else if($amount<=0) {
    err("smallamount");
} else if($amount>=99999999.99) {
    err("bigamount");
} else if(strlen($name)>70){
    err("longname");
} else if(strlen($addr)>70){
    err("longaddr");
} else if(strlen($title)>140){
    err("longtitle");
} else {

    //header("Location: confirm.php?" . http_build_query($_POST));

}





?>
<!DOCTYPE html>
<html>
    <body onload="document.forms[0].submit()">
        <form action="confirm.php" method="post">
            <?php foreach( $_POST as $key => $val ): ?>
                <input type="hidden" name="<?= htmlspecialchars($key, ENT_COMPAT, 'UTF-8') ?>" value="<?= htmlspecialchars($val, ENT_COMPAT, 'UTF-8') ?>">
            <?php endforeach; ?>
        </form>
    </body>
</html>