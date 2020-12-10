<?php


namespace App\Controllers;


use App\App;
use App\Controllers\Base\GuestController;
use App\Views\BasePage;
use App\Views\Forms\RegisterForm;

class RegisterController extends GuestController
{
    protected $form;
    protected $page;

    public function __construct()
    {
        parent:: __construct();
        $this->form = new RegisterForm();
        $this->page = new BasePage([
            'title' => 'Register'
        ]);
    }

    public function index()
    {
        if ($this->form->validateForm()) {
            $clean_inputs = $this->form->values();
            unset($clean_inputs['password_repeat']);
            App::$db->insertRow('users', $clean_inputs);
            header("location: /login");
        }

        $this->page->setContent($this->form->render());

        return $this->page->render();
    }

}