<?php

namespace frontend\controllers;

use frontend\models\ContactForm;
use common\models\Concert;
use Yii;
use yii\web\Controller;
use yii\web\Response;

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
     * Displays index page for announcements.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $concert = new Concert();
        $current_concert = Concert::findOne([
            'status' => Concert::STATUS_ACTIVE,
        ]);
        $concert_date = $current_concert->date ?? null;

        $concerts = $concert->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'concertModel' => $concert,
            'currentConcertModel' => $current_concert,

            'concert' => $current_concert,
            'concerts' => $concerts,
        ]);
    }
    
    /**
     * Create new concert
     * @param integer $id
     * @return Response
     */
    public function actionCreate()
    {
        $model = new Concert;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Noul concert a fost creat cu succes.'));
            $this->redirect(['concert/index']);
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'A apărut o eroare în crearea concertului.'));
        }

        return $this->redirect(['concert/index']);
    }

    /**
     * Open the edit page for the concert
     * @param integer $id
     * @return Response
     */
    public function actionEdit($id): string {
        $searchModel = Concert::findOne(['id' => $id]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageParam = 'p';
        $dataProvider->pagination->forcePageParam = 0;
        $dataProvider->pagination->defaultPageSize = 12;

        return $this->render('edit', [
            'model' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Update the info for the concert
     * @param integer $id
     * @return Response
     */
    public function actionUpdate($id)
    {
        $model = Concert::findOne(['id' => $id]);

        if($model->load(Yii::$app->request->post())) {
            if($model->status == Concert::STATUS_ACTIVE) {
                Concert::set_inactive_all();
                $model->status = Concert::STATUS_ACTIVE;
            }
        }

        if ($model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Informațiile concertului au fost modificate.'));
            $this->redirect(['concert/index']);
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'A apărut o eroare în salvarea informațiilor concertului.'));
        }

        return $this->redirect(['concert/index']);
    }

    /**
     * delete a concert
     * @param integer $id
     * @return void
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function actionDelete($id)
    {
        $model = Concert::findOne(['id' => $id]);
        if ($model->delete()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Concertul a fost șters cu succes.'));
        }

        $this->redirect(['concert/index']);
    }

    /**
     * Sets all concerts to inactive.
     *
     * @return mixed
     */
    public function actionSetinactive()
    {
        Concert::set_inactive_all();

        $this->redirect('index');
    }
}
