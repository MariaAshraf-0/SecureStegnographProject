<?php

function encryptData($data, $key) {
    $cipher = "AES-128-CTR";
    $iv = "1234567891011121";
    return openssl_encrypt($data, $cipher, $key, 0, $iv);
}

function decryptData($data, $key) {
    $cipher = "AES-128-CTR";
    $iv = "1234567891011121";
    return openssl_decrypt($data, $cipher, $key, 0, $iv);
}

?>