<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\widgets\ListView;
$this->registerJsFile('/js/clock.js', ['depends' => [\yii\web\JqueryAsset::class]]);

$this->title = Yii::t('app', 'Concerte');
//$this->params['breadcrumbs'][] = $this->title;
?>
<div id="concert_time" style="display: none;"><?= $concert_date ?></div>
<div class="site-concerts">
    <!--<h1 style="text-align: center;" class="page_title"><?= Html::encode($this->title) ?></h1>-->

    <h1 style="padding:0; margin: 0;" class="page_title">URMĂTORUL CONCERT 🤘</h1>

    <?php 
        if($concertModel->title || $concertModel->description) {
            echo <<<HTML
                <div class="index-section" style="min-height: fit-content; padding: 1em 0 0 0;">
                    <div class="flex-div" style="min-height: fit-content;">
                        <h2 style="text-align: center; padding-top: 1em; font-weight: bold; font-size: 3em;">$concertModel->title</h2>
                    </div>
                    <div class="flex-div">
                        <p style="margin-bottom: 0; font-weight: bold;" class="noto-sans-500">$concertModel->description</p>
                        <h2 style="text-align: center;">|</h2>
                    </div>
                </div>
            HTML;
        }
    ?>
    
    <div class="page_title">
        <p class="clock_text" id="clock">00d 00h 00m</p>
        <h2 class="date_text" id="date">DATE</h2>
    </div>

    <hr class="settings_bar_hr">
    
    <div class="about-wrapper">
        <div class="about-text about-padding">
            <h3 class="page_title">Trimite o propunere:</h3>
            <?php $form = ActiveForm::begin([
                    'id' => 'form-addpublicproposal',
                    'layout' => 'floating',
                    'action' => ['proposal/createpublicproposal'],
                    'method' => 'post',
                ]); ?>
        
                <?= $form->errorSummary($model);?>
                
                <div class="group_together">
                    <?= $form->field($model, 'title')->label(Yii::t('app', 'Titlu')) ?>
                    <?= $form->field($model, 'artist')->label(Yii::t('app', 'Artist')) ?>
                </div>
                <?= $form->field($model, 'info')->textarea(['rows' => 2, 'style' => 'min-height: 80px; overflow: auto;'])->label(Yii::t('app', 'Vrei să ne dai mai multe informații?')) ?>
                
                <br>
                <div style="width: 100%; text-align: center;">
                    <input type="submit" value="Save" class="btn btn-primary">
                </div>
            <?php ActiveForm::end(); ?>
        </div>
        <div class="about-text about-padding">
            <h3 class="page_title">Ultimele propuse:</h3>
            <div class="proposal_table_wrapper">       
                <table class="proposal_table public_proposal_table">
                    <thead>
                        <tr>
                            <th scope="col">Titlu</th>
                            <th scope="col">Artist</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= ListView::widget([
                            'dataProvider' => $dataProvider,
                            'itemView' => '_proposal_item',
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
        </div>
    </div>
    
    <!--
    <div id="slideshow" class="carousel slide" data-bs-ride="carousel">

        <div class="carousel-indicators">
        <button type="button" data-bs-target="#slideshow" data-bs-slide-to="0" class="active carousel-control"></button>
        <button type="button" data-bs-target="#slideshow" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#slideshow" data-bs-slide-to="2"></button>
        </div>

        <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="../frontend/web/img/concert-photos/IMG_7787.jpg" class="d-block w-100">
        </div>
        <div class="carousel-item">
            <img src="../frontend/web/img/concert-photos/IMG_7971.jpg" class="d-block w-100">
        </div>
        <div class="carousel-item">
            <img src="../frontend/web/img/concert-photos/IMG_7839.jpg" class="d-block w-100">
        </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#slideshow" data-bs-slide="prev">
        <span class="carousel-control-prev-icon carousel-control"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#slideshow" data-bs-slide="next">
        <span class="carousel-control-next-icon carousel-control"></span>
        </button>
        -->
    </div>
</div>
