<?php
namespace Core;
require_once __DIR__.'/../core/functions.php';
use Core\core;
use Core\table;
use Core\form;

abstract class pageForm extends core{
    use table;
    use form;

    public $nmPage = '';
    protected $fieldsSubmit = [];
    protected $nmViewForm = "form";
    protected $nmViewTable = "table";
    public function __construct(string $nmPage, string $sqlTable)
    {
        parent::__construct($sqlTable);
        $this->catchFunction();
        $this->setNmPage($nmPage);
        $this->Form();
        $this->Table();
        $this->addJs("pageForm");
        if (!empty($this->action)) {
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

    public function Form() {

    }
    public function Table() {

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

    public function setFieldsSubmit(array $fieldsSubmit):void
    {
        $this->fieldsSubmit[] = $fieldsSubmit;
    }

    public function catchFunction()
    {
        $arrUrl = $this->handleUrl($this->get['url']);
        if (!empty($arrUrl["METHOD"] ?? [])) {
            $method = $arrUrl["METHOD"];
            if (method_exists($this, $method)){
                call_user_func([$this, $method]);
            }
        }
    }
}
