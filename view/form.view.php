<?php
$arrInputs = $this->getArrInputs();
?>
<form action="<?= $_SERVER["PHP_SELF"]?>" method="post">
    <?php if (!empty($arrInputs)): ?>
        <?php foreach($arrInputs as $input): ?>
            <?= $input; ?>
        <?php endforeach; ?>
    <?php endif; ?>
</form>
