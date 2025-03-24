<?php

use common\models\Announcement;
use kartik\widgets\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $widget yii\widgets\ListView this widget instance */
/* @var $key mixed the key value associated with the data item */
/* @var $index integer the zero-based index of the data item in the items array returned by the data provider */
/* @var $model common\models\Announcement */

$svg_adjustments = '<svg xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-adjustments"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 10a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M6 4v4" /><path d="M6 12v8" /><path d="M10 16a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M12 4v10" /><path d="M12 18v2" /><path d="M16 7a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M18 4v1" /><path d="M18 9v11" /></svg>';
$svg_trash = '<svg xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>';
?>
<div class="announcement noto-sans-500">
    <div class="announcement-title-edit">
        <p style="margin: 0;"><b><?= Html::encode($model->title) ?></b></p>

        <button onclick='openPopup("update_announcement_popup-<?= $model->id ?>")'  class="icon_btn">
            <?= $svg_adjustments; ?>
        </button>
        <button onclick='openPopup("delete_announcement_popup-<?=$model->id?>")'  class="icon_btn trash_btn">
            <?= $svg_trash; ?>
        </button>
    </div>

    <hr class="announcement-hr">
    <div class="announcement-body">
        <p class="announcement-text "><?= $model->description ?></p>
        <p class="announcement-date"><?= Html::encode($model->created_at) ?></p>
    </div>
</div>

<!-- erase announcement popup -->
<div id="delete_announcement_popup-<?=$model->id?>">
    <div class="overlay_opaque" onclick="closePopup('delete_announcement_popup-<?=$model->id?>')"></div>
    <div class="popup">
        <h1 class="page_title"><?= Yii::t('app', 'Asta va șterge anunțul cu titlul: ') ?><strong><?= Html::encode($model->title) ?></strong></h1>
        <p style="text-align: center; line-height: 1.5rem; padding: 0;" class="lead"><?= Yii::t('app', 'Ești sigur că vrei să continui?') ?></p>
        <br>
        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <button onclick="closePopup('delete_announcement_popup-<?=$model->id?>')" type="button" class="btn btn-secondary"><?= Yii::t('app', 'Nu') ?></button>
                </div>
                <div class="col">
                    <a href="<?= Url::toRoute(['announcement/delete', 'id' => $model->id]); ?>" class="btn btn-danger"><?= Yii::t('app', 'Da') ?></a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- update announcement popup -->
<div id="update_announcement_popup-<?= $model->id ?>">
    <div class="overlay_opaque" onclick="closePopup('update_announcement_popup-<?= $model->id ?>')"></div>
    <div class="popup">
        <h1 class="page_title"><?= Yii::t('app', 'Modifică Anunț') ?></h1>
        <?php $form = ActiveForm::begin([
                'id' => 'form-addpublicproposal',
                'type' => ActiveForm::TYPE_FLOATING,
                'action' => ['announcement/update', 'id' => $model->id],
                'method' => 'post',
        ]); ?>

        <?= $form->errorSummary($model);?>

        <?= $form->field($model, 'title')->label(Yii::t('app', 'Titlu')) ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 4, 'style' => 'min-height: 160px; overflow: auto;'])->label(Yii::t('app', 'Informații')) ?>
        <br>

        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <button onclick="closePopup('update_announcement_popup-<?= $model->id ?>')" type="button" class="btn btn-danger"><?= Yii::t('app', 'Închide') ?></button>
                </div>
                <div class="col">
                    <input type="reset" value="Resetează" class="btn btn-warning">
                </div>
                <div class="col">
                    <input type="submit" value="Salvează" class="btn btn-success">
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
