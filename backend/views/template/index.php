<?php

use yii\helpers\Html;
?>

<h4>CV Templates</h4>

<?= Html::a('Add Template', ['create'], ['class' => 'btn btn-success mb-3']) ?>

<table class="table table-bordered">
    <tr>
        <th>Name</th>
        <th>Active</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($templates as $template): ?>
        <tr>
            <td><?= $template->name ?></td>
            <td><?= $template->is_active ? 'Yes' : 'No' ?></td>
            <td>
                <?= Html::a('Edit', ['update', 'id' => $template->id]) ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>