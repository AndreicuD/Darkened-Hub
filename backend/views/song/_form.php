<?php

use yii\bootstrap5\Html;
use kartik\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Song $model */
/** @var kartik\widgets\ActiveForm $form */
?>

<div class="song-form">

    <?php $form = ActiveForm::begin([
        'id' => 'form-song',
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 2, 'deviceSize' => ActiveForm::SIZE_SMALL]
    ]); ?>

    <?= $form->field($model, 'is_in_concert')->textInput() ?>

    <?= $form->field($model, 'setlist_spot')->textInput() ?>

    <?= $form->field($model, 'state')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'artist')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'first_guitar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'second_guitar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bass')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'drums')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'piano')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'first_voice')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'second_voice')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
