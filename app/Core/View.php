<?php
namespace App\Core;
class View {
  public static function render(string $view, array $params = [], ?string $layout = 'layouts/main'): void {
    extract($params, EXTR_SKIP);
    $viewFile = __DIR__ . '/../Views/' . $view . '.php';
    if (!is_file($viewFile)) { http_response_code(500); echo 'View not found'; return; }
    if ($layout === null) { require $viewFile; return; }
    ob_start(); require $viewFile; $content = ob_get_clean();
    require __DIR__ . '/../Views/' . $layout . '.php';
  }
}
