<?php
$playitDomain = 'mbgplayground.playit.plus';
if(isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] === $playitDomain){
    header('Location: https://mbgplayground.xyz' . $_SERVER['REQUEST_URI'], true, 301);
    exit;
}