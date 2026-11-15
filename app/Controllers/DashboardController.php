<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Core\Auth;

class DashboardController extends Controller {
  public function index(): void {
    Auth::require();
    $this->view('dashboard/index', ['user' => Auth::user()]);
  }
}
