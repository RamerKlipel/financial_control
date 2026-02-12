<?php
namespace Controllers;
use Core\form;

class categories extends form {
    public function __construct()
    {
        parent::__construct('Categories');

    }

    public function Form()
    {
        $this->addInput('text', 'category', 'labelzissima', ['required'=> true, 'class' => 'form-control']);
    }
}
