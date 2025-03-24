<?php

use yii\bootstrap5\Html;
use kartik\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Proposal $model */
/** @var kartik\widgets\ActiveForm $form */
?>

<div class="proposal-form">

    <?php $form = ActiveForm::begin([
        'id' => 'form-proposal',
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 2, 'deviceSize' => ActiveForm::SIZE_SMALL]
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'artist')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'info')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
