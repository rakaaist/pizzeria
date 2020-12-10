<?php

use App\App;
use Core\Router;

Router::add('index', '/', '\App\Controllers\HomeController', 'index');
Router::add('index2', '/index', '\App\Controllers\HomeController', 'index');

Router::add('login', '/login', '\App\Controllers\LoginController', 'index');
Router::add('register', '/register', '\App\Controllers\RegisterController', 'index');
Router::add('add', '/add', '\App\Controllers\Admin\PixelController', 'indexAdd');
Router::add('my', '/my', '\App\Controllers\Admin\MyController', 'index');
Router::add('list', '/list', '\App\Controllers\Admin\ListController', 'index');
Router::add('edit', '/edit', '\App\Controllers\Admin\PixelController', 'indexEdit');
Router::add('install', '/install', '\App\Controllers\InstallController', 'install');
Router::add('logout', '/logout', '\App\Controllers\Admin\LogoutController', 'logout');
