<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%concert}}".
 *
 * @property integer $id [int(auto increment)]
 * @property string $date [varchar(254)]
 */
class Concert extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%concert}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'required'],
            [['id', 'date'], 'safe'],
            [['id', 'date'], 'safe', 'on' => 'search'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'date' => Yii::t('app', 'Date'),
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params, $full = false) {
        $this->scenario = 'search';

        // Base query
        $query = self::find();

        
        // Data provider with default sorting
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['date' => SORT_ASC],
            ],
        ]);

        // Check if params are loaded and validated
        if (!$this->load($params) || !$this->validate()) {
            return $dataProvider;
        }

        // Additional filtering
        $query->andWhere(['is not', 'date', null]);

        return $dataProvider;
    }

    public function get_date($id) {
        return self::findOne(['id' => $id])->date;
    }
}
