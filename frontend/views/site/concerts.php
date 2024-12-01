<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
$this->registerJsFile('/js/clock.js', ['depends' => [\yii\web\JqueryAsset::class]]);

$this->title = 'Concerts';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-concerts">
    <h1 style="text-align: center;" class="page_title"><?= Html::encode($this->title) ?></h1>

    <h1 style="padding:0; margin: 0;" class="page_title">NEXT CONCERT:</h1>
    <div class="page_title">
        <p style="font-size: 8vw; padding-top: 1rem; margin: 0; line-height:0.8;" id="clock">00d 00h 00m 00s</p>
        <h2 class="page_title" id="date">DATE</h2>
    </div>
    <hr>

    <div id="slideshow" class="carousel slide" data-bs-ride="carousel">

        <!-- Indicators/dots -->
        <div class="carousel-indicators">
        <button type="button" data-bs-target="#slideshow" data-bs-slide-to="0" class="active carousel-control"></button>
        <button type="button" data-bs-target="#slideshow" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#slideshow" data-bs-slide-to="2"></button>
        </div>

        <!-- The slideshow/carousel -->
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

        <!-- Left and right controls/icons -->
        <button class="carousel-control-prev" type="button" data-bs-target="#slideshow" data-bs-slide="prev">
        <span class="carousel-control-prev-icon carousel-control"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#slideshow" data-bs-slide="next">
        <span class="carousel-control-next-icon carousel-control"></span>
        </button>
    </div>
</div>
