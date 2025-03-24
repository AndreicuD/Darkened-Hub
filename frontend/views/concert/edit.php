<?php
/** @var yii\web\View $this */

use yii\bootstrap5\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\DateTimePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\models\Concert;

$this->title = Yii::t('app', 'Update Concert');
?>
<div>
<h1 style="text-align: center;" class="page_title"><?= Html::encode($this->title) ?></h1>
    <?php $form_update = ActiveForm::begin(['id' => 'form-updateconcert'.$model->id, 'type' => ActiveForm::TYPE_FLOATING, 'action' => ['concert/update', 'id' => $model->id]]); ?>

    <?= $form_update->errorSummary($model);?>

    <?= $form_update->field($model, 'title')->label(Yii::t('app', 'Titlu')) ?>
    
    <?= $form_update->field($model, 'description')->textarea(['rows' => 2, 'style' => 'min-height: 80px; overflow: auto;'])->label(Yii::t('app', 'Descrierea concertului')) ?>
    
    <?= $form_update->field($model, 'date')->widget(DateTimePicker::class, [
        'name' => 'concert_datetimepicker',
        'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
        'options' => ['id' => 'create-concert-date', 'placeholder' => ''],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd hh:ii',
            'todayHighlight' => false,
            'todayBtn' => false,
        ],
    ])->label(false); ?>

    <?= $form_update->field($model, 'status')->dropDownList([
            Concert::STATUS_ACTIVE => $model::statusesList()[Concert::STATUS_ACTIVE],
            Concert::STATUS_INACTIVE => $model::statusesList()[Concert::STATUS_INACTIVE],
        ], [
            'id' => 'concert-status-dropdown',
            'class' => 'custom-class',
        ])->label(Yii::t('app', 'Status')); ?>
    
    <br>  
    <div class="container text-center">
        <div class="row">
            <div class="col">
            <?=Html::a('Anulează', Url::to(['concert/index']), ['class' => 'btn btn-danger']); ?>
            </div>
            <div class="col">
                <input type="submit" value="Salvează Modificări" class="btn btn-success">
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>