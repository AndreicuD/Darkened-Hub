<?php

namespace frontend\controllers;

use Yii;
use yii\db\ActiveRecord;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

use common\models\User;
use common\models\Song;
use common\models\Concert;
/**
 * Song controller
 */
class SongController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => [
                            'index', 'concert', 'create', 'update', 'delete', 'edit',
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
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
    public function actionIndex($title = null)
    {
        $searchModel = new Song();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageParam = 'p';
        $dataProvider->pagination->forcePageParam = 0;
        $dataProvider->pagination->defaultPageSize = 12;

        $user = new User();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'user' => $user,
        ]);
    }

    public function actionConcert()
    {
        $searchModel = new Song();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['is_in_concert' => 1]);
        $dataProvider->pagination->pageParam = 'p';
        $dataProvider->pagination->forcePageParam = 0;
        $dataProvider->pagination->defaultPageSize = 12;

        $user = new User();
 
        return $this->render('concert', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'user' => $user,
        ]);
    }
    
    public function actionCreate()
    {   
        $model = new Song();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Melodie creată cu succes.');
                    return $this->redirect(['song/index']);
                } else {
                    Yii::$app->session->setFlash('error', 'Nu s-a reușit crearea melodiei.');
                }
            } else {
                Yii::$app->session->setFlash('error', 'Validare eșuată: ' . json_encode($model->getErrors()));
            }
        } else {
            Yii::$app->session->setFlash('error', 'Încercarea de preluare a informației din formular a eșuat.');
        }

        return $this->redirect(['song/index']);
    }
    public function actionEdit($id, $page) {
        $searchModel = Song::findOne(['id' => $id]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageParam = 'p';
        $dataProvider->pagination->forcePageParam = 0;
        $dataProvider->pagination->defaultPageSize = 12;

        $user = new User();

        return $this->render('edit', [
            'model' => $searchModel,
            'dataProvider' => $dataProvider,
            'user' => $user,
            'page' => $page,
        ]);
    }
    public function actionUpdate($id, $page = 'index'): Response|string
    {
        $model = Song::findOne(['id' => $id]);
        //$model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Melodia a fost modificată.');
            $this->redirect(['song/' . $page]);
        } else {
            Yii::$app->session->setFlash('error', 'A apărut o eroare în salvarea melodiei.');
        }

        return $this->redirect(['song/' . $page]);
    }
    public function actionDelete($id)
    {
        $model = Song::findOne(['id' => $id]);
        if ($model->delete()) {
            Yii::$app->session->setFlash('success', 'Melodia a fost ștearsă.');
        }

        $this->redirect(['song/index']);
    }
}
