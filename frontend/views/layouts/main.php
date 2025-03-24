<?php

/** @var View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\web\View;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100" data-bs-theme="dark">
<?php $this->beginBody() ?>

<div class="background" id="background"></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.fog.min.js"></script>
<script>
VANTA.FOG({
  el: "#background",
  mouseControls: true,
  touchControls: true,
  gyroControls: false,
  minHeight: 200.00,
  minWidth: 200.00,
  highlightColor: 0x0,
  midtoneColor: 0x3b205e,
  lowlightColor: 0x000000,
  baseColor: 0x0,
  blurFactor: 0.61,
  speed: 0.00,
  zoom: 0.80
})
</script>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandImage' => '/img/logo-white.png',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar '.(Yii::$app->requestedRoute == 'site/index' ? 'navbar-index ' : '').'navbar-expand-md navbar-dark',
			'id' => 'navbar',
        ],
    ]);
    if (Yii::$app->user->isGuest) {
        $menuItems = [
            ['label' => Yii::t('app', 'Home'), 'url' => ['/site/index']],
            ['label' => Yii::t('app', 'Concerts'), 'url' => ['/site/concerts']],
            ['label' => Yii::t('app', 'Despre noi'), 'url' => ['/site/about']],
            ['label' => Yii::t('app', 'Contactează-ne'), 'url' => ['/site/contact']],
        ];
    } else {
        $menuItems = [
            ['label' => Yii::t('app', 'Home'), 'url' => ['/site/index']],
            ['label' => Yii::t('app', 'Propuneri Publice'), 'url' => ['/publicproposal/proposals']],
            ['label' => Yii::t('app', 'Propuneri'), 'url' => ['/proposal/proposals']],
            ['label' => Yii::t('app', 'Anunțuri'), 'url' => ['/announcement/index']],
            ['label' => Yii::t('app', 'Informații concerte'), 'url' => ['/concert/index']],
            ['label' => Yii::t('app', 'Statistici'), 'url' => ['/song/stats']],
            ['label' => Yii::t('app', 'Concert'), 'url' => ['/song/concert']],
            ['label' => Yii::t('app', 'Melodii'), 'url' => ['/song/index']],
        ];
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ms-auto mb-2 mb-md-0'],
        'items' => $menuItems,
    ]);
    if (Yii::$app->user->isGuest) { ?>
        <div class="d-flex login_logoutbutton">
            <?= Html::a(Yii::t('app', 'Autentificare'), ['/user/login'], ['class' => ['btn btn-link login text-decoration-none']]) ?>
        </div>
    <?php } else { ?>
        <div class="btn-group">
            <a class="btn btn-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                <?= Yii::$app->user->identity->username; ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg-end">
                <li><a class="dropdown-item" href="/user/settings"><?= Yii::t('app', 'Setări'); ?></a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item logout text-decoration-none" href="/user/logout"><?= Yii::t('app', 'Logout'); ?></a></li>
            </ul>
        </div>
    <?php } ?>
    <?php NavBar::end(); ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="<?= Yii::$app->requestedRoute == 'site/index' ? '' : 'container' ?>">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer footer-dark mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-start">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
        <p class="footer-love"><?= Yii::t('app', 'Realizat de Huțanu Andrei 💜🤘') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
