<?php
namespace App\Core;
final class Session {
  public static function start(): void {
    if (session_status() === PHP_SESSION_NONE) {
      session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'domain' => '',
        'secure' => isset($_SERVER['HTTPS']),
        'httponly' => true,
        'samesite' => 'Strict'
      ]);
      session_start();
    }
  }
}
