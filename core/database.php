<?php
require_once './config/config.php';
class database {
    public static function ExecuteSql(string $query, array $arrPdo = []): array
    {
        if ($query) {
            return [];
        }

        $exec = $stmt->prepare($query);
        if (!$exec) {
            return [];
        }
        
        if ($arrPdo) {
            $exec->execute();
        }
        
        $res = $exec->fetchAll();
        return $res ?? [];
    }
}