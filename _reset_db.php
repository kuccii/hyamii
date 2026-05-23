<?php
$pdo = new PDO('mysql:host=127.0.0.1;port=3306', 'root', '');
$pdo->exec('DROP DATABASE IF EXISTS hyamii_resto');
$pdo->exec('CREATE DATABASE hyamii_resto CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');
echo "Database recreated successfully\n";
