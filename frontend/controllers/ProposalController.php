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
 * Proposal controller
 */
class ProposalController extends Controller
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
    public function actionPublic_proposals($title = null)
    {
        $searchModel = new PublicProposal();
        $songModel = new Song();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageParam = 'p';
        $dataProvider->pagination->forcePageParam = 0;
        $dataProvider->pagination->defaultPageSize = 12;

        $user = new User();

        return $this->render('public_proposals', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'songModel' => $songModel,
            'user' => $user,
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

        $user = new User();

        return $this->render('proposals', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'songModel' => $songModel,
            'user' => $user,
        ]);
    }
    public function actionCreatepublicproposal()
    {
        $model = new PublicProposal();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Propunere creată cu succes.');
                    return $this->redirect(['site/concerts']);
                } else {
                    Yii::$app->session->setFlash('error', 'Nu s-a reușit crearea propunerii.');
                }
            } else {
                Yii::$app->session->setFlash('error', 'Validare eșuată: ' . json_encode($model->getErrors()));
            }
        } else {
            Yii::$app->session->setFlash('error', 'Încercarea de preluare a informației din formular a eșuat.');
        }

        return $this->redirect(['site/concerts']);
    }
    public function actionCreateproposal()
    {
        $model = new Proposal();
        $model->username = User::findIdentity(Yii::$app->user->id)->username;

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Propunere creată cu succes.');
                    return $this->redirect(['proposal/proposals']);
                } else {
                    Yii::$app->session->setFlash('error', 'Nu s-a reușit crearea propunerii.');
                }
            } else {
                Yii::$app->session->setFlash('error', 'Validare eșuată: ' . json_encode($model->getErrors()));
            }
        } else {
            Yii::$app->session->setFlash('error', 'Încercarea de preluare a informației din formular a eșuat.');
        }

        return $this->redirect(['proposal/proposals']);
    }

    public function actionUpdatepublicproposal($id): Response|string
    {
        $model = PublicProposal::findOne(['id' => $id]);
        //$model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Propunerea a fost modificată.');
            $this->redirect(['proposal/public_proposals']);
        } else {
            Yii::$app->session->setFlash('error', 'A apărut o eroare în salvarea melodiei.');
        }

        return $this->redirect(['proposal/public_proposals']);
    }
    public function actionUpdateproposal($id): Response|string
    {
        $model = Proposal::findOne(['id' => $id]);
        //$model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Propunerea a fost modificată.');
            $this->redirect(['proposal/proposals']);
        } else {
            Yii::$app->session->setFlash('error', 'A apărut o eroare în salvarea melodiei.');
        }

        return $this->redirect(['proposal/proposals']);
    }
    public function actionDeletepublicproposal($id)
    {
        $model = PublicProposal::findOne(['id' => $id]);
        if ($model->delete()) {
            Yii::$app->session->setFlash('success', 'Propunerea a fost ștearsă.');
        }

        $this->redirect(['proposal/public_proposals']);
    }
    public function actionDeleteproposal($id)
    {
        $model = Proposal::findOne(['id' => $id]);
        if ($model->delete()) {
            Yii::$app->session->setFlash('success', 'Propunerea a fost ștearsă.');
        }

        $this->redirect(['proposal/proposals']);
    }
}
