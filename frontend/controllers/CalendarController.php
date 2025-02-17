<?php

namespace frontend\controllers;

use frontend\models\ContactForm;
use common\models\Concert;
use Yii;
use yii\web\Controller;

/**
 * Calendar controller
 */
class CalendarController extends Controller
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
        $concert = new Concert();
        $concert_date = $concert->get_date(1);
        
        return $this->render('index', [
            'concertModel' => $concert,
            'concert_date' => $concert_date,
        ]);
    }
}
