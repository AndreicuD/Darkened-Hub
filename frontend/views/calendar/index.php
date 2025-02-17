<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\widgets\ListView;
use kartik\widgets\DateTimePicker;

$this->registerJsFile('/js/clock.js', ['depends' => [\yii\web\JqueryAsset::class]]);

$this->title = Yii::t('app', 'Calendar');
//$this->params['breadcrumbs'][] = $this->title;
?>
<div id="concert_time" style="display: none;"><?= $concert_date ?></div>
<div class="site-calendar">
    <h1 style="text-align: center;" class="page_title"><?= Html::encode($this->title) ?></h1>
    
    <div class="inline-form_items concert_date_form" style="align-items: center;">
    <?php
        $form_date = ActiveForm::begin([
            'id' => 'concert-date-form',
            'action' => ['concert/updateconcertdate', 'id' => 1], // The action URL with the ID
            'method' => 'post',
            'type' => ActiveForm::TYPE_INLINE,
        ]);
    ?>

        <label style="text-align: center;">Seteaza Data Concertului</label>
        <?= $form_date->field($concertModel, 'date')->widget(DateTimePicker::class, [
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

        <?= Html::submitButton('Salveaza Data', ['class' => 'btn btn-success', 'id' => 'set-date-button']) ?>
    <?php ActiveForm::end(); ?>
    </div>

    <p class="small_gray_text" style="font-size: 0.9em; text-align: center;">Ca sa arate utilizatorului ca nu avem o data fixata pentru urmatorul concert <b>seteaza data la orice zi care a trecut deja.</b></p>

    <hr>

</div>
