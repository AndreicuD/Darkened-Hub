<?php

use common\models\ChimeLike;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $widget yii\widgets\ListView this widget instance */
/* @var $key mixed the key value associated with the data item */
/* @var $index integer the zero-based index of the data item in the items array returned by the data provider */
?>

<th><span id="song_title"><?= Html::encode($model->title) ?></span></th>
<td><span id="song_artist"><?= Html::encode($model->artist) ?></span></td>