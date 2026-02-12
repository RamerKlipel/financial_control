<?php
namespace Src;
use Core\database;
class atualizationDb
{
    public $script = [];
    public function __construct()
    {
        $this->setScript();
        if ($_GET["rodaScript"]) {
            $this->rodaScript();
        }
    }
    public function rodaScript() {
        foreach ($this->script as $script) {
            Database::ExecuteSql($script);
        }
    }

    public function setScript()
    {
        $this->script = explode(",", $this->strScript);
    }

    public $strScript = "
        CREATE TABLE IF NOT EXISTS categories (
            IDCATEGORIE INT NOT NULL AUTO_INCREMENT,
            NMCATEGORIE VARCHAR(50) NOT NULL,
            PRIMARY KEY (IDCATEGORIE)
        );
    ";
}
