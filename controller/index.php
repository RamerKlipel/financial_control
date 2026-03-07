<?php
namespace Controllers;
use Core\pageForm;

class index extends pageForm {
    public function __construct()
    {
        parent::__construct('Home', 'home');
        callViewFrom("emptyindex");
    }
}
