<?php


namespace App\Controllers\Admin;


use App\App;
use App\Controllers\Base\AuthController;
use App\ListTable;
use App\Views\BasePage;
use App\Views\Forms\Admin\DeleteForm;
use Core\Views\Form;


class ListController extends AuthController
{
    protected $table;
    protected $page;
    protected $form;

    public function __construct()
    {
        parent:: __construct();

        $this->page = new BasePage([
            'title' => 'List'
        ]);
    }

    public function index()
    {
        if (Form::action()) {
            $this->form = new DeleteForm();

            if ($this->form->validateForm()) {
                App::$db->deleteRow('pixels', $this->form->values()['row_id']);
            }
        }

        $this->table = new ListTable();

        $this->page->setContent($this->table->render());

        return $this->page->render();
    }
}