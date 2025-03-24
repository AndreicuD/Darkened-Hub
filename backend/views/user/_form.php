<?php

use common\models\User;
use yii\bootstrap5\Html;
use kartik\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\User $model */
/** @var kartik\widgets\ActiveForm $form */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin([
        'id' => 'form-user',
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 2, 'deviceSize' => ActiveForm::SIZE_SMALL]
    ]); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sex')->dropDownList([ 'F' => 'F', 'M' => 'M', ], ['prompt' => Yii::t('app', 'Choose a sex ...')]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'birth_date')->widget(\common\widgets\DatePicker::class, []) ?>

    <?= $form->field($model, 'status')->dropDownList(User::statusesList(), ['prompt' => Yii::t('app', 'Choose a status ...')]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true])->hint(Yii::t('app', 'Leave empty to not change the current password')) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
