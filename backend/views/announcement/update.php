<?php

use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var common\models\Announcement $model */

$this->title = Yii::t('app', 'Update Announcement: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Announcements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Update') . ': ' . $model->id];
?>
<div class="announcement-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
