<?php
require_once './core/errorhandler.php';

use Core\ErrorHandler;

ErrorHandler::setHandler();

require_once './vendor/autoload.php';
require_once './core/functions.php';

if (file_exists('./config/control.php')) {
    require_once './config/control.php';
}

class index {
    public static function getController(): void
    {
        $classPhp = $class = $function = '';
        $params = $_GET;
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $url = array_filter(explode("/", $url));
        array_shift($url);
        $url = implode("/", $url);

        if (preg_match('/^([^@?]+)(?:@([^?]+))?/', $url, $matches)) {
            $classPhp = $matches[1];
            $classPhp = $class = (explode('.', $classPhp)[0] ?? $classPhp);

            if (strpos($classPhp, '.php') < 1) {
                $class = "$classPhp.php";
            }

            if (!empty($matches[2] ?? "")) {
                $function = $matches[2];
            }
        }

        if (!in_array($classPhp, getPagesPermissions()) || !file_exists("./controller/$class")) {
            callViewFrom('emptyindex');
            echo '<h1 style="margin: 0">Erro 404! Página não encontrada></h1>';die;
        } else {
            try {
                require_once "./controller/$class";
                $classPhp = str_replace("/", "\\", $classPhp);
                $nmClasse = "Controllers\\".$classPhp;
                $controller = new $nmClasse;

                if (!empty($function) && method_exists($controller, $function)) {
                    call_user_func_array([$controller, $function], array_values($params) ?: []);
                } else {
                    if (method_exists($controller, "render")) {
                        $controller->render();
                    }
                }
            } catch (\Exception $e) {
                throw $e;
            }
        }
    }
}

index::getController();
