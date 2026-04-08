<?php
namespace Controllers;

use Core\pageForm;

class Bills extends pageForm {

    public function __construct()
    {
        parent::__construct('Bills', 'bill');
        $sql = "SELECT b.*, c.NMCATEGORIE, CONCAT(NMCREDITCARD, ' (',NRFINALFOURNUMBER, ')') NMCREDITCARD,
        (
        CASE b.TPPAYMENT
            WHEN 'PX' THEN 'Pix'
            WHEN 'CC' THEN 'Credit Card'
            WHEN 'CD' THEN 'Debit Card'
        END
        ) TPPAYMENT,
        (
        CASE b.FLPAID
            WHEN 'S' THEN 'Yes'
            ELSE 'No'
        END
        ) FLPAID,
        (
        CASE b.FLINSTALLMENT
            WHEN 'S' THEN 'Yes'
            ELSE 'No'
        END
        ) FLINSTALLMENT
                FROM bill b
                JOIN categorie c on c.IDCATEGORIE = b.IDCATEGORIE
                JOIN creditcard cc on cc.IDCREDITCARD = b.IDCREDITCARD
                WHERE TRUE {{WHERE}}";
        $this->setSql($sql);
    }

    public function Form() {
        $this->addJs("bills", ['type'=>"module"]);
        $this->addInput('text', 'NMBILL', 'Bill', ['required' => true, 'class' => 'form-control input']);
        $this->addSelect('IDCATEGORIE', 'Categorie', $this->getArrCategorie(), ['required' => true, 'class' => 'form-select'], ['class' => $this->getWidth(2)]);
        $this->addInput('text', 'VLBILL', 'value', ['required' => true, 'class' => 'form-control input', 'data-mask' => 'coin-decimal-152']);
        $this->addSelect('FLPAID', 'Paid?', ['S' => 'Yes', 'N' => 'No'], ['class' => 'form-select']);
        $this->addSelect('FLINSTALLMENT', 'Installment?', ['S' => 'Yes', 'N' => 'No'], ['class' => 'form-select']);
        $this->addInput('text', 'NRINSTALLMENT', 'Nr.installment', ['class' => 'form-control input']);
        $this->addSelect('TPPAYMENT', 'Payment', getArrPayments(), ['class' => 'form-select']);
        $this->addSelect('IDCREDITCARD', 'Credit Card', $this->getArrCreditCard(), ['class' => 'form-select']);
        $this->addInput('text', 'DSWHERESPENT', 'Where Spent', ['required' => true, 'class' => 'form-control input']);
        $this->addInput('text', 'DABILL', 'Bill date', ['required' => true, 'class' => 'form-control input', 'value' => date("d/m/Y")]); //TODO make date mask
        $this->addInput('text', 'DADUE', 'Due date', ['class' => 'form-control input']); //TODO make date mask
        $this->addInput('text', 'DAPAYMENT', 'Payment date', ['class' => 'form-control input']); //TODO make date mask
        $this->addSelect('FLACTIVE', 'Active', ['S' => 'Yes', 'N' => 'No'], ['required'=> true, 'placeholder' => true, 'class' => 'form-select'], ['class' => $this->getWidth(0)]);
    }

    public function Table() {
        $this->addTable('NMBILL', 'Bill');
        $this->addTable('NMCATEGORIE', 'Categorie');
        $this->addTable('VLBILL', 'value');
        $this->addTable('FLPAID', 'Paid');
        $this->addTable('FLINSTALLMENT', 'Installment');
        $this->addTable('NRINSTALLMENT', 'Nr.installment');
        $this->addTable('TPPAYMENT', 'Payment');
        $this->addTable('NMCREDITCARD', 'Credit Card');
        $this->addTable('DSWHERESPENT', 'Where Spent');
        $this->addTable('DABILL', 'Bill date');
        $this->addTable('DADUE', 'Due date');
        $this->addTable('DAPAYMENT', 'Payment date');
    }

    public function getArrCategorie(): array
    {
        return $this->model->getArraySelect('categorie');
    }

    public function getArrCreditCard(): array
    {
        return $this->model->getArrCreditCard();
    }

}
