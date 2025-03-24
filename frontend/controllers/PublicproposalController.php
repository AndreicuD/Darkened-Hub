<?php

namespace frontend\controllers;

use common\models\PublicProposal;
use common\models\User;
use Throwable;
use Yii;
use yii\db\ActiveRecord;
use yii\db\StaleObjectException;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\Song;
use yii\web\Response;

/**
 * Proposal controller
 */
class PublicproposalController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['createproposal'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => [
                            'proposals', 'createproposal', 'deleteproposal', 'updateproposal', 'sendtosetlist',
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
     * Lists he public proposals
     * @param string|null $title
     * @return string
     */
    public function actionProposals($title = null)
    {
        $searchModel = new PublicProposal();
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

    /**
     * create a public proposal
     * @return Response
     */
    public function actionCreateproposal()
    {
        $model = new PublicProposal();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', Yii::t('app', 'Propunere creată cu succes.'));
                    return $this->redirect(['site/concerts']);
                } else {
                    Yii::$app->session->setFlash('error', Yii::t('app', 'Nu s-a reușit crearea propunerii.'));
                }
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Validare eșuată: ') . json_encode($model->getErrors()));
            }
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Încercarea de preluare a informației din formular a eșuat.'));
        }

        return $this->redirect(['site/concerts']);
    }

    /**
    * send to setlist a proposal
    * @param integer $id
    * @return string
    */
    public function actionSendtosetlist($id) {
        $searchModel = PublicProposal::findOne(['id' => $id]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageParam = 'p';
        $dataProvider->pagination->forcePageParam = 0;
        $dataProvider->pagination->defaultPageSize = 12;

        $user = new User();

        return $this->render('sendtosetlist', [
            'songModel' => new Song(),
            'model' => $searchModel,
            'dataProvider' => $dataProvider,
            'user' => $user,
        ]);
    }

    /**
     * update a public proposal
     * @param integer $id
     * @return Response
     */
    public function actionUpdateproposal($id)
    {
        $model = PublicProposal::findOne(['id' => $id]);
        //$model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Propunerea a fost modificată.'));
            $this->redirect(['publicproposal/proposals']);
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'A apărut o eroare în salvarea melodiei.'));
        }

        return $this->redirect(['publicproposal/proposals']);
    }

    /**
     * delete a public proposal
     * @param integer $id
     * @return void
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function actionDeleteproposal($id)
    {
        $model = PublicProposal::findOne(['id' => $id]);
        if ($model->delete()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Propunerea a fost ștearsă.'));
        }

        $this->redirect(['publicproposal/proposals']);
    }

}
