<?php

/** @var yii\web\View $this */
/* @var $latestDataProvider yii\data\ActiveDataProvider */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\widgets\ListView;
use yii\helpers\Url;

$this->registerJsFile('/js/clock.js', ['depends' => [\yii\web\JqueryAsset::class]]);

$this->title = 'Darkened Tunes';
?>
<div class="site-index" style="position:relative;">
    <!--<div class="hero">
        <p class="display-5 fw-bold lh-1 mb-3 hero_title user-select-none">Darkened</p>
        <p class="display-5 fw-bold lh-1 mb-3 hero_title user-select-none">Tunes</p>
        <br>
        <p class="lead"><?= Yii::t('app', 'Află mai multe informații despre următorul nostru concert '); ?> <a href="<?= Url::toRoute(['site/concerts']); ?>">aici</a>.</p>
    </div>
    <div class="about">
        <img src="frontend\web\img\29Aug-1.JPG">
    </div>-->
    <div class="hero">
        <!--<div class="hero-text">
            <p class="display-5 fw-bold lh-1 mb-3 hero_title user-select-none">DARKENED</p>
            <p class="display-5 fw-bold lh-1 mb-3 hero_title user-select-none">TUNES</p>
        </div>-->
        <a class="hero-text" href="#content">
            <svg class="down-arrow" xmlns="http://www.w3.org/2000/svg"  width="60"  height="60"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-compact-down"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 11l8 3l8 -3" /></svg>
        </a>
    </div>
    <div class="index" id="content">
        <div class="index-section double-index-section about-us-index">
            <div class="flex-div">
                <h2 class="section-title title alfa-font">DESPRE NOI</h2>
                <p class="noto-sans-500 section-text">
                    Bine ați venit la <strong>Clubul de Muzică „Darkened Tunes”</strong>, 
                    locul unde pasiunea pentru muzică prinde viață! În cadrul Colegiului Național „Tudor Vianu”, 
                    acest club reprezintă un spațiu creativ în care elevii talentați își pot exprima iubirea pentru 
                    sunet și ritm, dezvoltându-și abilitățile artistice și creând legături speciale prin muzică.
                </p>
                <a href="<?= Url::toRoute(['site/about']); ?>" class="btn btn-primary">Află mai multe informații despre noi.</a>
            </div>
            <div class="flex-div">
                <img src="..\frontend\web\img\about.png" alt="Photo of us">
            </div>
        </div>
        <div class="index-section concert-index">
            <div class="flex-div">
                <h2 class="section-title alfa-font">CONCERTE</h2>
            </div>
            <div class="flex-div">
                <div class="page_title">
                    <div id="concert_time" style="display: none;"><?= $concert_date ?></div>
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
                    <p class="clock_text" id="clock">00d 00h 00m 00s</p>
                    <h2 class="date_text" id="date">DATE</h2>
                    <hr>
                </div>
            </div>
            <div class="flex-div">
                <p class="noto-sans-500 section-text">Ai o propunere pentru următoarele concerte?</p>
                <div class="about-wrapper">
                    <div class="about-text">
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
                            <?= $form->field($model, 'info')->textarea(['rows' => 2, 'style' => 'min-height: 80px; overflow: hidden;'])->label(Yii::t('app', 'Vrei să ne dai mai multe informații?')) ?>
                            
                            <br>
                            <div style="width: 100%; text-align: center;">
                                <input type="submit" value="Save" class="btn btn-primary">
                            </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                    <div class="about-text">
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
            </div>
        </div>
        <div class="index-section announcement-index">
            <div class="flex-div">
                <h2 class="section-title alfa-font">ANUNȚURI</h2>
            </div>
            <div class="flex-div">
                <br>
                <?= ListView::widget([
                    'dataProvider' => $data_announcement,
                    'id' => 'announcements',
                    'itemView' => '_announcement',
                    'viewParams' => [],
                    'options' => [
                        'tag' => 'div',
                        'class' => 'list-wrapper row',
                        'style' => 'display: flexbox; flex-direction: row; justify-content: center;'
                    ],
                    'itemOptions' => [
                        'tag' => 'div',
                        'class' => 'col-4 announcement-div',
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
            </div>
        </div>
        <div class="index-section what-do-index">
            <img class="youtube-background" src="../frontend/web/img/what-do-photo-custom.png">
            <div class="flex-div">
                <h2 class="section-title alfa-font">CE FACEM NOI?</h2>
                <h3 class="index-second-title alfa-font">NEW VIDEO</h3>
            </div>
            <div class="flex-div has-yt-link">
                <div class="youtube-link">
                    
                    <iframe src="https://www.youtube.com/embed/3_T9pet-E-U?si=tJodjlHBy-iczCZU" title="Versprechen aus der Kindheit" frameborder="0" allow="picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="index-section memories-index">
        <div class="flex-div">
            <h2 class="section-title alfa-font">AMINTIRI</h2>
        </div>
        <div class="flex-div">
            <div class="memories-flex">
                <div class="col-memories">
                    <img src="..\frontend\web\img\memories\13Dec-2161.jpg">
                    <img src="..\frontend\web\img\memories\13Dec-2070.jpg">
                    <img src="..\frontend\web\img\memories\IMG_7971.jpg">
                    <!--<img src="..\frontend\web\img\memories\28Aug-92.jpg">-->
                </div>
                <div class="col-memories">
                    <img src="..\frontend\web\img\memories\13Dec-1978.jpg">
                    <img src="..\frontend\web\img\memories\13Dec-2171.jpg">
                    <img src="..\frontend\web\img\memories\IMG_8008.jpg">
                    <!--<img src="..\frontend\web\img\memories\28Aug-31.jpg">-->
                </div>
                <div class="col-memories">
                    <img src="..\frontend\web\img\memories\13Dec-1674.jpg">
                    <img src="..\frontend\web\img\memories\13Dec-1957.jpg">
                    <img src="..\frontend\web\img\memories\13Dec-1896.jpg">
                    <!--<img src="..\frontend\web\img\memories\29Aug-10.jpg">-->
                </div>
            </div>
        </div>
    </div>
</div>
