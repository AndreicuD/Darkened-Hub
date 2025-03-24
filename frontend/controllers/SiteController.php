<?php

namespace frontend\controllers;

use frontend\models\ContactForm;
use common\models\PublicProposal;
use common\models\Concert;
use common\models\Announcement;
use Yii;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new PublicProposal();
        $proposals = $model->searchLatest();

        $concert = Concert::findOne(['status' => Concert::STATUS_ACTIVE]);

        $announcement = new Announcement();
        $data_announcement = $announcement->searchLatest(3);

        return $this->render('index', [
            'model' => $model,
            'proposals' => $proposals,
            'data_announcement' => $data_announcement,
            'concert' => $concert,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Displays concerts page.
     *
     * @return string
     */
    public function actionConcerts()
    {
        $model = new PublicProposal();
        $dataProvider = $model->searchLatest();

        $concert = Concert::findOne(['status' => Concert::STATUS_ACTIVE]);
        $next_ones = (new Concert())->search([]);
        $next_ones->query
            ->andWhere('date > :date', [':date' => $concert->date])
            ->limit(3)
            ->orderBy(['date'=> SORT_ASC]);
        $public_prop = new PublicProposal();
        $last_one = (new Concert())->find()
            ->where('date < :date', [':date' => $concert->date])
            ->orderBy(['date'=> SORT_DESC])
            ->one();
        $public_prop = new PublicProposal();

        return $this->render('concerts', [
            'model' => $model,
            'dataProvider' => $dataProvider,
            'concert' => $concert,
            'next_concerts' => $next_ones,
            'last_concert' => $last_one,
            'proposals' => $public_prop->searchLatest(),
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return string|Response
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Mulțumim că ne-ai contactat. O să-ți răspundem în cel mai scurt timp posibil.'));
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'A apărut o eroare. Mesajul nu a fost transmis.'));
            }

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }
}
