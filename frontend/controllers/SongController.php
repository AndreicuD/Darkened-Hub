<?php

namespace frontend\controllers;

use common\models\PublicProposal;
use common\models\Proposal;
use common\models\User;
use Yii;
use yii\db\ActiveRecord;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\Song;
use yii\web\Response;

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
                        'actions' => ['createpublicproposal'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => [
                            'index', 'concert', 'create', 'update', 'delete',
                            'public_proposals', 'createpublicproposal', 'deletepublicproposal', 'updatepublicproposal',
                            'proposals', 'createproposal', 'deleteproposal', 'updateproposal'
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

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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

        return $this->render('concert', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionPublic_proposals($title = null)
    {
        $searchModel = new PublicProposal();
        $songModel = new Song();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageParam = 'p';
        $dataProvider->pagination->forcePageParam = 0;
        $dataProvider->pagination->defaultPageSize = 12;

        return $this->render('public_proposals', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'songModel' => $songModel,
        ]);
    }
    public function actionProposals($title = null)
    {
        $searchModel = new Proposal();
        $songModel = new Song();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageParam = 'p';
        $dataProvider->pagination->forcePageParam = 0;
        $dataProvider->pagination->defaultPageSize = 12;

        return $this->render('proposals', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'songModel' => $songModel,
        ]);
    }

    public function actionCreate()
    {   
        $model = new Song();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Song created successfully.');
                    return $this->redirect(['song/index']);
                } else {
                    Yii::$app->session->setFlash('error', 'Failed to save song.');
                }
            } else {
                Yii::$app->session->setFlash('error', 'Validation failed: ' . json_encode($model->getErrors()));
            }
        } else {
            Yii::$app->session->setFlash('error', 'Failed to load form data.');
        }

        return $this->redirect(['song/index']);
    }
    public function actionCreatepublicproposal()
    {
        $model = new PublicProposal();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Proposal created successfully.');
                    return $this->redirect(['site/concerts']);
                } else {
                    Yii::$app->session->setFlash('error', 'Failed to save proposal.');
                }
            } else {
                Yii::$app->session->setFlash('error', 'Validation failed: ' . json_encode($model->getErrors()));
            }
        } else {
            Yii::$app->session->setFlash('error', 'Failed to load form data.');
        }

        return $this->redirect(['site/concerts']);
    }
    public function actionCreateproposal()
    {
        $model = new Proposal();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Proposal created successfully.');
                    return $this->redirect(['song/proposals']);
                } else {
                    Yii::$app->session->setFlash('error', 'Failed to save proposal.');
                }
            } else {
                Yii::$app->session->setFlash('error', 'Validation failed: ' . json_encode($model->getErrors()));
            }
        } else {
            Yii::$app->session->setFlash('error', 'Failed to load form data.');
        }

        return $this->redirect(['song/proposals']);
    }


    public function actionUpdate($id, $page = 'index'): Response|string
    {
        $model = Song::findOne(['id' => $id]);
        //$model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'The song has been updated.');
            $this->redirect(['song/' . $page]);
        } else {
            Yii::$app->session->setFlash('error', 'There was an error saving the song.');
        }

        return $this->redirect(['song/' . $page]);
    }
    public function actionUpdatepublicproposal($id): Response|string
    {
        $model = PublicProposal::findOne(['id' => $id]);
        //$model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'The proposal has been updated.');
            $this->redirect(['song/public_proposals']);
        } else {
            Yii::$app->session->setFlash('error', 'There was an error saving the proposal.');
        }

        return $this->redirect(['song/public_proposals']);
    }
    public function actionUpdateproposal($id): Response|string
    {
        $model = Proposal::findOne(['id' => $id]);
        //$model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'The proposal has been updated.');
            $this->redirect(['song/proposals']);
        } else {
            Yii::$app->session->setFlash('error', 'There was an error saving the proposal.');
        }

        return $this->redirect(['song/proposals']);
    }

    public function actionDelete($id)
    {
        $model = Song::findOne(['id' => $id]);
        if ($model->delete()) {
            Yii::$app->session->setFlash('success', 'The song has been deleted.');
        }

        $this->redirect(['song/index']);
    }
    public function actionDeletepublicproposal($id)
    {
        $model = PublicProposal::findOne(['id' => $id]);
        if ($model->delete()) {
            Yii::$app->session->setFlash('success', 'The proposal has been deleted.');
        }

        $this->redirect(['song/public_proposals']);
    }
    public function actionDeleteproposal($id)
    {
        $model = Proposal::findOne(['id' => $id]);
        if ($model->delete()) {
            Yii::$app->session->setFlash('success', 'The proposal has been deleted.');
        }

        $this->redirect(['song/proposals']);
    }
}
