<?php
namespace Core;
trait table{
    protected $arrTable = [];
    protected $arrTh = [];

    protected function addTable(string $idInput, string $label = '', array $arrAttrInput = []): void
    {
        $this->arrTh[] = $label;
        $this->arrTable[$idInput] = html::addTable($idInput, $arrAttrInput);
    }

    public function getArrTable()
    {
        return $this->arrTable;
    }

    public function getArrTh()
    {
        return $this->arrTh;
    }

    public function renderTable()
    {
        ob_start();
            $this->callViewFrom($this->getViewTable());
        $this->setViewContent(ob_get_clean());

        $this->callViewFrom('index');
    }
}
