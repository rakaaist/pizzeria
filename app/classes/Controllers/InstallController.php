<?php


namespace App\Controllers;


use App\App;
use Core\FileDB;

class InstallController
{
    public function install()
    {
        App::$db = new FileDB(DB_FILE);

        App::$db->createTable('users');
        App::$db->insertRow('users', ['email' => 'test@gmail.com', 'password' => 'test']);
        App::$db->createTable('tracker');
        App::$db->createTable('pixels');
    }

}