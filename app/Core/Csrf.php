<?php
namespace App\Core;
final class Csrf {
  public static function token(): string {
    Session::start();
    if (empty($_SESSION['csrf'])) {
      $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
  }
  public static function check(string $token): bool {
    Session::start();
    return isset($_SESSION['csrf']) && hash_equals($_SESSION['csrf'], $token);
  }
}
