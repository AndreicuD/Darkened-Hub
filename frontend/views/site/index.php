<?php

/** @var yii\web\View $this */
/* @var $latestDataProvider yii\data\ActiveDataProvider */

use yii\bootstrap5\Html;
use yii\widgets\ListView;
use yii\helpers\Url;

//$this->registerJsFile('/js/tone.js', ['depends' => [\yii\web\JqueryAsset::class]]);
//$this->registerJsFile('/js/index_melody_play.js', ['depends' => [\yii\web\JqueryAsset::class]]);
//$this->registerJsFile('/js/melodyMaker.js', ['depends' => [\yii\web\JqueryAsset::class]]);

$this->title = 'Darkened Hub';
?>
<div class="site-index">
    <div class="hero">
        <p class="display-5 fw-bold lh-1 mb-3 hero_title user-select-none">Darkened</p>
        <p class="display-5 fw-bold lh-1 mb-3 hero_title user-select-none">Hub</p>
        <br>
        <p class="lead"><?= Yii::t('app', 'Find more information about our next concert '); ?> <a href="<?= Url::toRoute(['song/index']); ?>">here</a>.</p>
    </div>