<?php
$allowedMethods = ['GET'];
if(!in_array($_SERVER['REQUEST_METHOD'], $allowedMethods)) {
    header('HTTP/1.1 405 Method Not Allowed');
    header('Allow: ' . implode(', ', $allowedMethods));

    echo json_encode(['error' => 'You have no power over here.']);
    
    exit;
}