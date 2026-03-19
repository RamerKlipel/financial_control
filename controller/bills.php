<?php
namespace Controllers;

use Core\pageForm;

class Bills extends pageForm {

    public function __construct()
    {
        parent::__construct('Bills', 'bill');
        $sql = 'SELECT *
                FROM bill
                WHERE TRUE {{WHERE}}';
        $this->setSql($sql);
    }

    public function Form() {
        $this->addInput('text', 'NMBILL', 'Name', ['class' => 'form-control input']);
    }

    public function Table() {
        $this->addTable('NMBILL', 'Name');
    }

}
