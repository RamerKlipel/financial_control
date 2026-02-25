<?php
$arrInputs = $this->getArrInputs();
?>
<form action="<?= $_SERVER["REDIRECT_URL"]?>" method="post">
    <div class="form-row">
        <?php if (!empty($arrInputs)): ?>
            <?php foreach($arrInputs as $input): ?>
                <?= $input; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <div class="inline-primary-footer">
        <button type="submit" class="btn btn-primary">Salvar</button>
    </div>
</form>
