<?php

use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var common\models\Concert $model */

$this->title = Yii::t('app', 'Update Concert: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Concerts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Update') . ': ' . $model->id];
?>
<div class="concert-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
