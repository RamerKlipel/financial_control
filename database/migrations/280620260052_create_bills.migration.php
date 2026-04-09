<?php
namespace Core;

use Core\migration;

class create_bills extends migration {

    public function up(): string
    {
        $sql = "CREATE TABLE IF NOT EXISTS bill (
                    IDBILL INT NOT NULL AUTO_INCREMENT,
                    NMBILL VARCHAR(50) NOT NULL,
                    IDCATEGORIE INT NULL DEFAULT NULL,
                    VLBILL DECIMAL(15,2) NOT NULL DEFAULT 0,
                    FLPAID ENUM('S','N') NOT NULL DEFAULT 'N',
                    FLINSTALLMENT ENUM('S','N') NOT NULL DEFAULT 'N',
                    NRINSTALLMENT TINYINT NULL DEFAULT NULL,
                    TPPAYMENT CHAR(2) NOT NULL,
                    IDCREDITCARD INT NULL DEFAULT NULL,
                    DSWHERESPENT TEXT NULL DEFAULT NULL,
                    DABILL TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
                    DADUE DATE NULL DEFAULT NULL,
                    DAPAYMENT DATE NULL DEFAULT NULL,
                    FLACTIVE ENUM('S','N') NULL DEFAULT 'S',
                    PRIMARY KEY (IDBILL),
                    CONSTRAINT FK_BILL_IDCATEGORIE FOREIGN KEY (IDCATEGORIE) REFERENCES categorie (IDCATEGORIE) ON UPDATE CASCADE,
                    CONSTRAINT FK_BILL_IDCREDITCARD FOREIGN KEY (IDCREDITCARD) REFERENCES creditcard (IDCREDITCARD) ON UPDATE CASCADE
                );";
        return $sql;
    }

    public function down(): string
    {
        $sql = "DROP TABLE IF EXISTS bill;";
        return $sql;
    }
}
