<?php
namespace Core;

trait form {
    protected $arrInputs = [];
    public function setArrInputs()
    {
        printr($this->arrInputs);
    }
}
