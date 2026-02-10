<?php
require_once './vendor/autoload.php';
require_once './config/config.php';
require_once './core/functions.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$class = '';
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$parts = explode('/', trim($url, '/'));

if (!empty($parts) && strpos($parts[count($parts) -1], '.') !== false) {
    $class = explode('.', $parts[count($parts) -1])[0];
} else {
    $class = $parts[count($parts) -1];
}


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body style="width: max-content; height: max-content;">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <?php include_once "./view/navbar.view.php"; ?>
</body>
</html>
<?php
if (!in_array($class, getPagesPermissions())) {
    echo '<h1 style="margin: 0">Erro 404! Página não encontrada';die;
}
if ($class != 'index') {
    require_once "./controller/$class.php";
    $nmClasse = "Controllers\\".$class;
    new $nmClasse;
}
?>
