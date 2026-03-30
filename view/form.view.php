<?php
use Core\html;
$arrInputs = $this->getArrInputs();
$arrData = !empty($this->getArrData()) ? $this->getArrData()[0] : [];
?>
<form action="<?= $this->server["REDIRECT_URL"]?>" data-action="<?= $this->action ?>" data-id="<?= $this->id ?>" method="post">
    <div class="form-row form-input">
        <?php if (!empty($arrInputs)): ?>
            <?php foreach($arrInputs as $input): ?>
                <?php
                $inputVal = '';
                extract($input);

                if (key_exists($idInput, $arrData)) {
                    $inputVal = $arrData[$idInput];
                }

                switch($typeInput){
                    case 'input':
                        echo html::addInput($type, $idInput, $label, $arrAttrInput, $arrAttrDiv, $inputVal);
                    break;
                    case 'select':
                        echo html::addSelect($idInput, $label, $arrSelectOptions, $arrAttrInput, $arrAttrDiv, $inputVal);
                    break;
                }
                ?>


            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <?php if ($this->action != 'r'): ?>
        <div class="inline-primary-footer">
            <button type="submit" id="btnSubmit" class="btn btn-primary">Salvar</button>
        </div>
    <?php endif; ?>
</form>
