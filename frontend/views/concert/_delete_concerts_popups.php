<?php
use yii\bootstrap5\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
?>
<!-- erase concert popup -->
<div id="delete_concert_popup-<?=$model->id?>">
    <div class="overlay_opaque" onclick="closePopup('delete_concert_popup-<?=$model->id?>')"></div>
    <div class="popup">
        <h1 class="page_title"><?= Yii::t('app', 'Asta va șterge concertul de pe data: ') ?><strong><?= Html::encode($model->date) ?></strong></h1>
        <p style="text-align: center; line-height: 1.5rem; padding: 0;" class="lead"><?= Yii::t('app', 'Ești sigur că vrei să continui?') ?></p>
        <br>
        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <button onclick="closePopup('delete_concert_popup-<?=$model->id?>')" type="button" class="btn btn-secondary"><?= Yii::t('app', 'Nu') ?></button>
                </div>
                <div class="col">
                    <a href="<?= Url::toRoute(['concert/delete', 'id' => $model->id]); ?>" class="btn btn-danger"><?= Yii::t('app', 'Da') ?></a>
                </div>
            </div>
        </div>
    </div>
</div>