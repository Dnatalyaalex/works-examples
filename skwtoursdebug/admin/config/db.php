<?php
/* Подключение к базе данных MySQL с помощью вызова драйвера */
$dsn = 'mysql:dbname=skw_tours;host=127.0.0.1';
$user = 'root';
$password = '';


$db = null;
try {
    $db = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Подключение не удалось: ' . $e->getMessage();
}

