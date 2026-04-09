<?php

namespace frontend\models;

use common\models\User;
use Yii;
use yii\base\InvalidArgumentException;
use yii\base\Model;

class VerifyEmailForm extends Model
{
    /**
     * @var string
     */
    public $token;

    /**
     * @var User
     */
    private $_user;


    /**
     * Creates a form model with given token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws InvalidArgumentException if token is empty or not valid
     */
    public function __construct($token, array $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidArgumentException(Yii::t('app', 'Tokenul de verificare al email-ului nu poate fi gol.'));
        }
        $this->_user = User::findByVerificationToken($token);
        if (!$this->_user) {
            throw new InvalidArgumentException(Yii::t('app', 'Token de verificare al email-ului greșit.'));
        }
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'token' => Yii::t('app', 'Token'),
        ];
    }

    /**
     * Verify email
     *
     * @return User|null the saved model or null if saving fails
     */
    public function verifyEmail()
    {
        $user = $this->_user;
        $user->status = User::STATUS_ACTIVE;
        return $user->save(false) ? $user : null;
    }
}
