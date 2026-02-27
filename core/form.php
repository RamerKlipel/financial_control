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
        if ($this->action) {
            printr([$this->action,
            ]);
        }
    }

    protected function addInput(string $type, string $idInput, string $label = '', array $arrAttrInput = []): void
    {
        $this->arrInputs[] = html::addInput($type, $idInput, $label, $arrAttrInput);
    }

    public function getArrInput():array
    {
        return $this->arrInputs;
    }
}
