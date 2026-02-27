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
        $this->addInput('text', 'NMCATEGORIE', 'Nome', ['required'=> true, 'class' => 'form-control input']);
    }

    public function Table(): void
    {
        $this->addTable('IDCATEGORIE', 'Cod.');
        $this->addTable('NMCATEGORIE', 'nome');
    }
}
