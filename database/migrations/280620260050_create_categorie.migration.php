<?php
namespace Core;

use Core\migration;

class create_categorie extends migration {

    public function up(): string
    {
        $sql = "CREATE TABLE IF NOT EXISTS categorie (
                    IDCATEGORIE INT NOT NULL AUTO_INCREMENT,
                    NMCATEGORIE VARCHAR(50) NOT NULL,
                    FLACTIVE ENUM('S','N') NULL DEFAULT 'S',
                    PRIMARY KEY (IDCATEGORIE)
                );";
        return $sql;
    }

    public function down(): string
    {
        $sql = "DROP TABLE IF EXISTS categorie;";
        return $sql;
    }
}
