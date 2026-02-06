<?php
namespace Core;

use Core\database;
abstract class core {
    protected $sql = '';
    protected $arrBinds = [];

    protected function __construct()
    {

    }

    protected function setSql($sql)
    {
        $this->sql = $sql;
    }

    protected function getSql()
    {
        return !empty($this->getArrBinds()) ? database::debugPDO($this->$sql, $this->getArrBinds()) : $this->sql;
    }

    protected function setArrBinds($arrBinds)
    {
        $this->arrBinds = $arrBinds;
    }

    protected function getArrBinds(): array
    {
        return $this->arrBinds;
    }

    protected function callViewFrom(String $path): void
    {
        include_once __DIR__. "/../view/$path.view.php";
    }
}
