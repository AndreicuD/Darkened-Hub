<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadAvatarForm extends Model
{
    public $avatar;

    public function rules()
    {
        return [
            [['avatar'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, gif'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(): array
    {
        return [
            'avatar' => Yii::t('app', 'Avatar'),
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $userId = Yii::$app->user->id;

            // Use an absolute path instead of a relative one
            $uploadPath = Yii::getAlias('@frontend/web/img/user-icons/');
            $extension = strtolower(pathinfo($this->avatar->name, PATHINFO_EXTENSION));
            $fileName = $userId . '.' . $extension;

            $fullPath = $uploadPath . $fileName;

            // Ensure directory exists
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            // Delete old avatars
            $extensions = ['png', 'jpg', 'jpeg', 'gif'];
            foreach ($extensions as $ext) {
                $oldFile = $uploadPath . $userId . '.' . $ext;
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            }

            if ($this->avatar->saveAs($fullPath)) {
                foreach ($extensions as $ext) {
                    $file = $uploadPath . $userId . '.' . $ext;
                    if (file_exists($file)) {
                        return true;
                    }
                }
            }

        }
        return false;
    }
}
