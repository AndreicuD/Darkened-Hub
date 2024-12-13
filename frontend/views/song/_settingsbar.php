<?php
use yii\bootstrap5\Html;
use yii\widgets\ListView;
use yii\helpers\Url;
use yii\bootstrap5\ActiveForm;
?>
<ul class="settings_bar">
    <?php
        if($page == 'index') echo "<li><button role=" . '"button"' . 'class="btn btn-primary" onclick="openPopup(' . "'addsong_popup'" . ')">Add song</button></li>'
    ?>
    <!--<li><button role="button" class="btn btn-primary" onclick="openPopup('addsong_popup')">Add song</button></li>-->
    <li style="float: left;"><?=Html::a('Clear Filters', Url::to(['song/' . $page]), ['class' => 'btn btn-danger']); ?></li>
    <li class="filters">
        <?php $form = ActiveForm::begin(['id' => 'form-searchsong','method' => 'get', 'layout' => 'inline']); ?>
        <?= $form->errorSummary($searchModel);?>

        <?= $form->field($searchModel, 'state')->dropDownList([
            '5' => $searchModel::stateList()['5'], // Gray for "Not done yet"
            '4' => $searchModel::stateList()['4'],   // Green for "Great"
            '3' => $searchModel::stateList()['3'],   // Yellow for "Ok"
            '2' => $searchModel::stateList()['2'],    // Orange for "Could be better.."
            '1' => $searchModel::stateList()['1'],    // Red for "Bad"
        ], [
            'encode' => false, // Allow HTML in the dropdown options
            'prompt' => 'Any State',
        ]) ?>

        <?= $form->field($searchModel, 'title')->label(Yii::t('app', 'What song are you looking for?')) ?>
        <input type="submit" value="Search" class="btn btn-primary search_button">
        <?php ActiveForm::end(); ?>
    </li>
</ul>
<hr>
<div style="padding-bottom: 1rem; display: flex; flex-flow: row wrap; justify-content: center;">
    <div style="margin-left: 1em; margin-right: 1em;">
        <i class="fa fa-circle state-5 glow_text" aria-hidden="true"></i>
        <span id="song_title" class="glow_text"> -> <?= Html::encode($searchModel::stateList()['5']) ?></span>
    </div>
    <div style="margin-left: 1em; margin-right: 1em;">
        <i class="fa fa-circle state-1 glow_text" aria-hidden="true"></i>
        <span id="song_title" class="glow_text"> -> <?= Html::encode($searchModel::stateList()['1']) ?></span>
    </div>
    <div style="margin-left: 1em; margin-right: 1em;">
        <i class="fa fa-circle state-2 glow_text" aria-hidden="true"></i>
        <span id="song_title" class="glow_text"> -> <?= Html::encode($searchModel::stateList()['2']) ?></span>
    </div>
    <div style="margin-left: 1em; margin-right: 1em;">
        <i class="fa fa-circle state-3 glow_text" aria-hidden="true"></i>
        <span id="song_title" class="glow_text"> -> <?= Html::encode($searchModel::stateList()['3']) ?></span>
    </div>
    <div style="margin-left: 1em; margin-right: 1em;">
        <i class="fa fa-circle state-4 glow_text" aria-hidden="true"></i>
        <span id="song_title" class="glow_text"> -> <?= Html::encode($searchModel::stateList()['4']) ?></span>
    </div>
</div>