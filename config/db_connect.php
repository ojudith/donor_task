<?php

$host = 'localhost';
$db = 'wikimedia_task';
$user = 'root';
$password = '';


$dsn = "mysql:host={$host};dbname={$db};charset=UTF8";


try{
    $pdo = new PDO($dsn , $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
}