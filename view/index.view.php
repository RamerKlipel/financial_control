<?php
use Core\html;
$arrPermCRUD = $this->getArrPermCrud();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->getNmPage() ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="./public/css/style.css" >
    <?php foreach ($this->getArrCss() as $css): ?>
            <link rel="stylesheet" href="./public/css/<?= $css ?>.css" >
    <?php endforeach; ?>

</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <?php foreach ($this->getArrJs() as $js): ?>
    <!-- <script scr="./public/js/?= $js ?>.js" ></script> -->
    <?php endforeach; ?>
    <?php include_once "./view/navbar.view.php";?>
    <div class="inline-primary-div">

        <div style="display: flex; justify-content: space-between;">
            <h1><?= $this->getNmPage() ?></h1>
        <?php if (($arrPermCRUD['c'] ?? false) && empty($this->acao)): ?>
            <a href="<?= $_SERVER["REDIRECT_URL"].'?acao=c'?>" class="btn btn-primary" style="margin-bottom: 10px;" type="button" name="btnCria" id="btnCria">Novo Registro</a>
        <?php endif; ?>
        <?php if (!empty($this->acao)): ?>
            <a href="<?= $_SERVER["REDIRECT_URL"]?>" class="btn btn-primary" style="margin-bottom: 10px;" type="button" name="btnCria" id="btnCria">Voltar</a>
        <?php endif; ?>
        </div>
    <?php echo $this->getViewContent();?>
    </div>

</body>
</html>
