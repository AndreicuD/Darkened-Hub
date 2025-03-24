<?php

/** @var yii\web\View $this */
/** @var $concertModel common\models\Concert */
/** @var $currentConcertModel common\models\Concert */

use yii\bootstrap5\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\DateTimePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\models\Concert;
use yii\widgets\ListView;
use kartik\grid\GridView;
use yii\helpers\Url;

$this->registerJsFile('/js/clock.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('/js/popup.js', ['depends' => [\yii\web\JqueryAsset::class]]);

$this->title = Yii::t('app', 'Informații Concert');
?>
<div id="concert_time" style="display: none;"><?= $currentConcertModel->date ?? '' ?></div>
<div class="site-calendar">
    <h1 style="text-align: center;" class="page_title"><?= Html::encode($this->title) ?></h1>

    <div class="index-section">
        <div class="flex-div">
            <div id="create-concert">
                <?php
                    $form_create = ActiveForm::begin([
                        'id' => 'concert-create-date-form',
                        'type' => ActiveForm::TYPE_FLOATING,
                        'action' => ['concert/create'], // The action URL with the ID
                        'method' => 'post',
                    ]);
                ?>

                <?= $form_create->errorSummary($concertModel);?>

                <?= $form_create->field($concertModel, 'title')->label(Yii::t('app', 'Titlu')) ?>

                <?= $form_create->field($concertModel, 'description')->textarea(['rows' => 2, 'style' => 'min-height: 80px; overflow: auto;'])->label(Yii::t('app', 'Descrierea concertului')) ?>

                <?= $form_create->field($concertModel, 'date')->widget(DateTimePicker::class, [
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
                <br>

                <?= Html::button('Data nu este stabilită', ['class' => 'btn btn-danger', 'style' => 'min-width: 40%; margin-bottom: 1em;', 'id' => 'set-current-time']) ?>
                <br>
                <?= Html::submitButton('Creează concert', ['class' => 'btn btn-success', 'id' => 'set-date-button']) ?>

                <?php ActiveForm::end(); ?>

                <p class="small_gray_text" style="margin-top: 1rem; font-size: 0.9em; text-align: justify;"><?= Yii::t('app', 'Ca să arate utilizatorului că nu avem o dată fixată pentru următorul concert <b>apasă „Data nu este stabilită” și apoi „Creează concert”</b>.') ?></p>
            </div>
            <hr>
            <div class="flex-div" style="width: 100%;">
                <button role="button" onclick="openPopup('set_inactive_popup')" class="btn btn-danger"><?= Yii::t('app', 'Setează toate concertele la starea de inactiv.') ?></button>
            </div>
        </div>

    </div>
    <hr>
</div>

<div class="table_wrapper">
    <?php
    echo GridView::widget([
        'dataProvider' => $concerts,
        'layout' => '{toggleData}{export}{pager}{items}{pager}',
        'tableOptions' => [
            'class' => 'songs_table',
            'id' => 'songs_table',
        ],
        'resizableColumns' => false,
        'bordered' => false,
        'responsive' => false,
        'responsiveWrap' => false,
        'hover' => false,
        'striped' => false,
        'export' => [
            'label' => Yii::t("app", "Exportă datele"),
            'showConfirmAlert' => false,
            'fontAwesome' => true,
            'options' => ['class' => 'btn-primary'],
        ],
        'exportConfig' => [
            GridView::CSV => ['filename' => 'songs',],
            GridView::EXCEL => ['filename' => 'songs'],
            GridView::JSON => ['filename' => 'songs'],
        ],
        'headerRowOptions' => ['class' => 'table_head_row'],
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'title',
                'format' => 'raw',
                'label' => 'Titlu',
                'value' => $concertModel->title,
            ],
            ['attribute' => 'description', 'format' => 'text', 'label' => 'Descriere'],
            [
                'attribute' => 'date',
                'format' => 'datetime',
                'label' => 'Data Concertului',
                'value' => $concertModel->date,
            ],
            [
                'attribute' => 'status',
                'format' => 'text',
                'label' => 'Status',
                'value' => function ($concertModel) {
                    return $concertModel::statusesList()[$concertModel->status];
                }
            ],
            [
                'attribute' => '',
                'format' => 'raw',
                'label' => '',
                'value' => function ($concertModel) {
                    global $current_page;
                    return '<button onclick="location.href=' . "'" . 'edit?id=' . $concertModel->id . "'" . '" class="icon_btn">
                                <svg xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-adjustments"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 10a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M6 4v4" /><path d="M6 12v8" /><path d="M10 16a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M12 4v10" /><path d="M12 18v2" /><path d="M16 7a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M18 4v1" /><path d="M18 9v11" /></svg>
                            </button>';
                }
            ],
            [
                'attribute' => '',
                'format' => 'raw',
                'label' => '',
                'value' => function ($concertModel) {
                    return '<button onclick=' . "'" . 'openPopup("delete_concert_popup-' . $concertModel->id . '")' . "'" . ' class="icon_btn trash_btn">
                                <svg xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                            </button>';
                }
            ],
        ],
    ]);
    ?>
</div>

<!-- set inactive popup -->
<div id="set_inactive_popup">
    <div class="overlay_opaque" onclick="closePopup('set_inactive_popup')"></div>
    <div class="popup">
        <h1 class="page_title"><?= Yii::t('app', 'Asta va seta la statusul de inactiv TOATE concertele din listă.') ?></h1>
        <p style="text-align: center; line-height: 1.5rem; padding: 0;" class="lead"><?= Yii::t('app', 'Ești sigur că vrei să continui?') ?></p>
        <br>
        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <button onclick="closePopup('set_inactive_popup')" type="button" class="btn btn-secondary"><?= Yii::t('app', 'Nu') ?></button>
                </div>
                <div class="col">
                    <a href="<?= Url::toRoute(['concert/setinactive']); ?>" class="btn btn-danger"><?= Yii::t('app', 'Da') ?></a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= ListView::widget([
    'dataProvider' => $concerts,
    'itemView' => '_delete_concerts_popups',
    'viewParams' => [],
    'options' => [
        'tag' => 'div',
    ],
    'itemOptions' => [
        'tag' => 'div',
    ],
    'layout' => '{items}',
]); ?>

<?php
$js = <<<JS
    document.getElementById('set-current-time').addEventListener('click', function() {
        let now = new Date();
        let formattedDate = now.getFullYear() + '-' + 
            ('0' + (now.getMonth() + 1)).slice(-2) + '-' + 
            ('0' + now.getDate()).slice(-2) + ' ' + 
            ('0' + now.getHours()).slice(-2) + ':' + 
            ('0' + now.getMinutes()).slice(-2);
        document.getElementById('create-concert-date').value = formattedDate;
    });
JS;
$this->registerJs($js);
?>