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
 * @property string $date [datetime]
 * @property integer $status [tinyint(2)]
 * @property string $title [varchar(254)]
 * @property string $description [varchar(1000)]
 */


class Concert extends \yii\db\ActiveRecord
{

    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;
    
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
            [['date'], 'required', 'on' => 'default'],
            [['title'], 'string', 'max' => 254],
            [['description'], 'string', 'max' => 254],
            [['status'], 'in', 'range' => array_keys(self::statusesList())], // Validate allowed statuses
            [['id', 'date', 'title', 'description', 'status'], 'safe', 'on' => 'search'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'date' => Yii::t('app', 'Date'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
    * @return array the possible statuses
    */
    public static function statusesList(): array
    {
        return [
            self::STATUS_DELETED => Yii::t('app', 'Deleted'),
            self::STATUS_INACTIVE => Yii::t('app', 'Inactive'),
            self::STATUS_ACTIVE => Yii::t('app', 'Active'),
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
                'defaultOrder' => ['date' => SORT_DESC],
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

    /**
     * Sets the status to inactive for all concerts.
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public static function set_inactive_all(): void {
        
        Concert::updateAll(['status' => Concert::STATUS_INACTIVE]);
    }    

    public function get_date($id) {
        return self::findOne(['id' => $id])->date;
    }
}
