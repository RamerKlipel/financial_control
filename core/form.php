<?php
namespace Core;
require_once '../core/functions.php';
use Core\database;

abstract class form {
    public function __construct()
    {
   callViewFrom("form");
    }
}