<?php

namespace frontend\controllers;

use frontend\models\ContactForm;
use common\models\Concert;
use common\models\Announcement;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;

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
                            'index', 'createannouncement', 'updateannouncement', 'deleteannouncement',
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
        $concert = new Concert();
        $concert_date = $concert->get_date(1);

        $announcement = new Announcement();
        $announcement_list = $announcement->search(Yii::$app->request->queryParams);
        $announcement_list->pagination->pageParam = 'p';
        $announcement_list->pagination->forcePageParam = 0;
        $announcement_list->pagination->defaultPageSize = 12;
        
        return $this->render('index', [
            'concertModel' => $concert,
            'concert_date' => $concert_date,
            'announcementModel' => $announcement,
            'announcementList' => $announcement_list
        ]);
    }

    public function actionCreateannouncement()
    {
        $model = new Announcement();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Anunțul a fost creat cu succes.');
                    return $this->redirect(['announcement/index']);
                } else {
                    Yii::$app->session->setFlash('error', 'Nu s-a reușit crearea anunțului.');
                }
            } else {
                Yii::$app->session->setFlash('error', 'Validare eșuată: ' . json_encode($model->getErrors()));
            }
        } else {
            Yii::$app->session->setFlash('error', 'Încercarea de preluare a informației din formular a eșuat.');
        }

        return $this->redirect(['announcement/index']);
    }

    public function actionUpdateannouncement($id)
    {
        $model = Announcement::findOne(['id' => $id]);
        //$model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Anunțul a fost modificat.');
            $this->redirect(['announcement/index']);
        } else {
            Yii::$app->session->setFlash('error', 'A apărut o eroare în salvarea anunțului.');
        }

        return $this->redirect(['announcement/index']);
    }
    public function actionDeleteannouncement($id)
    {
        $model = Announcement::findOne(['id' => $id]);
        if ($model->delete()) {
            Yii::$app->session->setFlash('success', 'Anunțul a fost șters.');
        }

        $this->redirect(['announcement/index']);
    }
}
