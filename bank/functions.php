<?php


function hashpassword($passphrase){
    $newsalt = bin2hex(openssl_random_pseudo_bytes(64));
    return $newsalt . hash_pbkdf2("sha256", $passphrase, $newsalt, 1000,64);
}
function checkpassword($passphrase,$string){
    $salt = substr($string,0,128);
    $hash = substr($string,128);
    if(hash_pbkdf2("sha256", $passphrase, $salt, 1000,64)==$hash){
        return true;
    } else {
        return false;
    }
}


?>