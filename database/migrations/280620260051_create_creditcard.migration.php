<?php
namespace Core;

use Core\migration;

class create_creditcard extends migration {

    public function up(): string
    {
        $sql = "CREATE TABLE IF NOT EXISTS creditcard (
                    IDCREDITCARD INT NOT NULL AUTO_INCREMENT,
                    NMCREDITCARD VARCHAR(150) NOT NULL,
                    VLCREDITCARDLIMIT DECIMAL(15, 2) NOT NULL,
                    NRFINALFOURNUMBER CHAR(4) NOT NULL,
                    FLACTIVE ENUM('S','N') NULL DEFAULT 'S',
                    PRIMARY KEY (IDCREDITCARD)
                );;";
        return $sql;
    }

    public function down(): string
    {
        $sql = "DROP TABLE IF EXISTS creditcard;";
        return $sql;
    }
}
