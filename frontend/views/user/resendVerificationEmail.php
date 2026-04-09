<?php

/** @var yii\web\View$this  */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\ResetPasswordForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Retrimite email de verificare';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-resend-verification-email">
    <h1 class="text-center page_title"><?= Html::encode($this->title) ?></h1>

    <p class="text-center"><?= Yii::t('app', 'Te rog să introduci adresă de email. Un mail de verificare va fi trimis.') ?></p>

    <div class="row justify-content-center">
        <div class="col-lg-6">
            <?php $form = ActiveForm::begin(['id' => 'resend-verification-email-form', 'layout' => 'floating']); ?>

            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
