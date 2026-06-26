<?php

$arrInputs = $this->getArrInputs();
$arrData = !empty($this->getArrData()) ? $this->getArrData()[0] : [];
?>
<form action="<?= $this->server["REDIRECT_URL"] ?>" data-action="<?= $this->action ?>" data-id="<?= $this->id ?>" method="post">
    <div class="form-row form-input">
        <?php if (!empty($arrInputs)): ?>
            <?php foreach ($arrInputs as $input): ?>
                <?= $input->render($arrData); ?>

            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <div class="inline-primary-footer">
        <button type="button" id="btnFilter" class="btn btn-primary">Filtrar</button>
    </div>
</form>
