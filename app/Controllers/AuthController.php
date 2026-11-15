<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Core\Csrf;
use App\Core\Auth;
use App\Models\User;

class AuthController extends Controller {
  public function showLogin(): void {
    $this->view('login', ['csrf' => Csrf::token(), 'error' => null], null);
  }
  public function login(): void {
    $csrf = $_POST['csrf'] ?? '';
    if (!Csrf::check($csrf)) {
      $this->view('login', ['csrf'=>Csrf::token(), 'error'=>'CSRF inválido. Recarga la página.'], null); return;
    }
    $email = trim($_POST['email'] ?? '');
    $pass  = (string)($_POST['password'] ?? '');
    $user = User::findByEmail($email);
    if (!$user || !password_verify($pass, $user['password_hash'])) {
      $this->view('login', ['csrf'=>Csrf::token(), 'error'=>'Credenciales inválidas'], null); return;
    }
    Auth::login(['id'=>$user['id'],'name'=>$user['name'],'email'=>$user['email'],'role'=>$user['role']]);
    $this->redirect('/');
  }
  public function logout(): void { Auth::logout(); $this->redirect('/login'); }
}
