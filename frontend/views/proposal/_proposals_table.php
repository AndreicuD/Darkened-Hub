<?php

/** @var yii\web\View $this */

use yii\bootstrap5\Html;
use yii\widgets\ListView;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\grid\GridView;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

$this->registerJsFile('/js/popup.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>

<div class="table_wrapper">       
    <?php
        echo GridView::widget([
            'dataProvider' => $dataProvider,
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
            'export' => [
                'label' => Yii::t("app", "Exportă datele"),
                'showConfirmAlert' => false,
                'fontAwesome' => true,
                'options' => ['class' => 'btn-primary'],
            ],
            'exportConfig' => [
                GridView::CSV => ['filename' => 'proposals',],
                GridView::EXCEL => ['filename' => 'proposals'],
                GridView::JSON => ['filename' => 'proposals'],
            ],
            'headerRowOptions' => ['class' => 'table_head_row'],
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'title', 
                    'format' => 'raw', 
                    'label' => 'Titlu',
                    'value' => function ($searchModel) {
                        return $searchModel->title;
                    },
                ],
                [
                    'attribute' => 'artist', 
                    'format' => 'text', 
                    'label' => 'Artist'
                ],
                [
                    'attribute' => 'username', 
                    'format' => 'text', 
                    'label' => 'Username',
                ],
                [
                    'attribute' => 'info', 
                    'format' => 'text', 
                    'label' => 'Info',
                ],
                [
                    'attribute' => '', 
                    'format' => 'raw', 
                    'label' => '',
                    'value' => function ($searchModel) {
                        return '<button onclick="location.href=' . "'" . 'sendtosetlist?id=' . $searchModel->id .  "'" . '"' . ' class="icon_btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-brand-telegram">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M15 10l-4 4l6 6l4 -16l-18 7l4 2l2 6l3 -4" />
                                    </svg>    
                                </button>';
                    }
                ],
                [
                    'attribute' => '', 
                    'format' => 'raw', 
                    'label' => '',
                    'value' => function ($searchModel) {
                        global $current_page;
                        return '<button onclick=' . "'" . 'openPopup("update_proposal_popup-' . $searchModel->id . '")' . "'" . '"' . ' class="icon_btn">
                                    <svg xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-adjustments"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 10a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M6 4v4" /><path d="M6 12v8" /><path d="M10 16a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M12 4v10" /><path d="M12 18v2" /><path d="M16 7a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M18 4v1" /><path d="M18 9v11" /></svg>
                                </button>';
                    }
                ],
                [
                    'attribute' => '', 
                    'format' => 'raw', 
                    'label' => '',
                    'value' => function ($searchModel) {
                        global $current_page;
                        return '<button onclick=' . "'" . 'openPopup("delete_proposal_popup-' . $searchModel->id . '")' . "'" . ' class="icon_btn trash_btn">
                                    <svg xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                </button>';
                    }
                ],
            ],
        ]);
    ?>
</div>

<!-- add proposal popup -->
<div id="addproposal_popup">
    <div class="overlay_opaque" onclick="closePopup('addproposal_popup')"></div>
    <div class="popup">
        <h1 class="page_title"><?= Yii::t('app', 'Adaugă Propunere') ?></h1>
        <?php $form = ActiveForm::begin([
                'id' => 'form-addpublicproposal',
                'type' => ActiveForm::TYPE_FLOATING,
                'action' => ['proposal/createproposal'], // Specify the route to the create action
                'method' => 'post',
            ]); ?>
    
            <?= $form->errorSummary($searchModel);?>
            
            <div class="group_together">
                <?= $form->field($searchModel, 'title')->label(Yii::t('app', 'Titlu')) ?>
                <?= $form->field($searchModel, 'artist')->label(Yii::t('app', 'Artist')) ?>
            </div>
            <?= $form->field($searchModel, 'info')->textarea(['rows' => 2, 'style' => 'min-height: 80px']) ?>
            
            <br>
            
            <div class="container text-center">
                <div class="row">
                    <div class="col">
                        <button onclick="closePopup('addproposal_popup')" type="button" class="btn btn-danger"><?= Yii::t('app', 'Închide') ?></button>
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

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_proposals_popups',
    'viewParams' => ['songModel' => $songModel, 'user' => $user,],
    'options' => [
        'tag' => 'div',
    ],
    'itemOptions' => [
        'tag' => 'div',
    ],
    'layout' => '{items}',
]); ?>