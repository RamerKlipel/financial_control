<?php
namespace Core;
trait table{
    protected $arrTable = [];
    protected $arrTh = [];
    protected $arrPermIcon = [
        'r' => 'fa-solid fa-magnifying-glass',
        'u' => 'fa-solid fa-pen-to-square',
        'd' => 'fa-solid fa-trash'
    ];

    protected function addTable(string $idInput, string $label = '', array $arrAttrInput = []): void
    {
        $this->arrTh[] = $label;
        $this->arrTable[$idInput] = html::addTable($idInput, $arrAttrInput);
    }

    public function getArrTable(): array
    {
        return $this->arrTable;
    }

    public function getArrTh(): array
    {
        return $this->arrTh;
    }

    public function renderTable(): void
    {
        ob_start();
            $this->callViewFrom($this->getViewTable());
        $this->setViewContent(ob_get_clean());

        $this->callViewFrom('index');
    }

    public function setArrPermIcon($arrPermIcon): void
    {
        $this->arrPermIcon = $arrPermIcon;
    }

    public function getArrPermIcon(): array
    {
        return $this->arrPermIcon;
    }
}
