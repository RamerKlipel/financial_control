<?php
namespace Src;
use Core\database;
class dbAtt
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
        CREATE TABLE IF NOT EXISTS categorie (
            IDCATEGORIE INT NOT NULL AUTO_INCREMENT,
            NMCATEGORIE VARCHAR(50) NOT NULL,
            PRIMARY KEY (IDCATEGORIE)
        );

        CREATE TABLE IF NOT EXISTS bill (
            IDBILL INT NOT NULL AUTO_INCREMENT,
            NMBILL VARCHAR(50) NOT NULL,
            PRIMARY KEY (IDBILL)
        );
    ";
}
