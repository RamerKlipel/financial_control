<?php
namespace Controllers;
require_once __DIR__.'/../core/functions.php';
require_once __DIR__.'/../vendor/autoload.php';
use Core\form;

class Categories extends form {
    public function __construct()
    {
        parent::__construct('Categories');
    }
}

new Categories();
