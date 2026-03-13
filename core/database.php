<?php
namespace Core;

class database {
    private static $PDO = null;
    private static function getConnDB()
    {
        if (self::$PDO == null) {
            try {
                $conn = driver .':host='. host .';dbname='. dbname;
                $password = trim(password);
                $user = trim(user);
                self::$PDO = new \PDO($conn, $user, $password, OPTIONS_PDO);
            } catch (\PDOException $e) {
                echo 'erro ao conectar ao banco de dados: ' .$e->getMessage(). ' arquivo: ' .$e->getFile(). ' linha: ' .$e->getLine(). ' Código do erro: ', $e->getCode();die;
            }
        }
        return self::$PDO;
    }

    public static function ExecuteSql(string $sql, array $arrPdo = []): ?int
    {
        if (!$sql) {
            return null;
        }
        $PDO = self::getConnDB();
        $exec = $PDO->prepare($sql);
        if (!$exec) {
            return null;
        }
        $exec->execute($arrPdo);

        return ($PDO->lastInsertId());
    }

    public static function ExecuteSqlData(string $sql, array $arrPdo = []): array
    {
        if (!$sql) {
            return [];
        }
        $PDO = self::getConnDB();
        $exec = $PDO->prepare($sql);
        if (!$exec) {
            return [];
        }
        $exec->execute($arrPdo);

        $res = $exec->fetchAll();
        return $res ?? [];
    }

    public static function debugPDO(string $sql, array $arrPdo = []): string
    {
        if ($arrPdo) {
            foreach($arrPdo as $nmCampo => $val) {
                $sql = str_replace($nmCampo, $val, $sql);
            }
        }
        return $sql;
    }

    public static function insert(string $strTable, array $arrInsert, array $arrPdo = []): string
    {
        $arrColumns = array_keys($arrInsert);
        $arrValuesPdo = array_values($arrInsert);
        if (!empty($arrColumns) || !empty($arrValuesPdo)) {
            $strColmuns = implode(', ' ,$arrColumns);
            $strColumnsPdo = implode(', ' ,$arrValuesPdo);
            $sql = "INSERT INTO $strTable ($strColmuns)
                    VALUE ($strColumnsPdo)";
            $res = self::ExecuteSql($sql, $arrPdo);
        }
        return $res;
    }

    public static function delete(string $strTable, string $where, array $arrPdo = []): string
    {
        if (empty($where)) {
            http_response_code(500);
            return "For safety reasons, you shouldn't perform a delete without a where clause";
        }
        $sql = "DELETE
                FROM $strTable
                WHERE $where";
        $res = self::ExecuteSql($sql, $arrPdo);
        return $res;
    }

    public static function extractArrColumnsPdo(array $arrPdo, bool $blReplace = true): array
    {
        if (!empty($arrPdo)) {
            $arrColumns = array_keys($arrPdo);
            if ($blReplace) {
                foreach ($arrColumns as $key => $nmColumn) {
                    $arrColumns[$key] = str_replace(':', '', $nmColumn);
                }
            }
        }
        return $arrColumns ?? [];
    }
}
