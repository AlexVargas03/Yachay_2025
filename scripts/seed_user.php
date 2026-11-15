<?php
require __DIR__.'/../vendor/autoload.php';
use App\Core\DB;

$pdo = App\Core\DB::pdo();
$name  = 'Usuario Demo';
$email = 'usuario@colegio.edu';
$pass  = 'Secreto123!';
$hash  = password_hash($pass, PASSWORD_DEFAULT);

$pdo->prepare('INSERT INTO users (name,email,password_hash,role) VALUES (?,?,?,?)')
    ->execute([$name, $email, $hash, 'alumno']);

echo "Usuario creado: $email / $pass\n";
