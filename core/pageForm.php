<?php
namespace Core;
require_once __DIR__.'/../core/functions.php';
use Core\core;
use Core\html;
use Core\table;
use Core\form;

abstract class pageForm extends core{
    use table;
    use form;

    public $nmPage = '';
    protected $arrInputs = [];
    protected $fieldsSubmit = [];
    protected $nmViewForm = "form";
    protected $nmViewTable = "table";
    protected $viewFormContent;

    public function __construct(string $nmPage, string $sqlTable)
    {
        parent::__construct($sqlTable);
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

    public function Form() {

    }
    public function Table() {

    }

    public function renderTable()// TODO fazer essa função na trait table
    {
        self::echo2();
    }

    public function setViewForm(string $nmViewForm):void
    {
        $this->nmViewForm = $nmViewForm;
    }

    public function setViewTable(string $nmViewTable):void
    {
        $this->nmViewTable = $nmViewTable;
    }

    public function getViewForm(): string
    {
        return $this->nmViewForm;
    }

    public function getViewTable(): string
    {
        return $this->nmViewTable;
    }

    public function submit()
    {

    }

    public function setFieldsSubmit(array $fieldsSubmit):void
    {
        $this->fieldsSubmit[] = $fieldsSubmit;
    }

    public function getArrInput():array
    {
        return $this->arrInputs;
    }
}
