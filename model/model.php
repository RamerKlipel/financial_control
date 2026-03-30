<?php
namespace model;
use Core\database;

class model {
    protected $sql = '';
    protected $arrPdo = [];
    protected $strTable = '';

    public function setSql(string $sql): void
    {
        $this->sql = $sql;
    }

    public function getSql(): string
    {
        return $this->sql;
    }

    public function getDebugSql(): string
    {
        return database::debugPDO($this->sql, $this->getArrPdo());
    }

    public function setArrPdo(array $arrPdo): void
    {
        $this->arrPdo = $arrPdo;
    }

    public function getArrPdo(): array
    {
        return $this->arrPdo;
    }

    public function getArrData(): array
    {
        $arrDados = database::ExecuteSqlData($this->sql, $this->getArrPdo());
        return $arrDados;
    }

    public function setSqlTable($strTable):void
    {
        $this->strTable = $strTable;
    }

    public function getSqlTable(): string
    {
        return $this->strTable;
    }

    public function getArraySelect(string $table, string $nmIdTable = '', string $nmValTable = ''): array
    {
        $upperTable = strtoupper($table);
        $nmIdTable = !empty($nmIdTable) ? $nmIdTable : "ID$upperTable";
        $nmValTable = !empty($nmValTable) ? $nmValTable : "NM$upperTable";

        $sql = "SELECT $nmIdTable, $nmValTable
                FROM $table";
        $array = database::ExecuteSqlData($sql);
        return $array;
    }
}
