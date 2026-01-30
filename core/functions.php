<?php 
function printr(mixed $mix):void
{
    echo '<pre>';
    print_r($mix);
    echo '</pre>';
}

function callViewFrom(String $path): void
{
    printr($path);die;
    include_once "controle_financeiro/view/$path.view.php";
}