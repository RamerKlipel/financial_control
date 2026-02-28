<?php
require_once './vendor/autoload.php';
require_once './config/config.php';
require_once './core/functions.php';

class index {
    public static function getController()
    {
        $class = $function = '';
        $params = $_GET;
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $parts = explode('/', trim($url, '/'));
        $last = $parts[array_key_last($parts)];

        if (preg_match('/^([^@?]+)(?:@([^?]+))?/', $last, $matches)) {
            $class = $matches[1];
            if (!empty($matches[2] ?? "")) {
                $function = $matches[2];
            }
        }

        if (!in_array($class, getPagesPermissions())) {
            callViewFrom('navbar');// TODO utilizar forma melhor, mas da pra deixar pra depois por enquanto
            echo '<h1 style="margin: 0">Erro 404! Página não encontrada></h1>';die;
        }
        if ($class != 'index') {
            require_once "./controller/$class.php";
            $nmClasse = "Controllers\\".$class;
            $controller = new $nmClasse;

            if (!empty($function) && method_exists($controller, $function)) {
                call_user_func_array([$controller, $function], array_values($params) ?: []);
            }
        }
    }
}
echo index::getController();
