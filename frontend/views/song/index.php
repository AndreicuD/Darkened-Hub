<?php

/** @var yii\web\View $this */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\bootstrap5\Html;
use yii\widgets\ListView;
use yii\helpers\Url;
use yii\bootstrap5\ActiveForm;


$this->title = 'Songs';
$this->registerJsFile('/js/popup.js', ['depends' => [\yii\web\JqueryAsset::class]]);
//$this->params['breadcrumbs'][] = Yii::t('app', 'Songs');
?>
<div class="songs-index">
    <h1 style="text-align: center;" class="page_title"><?= Yii::t('app', 'Songs'); ?></h1>

    <?= $this->render('_settingsbar', [
        'searchModel' => $searchModel,
        'page' => 'index',
    ]) ?>
    
    <div class="table_wrapper">       
        <table class="songs_table">
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Artist</th>
                    <th scope="col">First Guitar</th>
                    <th scope="col">Second Guitar</th>
                    <th scope="col">Bass</th>
                    <th scope="col">Drums</th>
                    <th scope="col">Piano</th>
                    <th scope="col">First Voice</th>
                    <th scope="col">Second Voice</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => '_item',
                    'viewParams' => [],
                    'options' => [
                        'class' => 'song_in_table',
                    ],
                    'itemOptions' => [
                        'tag' => 'tr',
                        'class' => 'song_in_table',
                    ],
                    'layout' => '{items}{pager}',
                    'pager' => [
                        'pageCssClass' => 'page-item',
                        'prevPageCssClass' => 'prev page-item',
                        'nextPageCssClass' => 'next page-item',
                        'firstPageCssClass' => 'first page-item',
                        'lastPageCssClass' => 'last page-item',
                        'linkOptions' => ['class' => 'page-link'],
                        'disabledListItemSubTagOptions' => ['class' => 'page-link'],
                        'options' => ['class' => 'pagination justify-content-center'],
                    ],
                ]); ?>
            </tbody>
        </table>
        
    </div>
    <!-- add song popup -->
    <div id="addsong_popup">
        <div class="overlay_opaque" onclick="closePopup('addsong_popup')"></div>
        <div class="popup">
            <h1 class="page_title"><?= Yii::t('app', 'Add Song') ?></h1>
            <?php $form = ActiveForm::begin([
                'id' => 'form-addsong',
                'layout' => 'floating',
                'action' => ['song/create'], // Specify the route to the create action
                'method' => 'post',
            ]); ?>
    
            <?= $form->errorSummary($searchModel);?>
            
            <div class="group_together">
                <?= $form->field($searchModel, 'title')->label(Yii::t('app', 'Title')) ?>
                <?= $form->field($searchModel, 'artist')->label(Yii::t('app', 'Artist')) ?>
            </div>
            <hr>
            <div class="group_together">
                <?= $form->field($searchModel, 'first_guitar')->label(Yii::t('app', 'First Guitar')) ?>
                <?= $form->field($searchModel, 'second_guitar')->label(Yii::t('app', 'Second Guitar')) ?>
            </div>
            <div class="group_together">
                <?= $form->field($searchModel, 'bass')->label(Yii::t('app', 'Bass')) ?>
                <?= $form->field($searchModel, 'drums')->label(Yii::t('app', 'Drums')) ?>
            </div>
            <div class="group_together">
                <?= $form->field($searchModel, 'first_voice')->label(Yii::t('app', 'First Voice')) ?>
                <?= $form->field($searchModel, 'second_voice')->label(Yii::t('app', 'Second Voice')) ?>
            </div>
            <?= $form->field($searchModel, 'piano')->label(Yii::t('app', 'Piano')) ?>
            <hr>
            <div class="group_together">
                <?= $form->field($searchModel, 'is_in_concert')->checkbox([
                    'uncheck' => '0',
                    'value' => '1',
                    'id' => 'is-in-concert-checkbox', // Add an ID for targeting with JS
                ]); ?>
                
                <?= $form->field($searchModel, 'setlist_spot')->label(Yii::t('app', 'Spot in Setlist')); ?>
                <?= $form->field($searchModel, 'state')->dropDownList([
                    '5' => $searchModel::stateList()['5'], // Gray for "Not done yet"
                    '4' => $searchModel::stateList()['4'],   // Green for "Great"
                    '3' => $searchModel::stateList()['3'],   // Yellow for "Ok"
                    '2' => $searchModel::stateList()['2'],    // Orange for "Could be better.."
                    '1' => $searchModel::stateList()['1'],    // Red for "Bad"
                ], [
                    'id' => 'song-state-dropdown',
                    'class' => 'custom-class',
                ]) ?>
            </div>
            
            <br>

            <div class="container text-center">
                <div class="row">
                    <div class="col">
                        <button onclick="closePopup('addsong_popup')" type="button" class="btn btn-danger"><?= Yii::t('app', 'Close') ?></button>
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const is_in_concert_checkbox = document.getElementById('is-in-concert-checkbox');
            const setlist_spot_input = document.getElementById('song-setlist_spot');
            //const song_state_input = document.getElementById('song-state-dropdown');

            function toggleLabelState() {
                if (is_in_concert_checkbox.checked) {
                    setlist_spot_input.disabled = false;
                    //song_state_input.disabled = false;
                } else {
                    setlist_spot_input.disabled = true;
                    //song_state_input.disabled = true;
                }
            }

            // Initialize state on page load
            toggleLabelState();

            // Add event listener to the checkbox
            is_in_concert_checkbox.addEventListener('change', toggleLabelState);
        });

    </script>
</div>
