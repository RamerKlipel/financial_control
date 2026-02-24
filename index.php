<?php
require_once './vendor/autoload.php';
require_once './config/config.php';
require_once './core/functions.php';

class index {
    public static function getController()
    {
        $class = '';
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $parts = explode('/', trim($url, '/'));

        if (!empty($parts) && strpos($parts[count($parts) -1], '.') !== false) {
            $class = explode('.', $parts[count($parts) -1])[0];
        } else {
            $class = $parts[count($parts) -1];
        }

        if (!in_array($class, getPagesPermissions())) {
            callViewFrom('navbar');// TODO utilizar forma melhor, mas da pra deixar pra depois por enquanto
            echo '<h1 style="margin: 0">Erro 404! Página não encontrada></h1>';die;
        }
        if ($class != 'index') {
            require_once "./controller/$class.php";
            $nmClasse = "Controllers\\".$class;
            new $nmClasse;
        }
    }
}
echo index::getController();
