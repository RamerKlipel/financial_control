<?php
namespace Core;

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
        if ($this->request) {
            $arrBinds = $arrInsere = [];
            foreach($this->request as $nmCampo => $value) {
                $nmCampo = strtoupper($nmCampo);
                $arrBinds[":$nmCampo"] = $value;
                $arrInsere[$nmCampo] = ":$nmCampo";
            }
            Database::insere(); //TODO falta fazer o Database insere agora irmão, provavelmente no model é mio
        }
    }

    protected function addInput(string $type, string $idInput, string $label = '', array $arrAttrInput = [], array $arrAttrDiv = []): void
    {
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
