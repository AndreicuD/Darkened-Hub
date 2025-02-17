<?php

/** @var yii\web\View $this */

use yii\bootstrap5\Html;
use yii\widgets\ListView;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\grid\GridView;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

$songModel->title = $model->title;
$songModel->artist = $model->artist;
?>
<!-- erase public proposal popup -->
<div id="delete_<?=$page?>proposal_popup-<?=$model->id?>">
    <div class="overlay_opaque" onclick="closePopup('delete_<?=$page?>proposal_popup-<?=$model->id?>')"></div>
    <div class="popup">
        <h1 class="page_title"><?= Yii::t('app', 'Asta va șterge propunerea pentru: ') ?><strong><?= Html::encode($model->title) ?></strong></h1>
        <p style="text-align: center; line-height: 1.5rem; padding: 0;" class="lead"><?= Yii::t('app', 'Ești sigur că vrei să continui?') ?></p>
        <br>
        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <button onclick="closePopup('delete_<?=$page?>proposal_popup-<?=$model->id?>')" type="button" class="btn btn-secondary"><?= Yii::t('app', 'Nu') ?></button>
                </div>
                <div class="col">
                    <a href="<?= Url::toRoute(['proposal/delete' . $page . 'proposal', 'id' => $model->id]); ?>" class="btn btn-danger"><?= Yii::t('app', 'Da') ?></a>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="update_<?=$page?>proposal_popup-<?=$model->id?>">
    <div class="overlay_opaque" onclick="closePopup('update_<?=$page?>proposal_popup-<?=$model->id?>')"></div>
    <div class="popup">
        <h1 class="page_title"><?= Yii::t('app', 'Update Propunere') ?></h1>
        <?php $form_update = ActiveForm::begin(['id' => 'form-'. $page . 'updateproposal'.$model->id, 'type' => ActiveForm::TYPE_FLOATING, 'action' => ['proposal/update' . $page . 'proposal', 'id' => $model->id, 'page' => 'index']]); ?>

        <?= $form_update->errorSummary($model);?>

        <div class="group_together">
            <?= $form_update->field($model, 'title')->label(Yii::t('app', 'Titlu')) ?>
            <?= $form_update->field($model, 'artist')->label(Yii::t('app', 'Artist')) ?>
        </div>
        <?= $form_update->field($model, 'info')->textarea(['rows' => 2, 'style' => 'min-height: 80px']) ?>
            
        <br>   
        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <button onclick="closePopup('update_<?=$page?>proposal_popup-<?=$model->id?>')" type="button" class="btn btn-danger"><?= Yii::t('app', 'Închide') ?></button>
                </div>
                <div class="col">
                    <input type="submit" value="Salvează" class="btn btn-success">
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

<!-- add song popup -->
<div id="sendtosetlist_popup-<?=$model->id?>">
    <div class="overlay_opaque" onclick="closePopup('sendtosetlist_popup-<?=$model->id?>')"></div>
    <div class="popup">
        <h1 class="page_title"><?= Yii::t('app', 'Trimite în lista de melodii') ?></h1>
        <?php $form = ActiveForm::begin([
            'id' => 'form-addsong',
            'type' => ActiveForm::TYPE_FLOATING,
            'action' => ['song/create'], // Specify the route to the create action
            'method' => 'post',
        ]); ?>

        <?= $form->errorSummary($songModel);?>
        
        <div class="group_together">
            <?= $form->field($songModel, 'title')->label(Yii::t('app', 'Titlu')) ?>
            <?= $form->field($songModel, 'artist')->label(Yii::t('app', 'Artist')) ?>
        </div>
        <hr>
        <div class="group_together">
            <?= $form->field($songModel, 'first_guitar')->widget(Select2::class, [
                'data' => ArrayHelper::map($user::find()->all(), 'username', 'username'), // Map usernames from your user model,
                'options' => ['placeholder' => $songModel::instrumentList()['first_guitar']],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])->label($songModel::instrumentList()['first_guitar']); ?>
            
            <?= $form->field($songModel, 'second_guitar')->widget(Select2::class, [
                'data' => ArrayHelper::map($user::find()->all(), 'username', 'username'), // Map usernames from your user model,
                'options' => ['placeholder' => $songModel::instrumentList()['second_guitar']],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])->label($songModel::instrumentList()['second_guitar']); ?>
        </div>
        <div class="group_together">
            <?= $form->field($songModel, 'bass')->widget(Select2::class, [
                'data' => ArrayHelper::map($user::find()->all(), 'username', 'username'), // Map usernames from your user model,
                'options' => ['placeholder' => $songModel::instrumentList()['bass']],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])->label($songModel::instrumentList()['bass']); ?>
            <?= $form->field($songModel, 'drums')->widget(Select2::class, [
                'data' => ArrayHelper::map($user::find()->all(), 'username', 'username'), // Map usernames from your user model,
                'options' => ['placeholder' => $songModel::instrumentList()['drums']],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])->label($songModel::instrumentList()['drums']); ?>
        </div>
        <?= $form->field($songModel, 'piano')->widget(Select2::class, [
            'data' => ArrayHelper::map($user::find()->all(), 'username', 'username'), // Map usernames from your user model,
            'options' => ['placeholder' => $songModel::instrumentList()['piano']],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label($songModel::instrumentList()['piano']); ?>
        <div class="group_together">
            <?= $form->field($songModel, 'first_voice')->widget(Select2::class, [
                'data' => ArrayHelper::map($user::find()->all(), 'username', 'username'), // Map usernames from your user model,
                'options' => ['placeholder' => $songModel::instrumentList()['first_voice']],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])->label($songModel::instrumentList()['first_voice']); ?>
            <?= $form->field($songModel, 'second_voice')->widget(Select2::class, [
                'data' => ArrayHelper::map($user::find()->all(), 'username', 'username'), // Map usernames from your user model,
                'options' => ['placeholder' => $songModel::instrumentList()['second_voice']],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])->label($songModel::instrumentList()['second_voice']); ?>
        </div>
        <hr>
        <div class="group_together">
            <?= $form->field($songModel, 'is_in_concert')->checkbox([
                'uncheck' => '0',
                'value' => '1',
                'id' => 'is-in-concert-checkbox', // Add an ID for targeting with JS
            ])->label(Yii::t('app', 'E în concert?')); ?>
            
            <?= $form->field($songModel, 'setlist_spot')->label(Yii::t('app', 'Loc în Setlist')); ?>
            <?= $form->field($songModel, 'state')->dropDownList([
                '5' => $songModel::stateList()['5'], // Gray for "Not done yet"
                '4' => $songModel::stateList()['4'],   // Green for "Great"
                '3' => $songModel::stateList()['3'],   // Yellow for "Ok"
                '2' => $songModel::stateList()['2'],    // Orange for "Could be better.."
                '1' => $songModel::stateList()['1'],    // Red for "Bad"
            ], [
                'id' => 'song-state-dropdown',
                'class' => 'custom-class',
            ])->label(Yii::t('app', 'Stare')); ?>
        </div>
        
        <br>

        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <button onclick="closePopup('sendtosetlist_popup-<?=$model->id?>')" type="button" class="btn btn-danger"><?= Yii::t('app', 'Închide') ?></button>
                </div>
                <div class="col">
                    <input type="reset" value="Resetează" class="btn btn-warning">
                </div>
                <div class="col">
                    <input type="submit" value="Salvează" class="btn btn-success">
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>