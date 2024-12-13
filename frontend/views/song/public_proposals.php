<?php

/** @var yii\web\View $this */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\bootstrap5\Html;
use yii\widgets\ListView;
use yii\helpers\Url;
use yii\bootstrap5\ActiveForm;


$this->title = 'Public Proposals';
$this->registerJsFile('/js/popup.js', ['depends' => [\yii\web\JqueryAsset::class]]);
//$this->params['breadcrumbs'][] = Yii::t('app', 'Songs');
?>
<div class="songs-index">
    <h1 style="text-align: center;" class="page_title"><?= Yii::t('app', 'Public Proposals'); ?></h1>

    <ul class="settings_bar">
        <li style="float: left;"><?=Html::a('Clear Filters', Url::to(['song/public_proposals']), ['class' => 'btn btn-danger']); ?></li>
        <li class="filters">
            <?php $form = ActiveForm::begin(['id' => 'form-searchsong','method' => 'get', 'layout' => 'inline']); ?>
            <?= $form->errorSummary($searchModel);?>
            <?= $form->field($searchModel, 'title')->label(Yii::t('app', 'What proposal are you looking for?')) ?>

            <input type="submit" value="Search" class="btn btn-primary search_button">
            <?php ActiveForm::end(); ?>
        </li>
    </ul>
    <hr>
    
    <div class="table_wrapper">       
        <table class="songs_table">
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Artist</th>
                    <th scope="col">More Info</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => '_proposal_item',
                    'viewParams' => [
                        'page' => 'public',
                        'songModel' => $songModel,
                    ],                           
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