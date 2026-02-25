<?php
use Core\html;

$arrTable = $this->getArrTable();
$arrTh = $this->getArrTh();
$arrPermCRUD = $this->getArrPermCrud();
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
        <!-- ?php if (!empty($arrDados)): ?> -->
            <?php if (!empty($arrTable)): ?>
                <?php foreach($arrTable as $id => $tdTable): ?>
                    <?= $tdTable; ?>
                <?php endforeach; ?>
                <td></td>
            <?php endif;?>
            <?php foreach($arrPermCRUD as $strCRUD => $perm): ?>
            <?php endforeach; ?>
        <!-- ?php endif; ?> -->
    </tbody>
</table>
