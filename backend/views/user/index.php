<?php

use common\models\User;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use common\widgets\ActionColumn;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var common\models\User $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;

$svg_plus = '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>';
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a($svg_plus.Yii::t('app', 'User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'itemLabelSingle' => Yii::t('app', 'User'),
        'condensed' => true,
        'hover' => true,
        'columns' => [
            'id',
            'username',
            'email',
            'firstname',
            'lastname',
            'sex',
            'phone',
            [
                'attribute' => 'status',
                'filter' => $searchModel::statusesList(),
                'value' => function($data) use ($searchModel) {
                    return $searchModel->statusesList()[$data->status];
                }
            ],
            'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::class,
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
