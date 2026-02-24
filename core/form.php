<?php
namespace Core;

trait form {
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
        $this->setViewFormContent(ob_get_clean());

        $this->callViewFrom('index');
    }

    public function getArrInputs()
    {
        return $this->arrInputs;
    }

    public function setViewFormContent(string $viewFormContent): void
    {
        $this->viewFormContent = $viewFormContent;
    }

    public function getViewFormContent(): string
    {
        return $this->viewFormContent;
    }
}
