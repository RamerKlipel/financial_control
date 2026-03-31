<?php
namespace Controllers;
use Core\pageForm;

class creditcard extends pageForm
{
    public function __construct()
    {
        parent::__construct('Credit Card', 'creditcard');
        $sql = 'SELECT IDCREDITCARD, NMCREDITCARD, NRFINALFOURNUMBER, VLCREDITCARDLIMIT
                FROM creditcard';
        $this->setSql($sql);
    }

    public function Form()
    {
        $this->addInput('text', 'NMCREDITCARD', 'Name', ['class' => 'form-control input', 'maxlength' => 150]);
        $this->addInput('text', 'VLCREDITCARDLIMIT', 'Vl.Limit', ['class' => 'form-control input', 'maxlength' => 18]);
        $this->addInput('text', 'NRFINALFOURNUMBER', 'Last Four Number', ['class' => 'form-control input', 'placeholder' => 'ex.: 1234', 'maxlength' => 4]);
    }

    public function Table()
    {
        $this->addTable('NMCREDITCARD', 'Name');
        $this->addTable('VLCREDITCARDLIMIT', 'Vl.Limit');
        $this->addTable('NRFINALFOURNUMBER', 'Last Four Number');
    }
}
