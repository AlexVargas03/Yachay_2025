<?php
use App\Core\Router;
use App\Controllers\AuthController;
use App\Controllers\DashboardController;

Router::get('/login', [new AuthController, 'showLogin']);
Router::post('/login', [new AuthController, 'login']);
Router::get('/logout', [new AuthController, 'logout']);
Router::get('/', [new DashboardController, 'index']);
