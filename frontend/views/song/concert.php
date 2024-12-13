<?php

/** @var yii\web\View $this */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\bootstrap5\Html;
use yii\widgets\ListView;
use yii\helpers\Url;
use yii\bootstrap5\ActiveForm;

$this->title = 'Concert';
$this->registerJsFile('/js/popup.js', ['depends' => [\yii\web\JqueryAsset::class]]);
//$this->params['breadcrumbs'][] = Yii::t('app', 'Songs');
?>
<div class="songs-index">
    <h1 style="text-align: center;" class="page_title"><?= Yii::t('app', 'Concert'); ?></h1>
    
    <?= $this->render('_settingsbar', [
        'searchModel' => $searchModel,
        'page' => 'concert',
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
                </tr>
            </thead>
            <tbody>
                <?= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => '_concert_item',
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