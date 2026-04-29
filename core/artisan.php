<?php
namespace Core;
use Core\migrationManager;

$command = ($argv[1] ?? "");

match ($command) {
    'migrate' => new migrationManager(),
    default => print("Command not found. \n")
};
