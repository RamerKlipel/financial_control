<?php

namespace Core;

use Core\core;
use Core\table;
use Core\form;

abstract class PageFilter extends core
{
    use table;
    use form;
    public string $nmPage;
    public string $mainView;
    public string $nmViewForm = "pagefilter/pagefilterform";
    public string $nmViewTable = "pagefilter/pagefiltertable";
    public array $arrFieldsFilter;
    public function __construct(string $nmPage, string $sqlTable)
    {
        parent::__construct($sqlTable);
        $this->setNmPage($nmPage);
        $this->Form();
        $this->Table();
        $this->addJs("../utilities/maskhelper", ['type' => "module"]);
    }

    abstract public function Form(): void;

    abstract public function Table(): void;

    public function main(): void {}

    private function setNmPage(?string $nmPage): void
    {
        $this->nmPage = $nmPage ?? '';
    }

    protected function getNmPage(): string
    {
        return $this->nmPage;
    }

    protected function setViewFilter(string $view): void
    {
        $this->mainView = $view;
    }

    protected function getViewFilter(): string
    {
        return $this->mainView;
    }

    public function setViewTable(string $nmViewTable): void
    {
        $this->nmViewTable = $nmViewTable;
    }

    public function getViewTable(): string
    {
        return $this->nmViewTable;
    }

    public function setFieldsFilter(array $arrFieldsFilter): void
    {
        $this->arrFieldsFilter[] = $arrFieldsFilter;
    }

    public function render(): void
    {
        $this->renderForm();
    }

    public function getViewForm(): string
    {
        return $this->nmViewForm;
    }

    public function setViewForm(string $path): void
    {
        $this->nmViewForm = $path;
    }

    public function renderForm(): void
    {
        try {
            if (empty($this->getArrInputs())) {
                http_response_code(500);
                throw new \Exception("It's necessary to have at least one field on the function Form");
            }

            ob_start();
            $this->callViewFrom($this->getViewForm());
            $this->setViewContent(ob_get_clean());

            $this->callViewFrom('index');
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function renderTable(): void
    {
        $this->setArrData();

        ob_start();
        $this->callViewFrom($this->getViewForm());
        $this->setViewContent(ob_get_clean());

        $this->callViewFrom('index');
    }
}
