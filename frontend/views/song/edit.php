<?php
/** @var yii\web\View $this */

use yii\bootstrap5\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

$this->title = Yii::t('app', 'Update Melodie');
?>
<div>
<h1 style="text-align: center;" class="page_title"><?= Html::encode($this->title) ?></h1>
    <?php $form_update = ActiveForm::begin(['id' => 'form-updatesong'.$model->id, 'type' => ActiveForm::TYPE_FLOATING, 'action' => ['song/update', 'id' => $model->id, 'page' => 'index']]); ?>

    <?= $form_update->errorSummary($model);?>

    <div class="group_together">
        <?= $form_update->field($model, 'title')->label(Yii::t('app', 'Titlu')) ?>
        <?= $form_update->field($model, 'artist')->label(Yii::t('app', 'Artist')) ?>
    </div>
    <hr>
    <div class="group_together">
        <?= $form_update->field($model, 'first_guitar')->widget(Select2::class, [
            'data' => ArrayHelper::map($user::find()->all(), 'username', 'username'), // Map usernames from your user model,
            'options' => ['placeholder' => $model::instrumentList()['first_guitar']],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label($model::instrumentList()['first_guitar']); ?>
        
        <?= $form_update->field($model, 'second_guitar')->widget(Select2::class, [
            'data' => ArrayHelper::map($user::find()->all(), 'username', 'username'), // Map usernames from your user model,
            'options' => ['placeholder' => $model::instrumentList()['second_guitar']],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label($model::instrumentList()['second_guitar']); ?>
    </div>
    <div class="group_together">
        <?= $form_update->field($model, 'bass')->widget(Select2::class, [
            'data' => ArrayHelper::map($user::find()->all(), 'username', 'username'), // Map usernames from your user model,
            'options' => ['placeholder' => $model::instrumentList()['bass']],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label($model::instrumentList()['bass']); ?>
        <?= $form_update->field($model, 'drums')->widget(Select2::class, [
            'data' => ArrayHelper::map($user::find()->all(), 'username', 'username'), // Map usernames from your user model,
            'options' => ['placeholder' => $model::instrumentList()['drums']],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label($model::instrumentList()['drums']); ?>
    </div>
    <?= $form_update->field($model, 'piano')->widget(Select2::class, [
        'data' => ArrayHelper::map($user::find()->all(), 'username', 'username'), // Map usernames from your user model,
        'options' => ['placeholder' => $model::instrumentList()['piano']],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ])->label($model::instrumentList()['piano']); ?>
    <div class="group_together">
        <?= $form_update->field($model, 'first_voice')->widget(Select2::class, [
            'data' => ArrayHelper::map($user::find()->all(), 'username', 'username'), // Map usernames from your user model,
            'options' => ['placeholder' => $model::instrumentList()['first_voice']],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label($model::instrumentList()['first_voice']); ?>
        <?= $form_update->field($model, 'second_voice')->widget(Select2::class, [
            'data' => ArrayHelper::map($user::find()->all(), 'username', 'username'), // Map usernames from your user model,
            'options' => ['placeholder' => $model::instrumentList()['second_voice']],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label($model::instrumentList()['second_voice']); ?>
    </div>
    <hr>
    <div class="group_together">
        <?= $form_update->field($model, 'is_in_concert')->checkbox([
            'uncheck' => '0',
            'value' => '1',
            'id' => 'is-in-concert-checkbox', // Add an ID for targeting with JS
        ])->label(Yii::t('app', 'E in concert?')); ?>
        
        <?= $form_update->field($model, 'setlist_spot')->label(Yii::t('app', 'Spot in Setlist')); ?>
        <?= $form_update->field($model, 'state')->dropDownList([
            '5' => $model::stateList()['5'], // Gray for "Not done yet"
            '4' => $model::stateList()['4'],   // Green for "Great"
            '3' => $model::stateList()['3'],   // Yellow for "Ok"
            '2' => $model::stateList()['2'],    // Orange for "Could be better.."
            '1' => $model::stateList()['1'],    // Red for "Bad"
        ], [
            'id' => 'song-state-dropdown',
            'class' => 'custom-class',
        ])->label(Yii::t('app', 'Stare')); ?>
    </div>
    
    <br>  
    <div class="container text-center">
        <div class="row">
            <div class="col">
            <?=Html::a('Cancel', Url::to(['song/' . $page]), ['class' => 'btn btn-danger']); ?>
            </div>
            <div class="col">
                <input type="submit" value="Salveaza Modificari" class="btn btn-success">
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>