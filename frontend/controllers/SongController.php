<?php

namespace frontend\controllers;

use Throwable;
use Yii;
use yii\db\ActiveRecord;
use yii\db\StaleObjectException;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
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
                            'index', 'concert', 'create', 'update', 'delete', 'edit', 'stats',
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
        $dataProvider->pagination->defaultPageSize = 10;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'user' => new User(),
            'users' => ArrayHelper::map(User::find()->all(), 'username', 'username'),
        ]);
    }

    /**
     * displays a concert
     * @return string
     */
    public function actionConcert()
    {
        $searchModel = new Song();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['is_in_concert' => 1]);
        $dataProvider->pagination->pageParam = 'p';
        $dataProvider->pagination->forcePageParam = 0;
        $dataProvider->pagination->defaultPageSize = 20;

        return $this->render('concert', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'user' => new User(),
            'users' => ArrayHelper::map(User::find()->all(), 'username', 'username'),
        ]);
    }

    /**
     * statistics page
     * @param string|null $title
     * @return string
     */
    public function actionStats($title = null)
    {
        $songModel = new Song();

        $users = User::find()->all();
        $userSongCounts_concert = [];
        $userSongCounts_all = [];

        foreach ($users as $user) {
            $userName = $user->username;
            $count_all = Song::find()
                ->where([
                    'or',
                    ['first_guitar' => $userName],
                    ['second_guitar' => $userName],
                    ['drums' => $userName],
                    ['bass' => $userName],
                    ['first_voice' => $userName],
                    ['second_voice' => $userName],
                    ['piano' => $userName]
                ])->count();
            $count_concert = Song::find()
                ->where([
                    'or',
                    ['first_guitar' => $userName, 'is_in_concert' => 1],
                    ['second_guitar' => $userName, 'is_in_concert' => 1],
                    ['drums' => $userName, 'is_in_concert' => 1],
                    ['bass' => $userName, 'is_in_concert' => 1],
                    ['first_voice' => $userName, 'is_in_concert' => 1],
                    ['second_voice' => $userName, 'is_in_concert' => 1],
                    ['piano' => $userName, 'is_in_concert' => 1]
                ])->count();

            if ($count_all > 0) {
                $userSongCounts_all[$userName] = [
                    'name' => $user->username,
                    'count' => $count_all
                ];
            }
            if ($count_concert > 0) {
                $userSongCounts_concert[$userName] = [
                    'name' => $user->username,
                    'count' => $count_concert
                ];
            }
        }

        // ordoneaza descrescator
        usort($userSongCounts_all, function ($a, $b) {
            return $b['count'] - $a['count'];
        });
        usort($userSongCounts_concert, function ($a, $b) {
            return $b['count'] - $a['count'];
        });

        //concert stuff
        $state1count_concert = count(Song::findAll(['state' =>  1, 'is_in_concert' => 1]));
        $state2count_concert = count(Song::findAll(['state' =>  2, 'is_in_concert' => 1]));
        $state3count_concert = count(Song::findAll(['state' =>  3, 'is_in_concert' => 1]));
        $state4count_concert = count(Song::findAll(['state' =>  4, 'is_in_concert' => 1]));
        $state5count_concert = count(Song::findAll(['state' =>  5, 'is_in_concert' => 1]));

        //all songs
        $state1count_all = count(Song::findAll(['state' =>  1]));
        $state2count_all = count(Song::findAll(['state' =>  2]));
        $state3count_all = count(Song::findAll(['state' =>  3]));
        $state4count_all = count(Song::findAll(['state' =>  4]));
        $state5count_all = count(Song::findAll(['state' =>  5]));

        return $this->render('stats', [
            'users' => $user,
            'songModel' => $songModel,
            'userSongCounts_all' => $userSongCounts_all,
            'userSongCounts_concert' => $userSongCounts_concert,

            'state1count_concert' => $state1count_concert,
            'state2count_concert' => $state2count_concert,
            'state3count_concert' => $state3count_concert,
            'state4count_concert' => $state4count_concert,
            'state5count_concert' => $state5count_concert,

            'state1count_all' => $state1count_all,
            'state2count_all' => $state2count_all,
            'state3count_all' => $state3count_all,
            'state4count_all' => $state4count_all,
            'state5count_all' => $state5count_all,
        ]);
    }

    /**
     * create a song
     * @return Response
     */
    public function actionCreate()
    {
        $model = new Song();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', Yii::t('app', 'Melodie creată cu succes.'));
                    return $this->redirect(['song/index']);
                } else {
                    Yii::$app->session->setFlash('error', Yii::t('app', 'Nu s-a reușit crearea melodiei.'));
                }
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Validare eșuată: ') . json_encode($model->getErrors()));
            }
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Încercarea de preluare a informației din formular a eșuat.'));
        }

        return $this->redirect(['song/index']);
    }

    /**
     * edit a song
     * @param integer $id
     * @param string $page
     * @return string
     */
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

    /**
     * update a song
     * @param integer $id
     * @param string $page
     * @return Response|string
     */
    public function actionUpdate($id, $page = 'index'): Response|string
    {
        $model = Song::findOne(['id' => $id]);
        //$model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Melodia a fost modificată.'));
            $this->redirect(['song/' . $page]);
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'A apărut o eroare în salvarea melodiei.'));
        }

        return $this->redirect(['song/' . $page]);
    }

    /**
     * delete a song
     * @param integer $id
     * @return void
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function actionDelete($id)
    {
        $model = Song::findOne(['id' => $id]);
        if ($model->delete()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Melodia a fost ștearsă.'));
        }

        $this->redirect(['song/index']);
    }
}
