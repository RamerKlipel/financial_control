<?php
namespace Core;
require_once __DIR__.'/../core/functions.php';
use Core\core;
use Core\html;

abstract class form extends core{
    public $nmPage = '';
    protected $arrInputs = [];
    protected $viewForm = "form";
    protected $viewTable = "table";

    public function __construct($nmPage = '')
    {
        parent::__construct();
        $this->setNmPage($nmPage);
        $this->Form();
        $this->Table();
        $this->callViewFrom(!empty($this->acao) ? $this->viewForm : $this->viewTable);
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

    public function Form()
    {

    }

    public function Table()
    {

    }

    public function setViewForm(string $viewForm):void
    {
        $this->viewForm = $viewForm;
    }

    public function setViewTable(string $viewTable):void
    {
        $this->viewTable = $viewTable;
    }
}
