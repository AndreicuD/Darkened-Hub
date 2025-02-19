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
        <div class="flex-div avatar-div">
            <!-- profile picture stuff -->
            <?php
                $uploadPath = Yii::getAlias('@frontend/web/img/user-icons/');
                $defaultAvatar = $uploadPath . 'default-user-icon.jpg';
                $userAvatar = $defaultAvatar;
                
                // Check for user avatar
                $extensions = ['png', 'jpg', 'jpeg', 'gif'];
                $good_extension;
                foreach ($extensions as $ext) {
                    $filePath = $uploadPath . Yii::$app->user->id . '.' . $ext;
                    if (file_exists($filePath)) {
                        $userAvatar = $filePath;
                        $good_extension = $ext;
                        break;
                    }
                }
                if($userAvatar == $defaultAvatar) {
                    $current_user = 'default-user-icon';
                    $good_extension = 'jpg';
                }
            ?>

            <!-- Prevent browser caching by appending ?t=timestamp -->
            <img src="<?= Yii::getAlias('@web/img/user-icons/') . Yii::$app->user->id . '.' . $good_extension . '?t=' . time(); ?>" class="img-thumbnail avatar">

            <?php $form = ActiveForm::begin([
                'id' => 'form-upload-avatar',
                'options' => ['enctype' => 'multipart/form-data'], 
                'action' => ['user/upload-avatar'], 
                'method' => 'post',
            ]); ?>

            <?= $form->field($uploadModel, 'avatar')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
                'pluginOptions' => [
                    'showCaption' => false,
                    'uploadClass' => 'btn btn-success',
                    'removeClass' => 'btn btn-danger',
                ],
            ]); ?>

            <?php ActiveForm::end(); ?>

        </div>  
    </div>
</div>
