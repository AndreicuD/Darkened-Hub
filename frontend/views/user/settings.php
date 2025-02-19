<?php

/** @var yii\web\View $this */

use yii\bootstrap5\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\FileInput;

$this->title = 'Setări';
?>

<div class="site-index">
    <h1 style="text-align: center;" class="page_title"><?= Html::encode($this->title) ?></h1>

    <div class="index-section double-index-section">
        <div class="flex-div">
            <?php $form = ActiveForm::begin([
                'id' => 'form-change-info',
                'type' => ActiveForm::TYPE_FLOATING,
                'action' => ['user/settings'], // Specify the route to the create action
                'method' => 'post',
            ]); ?>
    
            <?= $form->errorSummary($userModel);?>
            
            <?= $form->field($userModel, 'username')->label(Yii::t('app', 'Username')) ?>
            <?= $form->field($userModel, 'email')->label(Yii::t('app', 'Email')) ?>
    
            <div class="row">
                <div class="col">
                    <input type="reset" value="Resetează" class="btn btn-warning">
                </div>
                <div class="col">
                    <input type="submit" value="Salvează" class="btn btn-success">
                </div>
            </div>
            <?php ActiveForm::end(); ?>

            
            <hr>
            <p class="small_gray_text">Schimbă Parola</p>
            <!-- CHANGE PASSWORD FORM -->
            <?php $passwordForm = ActiveForm::begin([
                'id' => 'form-change-password',
                'type' => ActiveForm::TYPE_FLOATING,
                'action' => ['user/change-password'], 
                'method' => 'post',
            ]); ?>

            <?= $passwordForm->errorSummary($changePasswordModel); ?>

            <?= $passwordForm->field($changePasswordModel, 'current_password')->passwordInput()->label('Parola Curentă') ?>
            <?= $passwordForm->field($changePasswordModel, 'new_password')->passwordInput()->label('Parola Nouă') ?>
            <?= $passwordForm->field($changePasswordModel, 'confirm_password')->passwordInput()->label('Confirmă Parola Nouă') ?>
            <p class="small_gray_text">Ți-ai uitat parola curentă? Schimb-o <?=Html::a('aici', Url::to(['user/request-password-reset'])); ?></p>

            <input type="submit" value="Schimbă Parola" class="btn btn-success">
            <?php ActiveForm::end(); ?>
        </div>

    </div>
</div>
