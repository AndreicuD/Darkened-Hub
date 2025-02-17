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

    public function actionUpdateconcertdate($id)
    {
        $model = Concert::findOne(['id' => $id]);
        //$model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Data concertului a fost modificată.');
            $this->redirect(['announcement/index']);
        } else {
            Yii::$app->session->setFlash('error', 'A apărut o eroare în salvarea datei concertului.');
        }

        return $this->redirect(['announcement/index']);
    }
    public function actionUpdateconcertinfo($id)
    {
        $model = Concert::findOne(['id' => $id]);
        //$model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Informațiile concertului au fost modificate.');
            $this->redirect(['announcement/index']);
        } else {
            Yii::$app->session->setFlash('error', 'A apărut o eroare în salvarea informațiilor concertului.');
        }

        return $this->redirect(['announcement/index']);
    }
}
