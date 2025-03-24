<?php

use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var common\models\Concert $model */

$this->title = Yii::t('app', 'Create Concert');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Concerts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="concert-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
