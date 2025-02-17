<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\DateTimePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\widgets\ListView;

$this->registerJsFile('/js/clock.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('/js/popup.js', ['depends' => [\yii\web\JqueryAsset::class]]);

$this->title = Yii::t('app', 'Informații Concert și Anunțuri');
?>
<div id="concert_time" style="display: none;"><?= $concert_date ?></div>
<div class="site-calendar">
    <h1 style="text-align: center;" class="page_title"><?= Html::encode($this->title) ?></h1>
    
    <div class="index-section double-index-section">
        <div class="flex-div" style="align-self: flex-start;">
            <h3 class="page_title">Modifică informațiile concertului</h3>

            <?php
                $form = ActiveForm::begin([
                    'id' => 'concert-date-form',
                    'type' => ActiveForm::TYPE_FLOATING,
                    'action' => ['concert/updateconcertinfo', 'id' => 1], // The action URL with the ID
                    'method' => 'post',
                ]);
            ?>

            <?= $form->errorSummary($concertModel);?>

            <?= $form->field($concertModel, 'title')->label(Yii::t('app', 'Titlu')) ?>

            <?= $form->field($concertModel, 'description')->textarea(['rows' => 2, 'style' => 'min-height: 80px; overflow: auto;'])->label(Yii::t('app', 'Descrierea concertului')) ?>

            <?= $form->field($concertModel, 'date')->widget(DateTimePicker::class, [
                'name' => 'concert_datetimepicker',
                'value' => $concert_date,
                'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
                'options' => ['id' => 'concert-date', 'placeholder' => $concert_date],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd hh:ii',
                    'todayHighlight' => false,
                    'todayBtn' => false,
                ],
            ])->label(false); ?>
            <br>
    
            <?= Html::button('Data nu este stabilită', ['class' => 'btn btn-danger', 'style' => 'min-width: 40%; margin-bottom: 1em;', 'id' => 'set-current-time']) ?>
            <br>
            <?= Html::submitButton('Salvează Data', ['class' => 'btn btn-success', 'id' => 'set-date-button']) ?>

            <?php ActiveForm::end(); ?> 
            
            <p class="small_gray_text" style="margin-top: 1rem; font-size: 0.9em; text-align: justify;">Ca să arate utilizatorului că nu avem o dată fixată pentru următorul concert <b>apasă „Data nu este stabilită” și apoi „Salvează Data”</b></p>
        </div>
        <div class="flex-div" style="align-self: flex-start;">
            <h3 class="page_title" style="min-height: 32px;">Creează un anunț</h3>

            <?php
                $form = ActiveForm::begin([
                    'id' => 'announcement-create-form',
                    'type' => ActiveForm::TYPE_FLOATING,
                    'action' => ['announcement/createannouncement'], // The action URL with the ID
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

</div>

<?= ListView::widget([
    'dataProvider' => $announcementList,
    'id' => 'announcements',
    'itemView' => '_announcement_edit',
    'viewParams' => [],
    'options' => [
        'tag' => 'div',
        'class' => 'list-wrapper row',
        'style' => 'display: flexbox; flex-direction: row; justify-content: center;'
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



<?php
$js = <<<JS
    document.getElementById('set-current-time').addEventListener('click', function() {
        let now = new Date();
        let formattedDate = now.getFullYear() + '-' + 
            ('0' + (now.getMonth() + 1)).slice(-2) + '-' + 
            ('0' + now.getDate()).slice(-2) + ' ' + 
            ('0' + now.getHours()).slice(-2) + ':' + 
            ('0' + now.getMinutes()).slice(-2);
        document.getElementById('concert-date').value = formattedDate;
    });
JS;
$this->registerJs($js);
?>