<?php
namespace Controllers;
use Core\pageForm;

class categories extends pageForm {
    public function __construct()
    {
        parent::__construct('Categories', 'categorie');
    }

    public function Form(): void
    {
        $this->addInput('text', 'NMCATEGORIE', 'labelzissima', ['required'=> true, 'class' => 'form-control']);
    }

    public function Table(): void
    {
        $this->addTable('IDCATEGORIE', 'Cod.');
        $this->addTable('NMCATEGORIE', 'nome');
    }
}
