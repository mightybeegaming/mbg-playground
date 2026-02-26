<?php
include '../.common/bootstrap.php';

header('Content-Type: application/json');

$ch = curl_init(URL_UPTIMESTATUS);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 5,
    CURLOPT_SSL_VERIFYPEER => true
]);
echo curl_exec($ch);