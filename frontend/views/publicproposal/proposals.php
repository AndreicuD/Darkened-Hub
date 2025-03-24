<?php

/** @var yii\web\View $this */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\bootstrap5\Html;
use yii\widgets\ListView;
use yii\helpers\Url;
use yii\bootstrap5\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

$this->title = Yii::t('app', 'Propuneri Publice');
$this->registerJsFile('/js/popup.js', ['depends' => [\yii\web\JqueryAsset::class]]);
//$this->params['breadcrumbs'][] = Yii::t('app', 'Songs');
?>
<div class="songs-index">
    <h1 style="text-align: center;" class="page_title"><?= Html::encode($this->title) ?></h1>

    <ul class="settings_bar">
    <li style="float: left;"><?=Html::a('Șterge Filtre', Url::to(['publicproposal/proposals']), ['class' => 'btn btn-danger']); ?></li>
        <li class="filters">
            <?php $form = ActiveForm::begin(['id' => 'form-searchsong','method' => 'get', 'layout' => 'inline']); ?>
            <?= $form->errorSummary($searchModel);?>

            <?= $form->field($searchModel, 'title')->label(Yii::t('app', 'Ce propunere cauți?')) ?>
            <input type="submit" value="Caută" class="btn btn-primary search_button">
            <?php ActiveForm::end(); ?>
        </li>
    </ul>
    <hr class="settings_bar_hr">

    <?= $this->render('_public_proposals_table', [
        'searchModel' => $searchModel,
        'songModel' => $songModel,
        'dataProvider' => $dataProvider,
        'page' => 'public',
        'user' => $user,
    ]) ?>
</div>