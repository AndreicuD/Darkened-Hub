<?php

namespace frontend\controllers;

use common\models\PublicProposal;
use common\models\Proposal;
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
class ProposalController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
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
     * lists the proposals
     * @param string|null $title
     * @return string
     */
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


    /**
     * create a proposal
     * @return Response
     */
    public function actionCreateproposal()
    {
        $model = new Proposal();
        $model->username = User::findIdentity(Yii::$app->user->id)->username;

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', Yii::t('app', 'Propunere creată cu succes.'));
                    return $this->redirect(['proposal/proposals']);
                } else {
                    Yii::$app->session->setFlash('error', Yii::t('app', 'Nu s-a reușit crearea propunerii.'));
                }
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Validare eșuată: ') . json_encode($model->getErrors()));
            }
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Încercarea de preluare a informației din formular a eșuat.'));
        }

        return $this->redirect(['proposal/proposals']);
    }


    /**
    * send to setlist a proposal
    * @param integer $id
    * @return string
    */
    public function actionSendtosetlist($id) {
        $searchModel = Proposal::findOne(['id' => $id]);
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
     * update a proposal
     * @param integer $id
     * @return Response
     */
    public function actionUpdateproposal($id)
    {
        $model = Proposal::findOne(['id' => $id]);
        //$model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Propunerea a fost modificată.'));
            $this->redirect(['proposal/proposals']);
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'A apărut o eroare în salvarea melodiei.'));
        }

        return $this->redirect(['proposal/proposals']);
    }

    /**
     * delete a proposal
     * @param integer $id
     * @return void
     * @throws StaleObjectException
     * @throws Throwable
     */
    public function actionDeleteproposal($id)
    {
        $model = Proposal::findOne(['id' => $id]);
        if ($model->delete()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Propunerea a fost ștearsă.'));
        }

        $this->redirect(['proposal/proposals']);
    }
}
