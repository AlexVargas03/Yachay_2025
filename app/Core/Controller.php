<?php
namespace App\Core;
class Controller {
  protected function view(string $v, array $p = [], ?string $layout = 'layouts/main'): void { View::render($v, $p, $layout); }
  protected function redirect(string $path): void { header("Location: $path"); exit; }
}
