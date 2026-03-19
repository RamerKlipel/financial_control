<?php
use Core\html;
$arrInputs = $this->getArrInputs();
$arrData = !empty($this->getArrData()) ? $this->getArrData()[0] : [];
?>
<form action="<?= $this->server["REDIRECT_URL"]?>" data-action="<?= $this->action ?>" data-id="<?= $this->id ?>" method="post">
    <div class="form-row form-input">
        <?php if (!empty($arrInputs)): ?>
            <?php foreach($arrInputs as $input): ?>
                <?php $inputVal = ''; ?>
                <?php extract($input); ?>

                <?php if (key_exists($idInput, $arrData)): ?>
                    <?php $inputVal = $arrData[$idInput];?>
                <?php endif; ?>

                <?= html::addInput($type, $idInput, $label, $arrAttrInput, $arrAttrDiv, $inputVal); ?>

            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <?php if ($this->action != 'r'): ?>
        <div class="inline-primary-footer">
            <button type="submit" id="btnSubmit" class="btn btn-primary">Salvar</button>
        </div>
    <?php endif; ?>
</form>
