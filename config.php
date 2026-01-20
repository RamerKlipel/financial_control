<?php 
require_once './control.php';

$conn = driver .':host='. host .';dbname='. dbname;
$password = trim(password);
$user = trim(user);

try {
    $stmt = new PDO($conn, $user, $password);
} catch (PDOException $e) {
    throw new PDOException ($e->getMessage(), $e->getCode());
}