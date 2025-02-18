<?php

/** @var yii\web\View $this */

use yii\bootstrap5\Html;
use yii\widgets\ListView;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\grid\GridView;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\widgets\DateTimePicker;
use common\models\Concert;

$this->title = 'Statistici';

// Pass PHP data to JavaScript
$songDataAll = [
    $state5count_all,
    $state1count_all,
    $state2count_all,
    $state3count_all,
    $state4count_all,
];

$songDataConcert = [
    $state5count_concert,
    $state1count_concert,
    $state2count_concert,
    $state3count_concert,
    $state4count_concert,
];

$states = [$songModel->stateList()[5], $songModel->stateList()[1], $songModel->stateList()[2], $songModel->stateList()[3], $songModel->stateList()[4]];

?>
<div class="site-index">
    <h1 style="text-align: center;" class="page_title"><?= Html::encode($this->title) ?></h1>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div class="index-section double-index-section">
        <div class="flex-div" style="align-self: flex-start;">
            <h2 class="page_title">Melodiile din Concert</h2>
            <!-- Chart Container -->
            <canvas id="concert_songChart" style="width: 80%; margin: auto; max-height: 400px;"></canvas>

            <script>
            document.addEventListener("DOMContentLoaded", function() {
                const ctx = document.getElementById('concert_songChart').getContext('2d');

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: <?= json_encode($states) ?>, // State labels
                        datasets: [
                            /*{
                                label: 'Total Songs',
                                data: <?= json_encode($songDataAll) ?>,
                                backgroundColor: 'rgba(54, 162, 235, 0.6)', // Blue
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            },*/
                            {
                                label: 'Melodii în concert',
                                data: <?= json_encode($songDataConcert) ?>,
                                backgroundColor: 'rgba(255, 99, 132, 0.6)', // Red
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1,
                                }
                            }
                        }
                    }
                });
            });
            </script>

            <?php if (!empty($userSongCounts_all)): ?>
                <div class="podium">
                    <!--<h2 class="page_title">Podium</h2>-->
                    <?php
                        $topUsers = array_slice($userSongCounts_all, 0, 3);
                        [$topUsers[0], $topUsers[1]] = [$topUsers[1], $topUsers[0]];
                    ?>
                    <div class="podium-container">
                        <?php foreach ($topUsers as $index => $user): ?>
                            <div class="podium-place podium-<?= $index + 1 ?>">
                                <p style="margin-bottom: 0;"><?= Html::encode($user['name']) ?></p>
                                <p><?= $user['count'] ?> melodii</p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php else: ?>
                <p>Nu există date pentru a crea podiumul.</p>
            <?php endif; ?>
        </div>
        <div class="flex-div" style="align-self: flex-start;">
            <h2 class="page_title">Toate Melodiile</h2>
            <!-- Chart Container -->
            <canvas id="all_songChart" style="width: 80%; margin: auto; max-height: 400px;"></canvas>

            <script>
            document.addEventListener("DOMContentLoaded", function() {
                const ctx = document.getElementById('all_songChart').getContext('2d');

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: <?= json_encode($states) ?>, // State labels
                        datasets: [
                            {
                                label: 'Toate melodiile',
                                data: <?= json_encode($songDataAll) ?>,
                                backgroundColor: 'rgba(54, 162, 235, 0.6)', // Blue
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            },
                            /*{
                                label: 'Songs in Concert',
                                data: <?= json_encode($songDataConcert) ?>,
                                backgroundColor: 'rgba(255, 99, 132, 0.6)', // Red
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1
                            }*/
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1,
                                }
                            }
                        }
                    }
                });
            });
            </script>

            <?php if (!empty($userSongCounts_all)): ?>
                <div class="podium">
                    <!--<h2 class="page_title">Podium</h2>-->
                    <?php 
                        $topUsers = array_slice($userSongCounts_all, 0, 3);
                        [$topUsers[0], $topUsers[1]] = [$topUsers[1], $topUsers[0]];
                    ?>
                    <div class="podium-container">
                        <?php foreach ($topUsers as $index => $user): ?>
                            <div class="podium-place podium-<?= $index + 1 ?>">
                                <p style="margin-bottom: 0;"><?= Html::encode($user['name']) ?></p>
                                <p><?= $user['count'] ?> melodii</p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php else: ?>
                <p>Nu există date pentru a crea podiumul.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
