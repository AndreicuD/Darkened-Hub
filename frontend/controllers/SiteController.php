<?php

namespace frontend\controllers;

use frontend\models\ContactForm;
use common\models\PublicProposal;
use common\models\Concert;
use common\models\Announcement;
use Yii;
use yii\web\Controller;

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
        $dataProvider = $model->searchLatest();

        $concert = new Concert();
        $concertModel = Concert::findOne(['id' => 1]);
        $concert_date = $concert->get_date(1);

        $announcement = new Announcement();
        $data_announcement = $announcement->searchLatest(3);

        $this->layout = "index_layout";
        return $this->render('index', [
            'model' => $model,
            'dataProvider' => $dataProvider,
            'concertModel' => $concertModel,
            'concert_date' => $concert_date,
            'data_announcement' => $data_announcement
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
     * @return mixed
     */
    public function actionConcerts()
    {
        $model = new PublicProposal();
        $dataProvider = $model->searchLatest();

        $concert = Concert::findOne(['id' => 1]);
        $concert_date = $concert->get_date(1);

        return $this->render('concerts', [
            'model' => $model,
            'dataProvider' => $dataProvider,
            'concertModel' => $concert,
            'concert_date' => $concert_date,
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Mulțumim că ne-ai contactat. O să-ți răspundem în cel mai scurt timp posibil.');
            } else {
                Yii::$app->session->setFlash('error', 'A apărut o eroare. Mesajul nu a fost transmis.');
            }

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }
}
