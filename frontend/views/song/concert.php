<?php

/** @var yii\web\View $this */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\bootstrap5\Html;
use yii\widgets\ListView;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\grid\GridView;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\widgets\DateTimePicker;
use common\models\Concert;

//var_dump($concert_date);
$this->title = Yii::t('app', 'Concert');
//$this->params['breadcrumbs'][] = Yii::t('app', 'Songs');
?>
<div class="songs-index">
    <h1 style="text-align: center;" class="page_title"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_settingsbar', [
        'searchModel' => $searchModel,
        'user' => $user,
        'page' => 'concert',
    ]) ?>

    <?= $this->render('_songs_table', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'user' => $user,
        'page' => 'concert',
    ]) ?>
</div>
