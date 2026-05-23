<?php
namespace Controllers;
use Core\pageForm;

class creditcard extends pageForm
{
    public function __construct()
    {
        parent::__construct('Credit Card', 'creditcard');
        $this->setFieldsSubmit(["NMCREDITCARD", "VLCREDITCARDLIMIT", "NRFINALFOURNUMBER"]);

        $sql = 'SELECT IDCREDITCARD, NMCREDITCARD, NRFINALFOURNUMBER, VLCREDITCARDLIMIT
                FROM creditcard';
        $this->setSql($sql);
    }

    public function Form()
    {
        $this->addInput('text', 'NMCREDITCARD', 'Name', ['required' => true, 'class' => 'form-control input', 'maxlength' => 150]);
        $this->addInput('text', 'VLCREDITCARDLIMIT', 'Vl.Limit', ['required' => true, 'class' => 'form-control input', 'data-mask' => 'coin-decimal-152']);
        $this->addInput('text', 'NRFINALFOURNUMBER', 'Last Four Number', ['required' => true, 'class' => 'form-control input', 'placeholder' => 'ex.: 1234', 'maxlength' => 4]);
    }

    public function Table()
    {
        $this->addTable('NMCREDITCARD', 'Name');
        $this->addTable('VLCREDITCARDLIMIT', 'Vl.Limit');
        $this->addTable('NRFINALFOURNUMBER', 'Last Four Number');
    }
}
