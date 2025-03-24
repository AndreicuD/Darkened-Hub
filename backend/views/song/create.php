<?php

use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var common\models\Song $model */

$this->title = Yii::t('app', 'Create Song');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Songs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="song-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
