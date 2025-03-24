<?php

namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use frontend\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ChangePasswordForm;
use frontend\models\UploadAvatarForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use common\models\User;

/**
 * Site controller
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['signup', 'login', 'reset-password', 'request-password-reset', 'verify-email', 'resend-verification-email'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index', 'settings', 'logout', 'reset-password', 'request-password-reset', 'change-password', 'upload-avatar'],
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
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Searches for users based on the term sent via AJAX.
     *
     * @param string $term The search term from the user input.
     * @return array JSON response with matching usernames.
     */

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSettings()
    {
        $user = User::findOne(['id' => Yii::$app->user->id]);
        $changePasswordModel = new ChangePasswordForm();
        $uploadModel = new UploadAvatarForm();
    
        if ($user->load(Yii::$app->request->post())) {
            if ($user->validate()) {
                if ($user->save()) {
                    Yii::$app->session->setFlash('success', 'Informațiile au fost modificate.');
                } else {
                    Yii::$app->session->setFlash('error', 'Nu s-a reușit modificarea informațiilor.');
                }
            } else {
                Yii::$app->session->setFlash('error', 'Validare eșuată: ' . json_encode($user->getErrors()));
            }
        }
    
        return $this->render('settings', [
            'userModel' => $user,
            'changePasswordModel' => $changePasswordModel,
            'uploadModel' => $uploadModel,
        ]);
    }
    

    public function actionChangePassword()
    {
        $model = new ChangePasswordForm();

        if ($model->load(Yii::$app->request->post()) && $model->changePassword()) {
            Yii::$app->session->setFlash('success', 'Parola a fost schimbată cu succes.');
            return $this->redirect(['user/settings']);
        }

        Yii::$app->session->setFlash('error', 'Parola nu a fost schimbată. Verifică datele introduse.');
        return $this->redirect(['user/settings']);
    }

    public function actionUploadAvatar()
    {
        $model = new UploadAvatarForm();

        if (Yii::$app->request->isPost) {

            $model->avatar = UploadedFile::getInstance($model, 'avatar');

            if ($model->upload()) {
                Yii::$app->session->setFlash('success', 'Poza de profil a fost actualizată cu succes.');
            } else {
                Yii::$app->session->setFlash('error', 'Eroare la încărcarea imaginii.');
            }
        }

        return $this->redirect(['user/settings']);
    }


    /**
     * settings page
     * @return string
     */
    public function actionSettings()
    {
        $user = User::findOne(['id' => Yii::$app->user->id]);
        $changePasswordModel = new ChangePasswordForm();
        $uploadModel = new UploadAvatarForm();

        if ($user->load(Yii::$app->request->post())) {
            if ($user->validate()) {
                if ($user->save()) {
                    Yii::$app->session->setFlash('success', Yii::t('app', 'Informațiile au fost modificate.'));
                } else {
                    Yii::$app->session->setFlash('error', Yii::t('app', 'Nu s-a reușit modificarea informațiilor.'));
                }
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Validare eșuată: ') . json_encode($user->getErrors()));
            }
        }

        return $this->render('settings', [
            'userModel' => $user,
            'changePasswordModel' => $changePasswordModel,
            'uploadModel' => $uploadModel,
        ]);
    }


    /**
     * change the password
     * @return Response
     */
    public function actionChangePassword()
    {
        $model = new ChangePasswordForm();

        if ($model->load(Yii::$app->request->post()) && $model->changePassword()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Parola a fost schimbată cu succes.'));
            return $this->redirect(['user/settings']);
        }

        Yii::$app->session->setFlash('error', Yii::t('app', 'Parola nu a fost schimbată. Verifică datele introduse.'));
        return $this->redirect(['user/settings']);
    }

    /**
     * upload an avatar
     * @return Response
     */
    public function actionUploadAvatar()
    {
        $model = new UploadAvatarForm();

        if (Yii::$app->request->isPost) {

            $model->avatar = UploadedFile::getInstance($model, 'avatar');

            if ($model->upload()) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Poza de profil a fost actualizată cu succes.'));
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Eroare la încărcarea imaginii.'));
            }
        }

        return $this->redirect(['user/settings']);
    }


    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            //Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            Yii::$app->session->setFlash('success', Yii::t('app', 'Thank you for registration. You can now login.'));
            //return $this->goHome();
            $this->redirect(['user/login']);
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', Yii::t('app', "Check your email for further instructions. If you don't find the email at first, <b>please also check the spam folder</b>."));

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', Yii::t('app', 'Sorry, we are unable to reset password for the provided email address.'));
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'New password saved.'));

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Your email has been confirmed!'));
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', Yii::t('app', 'Sorry, we are unable to verify your account with provided token.'));
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Check your email for further instructions.'));
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', Yii::t('app', 'Sorry, we are unable to resend verification email for the provided email address.'));
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}
