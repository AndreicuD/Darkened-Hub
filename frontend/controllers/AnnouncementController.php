<?php

namespace frontend\controllers;

use frontend\models\ContactForm;
use common\models\Concert;
use common\models\Announcement;
use Throwable;
use Yii;
use yii\db\StaleObjectException;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\Response;

/**
 * Announcement controller
 */
class AnnouncementController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => [
                            'index', 'create', 'update', 'delete',
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
     * Displays index page for announcements.
     *
     * @return mixed
     */
    public function actionIndex()
    {

        $announcement = new Announcement();
        $announcement_list = $announcement->search(Yii::$app->request->queryParams);
        $announcement_list->pagination->pageParam = 'p';
        $announcement_list->pagination->forcePageParam = 0;
        $announcement_list->pagination->defaultPageSize = 1;

        return $this->render('index', [
            'announcementModel' => $announcement,
            'announcementList' => $announcement_list,
        ]);
    }

    /**
     * Create an anouncement
     * @return Response
     */
    public function actionCreate()
    {
        $model = new Announcement();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', Yii::t('app', 'Anunțul a fost creat cu succes.'));
                    return $this->redirect(['index']);
                } else {
                    Yii::$app->session->setFlash('error', Yii::t('app', 'Nu s-a reușit crearea anunțului.'));
                }
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Validare eșuată: ') . json_encode($model->getErrors()));
            }
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Încercarea de preluare a informației din formular a eșuat.'));
        }

        return $this->redirect(['index']);
    }

    /**
     * Update an announcement
     * @param integer $id
     * @return Response
     */
    public function actionUpdate($id)
    {
        $model = Announcement::findOne(['id' => $id]);
        //$model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Anunțul a fost modificat.'));
            $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'A apărut o eroare în salvarea anunțului.'));
        }

        return $this->redirect(['index']);
    }

    /**
     * Delete an announcement
     * @param integer $id
     * @return void
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function actionDelete($id)
    {
        $model = Announcement::findOne(['id' => $id]);
        if ($model->delete()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Anunțul a fost șters.'));
        }

        $this->redirect(['index']);
    }
}
