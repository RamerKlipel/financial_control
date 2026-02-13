<?php
namespace Core;
require_once __DIR__.'/../core/functions.php';
use Core\core;
use Core\html;
use Core\form;
use Core\table;

abstract class pageForm extends core{
    public $nmPage = '';
    protected $arrInputs = [];
    protected $fieldsSubmit = [];
    protected $viewForm = "form";
    protected $viewTable = "table";

    public function __construct($nmPage = '')
    {
        parent::__construct();
        $this->setNmPage($nmPage);
        $this->Form();
        $this->Table();
        if (!empty($this->acao)) {
            $this->renderForm();
        } else {
            $this->renderTable();
        }
    }

    private function setNmPage(?string $nmPage):void
    {
        $this->nmPage = $nmPage ?? '';
    }

    protected function getNmPage(): string
    {
        return $this->nmPage;
    }

    protected function addInput(string $type, string $idInput, string $label = '', array $arrAttrInput = []): void
    {
        $this->arrInputs[] = html::addInput($type, $idInput, $label, $arrAttrInput);
    }

    protected function addTable(string $idInput, string $label = '', array $arrAttrInput = []): void
    {
        $this->arrInputs[] = html::addTable($idInput, $label, $arrAttrInput);
    }

    public function Form() {}
    public function Table() {}

    public function renderForm()
    {
        $form = new form();
    }

    public function renderTable()
    {
        $table = new table();
    }

    public function setViewForm(string $viewForm):void
    {
        $this->viewForm = $viewForm;
    }

    public function setViewTable(string $viewTable):void
    {
        $this->viewTable = $viewTable;
    }

    public function submit()
    {

    }

    public function setFieldsSubmit(array $fieldsSubmit):void
    {
        $this->fieldsSubmit[] = $fieldsSubmit;
    }
}
