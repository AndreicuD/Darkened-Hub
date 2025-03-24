<?php

/** @var yii\web\View $this */
/** @var $concertModel common\models\Concert */
/** @var $currentConcertModel common\models\Concert */

use yii\bootstrap5\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\DateTimePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\widgets\ListView;

$this->registerJsFile('/js/clock.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('/js/popup.js', ['depends' => [\yii\web\JqueryAsset::class]]);

$this->title = Yii::t('app', 'Anunțuri');
?>
<div id="concert_time" style="display: none;"><?= $currentConcertModel->date ?? '' ?></div>
<div class="site-calendar">
    <h1 style="text-align: center;" class="page_title"><?= Html::encode($this->title) ?></h1>

    <div class="index-section double-index-section">
        <div class="flex-div" style="align-self: flex-start;">
            <h3 class="page_title" style="min-height: 32px;">Creează un anunț</h3>
    
            <?php
                $form = ActiveForm::begin([
                    'id' => 'announcement-create-form',
                    'type' => ActiveForm::TYPE_FLOATING,
                    'action' => ['announcement/create'], // The action URL with the ID
                    'method' => 'post',
                ]);
            ?>
    
            <?= $form->errorSummary($announcementModel);?>
    
            <?= $form->field($announcementModel, 'title')->label(Yii::t('app', 'Titlu')) ?>
    
            <?= $form->field($announcementModel, 'description')->textarea(['rows' => 4, 'style' => 'min-height: 160px; overflow: auto;'])->label(Yii::t('app', 'Informații')) ?>
            <br>
            <?= Html::submitButton('Postează Anunțul', ['class' => 'btn btn-success', 'id' => 'create-announcement-button']) ?>
    
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <hr>
    <?= ListView::widget([
        'dataProvider' => $announcementList,
        'id' => 'announcements',
        'itemView' => '_announcement_edit',
        'viewParams' => [],
        'options' => [
            'tag' => 'div',
            'class' => 'list-wrapper row',
            'style' => 'display: flex; flex-direction: row; justify-content: center; flex-wrap: wrap;',
        ],
        'itemOptions' => [
            'tag' => 'div',
            'class' => 'announcement-div',
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
