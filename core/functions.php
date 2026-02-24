<?php
function printr(mixed $mix):void
{
    echo '<pre>';
    print_r($mix);
    echo '</pre>';
}

function getPagesPermissions(): array
{
    return [
        // 'index', 'bills',
        'categories', 'index',
        //  'reports', 'settings',
    ];
}

function callViewFrom(String $path): void
{
    include_once __DIR__. "/../view/$path.view.php";
}
