<?php
use yii\bootstrap5\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
?>
<!-- erase song popup -->
<div id="delete_song_popup-<?=$model->id?>">
    <div class="overlay_opaque" onclick="closePopup('delete_song_popup-<?=$model->id?>')"></div>
    <div class="popup">
        <h1 class="page_title"><?= Yii::t('app', 'Asta va sterge melodia: ') ?><strong><?= Html::encode($model->title) ?></strong></h1>
        <p style="text-align: center; line-height: 1.5rem; padding: 0;" class="lead"><?= Yii::t('app', 'Esti sigur ca vrei sa continui?') ?></p>
        <br>
        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <button onclick="closePopup('delete_song_popup-<?=$model->id?>')" type="button" class="btn btn-secondary"><?= Yii::t('app', 'Nu') ?></button>
                </div>
                <div class="col">
                    <a href="<?= Url::toRoute(['song/delete', 'id' => $model->id]); ?>" class="btn btn-danger"><?= Yii::t('app', 'Da') ?></a>
                </div>
            </div>
        </div>
    </div>
</div>