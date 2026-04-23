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
        $this->addInput('text', 'NMCATEGORIE', 'Name', ['required'=> true, 'class' => 'form-control input']);
        $this->addSelect('FLACTIVE', 'Active', ['S' => 'Yes', 'N' => 'No'], ['required'=> true, 'class' => 'form-select'], ['class' => $this->getWidth(0)]);
    }

    public function Table(): void
    {
        $this->addTable('IDCATEGORIE', 'Code');
        $this->addTable('NMCATEGORIE', 'name');
    }
}
