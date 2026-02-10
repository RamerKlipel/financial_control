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
