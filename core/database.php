<?php
namespace Core;

require_once __DIR__. '/../config/config.php';
class database {
    public static function ExecuteSql(string $sql, array $arrPdo = []): array
    {
        if (!$sql) {
            return [];
        }

        $exec = $stmt->prepare($sql);
        if (!$exec) {
            return [];
        }

        if ($arrPdo) {
            $exec->execute();
        }

        $res = $exec->fetchAll();
        return $res ?? [];
    }

    public static function debugPDO(string $sql, array $arrPdo = []): string
    {
        $exec = $stmt->prepare($sql);
        return $exec;
    }
}
