<?php
namespace App\Core;
final class Router {
  private static array $routes = ['GET'=>[], 'POST'=>[]];
  public static function get(string $path, callable $handler): void { self::$routes['GET'][$path] = $handler; }
  public static function post(string $path, callable $handler): void { self::$routes['POST'][$path] = $handler; }
  public static function dispatch(string $uri, string $method): void {
    $path = parse_url($uri, PHP_URL_PATH) ?: '/';
    $routes = self::$routes[$method] ?? [];
    $handler = $routes[$path] ?? null;
    if (is_array($handler) && is_object($handler[0])) { $handler[0]->{$handler[1]}(); return; }
    if (is_callable($handler)) { $handler(); return; }
    http_response_code(404); echo '404 Not Found';
  }
}
