<?php

/** @var yii\web\View $this */

use yii\bootstrap5\Html;
use yii\widgets\ListView;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\grid\GridView;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

$this->registerJsFile('/js/popup.js', ['depends' => [\yii\web\JqueryAsset::class]]);

global $current_page;
$current_page = $page;
?>

<div class="table_wrapper">       
    <?php
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'layout' => '{items}{pager}{toggleData}{export}',
            'tableOptions' => [
                'class' => 'songs_table',
                'id' => 'songs_table',
            ],
            'resizableColumns' => false,
            'bordered' => false,
            'responsive' => false,
            'responsiveWrap' => false,
            'hover' => false,
            'striped' => false,
            'export' => [
                'label' => 'Export data',
                'showConfirmAlert' => false,
                'fontAwesome' => true,
                'options' => ['class' => 'btn-primary'],
            ],
            'exportConfig' => [
                GridView::CSV => ['filename' => 'songs',],
                GridView::EXCEL => ['filename' => 'songs'],
                GridView::JSON => ['filename' => 'songs'],
            ],
            'headerRowOptions' => ['class' => 'table_head_row'],
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'title', 
                    'format' => 'raw', 
                    'label' => 'Titlu',
                    'content' => function ($searchModel) {
                        return '<i class="fa fa-circle state-' . $searchModel->state . '" ></i> '. $searchModel->title;
                    },
                    'value' => function ($searchModel) {
                        return $searchModel->title;
                    },
                ],
                ['attribute' => 'artist', 'format' => 'text', 'label' => 'Artist'],
                [
                    'attribute' => 'first_guitar', 
                    'format' => 'text', 
                    'label' => $searchModel::instrumentList()['first_guitar'],
                ],  
                [
                    'attribute' => 'second_guitar', 
                    'format' => 'text', 
                    'label' => $searchModel::instrumentList()['second_guitar'],
                ],
                [
                    'attribute' => 'bass', 
                    'format' => 'text', 
                    'label' => $searchModel::instrumentList()['bass'],
                ],
                [
                    'attribute' => 'drums', 
                    'format' => 'text', 
                    'label' => $searchModel::instrumentList()['drums'],
                ],
                [
                    'attribute' => 'piano', 
                    'format' => 'text', 
                    'label' => $searchModel::instrumentList()['piano'],
                ],
                [
                    'attribute' => 'first_voice', 
                    'format' => 'text', 
                    'label' => $searchModel::instrumentList()['first_voice'],
                ],
                [
                    'attribute' => 'second_voice', 
                    'format' => 'text', 
                    'label' => $searchModel::instrumentList()['second_voice'],
                ],
                [
                    'attribute' => 'state',
                    'format' => 'text',
                    'label' => 'Stare',
                    'value' => function ($searchModel) {
                        return $searchModel::stateList()[$searchModel->state];
                    }
                ],
                [
                    'attribute' => '', 
                    'format' => 'raw', 
                    'label' => '',
                    'value' => function ($searchModel) {
                        global $current_page;
                        return '<button onclick="location.href=' . "'" . 'edit?id=' . $searchModel->id . '&page=' . $current_page . "'" . '"' . ' class="icon_btn">
                                    <svg xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-adjustments"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 10a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M6 4v4" /><path d="M6 12v8" /><path d="M10 16a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M12 4v10" /><path d="M12 18v2" /><path d="M16 7a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M18 4v1" /><path d="M18 9v11" /></svg>
                                </button>';
                    }
                ],
                [
                    'attribute' => '', 
                    'format' => 'raw', 
                    'label' => '',
                    'value' => function ($searchModel) {
                        return '<button onclick=' . "'" . 'openPopup("delete_song_popup-' . $searchModel->id . '")' . "'" . ' class="icon_btn trash_btn">
                                    <svg xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                </button>';
                    }
                ],
            ],
        ]);
    ?>
</div>

<!-- add song popup -->
<div id="addsong_popup">
    <div class="overlay_opaque" onclick="closePopup('addsong_popup')"></div>
    <div class="popup">
        <h1 class="page_title"><?= Yii::t('app', 'Adaugă Melodie') ?></h1>
        <?php $form = ActiveForm::begin([
            'id' => 'form-addsong',
            'type' => ActiveForm::TYPE_FLOATING,
            'action' => ['song/create'], // Specify the route to the create action
            'method' => 'post',
        ]); ?>

        <?= $form->errorSummary($searchModel);?>
        
        <div class="group_together">
            <?= $form->field($searchModel, 'title')->label(Yii::t('app', 'Titlu')) ?>
            <?= $form->field($searchModel, 'artist')->label(Yii::t('app', 'Artist')) ?>
        </div>
        <hr>
        <div class="group_together">
            <?= $form->field($searchModel, 'first_guitar')->widget(Select2::class, [
                'data' => ArrayHelper::map($user::find()->all(), 'username', 'username'), // Map usernames from your user model,
                'options' => ['placeholder' => $searchModel::instrumentList()['first_guitar']],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])->label($searchModel::instrumentList()['first_guitar']); ?>
            
            <?= $form->field($searchModel, 'second_guitar')->widget(Select2::class, [
                'data' => ArrayHelper::map($user::find()->all(), 'username', 'username'), // Map usernames from your user model,
                'options' => ['placeholder' => $searchModel::instrumentList()['second_guitar']],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])->label($searchModel::instrumentList()['second_guitar']); ?>
        </div>
        <div class="group_together">
            <?= $form->field($searchModel, 'bass')->widget(Select2::class, [
                'data' => ArrayHelper::map($user::find()->all(), 'username', 'username'), // Map usernames from your user model,
                'options' => ['placeholder' => $searchModel::instrumentList()['bass']],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])->label($searchModel::instrumentList()['bass']); ?>
            <?= $form->field($searchModel, 'drums')->widget(Select2::class, [
                'data' => ArrayHelper::map($user::find()->all(), 'username', 'username'), // Map usernames from your user model,
                'options' => ['placeholder' => $searchModel::instrumentList()['drums']],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])->label($searchModel::instrumentList()['drums']); ?>
        </div>
        <?= $form->field($searchModel, 'piano')->widget(Select2::class, [
            'data' => ArrayHelper::map($user::find()->all(), 'username', 'username'), // Map usernames from your user model,
            'options' => ['placeholder' => $searchModel::instrumentList()['piano']],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label($searchModel::instrumentList()['piano']); ?>
        <div class="group_together">
            <?= $form->field($searchModel, 'first_voice')->widget(Select2::class, [
                'data' => ArrayHelper::map($user::find()->all(), 'username', 'username'), // Map usernames from your user model,
                'options' => ['placeholder' => $searchModel::instrumentList()['first_voice']],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])->label($searchModel::instrumentList()['first_voice']); ?>
            <?= $form->field($searchModel, 'second_voice')->widget(Select2::class, [
                'data' => ArrayHelper::map($user::find()->all(), 'username', 'username'), // Map usernames from your user model,
                'options' => ['placeholder' => $searchModel::instrumentList()['second_voice']],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])->label($searchModel::instrumentList()['second_voice']); ?>
        </div>
        <hr>
        <div class="group_together">
            <?= $form->field($searchModel, 'is_in_concert')->checkbox([
                'uncheck' => '0',
                'value' => '1',
                'id' => 'is-in-concert-checkbox', // Add an ID for targeting with JS
            ])->label(Yii::t('app', 'E în concert?')); ?>
            
            <?= $form->field($searchModel, 'setlist_spot')->label(Yii::t('app', 'Loc în Setlist')); ?>
            <?= $form->field($searchModel, 'state')->dropDownList([
                '5' => $searchModel::stateList()['5'], // Gray for "Not done yet"
                '4' => $searchModel::stateList()['4'],   // Green for "Great"
                '3' => $searchModel::stateList()['3'],   // Yellow for "Ok"
                '2' => $searchModel::stateList()['2'],    // Orange for "Could be better.."
                '1' => $searchModel::stateList()['1'],    // Red for "Bad"
            ], [
                'id' => 'song-state-dropdown',
                'class' => 'custom-class',
            ])->label(Yii::t('app', 'Stare')); ?>
        </div>
        
        <br>

        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <button onclick="closePopup('addsong_popup')" type="button" class="btn btn-danger"><?= Yii::t('app', 'Închide') ?></button>
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

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_delete_songs_popups',
    'viewParams' => [],
    'options' => [
        'tag' => 'div',
    ],
    'itemOptions' => [
        'tag' => 'div',
    ],
    'layout' => '{items}',
]); ?>