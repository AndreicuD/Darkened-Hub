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
<td><span id="song_first_guitar"><?= Html::encode($model->first_guitar) ?></span></td>
<td><span id="song_second_guitar"><?= Html::encode($model->second_guitar) ?></span></td>
<td><span id="song_bass"><?= Html::encode($model->bass) ?></span></td>
<td><span id="song_drums"><?= Html::encode($model->drums) ?></span></td>
<td><span id="song_piano"><?= Html::encode($model->piano) ?></span></td>
<td><span id="song_first_voice"><?= Html::encode($model->first_voice) ?></span></td>
<td><span id="song_second_voice"><?= Html::encode($model->second_voice) ?></span></td>
