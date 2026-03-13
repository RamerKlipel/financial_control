<?php
namespace Core;
use Core\database;

trait form {
    protected $viewFormContent;
    protected $arrInputs = [];
    public function setArrInputs(array $arrInputs): void
    {
        $this->arrInputs = $arrInputs;
    }

    public function renderForm()
    {
        $this->setArrInputs($this->getArrInput());
        ob_start();
            $this->callViewFrom($this->getViewForm());
        $this->setViewContent(ob_get_clean());

        $this->callViewFrom('index');
    }

    public function getArrInputs()
    {
        return $this->arrInputs;
    }

    public function Submit()
    {
        if ($this->post) {
            $arrPdo = $arrInsert = [];
            foreach($this->post as $nmCampo => $value) {
                $nmCampo = strtoupper($nmCampo);
                $arrPdo[":$nmCampo"] = $value;
                $arrInsert[$nmCampo] = ":$nmCampo";
            }
            Database::insert($this->getSqlTable(), $arrInsert, $arrPdo);
        }
    }

    protected function addInput(string $type, string $idInput, string $label = '', array $arrAttrInput = [], array $arrAttrDiv = []): void
    {
        if ($this->action == "r") {
            $arrAttrInput['disabled'] = true;
        }
        $this->arrInputs[] = html::addInput($type, $idInput, $label, $arrAttrInput, $arrAttrDiv);
    }

    public function getArrInput():array
    {
        return $this->arrInputs;
    }

    public function getWidth($nr): string
    {
        return "col-$nr";
    }
}
