<?php

/** @var yii\web\View $this */
/** @var common\models\PublicProposal $model */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var common\models\Concert $concert */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\widgets\ListView;
use yii\helpers\Url;

$this->registerJsFile('/js/clock.js', ['depends' => [\yii\web\JqueryAsset::class]]);

$this->title = Yii::t('app', 'Concerts');
//$this->params['breadcrumbs'][] = $this->title;
?>
<div id="concert_time" style="display: none;"><?= $concert->date ?? '' ?></div>
<div class="site-concerts">
    <!--<h1 style="text-align: center;" class="page_title"><?= Html::encode($this->title) ?></h1>-->

    <h1 style="padding:0; margin: 0;" class="page_title"><?= Yii::t('app', 'URMĂTORUL CONCERT 🤘'); ?></h1>
    <div id="concert_time" style="display: none;"><?= $concert->date ?? '' ?></div>
    <div class="page_title">
        <div id="concert_time" style="display: none;"><?= $concert->date ?? '' ?></div>
        <?php 
            $format = "Y-m-d h:i:s";
            $date1 = '0';
            $date2 = 'ceva';
            if($concert) {
                $date1  = \DateTime::createFromFormat($format, $concert->date);
                $date2  = \DateTime::createFromFormat($format, date('Y-m-d h:i:s', time()));
            }
            //var_dump($concert->date);
            //var_dump($date1);
            //var_dump($date2);
            //var_dump($date1 > $date2);
        ?>
        <?php if($concert && ($concert->title || $concert->description)) { ?>
            <div class="index-section" style="min-height: fit-content; padding: 1em 0 0 0;">
                <div class="flex-div" style="min-height: fit-content;">
                    <h2 style="text-align: center; padding-top: 1em; font-weight: bold; font-size: 3em;"><?= $concert->title ?? ''; ?></h2>
                </div>
                <div class="flex-div">
                    <p style="margin-bottom: 0; font-weight: bold;" class="noto-sans-500"><?= $concert->description ?? ''; ?></p>
                    <h2 style="text-align: center;">|</h2>
                </div>
            </div>
        <?php } ?>
        <p class="clock_text" id="clock">00d 00h 00m 00s</p>
        <h2 class="date_text" id="date"><?= Yii::t('app', 'DATE'); ?></h2>
    </div>

    <hr class="settings_bar_hr">

    <div class="about-wrapper">
        <div class="about-text about-padding">
            <h3 class="page_title"><?= Yii::t('app', 'Trimite o propunere:') ?></h3>
            <?php $form = ActiveForm::begin([
                    'id' => 'form-addpublicproposal',
                    'layout' => 'floating',
                    'action' => ['publicproposal/createproposal'],
                    'method' => 'post',
                ]); ?>

                <?= $form->errorSummary($model);?>

                <div class="group_together">
                    <?= $form->field($model, 'title')->label(Yii::t('app', 'Titlu')) ?>
                    <?= $form->field($model, 'artist')->label(Yii::t('app', 'Artist')) ?>
                </div>
                <?= $form->field($model, 'info')->textarea(['rows' => 2, 'style' => 'min-height: 80px; overflow: auto;'])->label(Yii::t('app', 'Vrei să ne dai mai multe informații?')) ?>

                <br>
                <div style="width: 100%; text-align: center;">
                    <input type="submit" value="<?= Yii::t('app', 'Save') ?>" class="btn btn-primary">
                </div>
            <?php ActiveForm::end(); ?>
        </div>
        <div class="about-text about-padding">
            <h3 class="page_title"><?= Yii::t('app', 'Ultimele propuse:') ?></h3>
            <div class="proposal_table_wrapper">
                <table class="proposal_table public_proposal_table">
                    <thead>
                        <tr>
                            <th scope="col"><?= Yii::t('app', 'Titlu') ?></th>
                            <th scope="col"><?= Yii::t('app', 'Artist') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= ListView::widget([
                            'dataProvider' => $proposals,
                            'itemView' => '_proposal_item',
                            'viewParams' => [],
                            'options' => [
                                'class' => 'song_in_table',
                            ],
                            'itemOptions' => [
                                'tag' => 'tr',
                                'class' => 'song_in_table',
                            ],
                            'layout' => '{items}{pager}',
                            'pager' => [
                                'pageCssClass' => 'page-item',
                                'prevPageCssClass' => 'prev page-item',
                                'nextPageCssClass' => 'next page-item',
                                'firstPageCssClass' => 'first page-item',
                                'lastPageCssClass' => 'last page-item',
                                'linkOptions' => ['class' => 'page-link'],
                                'disabledListItemSubTagOptions' => ['class' => 'page-link'],
                                'options' => ['class' => 'pagination justify-content-center'],
                            ],
                        ]); ?>                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="index-section double-index-section" style="padding-left: 0; padding-right: 0;">
        <div class="flex-div" style="width: 100%; padding-left: 0; align-self: flex-start;">
            <h3 class="page_title"><?= Yii::t('app', 'Concertul Trecut') ?></h3>
            <div class="announcement noto-sans-500">
                <p class="announcement-title" style="text-align: center; margin: 0; border-radius: 10px;">
                    <?php 
                        echo Html::encode($last_concert->date);
                        if($last_concert->title) {
                            echo ' - ' . $last_concert->title;
                        }
                    ?>
                </p>
                <div class="announcement-body">
                    <?php 
                        if($last_concert->description) {
                            echo '<hr style="padding: 0; margin: 0;">';
                            echo '<p class="announcement-text" style="text-align: center;">';
                            echo $last_concert->description;
                            echo '</p>';
                        }
                    ?>
                </div>
            </div>
            <a href="<?= Url::toRoute(['site/contact']); ?>" class="btn btn-primary"><?= Yii::t('app', 'Ai feedback? Scrie-ne aici.') ?></a>
        </div>
        <div class="flex-div" style="width: 100%; padding-right: 0; align-self: flex-start;">
            <h3 class="page_title"><?= Yii::t('app', 'Concertele Viitoare') ?></h3>
            <?= ListView::widget([
                'dataProvider' => $next_concerts,
                'itemView' => '_concert_item',
                'viewParams' => [],
                'options' => [
                    'tag' => 'div',
                    'class' => 'list-wrapper row concert_item',
                    'style' => 'display: flexbox; flex-direction: row; justify-content: center;'
                ],
                'itemOptions' => [
                    'tag' => 'div',
                ],
                'layout' => '{items}{pager}',
                'pager' => [
                    'pageCssClass' => 'page-item',
                    'prevPageCssClass' => 'prev page-item',
                    'nextPageCssClass' => 'next page-item',
                    'firstPageCssClass' => 'first page-item',
                    'lastPageCssClass' => 'last page-item',
                    'linkOptions' => ['class' => 'page-link'],
                    'disabledListItemSubTagOptions' => ['class' => 'page-link'],
                    'options' => ['class' => 'pagination justify-content-center'],
                ],
            ]); ?>
        </div>
    </div>
</div>

