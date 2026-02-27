<?php
use Core\html;

$arrTable = $this->getArrTable();
$arrTh = $this->getArrTh();
$arrPermCRUD = $this->getArrPermCrud();
$arrPermIcon = $this->getArrPermIcon();
?>

<table class="table table-bordered table-hover table-responsive table-striped">
    <thead>
    <?php if (!empty($arrTh)): ?>
        <?php foreach($arrTh as $th): ?>
            <th> <?= $th ?> </th>
        <?php endforeach; ?>
    <?php endif; ?>
        <th></th>
    </thead>
    <tbody>
        <!-- ?php if (!empty($arrData)): ?> -->
            <?php if (!empty($arrTable)): ?>
                <?php foreach($arrTable as $id => $tdTable): ?>
                    <?= $tdTable; ?>
                <?php endforeach; ?>
            <?php endif;?>
            <td>
                <div class="btn-group-action">
                    <?php foreach($arrPermCRUD as $strCRUD => $perm): ?>
                        <?php if ($perm && $strCRUD != "c"): ?>
                            <a class="btn-action btn" style="border: #00000045;" href="<?= $this->server["REDIRECT_URL"] ?>?action=<?= $strCRUD ?>"><i class="<?= $arrPermIcon[$strCRUD]?>"></i></a>
                        <?php endif;?>
                    <?php endforeach; ?>
                </div>
            </td>
        <!-- ?php endif; ?> -->
    </tbody>
</table>
