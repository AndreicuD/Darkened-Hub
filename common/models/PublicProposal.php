<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%public_proposal}}".
 *
 * @property integer $id [int(11) unsigned (auto increment)]
 * @property string $title [varchar(254)]
 * @property string $artist [varchar(254)]
 * @property string $info [varchar(254)]
 * @property integer $created_at [datetime]
 * @property integer $updated_at [timestamp = current_timestamp()]
 *
 * @property integer $page_size
 *
 * @property User $user
 */
class PublicProposal extends \yii\db\ActiveRecord
{
    public $page_size;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%public_proposal}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'artist'], 'required', 'on' => 'default'],
            [['title', 'artist', 'info'], 'string', 'max' => 254],
            [['title', 'artist', 'info'], 'safe', 'on' => 'search'],
            [['title', 'artist', 'info'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'artist' => Yii::t('app', 'Artist'),
            'info' => Yii::t('app', 'More information'),
            'page_size' => Yii::t('app', 'Page size'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params, $full = false)
    {
        $this->scenario = 'search';

        $query = self::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> [
                'defaultOrder' => ['id'=>SORT_DESC],
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

    // Filter conditions

        if ($full) {
            $dataProvider->setPagination(false);
        } else {
            $dataProvider->pagination->pageSize = ($this->page_size > 0) ? $this->page_size : 10;
        }

        $query->andFilterWhere(['like', 'title', $this->title]);
        $query->andFilterWhere(['like', 'artist', $this->artist]);
        $query->andFilterWhere(['like', 'created_at', $this->created_at]);
        $query->andFilterWhere(['like', 'updated_at', $this->updated_at]);

        return $dataProvider;
    }

    public function searchLatest($limit = 5)
    {
        $this->scenario = 'search';

        $query = self::find();

        $query->limit($limit);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> [
                'defaultOrder' => ['id'=>SORT_DESC],
            ]
        ]);
        $dataProvider->setPagination(false);

        return $dataProvider;
    }
}
