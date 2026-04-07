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
        $strUpperTable = strtoupper($table);
        $nmIdTable = !empty($nmIdTable) ? $nmIdTable : "ID$strUpperTable";
        $nmValTable = !empty($nmValTable) ? $nmValTable : "NM$strUpperTable";

        $sql = "SELECT $nmIdTable, $nmValTable
                FROM $table";
        $arrAssociative = database::executeSqlMountAssociativeArray($sql, $nmIdTable, $nmValTable);

        return $arrAssociative;
    }

    public function getArrCreditCard(): array
    {
        $sql = "SELECT IDCREDITCARD, CONCAT(NMCREDITCARD, ' (',NRFINALFOURNUMBER, ')') NMCREDITCARD
                FROM creditcard";
        $arrCreditCard = Database::executeSqlMountAssociativeArray($sql, 'IDCREDITCARD', 'NMCREDITCARD');

        return $arrCreditCard ?? [];
    }
}
