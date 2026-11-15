<?php
namespace App\Models;
use App\Core\DB;
class User {
  public static function findByEmail(string $email): ?array {
    $st = DB::pdo()->prepare('SELECT id,name,email,password_hash,role FROM users WHERE email = ? LIMIT 1');
    $st->execute([$email]); $u = $st->fetch();
    return $u ?: null;
  }
}
