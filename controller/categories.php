<?php
namespace Controllers;
use Core\pageForm;

class categories extends pageForm {
    public function __construct()
    {
        parent::__construct('Categories', 'categorie');
        $sql = "SELECT *
                FROM categorie
                WHERE TRUE {{WHERE}}";
        $this->setSql($sql);
    }

    public function Form(): void
    {
        $this->addInput('text', 'NMCATEGORIE', 'Nome', ['required'=> true, 'class' => 'form-control input']);
    }

    public function Table(): void
    {
        $this->addTable('IDCATEGORIE', 'Code');
        $this->addTable('NMCATEGORIE', 'name');
    }
}
