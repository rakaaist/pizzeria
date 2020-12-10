<?php

namespace App\Controllers\Admin;

use App\App;
use App\Controllers\Base\AuthController;
use App\Views\BasePage;
use Core\View;

class MyController extends AuthController
{
    protected $page;
    protected $content;

    public function __construct()
    {
        parent:: __construct();
        $this->page = new BasePage([
            'title' => 'My'
        ]);
    }

    public function index() {

        $this->content = new View([
                'pixels' => App::$db->getRowsWhere('pixels', ['email' => $_SESSION['email']])
            ]
        );

        $this->page->setContent($this->content->render(ROOT . '/app/templates/content/index.tpl.php'));

        return $this->page->render();
    }
}