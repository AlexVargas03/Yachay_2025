<?php
namespace App\Core;
final class Auth {
  public static function user(): ?array { Session::start(); return $_SESSION['user'] ?? null; }
  public static function login(array $u): void { Session::start(); $_SESSION['user'] = $u; session_regenerate_id(true); }
  public static function logout(): void { Session::start(); $_SESSION = []; session_destroy(); }
  public static function require(): void { if (!self::user()) { header('Location: /login'); exit; } }
}
