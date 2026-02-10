<?php
namespace Core;
require_once __DIR__.'/../core/functions.php';
use Core\core;

abstract class form extends core{
    public $nmPage = '';
    protected $arrInputs = [];
    public function __construct($nmPage = '')
    {
        $this->setNmPage($nmPage);
        $this->callViewFrom("form");
    }

    private function setNmPage(?string $nmPage):void
    {
        $this->nmPage = $nmPage ?? '';
    }

    protected function getNmPage(): string
    {
        return $this->nmPage;
    }

    protected function addInput()
    {
        $this->arrInputs[] = 'input';
    }

}
