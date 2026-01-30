<?php
require_once __DIR__ . '/control.php';

$conn = driver .':host='. host .';dbname='. dbname;
$password = trim(password);
$user = trim(user);

try {
    $stmt = new PDO($conn, $user, $password);
} catch (PDOException $e) {
    echo 'erro ao conectar ao banco de dados: ' .$e->getMessage(). ' arquivo: ' .$e->getFile(). ' linha: ' .$e->getLine(). ' Código do erro: ', $e->getCode();die;
}
