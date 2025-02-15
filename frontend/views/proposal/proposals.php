<?php

/** @var yii\web\View $this */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\bootstrap5\Html;
use yii\widgets\ListView;
use yii\helpers\Url;
use yii\bootstrap5\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

$this->title = Yii::t('app', 'Propuneri');
$this->registerJsFile('/js/popup.js', ['depends' => [\yii\web\JqueryAsset::class]]);
//$this->params['breadcrumbs'][] = Yii::t('app', 'Songs');
?>
<div class="songs-index">
    <h1 style="text-align: center;" class="page_title"><?= Html::encode($this->title) ?></h1>

    <ul class="settings_bar">
        <li><button role="button" class="btn btn-primary" onclick="openPopup('addproposal_popup')">Adauga Propunere</button></li>
        <li style="float: left;"><?=Html::a('Sterge Filtre', Url::to(['proposal/proposals']), ['class' => 'btn btn-danger']); ?></li>
        <li class="filters">
            <?php $form = ActiveForm::begin(['id' => 'form-searchsong','method' => 'get', 'layout' => 'inline']); ?>
            <?= $form->errorSummary($searchModel);?>
            
            <?= $form->field($searchModel, 'username')->widget(Select2::class, [
                'data' => ArrayHelper::map($user::find()->all(), 'username', 'username'), // Map usernames from your user model
                'theme' => Select2::THEME_KRAJEE_BS5,
                'options' => [
                    'placeholder' => 'Cauta dupa username...',
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]); ?>

            <?= $form->field($searchModel, 'title')->label(Yii::t('app', 'Ce propunere cauti?')) ?>
            <input type="submit" value="Cauta" class="btn btn-primary search_button">
            <?php ActiveForm::end(); ?>
        </li>
    </ul>
    <hr>

    <?= $this->render('_proposals_table', [
        'searchModel' => $searchModel,
        'songModel' => $songModel,
        'dataProvider' => $dataProvider,
        'page' => '',
        'user' => $user,
    ]) ?>
</div>
