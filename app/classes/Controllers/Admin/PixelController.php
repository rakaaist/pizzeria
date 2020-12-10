<?php


namespace App\Controllers\Admin;


use App\App;
use App\Controllers\Base\AuthController;
use App\Views\BasePage;
use App\Views\Forms\Admin\AddForm;
use App\Views\Forms\Admin\EditForm;

class PixelController extends AuthController
{
    protected $formEdit;
    protected $formAdd;
    protected $pageEdit;
    protected $pageAdd;

    public function __construct()
    {
        parent:: __construct();

        $this->formEdit = new EditForm();

        $this->formAdd = new AddForm();

        $this->pageEdit = new BasePage([
            'title' => 'Edit'
        ]);

        $this->pageAdd = new BasePage([
            'title' => 'Add'
        ]);

    }

    public function indexEdit()
    {
        $id = $_GET['id'] ?? null;
        $row = App::$db->getRowById('pixels', $id);
        unset($row['email']);
        $this->formEdit->fill($row);

        if ($this->formEdit->validateForm()) {
            $clean_inputs = $this->formEdit->values();
            $clean_inputs['email'] = $_SESSION['email'];
            App::$db->updateRow('pixels', $id, $clean_inputs);
            header("Location: ../list");
            exit();
        }

        $this->pageEdit->setContent($this->formEdit->render());

        print $this->pageEdit->render();
    }

    public function indexAdd()
    {
        if ($this->formAdd->validateForm()) {
            $clean_inputs = $this->formAdd->values();
            $clean_inputs['email'] = $_SESSION['email'];
            App::$db->insertRow('pixels', $clean_inputs);
        }

        $this->pageAdd->setContent($this->formAdd->render());

        return $this->pageAdd->render();
    }

}