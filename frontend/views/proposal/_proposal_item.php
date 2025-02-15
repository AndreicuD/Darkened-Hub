<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $widget yii\widgets\ListView this widget instance */
/* @var $key mixed the key value associated with the data item */
/* @var $index integer the zero-based index of the data item in the items array returned by the data provider */


//PLEASE MAKE PAGE 'public' if you want to show public proposals, else leave blank '';

$songModel->title = $model->title;
$songModel->artist = $model->artist;
?>

<th><span id="proposal_title"><?= Html::encode($model->title) ?></span></th>
<td><span id="proposal_artist"><?= Html::encode($model->artist) ?></span></td>
<td><span id="proposal_info"><?= Html::encode($model->info) ?></span></td>
<td style="text-align: right;">
    <button onclick="openPopup('sendtosetlist_popup-<?=$model->id?>')" class="icon_btn">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-brand-telegram">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M15 10l-4 4l6 6l4 -16l-18 7l4 2l2 6l3 -4" />
        </svg>    
    </button>
    <button onclick="openPopup('update_<?=$page?>proposal_popup-<?=$model->id?>')" class="icon_btn">
        <svg xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-adjustments"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 10a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M6 4v4" /><path d="M6 12v8" /><path d="M10 16a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M12 4v10" /><path d="M12 18v2" /><path d="M16 7a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M18 4v1" /><path d="M18 9v11" /></svg>
    </button>
    <button onclick="openPopup('delete_<?=$page?>proposal_popup-<?=$model->id?>')" class="icon_btn trash_btn">
        <svg xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
    </button>
</td>

<!-- update proposal popup -->
<div id="update_<?=$page?>proposal_popup-<?=$model->id?>">
    <div class="overlay_opaque" onclick="closePopup('update_<?=$page?>proposal_popup-<?=$model->id?>')"></div>
    <div class="popup">
        <h1 class="page_title"><?= Yii::t('app', 'Update Proposal') ?></h1>
        <?php $form_update = ActiveForm::begin(['id' => 'form-'. $page . 'updateproposal'.$model->id, 'layout' => 'floating', 'action' => ['song/update' . $page . 'proposal', 'id' => $model->id, 'page' => 'index']]); ?>

        <?= $form_update->errorSummary($model);?>

        <div class="group_together">
            <?= $form_update->field($model, 'title')->label(Yii::t('app', 'Title')) ?>
            <?= $form_update->field($model, 'artist')->label(Yii::t('app', 'Artist')) ?>
        </div>
        <?= $form_update->field($model, 'info')->textarea(['rows' => 2, 'style' => 'min-height: 80px']) ?>
            
        <br>   
        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <button onclick="closePopup('update_<?=$page?>proposal_popup-<?=$model->id?>')" type="button" class="btn btn-danger"><?= Yii::t('app', 'Close') ?></button>
                </div>
                <div class="col">
                    <input type="submit" value="Save" class="btn btn-success">
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

<!-- erase public proposal popup -->
<div id="delete_<?=$page?>proposal_popup-<?=$model->id?>">
    <div class="overlay_opaque" onclick="closePopup('delete_<?=$page?>proposal_popup-<?=$model->id?>')"></div>
    <div class="popup">
        <h1 class="page_title"><?= Yii::t('app', 'This will delete the proposal for:') ?></h1>
        <div style="text-align: center;">
            <h1><strong><?= Html::encode($model->title) ?></strong></h1>
            <br>
            <p><?= Yii::t('app', 'Are you sure you want to continue?') ?></p>
        </div>
        <br>
        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <button onclick="closePopup('delete_<?=$page?>proposal_popup-<?=$model->id?>')" type="button" class="btn btn-secondary"><?= Yii::t('app', 'No') ?></button>
                </div>
                <div class="col">
                    <a href="<?= Url::toRoute(['song/delete' . $page . 'proposal', 'id' => $model->id]); ?>" class="btn btn-danger"><?= Yii::t('app', 'Yes') ?></a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- add song popup -->
<div id="sendtosetlist_popup-<?=$model->id?>">
        <div class="overlay_opaque" onclick="closePopup('sendtosetlist_popup-<?=$model->id?>')"></div>
        <div class="popup">
            <h1 class="page_title"><?= Yii::t('app', 'Add Song') ?></h1>
            <?php $form = ActiveForm::begin([
                'id' => 'form-addsong',
                'layout' => 'floating',
                'action' => ['song/create'], // Specify the route to the create action
                'method' => 'post',
            ]); ?>
    
            <?= $form->errorSummary($songModel);?>
            
            <div class="group_together">
                <?= $form->field($songModel, 'title')->label(Yii::t('app', 'Title')) ?>
                <?= $form->field($songModel, 'artist')->label(Yii::t('app', 'Artist')) ?>
            </div>
            <hr>
            <div class="group_together">
                <?= $form->field($songModel, 'first_guitar')->label(Yii::t('app', 'First Guitar')) ?>
                <?= $form->field($songModel, 'second_guitar')->label(Yii::t('app', 'Second Guitar')) ?>
            </div>
            <div class="group_together">
                <?= $form->field($songModel, 'bass')->label(Yii::t('app', 'Bass')) ?>
                <?= $form->field($songModel, 'drums')->label(Yii::t('app', 'Drums')) ?>
            </div>
            <div class="group_together">
                <?= $form->field($songModel, 'first_voice')->label(Yii::t('app', 'First Voice')) ?>
                <?= $form->field($songModel, 'second_voice')->label(Yii::t('app', 'Second Voice')) ?>
            </div>
            <?= $form->field($songModel, 'piano')->label(Yii::t('app', 'Piano')) ?>
            <hr>
            <div class="group_together">
                <?= $form->field($songModel, 'is_in_concert')->checkbox([
                    'uncheck' => '0',
                    'value' => '1',
                    'id' => 'is-in-concert-checkbox', // Add an ID for targeting with JS
                ]); ?>
                
                <?= $form->field($songModel, 'setlist_spot')->label(Yii::t('app', 'Spot in Setlist')); ?>
                <?= $form->field($songModel, 'state')->dropDownList([
                    '5' => $songModel::stateList()['5'], // Gray for "Not done yet"
                    '4' => $songModel::stateList()['4'],   // Green for "Great"
                    '3' => $songModel::stateList()['3'],   // Yellow for "Ok"
                    '2' => $songModel::stateList()['2'],    // Orange for "Could be better.."
                    '1' => $songModel::stateList()['1'],    // Red for "Bad"
                ], [
                    'id' => 'song-state-dropdown',
                    'class' => 'custom-class',
                ]) ?>
            </div>
            
            <br>

            <div class="container text-center">
                <div class="row">
                    <div class="col">
                        <button onclick="closePopup('sendtosetlist_popup-<?=$model->id?>')" type="button" class="btn btn-danger"><?= Yii::t('app', 'Close') ?></button>
                    </div>
                    <div class="col">
                        <input type="reset" value="Reset" class="btn btn-warning">
                    </div>
                    <div class="col">
                        <input type="submit" value="Save" class="btn btn-success">
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>