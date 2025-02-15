<?php

/** @var yii\web\View $this */
/* @var $latestDataProvider yii\data\ActiveDataProvider */

use yii\bootstrap5\Html;
use yii\widgets\ListView;
use yii\helpers\Url;

$this->title = 'Darkened Tunes';
?>
<div class="site-index" style="position:relative;">
    <div class="hero">
        <p class="display-5 fw-bold lh-1 mb-3 hero_title user-select-none">Darkened</p>
        <p class="display-5 fw-bold lh-1 mb-3 hero_title user-select-none">Tunes</p>
        <br>
        <p class="lead"><?= Yii::t('app', 'Află mai multe informații despre următorul nostru concert '); ?> <a href="<?= Url::toRoute(['site/concerts']); ?>">aici</a>.</p>
    </div>
</div>
