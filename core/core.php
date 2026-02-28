<?php
namespace Core;

use Core\database;
abstract class core {
    protected $sql = '';
    protected $arrBinds = [];
    public $get = [];
    public $post = [];
    public $request = [];
    public $server = [];
    public $action = "";
    public $id = null;
    protected $model;
    protected $viewContent;
    protected $sqlTable = "";
    protected $arrJs = [];
    protected $arrCss = [];
    protected $arrPermCRUD = ["c" => true, "r" => true, "u" => true, "d" => true];


    public function __construct(string $sqlTable) {
        $this->setSqlTable($sqlTable);
        $this->handleGlobalVariables();
        $arrUrl = $this->handleUrl($this->get['url']);
        $class = $arrUrl['CLASS'];
        $this->setModel($class);
    }

    protected function setSql(string $sql): void
    {
        $this->sql = $sql;
    }

    protected function getSql()
    {
        return !empty($this->getArrBinds()) ? database::debugPDO($this->sql, $this->getArrBinds()) : $this->sql;
    }

    protected function setArrBinds(array $arrBinds): void
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

    private function handleGlobalVariables(): void
    {
        $this->get = $_GET;
        $this->post = $_POST;
        $this->request = $_REQUEST;
        $this->server = $_SERVER;
        $this->action = $_GET["action"] ?? "";
        $this->id = $_GET["id"] ?? "";

        unset($_GET);
        unset($_POST);
        unset($_REQUEST);
        unset($_GET);
        unset($_GET);
    }

    private function setModel(string $model): void
    {
        require_once __DIR__. "/../model/".$model."Model.php";
        $model = "\model\\".$model."Model";
        $this->model = new $model();
    }

    protected function setSqlTable(string $strTable): void
    {
        $this->sqlTable = $strTable;
    }

    protected function addJs(string $js): void
    {
        $this->arrJs[] = $js;
    }

    protected function addCss(string $css): void
    {
        $this->arrCss[] = $css;
    }

    protected function getArrJs(): array
    {
        return $this->arrJs;
    }

    protected function getArrCss(): array
    {
        return $this->arrCss;
    }

    public function setViewContent(string $viewContent): void
    {
        $this->viewContent = $viewContent;
    }

    public function getViewContent(): ?string
    {
        return $this->viewContent;
    }

    public function getArrPermCrud(): array
    {
        return $this->arrPermCRUD;
    }

    protected function handleUrl(string $url): array
    {
        preg_match("/^([^@?]+)(?:@([^?]+))?/", $url, $match);
        $arrUrl = [
            'FULLURL' => ($match[0] ?? ''),
            'CLASS' => ($match[1] ?? ''),
            'METHOD' => ($match[2] ?? '')
        ];
        return ($arrUrl ?? []);
    }

    public function submit()
    {

    }
}
