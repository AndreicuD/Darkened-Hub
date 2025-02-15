<?php

namespace frontend\controllers;

use frontend\models\ContactForm;
use common\models\Concert;
use Yii;
use yii\web\Controller;

/**
 * Concert controller
 */
class ConcertController extends Controller
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
    public function actionUpdateconcertdate($id)
    {
        $model = Concert::findOne(['id' => $id]);
        //$model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Data concertului a fost modificata.');
            $this->redirect(['calendar/index']);
        } else {
            Yii::$app->session->setFlash('error', 'A aparut o eroare in salvarea datei concertului.');
        }

        return $this->redirect(['calendar/index']);
    }
}
