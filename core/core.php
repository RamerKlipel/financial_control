<?php
namespace Core;

use Core\database;
abstract class core {
    protected $sql = '';
    protected $arrBinds = [];
    public $get = [];
    public $post = [];
    public $request = [];
    public $acao = "";
    public $id = null;

    public function __construct() {
        $this->trataGlobalVariables();
    }

    protected function setSql($sql)
    {
        $this->sql = $sql;
    }

    protected function getSql()
    {
        return !empty($this->getArrBinds()) ? database::debugPDO($this->sql, $this->getArrBinds()) : $this->sql;
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

    private function trataGlobalVariables(): void
    {
        $this->get = $_GET;
        $this->post = $_POST;
        $this->request = $_REQUEST;
        $this->acao = $_GET["acao"] ?? "";
        $this->id = $_GET["id"] ?? "";

        unset($_GET);
        unset($_POST);
        unset($_REQUEST);
        unset($_GET);
        unset($_GET);
    }
}
