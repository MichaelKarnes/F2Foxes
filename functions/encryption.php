<?php
function encrypt($string, $key) {
    return base64_encode(openssl_encrypt($string, "AES-256-CBC", $key));
}
function decrypt($string, $key) {
    return openssl_decrypt(base64_decode($string), "AES-256-CBC", $key);
}
?>
