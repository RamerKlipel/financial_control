<?php
require_once './vendor/autoload.php';
require_once './config/control.php';
require_once './core/functions.php';

// try {
// $conn = driver .':host='. host .';dbname='. dbname;
// $password = trim(password);
// $user = trim(user);
// $pdo = new \PDO($conn, $user, $password, OPTIONS_PDO);
// printr($pdo->query('show tables')->fetch());die;
// } catch (PDOException | Exception $e) {
// echo 'erro ao conectar ao banco de dados: ' .$e->getMessage(). ' arquivo: ' .$e->getFile(). ' linha: ' .$e->getLine(). ' Código do erro: ', $e->getCode();die;
// }

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
            callViewFrom('emptyindex');
            echo '<h1 style="margin: 0">Erro 404! Página não encontrada></h1>';die;
        } else {
            require_once "./controller/$class.php";
            $nmClasse = "Controllers\\".$class;
            $controller = new $nmClasse;

            if (!empty($function) && method_exists($controller, $function)) {
                call_user_func_array([$controller, $function], array_values($params) ?: []);
            }

            $controller->render();
        }
    }
}
echo index::getController();
