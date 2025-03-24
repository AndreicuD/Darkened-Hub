<?php

use common\models\Announcement;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $widget yii\widgets\ListView this widget instance */
/* @var $key mixed the key value associated with the data item */
/* @var $index integer the zero-based index of the data item in the items array returned by the data provider */
?>
<div class="announcement noto-sans-500">
    <p class="announcement-title" style="text-align: center; margin: 0; border-radius: 10px;">
        <?php 
            echo Html::encode($model->date);
            if($model->title) {
                echo ' - ' . $model->title;
            }
        ?>
    </p>
    <div class="announcement-body">
        <?php 
            if($model->description) {
                echo '<hr style="padding: 0; margin: 0;">';
                echo '<p class="announcement-text" style="text-align: center;">';
                echo $model->description;
                echo '</p>';
            }
        ?>
    </div>
</div>