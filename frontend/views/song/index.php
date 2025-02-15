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

$this->title = Yii::t('app', 'Melodii');
//$this->params['breadcrumbs'][] = Yii::t('app', 'Songs');
?>
<div class="songs-index">
    <h1 style="text-align: center;" class="page_title"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_settingsbar', [
        'searchModel' => $searchModel,
        'user' => $user,
        'page' => 'index',
    ]) ?>
    
    <?= $this->render('_songs_table', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'user' => $user,
        'page' => 'index',
    ]) ?>

</div>
