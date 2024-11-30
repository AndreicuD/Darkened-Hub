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

    <img href="web/img/29Aug-1.JPG"></img>
</div>
