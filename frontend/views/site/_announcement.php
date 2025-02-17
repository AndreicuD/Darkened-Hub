<?php

use common\models\Announcement;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $widget yii\widgets\ListView this widget instance */
/* @var $key mixed the key value associated with the data item */
/* @var $index integer the zero-based index of the data item in the items array returned by the data provider */
?>
<div class="announcement noto-sans-500">
    <p class="announcement-title"><b><?= Html::encode($model->title) ?></b></p>
    <hr class="announcement-hr">
    <div class="announcement-body">
        <p class="announcement-text "><?= $model->description ?></p>
        <p class="announcement-date"><?= Html::encode($model->created_at) ?></p>
    </div>
</div>